<?php if (!defined('THINK_PATH')) exit();?><html>
<head>
<meta charset="utf-8">
<title></title>
<script language="javascript">
function switchSysBar()
{
	if (parent.document.getElementById('attachucp').cols=="205,10,*")
	{
		document.getElementById('leftbar').style.display="";
		parent.document.getElementById('attachucp').cols="0,10,*";
	}
	else
	{
		parent.document.getElementById('attachucp').cols="205,10,*";
		document.getElementById('leftbar').style.display="none";
	}
}
function load()
{
	if (parent.document.getElementById('attachucp').cols=="0,10,*")
	{
		document.getElementById('leftbar').style.display="";
	}
}
</script>
</head>
<body marginwidth="0" marginheight="0" onLoad="load()" topmargin="0" leftmargin="0">
<center>
<table height="100%" cellspacing="0" cellpadding="0" border="0" width="100%">
<tbody>
<tr>
<td bgcolor="#D1D1D1" width="1">
<img height="1" width="1" src="images/ccc.gif"/>
</td>
<td id="leftbar" bgcolor="#FFFFFF" style="display: none;">
<a onClick="switchSysBar()" href="javascript:void(0);">
<img height="90" border="0" width="9" alt="展开左侧菜单" title="展开左侧菜单" src="/Public/Images/pic24.gif"/>
</a>
</td>
<td id="rightbar" bgcolor="#FFFFFF">
<a onClick="switchSysBar()" href="javascript:void(0);">
<img height="90" border="0" width="9" alt="隐藏左侧菜单" title="隐藏左侧菜单" src="/Public/Images/pic23.gif"/>
</a>
</td>
</tr>
</tbody>
</table>
</center>
</body>
</html>
<!-- final_13.09.24 -->