<?php

namespace app\admin\controller;

use think\Controller;

class Cate extends Base
{
    // 栏目列表
    public function list()
    {
        $cates = model('Cate')->order('sort')->paginate(10);
        // 定义一个模板数据变量
        $viewData = [
            'cates' => $cates,
        ];
        $this->assign($viewData);
        return view();
    }

    // 栏目添加
    public function add()
    {
        if(request()->isAjax()) {
            $data = [
                'catename' => input('post.catename'),
                'sort' => input('post.sort')
            ];
            $result = model('Cate')->add($data);
            if ($result == 1) {
                $this->success('栏目添加成功','admin/cate/list');
            }else {
                $this->error($result);
            }
        }
        return view();
    }

    // 栏目排序
    public function sort()
    {
        $data = [
            'id' => input('post.id'),
            'sort' => input('post.sort')
        ];
        $result = model('Cate')->sort($data);
        if ($result == 1) {
            $this->success('排序成功','admin/cate/list');
        } else {
            $this->error($result);
        }
    }

    // 栏目编辑
    public function edit()
    {
        if (request()->isAjax()) {
            $data = [
                'id' => input('post.id'),
                'catename' => input('post.catename')
            ];
            $result = model('Cate')->edit($data);
            if($result == 1) {
                $this->success('编辑成功','admin/cate/list');
            } else {
                $this->error($result);
            }
        }
        $cateInfo = model('Cate')->find(input('id'));
        // 模板变量
        $viewData = [
            'cateInfo' =>$cateInfo,
        ];
        $this->assign($viewData);
        return view();
    }

    // 栏目删除
    public function del()
    {                   // 本模型      //文章模型 // 文章里的评论模型
        $cateInfo = model('Cate')->with('article,article.comments')->find(input('post.id'));
        foreach ($cateInfo['article'] as $k => $v) { // 循环文章模型
            $v->together('comments')->delete(); // 删除评论
        }
        $result = $cateInfo->together('article')->delete(); //删除栏目和关联的文章
        // ==== 栏目里有多个文章，文章里有多条评论。
        if($result) {
            $this->success('删除成功', 'admin/cate/list');
        } else {
            $this->error('栏目删除失败');
        }
    }
}
