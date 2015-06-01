<?php if (!defined('THINK_PATH')) exit();?>


<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>医院管理系统</title>
<link rel="stylesheet" type="text/css" href="/phpapp/yishi__PUBLIC__/Css/right.css" />
<script language="JavaScript" type="text/javascript">
function checkForm()
{
	var op = document.getElementById("oldpwd").value;
	var np1 = document.getElementById("newpwd1").value;
	var np2 = document.getElementById("newpwd2").value;
	
	if(op =="")
	{
		alert("请输入旧密码！");
		document.getElementById("oldpwd").focus();
		return false;
	}
	
	if(np1 =="")
	{
		alert("请输入新密码！");
		document.getElementById("newpwd1").focus();
		return false;
	}
	
	var filter=/^(?![a-z]+$)(?!\d+$)[a-z0-9]{8,20}$/i;
	if (!filter.test(np1))
	{
		alert("密码必须包括数字、字母，长度8－20");
		document.getElementById("newpwd1").focus();
		return (false);
	}
	if(np2 =="")
	{
		alert("请再次输入新密码！");
		document.getElementById("newpwd2").focus();
		return false;
	}
	if(np1 != np2)
	{
		alert("两次输入的新密码不一样！");
		document.getElementById("newpwd2").focus();
		return false;
	}
	location.href = "<?php echo U('Public/repass');?>/old/"+op+"/n1/"+np1+"/n2/"+np2+"/action/update";
}
</script>
</head>

<!-- body style="overflow:scroll;overflow-x:hidden;" -->
<body>

<div id="man_zone">
<div class="right_add2"><p>当前页：修改密码</p></div>
<div class="all_table2">

<form name="form1" method="post" action="?Work=Save">
<table width="100%">

<tr>
<td width="9%" height="34" align="right">旧密码：</td>
<td align="left"><input name="oldpwd" type="password" class="Input_W675" id="oldpwd" size="50">&nbsp;<span style="color:red" id="chk">*</span></td>
</tr>

<tr>
<td width="9%" height="34" align="right">新密码：</td>
<td align="left"><input name="newpwd1" type="password" class="Input_W675" id="newpwd1" size="50">&nbsp;<span style="color:red" id="chk">*</span></td>
</tr>

<tr>
<td width="9%" height="34" align="right">确认新密码：</td>
<td align="left"><input name="newpwd2" type="password" class="Input_W675" id="newpwd2" size="50">&nbsp;<span style="color:red" id="chk">*</span></td>
</tr>

<tr>
<td height="25" align="right">&nbsp;</td>
<td colspan="5"><input class="Submit" type="button" onClick="checkForm(document.forms['form1'])" value="" name="Submit22"><input class="resetsubmit" value="" name="" type="reset"><input class="returnsubmit" value="" name="" type="button" onClick="window.history.back();"></td>
</tr>

</table>
</form>

</div>
</div>

</body>
</html>