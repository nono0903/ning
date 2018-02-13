<?php /*a:4:{s:57:"D:\phpStudy\WWW\tp5\application/index/view\index\art.html";i:1518505382;s:59:"D:\phpStudy\WWW\tp5\application/index/view\public\head.html";i:1518078028;s:61:"D:\phpStudy\WWW\tp5\application/index/view\public\header.html";i:1518492763;s:61:"D:\phpStudy\WWW\tp5\application/index/view\public\footer.html";i:1518500963;}*/ ?>
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

<body class="single">
<!-- <div class="scanlines"></div> -->

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
					<li><a href="<?php echo url('/artlist',['id'=>$vo['category_id'],'type'=>$vo['type']]); ?>"><?php echo htmlentities($vo['category_name']); ?></a>
                        <ul>
                        <?php if(is_array($vo['sons']) || $vo['sons'] instanceof \think\Collection || $vo['sons'] instanceof \think\Paginator): if( count($vo['sons'])==0 ) : echo "" ;else: foreach($vo['sons'] as $key=>$v): ?>

                                <li><a href="<?php echo url('/artlist',['id'=>$v['category_id'],'type'=>$v['type']]); ?>"><?php echo htmlentities($v['category_name']); ?></a>

                        <?php endforeach; endif; else: echo "" ;endif; ?>
                         </ul>
					</li>					
                    <?php endforeach; endif; else: echo "" ;endif; ?>

					<li><a href="<?php echo url('/ct'); ?>">你猜这里是什么</a>
						<ul>
							<li><a href="<?php echo url('/co'); ?>">故事相册</a></li>
							<li>
                                <a href="<?php echo url('/viedo'); ?>">百撕不得姐</a>
                                <ul>
                                    <li><a href="<?php echo url('/jock'); ?>">段子</a></li>
                                    <li><a href="<?php echo url('/pict'); ?>">图片</a></li>
                                    <li><a href="<?php echo url('/viedo'); ?>">视频</a></li>
                                </ul>
                              </li>
						</ul>
					</li>
					<li><a href="<?php echo url('/contact'); ?>">联系方式</a></li>
				</ul>
			</div>
		</div>
		<div class="clear"></div>
	</div>
</div>
<!-- End Header -->

<!-- Begin Wrapper -->
<div class="wrapper"><!-- Begin Intro -->
<div class="intro">能自己动手去做的事就去做,别bb,别bb,别bb! </div>
<ul class="social">
</ul><!-- End Intro --> 

	<!-- Begin Main Image -->
	<div class="main-image" >
		<div class="outer">
			<span class="inset"><img src="<?php echo htmlentities($art['img']); ?>" alt="<?php echo htmlentities($art['title']); ?>" /></span>
		</div>
	</div>
	<!-- End Main Image --> 


<!-- Begin Container -->
<div class="content">

	<!-- Begin Post -->
	<div class="post format-image box"> 


		<div class="details">
			<span class="icon-image"><?php echo htmlentities(date("Y/m/d",!is_numeric($art['pubtime'])? strtotime($art['pubtime']) : $art['pubtime'])); ?></span>
			<span class="likes"><a href="javascript:void(0)" onclick="blikes(<?php echo htmlentities($art['blog_id']); ?>)" id="b<?php echo htmlentities($art['blog_id']); ?>"><?php echo htmlentities($art['likes']); ?></a></span>
			<span class="comments"><a href="#respond" ><?php echo htmlentities($art['click_count']); ?></a></span>
			
		</div>

			<h1 class="title"><?php echo htmlentities($art['title']); ?></h1>
			<?php echo htmlspecialchars_decode($art['article']); ?>

		
		<div class="tags">
		<?php if(is_array($art['tag']) || $art['tag'] instanceof \think\Collection || $art['tag'] instanceof \think\Paginator): if( count($art['tag'])==0 ) : echo "" ;else: foreach($art['tag'] as $key=>$ta): ?>
			<a href="<?php echo Url('/artlist',['tag_id'=>$ta['tag_id'],type=>$art['type']]); ?>"><?php echo cache($ta['tag_id']); ?> &nbsp;</a>
		<?php endforeach; endif; else: echo "" ;endif; ?>
		</div>


 </div>
		
		<div class="post-nav" id="flip">
			
			<div class="clear"></div>
		</div>

	</div>
	<!-- End Post --> 	
	
		<!-- Begin Comment Wrapper -->
	<div id="comment-wrapper" class="box">
		  
		  <!-- Begin Comments --> 
		 <div id="comments">           
		<!-- End Comments -->
		
		</div>
		<!-- End Form -->	
		
		
		
		<!-- End Comment Wrapper -->
	</div>

<!-- End Container -->

<!-- Begin Sidebar -->
<div class="sidebar box">
<!-- 图文模块 -->
  <div class="sidebox widget">
			<h3 class="widget-title">图文欣赏</h3>
			<ul class="post-list">
				<?php if(is_array($aside) || $aside instanceof \think\Collection || $aside instanceof \think\Paginator): if( count($aside)==0 ) : echo "" ;else: foreach($aside as $key=>$a): ?>
			  	<li> 
			  		<div class="frame">
			  			<a href="<?php echo Url('art',['id'=>$a['blog_id']]); ?>"><img src="<?php echo htmlentities(thumb_images($a['blog_id'],76,70,$a['thumb_img'])); ?>" style="width: 76px;height: 70px;"/></a>
			  		</div>
					<div class="meta">
					    <h6><a href="<?php echo Url('art',['id'=>$a['blog_id']]); ?>"><?php echo htmlentities($a['title']); ?></a></h6>
					    <em><?php echo htmlentities(date("Y/m/d",!is_numeric($a['pubtime'])? strtotime($a['pubtime']) : $a['pubtime'])); ?></em>
				    </div>
				</li>
				<?php endforeach; endif; else: echo "" ;endif; ?>
			</ul>
			
	</div>
<!-- 图文模块 -->
	<div class="sidebox widget">
		<h3 class="widget-title">推荐文章</h3>
		<ol>
		<?php if(is_array($artlist) || $artlist instanceof \think\Collection || $artlist instanceof \think\Paginator): if( count($artlist)==0 ) : echo "" ;else: foreach($artlist as $key=>$list): ?>
          <li><a href="<?php echo Url('art',['id'=>$list['blog_id']]); ?>"><?php echo htmlentities($list['title']); ?></a></li>
        <?php endforeach; endif; else: echo "" ;endif; ?>  
        </ol>
	</div>
	
	<div class="sidebox widget">
		
	</div>
	<div class="sidebox widget">
		
	</div>
	<div class="sidebox widget">
		<h3 class="widget-title">最新回复</h3>
		
	
	</div>
</div>
<!--End Sidebar -->
<div class="clear"></div>

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
	$('title').html("<?php echo htmlentities($art['title']); ?>");
	$(function(){
		$.ajax({
				type:'POST',
				data:{'id':<?php echo htmlentities($art['blog_id']); ?>,'type':<?php echo htmlentities($art['type']); ?>},
				dataType:'json',
				url:"/getPage",
				success:function(data){
				   $('#flip').empty().html(data);
				}
		});		
	})
</script>
</body>
</html>