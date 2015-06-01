<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
<meta charset="utf-8">
<title></title>
<script>
//android
if (navigator.userAgent.match(/Android/i))
{
	//alert(/android/);
	window.location.href='m/';
}
//iphone或者ipad
if ((navigator.userAgent.indexOf('iPhone') != -1) || (navigator.userAgent.indexOf('iPod') != -1) || (navigator.userAgent.indexOf('iPad') != -1))
{
	//alert(/iphone/);
	window.location.href='m/';
}
</script>
</head>
<frameset frameSpacing="0" rows="144,*,25" frameBorder="NO">
	<frame src="<?php echo U('Index/top');?>" name="top" scrolling="no" id="top">
        <frameset rows="*" cols="205,10,*" frameSpacing="0" frameBorder="NO" id="attachucp" name="main" scrolling="no">
			<frame id="attachucp" name="left" src="<?php echo U('Index/left');?>" scrolling="auto" target="right">
            <frame id="leftbar" scrolling="no" noresize="" name="switchFrame" src="<?php echo U('Index/switchs');?>">
            <frame name="right" src="<?php echo U('Index/right');?>" scrolling="auto">
        </frameset>
	<frame src="<?php echo U('Index/foot');?>" name="bott" scrolling="no" id="bott">
</frameset>
<noframes>
<body>
</body>
</noframes>
</html>
<!-- final_13.10.08 -->