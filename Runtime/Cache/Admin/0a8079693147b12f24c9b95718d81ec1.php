<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
<meta charset="utf-8">
<title></title>
<link rel="stylesheet" type="text/css" href="/Public/Css/right.css" />
<script><!--
function checkForm(obj)
{
	if (obj.name.value=="")
	{
		alert("请输入用户名！");
		obj.name.focus();
		return false;
	}
	var reg=/^[a-zA-Z0-9]{4,16}$/;
	if (!reg.test(obj.name.value))
	{
		alert("用户名只能使用英文字母或数字，长度4到16位！");
		obj.name.focus();
		return false;
	}
	if(obj.email.value==""){
		alert("邮件不能为空");
		obj.email.focus();
		return false;
	}
	var reg=/^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(.[a-zA-Z0-9_-])+/;
	if (!reg.test(obj.email.value))
	{
		alert("邮箱格式不正确");
		obj.email.focus();
		return false;
	}
	if(obj.phone.value==""){
		alert("电话不能为空");
		obj.phone.focus();
		return false;
	}
	var reg=/^(13[0-9]{9})|(15[0-9]{9})|(18[0-9]{9})$/;
	if(!reg.test(obj.phone.value)){
		alert("电话格式不正确");
		obj.phone.focus();
		return false;
	}
	obj.submit();
}
function ReSetPwd(id)
{
	if(confirm("您确定初始化密码吗？"))
	{
		location.href="<?php echo U('Admin/Member/repass');?>/id/"+ id;
	}
}
--></script>
</head>

<!-- body style="overflow:scroll;overflow-x:hidden;" -->
<body>
<div id="man_zone">


<div class="right_add2"><p>当前页：编辑账号</p></div>
<div class="all_table2">

<form name="form1" method="post" action="">
<table width="100%">
<tr>
<td width="9%" height="34" align="right">用户名:</td>
<td align="left"><input name="uname" type="text" class="Input_W675" id="Title" size="50" value="<?php echo ($data["uname"]); ?>">&nbsp;<span style="color:red" id="chk">*</span></td>
</tr>
<tr>
<td align="right"></td>
<td>(用户名只能使用英文字母或数字，长度4到16位！)</td>
</tr>
<tr>
	<td width="9%" height="34" align="right">真實姓名:</td>
	<td align="left"><input name="truename" type="text" class="Input_W675" size="50" value="<?php echo ($data["truename"]); ?>">&nbsp;<span style="color:red" >*</span></td>
</tr>

<tr>
<td width="9%" height="34" align="right">性别:</td>
<td align="left">
<select name="sex">
<option value="0">请选择</option>
<option value="1" <?php echo (retrunselect($data["sex"],1)); ?>>男</option>
<option value="2" <?php echo (retrunselect($data["sex"],2)); ?>>女</option>
</select></td>
</tr>
<tr>
<td width="9%" height="34" align="right">出生年月:</td>
<td align="left"><input type="text" name="both" class="Input_W675" id="Title" size="20" value="<?php echo (date('Y-m-d',$data["both"])); ?>" /></td>
</tr>
<tr>
<td width="9%" height="34" align="right">密码:</td>
<td align="left"><input name="pwd" type="text" class="Input_W675" id="Title" size="20" value="">&nbsp;<span style="color:red" id="chk">留空不更新</span></td>
</tr>
<tr>
<td width="9%" height="34" align="right">到期日期:</td>
<td align="left"><input type="text" name="expeirtime" class="Input_W675" id="Title" size="20" value="<?php echo (date('Y-m-d',$data["expeirtime"])); ?>" /></td>
</tr>
<tr>
<td width="9%" height="34" align="right">学历:</td>
<td align="left"><input type="text" name="xueli" class="Input_W675" id="Title" size="20" value="<?php echo ($data["xueli"]); ?>" /></td>
</tr>
<tr>
<td width="9%" height="34" align="right">学位:</td>
<td align="left"><input type="text" name="xuewei" class="Input_W675" id="Title" size="20" value="<?php echo ($data["xuewei"]); ?>" /></td>
</tr>
<tr>
<td width="9%" height="34" align="right">所属分会:</td>
<td align="left">
<select name="group">
<option value="">请选择用户分组</option>
<?php if(is_array($group)): $i = 0; $__LIST__ = $group;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$glist): $mod = ($i % 2 );++$i;?><option value="<?php echo ($glist["id"]); ?>" <?php echo (retrunselect($data["group"],$glist['id'])); ?>><?php echo ($glist["title"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
</select>
</td>
</tr>
<tr>
<td width="9%" height="34" align="right">身份证号:</td>
<td align="left"><input type="text" name="card" class="Input_W675" id="Title" size="20" value="<?php echo ($data["card"]); ?>" /></td>
</tr>
<tr>
<td width="9%" height="34" align="right">E-mail:</td>
<td align="left"><input name="email" type="text" class="Input_W675" id="Title" size="20" value="<?php echo ($data["email"]); ?>">&nbsp;<span style="color:red" id="chk">*</span></td>
</tr>
<tr>
<td width="9%" height="34" align="right">手机号:</td>
<td align="left"><input name="phone" type="text" class="Input_W675" id="Title" size="20" value="<?php echo ($data["phone"]); ?>">&nbsp;<span style="color:red" id="chk">*</span></td>
</tr>
<tr>
<td width="9%" height="34" align="right">所在单位:</td>
<td align="left"><input name="company" type="text" class="Input_W675" id="Title" size="20" value="<?php echo ($data["company"]); ?>">&nbsp;<span style="color:red" id="chk">*</span></td>
</tr>
<tr>
<td width="9%" height="34" align="right">科室:</td>
<td align="left"><input type="text" name="room" class="Input_W675" id="Title" size="20" value="<?php echo ($data["room"]); ?>" /></td>
</tr>
<tr>
<td width="9%" height="34" align="right">职称:</td>
<td align="left"><input name="zhiwu" type="text" class="Input_W675" id="Title" size="20" value="<?php echo ($data["zhiwu"]); ?>">&nbsp;<span style="color:red" id="chk">*</span></td>
</tr>
<tr>
<td width="9%" height="34" align="right">执业年限:</td>
<td align="left"><input type="text" name="zynx" class="Input_W675" id="Title" size="20" value="<?php echo ($data["zynx"]); ?>" /></td>
</tr>
<tr>
<td width="9%" height="34" align="right">执业范围:</td>
<td align="left">
<select name="zyfw">
<option value="0" <?php echo (retrunselect($data["zyfw"],0)); ?>>请选择</option>
<option value="1" <?php echo (retrunselect($data["zyfw"],1)); ?>>临床</option>
<option value="2" <?php echo (retrunselect($data["zyfw"],2)); ?>>口腔</option>
<option value="3" <?php echo (retrunselect($data["zyfw"],3)); ?>>公共卫生</option>
<option value="4" <?php echo (retrunselect($data["zyfw"],4)); ?>>中医</option>
</select>
</td>
</tr>
<tr>
<td width="9%" height="34" align="right">医师级别:</td>
<td align="left">
<select name="ysjb">
<option value="0" <?php echo (retrunselect($data["ysjb"],0)); ?>>请选择</option>
<option value="1" <?php echo (retrunselect($data["ysjb"],1)); ?>>执业医师</option>
<option value="2" <?php echo (retrunselect($data["ysjb"],2)); ?>>执业助理医师</option>
</select>
</td>
</tr>
<tr>
<td width="9%" height="34" align="right">资格证书编号:</td>
<td align="left"><input type="text" name="zgzsbh" class="Input_W675" id="Title" size="20" value="<?php echo ($data["zgzsbh"]); ?>" /></td>
</tr>
<tr>
<td width="9%" height="34" align="right">执业证书编号:</td>
<td align="left"><input type="text" name="zyzsbh" class="Input_W675" id="Title" size="20" value="<?php echo ($data["zyzsbh"]); ?>" /></td>
</tr>
<tr>
<td width="9%" height="34" align="right">地址:</td>
<td align="left"><input name="address" type="text" class="Input_W675" id="Title" size="20" value="<?php echo ($data["address"]); ?>">&nbsp;<span style="color:red" id="chk">*</span></td>
</tr>
<tr>
<td height="34" align="right">是否锁定：</td>
<td><input name="status" type="radio" value="1" <?php echo (retruncheck($data["status"],1)); ?>>&nbsp;正常&nbsp;<input name="status" type="radio" value="0" <?php echo (retruncheck($data["status"],0)); ?>>&nbsp;锁定</td>
</tr>
<tr>
<td height="25" align="right"><input type="hidden" name="id" value="<?php echo ($data["id"]); ?>" /><input type="hidden" name="action" value="update" /></td>
<td colspan="5"><input class="Submit" type="button" onClick="checkForm(document.forms['form1'])" value="" name="Submit22"><input class="resetsubmit" value="" name="" type="reset"><input class="returnsubmit" value="" name="" type="button" onClick="window.history.back();"></td>
</tr>

</table>
</form>
</div>



</div>
</body>
</html>