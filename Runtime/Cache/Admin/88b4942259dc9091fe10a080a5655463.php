<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
<meta charset="utf-8">
<title></title>
<link rel="stylesheet" type="text/css" href="/phpapp/yishi/Public/Css/right.css" />
<script language="javascript">
function Edit(id)
{
	location.href='<?php echo U('System/groupedit');?>/id/'+ id;
}
function Del(id)
{
	if (confirm("确定删除该记录？请慎重操作！"))
	{
		location.href='<?php echo U('System/groupdel');?>/id/'+ id;
	}
}
function Role(id)
{
	location.href='<?php echo U('System/role');?>/id/'+id;
}
</script>
</head>
<!-- body style="overflow:scroll;overflow-x:hidden;" -->
<body>
<div id="man_zone">
<div class="right_add"><p>当前页：分组列表</p></div>

<table class="bomdiv" border="0">
<tr>

<td nowrap="nowrap"><input class="bomdivcha" type="button" name="Submit" value="增加" onClick="location.href='<?php echo U('System/groupadd');?>'"></td>
</tr>
</table>

<div class="all_table">
<table cellspacing="0" cellpadding="0">
  <tr id="all_table_top">
	<td nowrap='nowrap'>类别</td>
    <td nowrap='nowrap'>分组名称</td>
    <td nowrap='nowrap'>状态</td>
	<td nowrap='nowrap'>操作</td>
  </tr>

<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$grouplist): $mod = ($i % 2 );++$i;?><tr>
<td nowrap='nowrap'><?php echo ($grouplist["module"]); ?> </td>
<td nowrap='nowrap'><?php echo ($grouplist["title"]); ?></td>
<td nowrap='nowrap'><?php if($grouplist['status'] == 1): ?>正常<?php else: ?>异常<?php endif; ?></td>
<td nowrap='nowrap'><span style="cursor:pointer;" title="编辑" onclick="Edit(<?php echo ($grouplist["id"]); ?>)">[编]</span><span style="cursor:pointer;" title="删除" onclick="Del(<?php echo ($grouplist["id"]); ?>)">[删]</span></td>
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