<?php
/**
*author:quanyinzhong
*email:290551872@163.com
*website:http://www.35258.com
**/
namespace Home\Model;
use Think\Model\ViewModel;
class ProjectViewModel extends ViewModel{
	public $viewFields = array(
			'Mytask'=>array('uid','pid','score',' isover'),
			'Project'=>array('id','_on'=>'Project.id=Mytask.pid')
			);
}