<?php

namespace Model;

class NoticeModel extends BaseModel
{
    protected $_validate        =   array(
        array('n_content','require','必填')
    );

    public function setshow($n_id)
    {
        $info = $this->where("n_delflag=0")->select();
        foreach ($info as $item)
        {
            if($item['n_id'] == $n_id)
            {
                $item['n_isshow'] = '1';
            }
            elseif($item['n_isshow'] != 0)
            {
                $item['n_isshow'] = 0;
            }
            else
            {
                continue;
            }
            $res = $this->save($item);
            if(!$res)
            {
                return false;
            }
        }
        return true;
    }
}