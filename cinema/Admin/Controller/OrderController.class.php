<?php

namespace Admin\Controller;

class OrderController extends BaseController
{
    public function index()
    {
        $info = $this::$order->where("o_delflag = 0")->select();
        foreach ($info as $k=>$o)
        {
            $info[$k]['user'] = $this::$user->field('u_phone')->find($info[$k]['o_userid'])['u_phone'];

            $seatnum = count(explode(',',$info[$k]['o_seats']));
            $ticketprice = $this::$ticket->field('t_price')->find($info[$k]['o_ticketid'])['t_price'];

            $info[$k]['ticketnum'] = $seatnum;
            $info[$k]['price'] = intval($seatnum)*intval($ticketprice);
        }

        $this->assign('info',$info);
        $this->display();
    }

    public function delete($o_id)
    {
        $res = $this::$order->deleteByLogical($o_id);
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