<?php

namespace Admin\Controller;

class CommentController extends BaseController
{
    public function index()
    {
        $info = $this::$comment->where("c_delflag = 0")->select();
        foreach ($info as $k=>$o)
        {
            $info[$k]['user'] = $this::$user->field('u_phone')->find($info[$k]['c_userid'])['u_phone'];
            $info[$k]['movie'] = $this::$movie->field('m_name')->find($info[$k]['c_movieid'])['m_name'];
            $info[$k]['content'] = substr($info[$k]['c_content'],0,36)."...";
        }

        $this->assign('info',$info);
        $this->display();
    }

    public function detail($c_id)
    {
        $info = $this::$comment->find($c_id);
        $info['user'] = $this::$user->field('u_phone')->find($info['c_userid'])['u_phone'];
        $info['movie'] = $this::$movie->field('m_name')->find($info['c_movieid'])['m_name'];

        $this->assign('comment',$info);
        $this->display();
    }

    public function delete($c_id)
    {
        $res = $this::$comment->deleteByLogical($c_id);
        if($res)
        {
            $this->success('删除成功');
        }
        else
        {
            $this->error('删除失败');
        }
    }
}