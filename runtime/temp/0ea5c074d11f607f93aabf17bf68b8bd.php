<?php /*a:2:{s:65:"D:\phpStudy\WWW\tp5\application/admin/view\index\articlelist.html";i:1518078027;s:61:"D:\phpStudy\WWW\tp5\application/admin/view\public\layout.html";i:1518078026;}*/ ?>
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
<script type="text/javascript" src="/static/layer/laydate/laydate.js"></script>
<body style="background-color: rgb(255, 255, 255); overflow: auto; cursor: default; -moz-user-select: inherit;">
<div id="append_parent"></div>
<div id="ajaxwaitid"></div>
<div class="page">
  <div class="fixed-bar">
    <div class="item-title">
      <div class="subject">
        <h3>文章管理</h3>
        <h5>文章列表</h5>
      </div>
    </div>
  </div>
  <!-- 操作说明 -->
  <div class="flexigrid">
    <div class="mDiv">
      <div class="ftitle">
        <h3>文章列表</h3>
        <h5>(共<?php echo htmlentities($page->totalRows); ?>条记录)</h5>
      </div>
      <div title="刷新数据" class="pReload"><i class="fa fa-refresh"></i></div>
	  <form class="navbar-form form-inline"  method="post" action="<?php echo Url('Admin/order/export_order'); ?>"  name="search-form2" id="search-form2">  
	  		<input type="hidden" name="order_by" value="blog_id">
            <input type="hidden" name="sort" value="desc">
            <!--用于查看结算统计 包含了哪些订单-->

      <div class="sDiv">
        <div class="sDiv2">
        	<input type="text" size="30" id="add_time_begin" name="add_time_begin" value="" class="qsbox"  placeholder="下单开始时间">
        </div>
        <div class="sDiv2">
        	<input type="text" size="30" id="add_time_end" name="add_time_end" value="" class="qsbox"  placeholder="下单结束时间">
        </div>
        <div class="sDiv2">	 
        	<select name="type" class="select" style="width:100px;margin-right:5px;margin-left:5px" onchange="getCategorys(this.value)">
                    <option value="">文章类型</option>
                    <option value="1">生活</option>
        			<option value="2">技术</option>
            </select>
        </div>
        <div class="sDiv2">	   
            <select name="category" id="category" class="select" style="width:100px;margin-right:5px;margin-left:5px">
                <option value="-1">分类</option>
             </select>
         </div>
         <div class="sDiv2">	 
          <input type="text" size="30" name="keywords" class="qsbox" placeholder="搜索相关数据...">
        </div>
        <div class="sDiv2">	 
          <input type="button" onclick="ajax_get_table('search-form2',1)"  class="btn" value="搜索">
        </div>
      </div>
     </form>
    </div>
      <div class="hDiv">

              <table cellspacing="0" cellpadding="0" >
                  <thead>
                  <tr>
                      <th class="sign" axis="col0">
                          <div style="width: 24px;"><i class="ico-check"></i></div>
                      </th>
                      <th align="left" abbr="order_sn" axis="col1" >
                          <div style="text-align: center; width: 40px;" >Id</div>
                      </th>
                      <th align="left" abbr="consignee" axis="col2" class="">
                          <div style="text-align: center; width: 120px;" >Title</div>
                      </th>
                      <th align="center" abbr="article_show" axis="col3">
                          <div style="text-align: center; width: 60px;" >分类</div>
                      </th>
                      <th align="center" abbr="article_time" axis="col4" >
                          <div style="text-align: center; width: 60px;" >评论</div>
                      </th>
                      <th align="center" abbr="article_time" axis="col5" >
                          <div style="text-align: center; width: 60px;" >收藏</div>
                      </th>
                      <th align="center" abbr="article_time" axis="col6">
                          <div style="text-align: center; width: 60px;" >点击</div>
                      </th>
                      <th align="center" abbr="article_time" axis="col7">
                          <div style="text-align: center; width: 60px;" >显示</div>
                      </th>
                      <th>
                          <div style="text-align: center; width: 60px;" >首页</div>
                      </th>

                      <th align="center" abbr="article_time" axis="col8" >
                          <div style="text-align: center; width: 120px;" >下单时间</div>
                      </th>
                      <th align="left" axis="col1" axis="col9" class="handle">
                          <div style="text-align: left; width: 40px;">操作</div>
                      </th>


                  </tr>
                  </thead>
              </table>

      </div>
    <div class="tDiv">
      <div class="tDiv2">
        <div class="fbutton"> 
        	<a href="javascript:exportReport()">
	          	<div class="add" title="选定行数据导出excel文件,如果不选中行，将导出列表所有数据">
	            	<span><i class="fa fa-plus"></i>导出数据</span>
	          	</div>
          	</a> 
          </div>
          <div class="fbutton">
        	<a href="<?php echo Url('/addEditArticle'); ?>">
	          	<div class="add" title="发布文章">
	            	<span><i class="fa fa-plus"></i>发布文章</span>
	          	</div>
          	</a>
          </div>
      </div>
      <div style="clear:both"></div>
    </div>
    <div class="bDiv" style="height: auto;">
      <div id="flexigrid" cellpadding="0" cellspacing="0" border="0">
        
      </div>
      <div class="iDiv" style="display: none;"></div>
    </div>
    <!--分页位置--> 
   	</div>
</div>
<script type="text/javascript">

	 
    $(document).ready(function(){	
	   
     	$('#add_time_begin').layDate(); 
     	$('#add_time_end').layDate();
     	
		// 点击刷新数据
		$('.fa-refresh').click(function(){
			location.href = location.href;
		});
		
		ajax_get_table('search-form2',1);
		
		$('.ico-check ' , '.hDivBox').click(function(){
			$('tr' ,'.hDivBox').toggleClass('trSelected' , function(index,currentclass){
	    		var hasClass = $(this).hasClass('trSelected');
	    		$('tr' , '#flexigrid').each(function(){
	    			if(hasClass){
	    				$(this).addClass('trSelected');
	    			}else{
	    				$(this).removeClass('trSelected');
	    			}
	    		});  
	    	});
		});
		 
	});
    
    
  	//ajax 抓取页面
    function ajax_get_table(tab,p){

        $.ajax({
                type : "POST",
                url:"/ajax_article_list?page="+p,//+tab,
                data : $('#'+tab).serialize(),// 你的formid
                success: function(data){
                    $("#flexigrid").html('');
                    $("#flexigrid").append(data);
                    
                	// 表格行点击选中切换
            	    $('#flexigrid > table>tbody >tr').click(function(){
            		    $(this).toggleClass('trSelected');
            		});
                	 
                }
            });
    }
	
 // 点击排序
    function sort(field){
        $("input[name='order_by']").val(field);
        var v = $("input[name='sort']").val() == 'desc' ? 'asc' : 'desc';
        $("input[name='sort']").val(v);
        ajax_get_table('search-form2',1);
    }
	
	function exportReport(){
        var selected_ids = '';
        $('.trSelected' , '#flexigrid').each(function(i){
            selected_ids += $(this).data('order-id')+',';
        });
        if(selected_ids != ''){
            $('input[name="order_ids"]').val(selected_ids.substring(0,selected_ids.length-1));
        }
		$('#search-form2').submit();
	}

	function getCategorys(o){

        var url = '/getCategoryOpt&type='+o;
        $.ajax({
            type : "GET",
            url  : url,
            error: function(request) {
                alert("服务器繁忙, 请联系管理员!");
                return;
            },
            success: function(v) {
                v = "<option value='-1'>分类</option>" + v;
                $('#category').empty().html(v);
            }
        });
    }
	
	 
</script>
</body>
</html>