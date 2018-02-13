<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/2/5 0005
 * Time: 9:35
 */

namespace app\index\controller;

use think\Db;
use think\Controller;
use think\facade\Cache;

class Base extends Controller
{
    public function __construct()
    {

        header("Cache-control: private");
        parent::__construct();

        $this->assign('navigate',navigate());
        $this->assign('foo',footer());
    }

    public function initialize()
    {
        $this->checkTag();


        //todo 从此截断对边栏赋值



//        $action  = request()->action();
//        if(!in_array($action ,['login','logout'])) {
//            if(session('admin_id') > 0 ){
////                $this->check_priv();//检查管理员菜单操作权限
//                return true;
//            }else{
//                $this->error('请先登陆',Url('/login'),1);
//            }
//        }

    }

    public function checkTag(){

        $tags = Db::table('tags')
        ->cursor();
        foreach ($tags as $val) {
           Cache::tag('tag')->get($val['tag_id'])?false:Cache::tag('tag')->set($val['tag_id'],$val['tag_name']);     
        }
     
    } 
}