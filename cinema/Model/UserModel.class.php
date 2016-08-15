<?php

namespace Model;

class UserModel extends BaseModel
{
    protected $patchValidate    =   true;

    protected $_validate        =   array(
        array('u_name','require','*必填'),
        array('u_pwd','require','*必填'),
//        array('u_pwd','/^[\A-Za-z0-9\!\#\$\%\^\&\*\.\~]{5,22}$/','密码必须至少包含 5 个字符，其中可包括以下字符: 大写字母、小写字母、数字和符号。',0,'regex'),
        array('u_phone','require','*必填'),
        array('u_phone','/^(((13[0-9]{1})|(15[0-9]{1}))+\d{8})$/','手机号码格式错误',0,'regex'),
        array('u_email','require','*必填'),
        array('u_email','email','邮箱格式错误')
    );

    public function checkPhone($phone)
    {
        if($user = $this->where("u_delflag=0 and u_phone='%s'",$phone)->find())
        {
            return $user;
        }
        else
        {
            return false;
        }
    }

    public function checkEmail($email)
    {
        if($user = $this->where("u_delflag=0 and u_email='%s'",$email)->find())
        {
            return $user;
        }
        else
        {
            return false;
        }
    }

    public function checkEmailByPhone($phone,$email)
    {
        if($user = $this->where("u_delflag=0 and u_phone='%s' and u_email='%s'",$phone,$email)->find())
        {
            return $user;
        }
        else
        {
            return false;
        }
    }

    public function checkLogin($phone,$pwd)
    {
        $user = $this ->where("u_delflag=0 and u_phone='%s'",$phone)->find();

        if($user)
        {
            if($user['u_pwd'] == $pwd)
            {
                return $user;
            }
        }
        return false;
    }

    public function checkprepwd($u_id,$o_pwd)
    {
        $info = $this->find($u_id);
        if($info['u_pwd'] === $o_pwd)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function changepwd($u_id,$u_pwd)
    {
        $info = $this->find($u_id);
        $info['u_pwd'] = $u_pwd;
        $info['u_modifiedon'] = date('Y-m-d H:i:s');
        if($res = $this->save($info))
        {
            return $res;
        }
        else
        {
            return false;
        }
    }

    public function addpoints($u_id,$points)
    {
        $info = $this->find($u_id);
        $info['u_points'] = intval($info['u_points'])+intval($points);
        $info['u_modifiedon'] = date('Y-m-d H:i:s');
        if($res = $this->save($info))
        {
            return $res;
        }
        else
        {
            return false;
        }
    }
}