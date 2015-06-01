<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Insert title here</title>
<script src="/Public/media/jquery.js"></script>	
</head>
<body>
<select id="fa" onchange="getG(this.value)">
<option value="0">请选择单位类型</option>
<option value="1">总会</option>
<option value="2">分会</option>
<option value="3">单位</option>
</select>

<select id="son">
<option value="0">请选择单位</option>
</select>
<span id="ugroup"></span>
用户名<input type="text" name="uname" value="" />
<input type="button" onclick="showmember()" value="显示会员" />
<style>
ul li{list-style:none;}
</style>
<script>
function getG(id){
	if(id == 2 || id == 3){
		$.post("<?php echo U('Member/selectgroupdo');?>",{gid:id},function(e){
			$("#son").empty().append(e);
		},'json');
	}else{
		$("#son").empty().append('<option value="0">请选择单位</option>');
	}
}
function showmember(){
	var fid = $("#fa option:selected").val();
	var son = $("#son option:selected").val();
	var uname = $("input[name='uname']").val();
	if(fid == 0){
		alert('请选择单位类型'); 
	}else{
		$.post("<?php echo U('Member/selectuserdo');?>",{faid:fid,sonid:son,name:uname},function(e){
			$("#userlist").empty().html(e);
		},'json');
	}
}
function addv(id){
	//$("#sendid").append("<input type='hidden' value='"+id+"' />");
	var n = document.getElementById(id);
	if(n.checked == true){
		//选中
		$.post("<?php echo U('Member/mailuser');?>",{action:'add',uid:id},function(e){
			//alert('已选中');
		},'json');
	}else{
		//取消
		$.post("<?php echo U('Member/mailuser');?>",{action:'nadd',uid:id},function(e){
			//alert('已取消');
		},'json');
	}
}
function subs(){
		//var str=""
		//$("#sendid input").each(function(index, element) {
		//	str += $(this).val()+","
	   // });
		//str = str.substr(0,str.length-1);//除去最后一个“，”
		window.returnValue=1;
		window.close();
}
function selectAll(){
$("input[name='uid[]']").each(function(){
	$(this).attr("checked",true);
	addv(this.value);
});
}
</script>
<div>
<ul id="userlist">
</ul>
<div id="sendid"></div>
</div>
<input type="button" value="全选" onclick="selectAll()" />
<input type="button" value="确定" onclick="subs()" />
</body>
</html>