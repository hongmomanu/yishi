<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>医师协会</title>
<link href="/phpapp/yishi/Public/Home/css/style.css" type="text/css" rel="stylesheet" />
<script src="/phpapp/yishi/Public/media/jquery.js"></script>
<script src="/phpapp/yishi/js/highcharts.js"></script>
<script src="/phpapp/yishi/js/highcharts-3d.js"></script>
<script src="/phpapp/yishi/js/modules/exporting.js"></script>
<?php if(IS_POST){ ?>
<script type="text/javascript">
$(function () {
    $('#container').highcharts({
        chart: {
            type: 'column',
            margin: 75,
            options3d: {
				enabled: true,
                alpha: 10,
                beta: 25,
                depth: 70
            }
        },
        title: {
            text: '人员统计'
        },
        subtitle: {
            text: ''
        },
        plotOptions: {
            column: {
                depth: 25
            }
        },
        xAxis: {
        	categories: ['参与人数','合格人数','合格率']
        },
        yAxis: {
            opposite: true
        },
        series: [{
            name: '人数',
            data: [<?php echo ($count1); ?>,<?php echo ($count2); ?>,<?php echo ($count3); ?>]
        }]
    });
});
		</script>
<?php }else{ ?>
<script type="text/javascript">
$(function () {
    $('#container').highcharts({
        chart: {
            type: 'column',
            margin: 75,
            options3d: {
				enabled: true,
                alpha: 10,
                beta: 25,
                depth: 70
            }
        },
        title: {
            text: '人员统计'
        },
        subtitle: {
            text: ''
        },
        plotOptions: {
            column: {
                depth: 25
            }
        },
        xAxis: {
        	categories: ['分会','团体','个人','男','女','专科','本科','研究生','其他','临床','口腔','公共卫生','中医','执业医师','执业助理医生']
        },
        yAxis: {
            opposite: true
        },
        series: [{
            name: '人数',
            data: [<?php echo ($newchar); ?>]
        }]
    });
});
		</script>
<?php } ?>
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
	<div class="ny_con">
    	<div class="gonggaot"><img src="/phpapp/yishi/Public/Home/images/laba.jpg" width="20" height="39" class="left mr10" /><?php echo gonggao(); ?></div>
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
<a href="<?php echo U('Member/tongji');?>"><li>统计</li></a>
<a href="<?php echo U('Index/exam');?>"><li>考试管理</li></a>
<a onClick='showHide("items2_5")'><li>网站信息管理</li></a>
<dl id="items2_5" <?php if(CONTROLLER_NAME == 'News'){ }else{ ?>style="display:none;"<?php } ?>>
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
<a onClick='showHide("items2_3")'><li>账号管理</li></a>
<dl id="items2_3" <?php if($_GET['type'] == 4){ }else{ ?>style="display:none;"<?php } ?>>
<dd><a href="<?php echo U('Member/users',array('type'=>'4'));?>">·管理</a></dd>
<dd><a href="<?php echo U('Member/adduser',array('type'=>'4'));?>">·新增</a></dd>
<dd><a href="<?php echo U('Member/fadduser');?>">·批量新增</a></dd>
</dl>
<a href="<?php echo U('Project/index');?>"><li>培训管理</li></a>
<a href="<?php echo U('Member/sendmessage');?>"><li>发布站内信</li></a>
<a href="<?php echo U('Member/tongji');?>"><li>统计</li></a>
<a href="<?php echo U('Index/exam');?>"><li>考试管理</li></a>
<a onClick='showHide("items2_7")'><li>公告管理</li></a>
<dl id="items2_7" <?php if(CONTROLLER_NAME == 'Member' && (ACTION_NAME == 'article' || ACTION_NAME == 'articleadd')){ }else{ ?>style="display:none;"<?php } ?>>
<dd><a href="<?php echo U('Member/article');?>">·管理</a></dd>
<dd><a href="<?php echo U('Member/articleadd');?>">·新增公告</a></dd>
</dl>
<?php }else if(session('groupid') == 3){ ?>
<a onClick='showHide("items2_3")'><li>个人账号管理</li></a>
<dl id="items2_3" <?php if($_GET['type'] == 4){ }else{ ?>style="display:none;"<?php } ?>>
<dd><a href="<?php echo U('Member/users',array('type'=>'4'));?>">·管理</a></dd>
<dd><a href="<?php echo U('Member/adduser',array('type'=>'4'));?>">·新增</a></dd>
<dd><a href="<?php echo U('Member/fadduser');?>">·批量新增</a></dd>
</dl>
<a href="<?php echo U('Member/tongji');?>"><li>统计</li></a>
<a href="<?php echo U('Index/exam');?>"><li>考试管理</li></a>
<a onClick='showHide("items2_7")'><li>公告管理</li></a>
<dl id="items2_7" <?php if(CONTROLLER_NAME == 'Member' && (ACTION_NAME == 'article' || ACTION_NAME == 'articleadd')){ }else{ ?>style="display:none;"<?php } ?>>
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
        	<div style="padding: 35px 0 35px 70px;">
        	<form action="" method="post">
        	性别
<select name="sex">
<option value="0">请选择</option>
<option value="1">男</option>
<option value="2">女</option>
</select>
年龄<input size="5" type="text" name="start" value="" />-<input type="text" size="5" name="end" value="" />
医师级别<select name="ysjb">
<option value="0">请选择</option>
<option value="1">执业医师</option>
<option value="2">执业助理医师</option>
</select>
学历<select name="xueli">
<option value="0">请选择</option>
<option value="1">专科</option>
<option value="2">本科</option>
<option value="3">研究生</option>
<option value="4">其他</option>
</select>
执业范围
<select name="zyfw">
<option value="0">请选择</option>
<option value="1">临床</option>
<option value="2">口腔</option>
<option value="3">公共卫生</option>
<option value="4">中医</option>
</select>
培训项目<select name="project">
<option value="0">请选择</option>
<?php if(is_array($pxxm)): $i = 0; $__LIST__ = $pxxm;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$pxxmlist): $mod = ($i % 2 );++$i;?><option value="<?php echo ($pxxmlist["id"]); ?>"><?php echo ($pxxmlist["title"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
</select>
<input type="submit" value="筛选" />
</form>
</div>
<div class="reg" style="padding: 35px 0 35px 70px;">
<?php if(IS_POST){ ?>

<?php }else{ ?>
<ul>
<li class="text">当前在线：<?php echo ($countper); ?>个</li>
<li class="text">分会：<?php echo ($data["fenhui"]); ?>个</li>
<li class="text">单位：<?php echo ($data["tuanti"]); ?>个</li>
<li class="text">个人：<?php echo ($data["person"]); ?>个</li>
<li class="text">男：<?php echo ($data["man"]); ?>个</li>
<li class="text">女：<?php echo ($data["woman"]); ?>个</li>
<li class="text">专科：<?php echo ($data["zhuanke"]); ?>个</li>
<li class="text">本科：<?php echo ($data["benke"]); ?>个</li>
<li class="text">研究生：<?php echo ($data["yanjiusheng"]); ?>个</li>
<li class="text">其他学历：<?php echo ($data["qita"]); ?>个</li>
<li class="text">临床：<?php echo ($data["linchuang"]); ?>个</li>
<li class="text">口腔：<?php echo ($data["kouqiang"]); ?>个</li>
<li class="text">公共卫生：<?php echo ($data["gonggongweisheng"]); ?>个</li>
<li class="text">中医：<?php echo ($data["zhongyi"]); ?>个</li>
<li class="text">执业医师：<?php echo ($data["zyys"]); ?>个</li>
<li class="text">执业助理医生：<?php echo ($data["zyzlys"]); ?>个</li>
<li class="text">培训项目：<?php echo ($data["pxxm"]); ?>个</li>
<li class="text">培训参与人数:<?php echo ($data["pxperson"]); ?></li>
<li class="text">培训学分:<?php echo ($data["totalscore"]); ?></li>
</ul>
<?php } ?>
<div id="container" style="height: 400px"></div>
</div>
            </div>
        </div><div class="clear"></div>
        <div class="blank"></div>
        
  
  </div>
    
</div>
<!--底部开始-->
<div class="dibu">
	<div align="center"><a>关于我们</a>   <a>网站版权</a>   <a>网站地图</a>     <a>合作联系</a>     <a>意见反馈</a>   <a>联系我们</a></div>
    <p>主办：宁夏医师协会<br />

</p>
</div>
</body>
</html>