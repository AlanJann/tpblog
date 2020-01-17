<?php

namespace app\admin\controller;

use think\Controller;

class Admin extends Base
{
    // 管理员列表
    public function list()
    {
        $admins = model('Admin')->order(['is_super' => 'desc', 'status' => 'desc'])->paginate(10);
        $viewData = [
            'admins' => $admins
        ];
        $this->assign($viewData);
        return view();
    }

    // 管理员添加
    public function add()
    {
        if (request()->isAjax()) {
            $data = [
                'username' => input('post.username'),
                'password' => input('post.password'),
                'repassword' => input('post.repassword'),
                'nickname' => input('post.nickname'),
                'email' => input('post.email'),
                'status' => input('post.status', 0),
                'is_super' => input('post.is_super', 0),
            ];
            $result = model('Admin')->add($data);
            if ($result == 1) {
                $this->success('添加成功','admin/admin/list');
            } else {
                $this->error($result);
            }
        }
        return view();
    }

    // 管理员状态
    public function status()
    {
        $data = [
            'id' => input('post.id'),
            'status' => input('post.status') ? 0 : 1,
        ];
        $result = model('Admin')->status($data);
        if($result == 1) {
            $this->success('设置成功','admin/admin/list');
        } else {
            $this->error('设置失败');
        }
    }

    // 超级管理员
    public function issuper()
    {
        $data = [
            'id' => input('post.id'),
            'is_super' => input('post.is_super') ? 0 : 1,
        ];
        $result = model('Admin')->issuper($data);
        if($result == 1) {
            $this->success('设置成功','admin/admin/list');
        } else {
            $this->error('设置失败');
        }
    }

    // 管理员编辑
    public function edit()
    {

      if (request()->isAjax()) {
        $data = [
          'id' => input('post.id'),
          'username' => input('post.username'),
          'password' => input('post.password'),
          'repassword' => input('post.repassword'),
          'nickname' => input('post.nickname'),
          'email' => input('post.email'),
          'status' => input('post.status', 0),
          'is_super' => input('post.is_super',0)
        ];
        $result = model('Admin')->edit($data);
        if($result == 1) {
          $this->success('编辑成功','admin/admin/list');
        } else {
          $this->error($result);
        }

      }

      $adminInfo = model('Admin')->find(input('id'));
      $viewData = [
        'adminInfo' => $adminInfo
      ];
      $this->assign($viewData);
      return view();
    }

    // 删除管理员
    public function del()
    {
      $result = model('Admin')->del(input('id'));
      if($result == 1) {
        $this->success('删除成功','admin/admin/list');
      } else {
        $this->error($reuslt);
      }
    }
}
