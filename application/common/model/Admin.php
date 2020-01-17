<?php

namespace app\common\model;

use think\Model;
use think\model\concern\SoftDelete;

class Admin extends Model
{
    // 软删除
    use SoftDelete;

    // 登录校验
    public function login($data)
    {
        $validate = new \app\common\validate\Admin();
		// 判断是否验证通过,如果没有报错回去
        if (!$validate->scene('login')->check($data)) {
            return $validate->getError();
        } 
        $result = $this->where($data)->find();
        if ($result) {
			// 判断用户是否可用
			if ($result['status'] != 1){
				return '此账户被禁用！';
			}
            // 1.表示这个用户，也就是账户密码正确，
			$sessionData = [
				'id' => $result['id'],
				'nickname' => $result['nickname'],
				'is_super' => $result['is_super'],
			];
			session('admin',$sessionData);
            return 1;
        } else{
            // 2.表示没有改用户，或者密码错误
            return '账号或密码不正确';
        }
    }
	
	// 注册账户
	public function register($data)
	{
		$validate = new \app\common\validate\Admin();
		if (!$validate->scene('register')->check($data)) {
			return $validate->getError();
		}
		// 表单验证通过之后就可以将数据写入数据库 allowField: 表示数据库有的表才会将对应的数据写入, save: 插入数据.
		$result = $this->allowField(true)->save($data);
		if ($result) {
			return 1;
		} else{
			return '注册失败';
		}
	}

	// 后台添加
	public function add($data)
	{
		$validate = new \app\common\validate\Admin();
		if (!$validate->scene('add')->check($data)) {
			return $validate->getError();
		}
		$result = $this->allowField(true)->save($data);
		if ($result) {
			return 1;
		} else {
			return '添加失败';
		}
	}

	// 管理员状态
	public function status($data)
	{
		$admin = $this->find($data['id']);
		$admin->status = $data['status'];
		$result = $admin->save();
		if ($result){
			return 1;
		} else {
			return '设置失败';
		}
	}

	// 超级管理员
	public function issuper($data)
	{
		$admin = $this->find($data['id']);
		$admin->is_super = $data['is_super'];
		$result = $admin->save();
		if ($result){
			return 1;
		} else {
			return '设置失败';
		}
	}

	// 编辑
	public function edit($data)
	{
		$validate = new \app\common\validate\Admin();
		if(!$validate->scene('edit')->check($data)) {
			return $validate->getError();
		}
		$admin = $this->find($data['id']);
		$admin->username = $data['username'];
		$admin->password = $data['password'];
		$admin->nickname = $data['nickname'];
		$admin->email = $data['email'];
		$admin->status = $data['status'];
		$admin->is_super = $data['is_super'];
		$result = $admin->save();
		if ($result){
			return 1;
		} else {
			return '编辑失败';
		}
	}

	// 删除
	public function del($id)
	{
		$admin = $this->find($id);
		$result = $admin->delete();
		if ($result) {
			return 1;
		} else {
			return '删除失败';
		}
	}


}
