<?php
/**
*author:quanyinzhong
*email:290551872@163.com
*website:http://www.35258.com
**/
namespace Admin\Model;
class UserModel extends \Think\Model{
	 public static function adduser($data,$groupid){
	 	if($groupid == 1){
	 		//总
	 		$group = '9';
	 	}else if($groupid == 2){
	 		//分
	 		$group = '10';
	 	}else if($groupid == 3){
	 		//单
	 		$group = '11';
	 	}else{
	 		//个人
	 		$group = '8';
	 	}
	 	$exam['usergroupid'] = $group;
	 	$exam['useremail'] = $data['email'];
	 	$exam['username'] = $data['uname'];
	 	$exam['userpassword'] = $data['pwd'];
	 	$exam['userregtime'] = $data['posttime'];
	 	$exam['userregip'] = get_client_ip();
	 	if(false !== M('user')->add($exam)){
	 		return true;
	 	}else{
	 		return false;
	 	}
	 }
}