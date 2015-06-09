<?php if (!defined('THINK_PATH')) exit(); if(C('LAYOUT_ON')) { echo ''; } ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>跳转提示</title>
<style type="text/css">
*{ padding: 0; margin: 0; }
body{ background: #fff; font-family: '微软雅黑'; color: #333; font-size: 16px; }
.system-message{ padding: 24px 48px; }
.system-message h1{ font-size: 100px; font-weight: normal; line-height: 120px; margin-bottom: 12px; }
.system-message .jump { padding-top: 10px}
.system-message .jump a{ color: #333;}
.system-message .success,.system-message .error{ line-height: 1.8em; font-size: 36px }
.system-message .detail{ font-size: 12px; line-height: 20px; margin-top: 12px; display:none}

*{margin:0px;padding:0px;font-size:12px;font-family:Arial,Verdana;}
#wrapper{width:450px;height:200px;background:#F5F5F5;border:1px solid #D2D2D2;position:absolute;top:40%;left:50%;margin-top:-100px;margin-left:-225px;}
p.msg-title{width:100%;height:30px;line-height:30px;text-align:center;color:#EE7A38;margin-top:40px;font:14px Arial,Verdana;font-weight:bold;}
p.message{width:100%;height:40px;line-height:40px;text-align:center;color:blue;margin-top:5px;margin-bottom:5px;}
p.error{width:100%;height:40px;line-height:40px;text-align:center;color:red;margin-top:5px;margin-bottom:5px;}
p.notice{width:100%;height:25px;line-height:25px;text-align:center;}
</style>
</head>
<body>
<div class="system-message" id="wrapper">
<?php if(isset($message)): ?><h1>:)</h1>
<p class="success"><?php echo($message); ?></p>
<?php else: ?>
<h1>:(</h1>
<p class="error"><?php echo($error); ?></p><?php endif; ?>
<p class="detail"></p>
<p class="jump">
页面自动 <a id="href" href="<?php echo($jumpUrl); ?>">跳转</a> 等待时间： <b id="wait"><?php echo($waitSecond); ?></b>
</p>
</div>
<script type="text/javascript">
(function(){
var wait = document.getElementById('wait'),href = document.getElementById('href').href;
var interval = setInterval(function(){
	var time = --wait.innerHTML;
	if(time <= 0) {
		location.href = href;
		clearInterval(interval);
	};
}, 1000);
})();
</script>
</body>
</html>