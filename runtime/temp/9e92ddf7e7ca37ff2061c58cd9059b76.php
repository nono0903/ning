<?php /*a:2:{s:59:"D:\phpStudy\WWW\tp5\application/admin/view\index\index.html";i:1518078027;s:59:"D:\phpStudy\WWW\tp5\application/admin/view\public\left.html";i:1518078026;}*/ ?>
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

<link rel="shortcut icon" type="image/x-icon" href="/static/images/close.png" media="screen"/>
<!--<link rel="shortcut icon" type="image/x-icon" href="__PUBLIC__/images/favicon.ico" media="screen"/>-->
<title>后台管理</title>

<script type="text/javascript">
  var SITEURL = window.location.host +'/index.php/admin';
</script>

<link href="/static/admincss/main.css" rel="stylesheet" type="text/css">
<link href="/static/adminjs/jquery-ui/jquery-ui.min.css" rel="stylesheet" type="text/css">
<link href="/static/font/css/font-awesome.min.css" rel="stylesheet" />
<script type="text/javascript" src="/static/adminjs/jquery.js"></script>
<script type="text/javascript" src="/static/adminjs/jquery-ui/jquery-ui.min.js"></script>
<script type="text/javascript" src="/static/adminjs/dialog/dialog.js" id="dialog_js"></script>
<script type="text/javascript" src="/static/adminjs/jquery.cookie.js"></script>
<script type="text/javascript" src="/static/adminjs/admincp.js"></script>
<script type="text/javascript" src="/static/adminjs/jquery.validation.min.js"></script>
<script src="/static/layer/layer.js"></script><!--弹窗js 参考文档 http://layer.layui.com/-->
</head>
<body>
<div class="admincp-header">
  <div class="bgSelector"></div>
  <div id="foldSidebar"><i class="fa fa-outdent" title="展开/收起侧边导航"></i></div>
  <div class="admincp-name" onClick="javascript:openItem('welcome|Index');">
    <img src="" alt="管理中心">
  </div>
  <div class="nc-module-menu">
    <ul class="nc-row">
      <li data-param="system"><a href="javascript:void(0);">系统</a></li>
      <li data-param="shop"><a href="javascript:void(0);">商城</a></li>
      <!--<li data-param="mobile"><a href="javascript:void(0);">模板</a></li>-->
      <!--<li data-param="resource"><a href="javascript:void(0);">插件</a></li>      -->
    </ul>
  </div>
  <div class="admincp-header-r">
    <div class="manager">
      
      <dl>
        <dt class="name"></dt>
        <dd class="group">ThinkPHP5框架开发</dd>
      </dl>    
      <dl>
        <dt class="name">名称</dt>
        <dd class="group">管理员</dd>
      </dl>
      <span class="avatar">
      <!-- 屏蔽管理员头像上传 -->
      <input name="_pic" type="file" class="admin-avatar-file" id="_pic" title="设置管理员头像"/>
      <img alt="" tptype="admin_avatar" src="/static/images/admint.png"> </span><i class="arrow" id="admin-manager-btn" title="显示快捷管理菜单"></i>
      <div class="manager-menu">
        <div class="title">
          <h4>最后登录</h4>
          <a href="javascript:void(0);" onClick="CUR_DIALOG = ajax_form('modifypw', '修改密码', '<?php echo Url('Admin/modify_pwd',array('admin_id'=>'')); ?>');" class="edit-password">修改密码</a> </div>
          <div class="login-date"> <?php echo date('Y-m-d H:i:s',cookie('last_login_time'));?> <span>(IP: <?php echo cookie('last_login_ip');?> )</span> </div>

      </div>
    </div>
    <ul class="operate nc-row">
      <li style="display: none !important;" tptype="pending_matters"><a class="toast show-option" href="javascript:void(0);" onClick="$.cookie('commonPendingMatters', 0, {expires : -1});ajax_form('pending_matters', '待处理事项', 'http://www.walhao.com/admin/index.php?act=common&op=pending_matters', '480');" title="查看待处理事项">&nbsp;<em>0</em></a></li>
      <!-- li><a class="sitemap show-option" tptype="map_on" href="javascript:void(0);" title="查看全部管理菜单">&nbsp;</a></li -->
      <!-- li><a class="style-color show-option" id="trace_show" href="javascript:void(0);" title="给管理中心换个颜色">&nbsp;</a></li -->
      <li><a class="sitemap show-option" id="trace_show" href="<?php echo Url('System/cleanCache'); ?>" target="workspace" title="更新缓存">&nbsp;</a></li>
      <li><a class="homepage show-option" target="_blank" href="/" title="新窗口打开商城首页">&nbsp;</a></li>
      <li><a class="login-out show-option" href="<?php echo Url('Admin/Admin/logout'); ?>" title="安全退出管理中心">&nbsp;</a></li>
    </ul>
  </div>
  <div class="clear"></div>
</div>
<div class="admincp-container unfold">
<div class="admincp-container-left">
    <div class="top-border"><span class="nav-side"></span><span class="sub-side"></span></div>
    <div id="admincpNavTabs_index" class="nav-tabs">
    	<dl>
		    <dt><a href="javascript:void(0);"><span class="ico-microshop-1"></span><h3>概览</h3></a></dt>
		    <dd class="sub-menu">
			    <ul>
				    <li><a href="javascript:void(0);" data-param="welcome|Index">系统后台</a></li>
			    </ul>
		    </dd>
	    </dl>
    </div>
    <?php if(is_array($menu) || $menu instanceof \think\Collection || $menu instanceof \think\Paginator): if( count($menu)==0 ) : echo "" ;else: foreach($menu as $mk=>$vo): ?>
    <div id="admincpNavTabs_<?php echo htmlentities($mk); ?>" class="nav-tabs">
    	<?php if(is_array($vo['child']) || $vo['child'] instanceof \think\Collection || $vo['child'] instanceof \think\Paginator): if( count($vo['child'])==0 ) : echo "" ;else: foreach($vo['child'] as $key=>$v2): ?>
	    <dl>
		    <dt><a href="javascript:void(0);"><span class="ico-<?php echo htmlentities($mk); ?>-<?php echo htmlentities($key); ?>"></span><h3><?php echo htmlentities($v2['name']); ?></h3></a></dt>
		    <dd class="sub-menu">
			    <ul>
			    	<?php if(is_array($v2['child']) || $v2['child'] instanceof \think\Collection || $v2['child'] instanceof \think\Paginator): if( count($v2['child'])==0 ) : echo "" ;else: foreach($v2['child'] as $key=>$v3): ?>
				    	<li><a href="javascript:void(0);" data-param="<?php echo htmlentities($v3['act']); ?>|<?php echo htmlentities($v3['op']); ?>"><?php echo htmlentities($v3['name']); ?></a></li>
				    <?php endforeach; endif; else: echo "" ;endif; ?>
			    </ul>
		    </dd>
	    </dl>
    	<?php endforeach; endif; else: echo "" ;endif; ?>
    </div>
    <?php endforeach; endif; else: echo "" ;endif; ?>
   </div>
  <div class="admincp-container-right">
    <div class="top-border"></div>
    <iframe src="" id="workspace" name="workspace" style="overflow: visible;" frameborder="0" width="100%" height="94%" scrolling="yes" onload="window.parent"></iframe>
  </div>
</div>
</body>
</html>