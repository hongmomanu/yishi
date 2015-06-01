<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Insert title here</title>
<script type="text/javascript" src="/Public/Js/jquery-1.8.3.min.js"></script>
</head>
<body>
标题:<?php echo ($article["title"]); ?><br />
内容:<?php echo ($article["content"]); ?><br />
驳回理由:<textarea id="conts"></textarea><br />
<input type="hidden" name="id" value="<?php echo ($article["id"]); ?>" />
<input type="button" id="subbt" value="确定驳回" onclick="" />
<script>
$(document).ready(function(){
	$("#subbt").click(function(){
		var id = $("input[name='id']").val();
		var cont = $("#conts").val();
		$.post("<?php echo U('Member/bohui');?>",{action:'save',id:id,cts:cont},function(e){
			if(e.status == 1){
				window.returnValue='驳回成功';
			}else{
				window.returnValue='驳回失败';
			}
			window.close();
		},'json');
	});
});
</script>
</body>
</html>