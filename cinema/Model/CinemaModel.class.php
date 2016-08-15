<?php

namespace Model;

class CinemaModel extends BaseModel
{
    protected $_validate        =   array(
        array('c_name','require','必填'),
        array('c_location','require','必填')
    );
}