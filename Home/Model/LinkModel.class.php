<?php
/**
*author:quanyinzhong
*email:290551872@163.com
*website:http://www.35258.com
**/
namespace Home\Model;
class LinkModel extends \Think\Model{
	public static function linkCache(){
		$file = 'friendlink';
		if(S($file)){
			return S($file);
		}else{
			$data = M('link')->select();
			S($file,$data);
			return $data;
		}
	}
}