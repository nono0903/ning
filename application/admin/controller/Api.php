<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/2/1 0001
 * Time: 14:49
 */

namespace app\admin\controller;

use think\Controller;
use think\facade\Request;
use think\Db;
use think\facade\Cache;
use app\admin\model\Category;
use app\admin\model\ArticleTags;

class Api extends Controller
{

    public function changeTable(){
        $table = input('table',false);
        $id_name = input('id_name',false);
        $id_value = input('id_value',false);
        $field = input('field',false);
        $value = Input('value',false);
        if(!$table||!$id_name||!$id_value||!$field||!$value) exit('缺少参数,执行失败!');
        //todo ajax操作表,虽然方便,快捷,但是漏洞也比较大,要先确定允许操作的表,字段,否则不允许操作
        $ForbidenTable = [];
        $allowField = ['is_show','is_index','sort','category_name'];

        if(in_array($table,$ForbidenTable)) exit('无权执行该操作');
        if(!in_array($field,$allowField)) exit("缺少执行权限");

        $result = Db::table($table)
            ->where($id_name,$id_value)
            ->setField($field,$value);
        if($result) exit('操作成功!');

        exit('未知错误!');

    }

    /**
     * js联动,通过父id查找子
     */
    public function getCategory(){
        $id= input('parent_id');
        $categorys = Category::
            where('parent_id',$id)
            ->Field('category_id,category_name')
            ->select();

        $html = '';
        foreach ($categorys as $k => $v)
        {
            $html .="<option value=".$v['category_id'].">".$v['category_name']."</option>";
        }
        exit($html);

    }

    /**
     * 通过类型获取分类
     */
    public function getCategoryOpt()
    {
        $type = input('type',1);

        $category_list = Category::
            where('parent_id','<>','0')
            ->Field('category_id,category_name')
            ->where('type',$type)
            ->select();
        $html = '';
        foreach ($category_list as $k => $v)
        {
            $html .="<option value=".$v['category_id'].">".$v['category_name']."</option>";
        }
        exit($html);


    }

    /**
     * ajax获取tag
     * @return \think\response\View
     */
    public function getTags(){
        $type = input('type');
        $blog_id = input('id',false);
        $taglist = Db::table('tags')
            ->where('type',$type)
            ->select();
        $tags = [];
        if($blog_id)$tags = ArticleTags::where('blog_id',$blog_id)->column('tag_id');
        $this->assign('tags',$tags);
        $this->assign('list',$taglist);

        return view('index/ajax_tag');
    }

    /**
     * ajax 添加tag
     */
    public function addTag(){
        $type = input('type');
        $tag = input('tag_name');
        if(!$type||!$tag) jsonReturn(-1,'非法操作');
        $tagres = Db::table('tags')
            ->where([['tag_name','=',$tag],['type','=',$type]])
            ->find();
        if($tagres) jsonReturn(-1,'数据已存在');
        Db::table('tags')
            ->strict(false)
            ->insert($_POST);
        jsonReturn(1,'添加成功');

    }

    /**
     *ajax删除tag
     */
    public function delTag(){
        $type = input('type');
        $tag = input('tag_name');
        if(!$type||!$tag) jsonReturn(-1,'非法操作');
        $tagid = Db::table('tags')
            ->where([['tag_name','=',$tag],['type','=',$type]])
            ->value('tag_id');
        if(!$tagid) jsonReturn(-1,'数据不存在');
        Db::table('tags')->delete($tagid);
        jsonReturn(1,'操作成功');

    }

    public function getPage(){
        $id = input('id');
        $type = input('type');
        
        $prev = Db::table('blog_info')
        ->where([['blog_id','<',$id],['type','=',$type]])
        ->order('blog_id','desc')
        ->field('blog_id,title')
        ->find();
        $next = Db::table('blog_info')
        ->where([['blog_id','>',$id],['type','=',$type]])
        ->field('blog_id,title')
        ->find();
        $page['prev'] = empty($prev)?['blog_id'=>$id,'title'=>'没有更多内容...']:$prev;
        $page['next'] = empty($next)?['blog_id'=>$id,'title'=>'没有更多内容...']:$next;
        ($type == 1) && $url = '/art';
        ($type == 2) && $url = '/tech_article';

        $str = '<span class="nav-prev"><a href="'.Url($url,['id'=>$page['prev']['blog_id']]).'">&larr;'. $page['prev']['title'].'</a></span>';
        $str .= '<span class="nav-next"><a href="'.Url($url,['id'=>$page['next']['blog_id']]).'">'.$page['next']['title'] .'&rarr;</a></span>';
        return $str;
    }


}