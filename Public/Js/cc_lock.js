var xmlHttp; //定义XMLHttpRequest对象

function createXmlHttpRequestObject()
{
	//如果在internet Explorer下运行
	if(window.ActiveXObject)
	{
		try {
			xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
		catch(e){
			xmlHttp=false;
			}
	}
	else
	{
		//如果在Mozilla或其他的浏览器下运行
		try {
			xmlHttp=new XMLHttpRequest();
			}
		catch(e){
			xmlHttp=false;
			}
	}
	//返回创建的对象或显示错误信息
	if(!xmlHttp)
	{
		alert("返回创建的对象或显示错误信息");
	}
	else
	{
		return xmlHttp;
	}
}

// JavaScript Document

function chkUserLock()
{
	createXmlHttpRequestObject();
	
	xmlHttp.onreadystatechange = callBackFun; //指定回调函数
	xmlHttp.open('GET', 'lock_chk.php', true); //使用GET方法调用chk.php
	xmlHttp.send(null); //不发送任何数据，因为数据已经使用请求URL通过GET方法发送
}

//回调函数
function callBackFun()
{
	if(xmlHttp.readyState == 4 && xmlHttp.status == 200)
	{
		//如果服务器已经传回信息并没发生错误
		
		if(xmlHttp.responseText == 'y')
		{
			chkLogOut();
			alert('账号已锁定，请联系管理员！');
			window.location.href='./logout.php';
		}
	}
}

function chkLogOut()
{
	createXmlHttpRequestObject();
	xmlHttp.open('GET', 'logout.php', true); //使用GET方法调用chk.php
	xmlHttp.send(); //不发送任何数据，因为数据已经使用请求URL通过GET方法发送
}