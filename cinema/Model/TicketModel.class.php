<?php

namespace Model;

class TicketModel extends BaseModel
{
    protected $_validate        =   array(
        array('t_movieid','require','请选择一项'),
        array('t_price','require','必填'),
        array('t_ticketnum','require','必填'),
        array('t_points','require','必填'),
        array('t_date','require','必填'),
        array('t_time','require','必填'),
        array('t_roomid','require','请选择一项'),
        array('t_cinemaid','require','请选择一项'),
        array('t_standard','require','必填'),
        array('t_language','require','必填')
    );

    public function updatestate($t_id,$state)
    {
        $info = $this->find($t_id);
        $info['t_issale']=$state;
        return $this->save($info);
    }
}