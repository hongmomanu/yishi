function init(title,content,url)
{
	var divTip = document.createElement("div");
	divTip.id="tip";
	divTip.innerHTML="<h1><a href='javascript:void(0)' onclick='start()'>×</a>" + title + "</h1><p><a href='" + url + "' onclick='start()'>" + content + "</a></p>";
	divTip.style.height='0px';
	divTip.style.bottom='0px';
	divTip.style.position='fixed';
	document.body.appendChild(divTip);
	start();
	setTimeout("start();",10000);
}

var handle;

function start()
{
	var obj = document.getElementById("tip");
	if (parseInt(obj.style.height)==0)
	{
		obj.style.display="block";
		handle = setInterval("changeH('up')",20);
		//window.setTimeout('start()',5000);
	}
	else
	{
		handle = setInterval("changeH('down')",20);
	}
}

function changeH(str)
{
	var obj=document.all?document.all["tip"] : document.getElementById("tip");
	if(str=="up")
	{
		if (parseInt(obj.style.height)>100)
		{
			clearInterval(handle);
		}
		else
		{
			obj.style.height=(parseInt(obj.style.height)+8).toString()+"px";
		}
	}
	if(str=="down")
	{
		if (parseInt(obj.style.height)<8)
		{
			clearInterval(handle);
			obj.style.display="none";
		}
		else
		{
			obj.style.height=(parseInt(obj.style.height)-8).toString()+"px";
		}
	}
}