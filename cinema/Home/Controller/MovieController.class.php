<?php

namespace Home\Controller;

class MovieController extends BaseController
{
    public function detail($m_id)
    {
        $movieinfo = $this::$movie->find($m_id);
        $stageinfo = $this::$stage->where("s_delflag=0 and s_movieid=%d",$m_id)->select();
        $commentinfo = $this::$comment->where("c_delflag=0 and c_movieid=%d",$m_id)->order("c_subtime desc")->select();

        //获取当前用户所有评论
        $mycommentinfo = array();
        foreach($commentinfo as $key=>$co)
        {
            if($co['c_userid']===session('u_id'))
            {
                $commentinfo[$key]['user'] = $this::$user->field("u_name")->find($co['c_userid'])['u_name'];
                $mycommentinfo[] = $co;
            }
        }

        if(!empty(session('u_id')))
        {
            //验证当前电影是否已添加到想看电影
            $res = $this::$wantmovie->where("w_userid=%d and w_movieid=%d and w_delflag=0",session('u_id'),$m_id)->find();
            if(!empty($res))
            {
                $this->assign('exiwant',1);
            }
        }

        //生成缩略图路径
        foreach ($stageinfo as $key=>$st)
        {
            $pos = strrpos($st['s_url'],'.');
            $stageinfo[$key]['sm_url'] = substr_replace($st['s_url'],'_sm.jpg',$pos);
        }

        $this->assign('mycomments',$mycommentinfo);
        $this->assign('comments',$commentinfo);
        $this->assign('movie',$movieinfo);
        $this->assign('stages',$stageinfo);
        $this->display();
    }

    public function comment()
    {
        if(empty($_POST['c_content']))
        {
            $this->error("评论内容不能为空");
        }

        $_POST['c_userid'] = session('u_id');
        $_POST['c_subtime'] = date("Y-m-d H:i");

        if($this::$comment->add($_POST))
        {
            $this->redirect("Home/Movie/detail/m_id/".$_POST['c_movieid']);
        }
        else
        {
            $this->error("评论失败，请重试");
        }
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

    public function wantsee()
    {
        $mov['w_movieid'] = $_POST['m_id'];
        $mov['w_userid'] = session('u_id');
        $res = $this::$wantmovie->add($mov);
        if($res)
        {
            echo 'ok';
        }
    }
    
    public function delwant($m_id)
    {
        $wantmovieinfo = $this::$wantmovie->field("w_id")->where("w_movieid=%d and w_userid=%d",$m_id,session('u_id'))->find();
        $res = $this::$wantmovie->deleteByLogical($wantmovieinfo['w_id']);
        if($res)
        {
            $this->redirect('Home/User/wantsee');
        }
        else
        {
            $this->error('删除失败');
        }
    }
}