<?php
/**
*author:quanyinzhong
*email:290551872@163.com
*website:http://www.35258.com
**/
namespace Home\Model;
class PxsonitemModel extends \Think\Model{
	protected $_auto = array (
			array('posttime','time',3,'function'), // 对update_time字段在更新的时候写入当前时间戳
			array('uid','is_login',3,'function'), // 对update_time字段在更新的时候写入当前时间戳
			array('title','trim',3,'function'), // 对update_time字段在更新的时候写入当前时间戳
	);
	public static function getInfo($id){
		$data = M('pxsonitem')->find($id);
		return $data;
	}
	
}