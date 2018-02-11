<?php /*a:2:{s:59:"D:\www\tp5\application/admin/view\index\addEditArticle.html";i:1517711754;s:52:"D:\www\tp5\application/admin/view\public\layout.html";i:1517366150;}*/ ?>
<!doctype html>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<!-- Apple devices fullscreen -->
<meta name="apple-mobile-web-app-capable" content="yes">
<!-- Apple devices fullscreen -->
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
<link href="/static/admincss/main.css" rel="stylesheet" type="text/css">
<link href="/static/admincss/page.css" rel="stylesheet" type="text/css">
<link href="/static/font/css/font-awesome.min.css" rel="stylesheet" />
<!--[if IE 7]>
  <link rel="stylesheet" href="/static/font/css/font-awesome-ie7.min.css">
<![endif]-->
<link href="/static/adminjs/jquery-ui/jquery-ui.min.css" rel="stylesheet" type="text/css"/>
<link href="/static/adminjs/perfect-scrollbar.min.css" rel="stylesheet" type="text/css"/>
<style type="text/css">html, body { overflow: visible;}</style>
<script type="text/javascript" src="/static/adminjs/jquery.js"></script>
<script type="text/javascript" src="/static/adminjs/jquery-ui/jquery-ui.min.js"></script>
<script type="text/javascript" src="/static/layer/layer.js"></script><!-- 弹窗js 参考文档 http://layer.layui.com/-->
<script type="text/javascript" src="/static/adminjs/admin.js"></script>
<script type="text/javascript" src="/static/adminjs/jquery.validation.min.js"></script>
<script type="text/javascript" src="/static/adminjs/common.js"></script>
<script type="text/javascript" src="/static/adminjs/perfect-scrollbar.min.js"></script>
<script type="text/javascript" src="/static/adminjs/jquery.mousewheel.js"></script>
<script src="/static/adminjs/myFormValidate.js"></script>
<script src="/static/adminjs/myAjax2.js"></script>
<script src="/static/adminjs/global.js"></script>
</head>
<!--以下是在线编辑器 代码 -->
<script type="text/javascript" src="/static/plugins/Ueditor/ueditor.config.js"></script><script type="text/javascript" src="/static/plugins/Ueditor/ueditor.all.min.js"></script><script type="text/javascript" src="/static/plugins/Ueditor/lang/zh-cn/zh-cn.js"></script>
<!--以上是在线编辑器 代码  end-->
<body style="background-color: #FFF; overflow: auto;">
<div id="append_parent"></div>
<div id="ajaxwaitid"></div>
<div class="page">
    <div class="fixed-bar">
        <div class="item-title">
            <div class="subject">
                <h3>商品设置</h3>
                <h5>商品基本信息设置</h5>
            </div>
        </div>
    </div>
    <!--表单数据-->
    <form method="post" id="addEditGoodsForm" action="">
        <input type="hidden" name="blog_id" value="<?php echo htmlentities($blog['blog_id']); ?>" class="input-txt"/>
        <!--通用信息-->
        <div class="ncap-form-default tab_div_1">
            <dl class="row">
                <dt class="tit">
                    <label for="record_no">标题:</label>
                </dt>
                <dd class="opt">
                    <input type="text" value="<?php echo htmlentities($blog['title']); ?>" name="title" />
                    <span class="err" id="err_title" style="color:#F00; display:none;"></span>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label>类型:</label>
                </dt>
                <dd class="opt">
                    <div class="onoff">
                        <label for="type1" class="cb-enable <?php if($article['type'] == 1): ?>selected<?php endif; ?>">生活</label>
                        <label for="type0" class="cb-disable <?php if($article['type'] == 2): ?>selected<?php endif; ?>">技术</label>
                        <input id="type1" name="type" value="1" onclick="getTag(this.value)" type="radio" <?php if($article['type'] == 1): ?> checked="checked"<?php endif; ?>>
                        <input id="type0" name="type" onclick="getTag(this.value)" value="2" type="radio" <?php if($article['type'] == 2): ?> checked="checked"<?php endif; ?>>
                    </div>
                    <p class="notic"></p>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label for="store_name">简介</label>
                </dt>
                <dd class="opt" >
                    <textarea style="height:100px" rows="5" cols="80" name="intro" ><?php echo htmlentities($blog['intro']); ?></textarea>
                    <span id="err_intro" class="err" style="color:#F00; display:none;"></span>
                </dd>
            </dl>

            <dl class="row">
                <dt class="tit">
                    <label for="record_no">分类</label>
                </dt>
                <dd class="opt">
                    <select name="cat_id1" id="cat_id1" onChange="get_category(this.value,'cat_id2','0');" class="small form-control">
                        <?php if($article['parent_id'] == 0): ?>
                        <option value="0" selected>顶级分类</option>

                        <?php endif; if(is_array($category) || $category instanceof \think\Collection || $category instanceof \think\Paginator): if( count($category)==0 ) : echo "" ;else: foreach($category as $k=>$v): ?>
                            <option value="<?php echo htmlentities($v['category_id']); ?>" <?php if($v['category_id'] == $article['parent_id']): ?>selected="selected"<?php endif; ?> >
                            <?php echo htmlentities($v['category_name']); ?>
                            </option>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </select>
                    <select name="category_id" id="cat_id2"  class="small form-control">
                        <option value="0">请选择商品分类</option>
                    </select>
                </dd>
            </dl>

            <dl class="row">
                <dt class="tit">
                    <label>图片上传</label>
                </dt>
                <dd class="opt">
                    <div class="input-file-show">
            <span class="show">
                <a id="img_a" target="_blank" class="nyroModal" rel="gal" href="<?php echo htmlentities($blog['thumb_img']); ?>">
                    <i id="img_i" class="fa fa-picture-o" onmouseover="layer.tips('<img src=<?php echo htmlentities($blog['thumb_img']); ?>>',this,{tips: [1, '#fff']});" onmouseout="layer.closeAll();"></i>
                </a>
            </span>
                        <span class="type-file-box">
                <input type="text" id="imagetext" name="img" value="<?php echo htmlentities($blog['thumb_img']); ?>" class="type-file-text">
                <input type="button" name="button" id="button1" value="选择上传..." class="type-file-button">
                <input class="type-file-file" onClick="GetUploadify(1,'','img','img_call_back')" size="30" hidefocus="true" nc_type="change_site_logo" title="点击前方预览图可查看大图，点击按钮选择文件并提交表单后上传生效">
            </span>
                    </div>
                    <span class="err"></span>
                    <p class="notic">上传图片格式文件</p>
                </dd>
            </dl>

            <dl class="row">
                <dt class="tit">
                    <label>推送主页</label>
                </dt>
                <dd class="opt">
                    <div class="onoff">
                        <label for="is_index1" class="cb-enable <?php if($blog[is_index] == 1): ?>selected<?php endif; ?>">是</label>
                        <label for="is_index0" class="cb-disable <?php if($blog[is_index] == 0): ?>selected<?php endif; ?>">否</label>
                        <input id="is_index1" name="is_index" value="1" type="radio" <?php if($blog[is_index] == 1): ?> checked="checked"<?php endif; ?>>
                        <input id="is_index0" name="is_index" value="0" type="radio" <?php if($blog[is_index] == 0): ?> checked="checked"<?php endif; ?>>
                    </div>
                    <p class="notic"></p>
                </dd>
            </dl>

            <dl class="row">
                <dt class="tit">
                    <label for="record_no">关键词</label>
                </dt>
                <dd class="opt">
                    <input type="text" value="<?php echo htmlentities($blog['keywords']); ?>" name="keywords" class="input-txt"/>
                    <span class="err" id="err_keywords" style="color:#F00; display:none;"></span>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label for="record_no">Tags</label>
                </dt>
                <dd class="opt" id="ajax_tags">

                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label for="record_no">详情描述</label>
                </dt>

                <dd class="opt">

                    <textarea class="span12 ckeditor" id="content" name="article" title=""><?php echo htmlentities(htmlspecialchars_decode($blog['article'])); ?></textarea>
                    <span class="err" id="err_content" style="color:#F00; display:none;"></span>
                </dd>
            </dl>
        </div>
        <!--通用信息-->

        <div class="ncap-form-default">
            <div id="useTag"></div>
            <div class="bot">
                <input type="hidden" name="__token__" value="<?php echo htmlentities(app('request')->token()); ?>" />
                <input class="ncap-btn-big ncap-btn-green" type="submit" value="确认提交">
                <!--<a href="JavaScript:void(0);" class="ncap-btn-big ncap-btn-green" onClick="ajax_submit_form('addEditGoodsForm','<?php echo Url('Goods/addEditGoods?is_ajax=1'); ?>');"><submit>确认提交</submit></a>-->
            </div>
        </div>
    </form>
    <!--表单数据-->
</div>
<div id="goTop"> <a href="JavaScript:void(0);" id="btntop"><i class="fa fa-angle-up"></i></a><a href="JavaScript:void(0);" id="btnbottom"><i class="fa fa-angle-down"></i></a></div>
<script>


    var url="<?php echo url('/Ueditor',array('savePath'=>'Blog')); ?>";
    var ue = UE.getEditor('content',{
        serverUrl :url,
        zIndex: 999,
        initialFrameWidth: "100%", //初化宽度
        initialFrameHeight: 300, //初化高度
        focus: false, //初始化时，是否让编辑器获得焦点true或false
        maximumWords: 99999, removeFormatAttributes: 'class,style,lang,width,height,align,hspace,valign',//允许的最大字符数 'fullscreen',
        pasteplain:false, //是否默认为纯文本粘贴。false为不使用纯文本粘贴，true为使用纯文本粘贴
        autoHeightEnabled: true
    });


    /** 以下是编辑时默认选中某个商品分类*/
    $(document).ready(function(){

        // 商品分类第二个下拉菜单
        get_category('<?php echo htmlentities($article["parent_id"]); ?>','cat_id2','<?php echo htmlentities($article["category_id"]); ?>');
        getTag('<?php echo htmlentities($blog['type']); ?>');
    });


    function img_call_back(fileurl_tmp)
    {
        $("#imagetext").val(fileurl_tmp);
        $("#img_a").attr('href', fileurl_tmp);
        $("#img_i").attr('onmouseover', "layer.tips('<img src="+fileurl_tmp+">',this,{tips: [1, '#fff']});");
    }

    function getTag(o){
        $.ajax({
            type:'GET',
            url:"/getTags&type="+o+'&id='+'<?php echo htmlentities($blog['blog_id']); ?>',
            success:function(data){
                $("#ajax_tags").html('');
                $("#ajax_tags").append(data);
            }
        });




    }

</script>
</body>
</html>