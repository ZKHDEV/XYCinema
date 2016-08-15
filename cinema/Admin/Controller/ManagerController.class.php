<?php
namespace Admin\Controller;

class ManagerController extends BaseController
{
    public function login()
    {
        if(!empty($_POST))
        {
            $verify = new \Think\Verify();
            if($verify ->check($_POST['verify']))
            {
                $info = $this::$admin -> checkLogin($_POST['a_name'],$_POST['a_pwd']);
                if($info)
                {
                    session('a_id',$info['a_id'],1800);
                    session('a_name',$info['a_name'],1800);
                    $this->success('登陆成功',U('Admin/index'));
                }
                else
                {
                    $this -> error('用户名或密码错误','login');
                }
            }
            else
            {
                $this -> error('验证码错误','login');
            }
        }
        else
        {
            $this->display();
        }
    }

    public function verifyImg()
    {
        $config = array(
            'fontSize'  =>  16,              // 验证码字体大小(px)
            'imageH'    =>  40,               // 验证码图片高度
            'imageW'    =>  120,               // 验证码图片宽度
            'length'    =>  4,               // 验证码位数
            'fontttf'   =>  '4.ttf',              // 验证码字体，不设置随机获取
        );
        $verify = new \Think\Verify($config);
        $verify -> entry();
    }

    public function logout()
    {
        session('a_id',null);
        session('a_name',null);
         $currentm = __MODULE__;
            $js = <<<eof
                    <script type="text/javascript">
                        window.top.location.href="$currentm/Manager/login";
                    </script>
eof;
            echo $js;
    }

    public function changepwd($a_id)
    {
        if(!empty($_POST))
        {
            if(empty($_POST['p_pwd']) || empty($_POST['a_pwd']))
            {
                $error['p_pwd']='必填';
                $error['a_pwd']='必填';
            }
            else
            {
                if($_POST['a_pwd'] !== $_POST['r_pwd'])
                {
                    $error['r_pwd']='密码不匹配';
                }
                else
                {
                    if(!$this::$admin->checkprepwd($a_id,$_POST['p_pwd']))
                    {
                        $error['p_pwd']='原密码错误';
                    }
                    else
                    {
                        //验证通过，修改密码
                        if($this::$admin->changepwd($a_id,$_POST['a_pwd']))
                        {
                            session('a_id',null);
                            session('a_name',null);
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
            $this->display();
        }
    }
}
