<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/25 0025
 * Time: 10:47
 */

namespace app\admin\controller;

use app\admin\model\Article as Articles ;
use app\admin\model\ArticleTags;
use app\admin\model\Blog_info;
use app\admin\model\Category;
use think\Controller;
use think\facade\Request;
use think\Db;
use think\facade\Cache;
use think\Model;

class Index extends Base {
    public function index(){
        $menu =	array(
	    'system'=>array('name'=>'系统','child'=>array(
				array('name' => '设置','child' => array(
                    array('name' => '文章列表', 'act'=>'ArticleList', 'op'=>'Admin'),
                    array('name' => '分类', 'act'=>'categoryList', 'op'=>'Goods'),

				)),
				array('name' => '会员','child'=>array(
						array('name'=>'会员列表','act'=>'index','op'=>'User'),
//						array('name'=>'会员等级','act'=>'levelList','op'=>'User'),
						array('name'=>'充值记录','act'=>'recharge','op'=>'User'),
						array('name'=>'提现申请','act'=>'withdrawals','op'=>'User'),
//						array('name'=>'会员操作','act'=>'memberOperate','op'=>'User'),
						array('name'=>'消息中心','act'=>'message','op'=>'User'),
                        array('name'=>'短信记录','act'=>'shortMsg','op'=>'User'),

                )),
				array('name' => '广告','child' => array(
						array('name'=>'广告列表','act'=>'adList','op'=>'Ad'),
						array('name'=>'广告位置','act'=>'positionList','op'=>'Ad'),
				)),
				array('name' => '文章','child'=>array(
						array('name' => '文章列表', 'act'=>'articleList', 'op'=>'Article'),
						array('name' => '文章分类', 'act'=>'categoryList', 'op'=>'Article'),
						//array('name' => '帮助管理', 'act'=>'help_list', 'op'=>'Article'),
						//array('name'=>'友情链接','act'=>'linkList','op'=>'Article'),
						//array('name' => '公告管理', 'act'=>'notice_list', 'op'=>'Article'),
						array('name' => '专题列表', 'act'=>'topicList', 'op'=>'Topic'),
				)),
				array('name' => '权限','child'=>array(
						array('name' => '管理员列表', 'act'=>'index', 'op'=>'Admin'),
                        array('name' => '组织管理','act'=>'organization','op'=>'Admin'),
                        array('name' =>'部门管理','act'=>'department','op'=>'Admin'),
                        array('name' => '角色管理', 'act'=>'role', 'op'=>'Admin'),
						array('name'=>'权限资源列表','act'=>'right_list','op'=>'System'),
						array('name' => '管理员日志', 'act'=>'log', 'op'=>'Admin'),
//						array('name' => '供应商列表', 'act'=>'supplier', 'op'=>'Admin'),
				)),

				array('name' => '模板','child'=>array(
						array('name' => '模板设置', 'act'=>'templateList', 'op'=>'Template'),
				)),
				array('name' => '数据','child'=>array(
						array('name' => '数据备份', 'act'=>'index', 'op'=>'Tools'),
						array('name' => '数据还原', 'act'=>'restore', 'op'=>'Tools'),
						//array('name' => '数据恢复', 'act'=>'log', 'op'=>'Admin'),
						//array('name' => 'SQL查询', 'act'=>'log', 'op'=>'Admin'),
				))
	)),

	    'shop'=>array('name'=>'商城','child'=>array(
				array('name' => '商品','child' => array(
					array('name' => '文章列表', 'act'=>'ArticleList', 'op'=>'Admin'),
                    array('name' => '分类', 'act'=>'categoryList', 'op'=>'Goods'),
					array('name' => '商品规格', 'act' =>'specList', 'op' => 'Goods'),
					array('name' => '品牌列表', 'act'=>'brandList', 'op'=>'Goods'),

			)),

	)),

        );



        $this->assign('admin_info',['user_name'=>"ww",'admin_id'=>1]);
        $this->assign('menu',$menu);
        return $this->fetch();

    }

    public function welcome(){
    	$this->assign('sys_info',$this->get_sys_info());
//    	$today = strtotime("-1 day");
    	$today = strtotime(date("Y-m-d"));
    	$count['handle_order'] = 1;//待处理订单
    	$count['new_order'] =1;//今天新增订单
    	$count['goods'] =  1;//商品总数
    	$count['article'] = 1;//文章总数
    	$count['users'] = 1;//会员总数
    	$count['today_login'] =1;//今日访问
    	$count['new_users'] = 1;//新增会员
    	$count['comment'] =1;//最新评论
    	$this->assign('count',$count);
        return $this->fetch();
    }

    public function get_sys_info(){
		$sys_info['os']             = PHP_OS;
		$sys_info['zlib']           = function_exists('gzclose') ? 'YES' : 'NO';//zlib
		$sys_info['safe_mode']      = (boolean) ini_get('safe_mode') ? 'YES' : 'NO';//safe_mode = Off
		$sys_info['timezone']       = function_exists("date_default_timezone_get") ? date_default_timezone_get() : "no_timezone";
		$sys_info['curl']			= function_exists('curl_init') ? 'YES' : 'NO';
		$sys_info['web_server']     = $_SERVER['SERVER_SOFTWARE'];
		$sys_info['phpv']           = phpversion();
		$sys_info['ip'] 			= GetHostByName($_SERVER['SERVER_NAME']);
		$sys_info['fileupload']     = @ini_get('file_uploads') ? ini_get('upload_max_filesize') :'unknown';
		$sys_info['max_ex_time'] 	= @ini_get("max_execution_time").'s'; //脚本最大执行时间
		$sys_info['set_time_limit'] = function_exists("set_time_limit") ? true : false;
		$sys_info['domain'] 		= $_SERVER['HTTP_HOST'];
		$sys_info['memory_limit']   = ini_get('memory_limit');
        $sys_info['version']   	    = 2.0;
		$mysqlinfo = Db::query("SELECT VERSION() as version");
		$sys_info['mysql_version']  = $mysqlinfo[0]['version'];
		if(function_exists("gd_info")){
			$gd = gd_info();
			$sys_info['gdinfo'] 	= $gd['GD Version'];
		}else {
			$sys_info['gdinfo'] 	= "未知";
		}
		return $sys_info;
    }

    public function ArticleList(){

        return view();
    }

    public function ajax_article_list(){
        $order_by = input('order_by',false);
        $sort = input('sort','asc');
        $stime = input('add_time_begin',false);
        $etime = input('add_time_end',false);
        $type = input('type',false);
        $category = input('category',false);

        empty($type)?false:$map[]=['b.type','=',$type];
        ($category>0)?$map[]=['b.category_id','=',$category]:false;
        empty($stime)?false:$map[]=['pubtime','>=',strtotime($stime)];
        empty($etime)?false:$map[]=['pubtime','<=',strtotime($etime)];
        $order_by = empty($order_by)?['b.blog_id'=>'desc']:[$order_by=>$sort];

        $result = Db::table('blog_info')
            ->alias('b')
            ->rightJoin(['category'=>'c'],'b.category_id = c.category_id')
            ->field('b.*,c.category_name')
            ->where($map)
            ->order($order_by)
            ->paginate(10,false,[
                'path'=>'javascript:void(0)',
                ]);


        $this->assign('articleList',$result);


        return view();
    }

    public function addEditArticle(){
        $this->initEditor();

        //post提交处理
        if(request()->isPost()){



            $info_data = input('post.',null,'htmlspecialchars');

            $info_data['pubtime'] = time();

            $art_data['article'] = $info_data['article'];

            $tag_data =  $info_data['tag'];

            //有主键升级处理
            $pkey =  $info_data['blog_id'];
            $blog_info = new Blog_info();
            $article = new Articles();
            if($pkey)
            {
                $blog_info->allowField(true)
                    ->save($info_data,$pkey);

                $article->where('blog_id',$pkey)->update($art_data);


            }else{
                $blog_info->allowField(true)
                    ->save($info_data);

                $pkey = $blog_info->blog_id;

                $art_data['blog_id'] = $pkey;

                $article->insert($art_data);

            }

            //组织中间表数据

            if(is_array($tag_data)){

                $data = [];
                foreach ($tag_data as $k=> $v){
                    $data[$k]['tag_id'] = $v;
                    $data[$k]['blog_id'] = $pkey;
                }
                Db::table('article_tags')->where('blog_id',$pkey)->delete();
                Db::table('article_tags')->insertAll($data);
            }
            $this->success('success',url('/articlelist'));


        }else{
            if($blog_id = input('blog_id')){
                $info = Blog_info::getArticle($blog_id);

                $this->assign('blog',$info);
            }

        }
        $category = Category::where('parent_id',0)->select();
        $this->assign('category',$category);
         return view();
    }
    
      /**
     * 初始化编辑器链接
     * 本编辑器参考 地址 http://fex.baidu.com/ueditor/
     */
    private function initEditor()
    {
        $this->assign("URL_upload", Url('/Ueditor/imageUp',array('savepath'=>'goods'))); // 图片上传目录
        $this->assign("URL_imageUp", Url('/Ueditor/imageUp',array('savepath'=>'article'))); //  不知道啥图片
        $this->assign("URL_fileUp", Url('/Ueditor/fileUp',array('savepath'=>'article'))); // 文件上传s
        $this->assign("URL_scrawlUp", Url('/Ueditor/scrawlUp',array('savepath'=>'article')));  //  图片流
        $this->assign("URL_getRemoteImage", Url('/Ueditor/getRemoteImage',array('savepath'=>'article'))); // 远程图片管理
        $this->assign("URL_imageManager", Url('/Ueditor/imageManager',array('savepath'=>'article'))); // 图片管理
        $this->assign("URL_getMovie", Url('/Ueditor/getMovie',array('savepath'=>'article'))); // 视频上传
        $this->assign("URL_Home", "");
    }


    public function getCategoryList(){
        dump(Env::get('think_path') );
        exit;

        $data = $this->getCategoryTree(0);

        static $arr = [];
        foreach ($data as $k=>$v)
        {
            $sondata = $v['son'];
            unset($v['son']);
            $arr[] = $v;
            if(empty($sondata)) continue;
            foreach ($sondata as $k1 =>$v1){
                $arr[] = $v1;
            }
        }
        unset($data);

        $this->assign('list',$arr);
        return view('categoryList');
    }

    public function addEditCategory()
    {
        if(request()->isPost()){
           if(input('category_id'))
                Category::update($_POST);
           else
                Category::save($_POST);

           $this->success('执行成功','/CategoryList');

        }
        $id = input('id');
        if($id)
            $data = Db::table('category')->find($id);

        $category_list = Db::table('category')
            ->field('category_id,category_name')
            ->where('parent_id',0)
            ->select();

        $this->assign('category',$data);
        $this->assign('category_list',$category_list);
        return view('_category');
    }

    public function getCategoryTree($id)
    {
        $data = Db::table('category')
            ->where('parent_id','=',$id)
            ->select();
        if(empty($data)) return;
        if (is_array($data)){
            foreach($data as $k => $v)
            {
                $data[$k]['son'] = $this->getCategoryTree($v['category_id']);
            }
        }
        return $data;
    }

    public function delCategory(){
        $id = input('id',false);
        if(!$id) $this->error( "非法操作!");
        $info = Db::table('category')
        ->find($id);
        if(!$info) $this->error( "非法操作!");
        $categoryCount = Db::table('category')
            ->where('parent_id','=',$id)
            ->count();
        if($categoryCount) $this->error('类目下有子分类,不能删除!');

        $articleCount = Db::table('blog_info')
            ->where('category_id',$id)
            ->count();
        if($articleCount) $this->error('分类下有文章,不能删除!');

        Db::table('category')
            ->delete($id);
        $this->success('删除成功!',Url('/CategoryList'));

    }

    public function login(){
        dump(123);
    }

    public function logout(){

    }








}