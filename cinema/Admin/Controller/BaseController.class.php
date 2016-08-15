<?php
namespace Admin\Controller;
use Think\Controller;

class BaseController extends Controller
{
    protected static $admin;
    protected static $ticket;
    protected static $movie;
    protected static $cinema;
    protected static $room;
    protected static $order;
    protected static $user;
    protected static $comment;
    protected static $employ;
    protected static $notice;
    protected static $stage;


    protected function _empty()
    {
        $this->display('./404.html');
    }
    
    function __construct()
    {
        parent::__construct();
        
        //验证是否登录
        $currentca = CONTROLLER_NAME.'-'.ACTION_NAME;

        $a_id=session('a_id');
        
        $allowac = array('manager-login','manager-logout','manager-verifyimg','empty-_empty');
        if(empty($a_id) && !in_array(strtolower($currentca),$allowac))
        {
            $currentm = __MODULE__;
            $js = <<<eof
                    <script type="text/javascript">
                        window.top.location.href="$currentm/Manager/login";
                    </script>
eof;
            echo $js;
        }

        $this::$admin = new \Admin\Model\AdminModel();
        $this::$ticket = new \Model\TicketModel();
        $this::$movie = new \Model\MovieModel();
        $this::$cinema = new \Model\CinemaModel();
        $this::$room = new \Model\RoomModel();
        $this::$order = new \Model\OrderModel();
        $this::$user = new \Model\UserModel();
        $this::$comment = new \Model\CommentModel();
        $this::$employ = new \Model\EmployModel();
        $this::$notice = new \Model\NoticeModel();
        $this::$stage = new \Model\StageModel();
    }
}
