<?php
/**
*author:quanyinzhong
*email:290551872@163.com
*website:http://www.35258.com
**/
namespace Home\Model;
class FlashModel extends \Think\Model{
	public static function flashCache(){
		$file = 'flashimage';

		$data = M('flash')->limit(5)->select();
		S($file,$data);
		return $data;

		/*if(S($file)){
			return S($file,3600);
		}else{
			$data = M('flash')->limit(5)->select();
			S($file,$data);
			return $data;
		}*/
	}
	public static function rebuild(){
		$file = 'flashimage';
		S($file,NULL);
	}
}