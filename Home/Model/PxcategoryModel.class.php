<?php
/**
*author:quanyinzhong
*email:290551872@163.com
*website:http://www.35258.com
**/
namespace Home\Model;
class PxcategoryModel extends \Think\Model{
	protected $_auto = array (
			array('posttime','time',1,'function'), // 对update_time字段在更新的时候写入当前时间戳
			array('uid','is_login',1,'function'), // 对update_time字段在更新的时候写入当前时间戳
	);
	
}