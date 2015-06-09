<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>医师协会</title>
<link href="/Public/Home/css/style.css" type="text/css" rel="stylesheet" />
<script>
function Edit(id)
{
	location.href='<?php echo U('Member/edit');?>/id/'+ id;
}
function View(uid,type)
{
	location.href='<?php echo U('Member/users');?>/uid/'+ uid +'/type/'+ type;
}
function Change(id,type)
{
	if(type == 1){
		if (confirm("确定启用账户？请慎重操作！"))
		{
			location.href='<?php echo U('Member/changestatus');?>/id/'+ id +'/status/1';
		}
	}else{
		if (confirm("确定禁用账户？请慎重操作！"))
		{
			location.href='<?php echo U('Member/changestatus');?>/id/'+ id +'/status/0';
		}
	}
}
function Search(){
	var name = document.getElementById('UserName').value;
	location.href="<?php echo U('Member/users',array('type'=>I('get.type')));?>/uname/"+name;
}
</script>
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
<a  onClick='showHide("items2_4_0")' ><li>统计</li></a>

<dl id="items2_4_0">
<dd><a href="<?php echo U('Member/tongji');?>">.会员统计</a></dd>
<dd><a href="<?php echo U('Member/tongjiweb');?>">·站点统计</a></dd>
</dl>

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
        	<table class="bomdiv" border="0">
<tr>
<td nowrap="nowrap"><p>&nbsp;<?php echo getGroupName(I('get.type')); ?>会员用户名：</p></td>
<td nowrap="nowrap"><input name="UserName" type="text" class="Input_W80 bomdivinp" id="UserName" value="<?php echo ($keyword); ?>" size="10"></td>
<td nowrap="nowrap"><input class="bomdivcha" type="button" name="Submit2" value="查询" onClick="Search()"></td>
</tr>
</table>
        	<div class="all_table">
<table cellspacing="0" cellpadding="0">
  <tr id="all_table_top">
    <td nowrap='nowrap'>id</td>
    <td nowrap='nowrap'>用户名</td>
    <?php if(I('get.type') == 4){ ?>
    <td nowrap='nowrap'>真实姓名</td>
    <td nowrap='nowrap'>到期日期</td>
    <?php } ?>
    <td nowrap='nowrap'>单位名称</td>
	
	<td nowrap='nowrap'>注册日期</td>
	
	<td nowrap='nowrap'>状态</td>
	<td nowrap='nowrap'>联系电话</td>
	<td nowrap='nowrap'>操作</td>
  </tr>
  <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$user): $mod = ($i % 2 );++$i;?><tr>
<td nowrap='nowrap'><?php echo ($user["id"]); ?></td>
<td nowrap='nowrap'><?php echo ($user["uname"]); ?></td>
 <?php if(I('get.type') == 4){ ?>
<td nowrap='nowrap'><?php echo ($user["truename"]); ?></td>
<td nowrap='nowrap'><?php echo (date('Y-m-d H:i:s',$user["expeirtime"])); ?></td>
<?php } ?>
<td nowrap='nowrap'><?php echo ($user["company"]); ?></td>
<td nowrap='nowrap'><?php echo (date('Y-m-d H:i:s',$user["posttime"])); ?></td>

<td nowrap='nowrap'><?php if($user['status'] == 1): ?>正常<?php else: ?>锁定<?php endif; ?></td>

<td nowrap='nowrap'><?php echo ($user["phone"]); ?> </td>
<td nowrap='nowrap'>
<?php if($user['status'] == 1): ?><span style="cursor:pointer;" title="编辑" onclick="Change(<?php echo ($user["id"]); ?>,0)">[冻结]</span>
<?php else: ?>
<span style="cursor:pointer;" title="编辑" onclick="Change(<?php echo ($user["id"]); ?>,1)">[恢复]</span><?php endif; ?>
<?php if(I('get.type') == 2){ ?>
<span style="cursor:pointer;" title="删除" onclick="View(<?php echo ($user["id"]); ?>,4)">[分会信息]</span>
<?php }else if(I('get.type') == 3){ ?>
<span style="cursor:pointer;" title="删除" onclick="View(<?php echo ($user["id"]); ?>,4)">[团体信息]</span>
<?php } ?>
<span style="cursor:pointer;" title="删除" onclick="Edit(<?php echo ($user["id"]); ?>)">[修改]</span>
</td>
</tr><?php endforeach; endif; else: echo "" ;endif; ?>
</table>
</div>
            
<div style="width: 95%; height: 30px; overflow: hidden; text-align: center; font-weight: bold; margin-bottom:10px; margin-top:10px; font-size:14px;">
                                            <?php echo ($page); ?>
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