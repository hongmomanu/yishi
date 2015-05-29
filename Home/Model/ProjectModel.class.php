<?php
/**
*author:quanyinzhong
*email:290551872@163.com
*website:http://www.35258.com
**/
namespace Home\Model;
class ProjectModel extends \Think\Model{
	protected $_auto = array (
			array('posttime','time',1,'function'), // 对update_time字段在更新的时候写入当前时间戳
			array('uid','is_login',1,'function'), // 对update_time字段在更新的时候写入当前时间戳
	);
	public static function getInfo($id){
		$data = M('project')->find($id);
		return $data;
	}
	//计算培训学分
	public static function socre($uid = ''){
		if($uid){
			$condition['uid'] = $uid;
			$data = M('project')->where($condition)->field('score')->select();
		}else{
			$data = M('project')->field('score')->select();
		}
		
		$sc = array();
		foreach($data as $k=>$v){
			array_push($sc, $v['score']);
		}
		$totalscore = array_sum($sc);
		return $totalscore;
	}
	
}