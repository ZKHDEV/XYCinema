<?php
namespace Home\Controller;
use Think\Controller;

class BaseController extends Controller
{
    protected static $ticket;
    protected static $movie;
    protected static $cinema;
    protected static $room;
    protected static $order;
    protected static $user;
    protected static $comment;
    protected static $employ;
    protected static $notice;
    protected static $wantmovie;
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

        $u_id=session('u_id');

        $allowac = array('empty-_empty','home-index','movie-detail','home-getcinema','home-getmovie','home-getticket','home-getlocation',
            'home-getcity','home-about','home-join','home-connect','home-notice');
        if(empty($u_id) && !in_array(strtolower($currentca),$allowac))
        {
            $currentm = __MODULE__;
            $js = <<<eof
                    <script type="text/javascript">
                        alert("请先登录！");
                        window.top.location.href="$currentm/Manager/login";
                    </script>
eof;
            echo $js;
        }


        $this::$ticket = new \Model\TicketModel();
        $this::$movie = new \Model\MovieModel();
        $this::$cinema = new \Model\CinemaModel();
        $this::$room = new \Model\RoomModel();
        $this::$order = new \Model\OrderModel();
        $this::$user = new \Model\UserModel();
        $this::$comment = new \Model\CommentModel();
        $this::$employ = new \Model\EmployModel();
        $this::$notice = new \Model\NoticeModel();
        $this::$wantmovie = new \Model\WantmovieModel();
        $this::$stage = new \Model\StageModel();
    }
}