<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;

class Base extends Controller
{
    // 如果没有登录的话，就去登录页面
    public function initialize()
    {
        if (!session('?admin.id')) {
            $this->redirect('admin/index/login');
        }
    }
}
