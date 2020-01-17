<?php

namespace app\common\validate;

use think\Validate;

class Comment extends validate
{
  protected $rule = [
    'content|内容' => 'require',
  ];

  public function sceneUsermsg()
  {
    return $this->only(['content']);
  }
}