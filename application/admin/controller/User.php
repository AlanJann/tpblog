<?php

namespace app\admin\controller;

use think\Controller;

class User extends Base
{
    //会员列表
    public function list()
    {
        $users = model('User')->order('create_time', 'desc')->paginate(10);
        $viewDate = [
            'users' => $users
        ];
        $this->assign($viewDate);
        return view();
    }


    // 会员添加
    public function add()
    {
        if(request()->isAjax()) {
            $data = [
                'username' => input('post.username'),
                'password' => input('post.userpwd'),
                'nickname' => input('post.usernick'),
                'email' => input('post.useremail')
            ];
            $result = model('User')->add($data);
            if ($result == 1) {
                $this->success('添加会员成功','admin/user/list');
            } else {
                $this->error($result);
            }
        }
        return view();
    }

    // 会员编辑
    public function edit()
    {
        if (request()->isAjax()) {
            $data = [
                'id' => input('post.id'),
                'username' => input('post.username'),
                'password' => input('post.userpwd'),
                'nickname' => input('post.usernick'),
                'email' => input('post.useremail',)
            ];
            $result = model('User')->edit($data);
            if ($result == 1) {
                $this->success('修改成功','admin/user/list');
            } else {
                $this->error($result);
            }
        }
        $userInfo = model('User')->find(input('id'));
        $viewData = [
            'userInfo' => $userInfo
        ];
        $this->assign($viewData);
        return view();
        
    }

    // 会员删除
    public function del()
    {
        $user = model('User')->with('comments')->find(input('id'));
        $result = $user->together('comments')->delete();
        if ($result) {
            $this->success('删除成功','admin/user/list');
        } else {
            $this->error('删除失败');
        }
    }
}
