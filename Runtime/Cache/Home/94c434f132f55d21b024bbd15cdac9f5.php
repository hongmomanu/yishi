<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>医师协会</title>
<link href="/Public/Home/css/style.css" type="text/css" rel="stylesheet" />
<script src="/Public/media/jquery.js"></script>
</head>

<body>
<!--top-->
<div id="top">
	<div class="top">
    	<div class="logo left"><img src="/Public/Home/images/logo.jpg"  /></div>
        <div class="jiansuo right">
        	<ul>
            	
            </ul>
            <div class="hearderSearch">
            	<form action="<?php echo U('Index/search');?>" method="get">
                    <input type="text" name="keyword" id="q" title="检索输入框" value=""/>
                    <input type="submit" class="btn-info" title="检索" value="  "/>
                </form>
            </div>
        </div>
    </div>
</div>
<!--top end-->
<div class="banner"></div>
<div id="nav">
	<div class="nav">
    <ul>
                     <li><a href="<?php echo U('Index/index');?>">首页</a></li>
        	<li><a class="hide" href="javascript:void(0)">协会文件</a>
            	<ul style="z-index:1000">
                    <li><a href="<?php echo U('Index/about');?>">协会简介	</a></li>
                    <li><a href="<?php echo U('Index/alonepage',array('id'=>'2'));?>">协会领导</a></li>
                    <li><a href="<?php echo U('Index/alonepage',array('id'=>'3'));?>"> 组织机构</a></li>
            	</ul>
            </li> 	
        	<li><a href="<?php echo U('Index/category',array('sortid'=>'14'));?>">政策法规</a></li>
        	<li><a class="hide" href="<?php echo U('Member/index');?>">会员管理</a>
             <ul style="z-index:1000">
                    <li><a href="<?php echo U('Index/category',array('sortid'=>'15'));?>">会费标准 </a></li>
                    <li><a href="<?php echo U('Index/category',array('sortid'=>'16'));?>">会员管理办法</a></li>
            	</ul>
            </li>
            
        	<li><a class="hide" href="<?php echo U('Index/category',array('sortid'=>'3'));?>">医疗评审</a>
           
            <ul style="z-index:1000">
                    <li><a href="<?php echo U('Index/category',array('sortid'=>'17'));?>">医疗机构校验</a></li>
                    <li><a href="<?php echo U('Index/category',array('sortid'=>'18'));?>">医疗机构评审</a></li>
                    <li><a href="<?php echo U('Index/category',array('sortid'=>'19'));?>">医疗设备评审</a></li>
                    <li><a href="<?php echo U('Index/category',array('sortid'=>'20'));?>">医疗技术评审</a></li>
            	</ul>
            
                </li>
        	<li><a class="hide" href="<?php echo U('Index/exam');?>">考核培训</a>
             <ul style="z-index:1000">
                    <li><a href="<?php echo U('Index/exam');?>">继教培训</a></li>
            	</ul>
            </li>
           
      </ul>
    </div>
</div>
<div id="centent">
	<div class="ny_con">
    	<div class="gonggaot"><img src="/Public/Home/images/laba.jpg" width="20" height="39" class="left mr10" /><?php echo gonggao(); ?></div>
        <div class="blank"></div>
<div class="ny_L">
        	<div class="ny_Lbox mb10">
            	<h3>菜单</h3>
                <ul>
                	<a href="<?php echo U('Member/info');?>"><li>基本资料</li></a>
<a onClick='showHide("items3_1")'><li>站内消息<?php echo getnewMessagecount(); ?></li></a>
<dl id="items3_1" <?php if(CONTROLLER_NAME == 'Member' && (ACTION_NAME == 'message' || ACTION_NAME == 'inputbox')){ }else{ ?>style="display:none;"<?php } ?>>
<dd><a href="<?php echo U('Member/message');?>">发件箱</a></dd>
<dd><a href="<?php echo U('Member/inputbox');?>">收件箱</a></dd>
</dl>
<!-- <a href="<?php echo U('Member/collect');?>"><li>我的收藏</li></a> -->
<?php if(session('groupid') == 1){ ?>
<a onClick='showHide("items2_1")'><li>分会账号管理</li></a>
<dl id='items2_1' <?php if($_GET['type'] == 2){ }else{ ?>style="display:none;"<?php } ?>>
<dd><a href="<?php echo U('Member/users',array('type'=>'2'));?>">·管理</a></dd>
<dd><a href="<?php echo U('Member/adduser',array('type'=>'2'));?>">·新增账号</a></dd>
<dd><a href="<?php echo U('Member/fadduser');?>">·批量新增账号</a></dd>
</dl>

<a onClick='showHide("items2_2")'><li>团体账号管理</li></a>
<dl id="items2_2" <?php if($_GET['type'] == 3){ }else{ ?>style="display:none;"<?php } ?>>
<dd><a href="<?php echo U('Member/users',array('type'=>'3'));?>">·管理</a></dd>
<dd><a href="<?php echo U('Member/adduser',array('type'=>'3'));?>">·新增</li></a></dd>
<dd><a href="<?php echo U('Member/fadduser');?>">·批量新增</a></dd>
</dl>
<a onClick='showHide("items2_3")'><li>个人账号管理</li></a>
<dl id="items2_3" <?php if($_GET['type'] == 4){ }else{ ?>style="display:none;"<?php } ?>>
<dd><a href="<?php echo U('Member/users',array('type'=>'4'));?>">·管理</a></dd>
<dd><a href="<?php echo U('Member/adduser',array('type'=>'4'));?>">·新增</a></dd>
<dd><a href="<?php echo U('Member/fadduser');?>">·批量新增</a></dd>
</dl>
	<a onClick='showHide("items2_4")'><li>培训管理</li></a>
<dl id="items2_4" <?php if(CONTROLLER_NAME == 'Project'){ }else{ ?>style="display:none;"<?php } ?>>
<dd><a href="<?php echo U('Project/index');?>">·培训项目</a></dd>
<dd><a href="<?php echo U('Project/add');?>">·发布培训</a></dd>
</dl>
<a href="<?php echo U('Member/sendmessage');?>"><li>发布站内信</li></a>
<a  onClick='showHide("items2_5")' ><li>统计</li></a>

<dl id="items2_5" <?php if(CONTROLLER_NAME == 'Project'){ }else{ ?>style="display:none;"<?php } ?>>
<dd><a href="<?php echo U('Member/tongji');?>">.会员统计</a></dd>
<dd><a href="<?php echo U('Member/tongjiweb');?>">·站点统计</a></dd>
</dl>

<a href="<?php echo U('Index/exam');?>"><li>考试管理</li></a>
<a onClick='showHide("items2_6")'><li>网站信息管理</li></a>
<dl id="items2_6" <?php if(CONTROLLER_NAME == 'News'){ }else{ ?>style="display:none;"<?php } ?>>
<dd><a href="<?php echo U('News/index');?>">·信息列表</a></dd>
<dd><a href="<?php echo U('News/newsadd');?>">·新增信息</a></dd>
</dl>
<a onClick='showHide("items2_7")'><li>公告管理</li></a>
<dl id="items2_7" <?php if(CONTROLLER_NAME == 'Member' && (ACTION_NAME == 'article' || ACTION_NAME == 'articleadd')){ }else{ ?>style="display:none;"<?php } ?>>
<dd><a href="<?php echo U('Member/article');?>">·管理</a></dd>
<dd><a href="<?php echo U('Member/articleadd');?>">·新增公告</a></dd>
<dd><a href="<?php echo U('Member/articlestatus');?>">·公告审核</a></dd>
</dl>
<?php }else if(session('groupid') == 2){ ?>
<a onClick='showHide("items2_8")'><li>账号管理</li></a>
<dl id="items2_8" <?php if($_GET['type'] == 4){ }else{ ?>style="display:none;"<?php } ?>>
<dd><a href="<?php echo U('Member/users',array('type'=>'4'));?>">·管理</a></dd>
<dd><a href="<?php echo U('Member/adduser',array('type'=>'4'));?>">·新增</a></dd>
<dd><a href="<?php echo U('Member/fadduser');?>">·批量新增</a></dd>
</dl>
<a href="<?php echo U('Project/index');?>"><li>培训管理</li></a>
<a href="<?php echo U('Member/sendmessage');?>"><li>发布站内信</li></a>
<a href="<?php echo U('Member/tongji');?>"><li>统计</li></a>
<a href="<?php echo U('Index/exam');?>"><li>考试管理</li></a>
<a onClick='showHide("items2_9")'><li>公告管理</li></a>
<dl id="items2_9" <?php if(CONTROLLER_NAME == 'Member' && (ACTION_NAME == 'article' || ACTION_NAME == 'articleadd')){ }else{ ?>style="display:none;"<?php } ?>>
<dd><a href="<?php echo U('Member/article');?>">·管理</a></dd>
<dd><a href="<?php echo U('Member/articleadd');?>">·新增公告</a></dd>
</dl>
<?php }else if(session('groupid') == 3){ ?>
<a onClick='showHide("items2_10")'><li>个人账号管理</li></a>
<dl id="items2_10" <?php if($_GET['type'] == 4){ }else{ ?>style="display:none;"<?php } ?>>
<dd><a href="<?php echo U('Member/users',array('type'=>'4'));?>">·管理</a></dd>
<dd><a href="<?php echo U('Member/adduser',array('type'=>'4'));?>">·新增</a></dd>
<dd><a href="<?php echo U('Member/fadduser');?>">·批量新增</a></dd>
</dl>
<a href="<?php echo U('Member/tongji');?>"><li>统计</li></a>
<a href="<?php echo U('Index/exam');?>"><li>考试管理</li></a>
<a onClick='showHide("items2_11")'><li>公告管理</li></a>
<dl id="items2_11" <?php if(CONTROLLER_NAME == 'Member' && (ACTION_NAME == 'article' || ACTION_NAME == 'articleadd')){ }else{ ?>style="display:none;"<?php } ?>>
<dd><a href="<?php echo U('Member/article');?>">·管理</a></dd>
<dd><a href="<?php echo U('Member/articleadd');?>">·新增公告</a></dd>
</dl>
<?php } ?>

<?php if(session('groupid') != 1){ ?>
<a href="<?php echo U('Project/my');?>"><li>培训项目</li></a>
<?php } ?>
<?php if(session('groupid') != 1){ ?>
<a href="<?php echo U('Project/myproject');?>"><li>我的培训</li></a>
<?php } ?>
<a href="<?php echo U('Public/logout');?>"><li>退出</li></a>
<script>
function showHide(id){
	var name = document.getElementById(id).style.display;
	if(name == 'none'){
		document.getElementById(id).style.display = '';
	}else{
		document.getElementById(id).style.display = 'none';
	}
}
</script>

                </ul>
            </div>
        </div>
        <div class="ny_R right">

        	<div  class="neirong">
            	 <div class="reg" style="padding: 35px 0 35px 70px;">
<form action="" method="post" enctype="multipart/form-data">
<input type="hidden" name="action" value="send" />
<input type="hidden" id="uids" name="uids" value="" />
<ul>
<li class='text'><span>标题</span><input type="text" name="title" value="" /></li>
<li class="text"><span>发放用户</span>
<span id="s1">
<select name="type" onchange="fchange(this.value)">
<option value="0">请选择</option>
<option value="4">单个用户</option>
<?php echo ($list); ?>
</select></span><span id="s2" style="margin-left:45px;width:260px;display:none"><input style="width:120px" type="button" value="选择用户" onclick="showmodal();"/><input style="width:120px;margin-left:10px" type="button" onclick="showusers();" value="查看已选用户列表" /></span></li>
<li><span>内容</span><textarea name="content"></textarea></li>
<li><span>附件</span><input type="file" name="fujian"/></li>

<li><input type="submit" value="提交" class="submit"><input type="reset" value="重写" class="reset"><div class="clear"></div></li>

</ul>
</form>
</div>
    </div>
        </div><div class="clear"></div>
        <div class="blank"></div>
  </div>
    
</div>
<script>
function fchange(id){
	if(id == 4){
		document.getElementById('s2').style.display = '';
	}else{
		var u = document.getElementById("uids");
		u.value = '';
		document.getElementById('s2').style.display = 'none';
	}
}
function showmodal(){
	 var ret = window.showModalDialog("<?php echo U('Member/selectuser');?>",null,"dialogWidth:800px;dialogHeight:500px;help:no;status:no");
	// if(ret == ''){
	//	 alert('未选择用户');
	// }else{
	//	 var u = document.getElementById("uids");
	//	 u.value = ret;
	//	 var unum = new Array();
	//	 unum = ret.split(",");
	//	 alert("共选择了"+unum.length+"位用户");
	// }
	}
function showusers(){
	//var user = document.getElementById('uids').value;
	//if(user == ''){
		//alert("发送用户为空");
	//}else{
		var ret = window.showModalDialog("<?php echo U('Member/showusers');?>",null,"dialogWidth:800px;dialogHeight:500px;help:no;status:no");
	//}
}
</script>
<!--底部开始-->
<div class="dibu">
	<div align="center"><a>关于我们</a>   <a>网站版权</a>   <a>网站地图</a>     <a>合作联系</a>     <a>意见反馈</a>   <a>联系我们</a></div>
    <p>主办：宁夏医师协会<br />

</p>
</div>
</body>
</html>