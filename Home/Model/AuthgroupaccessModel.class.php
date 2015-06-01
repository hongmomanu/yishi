<?php
/**
*author:quanyinzhong
*email:290551872@163.com
*website:http://www.35258.com
**/
namespace Home\Model;
class AuthgroupaccessModel extends \Think\Model{
	protected $trueTableName = 'auth_group_access'; 
	 protected $_validate = array(
		array('uid','','亲，这个人家已经吃厌烦了',0,'unique',3), // 在新增的时候验证name字段是否唯一
	);
	//根据用户id查询所属组
	public static function getGroupid($uid){
		$condition['uid'] = $uid;
		$data = M('auth_group_access')->where($condition)->find();
		return $data['group_id'];
	}
	//更新信息
	public static function addgroup($uid,$groupid){
		$data['uid'] = $uid;
		$data['group_id'] = $groupid;
		$m['uid'] = $uid;
		$user  = M('auth_group_access')->where($m)->find();
		if($user){
			$result = M('auth_group_access')->where("uid=".$uid)->save($data);
		}else{
			$result = M('auth_group_access')->data($data)->add();
		}
		
		if(false !== $result){
			return true;
		}else{
			return false;
		}
	}
	public static function selectgroup($id){
		$condition['group_id'] = $id;
		$data = M('auth_group_access')->where($condition)->select();
		$uids = array();
		foreach($data as $k=>$v){
			if($v['uid'] == is_login()){
				unset($data[$k]);
			}else{
				array_push($uids, $v['uid']);
			}
		}
		$uid = implode(',', $uids);
		return $uid;
	}
}