<?php
namespace app\index\controller;

use think\Controller;
use think\facade\Request;
use think\Db;
use think\facade\Cache;
use app\index\model\Article;
use app\admin\model\Blog_info;


class Index extends Base
{

        /**
     * 主页面,各种查
     * @Authorhtl {Ning<nk11@qq.com>}
     */
    public function index(){


        $quote=Db::table('quote')->order('pubtime desc')->limit(1)->find();
        $this->assign('quote',$quote);

        // 生活博文
        $blogs1 = Db::table('blog_info')
            ->field('blog_id,title,pubtime,img,intro,likes,click_count')
            ->where([['is_index','=',1],['type','=',1]])
            ->order('pubtime desc')
            ->limit(2)
            ->select();
        $this->assign('blog',$blogs1);
         // 技术博文展示

         $blogs2 = Db::table('blog_info')
             ->field('blog_id,title,pubtime,likes,click_count,intro')
             ->where([['is_index','=',1],['type','=',2]])
             ->order('pubtime desc')
             ->limit(1)
             ->find();
         $this->assign('blog2',$blogs2);

         $blogs3 = Blog_info::with('article')
             ->field('blog_id,title,pubtime,likes,click_count')
             ->where([['is_index','=',1],['type','=',2]])
             ->order('pubtime desc')
             ->limit(1,5)
             ->select();
         $this->assign('blogs3',$blogs3);

         // 内含段子
         $dz = $this->duanzi();
         $this->assign('dz',$dz);


        return $this->fetch('index');
    }
/**
 * 生活类文章
 * @Authorhtl {Ning<nk11@qq.com>}
 */
    public function art(){
       
        
            $blogs =  $article = Blog_info::with('article,tag')->find(input('id'));
          
            $this->assign('art',$blogs);
         
            //侧边栏图文模块

            $aside = Db::table('blog_info')->field('blog_id,img,title,pubtime')->where('is_show="on"')->where('is_index="on"')->order('pubtime desc')->limit(4)->select();

            $this->assign('aside',$aside);
            //侧边栏文章推荐
            $arts = Db::table('blog_info')->field('blog_id,title')->where('is_show="on"')->order('click_count desc')->limit(9)->select();
            $this->assign('artlist',$arts);


           return $this->fetch();

    }
/**
 * 生活类文章列表
 * @Authorhtl {Ning<nk11@qq.com>}
 */
    public function artlist(){

        $type = input('type',false);
        $category = input('id');
        $tag_id = input('tag_id');

        //通过分类获取
        if($category){
          $categorys = Db::table('category')
          ->where('parent_id',$category)
          ->column('category_id');

          $map[]= empty(!$categorys)?['category_id','in',$categorys]:['category_id','=',$category];

           $list = Db::table('blog_info')
           ->field('blog_id,pubtime,likes,click_count,img,intro,category_id,title')
           ->where($map)
           ->order('pubtime desc')
           ->paginate(8,false,[
              'type'     => 'bootstrap',
              'var_page' => 'page',
              'query'=>request()->param()
              ]);
          }
          //通过标签获取
          if($tag_id){
            $arts = Db::table('article_tags')
            ->where('tag_id',$tag_id)
            ->column('blog_id');
            
            $list = Db::table('blog_info')
            ->where('blog_id','in',$arts)
            ->field('blog_id,pubtime,likes,click_count,img,intro,category_id,title')
            ->order('pubtime desc')
            ->paginate(8,false,[
              'type'     => 'bootstrap',
              'var_page' => 'page',
              'query'=>request()->param()
              ]);

          }
         
        if($type == 1){            
            $aside = Db::table('blog_info')
                ->field('blog_id,img,title,pubtime')
                ->where('is_show',1)
                ->where('is_index',1)
                ->where('type',$type)
                ->order('pubtime desc')
                ->limit(4)
                ->select();
            $this->assign('aside',$aside);

            $arts = Db::table('blog_info')
                ->field('blog_id,title')
                ->where('is_show="on"')
                ->order('pubtime desc')
                ->where('type',$type)
                ->limit(9)
                ->select();
            $this->assign('artlist',$arts);
        }
        $this->assign('list',$list);// 赋值数据集
        if ($type == 1) return $this->fetch('artlist');
        if($type == 2) return $this->fetch('techlist');


    }


    //添加喜欢
    public function likes(){
        Db::table('blog')->execute('update blog set likes=likes+1 where blog_id='.I('id'));
        $like = Db::table('blog')->field('likes')->find(I('id'));
        $this->ajaxReturn($like,'json');

    }
    public function techlike(){
        Db::table('tech')->execute('update tech set likes=likes+1 where tech_id='.I('id'));
        $like = M('tech')->field('likes')->find(I('id'));
        $this->ajaxReturn($like,'json');
    }





/**
 * 技术文章
 * @Authorhtl {Ning<nk11@qq.com>}
 */
    public function tech_article(){
      
        $article = Blog_info::with('article,tag')->find(input('id'));
        $this->assign('art',$article);
        return $this->fetch();

    }




/**
 * 联系我模块，发送邮件到我的邮箱
 * @Authorhtl {Ning<nk11@qq.com>}
 * @DateTime  2016-12-07T23:03:22+0800
 */
    public function contact(){
        /*判断是否有提交，没有提交吊用底部信息显示模版*/
        if(!request()->isPost()){
            
            return $this->fetch();

        }else{/*有提交实例化留言表，发送邮件*/
            $con = Db::table('contact');//实例化对象

            if (!$con->create()) {//提交验证
                $this->error($con->getError());
                exit;
            }//可选参数验证入库
            if (!empty($_POST['name'])) {
                $con->name = $_POST['name'];
            }
            if (!empty($_POST['title'])) {
                $con->name = $_POST['title'];
            }
            $con->email = $_POST['email'];
            $con->message = $_POST['message'];
            $con->subtime = time();
            //获取用户ip
            $ip = get_client_ip();
            $con->ip = $ip;
            //吊用方法发送邮件
            $this->send_mail($ip,$_POST['email'],$_POST['message'],$_POST['name']);
            if ($con->add()) {
              $this->success('留言成功，邮件已发送站长信箱！');
            }
        }

    }



    public function co(){
        return $this->fetch('photo');
        }


    public function jock(){
        $res = $this->duanzi();
        return $this->fetch();
    }

    public function pict(){
        return $this->fetch();

    }
/**
 * 播放不姐接视频
 * @Authorhtl {Ning<nk11@qq.com>}
 * @DateTime  2017-01-08T21:27:19+0800
 * @return
 */
    public function viedo(){

        $nu = input('nu')?input('nu'):0;
        if ($nu<0) {
          $nu = mt_rand(10,99);
        }
        
		if (Cache::get($nu)) {
			$res = Cache::get('viedo'.$nu);
		}else{
			$res = $this->sp($nu);
			$res['nu'] = $nu;
            $res['text'] = trim($res['text']);
			Cache::set('viedo'.$nu,$res);
		}
 
        $this->assign('res',$res);
        return $this->fetch();

    }

    /**
     * 调用不得姐
     * @Authorhtl {Ning<nk11@qq.com>}
     * @DateTime  2017-01-08T21:27:54+0800
     * @param     integer                  $nu
     * @return    array
     */
    public function sp($nu=0){
        if($nu<20){
            $page = 1;
        }elseif($nu>=20&&$nu<40){
            $page = 2;
            $nu = $nu%20;
        }elseif($nu>=40&&$nu<60){
            $page = 3;
            $nu = $nu%20;
        }elseif ($nu>=60&&$nu<80) {
            $page = 4;
            $nu = $nu%20;
        }elseif ($nu>=80&&$nu<100) {
            $page = 5;
            $nu = $nu%20;
        }elseif ($nu>=100&&$nu<120) {
            $page = 6;
            $nu = $nu%20;
        }elseif ($nu>=120) {
            $page = mt_rand(1,9);
            $nu = $nu%20;
        }
        $type = 41;
        $result = $this->budejie($type,$page);

        return $result[$nu];

    }



    /**
     * 调用不得姐api返回图片信息
     * @Authorhtl {Ning<nk11@qq.com>}
     * @DateTime  2016-11-25T20:15:13+0800
     * @return array
     */
    public function ct(){
        $type = 10;
        $page = mt_rand(1,9);
        $result = $this->budejie($type,$page);
        $this->assign('res',$result);
        return $this->fetch('jockpho');
    }



    /**
     * 调用不得姐api接口返回数据
     * @Authorhtl {Ning<nk11@qq.com>}
     * @DateTime  2016-11-25T20:14:01+0800
     * @return array
     */
    public function duanzi(){
        $result = $this->budejie(29,1);
        $one = array_rand($result);
        $res = $result["$one"];
        return $res;
    }



    /**
     * 链接百思不得姐api,返回多维数组
     * @Authorhtl {Ning<nk11@qq.com>}
     * @DateTime  2016-11-25T20:11:56+0800
     * @param    int  $type 获取的数据类型
     * @param    integer   $page 获取的页数
     * @return   array
     */
    public function budejie($type,$page=1){
          $showapi_appid ='27667';  //替换此值,在官网的"我的应用"中找到相关值
            $showapi_secret = 'a3a6f888ea30485cb1fc98f4c1a4dce0';  //替换此值,在官网的"我的应用"中找到相关值
            $paramArr = array(
                 'showapi_appid'=> $showapi_appid,
                 'type'=> "$type",
                 'title'=> "",
                 'page'=> "$page"
                 //添加其他参数
            );
            //创建参数(包括签名的处理)
            function createParam ($paramArr,$showapi_secret) {
                 $paraStr = "";
                 $signStr = "";
                 ksort($paramArr);
                 foreach ($paramArr as $key => $val) {
                     if ($key != '' && $val != '') {
                         $signStr .= $key.$val;
                         $paraStr .= $key.'='.urlencode($val).'&';
                     }
                 }
                 $signStr .= $showapi_secret;//排好序的参数加上secret,进行md5
                 $sign = strtolower(md5($signStr));
                 $paraStr .= 'showapi_sign='.$sign;//将md5后的值作为参数,便于服务器的效验
                 // 排好序的参数:
                 return $paraStr;
            }

            $param = createParam($paramArr,$showapi_secret);
            $url = 'http://route.showapi.com/255-1?'.$param;

            // $result = file_get_contents($url);//效率出发啊考虑不用
            $result=$this->getCurl($url);

            $result = json_decode($result,true)['showapi_res_body']['pagebean']['contentlist'];
            return $result;
        }



/**
 * 回调地址，接收多说用户留言信息
 * @Authorhtl {Ning<nk11@qq.com>}
 * @DateTime  2016-12-07T23:00:45+0800
 * @return  json
 */
    public function callback(){
        $url='http://api.duoshuo.com/log/list.json?short_name=nono0903&secret=73d433b62087e5365dd8706b393d3756';
        $comms = file_get_contents($url);
        $comms =json_decode($comms,true);
        print_r($comms);
    }


    public function getCurl($url){//crul吊用api接口方法
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,"$url");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    $out = curl_exec($ch);
    curl_close($ch);
    return $out;
}



/**
 * [send_mail description]发送邮件api调用
 * @Authorhtl {Ning<nk11@qq.com>}
 * @DateTime  2016-12-07T22:56:35+0800
 * @param  str $ip 发送邮件者的ip地址
 * @param  str $email 发送邮件者等级的回发email地址
 * @param  str $message 发送的邮件信息
 * @param  str $name  发送者登记的用户名
 * @return json 发送成功返回json对象，发送失败返回false
 */
    public function send_mail($ip,$email,$message,$name="0") {
        $url = 'http://api.sendcloud.net/apiv2/mail/send';
        $API_USER = 'ningnan7758_test_TIdYXY';
        $API_KEY = 'f8WPuNVJnZ5Y7Xjf';

        $param = array(
            'apiUser' => $API_USER, # 使用api_user和api_key进行验证
            'apiKey' => $API_KEY,
            'from' => $email, # 发信人，用正确邮件地址替代
            'fromName' => 'NingBlog',
            'to' => 'nk11@qq.com',# 收件人地址, 用正确邮件地址替代, 多个地址用';'分隔
            'subject' => '博客留言提醒',
            'html' => "  ip为：".$ip.";  用户名为：".$name.";  留言信息：".$message.";  回复邮箱：".$email,
            'respEmailId' => 'true'
        );


        $data = http_build_query($param);

        $options = array(
            'http' => array(
                'method' => 'POST',
                'header' => 'Content-Type: application/x-www-form-urlencoded',
                'content' => $data
        ));
        $context  = stream_context_create($options);
        $result = file_get_contents($url, FILE_TEXT, $context);

        return $result;
    }






    public function hello($name = 'ThinkPHP5')
    {
        return 'hello,' . $name;
    }



    public function clean_up(){

        $data = Db::table('article_c')->cursor();
        foreach ($data as $v){
            $in = [];
            $in['blog_id'] = $v['blog_id'];
            $in['article'] = $st = htmlspecialchars_decode($v['article']);
            $new =  htmlentities($st);

            dump($v['article']);
            dump($new);
            dump($in);

            exit;

        }



    }


}
