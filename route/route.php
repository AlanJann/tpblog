<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

Route::group('admin',function () {
	Route::rule('/','admin/index/login','get|post');    // 登录路由
	Route::rule('register','admin/index/register','get|post');  // 注册路由

	Route::rule('index','admin/home/index','get');  // 后台首页
	Route::rule('loginout','admin/home/loginout', 'post'); // 退出登录

	Route::rule('catelist','admin/cate/list','get'); //栏目
	Route::rule('cateadd','admin/cate/add','get|post'); //添加
	Route::rule('catesort','admin/cate/sort','post'); //排序
	Route::rule('cateedit/[:id]','admin/cate/edit','get|post'); //编辑
	Route::rule('cateedel','admin/cate/del','post'); //删除

	Route::rule('articlelist','admin/article/list','get'); //文章列表
	Route::rule('articleadd','admin/article/add','get|post'); //文章添加
	Route::rule('articletop','admin/article/top','post'); //文章推荐
	Route::rule('articleedit/[:id]','admin/article/edit','get|post'); //文章编辑
	Route::rule('articledel','admin/article/del','post'); //文章删除

	Route::rule('userlist','admin/user/list','get'); // 会员列表
	Route::rule('useradd','admin/user/add','get|post'); //添加用户
	Route::rule('useredit/[:id]','admin/user/edit','get|post'); //会员编辑
	Route::rule('userdel','admin/user/del','post'); // 会员删除

	Route::rule('adminlist','admin/admin/list','get'); // 管理员列表
	Route::rule('adminadd','admin/admin/add','get|post'); // 管理员添加
	Route::rule('adminstatus','admin/admin/status','post'); // 管理员状态
	Route::rule('adminissuper','admin/admin/issuper','post'); // 超级管理员
	Route::rule('adminedit/[:id]','admin/admin/edit','get|post'); // 管理员编辑
	Route::rule('admindel','admin/admin/del','post'); // 管理员删除

	Route::rule('commentlist','admin/comment/list','get'); // 评论列表
	Route::rule('commentdel','admin/comment/del','post'); // 删除评论

	Route::rule('set','admin/config/set','get|post'); //系统设置
	Route::rule('setedit','admin/config/edit','get|post'); //设置修改
});

// 前台路由
Route::rule('search/:search','api/index/index','get'); // 单挑搜索
Route::rule('cate/:id','api/index/index','get'); // 导航点击
Route::rule('/','api/index/index','get|post');  // 前台首页
Route::rule('article-<id>','api/article/info','get'); // 文章详情
Route::rule('register','api/index/register', 'get|post'); // 前台用户注册
Route::rule('login','api/index/login', 'get|post'); // 用户登录
Route::rule('loginout','api/index/loginout','post'); // 用户退出
Route::RULE('usermsg','api/index/usermsg'); //用户评论
