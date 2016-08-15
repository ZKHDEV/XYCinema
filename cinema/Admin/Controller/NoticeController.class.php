<?php

namespace Admin\Controller;

class NoticeController extends BaseController
{
    public function index()
    {
        $info = $this::$notice->where("n_delflag = 0")->select();

        $this->assign('info',$info);
        $this->display();
    }

    public function add()
    {
        if(!empty($_POST))
        {
            $_POST['n_subtime'] = date('Y-m-d H:i:s');
            $_POST['n_modifiedon'] = date('Y-m-d H:i:s');

            $res = $this::$notice->create();
            if($res)
            {
                if($this::$notice->add($_POST))
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
                $this->assign('error',$this::$notice->getError());
                $this->display();
            }
        }
        else
        {
            $this->display();
        }
    }

    public function update($n_id)
    {
        if(!empty($_POST))
        {
            $_POST['n_modifiedon'] = date('Y-m-d H:i:s');
            $res = $this::$notice->create();
            if($res)
            {

                if($this::$notice->save($res))
                {
                    return $this->success('修改成功',U("index"));
                }
                else
                {
                    return $this->error('修改失败，请重试');
                }

            }
            else
            {
                $this->assign('error',$this::$notice->getError());
                $this->display();
            }
        }
        else
        {
            $info = $this::$notice->find($n_id);

            $this->assign('notice',$info);
            $this->display();
        }
    }

    public function detail($n_id)
    {
        $info = $this::$notice->find($n_id);
        $info['n_content'] = str_replace('&lt;','<',$info['n_content']);
        $info['n_content'] = str_replace('&gt;','>',$info['n_content']);
        $info['n_content'] = str_replace('&quot;','"',$info['n_content']);

        $this->assign('notice',$info);
        $this->display();
    }

    public function delete($n_id)
    {
        $res = $this::$notice->deleteByLogical($n_id);
        if($res)
        {
            $this->success('删除成功');
        }
        else
        {
            $this->error('删除失败');
        }
    }

    public function setshow()
    {
        $n_id = $_POST['n_id'];
        $res = $this::$notice->setshow($n_id);
        if($res)
        {
            echo "ok";
        }
        else
        {
            echo "no";
        }
    }
}