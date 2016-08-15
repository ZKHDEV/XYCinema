<?php

namespace Admin\Controller;

class MovieController extends BaseController
{
    public function index()
    {
        $info = $this::$movie->where("m_delflag = 0")->select();
        $this->assign('info',$info);
        $this->display();
    }

    private function _savethumb($root,$target,$width,$height)
    {
        $image = new \Think\Image();
        $image->open('./Public/Upload/'.$root);
        $image->thumb($width,$height)->save('./Public/Upload/'.$target);
    }

    public function add()
    {
        if(!empty($_POST))
        {
            foreach ($_FILES as $f)
            {
                if($f['error'] === 4)
                {
                    $this->error('横幅海报和剧照不能为空');
                }
            }

            $config = array(
                'maxSize'       =>  5242880, //上传的文件大小限制 (0-不做限制)
                'exts'          =>  array('jpg','jpeg','png','gif'), //允许上传的文件后缀
                'rootPath'      =>  './Public/Upload/', //保存根路径
                'savePath'      =>  'img/', //保存路径
            );
            $upload = new \Think\Upload($config);
            $info = $upload->upload();

            if(!$info)
            {
                $this->error($upload->getError());
            }

            $_POST['m_poster'] = $info['m_poster']['savepath'].$info['m_poster']['savename'];
            $pos1 = strrpos($_POST['m_poster'],'.');
            $thuposter = substr_replace($_POST['m_poster'],'_sm.jpg',$pos1);

            $rootfront = $info['m_frontcover']['savepath'].$info['m_frontcover']['savename'];
            $_POST['m_frontcover'] = $info['m_frontcover']['savepath'].'th_'.$info['m_frontcover']['savename'];
            $pos2 = strrpos($_POST['m_frontcover'],'.');
            $_POST['m_frontcover'] = substr_replace($_POST['m_frontcover'],'.jpg',$pos2);

            //保存缩略图
            $this->_savethumb($rootfront,$_POST['m_frontcover'],250,370);
            $this->_savethumb($_POST['m_poster'],$thuposter,450,200);

            $_POST['m_subtime'] = date('Y-m-d H:i:s');
            $_POST['m_modifiedon'] = date('Y-m-d H:i:s');

            $res = $this::$movie->create();
            if($res)
            {
                if($this::$movie->add($res))
                {
                    $this->success('添加成功',U('index'));
                }
                else
                {
                    $this->error('添加失败，请重试');
                }
            }
            else
            {
                $this->assign('error',$this::$movie->getError());
                $this->display();
            }
        }
        else
        {
            $this->display();
        }
    }

    public function update($m_id)
    {
        if(!empty($_POST))
        {
            foreach ($_FILES as $f)
            {
                if($f['error'] !== 4)
                {
                    $config = array(
                        'maxSize'       =>  5242880, //上传的文件大小限制 (0-不做限制)
                        'exts'          =>  array('jpg','jpeg','png','gif'), //允许上传的文件后缀
                        'rootPath'      =>  './Public/Upload/', //保存根路径
                        'savePath'      =>  'img/' //保存路径
                    );
                    $upload = new \Think\Upload($config);
                    $uploadinfo = $upload->upload();

                    if(!$uploadinfo)
                    {
                        $this->error($upload->getError());
                    }

                    $changefiles = array_keys($uploadinfo);
                    foreach ($changefiles as $c)
                    {
                        if($c==='frontcover')
                        {
                            $rootfront = $uploadinfo[$c]['savepath'].$uploadinfo[$c]['savename'];
                            $_POST['m_'.$c] = $uploadinfo[$c]['savepath'].'th_'.$uploadinfo[$c]['savename'];
                            $pos1 = strrpos($_POST['m_'.$c],'.');
                            $_POST['m_'.$c] = substr_replace($_POST['m_'.$c],'.jpg',$pos1);
                            
                            $this->_savethumb($rootfront,$_POST['m_'.$c],250,370);
                        }
                        else
                        {
                            $_POST['m_'.$c] = $uploadinfo[$c]['savepath'].$uploadinfo[$c]['savename'];
                            $pos2 = strrpos($_POST['m_'.$c],'.');
                            $thuposter = substr_replace($_POST['m_'.$c],'_sm.jpg',$pos2);
                            $this->_savethumb($_POST['m_'.$c],$thuposter,450,200);
                        }
                    }
                    break;
                }
            }

            $_POST['m_modifiedon'] = date('Y-m-d H:i:s');

            $res = $this::$movie->create();
            if($res)
            {
                if($this::$movie->save($res))
                {
                    $this->success('修改成功',U('index'));
                }
                else
                {
                    $this->error('修改失败，请重试');
                }
            }
            else
            {
                $this->assign('error',$this::$movie->getError());
                $this->display();
            }
        }
        else
        {
            $info = $this::$movie->find($m_id);
            $pos = strrpos($info['m_poster'],'.');
            $info['sm_poster'] = substr_replace($info['m_poster'],'_sm.jpg',$pos);
            
            $this->assign('movie',$info);
            $this->display();
        }
    }
    
    public function delete($m_id)
    {
        $res = $this::$movie->deleteByLogical($m_id);
        if($res)
        {
            $this->success('删除成功');
        }
        else
        {
            $this->error('删除失败');
        }
    }

    public function detail($m_id)
    {
        $info = $this::$movie->find($m_id);

        $pos = strrpos($info['m_poster'],'.');
        $info['sm_poster'] = substr_replace($info['m_poster'],'_sm.jpg',$pos);

        $this->assign('movie',$info);
        $this->display();
    }

    public function stage($m_id)
    {
        if(!empty($_FILES))
        {
            if($_FILES['stage']['error'] !== 4)
            {
                $config = array(
                    'maxSize'       =>  5242880, //上传的文件大小限制 (0-不做限制)
                    'exts'          =>  array('jpg','jpeg','png','gif'), //允许上传的文件后缀
                    'rootPath'      =>  './Public/Upload/', //保存根路径
                    'savePath'      =>  'img/' //保存路径
                );
                $upload = new \Think\Upload($config);
                $info = $upload->upload();
                if(!$info)
                {
                    $this->error($upload->getError());
                }

                $res['s_movieid'] = $m_id;
                $res['s_url'] = $info['stage']['savepath'].$info['stage']['savename'];

                $pos = strrpos($res['s_url'],'.');
                $thustage = substr_replace($res['s_url'],'_sm.jpg',$pos);
                $this->_savethumb($res['s_url'],$thustage,292,194);

                if($this::$stage->add($res))
                {
                    $this->success('添加成功');
                }
                else
                {
                    $this->error('添加失败，请重试');
                }
            }
        }
        else
        {
            $movie = $this::$movie->field("m_name")->find($m_id)['m_name'];
            $stageinfo = $this::$stage->where("s_delflag=0 and s_movieid=%d",$m_id)->select();
            foreach ($stageinfo as $key=>$st)
            {
                $pos = strrpos($st['s_url'],'.');
                $stageinfo[$key]['sm_url'] = substr_replace($st['s_url'],'_sm.jpg',$pos);
            }

            $stagerows = ceil(count($stageinfo)/4);

            $this->assign('stagerows',$stagerows);
            $this->assign('movie',$movie);
            $this->assign('stage',$stageinfo);
            $this->display();
        }
    }

    public function delstage($s_id)
    {
        $res = $this::$stage->deleteByLogical($s_id);
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