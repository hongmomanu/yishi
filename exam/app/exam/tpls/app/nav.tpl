<link href="/Public/Home/css/styleks.css" type="text/css" rel="stylesheet" />
<div id="topks">
	<div class="topks">
    	<div class="logo left"><img src="/Public/Home/images/logo.jpg"  /></div>
        <div class="jiansuo right">
        	<ul>
            	{x2;if:$_user['teacher_subjects']}
							<li><a href="index.php?exam-teach">教师管理</a></li>
							{x2;endif}
							<li><a href="index.php?user-app-center">个人中心</a></li>
							<li><a href="index.php?user-app-logout">退出</a></li>
            </ul>
            
        </div>
    </div>
</div>
<!--top end-->
<div class="banner"></div>
<div id="nav">
	<div class="navks">
    <ul>
        	<li><a href="/index.php/Index/index">首页</a></li>
        	<li><a  href="javascript(void)">协会文件</a>
            	<ul style="z-index:1000">
                    <li><a href="/index.php/Index/about">协会简介	</a></li>
                    <li><a href="/index.php/Index/alonepage/id/2">协会领导</a></li>
                    <li><a href="/index.php/Index/alonepage/id/3"> 组织机构</a></li>
            	</ul>
            </li> 	
        	<li><a href="/index.php/Index/category/sortid/14">政策法规</a></li>
        	<li><a  href="{:U('Member/index')}">会员管理</a>
             <ul style="z-index:1000">
                    <li><a href="/index.php/Index/category/sortid/15">会费标准 </a></li>
                    <li><a href="/index.php/Index/category/sortid/16">会员管理办法</a></li>
                    <li><a href="/index.php/Member/index}">会员中心</a></li>
            	</ul>
            </li>
            
        	<li><a  href="/index.php/Index/category/sortid/3">医疗评审</a>
           
            <ul style="z-index:1000">
                    <li><a href="/index.php/Index/category/sortid/17">医疗机构校验</a></li>
                    <li><a href="/index.php/Index/category/sortid/18">医疗机构评审</a></li>
                    <li><a href="/index.php/Index/category/sortid/19">医疗设备评审</a></li>
                    <li><a href="/index.php/Index/category/sortid/20">医疗技术评审</a></li>
            	</ul>
            
                </li>
        	<li><a  href="/index.php/Index/exam">考核培训</a>
             <ul style="z-index:1000">
                    <li><a href="/index.php/Index/exam">继教培训</a></li>
            	</ul>
            </li>
      </ul>
    </div>
</div>
