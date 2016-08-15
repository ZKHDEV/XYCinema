<?php

namespace Model;

class EmployModel extends BaseModel
{
    protected $_validate        =   array(
        array('e_post','require','必填'),
        array('e_num','require','必填'),
        array('e_area','require','必填'),
        array('e_descride','require','必填')
    );
}