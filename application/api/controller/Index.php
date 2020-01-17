<?php

namespace app\api\controller;

use think\Controller;

class Index extends Base
{
    // 首页
    public function index()
    {
        $where = [];
        $catename = null;
        if (input('?id')) {
            $where = [
                'cate_id' => input('id')
            ];
            $catename = model('Cate')->where('id',input('id'))->value('catename');
        }
        $cates = model('Cate')->order('sort','asc')->select();
        $webInfo = model('Config')->find();
        $top = model('Article')->where(['is_top' => 1])->order('create_time','desc')->limit(10)->select();
        $articles = model('Article')->where($where)->order('create_time','desc')->paginate(5);
        $viewData = [
            'cates' => $cates,
            'webinfo' => $webInfo,
            'articles' => $articles,
            'catename' => $catename,
            'top' => $top,
        ];
        $this->assign($viewData);
        return view();
    }

    // 用户注册
    public function register()
    {
        if(request()->isAjax()) {
            $data = [
                'username' => input('post.username'),
                'password' => input('post.password'),
                'repassword' => input('post.repassword'),
                'nickname' => input('post.nickname'),
                'email' => input('post.email'),
            ];
            $result = model('User')->register($data);
            if ($result == 1) {
                $this->success('注册成功','api/index/login');
            } else {
                $this->error($result);
            }
        }
 
        return view();
    }

    // 用户登录
    public function login()
    {
        if(request()->isAjax()) {
            $data = [
                'username' =>input('post.username'),
                'password' =>input('post.password')
            ];
            $result = model('User')->login($data);
            if ($result == 1) {
                $this->success('登录成功','api/index/index');
            } else {
                $this->error($result);
            }
        }

        return view();
    }

    // 用户退出
    public function loginout()
    {
        session(null);
        if (session('?user.id')) {
            $this->error('退出失败');
        } else {
            $this->success('退出成功!','api/index/index');
        }
    }

    // 用户评论
    public function usermsg()
    {
        $data = [
            'user_id' => input('post.user_id'),
            'article_id' => input('post.article_id'),
            'content' => input('post.content'),
        ];
        // 如果没有登录的话，不让评论
        if (!session('?user.id')) {
            $this->error('请先登录！');
            return;
        }
        

        $result = model('Comment')->usermsg($data);
        if ($result == 1) {
            $this->success('评论成功');
        } else {
            $this->error($result);
        }
    }


}
