<?php

namespace Home\Controller;

class UserController extends BaseController
{
    public function index()
    {
        $u_id = session("u_id");
        $userinfo = $this::$user->find($u_id);

        //获取用户全部订单信息
        $info = $this::$order->where("o_delflag=0 and o_userid=%d",$u_id)->select();
        foreach($info as $key=>$in)
        {
            if(intval($in['o_state'])===0 && strtotime(date('Y-m-d H:i:s')) - strtotime($in['o_subtime']) > 15*60)
            {
                $this::$order->updatestate($in['o_id'],3);
                $info[$key]['o_state'] = 3;
            }
            $ticketinfo = $this::$ticket->field("t_date,t_time,t_movieid,t_standard")->find($in['o_ticketid']);
            $info[$key]['movie'] = $this::$movie->field("m_name")->find($ticketinfo['t_movieid'])['m_name'];
            $info[$key]['standard'] = $ticketinfo['t_standard'];
            $info[$key]['date'] = $ticketinfo['t_date'];
            $info[$key]['time'] = $ticketinfo['t_time'];
        }

        $this->assign('user',$userinfo);
        $this->assign('orders',$info);
        $this->display();
    }

    /**
     * 修改个人信息
     */
    public function changemsg()
    {
        if(!empty($_POST))
        {
            if(empty($_POST['u_name']) || empty($_POST['u_email']))
            {
                $this->error("用户名或邮箱不能为空");
            }
            if(!preg_match('/^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/',$_POST['u_email']))
            {
                $this->error("邮箱格式错误");
            }
            $tmp = $this::$user->where("u_delflag=0 and u_id<>%d and u_email='%s'",session('u_id'),$_POST['u_email'])->find();
            if(!empty($tmp))
            {
                $this->error("邮箱已存在");
            }

            $user = $this::$user->find(session('u_id'));
            $user['u_name']=$_POST['u_name'];
            $user['u_email']=$_POST['u_email'];
            $user['u_modifiedon']=date('Y-m-d H:i:s');

            if($this::$user->save($user))
            {
                session("u_name",$user['u_name']);
                $this->success("修改成功",U("index"));
            }
            else
            {
                $this->error("修改失败");
            }
        }
        else
        {
            $userinfo = $this::$user->find(session('u_id'));

            $this->assign('user',$userinfo);
            $this->display();
        }
    }

    /**
     * 修改密码
     */
    public function changepwd()
    {
        if(!empty($_POST))
        {
            if(empty($_POST['o_pwd']) || empty($_POST['u_pwd']))
            {
                $error['o_pwd']='必填';
                $error['u_pwd']='必填';
            }
            else
            {
                if($_POST['u_pwd'] !== $_POST['r_pwd'])
                {
                    $error['r_pwd']='密码不匹配';
                }
                else
                {
                    if(!$this::$user->checkprepwd(session('u_id'),$_POST['o_pwd']))
                    {
                        $error['o_pwd']='原密码错误';
                    }
                    else
                    {
                        //验证通过，修改密码
                        if($this::$user->changepwd(session('u_id'),$_POST['u_pwd']))
                        {
                            session('u_id',null);
                            session('u_name',null);
                            session('u_phone',null);
                            $currentm = __MODULE__;
                            $js = <<<eof
                    <script type="text/javascript">
                        alert("密码修改成功，请重新登录！");
                        window.top.location.href="$currentm/Manager/login";
                    </script>
eof;
                            echo $js;
                        }
                        else
                        {
                            $this->error('密码修改失败,请重试');
                        }
                    }
                }
            }

            $this->assign('error',$error);
            $this->display();
        }
        else
        {
            $userinfo = $this::$user->find(session('u_id'));

            $this->assign('user',$userinfo);
            $this->display();
        }
    }

    public function comment()
    {
        $commentinfo = $this::$comment->where("c_delflag=0 and c_userid=%d",session('u_id'))->order("c_movieid desc")->select();
        foreach($commentinfo as $key=>$co)
        {
            $commentinfo[$key]['movie'] = $this::$movie->field("m_name")->find($co['c_movieid'])['m_name'];
        }
        $userinfo = $this::$user->find(session('u_id'));

        $this->assign('user',$userinfo);
        $this->assign('mycomments',$commentinfo);
        $this->display();
    }

    public function order($o_id)
    {
        //验证非法访问
        $orderinfo = $this::$order->where("o_delflag=0 and o_userid=%d",session('u_id'))->find($o_id);
        if(empty($orderinfo))
        {
            $this->display('./404.html');
            exit;
        }

        //获取订单详情
        $ticketinfo = $this::$ticket->find($orderinfo['o_ticketid']);

        $seatarr = explode(';',$orderinfo['o_seatlist']);
        $orderinfo['ticketnum'] = count($seatarr);
        $orderinfo['movie'] = $this::$movie->field("m_name")->find($ticketinfo['t_movieid'])['m_name'];
        $orderinfo['standard'] = $ticketinfo['t_standard'];
        $orderinfo['cinema'] = $this::$cinema->field("c_name")->find($ticketinfo['t_cinemaid'])['c_name'];
        $orderinfo['room'] = $this::$room->field("r_name")->find($ticketinfo['t_roomid'])['r_name'];
        $orderinfo['date'] = $ticketinfo['t_date'];
        $orderinfo['time'] = $ticketinfo['t_time'];
        $orderinfo['points'] = intval($ticketinfo['t_points'])*$orderinfo['ticketnum'];

        $userinfo = $this::$user->find(session('u_id'));

        $this->assign('user',$userinfo);
        $this->assign('order',$orderinfo);
        $this->display();

    }

    public function permsg()
    {
        $userinfo = $this::$user->find(session('u_id'));

        $this->assign('user',$userinfo);
        $this->display();
    }

    /**
     * 用户订单历史纪录
     */
    public function history()
    {
        $userinfo = $this::$user->find(session('u_id'));
        $orderinfo = $this::$order->field("o_ticketid")->where("o_userid=%d",session('u_id'))->select();

        $movieids = array();
        foreach($orderinfo as $o)
        {
            $movieids[] = $this::$ticket->field("t_movieid")->find($o['o_ticketid'])['t_movieid'];
        }

        $movieids = array_unique($movieids);

        $movies = array();
        foreach($movieids as $id)
        {
            $movies[] = $this::$movie->find($id);
        }

        $this->assign('movies',$movies);
        $this->assign('user',$userinfo);
        $this->display();
    }

    /**
     * 获取想看电影列表
     */
    public function wantsee()
    {
        $userinfo = $this::$user->find(session('u_id'));
        $wantmovieinfo = $this::$wantmovie->field("w_movieid")->where("w_delflag=0 and w_userid=%d",session('u_id'))->select();

        $movieids = array();
        foreach($wantmovieinfo as $w)
        {
            $movieids[] = $w['w_movieid'];
        }

        $movieids = array_unique($movieids);

        $movies = array();
        foreach($movieids as $id)
        {
            $movies[] = $this::$movie->find($id);
        }

        $this->assign('movies',$movies);
        $this->assign('user',$userinfo);
        $this->display();
    }
}