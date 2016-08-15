<?php

namespace Model;

class OrderModel extends BaseModel
{
    protected $_validate        =   array(
        array('o_ticketid','require','必填'),
        array('o_seats','require','请选择座位')
    );
    
    public function updatestate($o_id,$state)
    {
        $info = $this->find($o_id);
        $info['o_state']=$state;
        return $this->save($info);
    }

    public function updatepay($o_id)
    {
        $info = $this->find($o_id);
        $info['o_state']=1;
        $info['o_paytime']=date('Y-m-d H:i:s');
        return $this->save($info);
    }
}