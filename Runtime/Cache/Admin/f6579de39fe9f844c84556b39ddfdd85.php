<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
<meta charset="utf-8">
<title></title>
<link rel="stylesheet" type="text/css" href="/Public/Css/index.css" />
</head>

<body>
<div class="header">
<div class="headerlogo">
<div class="fl fhsy"><a href="right.php"  target="right"></a></div>
<div class="dltc fr dis">
<a href="<?php echo U('Public/repass');?>" target="right" title="修改密码">修改密码</a>
<a href="<?php echo U('Public/logout');?>" title="退出" onclick="{if(confirm('是否确定要退出管理系统？')){return true;}return false;}">退出</a>
<a href="#" target="_blank" title="帮助">帮助</a>
</div>
</div>
</div>
<div class="indtop">
<div class="indtopb">
<span>用户：<?php echo ($_SESSION['user']['uname']); ?></span>
</div>
</div>
</body>
</html>