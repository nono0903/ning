<?php /*a:3:{s:52:"D:\www\tp5\application/index/view\index\artlist.html";i:1518073704;s:50:"D:\www\tp5\application/index/view\public\head.html";i:1516772885;s:52:"D:\www\tp5\application/index/view\public\header.html";i:1517798577;}*/ ?>
<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
    <title>NingBlog</title>
    <meta name="keywords" content="寜的博客,ning,NingBlog,自适应,透明，瀑布流,宁"/>
    <meta name="description" content="寜的全端自适应博客" />
    <link rel="stylesheet"  media="all" href="static/css/style.css" />
    <link rel="stylesheet" type="text/css" href="static/css/media-queries.css" />
    <link rel="stylesheet" type="text/css" href="static/js/player/mediaelementplayer.css" />
    <link rel="stylesheet" type="text/css" href="static/css/lrtk.css"  />
    <!-- js -->
    <!-- jquery-1.7.2. -->
    <script type="text/javascript" src="static/js/jquery-1.7.2.min.js"></script>
    <!-- ddsmoothmenu.js制作下拉菜单 -->
    <script type="text/javascript" src="static/js/ddsmoothmenu.js"></script>
    <!-- Retina.js 检查网页中的图片看是否存在高清的版本,如果有将会替换显示。 -->
    <!-- <script type="text/javascript" src="static/js/retina.js"></script> -->
    <!-- 响应下拉导航SelectNav.js -->
    <script type="text/javascript" src="static/js/selectnav.js"></script>
    <!-- jQuery瀑布流插件 Masonry -->
    <script type="text/javascript" src="static/js/jquery.masonry.min.js"></script>
    <!-- 流媒体视频播放 jQuery插件 Fitvids.js -->
    <script type="text/javascript" src="static/js/jquery.fitvids.js"></script>
    <!-- Backstretch动态设置背景图片 -->
    <script type="text/javascript" src="static/js/jquery.backstretch.min.js"></script>
    <!-- HTML5播放器 MediaElement -->
    <script type="text/javascript" src="static/js/mediaelement.min.js"></script>
    <!-- 自动播放MediaElementPlayer + -->
    <script type="text/javascript" src="static/js/mediaelementplayer.min.js"></script>
    <!-- 引入网站背景图片 -->
    <script type="text/javascript">
        $.backstretch("static/images/bg/1.jpg","static/images/bg/2.jpg");

    </script>
    <!-- 右下角回顶部,留言小插件 -->
    <script type="text/javascript" src="static/js/js.js"></script>
</head>
<body class="single">
<div class="scanlines"></div>
<div class="scanlines"></div>
<div class="header-wrapper opacity">
	<div class="header">
		<div class="logo">
		    <a href="/">
				<!--<img src="static/images/logo.png" alt="NingBlog" />-->
			</a>
	    </div>
		<div id="menu-wrapper">
			<div id="menu" class="menu">
				<ul id="tiny">
					<li class="active"><a href="/">首页</a></li>
                    <?php if(is_array($navigate) || $navigate instanceof \think\Collection || $navigate instanceof \think\Paginator): if( count($navigate)==0 ) : echo "" ;else: foreach($navigate as $key=>$vo): ?>
					<li><a href="<?php echo url('/artlist',['id'=>$vo['category_id'],type=>$vo['type']]); ?>"><?php echo htmlentities($vo['category_name']); ?></a>
                        <ul>
                        <?php if(is_array($vo['sons']) || $vo['sons'] instanceof \think\Collection || $vo['sons'] instanceof \think\Paginator): if( count($vo['sons'])==0 ) : echo "" ;else: foreach($vo['sons'] as $key=>$v): ?>

                                <li><a href="<?php echo url('/artlist',['id'=>$v['category_id'],type=>$v['type']]); ?>"><?php echo htmlentities($v['category_name']); ?></a>

                        <?php endforeach; endif; else: echo "" ;endif; ?>
                         </ul>
					</li>					
                    <?php endforeach; endif; else: echo "" ;endif; ?>

					<li><a href="<?php echo url('ct'); ?>">你猜这里是什么</a>
						<ul>
							<li><a href="<?php echo url('co'); ?>">故事相册</a></li>
							<li>
                                <a href="<?php echo url('viedo'); ?>">百撕不得姐</a>
                                <ul>
                                    <li><a href="<?php echo url('jock'); ?>">段子</a></li>
                                    <li><a href="<?php echo url('pict'); ?>">图片</a></li>
                                    <li><a href="<?php echo url('viedo'); ?>">视频</a></li>
                                </ul>
                              </li>
						</ul>
					</li>
					<li><a href="<?php echo url('contact'); ?>">联系方式</a></li>
				</ul>
			</div>
		</div>
		<div class="clear"></div>
	</div>
</div>
<!-- Begin Wrapper -->
<div class="wrapper"><!-- Begin Intro -->
<div class="intro">能自己动手去做的事就去做,别bb,别bb,别bb! </div>
<ul class="social">
</ul><!-- End Intro --> 

	<!-- Begin Main Image -->
	<!-- <div class="main-image">
		<div class="outer">
			<span class="inset"><img src="__PUBLIC__/Home/images/art/post1-full.jpg" alt="" /></span>
		</div>
	</div> -->
	<!-- End Main Image --> 

<!-- Begin Container -->
<div class="content">

		<!-- Begin Post -->
		<?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): if( count($list)==0 ) : echo "" ;else: foreach($list as $key=>$v): ?>
		<div class="post format-image box"> 

			<div class="details">
				<span class="icon-image"><?php echo htmlentities(date("Y/m/d H:i:s",!is_numeric($v['pubtime'])? strtotime($v['pubtime']) : $v['pubtime'])); ?></span>
				<span class="likes"><a href="javascript:void(0)" onclick="blikes(<?php echo htmlentities($v['blog_id']); ?>)" id="b<?php echo htmlentities($v['blog_id']); ?>"><?php echo htmlentities($v['likethis']); ?><span class="addone"></span></a></span>
				<span class="comments"><a href="<?php echo Url('art',['id'=>$v['blog_id']]); ?>#respond"><?php echo htmlentities($v['click_count']); ?></a></span>
			</div>
			<!-- 插图 -->
		  <if condition ="$blog1['thumb_img1'] neq ''">			
			<div class="frame">
				<a href="<?php echo Url('art',['id'=>$v['blog_id']]); ?>">
					<img src="<?php echo htmlentities($v['thumb_img1']); ?>" alt="<?php echo htmlentities($v['title']); ?>" style="margin:0px auto;"/>
				</a>
			</div>
			<!-- 插图 -->

			<h1 class="title"><a href="<?php echo Url('art',['id'=>$v['blog_id']]); ?>"><?php echo htmlentities($v['title']); ?></a></h1>
			<p><?php echo htmlentities($v['intro']); ?></p>
		
			<div class="tags"><a href=""><?php echo htmlentities($v['cat_name']); ?></a> </div>	
			
			<div class="post-nav">
				<span class="nav-prev"><a href="#"></a></span>
				<span class="nav-next"><a href="<?php echo Url('art',['id'=>$v['blog_id']]); ?>">阅读文章</a></span>
				<div class="clear"></div>
			</div>

		</div>
		<?php endforeach; endif; else: echo "" ;endif; ?>
		<div class="post-nav">
				<?php echo htmlentities($page); ?>
				<div class="clear"></div>
			</div>
		<!-- End Post --> 		
</div>

<!-- End Container -->

<!-- Begin Sidebar -->
<div class="sidebar box">

	
	<div class="sidebox widget">
		<h3 class="widget-title">推荐文章</h3>
		<ol>
		<?php if(is_array($artlist) || $artlist instanceof \think\Collection || $artlist instanceof \think\Paginator): if( count($artlist)==0 ) : echo "" ;else: foreach($artlist as $key=>$list): ?>
          <li><a href="<?php echo Url('art',['id'=>$list['blog_id']]); ?>"><?php echo htmlentities($list['title']); ?></a></li>
        <?php endforeach; endif; else: echo "" ;endif; ?>
        </ol>
	</div>
 <!-- 搜索 -->
	<div class="sidebox widget">
		<h3 class="widget-title">Search</h3>
		<form class="searchform" method="get" action="#">
			<input type="text" name="s" placeholder="Search..." />
		</form>
	</div>
 <!-- 搜索 -->

	<!-- 图文模块 -->
	<div class="sidebox widget">
			<h3 class="widget-title">图文欣赏</h3>
			<ul class="post-list">
				<foreach name="aside" item="a">
			  	<li> 
			  		<div class="frame">
			  			<a href="<?php echo Url('art',['id'=>$a['blog_id']]); ?>"><img src="<?php echo htmlentities($a['thumb_img']); ?>" style="width: 76px;height: 70px;"/></a>
			  		</div>
					<div class="meta">
					    <h6><a href="<?php echo Url('art',['id'=>$a['blog_id']]); ?>"><?php echo htmlentities($a['title']); ?></a></h6>
					    <em><?php echo htmlentities(date("Y/m/d",!is_numeric($a['pubtime'])? strtotime($a['pubtime']) : $a['pubtime'])); ?></em>
				    </div>
				</li>
				</foreach>
			</ul>
			
	</div>
	<!-- 图文模块 -->

</div>
<!--End Sidebar -->



<div class="clear"></div>

</div>
<!-- End Wrapper -->

<!-- Begin Footer -->
<include file="public/footer"/>
<!-- End Footer --> 
</body>

</html>