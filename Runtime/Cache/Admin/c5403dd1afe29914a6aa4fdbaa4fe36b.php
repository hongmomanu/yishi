<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
<meta charset="utf-8">
<title></title>
<link rel="stylesheet" type="text/css" href="/phpapp/yishi/Public/Css/nav.css" />
</head>

<body style="overflow-x:hidden;">
<div class="sybodf" id="diov1">
<div class="index_lt">
<table width='100%' height="100%" border='0' cellspacing='0' cellpadding='0'>
<tr class="index_lt_one">
<td style='padding-top:5px;' valign="top">
<!-- Item 1 Strat -->
<dl class='bitem'>
<dt onClick='showHide("items1_1")'><b class="tdcolor"><div class="bitem1"></div>会员管理</b></dt>
<dd style='display:block' class='sitem' id='items1_1'>
<ul class='sitemu'>
<li><a href="<?php echo U('Admin/Member/index');?>" target="right">会员列表</a></li>
<li><a href="<?php echo U('Admin/Member/adduserf');?>" target="right">批量导入会员</a></li>

</ul>
</dd>
</dl>
<!-- Item 1 End -->
<!-- Item 2 Strat -->
<dl class='bitem'>
<dt onClick='showHide("items2_1")'><b><div class="bitem2"></div>资讯管理</b></dt>
<dd style='display:none' class='sitem' id='items2_1'>
<ul class='sitemu'>
<li><a href="<?php echo U('Admin/News/sort');?>" target="right">分类列表</a></li>
<li><a href="<?php echo U('Admin/News/index');?>" target="right">资讯管理</a></li>
</ul>
</dd>
</dl>
<!-- Item 2 End -->
<!-- Item 5 Strat -->
<dl class='bitem'>
<dt onClick='showHide("items5_1")'><b><div class="bitem5"></div>系统设置</b></dt>
<dd style="display:none;" class='sitem' id='items5_1'>
<ul class='sitemu'>
<li><a href="<?php echo U('System/alonepage');?>" target="right">单页面管理</a></li>
<div class="Dividing"></div>
<!-- <li><a href="<?php echo U('System/consultingtype');?>" target="right">数据库备份</a></li> -->
<div class="Dividing"></div>
<li><a href="<?php echo U('System/group');?>" target="right">分组列表</a></li>
<li><a href="<?php echo U('System/account');?>" target="right">管理员列表</a></li>
<div class="Dividing"></div>

<li><a href="<?php echo U('System/syslog');?>" target="right">系统日志</a></li>
</ul>
</dd>
</dl>
<!-- Item 5 End -->
</td>
</tr>
</table>
</div>

<div class="cler"></div>
</div>
<script language='javascript'>var curopenItem = '1';</script>
<script language="javascript" type="text/javascript" src="/phpapp/yishi/Public/Js/menu.js"></script>
</body>
</html>