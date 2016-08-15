<?php

namespace Admin\Controller;

class TicketController extends BaseController
{
    public function index()
    {
        $info = $this::$ticket->where("t_delflag = 0")->select();
        foreach ($info as $key => $ticket)
        {
            if(strtotime($ticket['t_date'].' '.$ticket['t_time'])-strtotime(date("m/d/Y h:ia"))<0)
            {
                $this::$ticket->updatestate($ticket['t_id'],0);
                $info[$key]['t_issale']=0;
            }
            $res = $this::$room->field('r_cinemaid,r_name')->find($ticket['t_roomid']);
            $info[$key]['room'] = $res['r_name'];
            $info[$key]['cinema'] = $this::$cinema->field('c_name')->where("c_id=%d",$res['r_cinemaid'])->find()['c_name'];

            $res2 = $this::$order->where("o_ticketid=%d and o_state=1",$ticket['t_id'])->select();

            $ticketnum=0;
            foreach($res2 as $key=>$re)
            {
                $seatarr = explode(';',$re['o_seatlist']);
                $ticketnum += count($seatarr);
            }

            $info[$key]['remain'] = intval($info[$key]['t_ticketnum']) - $ticketnum;

            $res3 = $this::$movie->field('m_name')->where("m_id = %d",$ticket['t_movieid'])->find();
            $info[$key]['movie'] = $res3['m_name'];
        }

        $this->assign('info',$info);
        $this->display();
    }

    public function add()
    {
        if(!empty($_POST))
        {
            $_POST['t_subtime'] = date('Y-m-d H:i:s');
            $_POST['t_modifiedon'] = date('Y-m-d H:i:s');
            $res = $this::$ticket->create();
            if($res)
            {
                if($this::$ticket->add($_POST))
                {
                    return $this->success('添加成功',U("index"));
                }
                else
                {
                    return $this->error('添加失败，请重试');
                }
            }
            else
            {
                $this->assign('error',$this::$ticket->getError());
                $this->display();
            }
        }
        else
        {
            $movies = $this::$movie->field("m_id,m_name")->where("m_delflag=0")->select();
            $cinemas = $this::$cinema->field("c_id,c_name")->where("c_delflag=0")->select();

            $this->assign('movies',$movies);
            $this->assign('cinemas',$cinemas);

            $this->display();
        }
    }

    public function getroom()
    {
        $c_id = $_POST['c_id'];
        $res = $this::$room->field("r_id,r_name")->where("r_delflag=0 and r_cinemaid=%d",$c_id)->select();
        echo json_encode($res);
    }

    public function update($t_id)
    {
        if(!empty($_POST))
        {
            $_POST['t_modifiedon'] = date('Y-m-d H:i:s');
            $res = $this::$ticket->create();
            if($res)
            {

                if($this::$ticket->save($res))
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
                $this->assign('error',$this::$ticket->getError());
                $this->display();
            }
        }
        else
        {
            $rooms = $this::$room->field("r_id,r_name,r_cinemaid")->where("r_delflag=0")->select();
            $movies = $this::$movie->field("m_id,m_name")->where("m_delflag=0")->select();
            $cinemas = $this::$cinema->field("c_id,c_name")->where("c_delflag=0")->select();
            $currentticket = $this::$ticket->find($t_id);

            $this->assign('rooms',$rooms);
            $this->assign('movies',$movies);
            $this->assign('cinemas',$cinemas);
            $this->assign('ticket',$currentticket);

            $this->display();
        }
    }

    public function delete($t_id)
    {
        $res = $this::$ticket->deleteByLogical($t_id);
        if($res)
        {
            $this->success('删除成功');
        }
        else
        {
            $this->error('删除失败');
        }
    }

    public function detail($t_id)
    {
        $info = $this::$ticket->find($t_id);
        $res = $this::$room->field('r_cinemaid,r_name')->where("r_id=%d",$info['t_roomid'])->find();
        $info['room'] = $res['r_name'];
        $res2 = $this::$cinema->field('c_name')->where("c_id=%d",$info['t_cinemaid'])->find();
        $info['cinema'] = $res2['c_name'];
        $res3 = $this::$order->where("o_ticketid=%d and o_state=2",$info['t_id'])->select();
        $info['remain'] = intval($info['t_ticketnum']) - count($res3);
        $res4 = $this::$movie->field('m_name')->where("m_id = %d",$info['t_movieid'])->find();
        $info['movie'] = $res4['m_name'];

        $this->assign('ticket',$info);
        $this->display();
    }
}