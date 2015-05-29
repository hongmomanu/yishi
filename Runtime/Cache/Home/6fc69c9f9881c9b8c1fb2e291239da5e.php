<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Insert title here</title>
<script src="/Public/media/jquery.js"></script>	
<link href="/Public/Home/css/style.css" type="text/css" rel="stylesheet" />
</head>
<body>

<script>
function addv(id){
	//$("#sendid").append("<input type='hidden' value='"+id+"' />");
	var n = document.getElementById(id);
	if(n.checked == true){
		//选中
		$.post("<?php echo U('Member/mailuser');?>",{action:'add',uid:id},function(e){
			//alert('已选中');
		},'json');
	}else{
		//取消
		$.post("<?php echo U('Member/mailuser');?>",{action:'nadd',uid:id},function(e){
			//alert('已取消');
		},'json');
	}
	location.reload();
}
</script>
<div>

        	<table class="bomdiv" border="0">

</table>
        	<div class="all_table">
<table cellspacing="0" cellpadding="0">
  <tr id="all_table_top">
    
    <td nowrap='nowrap'>用户名</td>
  
    <td nowrap='nowrap'>单位名称</td>
	
	<td nowrap='nowrap'>操作</td>
  </tr>
  <?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$ulist): $mod = ($i % 2 );++$i;?><tr>
<td nowrap='nowrap'><?php echo ($ulist["truename"]); ?></td>
<td nowrap='nowrap'><?php echo ($ulist["company"]); ?></td>
<td>
<span style="cursor:pointer;" title="删除" id="<?php echo ($ulist["id"]); ?>" onclick="addv(<?php echo ($ulist["id"]); ?>)">[修改]</span>
</td>
</tr><?php endforeach; endif; else: echo "" ;endif; ?>
</table>
</div>
<br />
<div style="margin-top:15px;">您工选择了<?php echo ($total); ?>位用户</div>
</div>
</body>
</html>