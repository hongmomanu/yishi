<?php
/**
*author:quanyinzhong
*email:290551872@163.com
*website:http://www.35258.com
**/
namespace Admin\Model;
class AuthgroupModel extends \Think\Model{
	protected $trueTableName = 'auth_group'; 
	//缓存所有地区信息
	public static function groupCache(){
		$file = 'group';
		if(S($file)){
			$result = S($file);
		}else{
			$condition['status'] = 1;
			$data = M('auth_group')->where($condition)->select();
			S($file,$data,86400);
			$result = $data;
		}
		return $result;
	}
	//重建缓存
	public static function rebuildgroup(){
		$file = 'group';
		S($file,Null);
		self::groupCache();
	}
	//根据id返回分组名称
	public static function getById($id){
		$result = self::groupCache();
		foreach($result as $k=>$v){
			if($v['id'] == $id){
				$data = $v;
			}
		}
		return $data;
	}
	//根据类型返回分组
	public static function getGroup($type){
		$data = self::groupCache();
		foreach($data as $k=>$v){
			if($v['module'] != $type){
				unset($data[$k]);
			}
		}
		return $data;
	}
}