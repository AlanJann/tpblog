<?php

namespace app\admin\controller;

use think\Controller;

class comment extends Base
{
    // 评论列表
    public function list()
    {
        $comments = model('Comment')->with('article,user')->order('create_time','desc')->paginate(10);
        $viewData = [
            'comments' => $comments,
        ];
        $this->assign($viewData);
        return view();
    }

    // 评论删除
    public function del()
    {
        $comment = model('Comment')->find(input('id'));
        $result = $comment->delete();
        if ($result) {
            $this->success('删除成功','admin/comment/list');
        } else {
            $this->error('删除失败');
        }
    }
}
