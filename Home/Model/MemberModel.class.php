<?php
/**
*author:quanyinzhong
*email:290551872@163.com
*website:http://www.35258.com
**/
namespace Home\Model;
class MemberModel extends \Think\Model{
	 protected $_validate = array(
		array('uname','','用户名已存在',0,'unique',3), // 在新增的时候验证name字段是否唯一
	 	array('phone','','电话已存在',0,'unique',3), // 在新增的时候验证name字段是否唯一
	 	array('email','','邮箱已存在',0,'unique',3), // 在新增的时候验证name字段是否唯一
	 	array('repwd','repwd','确认密码不正确',0,'confirm'), // 验证确认密码是否和密码一致     
	 	array('pwd','checkPwd','密码格式不正确',0,'function'), // 自定义函数验证密码格式
		);
	 protected $_auto = array (            
	 		array('pwd','md5',3,'function') , // 对password字段在新增和编辑的时候使md5函数处理         
	 		array('posttime','time',0,'function'), // 对update_time字段在更新的时候写入当前时间戳 
	 		array('uname','trim',3,'function'), // 对update_time字段在更新的时候写入当前时间戳
	 		array('status',1), // 对update_time字段在更新的时候写入当前时间戳
	);
	 //根据用户id获取信息
	 public static function getUserInfobyid($id,$value){
	 	$info = M('Member')->find($id);
	 	if($value){
	 		return $info[$value];
	 	}else{
	 		return $info;
	 	}
	 }
	 //登陆
	 public static function login($username,$password){
	 	$condition['uname'] = $username;
	 	$condition['pwd'] = md5($password);
	 	$user = M('member')->where($condition)->Field('id,uname,expeirtime,status')->find();
	 	if($user){
	 		if($user['status'] == 1){
	 			//获取用户分组个人账号具有有效期
	 			$group = D('authgroupaccess')->getGroupid($user['id']);
	 			if($group == 4 && $user['expeirtime'] < time()){
	 					$code = -2;//账号过期
	 			}else{
	 				session('user',$user);
	 				session('uid',$user['id']);
	 				session('uname',$user['uname']);
	 				session('groupid',$group);
	 				$code = 0;	
	 			}
	 		}else{
	 			$code = -1;//账号锁定 
	 		}
	 	}else{
	 		unset($condition);
	 		$condition['uname'] = $username;
	 		$u = M('member')->where($condition)->find();
	 		if($u){
	 			$code = 2;
	 		}else{
	 			$result = D('Loginerr')->errorLog();
	 			$code = 1;//用户不存在
	 		}
	 	}
	 	D('Loginlog')->loginlog($username,$code);
	 	return $code;
	 }
	 //检查用户是否存在
	 public static function checkuname($name,$phone){
	 	$condition['uname'] = $name;
	 	$condition['phone'] = $phone;
	 	$result = M('member')->where($condition)->find();
	 	if($result){
	 		return $result;
	 	}else{
	 		return false;
	 	}
	 }
	 //根据用户昵称查找用户id
	 public static function getInfoByname($name,$value){
	 	$condition['uname'] = $name;
	 	$result = M('member')->where($condition)->find();
	 	if($value){
	 		return $result[$value];
	 	}else{
	 		return $result;
	 		
	 	}
	 }
}