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

//Route::rule('admin', 'admin/index/index');
//Route::rule('welcome', 'admin/index/welcome');
Route::controller('Ueditor','Admin/Ueditor');
Route::controller('Uploadify','Admin/Uploadify');
return [
    'cl'=>'index/index/clean_up',
    '/'=>'index/index/index',
    'artlist'=>'index/index/artlist',
    'tech_article'=>'index/Index/tech_article',

//后台接口
    'admin'=>'admin/index/index',
    'welcome'=>'admin/index/welcome',
    'articlelist'=>'admin/index/articlelist',
    'ajax_article_list'=>'admin/index/ajax_article_list',
    'addEditArticle'=>'admin/index/addEditArticle',
    'Ueditor'=>'Admin/Ueditor/index',
    'imgUp'=>'Admin/Uploadify/upload',
    'doImgUp'=>'Admin/Ueditor/imageUp',
    'delUpload'=>'Admin/Uploadify/delupload',

    'CategoryList'=>'Admin/Index/getCategoryList',
    'delCategory'=>"Admin/Index/delCategory",
    'addEditCategory'=>"Admin/index/AddEditCategory",




//Api接口路由
    'get_category'=>'Admin/Api/getCategory',
    'getCategoryOpt'=>'Admin/Api/getCategoryOpt',
    'changeTableVal'=>"Admin/Api/changeTable",
    'getTags'=>"Admin/Api/getTags",
    'addTag'=>'Admin/Api/addTag',
    'delTag'=>"Admin/Api/delTag",

];
