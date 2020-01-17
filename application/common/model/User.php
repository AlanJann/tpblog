<?php

namespace app\common\model;

use think\Model;
use think\model\concern\SoftDelete;

class User extends Model
{
    //软删除
    use SoftDelete;
    // 只读字段
    protected $readonly = ['username','email'];

    // 关联评论 
    public function comments()
    {
        return $this->hasMany('Comment','user_id','id');
    }

    // 添加
    public function add($data) 
    {
        $validate = new \app\common\validate\User();
        if (!$validate->scene('add')->check($data)) {
            return $validate->getError();
        }
        $result = $this->allowField(true)->save($data);
        if ($result) {
            return 1;
        } else {
            return '会员添加失败';
        }
    }

    // 编辑
    public function edit($data)
    {
        $validate = new \app\common\validate\User();
        if (!$validate->scene('add')->check($data)) {
            return $validate->getError();
        }
        $userInfo = $this->find($data['id']);
        $userInfo->username = $data['username'];
        $userInfo->password = $data['password'];
        $userInfo->nickname = $data['nickname'];
        $userInfo->email = $data['email'];
        $result = $userInfo->save();
        if ($result) {
            return 1;
        } else {
            return '数据修改失败';
        }
    }

    // 注册
    public function register($data)
    {
        $validate = new \app\common\validate\User();
        if (!$validate->scene('register')->check($data)) {
            return $validate->getError();
        }

        $result = model('User')->allowField(true)->save($data);
        if ($result) {
            return 1;
        } else {
            return '注册失败';
        }
    }

    // 登录
    public function login($data)
    {
        $validate = new \app\common\validate\User();
        if (!$validate->scene('login')->check($data)) {
            return $validate->getError();
        }

        $where = [
            'username' => $data['username'],
            'password' => $data['password']
        ];
        $result = $this->where($where)->find();
        if ($result) {
            // 账户密码验证成功,存session
            $sessionData = [
                'nickname' => $result['nickname'],
                'id' => $result['id'],
            ];
            session('user',$sessionData);
            return 1;
        } else {
            return '账户或者密码不正确';
        }
    }
}
