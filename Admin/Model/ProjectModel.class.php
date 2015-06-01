<?php
/**
*author:quanyinzhong
*email:290551872@163.com
*website:http://www.35258.com
**/
namespace Admin\Model;
class ProjectModel extends \Think\Model{
	//根据id判断是否需要退款
	public static function checkById($id){
		if($id){
			$data = M('project')->find($id);
			if($data){
				if((time() > $data['endtime']) && $data['nowprice'] < $data['price']){
					return 1;
				}else{
					return 0;
				}
			}else{
				return 0;
			}
		}else{
			return 0;
		}
	}
	//根据id获取项目信息
	public static function getInfoById($id){
		if($id){
			$data = M('Project')->find($id);
			return $data;
		}else{
			return false;
		}
	}
	
}