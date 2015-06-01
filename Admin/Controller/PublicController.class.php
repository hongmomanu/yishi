<?php
// 本类由系统自动生成，仅供测试用途
namespace Admin\Controller;
use Think\Controller;
class PublicController extends Controller {
  /**
     * 后台用户登录
     * @author 麦当苗儿 <zuojiazi@vip.qq.com>
     */
    public function login(){
        if(IS_POST){
            /* 调用登录接口登录 */
            $username = I('post.username');
            $password = I('post.password');
            $type = I('post.type');
            	$result = D('Sysuser')->login($username,$password);
            	$url = U('Index/index');
                if($result == 1){
                	 $this->error('账号已被锁定');
                }else if($result == 2){
                	 $this->error('用户名或密码错误');
                }else{
                	 $this->success('登陆成功',$url);
                } 
        } else {
            if(is_login()){
                $this->redirect('Index/index');
            }else{
                $this->display();
            }
        }
    }

    /* 退出登录 */
    public function logout(){
        if(is_login()){
            session('[destroy]');
           $this->redirect('login');
        } else {
            $this->redirect('login');
        }
    }
    public function verify(){
        $verify = new \Think\Verify();
        $verify->entry(1);
    }
    //重置密码
    public function repass(){
    	$action = I('get.action');
    	if($action == 'update'){
    		$new1 = trim(I('get.n1'));
    		$new2 = trim(I('get.n2'));
    		$old = trim(I('get.old'));
    		if($new1 != $new2){
    			$this->error('两次输入的新密码不一样');
    		}
    		$data = M('sysuser')->field('password')->find(session('uid'));
    		if(md5($old) != $data['password']){
    			$this->error('原始密码不正确');
    		}else{
    			$result = M('sysuser')->where('id='.session('uid'))->setField('password',md5($new1));
	    		if(false !== $result){
					$this->success('密码修改成功');
				}else{
					$this->success('密码修改失败');
				}
    		}
    	}else{
    		$this->display();
    	}
    }
}