<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/25 0025
 * Time: 13:01
 */

namespace app\admin\controller;
use think\Controller;
use think\facade\Session;



class Base extends Controller{
    public function __construct()
    {
        Session::start();
        header("Cache-control: private");
        parent::__construct();

        //用户中心面包屑导航
//        $navigate_admin = navigate_admin();
//        $navigate_admin = [];
//        $this->assign('navigate_admin', $navigate_admin);
    }

    public function initialize()
    {

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


}