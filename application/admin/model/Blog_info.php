<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/2/3 0003
 * Time: 13:32
 */

namespace app\admin\model;

use think\Model;
use think\Db;


class Blog_info extends Model
{
    protected $pk = 'blog_id';
    protected $_link = [];

    public function tags(){
    }

    public function getArticle($id)
    {
        $info = Db::table('blog_info')
            ->alias('b')
            ->rightJoin(['category'=>'c'],'b.category_id = c.category_id')
            ->rightJoin(['article'=>'a'],'b.blog_id = a.blog_id')
            ->field('b.*,c.parent_id,a.article')
            ->find($id);
        return $info;
    }

    public function article(){
        return $this->hasOne('Article','blog_id')->bind('article');
    }

    public function tag(){
        return $this->hasMany('ArticleTags','blog_id');
    }

    public function category(){
        return $this->hasOne('Category','category_id')->bind('category_name');
    }



}