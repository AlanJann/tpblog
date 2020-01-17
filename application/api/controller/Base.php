<?php

namespace app\api\controller;

use think\Controller;
use think\Request;

class Base extends Controller
{
    public function initializa()
    {
        $cates = model('Cate')->order('sort','asc')->select();
        $viewData = [
            'cates' => $cates
        ];
        $this->view()->share($viewData);
    }
}
