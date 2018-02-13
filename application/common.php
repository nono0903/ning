<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件

/**
 * 多维数组转化为一维数组
 * @param 多维数组
 * @return array 一维数组
 */
function array_multi2single($array)
{
    static $result_array = array();
    foreach ($array as $key=> $value) {
        if (is_array($value)) {
            array_multi2single($value);
        } else
            $result_array [$key] = $value;
    }
    return $result_array;
}


/**
 * Ajax返回信息
 * @param int $status
 * @param string $msg
 * @param string $data
 */
function jsonReturn($status=0,$msg='',$data=''){
    if(empty($data))
        $data = '';
    $info['status'] = !$status ? 1 : $status;
    $info['msg'] = $msg;
    $info['result'] = $data;
    exit(json_encode($info));
}

/*
 * 导航栏数据
 */
function navigate(){
    //todo 可将导航信息放进缓存
   return Cache::remember('name',function(){
        $data = Db::table('category')
            ->field('category_id,category_name,type')
            ->where('is_index',1)
            ->order('sort_order','desc')
            ->select();

        foreach ($data as $k =>$v){
            $data[$k]['sons'] = Db::table('category')
                ->field('category_id,category_name,type')
                ->where('parent_id',$v['category_id'])
                ->order('sort_order','desc')
                ->select();
        }

        return $data;
    
    });
    
}

/**
 * 公共底部
 * @return mixed
 */
function footer(){

    $type = input('type',false);
    if($type) $map[] = ['type','=',$type];
    $data = Db::table('blog_info')
        ->field('blog_id,title,pubtime,type')
        ->where($map)
        ->group('RAND()')
        ->limit(3)
        ->select();

    return $data;

}


/**
 * 生成缩略图
 * @param $id 主键
 * @param $width 缩略图宽
 * @param $height 缩略图高
 * @return string 生成图片路径
 */
function thumb_images($id, $width, $height,$url='')
{
    //todo 牵扯到一个部署权限的问题,需要创建777权限的upload/image/thumb
    if (!$id&&!$url) return '';

    if(!$url)$original_img = Db::table('blog_info')->where('blog_id',$id)->value('img');
    else $original_img = $url;
    if (empty($original_img)){
        return 'upload/img/sma583ac32a1e7c7.jpg';
    }

    //判断是否启用oss
    $ossConfig = Cache::get('oss');
    if ($ossConfig['oss_switch']) {

        $ossClient = new \app\common\logic\OssLogic;
        if (($ossUrl = $ossClient->getGoodsThumbImageUrl($original_img, $width, $height))) {
            return $ossUrl;
        }
    }

    //判断缩略图是否存在
    $path = "upload/image/thumb/$id/";
    $thumb_name = "thumb_{$id}_{$width}_{$height}";

    //这个缩略图 已经生成过这个比例的图片就直接返回了
    if (is_file($path . $thumb_name . '.jpg')) return '/' . $path . $thumb_name . '.jpg';
    if (is_file($path . $thumb_name . '.jpeg')) return '/' . $path . $thumb_name . '.jpeg';
    if (is_file($path . $thumb_name . '.gif')) return '/' . $path . $thumb_name . '.gif';
    if (is_file($path . $thumb_name . '.png')) return '/' . $path . $thumb_name . '.png';

    if (!is_file($original_img)) {
        return 'upload/img/sma583ac32a1e7c7.jpg';
    }
    try {

        $image = \think\Image::open($original_img);

        $thumb_name = $thumb_name . '.' . $image->type();
        // 生成缩略图
        !is_dir($path) && mkdir($path, 0777, true);
        $image->thumb($width, $height, 3)->save($path . $thumb_name, NULL, 100); //按照原图的比例生成一个最大为$width*$height的缩略图并保存
        //图片水印处理
        $water = Cache::get('water');
        if ($water['is_mark'] == 1) {
            $imgresource = './' . $path . $thumb_name;
            if ($width > $water['mark_width'] && $height > $water['mark_height']) {
                if ($water['mark_type'] == 'img') {
                    //检查水印图片是否存在
                    $waterPath = "." . $water['mark_img'];
                    if (is_file($waterPath)) {
                        $quality = $water['mark_quality'] ?: 80;
                        $waterTempPath = dirname($waterPath).'/temp_'.basename($waterPath);
                        $image->open($waterPath)->save($waterTempPath, null, $quality);
                        $image->open($imgresource)->water($waterTempPath, $water['sel'], $water['mark_degree'])->save($imgresource);
                        @unlink($waterTempPath);
                    }
                } else {
                    //检查字体文件是否存在,注意是否有字体文件
                    $ttf = './hgzb.ttf';
                    if (file_exists($ttf)) {
                        $size = $water['mark_txt_size'] ?: 30;
                        $color = $water['mark_txt_color'] ?: '#000000';
                        if (!preg_match('/^#[0-9a-fA-F]{6}$/', $color)) {
                            $color = '#000000';
                        }
                        $transparency = intval((100 - $water['mark_degree']) * (127/100));
                        $color .= dechex($transparency);
                        $image->open($imgresource)->text($water['mark_txt'], $ttf, $size, $color, $water['sel'])->save($imgresource);
                    }
                }
            }
        }
        $img_url = $path . $thumb_name;

        return $img_url;
    } catch (think\Exception $e) {

        return $original_img;
    }
}


