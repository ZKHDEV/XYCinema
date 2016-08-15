<?php

namespace Admin\Controller;

class EmployController extends BaseController
{
    public function index()
    {
        $info = $this::$employ->where("e_delflag = 0")->select();

        $this->assign('info',$info);
        $this->display();
    }

    public function add()
    {
        if(!empty($_POST))
        {
            $_POST['e_subtime'] = date('Y-m-d H:i:s');
            $_POST['e_modifiedon'] = date('Y-m-d H:i:s');

            $res = $this::$employ->create();
            if($res)
            {
                if($this::$employ->add($_POST))
                {
                    return $this->success('添加成功',U('index'));
                }
                else
                {
                    return $this->error('添加失败，请重试');
                }
            }
            else
            {
                $this->assign('error',$this::$employ->getError());
                $this->display();
            }
        }
        else
        {
            $this->display();
        }
    }

    public function delete($e_id)
    {
        $res = $this::$employ->deleteByLogical($e_id);
        if($res)
        {
            $this->success('删除成功');
        }
        else
        {
            $this->error('删除失败');
        }
    }

    public function update($e_id)
    {
        if(!empty($_POST))
        {
            $_POST['e_modifiedon'] = date('Y-m-d H:i:s');

            $res = $this::$employ->create();
            if($res)
            {
                if($this::$employ->save($res))
                {
                    $this->success('修改成功',U('index'));
                }
                else
                {
                    $this->error('修改失败，请重试');
                }
            }
            else
            {
                $this->assign('error',$this::$employ->getError());
                $this->display();
            }
        }
        else
        {
            $info = $this::$employ->find($e_id);

            $this->assign('employ',$info);
            $this->display();
        }
    }

    public function detail($e_id)
    {
        $info = $this::$employ->find($e_id);

        $this->assign('employ',$info);
        $this->display();
    }
}