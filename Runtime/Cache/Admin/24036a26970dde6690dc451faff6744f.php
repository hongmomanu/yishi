<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
<meta charset="utf-8">
<title></title>
<link rel="stylesheet" type="text/css" href="/Public/Css/right.css" />
<script>
function Edit(id)
{
	location.href='<?php echo U('Admin/Member/edit');?>/uid/'+ id;
}
function Del(id)
{
	if (confirm("确定删除该记录？请慎重操作！"))
	{
		location.href='<?php echo U('Admin/Member/del');?>/id/'+ id;
	}
}
function Search(){
	var name = document.getElementById('UserName').value;
	location.href="<?php echo U('Admin/Member/index');?>/uname/"+name;
}
</script>
</head>
<!-- body style="overflow:scroll;overflow-x:hidden;" -->
<body>
<div id="man_zone">
<div class="right_add"><p>当前页：会员列表</p></div>

<table class="bomdiv" border="0">
<tr>
<td nowrap="nowrap"><p>&nbsp;用户名：</p></td>
<td nowrap="nowrap"><input name="UserName" type="text" class="Input_W80 bomdivinp" id="UserName" value="<?php echo ($keyword); ?>" size="10"></td>
<td nowrap="nowrap"><input class="bomdivcha" type="button" name="Submit2" value="查询" onClick="Search()"></td>

<td nowrap="nowrap"><input class="bomdivcha" type="button" name="Submit" value="增加" onClick="location.href='<?php echo U('Admin/Member/adduser');?>'"></td>
</tr>
</table>

<div class="all_table">
<table cellspacing="0" cellpadding="0">
  <tr id="all_table_top">
    <td nowrap='nowrap'>id</td>
    <td nowrap='nowrap'>昵称</td>
    <td nowrap='nowrap'>账号类型</td>
	<td nowrap='nowrap'>联系电话</td>
	<td nowrap='nowrap'>邮件</td>
	<td nowrap='nowrap'>注册日期</td>
	<td nowrap='nowrap'>到期日期</td>
	<td nowrap='nowrap'>状态</td>
	<td nowrap='nowrap'>所在公司</td>
	<td nowrap='nowrap'>操作</td>
  </tr>
  <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$user): $mod = ($i % 2 );++$i;?><tr>
<td nowrap='nowrap'><?php echo ($user["id"]); ?></td>
<td nowrap='nowrap'><?php echo ($user["uname"]); ?></td>
<td nowrap='nowrap'><?php echo (usertype($user["id"])); ?></td>
<td nowrap='nowrap'><?php echo ($user["phone"]); ?> </td>
<td nowrap='nowrap'><?php echo ($user["email"]); ?></td>
<td nowrap='nowrap'><?php echo (date('Y-m-d H:i:s',$user["posttime"])); ?></td>
<td nowrap='nowrap'><?php echo (date('Y-m-d H:i:s',$user["expeirtime"])); ?></td>
<td nowrap='nowrap'><?php if($user['status'] == 1): ?>正常<?php else: ?>锁定<?php endif; ?></td>
<td nowrap='nowrap'><?php echo ($user["company"]); ?></td>
<td nowrap='nowrap'><span style="cursor:pointer;" title="编辑" onclick="Edit(<?php echo ($user["id"]); ?>)">[编]</span><span style="cursor:pointer;" title="删除" onclick="Del(<?php echo ($user["id"]); ?>)">[删]</span></td>
</tr><?php endforeach; endif; else: echo "" ;endif; ?>
</table>
</div>
<div class="page">
<div class="page">
<?php echo ($page); ?>
		
		</div></div>
</div>
</body>
</html>