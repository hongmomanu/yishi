<?php
// 本类由系统自动生成，仅供测试用途
namespace Admin\Controller;
use Think\Controller;
class IndexController extends CommonController {
	//框架首页
    public function index(){
    	
    	$this->display();
    }
    //顶部
    public function top(){
    	
		$notice = M('notice')->order('id DESC')->find();
		$this->assign('notice',$notice);
    	$this->display();
    }
    
    public function left(){
    
    	$this->display();
    }
    public function right(){
		$data = M('notice')->order('id DESC')->limit(5)->select();
		$this->assign('list',$data);
    	$this->display();
    }
    public function switchs(){
    	$this->display();
    }
    public function foot(){
    	$this->display();
    }
    function linke(){
    	$this->_list('link');
    	$this->display();
    }
}