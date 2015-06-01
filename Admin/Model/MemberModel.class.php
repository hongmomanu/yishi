<?php
/**
*author:quanyinzhong
*email:290551872@163.com
*website:http://www.35258.com
**/
namespace Admin\Model;
class MemberModel extends \Think\Model{
	protected $_validate = array(
			array('phone','','电话已存在',0,'unique',1), // 在新增的时候验证name字段是否唯一
			array('email','','邮箱已存在',0,'unique',1), // 在新增的时候验证name字段是否唯一
	);
	protected $_auto = array (
			array('pwd','md5',3,'function') , // 对password字段在新增和编辑的时候使md5函数处理         
	 		array('posttime','time',0,'function'), // 对update_time字段在更新的时候写入当前时间戳 
	 		array('uname','trim',3,'function'), // 对update_time字段在更新的时候写入当前时间戳
	 		array('status',1), // 对update_time字段在更新的时候写入当前时间戳
	);
	//根据id返回用户
	public static function getById($id,$type = 'all'){
		$data = M('member')->find($id);
		if($type != 'all'){
			foreach($data as $k=>$v){
				if($k == $type){
					return $v;
				}
			}
		}else{
			return $data;
		}
		
	}
	//检查用户是否存在
	public static function checkuname($name){
		$condition['uname'] = $name;
		$result = M('member')->where($condition)->find();
		if($result){
			return true;
		}else{
			return false;
		}
	}
	
}