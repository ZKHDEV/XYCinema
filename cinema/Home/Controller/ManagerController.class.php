<?php
namespace Home\Controller;
use Think\Controller;

class ManagerController extends Controller
{
    protected function _empty()
    {
        $this->display('./404.html');
    }

    public function login()
    {
        if(!empty($_POST))
        {
            $verify = new \Think\Verify();
            if($verify ->check($_POST['verify']))
            {
                $user = new \Model\UserModel();
                $info = $user -> checkLogin($_POST['u_phone'],$_POST['u_pwd']);
                if($info)
                {
                    session('u_id',$info['u_id'],1800);
                    session('u_phone',$info['u_phone'],1800);
                    session('u_name',$info['u_name'],1800);
//                    $this->redirect('Admin/index');
                    $this->success('登陆成功',U('Home/Home/index'));
                }
                else
                {
                    $this -> error('用户名或密码错误',U('login'));
                }
            }
            else
            {
                $this -> error('验证码错误',U('login'));
            }
        }
        else
        {
            $this->display();
        }
    }

    /**
     * 生成验证码
     */
    public function verifyImg()
    {
       $config = array(
           'fontSize'  =>  16,
           'imageH'    =>  40,
           'imageW'    =>  120,
           'length'    =>  4,
           'fontttf'   =>  '4.ttf'
       );
       $verify=new \Think\Verify($config);
       $verify->entry();
    }

    public function logout()
    {
        session('u_id',null);
        session('u_phone',null);
        session('u_name',null);
        $this->success("成功注销",U("Home/Manager/login"));
    }

    /**
     * 校验手机号
     * @param string $phone
     */
    public function checkPhone($phone='')
    {
        $user = new \Model\UserModel();
        if($user->checkPhone($phone))
        {
            echo '号码已存在';
        }
    }

    /**
     * 校验邮箱
     * @param string $phone
     */
    public function checkEmail($email='')
    {
        $user = new \Model\UserModel();
        if($user->checkEmail($email))
        {
            echo '邮箱已存在';
        }
    }

    /**
     * 注册
     */
    public function register()
    {
        if(!empty($_POST))
        {
            //验证图形验证码
            $verity = new \Think\Verify();
            if($verity->check($_POST['verify']))
            {
                //验证手机验证码
                if($_POST['u_phone']!=session('mobile') or $_POST['mobile_code']!=session('mobile_code') or empty($_POST['u_phone']) or empty($_POST['mobile_code']))
                {
                    $this->error('手机验证码错误',U('register'));
                }
                else
                {
                    session('mobile',null);
                    session('mobile_code',null);

                    $user = new \Model\UserModel();
                    $res = $user->create();
                    if($res)
                    {
                        if(!$user->checkPhone($res['u_phone']))
                        {
                            if(!$user->checkEmail($res['u_email']))
                            {
                                if($res['u_pwd'] == $_POST['r_pwd'])
                                {
                                    $res['u_subtime'] = date('Y-m-d H:i:s');
                                    $res['u_modifiedon'] = date('Y-m-d H:i:s');
                                    if($user->add($res))
                                    {
                                        $this->success('注册成功',U('login'));
                                    }
                                    else
                                    {
                                        $this->error('注册失败，请重试',U('register'));
                                    }
                                }
                                else
                                {
                                    $this->error('密码不匹配',U('register'));
                                }
                            }
                            else
                            {
                                $this->error('邮箱已存在',U('register'));
                            }
                        }
                        else
                        {
                            $this->error('手机号已存在',U('register'));
                        }
                    }
                    else
                    {
                        $this->assign('error',$user->getError());
                        $this->display();
                    }
                }
            }
            else
            {
                $this->error('验证码错误',U('register'));
            }
        }
        else
        {
            //生成随机手机验证码
            session('send_code',$this->random(6,1));
            $this->display();
        }
    }

    /**
     * 忘记密码
     */
    public function forget()
    {
        if(!empty($_POST))
        {
            if(empty($_POST['u_phone']) || empty($_POST['u_email']) || empty($_POST['verify']))
            {
                $this->error('手机号、邮箱和验证码不能为空',U('forget'));
            }
            else
            {
                $verity = new \Think\Verify();
                if($verity->check($_POST['verify']))
                {
                    $user = new \Model\UserModel();
                    if(!$user->checkPhone($_POST['u_phone']))
                    {
                        $this->error('手机号不存在',U('forget'));
                    }
                    else
                    {
                        if($res = $user->checkEmailByPhone($_POST['u_phone'],$_POST['u_email']))
                        {
                            //生成随机密码
                            $tmppwd = $this->random(10,0);
                            $content = "这是您的临时密码：$tmppwd,请及时修改！";
                            //发送随机密码到用户邮箱
                            if(think_send_mail($_POST['u_email'],$_POST['u_email'],"密码重置",$content)===true)
                            {
                                if($user->changepwd($res['u_id'],md5($tmppwd)))
                                {
                                    $this->success("新密码已发送至您的邮箱，请尽快修改",U('login'));
                                }
                                else
                                {
                                    $this->error('密码重置失败，请重试',U('forget'));
                                }
                            }
                            else
                            {
                                $this->error('密码重置失败，请重试',U('forget'));
                            }
                        }
                        else
                        {
                            $this->error('邮箱不正确',U('forget'));
                        }
                    }
                }
                else
                {
                    $this->error('验证码错误',U('forget'));
                }
            }
        }
        else
        {
            $this->display();
        }
    }

    /**
     * 发送手机验证码
     */
    public function sms()
    {
        $target = "http://106.ihuyi.cn/webservice/sms.php?method=Submit";

        $mobile = $_POST['mobile'];
        $send_code = $_POST['send_code'];

        $mobile_code = $this->random(4,1);
        if(empty($mobile)){
            $this->error('手机号码不能为空',U('register'));
        }

        if(empty(session('send_code')) or $send_code!=session('send_code')){
            //防止用户恶意请求
            $this->error('请求超时',U('register'));
        }

        $post_data = "account=cf_zkh101&password=4f5f44a27550cb713d4358ba3a759c6a&mobile=".$mobile."&content=".rawurlencode("您的验证码是：".$mobile_code."。请不要把验证码泄露给其他人。");
        $gets = $this->xml_to_array($this->Post($post_data, $target));
        if($gets['SubmitResult']['code']==2){
            $_SESSION['mobile'] = $mobile;
            $_SESSION['mobile_code'] = $mobile_code;
        }
        echo $gets['SubmitResult']['msg'];
    }

    private function Post($curlPost,$url){
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_NOBODY, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $curlPost);
        $return_str = curl_exec($curl);
        curl_close($curl);
        return $return_str;
    }

    private function xml_to_array($xml){
        $reg = "/<(\w+)[^>]*>([\\x00-\\xFF]*)<\\/\\1>/";
        if(preg_match_all($reg, $xml, $matches)){
            $count = count($matches[0]);
            for($i = 0; $i < $count; $i++){
                $subxml= $matches[2][$i];
                $key = $matches[1][$i];
                if(preg_match( $reg, $subxml )){
                    $arr[$key] = $this->xml_to_array( $subxml );
                }else{
                    $arr[$key] = $subxml;
                }
            }
        }
        return $arr;
    }

    /**
     * 生成随机号码
     * @param int $length
     * @param int $numeric
     * @return string
     */
    private function random($length = 6 , $numeric = 0) {
        if($numeric) {
            $hash = sprintf('%0'.$length.'d', mt_rand(0, pow(10, $length) - 1));
        } else {
            $hash = '';
            $chars = 'ABCDEFGHJKLMNPQRSTUVWXYZ23456789abcdefghjkmnpqrstuvwxyz';
            $max = strlen($chars) - 1;
            for($i = 0; $i < $length; $i++) {
                $hash .= $chars[mt_rand(0, $max)];
            }
        }
        return $hash;
    }
}