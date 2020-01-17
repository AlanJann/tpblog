<?php

namespace app\common\model;

use think\Model;
use think\model\concern\SoftDelete;

class Comment extends Model
{
    // 软删除
    use SoftDelete;

    // 关联文章
    public function article()
    {
        return $this->belongsTo('Article','article_id','id');  // 多对1
    }

    // 关联用户
    public function user()
    {
        return $this->belongsTo('User','user_id','id');  // 多对1
    }

    // 用户评论
    public function usermsg($data)
    {
        $validate = new \app\common\validate\Comment();
        if (!$validate->scene('usermsg')->check($data)) {
            return $validate->getError();
        }
        $result = model('Comment')->allowField(true)->save($data);
        if ($result) {
            return 1;
        } else {
            return '评论失败';
        }
    }
}
