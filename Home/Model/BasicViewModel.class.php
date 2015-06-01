<?php
/**
*author:quanyinzhong
*email:290551872@163.com
*website:http://www.35258.com
**/
namespace Home\Model;
use Think\Model\ViewModel;
class BasicViewModel extends ViewModel{
	public $viewFields = array(
			'Basic'=>array('basicid','basic'),
			'Openbasics'=>array('obuserid','obbasicid','_on'=>'Openbasics.obbasicid=Basic.basicid')
			);
}