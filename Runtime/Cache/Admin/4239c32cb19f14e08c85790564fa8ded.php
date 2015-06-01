<?php if (!defined('THINK_PATH')) exit();?>




<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>医院管理系统</title>
<link rel="stylesheet" type="text/css" href="/phpapp/yishi/Public/Css/right.css" />
<script language="javascript">
function LogDel()
{
	if (confirm("确定清空系统日志？请慎重操作！"))
	{
		location.href='pubsub.php?Work=SysLogDel&CompanyID='+ 44;
	}
}
</script>
</head>
<!-- body style="overflow:scroll;overflow-x:hidden;" -->
<body>
<div id="man_zone">
<div class="right_add"><p>当前页：系统日志</p></div>

<table class="bomdiv" border="0">
<tr>

<td nowrap="nowrap"><p>&nbsp;用户名：</p></td>
<script>document.onkeydown = function(event){e = event ? event : (window.event ? window.event : null);if(e.keyCode==13){location.href='syslog_list.php?CompanyID=44&UserName='+document.getElementById('UserName').value;}}</script>
<td nowrap="nowrap"><input name="UserName" type="text" class="Input_W80 bomdivinp" id="UserName" value="" size="10"></td>
<td nowrap="nowrap"><input class="bomdivcha" type="button" name="Submit2" value="查询" onClick="location.href='syslog_list.php?CompanyID=44&UserName='+document.getElementById('UserName').value"></td>
</tr>
</table>

<div class="all_table">
<table cellspacing="0" cellpadding="0">
  <tr id="all_table_top">
    <td nowrap='nowrap'>用户名</td>
    <td nowrap='nowrap'>动作</td>
    <td nowrap='nowrap'>操作时间</td>
    <td nowrap='nowrap'>Ip地址</td>
  </tr>

<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$login): $mod = ($i % 2 );++$i;?><tr>
<td nowrap='nowrap'><?php echo ($login["user"]); ?></td>
<td nowrap='nowrap' style='text-align:left;'>&nbsp;<?php echo ($login["content"]); ?></td>
<td nowrap='nowrap'><?php echo (date("Y-m-d H:i:s",$login["time"])); ?></td>
<td nowrap='nowrap'><?php echo ($login["ip"]); ?></td>
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