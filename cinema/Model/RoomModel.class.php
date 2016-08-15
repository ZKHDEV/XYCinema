<?php
/**
 * Created by PhpStorm.
 * User: ZKH
 * Date: 2016-07-14
 * Time: 00:08
 */

namespace Model;

class RoomModel extends BaseModel
{
    protected $_validate        =   array(
        array('r_name','require','必填'),
        array('r_seats','require','请选择座位')
    );
}