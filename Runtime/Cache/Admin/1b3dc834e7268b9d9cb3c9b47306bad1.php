<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>管理系统</title>
<link rel="stylesheet" type="text/css" href="/phpapp/yishi/Public/Css/right.css" />
<script language="javascript">
function Edit(id)
{
	location.href='<?php echo U('Admin/System/aloneedit');?>/id/'+ id;
}

</script>
</head>
<!-- body style="overflow:scroll;overflow-x:hidden;" -->
<body>
<div id="man_zone">
<div class="right_add"><p>当前页：单页面管理</p></div>

<div class="all_table">
<table cellspacing="0" cellpadding="0">
  <tr id="all_table_top">
    <td nowrap='nowrap'>名称</td>
    <td nowrap='nowrap'>操作</td>
  </tr>

<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$login): $mod = ($i % 2 );++$i;?><tr>
<td nowrap='nowrap'><?php echo ($login["title"]); ?></td>
<td nowrap='nowrap'>
<span style="cursor:pointer;" title="编辑" onclick="Edit(<?php echo ($login["id"]); ?>)">[编辑]</span>
</td>
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