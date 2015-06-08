<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>医师协会</title>
<link href="/Public/Home/css/style.css" type="text/css" rel="stylesheet" />
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
        <div class="login">
       	  <form action="<?php echo U('Public/login');?>" method="post">
       	  <input name="uname" type="text" class="login_text zhanghao" />
            <input name="pwd" type="password" class="login_text mima" />
            <input type="submit" class="login_au login_dl" value="登 陆" />
                <a href="<?php echo U('Public/reg');?>"><div class="login_au login_zc">注 册</div></a>
                <input name="" type="reset" class="login_au login_qx" value="取 消" />
                <div class="zddl"><input name="" type="checkbox" value="" />下次自动登陆</div>
                <div class="wjmm"><a href="<?php echo U('Public/forget');?>" target="_blank">忘记密码</a></div>
                <input type="hidden" name="action" value="logindo" />
            </form>
        </div>
        <div class="blank"></div>
    </div>
</div>
<!--底部开始-->
<div class="dibu">
	<div align="center"><a>关于我们</a>   <a>网站版权</a>   <a>网站地图</a>     <a>合作联系</a>     <a>意见反馈</a>   <a>联系我们</a></div>
    <p>主办：上海医师协会 上海市北京西路1477号<br />
技术支持：中国医师协会信息网络中心 上海市浦东新区峨山路91弄58号2楼B区<br />
沪ICP备13019324号-1</p>
</div>
</body>
</html>