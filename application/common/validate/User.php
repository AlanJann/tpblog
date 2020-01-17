<?php

namespace app\common\validate;

use think\Validate;

class User extends Validate
{

  protected $rule = [
    'username|会员账户' => 'require|unique:user',
    'password|会员密码' => 'require',
    'repassword|确认密码'=>'require|confirm:password',
    'nickname|会员昵称' => 'require',
    'email|会员邮箱' => 'require|email'
  ];

  // 添加场景
  public function sceneAdd()
  {
    return $this->only(['username','password','nickname','email']);
  }

  // 注册场景
  public function sceneRegister()
  {
    return $this->only(['username','password','repassword','nickname','email']);
  }

  // 登录场景
  public function sceneLogin()
  {
    return $this->only(['password'])
    ->append('username','require');
  }
}