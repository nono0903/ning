<?php /*a:1:{s:71:"D:\phpStudy\WWW\tp5\application/admin/view\index\ajax_article_list.html";i:1518078026;}*/ ?>
<table>
 	<tbody>
 	<?php if(empty($articleList) == true): ?>
 		<tr data-id="0">
	        <td class="no-data" align="center" axis="col0" colspan="50">
	        	<i class="fa fa-exclamation-circle"></i>没有符合条件的记录
	        </td>
	     </tr>
	<?php else: if(is_array($articleList) || $articleList instanceof \think\Collection || $articleList instanceof \think\Paginator): $i = 0; $__LIST__ = $articleList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?>
  	<tr data-order-id="<?php echo htmlentities($list['blog_id']); ?>">
        <td class="sign" axis="col0">
          <div style="width: 24px;"><i class="ico-check"></i></div>
        </td>
        <td align="left" abbr="order_sn" axis="col1" class="">
          <div style="text-align: left; width: 40px;" class=""><?php echo htmlentities($list['blog_id']); ?></div>
        </td>
        <td align="left" abbr="consignee" axis="col2" class="">
          <div style="text-align: left; width: 120px;" class=""><?php echo htmlentities($list['title']); ?></div>
        </td>
        <td align="center" abbr="article_show" axis="col3" class="">
          <div style="text-align: center; width: 60px;" class=""><?php echo htmlentities($list['category_name']); ?></div>
        </td>
        <td align="center" abbr="article_time" axis="col4" class="">
          <div style="text-align: center; width: 35px;" class=""><?php echo htmlentities($list['comment_num']); ?></div>
        </td>
        <td align="center" abbr="article_time" axis="col5" class="">
            <div style="text-align: center; width: 35px;" class=""><?php echo htmlentities($list['likes']); ?></div>
        </td>
        <td align="center" abbr="article_time" axis="col6" class="">
            <div style="text-align: center; width: 35px;" class=""><?php echo htmlentities($list['click_count']); ?></div>
        </td>
        <td align="center" abbr="article_time" axis="col7" class="">
            <div style="text-align: center; width: 35px;">
                <?php if($list[is_show] == 1): ?>
                <span class="yes" onClick="changeTableVal('blog_info','blog_id','<?php echo htmlentities($list['blog_id']); ?>','is_show',this)" ><i class="fa fa-check-circle"></i>是</span>
                <?php else: ?>
                <span class="no" onClick="changeTableVal('blog_info','blog_id','<?php echo htmlentities($list['blog_id']); ?>','is_show',this)" ><i class="fa fa-ban"></i>否</span>
                <?php endif; ?>
            </div>
        </td>
        <td align="center" abbr="article_time" axis="col8" class="">
            <div style="text-align: center; width: 35px;">
                <?php if($list[is_index] == 1): ?>
                <span class="yes" onClick="changeTableVal('blog_info','blog_id','<?php echo htmlentities($list['blog_id']); ?>','is_index',this)" ><i class="fa fa-check-circle"></i>是</span>
                <?php else: ?>
                <span class="no" onClick="changeTableVal('blog_info','blog_id','<?php echo htmlentities($list['blog_id']); ?>','is_index',this)" ><i class="fa fa-ban"></i>否</span>
                <?php endif; ?>
            </div>
        </td>
        <td align="center" abbr="article_time" axis="col9" class="">
          <div style="text-align: center; width: 120px;" class=""><?php echo htmlentities(date('Y-m-d H:i',!is_numeric($list['pubtime'])? strtotime($list['pubtime']) : $list['pubtime'])); ?></div>
        </td>
        <td align="left" axis="col1" class="handle" align="center">
        		<div style="text-align: left; ">
        			<a class="btn green" href="<?php echo Url('/addEditArticle',array('blog_id'=>$list['blog_id'])); ?>"><i class="fa fa-list-alt"></i>查看</a>
        		</div>
         </td>
      </tr>
      <?php endforeach; endif; else: echo "" ;endif; endif; ?>
    </tbody>
</table>
<div class="row">
    <div class="col-sm-6 text-left"></div>
    <div class="col-sm-6 text-right"><?php echo $articleList; ?></div>
</div>
<script>
    $(".pagination  a").click(function(){
        var page = $(this).html();

        ajax_get_table('search-form2',page);
    });
    
 // 删除操作
    function del(obj) {
		confirm('确定要删除吗?', function(){
			location.href = $(obj).data('href');  
		});
	}
    
    $('.ftitle>h5').empty().html("(共<?php echo htmlentities($articleList->total()); ?>条记录)");
</script>