<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>医师协会1</title>
<link href="/phpapp/yishi/Public/Home/css/style.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="/phpapp/yishi/Public/Js/jquery-1.8.3.min.js"></script>
    <script type="text/javascript" src="/phpapp/yishi/Public/Js/jquery.Xslider.js"></script>
<script type="text/javascript">
$(document).ready(function(){


	// 焦点图片淡隐淡现
	$("#slider3").Xslider({
		affect:'fade',
		ctag: 'div'
	});
});
</script>
</head>

<body>
<!--top-->
<div id="top">
	<div class="top">
    	<div class="logo left"><img src="/phpapp/yishi/Public/Home/images/logo.jpg"  /></div>
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
<div class="con_row_2 w_1000">
  	  <div class="con_hd left">
       	  <div id="slider3" class="slider">
			<div class="conbox">
				<div><a href="#" title=""><img width="347" height="300" alt="" src="http://www.nxyxh.net/uploadfile/pro/20147/2014070717182621191.jpg"></a></div>
				<div><a href="#" title=""><img width="347" height="300" alt="" src="http://www.nxyxh.net/uploadfile/pro/20147/2014070717142355292.jpg"></a></div>
				<div><a href="#" title=""><img width="347" height="300" alt="" src="http://www.nxyxh.net/uploadfile/pro/20147/2014070716292198261.jpg"></a></div>
				<div><a href="#" title=""><img width="347" height="300" alt="" src="http://www.nxyxh.net/uploadfile/pro/20147/2014070716213331177.jpg"></a></div>
				<div><a href="#" title=""><img width="347" height="300" alt="" src="http://www.nxyxh.net/uploadfile/pro/20146/2014062512224568135.jpg"></a></div>
			</div>
			<div class="switcher">
				<a href="#" class="cur">1</a>
				<a href="#">2</a>
				<a href="#">3</a>
				<a href="#">4</a>
				<a href="#">5</a>
			</div>
		</div><!--slider end-->
      </div>
      <div class="con_row1_R left">
       	  <h2><div class="left">行业动态 <span>Dynamic</span></div><div class="right"><a href="<?php echo U('Index/category',array('sortid'=>'7'));?>"><img src="/phpapp/yishi/Public/Home/images/more.png"/></a></div><div class="clear"></div></h2>
          <?php if(is_array($hydt)): $i = 0; $__LIST__ = array_slice($hydt,1,1,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$hydtlists): $mod = ($i % 2 );++$i;?><h5><a href="<?php echo U('Index/article',array('id'=>$hydtlist['id']));?>"><?php echo ($hydtlist["title"]); ?></a></h5><?php endforeach; endif; else: echo "" ;endif; ?>
    <ul>
                	 <?php if(is_array($hydt)): $i = 0; $__LIST__ = $hydt;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$hydtlist): $mod = ($i % 2 );++$i;?><li><a href="<?php echo U('Index/article',array('id'=>$hydtlist['id']));?>"><span class="left"><?php if($hydtlist['istop'] == 1): ?><span style="color:red"><?php echo ($hydtlist["title"]); ?></span><?php else: echo ($hydtlist["title"]); endif; ?></span><span class="right"><?php echo (date('Y-m-d',$hydtlist["posttime"])); ?></span></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
                </ul>
      </div>
      <div class="box huiyuantd right" style="overflow:hidde">
        	<h3><img src="/phpapp/yishi/Public/Home/images/ico_06.jpg" class="abs left" />会员通道</h3>
<dl class="denglu">
<?php if(!is_login()){ ?>
<form action="<?php echo U('Public/login');?>" method="post">
            	<dd><label>用户名：</label><input type="text" class="input" name="uname" /></dd>
                <dd><label>密&nbsp;&nbsp;码：</label><input type="password" class="input" name="pwd" /></dd>
                <dd>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  <input name="提交" type="submit" class="submit" value="提交" /><input name="" type="reset" value="重置" class="submit" /><input type="hidden" name="action" value="logindo" />
                </dd>
                <!--
              <dd style="text-align:center"><a href="">立即注册</a>&nbsp;&iacute;&nbsp;<a href="#">忘记密码</a></dd>
              -->
            </form>
            <?php }else{ ?>
     <dd><label>欢迎您<?php echo (getgroupname(session('groupid'))); ?>会员<?php echo ($_SESSION['user']['uname']); ?></label></dd>
     <dd><label><a href="<?php echo U('Member/index');?>">进入<span style="color:red;font-size:18px">会员中心</span></a></label></dd>
     <dd><label><a href="<?php echo U('Public/logout');?>">退出登录</a></label></dd>
     <?php } ?>
            </dl>

        </div>
         <div style="margin-top:10px;margin-right:2px" class="right"><img src="/phpapp/yishi/Public/Home/ban_img.png" width="267" /></div>
      <div class="blank"></div>
      <div class="mb10"><img src="/phpapp/yishi/Public/Home/images/ban_1.jpg" width="1000" height="143" /></div>
      <div class="w_1000">
      <!--1-->
   	  <div class="box w_490 left">
        	<h2><img src="/phpapp/yishi/Public/Home/images/ico_01.jpg" class="abs left" />政策法规<a href="<?php echo U('Index/category',array('sortid'=>'14'));?>"><img src="/phpapp/yishi/Public/Home/images/more.png" class="more right" /></a></h2>
            <ul class="list">
            	<?php if(is_array($zcfg)): $i = 0; $__LIST__ = $zcfg;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$zcfglist): $mod = ($i % 2 );++$i;?><li><a href="<?php echo U('Index/article',array('id'=>$zcfglist['id']));?>"><span class="left"><?php echo ($zcfglist["title"]); ?>...</span><span class="right">[<?php echo (date('Y-m-d',$zcfglist["posttime"])); ?>]</span></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>
        </div>
     <!--1 end-->

     <!--2-->
   	  <div class="box w_490 right">
        	<h2><img src="/phpapp/yishi/Public/Home/images/ico_01.jpg" class="abs left" />工作动态<a href="<?php echo U('Index/category',array('sortid'=>'5'));?>"><img src="/phpapp/yishi/Public/Home/images/more.png" class="more right" /></a></h2>
            <ul  class="list">
            <?php if(is_array($gzdt)): $i = 0; $__LIST__ = $gzdt;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$gzdtlist): $mod = ($i % 2 );++$i;?><li><a href="<?php echo U('Index/article',array('id'=>$gzdtlist['id']));?>"><span class="left"><?php echo ($gzdtlist["title"]); ?>...</span><span class="right">[<?php echo (date('Y-m-d',$gzdtlist["posttime"])); ?>]</span></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>
        </div>
     <!--2 end-->
    <div class="blank"></div>
      <div class="mb10"><img src="/phpapp/yishi/Public/Home/images/ban_2.jpg" width="1000" height="60" /></div>
     <!--1-->
   	  <div class="box w_490 left">
        	<h2><img src="/phpapp/yishi/Public/Home/images/ico_01.jpg" class="abs left" />最新培训<a href="<?php echo U('Project/my');?>"><img src="/phpapp/yishi/Public/Home/images/more.png" class="more right" /></a></h2>
            <ul  class="list">
            <?php if(is_array($project)): $i = 0; $__LIST__ = $project;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$projectlist): $mod = ($i % 2 );++$i;?><li><a href="<?php echo U('Project/my');?>"><span class="left"><?php echo ($projectlist["title"]); ?>...</span><span class="right">[<?php echo (date('Y-m-d',$projectlist["posttime"])); ?>]</span></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>
        </div>
     <!--1 end-->

     <!--2-->
   	  <div class="box w_490 right">
        	<h2><img src="/phpapp/yishi/Public/Home/images/ico_01.jpg" class="abs left" />医疗评审<a href="<?php echo U('Index/category',array('sortid'=>'3'));?>"><img src="/phpapp/yishi/Public/Home/images/more.png" class="more right" /></a></h2>
            <ul  class="list">
            <?php if(is_array($ylps)): $i = 0; $__LIST__ = $ylps;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$ylpslist): $mod = ($i % 2 );++$i;?><li><a href="<?php echo U('Index/article',array('id'=>$ylpslist['id']));?>"><span class="left"><?php echo ($ylpslist["title"]); ?>...</span><span class="right">[<?php echo (date('Y-m-d',$ylpslist["posttime"])); ?>]</span></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>
        </div>
     <!--2 end-->
    
      </div>
     
      
      <div class="blank"></div>
      
      <!--1-->
   	  
     <!--1 end-->
     
     <!--2--><!--2 end-->
     <!--3-->
   	  
     <!--3 end-->
     
     
     <!--1-->
   	  
     <!--1 end-->
     
     <!--2--><!--2 end-->
  
    
     <div class="blank"></div>
     <div class="yqlj">
     	<h2>友情链接</h2>
        <ul>
        <?php if(is_array($link)): $i = 0; $__LIST__ = $link;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$linklist): $mod = ($i % 2 );++$i;?><li><a href="<?php echo ($linklist["link"]); ?>" target="_blank"><?php echo ($linklist["title"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>
     </div>
  </div>
</div>
<!--底部开始-->
<div class="dibu">
	<div align="center"><a>关于我们</a>   <a>网站版权</a>   <a>网站地图</a>     <a>合作联系</a>     <a>意见反馈</a>   <a>联系我们</a></div>
   <p>主办：浙江医师协会<br />

</p>
</div>
</body>
</html>