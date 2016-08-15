<?php

namespace Home\Controller;

class HomeController extends BaseController
{
    public function index()
    {
        $movieinfo = $this::$movie->where("m_delflag=0")->order("m_showdate")->select();
        //即将上映电影列表
        $willmovies = array();
        foreach($movieinfo as $key=>$mo)
        {
            //验证是否已上映
            if(strtotime($mo['m_showdate'])-strtotime(date("m/d/Y"))>0)
            {
                $willmovies[] = $movieinfo[$key];
                unset($movieinfo[$key]);
            }
        }

        $this->assign('wmovierows',intval(ceil(count($willmovies)/4)));
        $this->assign('movierows',intval(ceil(count($movieinfo)/4)));
        $this->assign('movies',$movieinfo);
        $this->assign('willmovies',$willmovies);
        $this->display();
    }

    /**
     * 获取当前地点
     */
    public function getlocation()
    {
        $citys = $this::$cinema->field("c_location")->where("c_delflag=0")->distinct(true)->select();
        $ip = new \Org\Net\IpLocation('UTFWry.dat');
        $area = $ip->getlocation();
        //验证当前地点是否存在影院
        foreach($citys as $c)
        {
            $tmpparr = explode($c['c_location'],$area['country']);
            if(count($tmpparr)>1)
            {
                $location = $c['c_location'];
                break;
            }
        }
        if(!isset($location))
        {
            $location = $citys[0]['c_location'];
        }

        echo $location;
    }

    /**
     * 获取城市列表
     */
    public function getcity()
    {
        $info = $this::$cinema->field("c_location")->where("c_delflag=0")->select();
        $citys = array();
        foreach($info as $item)
        {
            $citys[] = $item["c_location"];
        }
        $citys = array_unique($citys);
        
        echo json_encode($citys);
    }

    /**
     * 根据地点获取影院列表
     */
    public function getcinema()
    {
        $location = $_POST['c_location'];
        $cinemas = $this::$cinema->field("c_id,c_name")->where("c_delflag=0 and c_location='%s'",$location)->select();
        echo json_encode($cinemas);
    }

    /**
     * 根据影院获取有票电影列表
     */
    public function getmovie()
    {
        $c_id = $_POST['c_id'];
        $ticketinfo = $this::$ticket->field("t_id,t_movieid,t_date,t_time")->where("t_delflag=0 and t_cinemaid=%d and t_issale=1",$c_id)->distinct(true)->select();
        foreach($ticketinfo as $key=>$ti)
        {
            //验证电影票是否过期
            if(strtotime($ti['t_date'].' '.$ti['t_time'])-strtotime(date("m/d/Y h:ia"))<0)
            {
                $this::$ticket->updatestate($ti['t_id'],0);
                unset($ticketinfo[$key]);
            }
        }

        //根据电影票获取电影信息
        $movies = array();
        foreach($ticketinfo as $ti)
        {
            $movies[] = $this::$movie->field("m_id,m_name")->where("m_delflag=0")->find($ti["t_movieid"]);
        }

        echo json_encode($movies);
    }

    /**
     * 根据电影、影院获取电影票列表
     */
    public function getticket()
    {
        $c_id = $_POST['c_id'];
        $m_id = $_POST['m_id'];
        $date = $_POST['date'];

        $ticketinfo = $this::$ticket->where("t_delflag=0 and t_issale=1 and t_movieid=%d and t_cinemaid=%d and t_date='%s'",$m_id,$c_id,$date)->select();
        foreach($ticketinfo as $key=>$ti)
        {
            //验证电影票是否过期
            if(strtotime($ti['t_date'].' '.$ti['t_time'])-strtotime(date("m/d/Y h:ia"))<0)
            {
                $this::$ticket->updatestate($ti['t_id'],0);
                unset($ticketinfo[$key]);
            }
        }

        echo json_encode($ticketinfo);
    }

    public function about()
    {
        $this->display();
    }

    public function join($area)
    {
        $areas = $this::$employ->field("e_area")->where("e_delflag=0")->distinct(true)->select();
        //‘1’代表默认地点
        $area = $area == '1' ? $areas[0]['e_area'] : $area;
        $employs = $this::$employ->where("e_delflag=0 and e_area='%s'",$area)->select();
        foreach ($employs as $k=>$e)
        {
            $employs[$k]['e_subtime'] = substr($employs[$k]['e_subtime'],0,10) ;
        }

        $this->assign('employs',$employs);
        $this->assign('areas',$areas);
        $this->display();
    }

    public function connect()
    {
        $this->display();
    }

    public function notice()
    {
        $content = $this::$notice->field("n_content")->where("n_delflag=0 and n_isshow=1")->find()['n_content'];
        $content = str_replace('&lt;','<',$content);
        $content = str_replace('&gt;','>',$content);
        $content = str_replace('&quot;','"',$content);

        $this->assign('content',$content);
        $this->display();
    }
}