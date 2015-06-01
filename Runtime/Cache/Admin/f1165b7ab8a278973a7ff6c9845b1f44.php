<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
<meta charset="utf-8">
<title></title>
<link rel="stylesheet" type="text/css" href="/phpapp/yishi/Public/Css/right.css" />
<script language="javascript">
function Edit(id)
{
	location.href='<?php echo U('System/accountedit');?>/id/'+ id;
}
function Del(id)
{
	if (confirm("确定删除该记录？请慎重操作！"))
	{
		location.href='<?php echo U('System/accountdel');?>/id/'+ id;
	}
}
</script>
</head>
<!-- body style="overflow:scroll;overflow-x:hidden;" -->
<body>
<div id="man_zone">
<div class="right_add"><p>当前页：账号列表</p></div>

<table class="bomdiv" border="0">
<tr>

<td nowrap="nowrap"><p>&nbsp;用户名：</p></td>
<script>document.onkeydown = function(event){e = event ? event : (window.event ? window.event : null);if(e.keyCode==13){location.href='account_list.php?CompanyID=44&UserName='+document.getElementById('UserName').value;}}</script>
<td nowrap="nowrap"><input name="UserName" type="text" class="Input_W80 bomdivinp" id="UserName" value="" size="10"></td>
<td nowrap="nowrap"><input class="bomdivcha" type="button" name="Submit2" value="查询" onClick="location.href='account_list.php?CompanyID=44&UserName='+document.getElementById('UserName').value"></td>

<td nowrap="nowrap"><input class="bomdivcha" type="button" name="Submit" value="增加" onClick="location.href='<?php echo U('System/accountadd');?>'"></td>
</tr>
</table>

<div class="all_table">
<table cellspacing="0" cellpadding="0">
  <tr id="all_table_top">
    <td nowrap='nowrap'>用户名</td>
	<td nowrap='nowrap'>所属分组</td>
	<td nowrap='nowrap'>锁定</td>
	<td nowrap='nowrap'>操作</td>
  </tr>
  <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$user): $mod = ($i % 2 );++$i;?><tr>
<td nowrap='nowrap'><?php echo ($user["uname"]); ?></td>
<td nowrap='nowrap'><?php echo (getgroup($user["id"])); ?></td>
<td nowrap='nowrap'><?php if($user['status'] == 1): ?>正常<?php else: ?>锁定<?php endif; ?></td>
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