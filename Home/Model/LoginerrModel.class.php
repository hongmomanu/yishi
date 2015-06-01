<?php
/**
*author:quanyinzhong
*email:290551872@163.com
*website:http://www.35258.com
**/
namespace Home\Model;
class LoginerrModel extends \Think\Model{
	 protected $_auto = array (                  
	 		array('posttime','time',2,'function'), // 对update_time字段在更新的时候写入当前时间戳     
	);
	//记录错误信息
	public static function errorLog(){
		$ip = get_client_ip();
		$condition['ip'] = $ip;
		$data = M('loginerr')->where($condition)->find();
		if($data){
			if($data['times'] <=5){
				M('loginerr')->where($condition)->setInc('times');
			}else{
				if((time()-$data['posttime']) <= 7200){
					return -1;//小于两小时
				}else{
					M('loginerr')->where($condition)->setField('times',0);
					M('loginerr')->where($condition)->setInc('times');
				}
			}
		}else{
			$f['ip'] = $ip;
			$f['posttime'] = time();
			M('loginerr')->add($f);
		}
	}
	public static function checks(){
		$ip = get_client_ip();
		$condition['ip'] = $ip;
		$data = M('loginerr')->where($condition)->find();
		if($data['posttime'] != ''){
			if((($data['posttime']-time()) < 7200) && $data['times'] >= 5){
				return -1;//小于两小时
			}else{
				return true;
			}
		}
	}
}