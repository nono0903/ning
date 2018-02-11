<?php /*a:4:{s:57:"D:\www\tp5\application/index/view\index\tech_article.html";i:1518069534;s:50:"D:\www\tp5\application/index/view\public\head.html";i:1516772885;s:52:"D:\www\tp5\application/index/view\public\header.html";i:1517798577;s:52:"D:\www\tp5\application/index/view\public\footer.html";i:1518067283;}*/ ?>
<!DOCTYPE HTML>
<html lang="en">
<!-- HTML5头文件 -->
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
<!-- HTML5头文件 -->
<body>
<!-- Begin Header -->
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
<!-- End Header -->

<!-- Begin Wrapper -->
<div class="wrapper"><!-- Begin Intro -->
<div class="intro">学,是一个漫长的过程,需要仔细体会学习的心得,并不像做事,注重的是结果.</div>
<!-- End Intro --> 

<!-- Begin Container -->
<div class="box">
 	<div class="post format-standard box"> 
	
		<h6 class="title">技术探讨></h6>
		<div class="details">
			<h1 class="title"style="text-align: center;"><?php echo htmlentities($techart['title']); ?></h1>
			<span class="icon-standard"><a href="#"><?php echo htmlentities(date("Y/m/d H:i",!is_numeric($techart['pubtime'])? strtotime($techart['pubtime']) : $techart['pubtime'])); ?></a></span>
			<span class="likes"><a href="javascript:void(0)" id = "t<?php echo htmlentities($techart['blog_id']); ?>" onclick = "tlike(<?php echo htmlentities($techart['blog_id']); ?>)" ><?php echo htmlentities($techart['likes']); ?><span class="addone"></span></a></span>
			<span class="comments"><a href="#respond"><?php echo htmlentities($techart['click_count']); ?></a></span>
		</div>
			<?php echo htmlspecialchars_decode($techart['article']); ?>
		
			
			<div class="tags">
			标签:
			<?php if(is_array($techart['tag']) || $techart['tag'] instanceof \think\Collection || $techart['tag'] instanceof \think\Paginator): if( count($techart['tag'])==0 ) : echo "" ;else: foreach($techart['tag'] as $key=>$tags): ?>
			<a href="#"><?php echo htmlentities($tags['tag_id']); ?></a>&nbsp;
			<?php endforeach; endif; else: echo "" ;endif; ?>
			</div>	
			<div class="ds-share flat" data-thread-key="tech<?php echo htmlentities($techart['blog_id']); ?>" data-title="<?php echo htmlentities($techart['title']); ?>" data-images="" data-content='<?php echo htmlentities($techart["article"]); ?>' data-url="http://91ning.com<?php echo Url('fullwith?id='.$techart['blog_id']); ?>">
    <div class="ds-share-inline">
      <ul  class="ds-share-icons-16">      	
      	<li data-toggle="ds-share-icons-more"><a class="ds-more" href="javascript:void(0);">分享到：</a></li>
        <li><a class="ds-weibo" href="javascript:void(0);" data-service="weibo">微博</a></li>
        <li><a class="ds-qzone" href="javascript:void(0);" data-service="qzone">QQ空间</a></li>
        <li><a class="ds-qqt" href="javascript:void(0);" data-service="qqt">腾讯微博</a></li>
        <li><a class="ds-wechat" href="javascript:void(0);" data-service="wechat">微信</a></li>
      	
      </ul>
      <div class="ds-share-icons-more">
      </div>
    </div>
 </div>
			
			<div class="post-nav">
				<span class="nav-prev"><a href="<?php echo Url('fullwith?id='.($techart['blog_id']-1)); ?>"id="pre">&larr; 上一篇</a></span>
				<span class="nav-next"><a href="<?php echo Url('fullwith?id='.($techart['blog_id']+1)); ?>" id='next'>下一篇 &rarr;</a></span>
				<div class="clear"></div>
			</div>
		</div>


		<div class="clear"></div>
			<!-- Begin Comment Wrapper -->
	<div id="comment-wrapper" class="box">
		  
		  <!-- Begin Comments --> 
		  <div id="comments">           
		<!-- End Comments -->
		<div id="comment-form" class="comment-form">
			<div id="respond">
				<h3 id="reply-title">发表评论:</h3>
				<!-- 多说评论框 start -->
			<div class="ds-thread" data-thread-key="tech<?php echo htmlentities($techart['blog_id']); ?>" data-title="<?php echo htmlentities($techart['title']); ?>" data-url="http://91ning.com<?php echo Url('fullwith?id='.$techart['blog_id']); ?>"></div>
				<!-- 多说评论框 end -->

			</div><!-- #respond -->		  	
		</div>
		<!-- End Form -->	
		
		
		</div>	
		<!-- End Comment Wrapper -->
	</div>

</div>
<!-- End Container -->

</div>
<!-- End Wrapper -->

<!-- Begin Footer -->
<!-- jQuery回顶部和建议 代码开始 -->
<div id="tbox"> <a id="togbook" href="<?php echo Url('contact'); ?>"></a> <a id="gotop" href="javascript:void(0)"></a> </div>
<!-- 代码结束 -->
<div class="footer-wrapper">
	<div id="footer" class="four">
		<div id="first" class="widget-area">
		
			<div class="widget widget_archive">
				<h3 class="widget-title">友情链接</h3>
				<ul>
					<li><a href="http://www.youxijia.top/">德玛西亚</a></li>
					<li><a href="http://huaban.com/fy3zasyd6x/pins/">中北小黑</a></li>
					<li><a href="https://www.juhe.cn/">聚合数据</a> </li>
					<li><a href="https://www.showapi.com/">易用源</a> </li>
					<li><a href="http://www.zixue.it/">自学it</a> </li>
					<li><a href="http://www.itbool.com/">布尔教育</a> </li>
				</ul>
			</div>	
		</div><!-- #first .widget-area -->
	
		<div id="second" class="widget-area">
				<h3 class="widget-title">呵呵吧</h3>
				<ul>
					<li><a href="http://www.gcopyright.cn/">诚迅版权</a></li>
					<li><a href="http://www.walhao.com/">沃好商城</a></li>
					<li><a href="#">老王商城</a></li>
					<li><a href="#">放心贷</a> </li>
					<li><a href="#">百度</a> </li>
				</ul>
		</div><!-- #second .widget-area -->
	
		<div id="third" class="widget-area">
		<div id="example-widget-3" class="widget example">
			<h3 class="widget-title">时光痕迹</h3>
			<ul class="post-list">		
			<?php if(is_array($foo) || $foo instanceof \think\Collection || $foo instanceof \think\Paginator): if( count($foo)==0 ) : echo "" ;else: foreach($foo as $key=>$a): ?>
			  	<li> 
			  		<div class="frame">
			  			<a href="<?php echo url('art',['id'=>$a['blog_id'],'type'=>$a['type']]); ?>"><img src="<?php echo htmlentities(thumb_images($a['blog_id'],76,70)); ?>" style="width: 76px;height: 70px;"/></a>
			  		</div>
					<div class="meta">
					    <h6><a href="<?php echo url('art',['id'=>$a['blog_id'],'type'=>$a['type']]); ?>"><?php echo htmlentities($a['title']); ?></a></h6>
					    <em><?php echo htmlentities(date("Y/m/d",!is_numeric($a['pubtime'])? strtotime($a['pubtime']) : $a['pubtime'])); ?></em>
				    </div>
				</li>
				<?php endforeach; endif; else: echo "" ;endif; ?>
			</ul>
			
		</div>
		</div><!-- #third .widget-area -->
		
		<div id="fourth" class="widget-area">
		<div class="widget">
			<h3 class="widget-title">微信</h3>
			<img src="static/images/qrcode.jpg" width="150px"height="150px" alt="">
			<script type="text/javascript">var cnzz_protocol = (("https:" == document.location.protocol) ? " https://" : " http://");document.write(unescape("%3Cspan id='cnzz_stat_icon_1261127375'%3E%3C/span%3E%3Cscript src='" + cnzz_protocol + "s4.cnzz.com/z_stat.php%3Fid%3D1261127375%26show%3Dpic1' type='text/javascript'%3E%3C/script%3E"));</script>			
		</div>
		</div><!-- #fourth .widget-area -->
	</div>

</div>

<div class="site-generator-wrapper">
	<div class="site-generator">
		

	<span>&copy; Ning|寜&nbsp;&nbsp; Design by <a href="91ning.com">Ning</a>&nbsp;&nbsp;基于ThinkPHP制作&nbsp;&nbsp;QQ:976383555&nbsp;&nbsp;Email:nono0903@gmail.com</div></span>
</div>

<!--&lt;!&ndash; 多说公共JS代码 start (一个网页只需插入一次) &ndash;&gt;-->
<!--<script type="text/javascript">-->
<!--var duoshuoQuery = {short_name:"nono0903"};-->
	<!--(function() {-->
		<!--var ds = document.createElement('script');-->
		<!--ds.type = 'text/javascript';ds.async = true;-->
		<!--ds.src = (document.location.protocol == 'https:' ? 'https:' : 'http:') + '//static.duoshuo.com/embed.js';-->
		<!--ds.charset = 'UTF-8';-->
		<!--(document.getElementsByTagName('head')[0] -->
		 <!--|| document.getElementsByTagName('body')[0]).appendChild(ds);-->
	<!--})();-->
<!--</script>-->
<!--&lt;!&ndash; 多说公共JS代码 end &ndash;&gt;-->
<!-- 添加喜欢js公共代码 start-->
	<script>
		
		function blikes(id){
			var url = '/index.php/home/index/likethis?id='+id;
			$.get(url,function (data){
				//console.log(data.likethis);
				$('#b' + id).fadeOut(500).fadeIn(500,function(){
					
					$('#b' + id).html(data.likethis);
				});
			},'json')
		}

		function tlike(id){
				var url = '/index.php/home/index/techlike?id='+id;
			$.get(url,function (data){
				//console.log(data.likethis);
				$('#t' + id).fadeOut(500).fadeIn(500,function(){
					$('#t' + id).html(data.likethis);
				});
			},'json')
		}
		
	</script>
<!-- 添加喜欢js公共代码 end-->
 
<script type="text/javascript" src="static/js/scripts.js"></script>


<!-- End Footer --> 

<script>
	$('title').html('<?php echo htmlentities($techart['title']); ?>');
</script>

</body>
</html>