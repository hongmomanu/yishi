<?php if (!defined('THINK_PATH')) exit();?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title></title>
<link rel="stylesheet" type="text/css" href="/phpapp/yishi__PUBLIC__/Css/login.css" />
<script type="text/javascript">
if (top != window)
{
	top.location.href='login.php';
}
function chkForm(obj){
    if(obj.Title.value == ""){
        alert("请输入登录帐户");
        obj.Title.focus();
        return false;
    }
    if(obj.Pwd.value == ""){
        alert("请输入登录密码");
        obj.Pwd.focus();
        return false;
    }
	obj.sn.value = document.getElementById('ocx').getId();
	return true;	
}
</script>
</head>

<body>
<div class="loginall">
<div class="loginpn">
<div class="loginlogo"><img src="/phpapp/yishi__PUBLIC__/Images/loginlogo.jpg" alt=""></div>
<div class="logindl">
<form onSubmit="return chkForm(this);" id="form1" name="form1" method="post" action="<?php echo U('Public/login');?>">
<div class="logindls"><span>用户名：</span><input type="text" autocomplete="off" name="username" id="UserName" class="adminname"></div>
<div class="logindls"><span>密<b></b>码：</span><input type="password" name="password" id="PassWord" class="adminname"></div>
<div class="logindlc"><input type="submit" value="" name="submit"><button type="reset"></button></div>
</form>
<div class="logindlp">管理系统（C）2014 版权所有</div>
</div>
</div>
</div>
</body>
</html>