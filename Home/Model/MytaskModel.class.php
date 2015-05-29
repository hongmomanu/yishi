<?php
/**
*author:quanyinzhong
*email:290551872@163.com
*website:http://www.35258.com
**/
namespace Home\Model;
class MytaskModel extends \Think\Model{
	//获取单片文章
	public static function getNewsByid($id){
		$condition['pid'] = $id;
		$condition['uid'] = is_login();
		$data = M('mytask')->where($condition)->find();
		return $data;
	}
	//获取信息
	public static function getInfoByid($id){
		$condition['sid'] = $id;
		$condition['uid'] = is_login();
		$data = M('mytask')->where($condition)->find();
		return $data;
	}
	//判断任务是否完成
	public static function getStatus($map){
		$result = M('mytask')->where($map)->find();
		return $result;
	}
}