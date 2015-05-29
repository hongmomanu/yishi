<?php
/**
*author:quanyinzhong
*email:290551872@163.com
*website:http://www.35258.com
**/
namespace Admin\Model;
class SysuserModel extends \Think\Model{
	protected $_validate = array(
		array('uname','','用户名已存在',0,'unique',3), // 在新增的时候验证name字段是否唯一
	);
	//登陆
	public static function login($username,$password){
		$condition['uname'] = $username;
		$condition['password'] = md5($password);
		$user = M('sysuser')->where($condition)->Field('id,uname,status')->find();
		if($user){
			if($user[status] != 1){
				$code = 1;
			}else{
				//获取用户所属组
				$groupid = D('authgroupaccess')->getGroupid($user['id']);
				session('auid',$user['id']);
				session('auser',$user);
				session('groupid',$groupid);
				$code = 0;
			}
		}else{
			$code = 2;
		}
		D('Loginlog')->loginlog($username,$code);
		return $code;
	}
	//缓存所有用户信息
	public static function userCache(){
		$file = 'user';
		if(S($file)){
			$result = S($file);
		}else{
			$data = M('sysuser')->field('id,uname')->select();
			S($file,$data,86400);
			$result = $data;
		}
		return $result;
	}
	//重建缓存
	public static function rebuildUser(){
		$file = 'user';
		S($file,Null);
		self::userCache();
	}
	//根据id返回用户
	public static function getById($id){
		$result = self::userCache();
		foreach($result as $k=>$v){
			if($v['id'] == $id){
				$data = $v;
			}
		}
		return $data;
	}
	//返回客服信息
	public static function serviceUser(){
		$result = self::userCache();
		foreach($result as $k=>$v){
			if($v['lev'] != 'service'){
				unset($result[$k]);
			}
		}
		
		return $result;
	}
}