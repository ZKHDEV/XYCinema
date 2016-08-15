create database xycinema charset=utf8;

grant all privileges on xycinema.* to xy_admin identified by 'xyadmin123';
flush privileges;

-- 管理员信息表
create table xy_admin(
`a_id` int unsigned auto_increment not null,
`a_name` varchar(20) not null comment '登录名',
`a_pwd` char(32) not null comment '密码',
primary key(a_id)
)engine=myisam charset=utf8;

-- 用户信息表
create table xy_user(
`u_id` int unsigned auto_increment not null,
`u_name` varchar(20) comment '用户名',
`u_pwd` char(32) not null comment '密码',
`u_phone` char(11) not null comment '手机号',
`u_email` varchar(50) comment '邮箱',
`u_points` int unsigned not null default 0 comment '积分',
`u_delflag` tinyint not null default 0 comment '删除标记',
`u_subtime` char(19) not null comment '创建时间',
`u_modifiedon` char(19) not null comment '修改时间',
primary key(u_id)
)engine=myisam charset=utf8;

-- 电影详情表
create table xy_movie(
`m_id` int unsigned auto_increment not null,
`m_name` VARCHAR(100) not null comment '电影名',
`m_director` VARCHAR(50) not null comment '导演',
`m_star` VARCHAR(50) not null comment '主演',
`m_type` VARCHAR(20) not null comment '类型',
`m_country` VARCHAR(20) not null comment '国家',
`m_language` VARCHAR(50) not null comment '语言',
`m_version` VARCHAR(20) not null comment '版本',
`m_length` VARCHAR(20) not null comment '片长',
`m_descride` TEXT not null comment '描述',
`m_frontcover` VARCHAR(100) not null comment '封面',
`m_stage` TEXT comment '剧照',
`m_poster` VARCHAR(100) not null comment '横幅海报',
`m_advance` VARCHAR(500) comment '预告片',
`m_showdate` VARCHAR(20) not null comment '上映日期',
`m_subtime` CHAR(19) not null comment '创建时间',
`m_modifiedon` CHAR(19) not null comment '修改时间',
`m_delflag` tinyint not null DEFAULT 0 comment '删除标记',
`m_ishot` tinyint not null DEFAULT 0 comment '是否热映',
`m_remark` VARCHAR(100) comment '备注',
primary key(m_id)
)engine=myisam charset=utf8;

-- 电影剧照表
create table xy_stage(
  `s_id` int unsigned auto_increment not null,
  `s_movieid` int unsigned not null comment '电影ID',
  `s_url` VARCHAR(100) not null comment '剧照',
  `s_delflag` tinyint not null DEFAULT 0 comment '删除标记',
  primary key(s_id)
)engine=myisam charset=utf8;

-- 影院信息表
create table xy_cinema(
`c_id` int unsigned auto_increment not null,
`c_name` VARCHAR(50) not null comment '影院名',
`c_location` VARCHAR(50) not null comment '地点',
`c_subtime` CHAR(19) not null comment '创建时间',
`c_modifiedon` CHAR(19) not null comment '修改时间',
`c_delflag` tinyint not null DEFAULT 0 comment '删除标记',
primary key(c_id)
)engine=myisam charset=utf8;

-- 影厅信息表
create table xy_room(
`r_id` int unsigned auto_increment not null,
`r_name` VARCHAR(50) not null comment '影厅名',
`r_cinemaid` int unsigned not null comment '所属影院ID',
`r_seats` VARCHAR(800) not null comment '座位序列',
`r_subtime` CHAR(19) not null comment '创建时间',
`r_modifiedon` CHAR(19) not null comment '修改时间',
`r_delflag` tinyint not null DEFAULT 0 comment '删除标记',
primary key(r_id)
)engine=myisam charset=utf8;

-- 电影票信息表
create table xy_ticket(
`t_id` int unsigned auto_increment not null,
`t_price` int unsigned not null comment '单价',
`t_movieid` int unsigned not null comment '电影ID',
`t_ticketnum` int unsigned not null comment '票数',
`t_date` CHAR(10) not null comment '开场日期',
`t_time` CHAR(8) not null comment '开场时间',
`t_delflag` tinyint not null DEFAULT 0 comment '删除标记',
`t_subtime` CHAR(19) not null comment '创建时间',
`t_modifiedon` CHAR(19) not null comment '修改时间',
`t_roomid` int unsigned not null comment '影厅ID',
`t_cinemaid` int unsigned not null comment '影院ID',
`t_remark` VARCHAR(100) comment '备注',
`t_issale` tinyint not null DEFAULT 0 comment '是否在售',
`t_standard` VARCHAR(20) not null comment '制式',
`t_points` int unsigned not null default 0 comment '积分',
`t_language` VARCHAR(50) not null comment '语言',
primary key(t_id)
)engine=myisam charset=utf8;

-- 订单信息表
create table xy_order(
  `o_id` int unsigned auto_increment not null,
  `o_ticketid` int unsigned not null comment '电影票ID',
  `o_userid` int unsigned not null comment '用户ID',
  `o_seats` VARCHAR(800) not null comment '座位序列',
  `o_seatlist` VARCHAR(800) not null comment '座位号序列',
  `o_state` tinyint not null DEFAULT 0 comment '状态',
  `o_paytime` CHAR(19) comment '付款时间',
  `o_price` int unsigned not null comment '订单总价',
  `o_delflag` tinyint not null DEFAULT 0 comment '删除标记',
  `o_subtime` CHAR(19) not null comment '创建时间',
  primary key(o_id)
)engine=myisam charset=utf8;

-- 影评信息表
create table xy_comment(
  `c_id` int unsigned auto_increment not null,
  `c_userid` int unsigned not null comment '用户ID',
  `c_movieid` int unsigned not null comment '电影ID',
  `c_title` VARCHAR(50) not null comment '标题',
  `c_content` text not null comment '内容',
  `c_delflag` tinyint not null DEFAULT 0 comment '删除标记',
  `c_subtime` CHAR(19) comment '创建时间',
  primary key(c_id)
)engine=myisam charset=utf8;

-- 招聘信息表
create table xy_employ(
  `e_id` int unsigned auto_increment not null,
  `e_post` VARCHAR(50) not null comment '职位',
  `e_num` int unsigned not null comment '人数',
  `e_area` VARCHAR(50) not null comment '地区',
  `e_descride` TEXT not null comment '描述',
  `e_delflag` tinyint not null DEFAULT 0 comment '删除标记',
  `e_subtime` CHAR(19) not null comment '创建时间',
  `e_modifiedon` CHAR(19) not null comment '修改时间',
  primary key(e_id)
)engine=myisam charset=utf8;

-- 公告信息表
create table xy_notice(
  `n_id` int unsigned auto_increment not null,
  `n_content` text not null comment '公告内容',
  `n_subtime` CHAR(19) not null comment '创建时间',
  `n_modifiedon` CHAR(19) not null comment '修改时间',
  `n_delflag` tinyint not null DEFAULT 0 comment '删除标记',
  `n_isshow` tinyint not null DEFAULT 0 comment '是否显示',
  primary key(n_id)
)engine=myisam charset=utf8;

-- 想看电影表
create table xy_wantmovie(
  `w_id` int unsigned auto_increment not null,
  `w_movieid` int unsigned not null comment '电影ID',
  `w_userid` int unsigned not null comment '用户ID',
  `w_delflag` tinyint not null DEFAULT 0 comment '删除标记',
  primary key(w_id)
)engine=myisam charset=utf8;














