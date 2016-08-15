<?php
namespace Admin\Controller;

class UserController extends BaseController
{
    public function index()
    {
        $info = $this::$user->where("u_delflag = 0")->select();
        $this -> assign('info',$info);
        $this -> display();
    }

    public function delete($u_id)
    {
        $res = $this::$user->deleteByLogical($u_id);
        if($res)
        {
            $this->success('删除成功');
        }
        else
        {
            $this->error('删除失败');
        }
    }
}