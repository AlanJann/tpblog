<?php

namespace app\api\controller;


class Article extends Base
{
    // 文章详情页
    public function info()
    {

        $cates = model('Cate')->order('sort','asc')->select();
        $webInfo = model('Config')->find();

        $articleInfo = model('Article')->with('comments,comments.user')->find(input('id'));
        $articleInfo->setInc('click');
        $top = model('Article')->where('is_top',1)->order('create_time','desc')->limit(10)->select();
        $viewData = [
            'cates' => $cates,
            'webinfo' => $webInfo,
            'articleInfo' => $articleInfo,
            'top' => $top,
        ];
        $this->assign($viewData);
        return view();
    }

    // 评论
    public function usermsg()
    {
        $data = [
            
        ];
    }
}
