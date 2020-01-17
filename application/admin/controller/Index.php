<?php

namespace app\admin\controller;

use think\Controller;

class Index extends Base
{
		// 只要session里面存了用户信息，就无需登录
		public function initialize()
		{
				if (session('?admin.id')) {
						$this->redirect('admin/home/index');
				}
		}

    // 后台登录
    public function login () 
	{
        if (request()->isAjax()) {
            $data = [
                'username' => input('post.username'),
                'password' => input('post.password'),
            ];
            $result = model('Admin')->login($data);   // 将数据传给模型里面去校验
            if ($result == 1) {
                $this->success('登录成功','admin/home/index');
            } else {
                $this->error($result);
            }
        }
        return view();
    }
	
	// 注册
	public function register () 
	{
		if (request()->isAjax()) {
			$data = [
				'username' => input('post.username'),
				'password' => input('post.password'),
				'repassword' => input('post.repassword'),
				'nickname' => input('post.nickname'),
				'email' => input('post.email'),
			];
			$result = model('Admin')->register($data);
			if ($result == 1) {
				$this->success('注册成功','admin/index/login');
			} else {
				$this->error($result);
			}
			
		};
		return view();
	}
	

}
