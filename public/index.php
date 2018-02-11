<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

// [ 应用入口文件 ]
namespace think;

//  定义插件目录
define('PLUGIN_PATH', __DIR__ . '/../plugins/');
define('UPLOAD_PATH','upload/'); // 编辑器图片上传路径
define('SITE_URL','http://'.$_SERVER['HTTP_HOST']); // 网站域名
// 定义应用目录
define('APP_PATH', __DIR__ . '/../application/');

// 定义时间
define('NOW_TIME',$_SERVER['REQUEST_TIME']);

// 加载框架引导文件
//
//define('APP_DEBUG', true);
//define('LOG_RECORD', true);
//define('LOG_LEVEL', 'EMERG,ALERT,CRIT,ERR,WARN');

// 加载基础文件
require __DIR__ . '/../thinkphp/base.php';

// 支持事先使用静态方法设置Request对象和Config对象

// 执行应用并响应
Container::get('app')->run()->send();