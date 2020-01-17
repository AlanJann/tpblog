<?php

namespace app\admin\controller;

use think\Controller;

class Config extends Base
{
    // 系统设置
    public function set()
    {
        $set = model('Config')->find();
        $viewData = [
            'set' => $set,
        ];
        $this->assign($viewData);
        return view();
    }

    // 设置修改
    public function edit()
    {
        if (request()->isAjax()) {
            $data = [
                'webname' => input('post.webname'),
                'copyright' => input('post.copyright'),
            ];
            $set = model('Config')->find();
            $set->webname = $data['webname'];
            $set->copyright = $data['copyright'];
            $result = $set->save();
            if ($result) {
                $this->success('修改成功','admin/config/set');
            } else {
                $this->error('修改失败');
            }
        }
        $set = model('Config')->find();
        $viewData = [
            'set' => $set
        ];
        $this->assign($viewData);
        return view();
    }
}
