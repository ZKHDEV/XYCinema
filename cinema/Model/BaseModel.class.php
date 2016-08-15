<?php

namespace Model;
use Think\Model;

class BaseModel extends Model
{
    //设置批量验证
    protected $patchValidate = true;

    private $classname;

    function __construct()
    {
        parent::__construct();
        //获取调用Model类名
        $this->classname = substr(get_called_class(),6);
        $this->classname = substr_replace($this->classname,'',-5,5);
    }

    /**
     * 逻辑删除
     * @param $id
     * @return bool
     */
    public function deleteByLogical($id)
    {
        $currentmodel = M($this->classname);
        $info = $currentmodel->find($id);
        $pre = strtolower(substr($this->classname,0,1));
        $delflag = $pre.'_delflag';
        $info[$delflag] = 1;
        $res = $currentmodel->save($info);
        if($res)
        {
            return $res;
        }
        else
        {
            return false;
        }
    }
}