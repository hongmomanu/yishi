<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>医师协会</title>
<link href="__PUBLIC__/Home/css/style.css" type="text/css" rel="stylesheet" />
</head>

<body>
<!--top-->
<div id="top">
	<div class="top">
    	<div class="logo left"><img src="__PUBLIC__/Home/images/logo.jpg"  /></div>
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
                    <li><a href="<?php echo U('Member/index');?>">会员中心</a></li>
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
    	<div class="gonggaot"><img src="__PUBLIC__/Home/images/laba.jpg" width="20" height="39" class="left mr10" /><?php echo gonggao(); ?></div>
        <div class="blank"></div>
<div class="ny_L">
        	<div class="ny_Lbox mb10">
            	<h3>快速导航</h3>
                <ul>
                	            <li><a href="<?php echo U('Index/index');?>">首页</a></li>
        	 	
        	<li><a href="<?php echo U('Index/category',array('sortid'=>'14'));?>">政策法规</a></li>
        	<li><a href="<?php echo U('Member/index');?>">会员管理</a>
            
            </li>
            
        	<li><a href="<?php echo U('Index/category',array('sortid'=>'3'));?>">医疗评审</a>
           
           
            
                </li>
        	<li><a href="<?php echo U('Index/exam');?>">考核培训</a>
             
            </li>
           
                </ul>
            </div>
            

        	
        </div>
        <div class="ny_R right">
        	<h2><img src="__PUBLIC__/Home/images/ny_t.jpg" width="7" height="20" /><?php echo ($name); ?></h2>
            <ul class="dongtai">
            <?php if(is_array($list)): $k = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$article): $mod = ($k % 2 );++$k;?><li <?php if($k%2 == 0): ?>style="background:#f1f6fc"<?php endif; ?>><span class="left">·<a href="<?php echo U('Index/article',array('id'=>$article['id']));?>"> <?php echo ($article["title"]); ?></a></span><span class="right"><?php echo (date('Y-m-d',$article["posttime"])); ?></span></li><?php endforeach; endif; else: echo "" ;endif; ?>	
              </ul>
            
<div style="width: 95%; height: 30px; overflow: hidden; text-align: center; font-weight: bold; margin-bottom:10px; margin-top:10px; font-size:14px;">
                                          <?php echo ($page); ?>
                                            </div>

        </div><div class="clear"></div>
        <div class="blank"></div>
        
        <div class="yqlj">
     	<h2>友情链接</h2>
        <ul>
        <?php if(is_array($link)): $i = 0; $__LIST__ = $link;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$linklist): $mod = ($i % 2 );++$i;?><li><a href="<?php echo ($linklist["link"]); ?>" target="_blank"><?php echo ($linklist["title"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
        
        </ul>
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