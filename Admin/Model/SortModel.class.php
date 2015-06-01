<?php
/**
*author:quanyinzhong
*email:290551872@163.com
*website:http://www.35258.com
**/
namespace Admin\Model;
class SortModel extends \Think\Model{
	 protected $_validate = array(
		array('name','','分类已存在',0,'unique',1), // 在新增的时候验证name字段是否唯一
	);
	 //缓存
	 public static function CacheSort(){
	 	$file = 'sortcache';
	 	if(S($file)){
	 		$result = S($file);
	 		return $result;
	 	}else{
	 		$data = M('sort')->select();
	 		S($file,$data);
	 		return $data;
	 	}
	 	
	 }
	 //根据id获取分类信息
	 public static function getSortById($id){
	 	$data = self::CacheSort();
	 	foreach($data as $k=>$v){
	 		if($v['id'] == $id){
	 			return $v;
	 		}
	 	}
	 }
}