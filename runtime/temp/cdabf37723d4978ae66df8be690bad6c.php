<?php /*a:4:{s:59:"D:\phpStudy\WWW\tp5\application/index/view\index\index.html";i:1518506860;s:59:"D:\phpStudy\WWW\tp5\application/index/view\public\head.html";i:1518078028;s:61:"D:\phpStudy\WWW\tp5\application/index/view\public\header.html";i:1518492763;s:61:"D:\phpStudy\WWW\tp5\application/index/view\public\footer.html";i:1518500963;}*/ ?>
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
<body>
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
<div class="wrapper">
    <div class="intro">人生路上,我们都是孤独的行者,如人饮水,冷暖自知真正能帮你的,永远只有你自己 </div>
    <div class="blog-wrap">
        <div class="blog-grid">
            <div class="post format-audio box">
                <div class="audio-wrapper">
                    <div class="vinyl">
                        <dl>
                            <dt class="art">
                                <img class="highlight" src="static/images/vinyl.png" />
                                <img src="static/images/art/yyn.png" alt="乐与怒" />
                            </dt>
                            <dd class="song"><div class="icon-song"></div>海阔天空 </dd>
                            <dd class="artist"><div class="icon-artist"></div> Beyond</dd>
                            <dd class="album"><div class="icon-album"></div> 1993《乐与怒》</dd>
                        </dl>
                    </div>
                    <div class="clear"></div>
                    <div class="audio">
                        <audio controls="" preload="none" src="upload\music\dk.mp3"></audio>
                    </div>
                </div>
                <p>1992年，Beyond将事业发展重心移至日本，同时结束了与新艺宝长期合作的关系。成为国际化的乐队一直是Beyond的梦想，不过由于日本对于音乐制作上的严格要求，加上语言不通，Beyond颇为消沉了一阵子，但他们仍然十分努力 。1993年5月底，Beyond从日本返回到了香港，这一年也正值Beyond成立十周年之际，于是黄家驹写下了这首记录Beyond十年心路历程的歌曲《海阔天空》，歌词承载了黄家驹与乐队赴日本发展的艰辛与对理想的坚持  ，并收录在粤语专辑《乐与怒》中。这首歌曲也表达了黄家驹内心深处对香港乐坛的挣扎和失望。</p>

                <div class="details">
                    <span class="icon-audio"><a href="#">2015/8/15</a></span>
                    <span class="likes"><a href="#" class="likes">156</a></span>
                    <span class="comments"><a href="#">75</a></span>
                </div>

            </div>

            <div class="post format-quote box">
                <blockquote><?php echo htmlentities($quote['content']); ?></cite></blockquote>
                <div class="details">
                    <span class="icon-quote"><a href="#"><?php echo htmlentities(date("Y/m/d",!is_numeric($quote['pubtime'])? strtotime($quote['pubtime']) : $quote['pubtime'])); ?></a></span>
                    <span class="likes"><a href="#" class="likes"><?php echo htmlentities($quote['likes']); ?></a></span>
                    <span class="comments"><a href="#"><?php echo htmlentities($quote['click_count']); ?></a></span>
                </div>
            </div>

            <?php if(is_array($blog) || $blog instanceof \think\Collection || $blog instanceof \think\Paginator): if( count($blog)==0 ) : echo "" ;else: foreach($blog as $key=>$vo): ?>
            <div class="post format-image box">
                <if condition ="$vo['img'] neq ''">
                    <div class="frame">
                        <a href="<?php echo Url('/art',['id'=>$vo['blog_id']]); ?>">
                            <img src="<?php echo htmlentities(thumb_images($vo['blog_id'],530,250,$vo['img'])); ?>" alt="<?php echo htmlentities($vo['title']); ?>"/>
                        </a>
                    </div>
                </if>
                <h2 class="title"><a href="<?php echo Url('/art',['id'=>$vo['blog_id']]); ?>"><?php echo htmlentities($vo['title']); ?></a></h2>
                <p> <?php echo htmlentities($vo['intro']); ?></p>
                <div class="details">
                    <span class="icon-image"><a href="#"><?php echo htmlentities(date("Y/m/d",!is_numeric($vo['pubtime'])? strtotime($vo['pubtime']) : $vo['pubtime'])); ?></a></span>
                    <span class="likes"><a href="javascript:void(0)" onclick="blikes(<?php echo htmlentities($vo['blog_id']); ?>)" id="b<?php echo htmlentities($vo['blog_id']); ?>"><?php echo htmlentities($vo['likes']); ?><span class="addone"></span></a></span>
                    <span class="comments"><a href="<?php echo Url('/art',['id'=>$vo['blog_id']]); ?>#respond" class="likes"><?php echo htmlentities($vo['click_count']); ?></a></span>
                </div>

            </div>
            <?php endforeach; endif; else: echo "" ;endif; ?>

            <div class="post format-video box">
                <!-- 自动播放<div class="video frame"><iframe src="__PUBLIC__/Upload/veido/a1.mp4" width="500" height="281" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div> -->
                <h2 class="title"><a href="Upload/veido/a1.mp4">最美中国大爷</a></h2>
                <video width="100%" height="281" src="upload/veido/a1.mp4" type="video/mp4"id="player2" poster="static/images/mv.png" controls="controls" preload="none"></video>
                <p>王德顺，1936年出生于沈阳，人体艺术大师、电影演员。
                    1960年，王德顺开始做话剧演员。1985年，王德顺开始研究形体哑剧。1987年，王德顺将中国的哑剧带上世界哑剧舞台；1993年，王德顺创造“活雕塑”。2003年，王德顺参演何平执导《天地英雄》。2008年,王德顺参演张新建执导《闯关东》，2012年,王德顺参演张扬执导《飞越老人院》。2014年，王德顺参演董阿成执导电影《判若云泥》，并入围萨兰托电影节[2]  。2015年，王德顺参演陈正道执导《重返20岁》； 3月25日，王德顺在中国国际时装周在北京798艺术中心上演，因79岁的王德顺身材没有走样，精神矍铄，其光膀走秀的图片昨天爆红网络。</p>

                <div class="details">
                    <span class="icon-video"><a href="#">2016/10/15</a></span>
                    <span class="likes"><a href="#" class="likes">18</a></span>
                    <span class="comments"><a href="#">25</a></span>
                </div>

            </div>

            <div class="post format-standard box">

                <h2 class="title"><a href="<?php echo Url('/tech_article',['id'=>$blog2['blog_id']]); ?>"><?php echo htmlentities($blog2['title']); ?></a></h2>
                <?php echo htmlentities($blog2['intro']); ?>

                <div class="details">
                    <span class="icon-standard"><a href="#"><?php echo htmlentities(date("Y/m/d",!is_numeric($blog2['pubtime'])? strtotime($blog2['pubtime']) : $blog2['pubtime'])); ?></a></span>
                    <span class="likes"><a href="javascript:void(0)" id = "t<?php echo htmlentities($blog2['blog_id']); ?>" onclick = "tlike(<?php echo htmlentities($blog2['blog_id']); ?>)" ><?php echo htmlentities($blog2['likes']); ?></a></span><span class="addone"></span>
                    <span class="comments"><a href="<?php echo Url('/tech_article',['id'=>$blog2['blog_id']]); ?>#respond"><?php echo htmlentities($blog2['click_count']); ?></a></span>
                </div>



            </div>

            <div class="post format-link box">

                <h2 class="title">内涵段子<span class="arrow">&rarr;</span></h2>
                <p><?php echo htmlentities($dz['text']); ?></p>

                <div class="details">
                    <span class="icon-link"><a href="#"><?php echo htmlentities($dz['create_time']); ?></a></span>
                    <span class="likes"><a href="#" class="likes"><?php echo htmlentities($dz['love']); ?></a></span>
                    <span class="comments"><a href="#"><?php echo htmlentities($dz['hate']); ?></a></span>
                </div>

            </div>

            <?php if(is_array($blogs3) || $blogs3 instanceof \think\Collection || $blogs3 instanceof \think\Paginator): if( count($blogs3)==0 ) : echo "" ;else: foreach($blogs3 as $key=>$blog3): ?>
                <div class="post format-chat box">
                    <div class="con">
                        <h2 class="title"><a href="<?php echo Url('/tech_article',['id'=>$blog3['blog_id']]); ?>"><?php echo htmlentities($blog3['title']); ?></a></h2>
                    </div>
                    <?php echo htmlspecialchars_decode($blog3['article']); ?>
                    <div class="details">
                        <span class="icon-chat"><a href="#"><?php echo htmlentities(date("Y/m/d",!is_numeric($blog3['pubtime'])? strtotime($blog3['pubtime']) : $blog3['pubtime'])); ?></a></span>
                        <span class="likes"><a href="javascript:void(0)" onclick="tlike(<?php echo htmlentities($blog3['blog_id']); ?>)" id = "t<?php echo htmlentities($blog3['blog_id']); ?>"><?php echo htmlentities($blog3['likes']); ?><span class="addone"></span></a></span>
                        <span class="comments"><a href="<?php echo Url('/tech_article',['id'=>$blog3['blog_id']]); ?>#respond"><?php echo htmlentities($blog3['click_count']); ?></a></span>
                    </div>

                </div>
            <?php endforeach; endif; else: echo "" ;endif; ?>

        </div>

    </div>

</div>

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



</body>
</html>