<?php
/**
*author:quanyinzhong
*email:290551872@163.com
*website:http://www.35258.com
**/
namespace Home\Model;
class ScorelogModel extends \Think\Model{
	//登陆日志
	public static function log($data){
		M('scorelog')->data($data)->add();
	}
}