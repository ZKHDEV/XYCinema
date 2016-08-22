<?php  
define("DB_SERVER","127.0.0.1");  
define("DB_PORT",3306);  
define("DB_CATALOG","test");  
define("DB_USERID","root");  
define("DB_PASSWORD","");  
class DAL {  
    private static $__queries=0;  
    private static $__PDO=null;  
    private static function connect() {  
        if(isset(self::$__PDO))return;  
        try {  
            $dsn="mysql:host=".DB_SERVER.";port=".DB_PORT.";dbname=".DB_CATALOG;  
            self::$__PDO=new PDO('mysql:host=127.0.0.1;port=3306;dbname=test', DB_USERID, DB_PASSWORD);  
        } catch(PDOException $e) {  
            echo $e->getMessage().'<br />';  
        }  
    }
	private static function execute($sql,$params) {  
        self::connect();  
        try {  
            $stmt=self::$__PDO->prepare($sql);  
            if($params!==null) {  
                if(is_array($params) || is_object($params)) {  
                    $i=1;  
                    foreach($params as $param) {  
                        $stmt->bindValue($i++,$param);  
                    }  
                } else {  
                    $stmt->bindValue(1,$params);  
                }  
            }  
            if($rows=$stmt->execute()) {  
                self::$__queries++;  
                return array('stmt'=>$stmt,'rows'=>$rows);  
            } else {  
                $err=$stmt->errorInfo();  
                throw new PDOException($err[2],$err[1]);  
            }  
        } catch(PDOException $e) {  
              echo $e->getMessage().'<br />';  
        }  
    }  
	
	public static function insert($sql,$params=null) {  
        $res=self::execute($sql,$params);  
        return self::$__PDO->lastInsertId();  
    }  

    public static function update($sql,$params=null) {  
        $res=self::execute($sql,$params);  
        return $res['rows'];  
    }  

    public static function delete($sql,$params=null) {  
        $res=self::execute($sql,$params);  
        return $res['rows'];  
    }  
	
	public static function query($sql,$params=null) {  
        $res=self::execute($sql,$params);  
        return new DBRecordset($res['stmt']);  
    } 
	public static function getOne($sql,$params=null) {  
        $res=self::execute($sql,$params);
        return $res['stmt']->fetchColumn();  
    }  
	//for Transaction start  
    public static function beginTransaction() {  
        return self::$__PDO->beginTransaction();  
    }  
    public static function rollBack() {  
        return self::$__PDO->rollBack();  
    }  
    public static function commit() {  
        return self::$__PDO->commit();  
    }  
    //for Transaction end  
	public static function pagination($countSql,$selectSql,$params,&$pageNow,$pageSize,&$count) {  
        if($pageNow<=0)$pageNow=1;  
        $count=self::getOne($countSql,$params);  
        $pageCount=ceil($count/$pageSize);  
        if($pageNow>$pageCount)$pageNow=$pageCount;  
        if($pageNow<=0)$pageNow=1;  
        $offset=($pageNow-1)*$pageSize;  
        $sql=$selectSql.' LIMIT '.$offset.','.$pageSize;  
		
        return self::query($sql,$params);  
    }  
	
}
/********************************************************************************************
分页调用示例

<?php
require_once("SqlHelper.php");
$dal=new DAL;
$countSql="select count(*) from message;";  //为计算出记录总数而执行的SQL语句
$selectSql="select * from message"; //查询的SQL语句，后面不能有分号；
$pageNow=1;
$count=10;
$dbrecordset=$dal->pagination($countSql,$selectSql,null,$pageNow,3,$count);
echo $count;
$arr=$dbrecordset->getAllRows(); 
var_dump($arr);
?>
*****************************************************************************************/

class DBRecordset {  
    private $PDOStatement;  
    public function __construct(&$stmt) {  
        $this->PDOStatement=&$stmt;
        $this->PDOStatement->setFetchMode(PDO::FETCH_ASSOC);  
    }  
    public function next() {  
        return $this->PDOStatement->fetch();  
    }  
    public function count() {  
        //for mysql PDOStatement will return the number of rows in the resultset  
        return $this->PDOStatement->rowCount();  
    }  
    public function getAllRows() {  
        return $this->PDOStatement->fetchAll();  
    }  
    public function columnCount() {  
        return $this->PDOStatement->columnCount();  
    }  
   
}  