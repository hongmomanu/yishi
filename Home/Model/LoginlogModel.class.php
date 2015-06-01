<?php
/**
*author:quanyinzhong
*email:290551872@163.com
*website:http://www.35258.com
**/
namespace Home\Model;
class LoginlogModel extends \Think\Model{
	//登陆日志
	public static function loginlog($user,$code){
		if($code == -1){
			$data['content'] = '登录系统失败,账号已被锁定-'.getBrowse().'-'.GetOs();
		}else if($code == 2){
			$data['content'] = '登录系统失败,密码错误-'.getBrowse().'-'.GetOs();
		}else if($code == -2){
			$data['content'] = '登录系统失败,账号过期-'.getBrowse().'-'.GetOs();
		}else if($code == 1){
			$data['content'] = '用户不存在-'.getBrowse().'-'.GetOs();
		}else{
			$data['content'] = '登录系统成功-'.getBrowse().'-'.GetOs();
		}
		$data['time'] = time();
		$data['user'] = $user;
		$userip = get_client_ip();
		$Ip = new \Org\Net\IpLocation('qqwry.dat'); // 实例化类 参数表示IP地址库文件
		$area = $Ip->getlocation($userip);
		$data['ip'] = $userip.'('.iconv("GB2312","UTF-8",$area['country']).iconv("GB2312","UTF-8",$area['area']).')';
		M('loginlog')->data($data)->add();
	}
}