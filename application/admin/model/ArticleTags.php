<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/2/3 0003
 * Time: 16:17
 */

namespace app\admin\model;

use think\Model;


class ArticleTags extends Model
{
    public function blogInfo(){
        return $this->belongsTo('Blog_info');
    }


}