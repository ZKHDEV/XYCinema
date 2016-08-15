<?php

namespace Admin\Controller;

class CinemaController extends BaseController
{
    public function index()
    {
        $info = $this::$cinema->where("c_delflag = 0")->select();
        $this->assign('info',$info);
        $this->display();
    }

    public function add()
    {
        if(!empty($_POST))
        {
            $_POST['c_subtime'] = date('Y-m-d H:i:s');
            $_POST['c_modifiedon'] = date('Y-m-d H:i:s');

            $res = $this::$cinema->create();
            if($res)
            {
                if($this::$cinema->add($_POST))
                {
                    $this->success('添加成功',U('index'));
                }
                else
                {
                    $this->error('添加失败，请重试');
                }
            }
            else
            {
                $this->assign('error',$this::$cinema->getError());
                $this->display();
            }
        }
        else
        {
            $this->display();
        }
    }
    
    public function update($c_id)
    {
        if(!empty($_POST))
        {
            $_POST['c_modifiedon'] = date('Y-m-d H:i:s');
            $res = $this::$cinema->create();
            if($res)
            {
                if($this::$cinema->save($res))
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
                $this->assign('error',$this::$cinema->getError());
                $this->display();
            }
        }
        else
        {
            $info = $this::$cinema->find($c_id);
            $this->assign('cinema',$info);
            $this->display();
        }
    }

    public function delete($c_id)
    {
        $res = $this::$cinema->deleteByLogical($c_id);
        if($res)
        {
            $this->success('删除成功');
        }
        else
        {
            $this->error('删除失败');
        }
    }

    public function room($c_id)
    {
        $info = $this::$room->where("r_cinemaid=%d and r_delflag=0",$c_id)->select();

        foreach ($info as $key => $item)
        {
            $count = count(explode(',',$item['r_seats']))-1;
            $info[$key]['r_count'] = $count;
        }
        $this->assign('c_id',$c_id);
        $this->assign('info',$info);
        $this->display();
    }

    public function addroom($c_id)
    {
        if(!empty($_POST))
        {
            $_POST['r_subtime'] = date('Y-m-d H:i:s');
            $_POST['r_modifiedon'] = date('Y-m-d H:i:s');
            $res = $this::$room->create();
            if($res)
            {
                if($this::$room->add($_POST))
                {
                    $this->success('添加成功',U("Admin/cinema/room/c_id/$c_id"));
                }
                else
                {
                    $this->error('添加失败，请重试');
                }
            }
            else
            {
                $this->assign('error',$this::$room->getError());
                $this->display();
            }
        }
        else
        {
            $this->assign('c_id',$c_id);
            $this->display();
        }
    }
    
    public function ediroom($c_id,$r_id)
    {
        if(!empty($_POST))
        {
            $_POST['r_modifiedon'] = date('Y-m-d H:i:s');
            $res = $this::$room->create();
            if($res)
            {
                if($this::$room->save($res))
                {
                    $this->success('修改成功',U("Admin/cinema/room/c_id/$c_id"));
                }
                else
                {
                    $this->error('修改失败，请重试');
                }
            }
            else
            {
                $this->assign('error',$this::$room->getError());
                $this->display();
            }
        }
        else
        {
            $info = $this::$room->find($r_id);

            $seats = explode(',',$info['r_seats']);
            $info['seats'] = $seats;
            $count = count($seats)-1;
            $info['r_count'] = $count;

            $this->assign('room',$info);
            $this->assign('c_id',$c_id);
            $this->display();
        }
    }
    
    public function showroom($c_id,$r_id)
    {
        $info = $this::$room->find($r_id);

        $seats = explode(',',$info['r_seats']);
        $info['seats'] = $seats;
        $count = count($seats)-1;
        $info['r_count'] = $count;

        $this->assign('room',$info);
        $this->assign('c_id',$c_id);
        $this->display();
    }

    public function delroom($r_id)
    {
        $res = $this::$room->deleteByLogical($r_id);
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