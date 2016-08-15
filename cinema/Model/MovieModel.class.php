<?php

namespace Model;

class MovieModel extends BaseModel
{
    protected $_validate        =   array(
        array('m_name','require','必填'),
        array('m_director','require','必填'),
        array('m_star','require','必填'),
        array('m_type','require','必填'),
        array('m_country','require','必填'),
        array('m_language','require','必填'),
        array('m_version','require','必填'),
        array('m_showdate','require','必填'),
        array('m_length','require','必填'),
        array('m_descride','require','必填'),
        array('m_frontcover','require','必填'),
        array('m_poster','require','必填')
    );
}