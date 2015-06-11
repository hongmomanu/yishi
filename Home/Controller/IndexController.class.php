<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
	public function _initialize(){

		header('Content-Type:text/html;charset=utf-8');
		$user_online = "count.php"; //保存人数的文件
		touch($user_online);//如果没有此文件，则创建
		$timeout = 30;//30秒内没动作者,认为掉线
		$user_arr = file_get_contents($user_online);
		$user_arr = explode('#',rtrim($user_arr,'#'));
		//print_r($user_arr);
		$temp = array();
		foreach($user_arr as $value){
			$user = explode(",",trim($value));
			if (($user[0] != getenv('REMOTE_ADDR')) && ($user[1] > time())) {//如果不是本用户IP并时间没有超时则放入到数组中
				array_push($temp,$user[0].",".$user[1]);
			}
		}
		array_push($temp,getenv('REMOTE_ADDR').",".(time() + ($timeout)).'#'); //保存本用户的信息
		$user_arr = implode("#",$temp);
		//写入文件
		$fp = fopen($user_online,"w");
		flock($fp,LOCK_EX); //flock() 不能在NFS以及其他的一些网络文件系统中正常工作
		fputs($fp,$user_arr);
		flock($fp,LOCK_UN);
		fclose($fp);
	}
	function index(){
		//行业动态
		$hydt = D('Article')->getNewsList(7,9);
		$this->assign('hydt',$hydt);
		//政策法规
		$zcfg = D('Article')->getNewsList(14,9);
		$this->assign('zcfg',$zcfg);
		//工作动态
		$gzdt = D('Article')->getNewsList(5,9);
		$this->assign('gzdt',$gzdt);
		//最新培训
		$project = M('project')->order('posttime desc')->limit(9)->select();
		$this->assign('project',$project);
		//医疗评审
		$ylps = D('Article')->getNewsList(3,9);
		$this->assign('ylps',$ylps);
		
		//友情链接
		$link = D('Link')->linkCache();
		$this->assign('link',$link);
		$about = M('alonepage')->find(1);
		$this->assign('about',$about);

		//幻灯片
		$flash = D('flash')->flashCache();


		$this->assign('flash',$flash);
		$this->display();
	}
	function category(){
		$map['sort'] = I('get.sortid');
		$map['status'] = 1;
		$Rows = 13;
		$model = M('article');
		//取得满足条件的记录数
		$count = $model->where($map)->count('id');
		//创建分页对象
		//获取分页数
		$pageId = $_GET['page'];
		$pageId = $pageId == "" ? 1 : $pageId;
		$pageCount = ceil($count / $Rows);
		$url = CONTROLLER_NAME.'/'.ACTION_NAME;
		
		//分页查询数据
		$list = $model->where($map)->order('id DESC')->page($pageId,$Rows)->select();
		//echo $model->getLastsql();
		$page = pagerank($pageCount,$pageId,$count,$url,$f);
		//dump($list);
		//模板赋值显示
		$this->assign('list', $list);
		$this->assign('page',$page);
		$name = D('Sort')->getName(I('get.sortid'));
		$this->assign('name',$name);
		//友情链接
		$link = D('Link')->linkCache();
		$this->assign('link',$link);
		$this->display();
	}
	//详情页面
	function article(){
		$id = I('get.id');
		$condition['id'] = $id;
		if(session('groupid') != 1){			$condition['status'] = 1;
		}
		$data = M('article')->where($condition)->find();
		if(!$data){
			$this->error('文章不存在');
		}else{
			M('article')->where($condition)->setInc('hits');
			$this->assign('data',$data);
			//获取本栏目下最新文章
			$other = D('Article')->getNewsList($data['sort'],6);
			$this->assign('other',$other);
			//友情链接
			$link = D('Link')->linkCache();
			$this->assign('link',$link);
			$this->display();
		}
	}
	function search(){
		$map['title'] = array('like','%'.I('get.keyword').'%');
		$Rows = 13;
		$model = M('article');
		//取得满足条件的记录数
		$count = $model->where($map)->count('id');
		//创建分页对象
		//获取分页数
		$pageId = $_GET['page'];
		$pageId = $pageId == "" ? 1 : $pageId;
		$pageCount = ceil($count / $Rows);
		$url = CONTROLLER_NAME.'/'.ACTION_NAME;
	
		//分页查询数据
		$list = $model->where($map)->order('id DESC')->page($pageId,$Rows)->select();
		//echo $model->getLastsql();
		$page = pagerank($pageCount,$pageId,$count,$url,$f);
		//dump($list);
		//模板赋值显示
		$this->assign('list', $list);
		$this->assign('page',$page);
		$name = D('Sort')->getName(I('get.sortid'));
		$this->assign('name',$name);
		//友情链接
		$link = D('Link')->linkCache();
		$this->assign('link',$link);
		$this->assign('keyword',I('get.keyword'));
		$this->display();
	}
	function exam(){
		if(!is_login()){
			$this->error('请先登录',U('Public/login'));
		}
			/* $condition['username'] = session('uname');
			$examlogin = M('user')->where($condition)->find();
			$sc = 'xiaoquan@xablackcat.com';
			$userid = $examlogin['userid'];
			$username = $examlogin['username'];
			$email =  $examlogin['useremail'];
			$ts = time();
			$url = C('weburl').'/exam/index.php?exam-api-login&userid='.$userid.'&username='.$username.'&useremail='.$email.'&ts='.$ts.'&sign='.md5($userid.$username.$email.$sc.$ts);
			 */
		switch (session('groupid')){
			case 4:
				$end = '';
				break;
			default:
				$end = 'index.php?exam-teach';
		}
		$url = C('weburl').'/exam/'.$end;
		header("location:".$url);
		
	}
	function about(){
		$data = M('alonepage')->find(1);
		$this->assign('data',$data);
		//友情链接
		$link = D('Link')->linkCache();
		$this->assign('link',$link);
		$this->display();
	}
	function alonepage(){
		$data = M('alonepage')->find(I('get.id'));
		$this->assign('data',$data);
		//友情链接
		$link = D('Link')->linkCache();
		$this->assign('link',$link);
		$this->display('about');
	}
}