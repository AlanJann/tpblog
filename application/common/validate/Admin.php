<?php

namespace app\common\validate;

use think\Validate;

class Admin extends Validate
{
  protected $rule = [
    'username|管理员账户'=>'require',
    'password|密码'=>'require',
	'repassword|确认密码'=>'require|confirm:password',
	'nickname|昵称'=>'require',
  'email|邮箱'=>'require|email',
  'status' => 'require',
  'is_super' => 'require',
  ];

  // 验证场景
  public function sceneLogin()
  {
    return $this->only(['username','password']);
  }
  
  // 注册
  public function sceneRegister()
  {
	return $this->only(['username','password','repassword','nickname','email'])
	->append('username','unique:admin');
  }

  // 添加
  public function sceneAdd()
  {
    return $this->only(['username','password','repassword','nickname','email','status','is_super'])
    ->append('username','unique:admin');
  }

  // 编辑
  public function sceneEdit()
  {
    return $this->only(['username','password','repassword','nickname','email','status','is_super']);
  }
  
}