<?php
/**
*author:quanyinzhong
*email:290551872@163.com
*website:http://www.35258.com
**/
namespace Home\Model;
class HuibaoModel extends \Think\Model{
	//根据项目id返回回报列表
	public static function returnlist($pid){
		if($pid){
			$condition['pid'] = $pid;
			$data = M('huibao')->where($condition)->select();
			return $data;
		}
	}
	
}