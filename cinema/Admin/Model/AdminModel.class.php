<?php

namespace Admin\Model;
use Think\Model;

class AdminModel extends Model
{
    public function checkLogin($username='',$pwd='')
    {
        $admin = $this ->where("a_name='$username'")->find();
        
        if($admin)
        {
            if($admin['a_pwd'] == $pwd)
            {
                return $admin;
            }
        }
        return false;
    }

    public function checkprepwd($a_id,$p_pwd='')
    {
        $info = $this->find($a_id);
        if($info['a_pwd'] === $p_pwd)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function changepwd($a_id,$a_pwd)
    {
        $info = $this->find($a_id);
        $info['a_pwd'] = $a_pwd;
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
