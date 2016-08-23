<?php

namespace Model;

class WantmovieModel extends BaseModel
{
    public function deletewant($m_id,$u_id)
    {
        $info = $this->where("w_delflag=0 and w_movieid=%d and w_userid=%d",$m_id,$u_id)->find();
        if(!empty($info))
        {
            // var_dump($info);
            // exit;
            $res = $this->deleteByLogical($info["w_id"]);
            if($res)
            {
                return $res;
            }
        }
        return false;
    }
}