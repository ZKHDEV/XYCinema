<?php

namespace Home\Controller;

class OrderController extends BaseController
{
    public function seat($t_id)
    {
        $ticketinfo = $this::$ticket->find($t_id);
        $movieinfo = $this::$movie->find($ticketinfo['t_movieid']);
        $roominfo = $this::$room->find($ticketinfo['t_roomid']);
        $ticketinfo['movie'] = $movieinfo['m_name'];
        $ticketinfo['cinema'] = $this::$cinema->field("c_name")->find($ticketinfo['t_cinemaid'])['c_name'];
        $ticketinfo['room'] = $this::$room->field("r_name")->find($ticketinfo['t_roomid'])['r_name'];

        //计算最小行号和列号
        $seats = explode(',',$roominfo['r_seats']);
        $minrow = intval(floor((intval($seats[0])+14)/14));
        $mincol = (intval($seats[0])+14)%14;
        foreach ($seats as $se)
        {
            $row = intval(floor((intval($se)+14)/14));
            $col = (intval($se)+14)%14;
            $minrow=$row<$minrow?$row:$minrow;
            $mincol=$col<$mincol?$col:$mincol;
        }

        $roominfo['seats'] = $seats;
        //获取总票数
        $roominfo['totalcount'] = count($seats);

        //获取已售座位
        $disseatarr=array();
        $orderinfo = $this::$order->where("o_delflag=0 and o_state<2 and o_ticketid=%d",$t_id)->select();
        foreach($orderinfo as $or)
        {
            //验证订单是否超时，更新订单状态
            if(intval($or['o_state'])===0 && strtotime(date('Y-m-d H:i:s')) - strtotime($or['o_subtime']) > 15*60)
            {
                $this::$order->updatestate($or['o_id'],3);
            }
            else
            {
                $disseatarr[] = $or['o_seats'];
            }
        }
        $disseat = implode($disseatarr,',');
        $disseatarr = explode(',',$disseat);
        $roominfo['discount'] = empty($disseat) ? 0:count($disseatarr);
        $roominfo['disseatarr'] = $disseatarr;

        $this->assign('minrow',$minrow);
        $this->assign('mincol',$mincol);
        $this->assign('room',$roominfo);
        $this->assign('movie',$movieinfo);
        $this->assign('ticket',$ticketinfo);
        
        $this->display();
    }

    public function submitorder()
    {
        if(empty($_POST['o_seatlist'])||empty($_POST['o_seats']))
        {
            $this->error("请选择座位");
        }
        else
        {
            $_POST['o_userid']=session('u_id');
            $_POST['o_subtime']=date('Y-m-d H:i:s');
            $_POST['o_seatlist'] = rtrim($_POST['o_seatlist'],';');
            
            //获取总价
            $seatarr = explode(';',$_POST['o_seatlist']);
            $ticketcount = count($seatarr);
            $_POST['o_price'] = $ticketcount*floatval($_POST['price']);
            
            if($res = $this::$order->add($_POST))
            {
                $this->redirect("Home/Order/pay/o_id/$res");
            }
            else
            {
                $this->error('订单提交失败，请重试');
            }
        }
    }

    public function pay($o_id)
    {
        if(empty($_POST))
        {
            $orderinfo = $this::$order->find($o_id);
            //验证订单合法性
            if($orderinfo['o_userid']!==session('u_id'))
            {
                $this->display('./404.html');
                exit;
            }
            elseif($orderinfo['o_state']==='1')
            {
                //订单已完成
                $this->error("订单已完成",U("Home/Home/index"));
            }
            elseif($orderinfo['o_state']==='2'||$orderinfo['o_state']==='3'||$orderinfo['o_delflag']==='1')
            {
                //订单为取消、超时或删除状态
                $this->error("订单无效",U("Home/Home/index"));
            }
            elseif(strtotime(date('Y-m-d H:i:s')) - strtotime($orderinfo['o_subtime']) > 15*60)
            {
                //订单超时，更新状态
                $this::$order->updatestate($o_id,3);
                $this->error("订单超时",U("Home/Home/index"));
            }

            //获取订单详情
            $ticketinfo = $this::$ticket->find($orderinfo['o_ticketid']);
            $movieinfo = $this::$movie->field("m_name")->find($ticketinfo['t_movieid']);
            $roominfo = $this::$room->field("r_name")->find($ticketinfo['t_roomid']);
            $cinemainfo = $this::$cinema->field("c_name")->find($ticketinfo['t_cinemaid']);

            $orderinfo['movie'] = $movieinfo['m_name'];
            $orderinfo['standard'] = $ticketinfo['t_standard'];
            $orderinfo['cinema'] = $cinemainfo['c_name'];
            $orderinfo['room'] = $roominfo['r_name'];
            $orderinfo['language'] = $ticketinfo['t_language'];
            $orderinfo['price'] = $ticketinfo['t_price'];
            $orderinfo['date'] = $ticketinfo['t_date'];
            $orderinfo['time'] = $ticketinfo['t_time'];
            $orderinfo['o_seatlist'] = rtrim($orderinfo['o_seatlist'],';');

            //计算票数
            $seatarr = explode(';',$orderinfo['o_seatlist']);
            $orderinfo['ticketnum'] = count($seatarr);

            //计算订单总积分
            $orderinfo['points'] = intval($ticketinfo['t_points'])*$orderinfo['ticketnum'];

            $this->assign('order',$orderinfo);
            $this->display();
        }
        else
        {
            //TODO:完成支付


            //付款后更新订单状态和用户总积分
            $orderinfo = $this::$order->find($o_id);
            $ticketinfo = $this::$ticket->find($orderinfo['o_ticketid']);

            $seatarr = explode(';',$orderinfo['o_seatlist']);
            $ticketnum = count($seatarr);
            $points = intval($ticketinfo['t_points'])*$ticketnum;

            $this::$order->updatepay($o_id,$points);
            $this::$user->addpoints(session('u_id'),$points);

            $this->success("付款成功,订单完成",U("Home/Home/index"));
        }
    }

    public function ticket($m_id)
    {
        $ticketinfo = $this::$ticket->field("t_cinemaid,t_date,t_time")->where("t_delflag=0 and t_issale=1 and t_movieid=%d",$m_id)->select();

        $citys = array();
        foreach($ticketinfo as $ti)
        {
            if(strtotime($ti['t_date'].' '.$ti['t_time'])-strtotime(date("m/d/Y h:ia"))<0)
            {
                $this::$ticket->updatestate($ti['t_id'],0);
                continue;
            }
            $citys[] = $this::$cinema->field("c_location")->find($ti['t_cinemaid'])['c_location'];
        }
        $citys = array_unique($citys);

        $mname = $this::$movie->field("m_name")->find($m_id)['m_name'];

        $this->assign('mid',$m_id);
        $this->assign('mname',$mname);
        $this->assign('citys',$citys);
        $this->display();
    }

    public function getticket($c_location,$m_id)
    {
        $cinemainfo = $this::$cinema->field("c_id")->where("c_delflag=0 and c_location='%s'",$c_location)->distinct(true)->select();
        $cids = array();
        foreach($cinemainfo as $ci)
        {
            $cids[] = $ci['c_id'];
        }

        $cidstr=implode(',',$cids);

        $ticketinfo = $this::$ticket->where("t_delflag=0 and t_issale=1 and t_movieid=%d and t_cinemaid in (%s)",$m_id,$cidstr)->order("t_date")->select();

        foreach($ticketinfo as $key=>$ti)
        {
            $ticketinfo[$key]['cinema'] = $this::$cinema->field("c_name")->find($ticketinfo[$key]['t_cinemaid'])['c_name'];
        }

        echo json_encode($ticketinfo);
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

    public function cancel($o_id)
    {
        $res = $this::$order->updatestate($o_id,2);
        if($res)
        {
            $this->success('成功取消订单');
        }
        else
        {
            $this->error('取消订单失败');
        }
    }
}