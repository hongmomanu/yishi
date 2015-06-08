<?php
// 本类由系统自动生成，仅供测试用途
namespace Home\Controller;
use Think\Controller;
class ProjectController extends CommonController {
	public function _empty(){
		echo 1;
	}
	function index(){
		$group = array(1,2);
		if(in_array(session('groupid'), $group)){
			$map['uid'] = is_login();
			$this->_list('project');
			$this->display();
		}else{
			$this->error('无权限');
		}
	}
	function add(){
		$dopost = I('post.action')?I('post.action'):'';
		if($dopost == 'add'){
			$model = D('Project');
			if(false !== $data = $model->create()){
				$data['starttime'] = date2time(I('post.year1').'-'.I('post.month1').'-'.I('post.day1').' 00:00:00');
				$data['endtime'] = date2time(I('post.year2').'-'.I('post.month2').'-'.I('post.day2').' 23:59:59');
				$id = $model->add($data);
				if(false !== $id){
					$this->success('添加培训项目成功',U('Project/item',array('id'=>$id)));
				}else{
					$this->error('添加培训项目失败');
				}
			}else{
				$this->error('数据有误');
			}
		}else{
			$this->display();
		}
	}
	//添加培训子类分类
	function item(){
		$id = I('get.id');
		if(!is_numeric($id) || $id == 0){
			$this->error('错误的参数');
		}
		$map['uid'] = is_login();
		$map['pid'] = $id;
		$this->_list('pxcategory',$map);
		$this->assign('id',$id);
		$this->display();
	}
	function additem(){
		$dopost = I('post.action')?I('post.action'):'';
		if($dopost == 'add'){
			$model = D('pxcategory');
			if(false !== $data = $model->create()){
				if(false !== $model->add()){
					$this->success('添加成功',U('Project/item',array('id'=>$data['pid'])));
				}else{
					$this->error('添加失败');
				}
			}else{
				$this->error('数据错误');
			}
		}else{
			$pid = I('get.pid');
			if(!is_numeric($pid) || $pid == 0){
				$this->error('错误的编号');
			}
			$this->assign('pid',$pid);
			$this->display();
		}
	}
	function edititem(){
		$dopost = I('post.action')?I('post.action'):'';
		if($dopost == 'save'){
			$model = D('pxcategory');
			if(false !== $data = $model->create()){
				$condition['pid'] = I('post.pid');
				$condition['uid'] = is_login();
				if(false !== $model->where($condition)->save($data)){
					$this->success('更新成功',U('Project/item',array('id'=>I('post.pid'))));
				}else{
					$this->error('更新失败');
				}
			}else{
				$this->error('数据错误');
			}
		}else{
			$pid = I('get.id');
			$data = M('pxcategory')->find($pid);
			$this->assign('data',$data);
			$this->display();
		}
	}
	//删除
	function delitem(){
		$condition['id'] = I('get.id');
		$condition['uid'] = is_login();
		$result = M('pxcategory')->where($condition)->delete();
		if(false !== $result){
			$this->success('删除成功');
		}else{
			$this->error('删除失败');
		}
	}
	//子项目管理开始
	function sonitem(){
		$id = I('get.sid');
		if(!is_numeric($id) || $id == 0){
			$this->error('错误的参数');
		}
		$map['uid'] = is_login();
		$map['pid'] = $id;
		$this->_list('pxsonitem',$map);
		$this->assign('id',$id);
		$this->display();
	}
	function addsonitem(){
		$dopost = I('post.action')?I('post.action'):'';
		trace('Name的值',$dopost);
		if($dopost == 'add'){

			$model = D('pxsonitem');
			if(I('post.pxtype') == 1){
				//上传
				$upload = new \Think\Upload();// 实例化上传类
				$upload->maxSize   =     514572800000000 ;// 设置附件上传大小
				$upload->exts      =     array('zip','pdf');// 设置附件上传类型
				$upload->savePath  =      './'; // 设置附件上传目录    // 上传单个文件
				$upload->saveName = array('uniqid','');
				$upload->autoSub  = true;
				$upload->subName  = array('date','Ymd');
				$info = $upload->uploadOne($_FILES['images']);
				if(!$info) {// 上传错误提示错误信息
					$this->error($upload->getError());
				}
			
		}
			if(false !== $data = $model->create()){
				if(I('post.pxtype') == 1){
				$data['type'] = $info['ext'];
					if($info['ext'] == 'zip'){
						$filepath = '/kejian/'.time();
						makeDir('.'.$filepath);
						import("@.ORG.PclZip");
						$zipfile =  '/Uploads'.str_replace('.', '', $info['savepath']).$info['savename'];
						$archive = new \PclZip(dirname(dirname(dirname(__FILE__))).$zipfile);
						$list = $archive->extract(PCLZIP_OPT_PATH, '.'.$filepath);
						if ($list == 0) {
							$this->error($archive->errorInfo(true));
						}
						$data['filename'] = 'player.html';
						$data['filepath'] = $filepath.'/';
					}else{
						$data['filename'] = $info['savename'];
						$data['filepath'] = '/Uploads'.str_replace('.', '', $info['savepath']);
						$data['times'] = I('post.times');
					}
				}
				if(false !== $model->add($data)){
					$this->success('添加成功',U('Project/sonitem',array('sid'=>$data['pid'])));
				}else{
					$this->error('添加失败');
				}
			}else{
				$this->error('数据错误');
			}
		}else{
		trace('Name的值222',$dopost);
			$pid = I('get.pid');
			if(!is_numeric($pid) || $pid == 0){
				$this->error('错误的编号');
			}
			//获取用户考试系统试题
			$uid = D('user')->getUserInfo(session('uname'),'userid');
			$condition['Openbasics.obuserid'] = $uid;
			$data = D('BasicView')->where($condition)->select();
			//echo D('BasicView')->getLastsql();
			$this->assign('data',$data);
			//根据pid获取信息
			$s1 = M('pxcategory')->find($pid);
			$s2 = M('project')->find($s1['pid']);
			$this->assign('kaohe',$s2['kaohe']);
			$this->assign('pid',$pid);
			$this->display();
		}
	}
	//编辑
	function editsonitem(){
		$dopost = I('post.action')?I('post.action'):'';
		if($dopost == 'save'){
			$model = D('pxsonitem');
			if(I('post.pxtype') == 1){
				//上传
				$upload = new \Think\Upload();// 实例化上传类
				$upload->maxSize   =     514572800000000 ;// 设置附件上传大小
				$upload->exts      =     array('zip','pdf');// 设置附件上传类型
				$upload->savePath  =      './'; // 设置附件上传目录    // 上传单个文件
				$upload->saveName = array('uniqid','');
				$upload->autoSub  = true;
				$upload->subName  = array('date','Ymd');
				$info = $upload->uploadOne($_FILES['images']);
				if(!$info) {// 上传错误提示错误信息
					$this->error($upload->getError());
				}
					
			}
			if(false !== $data = $model->create()){
				if(I('post.pxtype') == 1){
					$data['type'] = $info['ext'];
					if($info['ext'] == 'zip'){
						$filepath = '/kejian/'.time();
						makeDir('.'.$filepath);
						import("@.ORG.PclZip");
						$zipfile =  '/Uploads'.str_replace('.', '', $info['savepath']).$info['savename'];
						$archive = new \PclZip(dirname(dirname(dirname(__FILE__))).$zipfile);
						$list = $archive->extract(PCLZIP_OPT_PATH, '.'.$filepath);
						if ($list == 0) {
							$this->error($archive->errorInfo(true));
						}
						$data['filename'] = 'player.html';
						$data['filepath'] = $filepath.'/';
					}else{
						$data['filename'] = $info['savename'];
						$data['filepath'] = '/Uploads'.str_replace('.', '', $info['savepath']);
					}
				}
				if(false !== $model->add($data)){
					$this->success('添加成功',U('Project/sonitem',array('sid'=>$data['pid'])));
				}else{
					$this->error('添加失败');
				}
			}else{
				$this->error('数据错误');
			}
		}else{
			$pid = I('get.id');
			if(!is_numeric($pid) || $pid == 0){
				$this->error('错误的编号');
			}
			//获取用户考试系统试题
			$uid = D('user')->getUserInfo(session('uname'),'userid');
			$condition['Openbasics.obuserid'] = $uid;
			$data = D('BasicView')->where($condition)->select();
			unset($condition);
			$map['uid'] = is_login();
			$map['id'] = $pid;
			$fdata = M('pxsonitem')->where($map)->find();
			if(empty($fdata)){
				$this->error('项目不存在');
			}
			$this->assign('fdata',$fdata);
			$this->assign('data',$data);
			$this->assign('pid',$pid);
			$this->display();
		}
	}
	function delsonitem(){
		$condition['uid'] = is_login();
		$condition['id'] = I('get.id');
		if(false !== M('pxsonitem')->where($condition)->delete()){
			$this->error('删除成功');
		}else{
			$this->error('删除失败');
		}
	}
	function edit(){
		$dopost = I('post.action')?I('post.action'):'';
		if($dopost == 'update'){
			$model = D('Project');
			if(false !== $data = $model->create()){
			$data['starttime'] = date2time(I('post.year1').'-'.I('post.month1').'-'.I('post.day1').' 00:00:00');
				$data['endtime'] = date2time(I('post.year2').'-'.I('post.month2').'-'.I('post.day2').' 23:59:59');
				if(false !== $model->save($data)){
					$this->success('修改培训项目成功');
				}else{
					$this->error('修改培训项目失败');
				}
			}else{
				$this->error('数据有误');
			}
		}else{
			$condition['uid'] = is_login();
			$condition['id'] = I('get.id');
			$data = M('project')->where($condition)->find();
			if(empty($data)){
				$this->error('数据可能已被删除');
			}
			$this->assign('data',$data);
			$this->display();
		}
	}
	function del(){
		$condition['uid'] = is_login();
		$condition['id'] = I('get.id');
		if(false !== M('project')->where($condition)->delete()){
			$this->error('删除培训项目成功');
		}else{
			$this->error('删除培训项目失败');
		}
	}
	//我的培训
	function my(){
	//取总会uid
		$user = D('Member')->getUserInfobyid(is_login());
		$group = array();
		$ugr = M('auth_group_access')->where('group_id = 1')->select();
		foreach($ugr as $k=>$v){
			array_push($group,$v['uid']);
		}
		if($user['group1'] != 0){
			array_push($group, $user['group1']);
		}
		if($user['group2'] != 0){
			array_push($group, $user['group2']);
		}
		if($user['group3'] != 0){
			array_push($group, $user['group3']);
		}
		$map['uid'] = array('in',implode(',', $group));
		$map['status'] = 1;
		$this->_list('project',$map);
		$this->display();	
	}
	function addtask(){
		$model = M('mytask');
		$project = M('project')->find(I('get.id'));
		if($project['starttime'] > time()){
			$this->error('培训尚未开始');
		}
		if($project['endtime'] < time()){
			$this->error('当前培训项目已结束');
		}
		$condition['pid'] = I('get.id');
		$condition['uid'] = is_login();
		if($model->where($condition)->find()){
			$this->error('您已参加培训，请勿重复添加');
		}
		$data['pid'] = I('get.id');
		$data['posttime'] = time();
		$data['uid'] = is_login();
		if(false !== $model->add($data)){
			$this->success('参加培训成功',U('Project/my'));
		}else{
			$this->error('参加培训失败');
		}
	}
	function taskcategory(){
		$id = I('get.id');
		$condition['pid'] = $id;
		$this->_list('pxcategory',$condition);
		$this->display();
	}
	function tasklink(){
		$id = I('get.id');
		$condition['pid'] = $id;
		$this->_list('pxsonitem',$condition);
		$this->display();
	}
	//start
	function starttask(){
		$id = I('get.id');
		if(!is_numeric($id) || $id == 0){
			$this->error('错误的任务号');
		}
		$condition['id'] = $id;
		$data = M('pxsonitem')->where($condition)->find();
		$map['uid'] = is_login();
		$map['sid'] = $id;
		$result = M('mytask')->where($map)->find();
		if($result){
			M('mytask')->where($map)->setField('posttime',time());
		}else{
			$f['uid'] = is_login();
			$f['sid'] = $id;
			$f['posttime'] = time();
			$f['pid'] = $data['pid'];
			M('mytask')->add($f);
		}
		if($data['pxtype'] == 2){
			Header("Location:".C('weburl').'exam/index.php?exam-app-index-setCurrentBasic&basicid='.$data['examid']);
		}else{
			$this->assign('data',$data);
			$this->display();
		}
	}
	function times(){
		$id = I('post.id');
		if(is_numeric($id) && $id != 0){
			$condition['sid'] = $id;
			$condition['uid'] = is_login();
			M('mytask')->where($condition)->setField('endtime',time());
			$data = M('mytask')->where($condition)->find();
			$map['pid'] = $data['pid'];
			$result = M('project')->where($map)->find();
			if(jstaytime($data['posttime'],$data['endtime']) >= $data['times']){
				M('mytask')->where($condition)->setField('isover',1);
			}
			//是否全部完成
			unset($condition,$map);
			$condition['pid'] = $result['id'];
			$num1 = M('pxsonitem')->where($condition)->count();
			$map['uid'] = is_login();
			$map['pid'] = $result['id'];
			$map['isover'] = 1;
			$num2 = M('mytask')->where($map)->count();
			if($num1 == $num2){
				unset($condition,$map);
				$condition['pid'] = $result['id'];
				$condition['uid'] = is_login();
				$condition['sid'] = 0;
				if($result['scoretype'] == 1){
				$f['score'] = $result['score'];
				}
				$f['isveri'] = 1;
				M('mytask')->where($condition)->save($f);
				if($result['scoretype'] == 1){
				$score['uid'] = is_login();
				$score['pid'] = $result['id'];
				$score['posttime'] = time();
				$score['content'] = '发放学分'.$result['score'].'分';
				D('Scorelog')->log($score);
				}
			}
		}
	}
	//培训报名名单
	function member(){
		$id = I('get.id');
		$condition['pid'] = $id;
		$condition['sid'] = '';
		$this->_list('mytask',$condition);
		$this->display();
	}
	function projectlist(){
		$condition['sid'] = array('neq','0');
		$condition['uid'] = I('get.uid');
		$condition['_string'] = 'pid = '.I('get.pid');
		
		$this->_list('mytask',$condition);
		$this->display();
	}
	function editscore(){
		$do = I('post.action')?I('post.action'):'';
		if($do == 'save'){
			$model = M('mytask');
			if(false !== $data = $model->create()){
				$map['id'] = $data['id'];
				if(false !== $model->where($map)->save($data)){
					$score['uid'] = $data['uid'];
					$score['pid'] = $data['pid'];
					$score['posttime'] = time();
					$score['content'] = '发放学分'.$data['score'].'分';
					$score['type'] = 2;
					$score['fuid'] = is_login();
					$score['description'] = I('post.description');
					D('Scorelog')->log($score);
					$this->success('编辑用户信息成功');
				}else{
					$this->error('编辑用户信息失败');
				}
			}else{
				$this->error('数据有误');
			}
		}else{
			$condition['id'] = I('get.id');
			$condition['uid'] = I('get.uid');
			$info = M('mytask')->where($condition)->find();
			if(pxstatus($info['pid']) == '未完成'){
				$this->error('培训未完成无法授予学分');
			}
			$this->assign('info',$info);
			$this->display();
		}
	}
	//日志记录
	function scorelog(){
		$id = I('get.id');
		$condition['pid'] = $id;
		$this->_list('scorelog',$condition);
		$this->display();
	}
	//学分
	function getcore(){
		$do = I('post.action')?I('post.action'):'';
		if($do == 'add'){
			$data['name'] = I('post.truename');
			$data['phone'] = I('post.phone');
			$data['address'] = I('post.address');
			$condition['pid'] = I('post.pid');
			$condition['uid'] = is_login();
			$condition['sid'] = 0;
			if(false !== M('mytask')->where($condition)->save($data)){
				$this->success('信息已提交');
			}else{
				$this->error('信息提交失败');
			}
		}else{
			$id = I('get.id');
			if(pxstatus($id) == '未完成'){
				$this->error('您目前培训尚未完成，无法领取学分');
			}else{
				$info = D('project')->getInfo($id);
				$this->assign('info',$info);
				$this->display();
			}
		}
		
	}
	//证书
	function getcode(){
	$do = I('post.action')?I('post.action'):'';
		if($do == 'add'){
			$data['cname'] = I('post.truename');
			$data['cphone'] = I('post.phone');
			$data['caddress'] = I('post.address');
			$condition['pid'] = I('post.pid');
			$condition['uid'] = is_login();
			$condition['sid'] = 0;
			if(false !== M('mytask')->where($condition)->save($data)){
				$this->success('信息已提交');
			}else{
				$this->error('信息提交失败');
			}
		}else{
			$id = I('get.id');
			if(pxstatus($id) == '未完成'){
				$this->error('您目前培训尚未完成，无法领取证书');
			}else{
				$info = D('project')->getInfo($id);
				$this->assign('info',$info);
				$this->display();
			}
		}
	}
	//导出名单
	function exportUser(){
		$id = I('get.id');
		$condition['pid'] = $id;
		$condition['sid'] = '';
		$data = M('mytask')->where($condition)->select();
		foreach($data as $k=>&$v){
			$v['uid'] = getUserInfo($v['uid'], 'truename');
			$v['pid'] = project($v['pid'],'title');
			$v['isover'] = $v['isover'] == 1?'是':'否';
			$v['isveri'] = $v['isveri'] == 1?'是':'否';
			$v['sid'] = $v['sid'] == 0?'':pxsonitem($v['sid'],'title');
			$v['times'] = endday($v['posttime'], $v['endtime']);
			unset($v['endtime'],$v['posttime']);
		}
		$xlsName  = "User";
		$xlsCell  = array(
				array('id','序号'),
				array('uid','姓名'),
				array('pid','项目名称'),
				array('score','学分'),
				array('isveri','是否获得证书'),
				array('times','停留时间'),
				array('sid','子项目名称'),
				array('isover','是否完成'),
				array('name','学分收件人'),
				array('phone','学分收件人联系方式'),
				array('address','学分收件人联系地址'),
				array('cname','证书收件人'),
				array('cphone','证书收件人联系方式'),
				array('caddress','证书收件人联系地址')
		);
		exportExcel($xlsName,$xlsCell,$data);
		
	}
	//我的培训
	function myproject(){
		$condition['uid'] = is_login();
		$condition['sid'] = 0;
		$project = M('mytask')->where($condition)->select();
		
		$pid = array();
		foreach($project as $k=>$v){
			array_push($pid,$v['pid']);
		}
		$pids = implode(',',$pid);
		$map['id'] = array('in',$pids);
		$this->_list('project',$map);
		$this->display();
	}
	//培训状态编辑
	function changestatus(){
		$status =I('get.status');
		$s = array('0','1');
		if(in_array($status,$s)){
			$id = I('get.id');
			$condition['id'] = $id;
			$result = M('project')->where($condition)->setField('status',$status);
			if(false !== $result){
				$this->success('操作成功');
			}else{
				$this->error('操作失败');
			}
		}else{
			$this->error('错误的代码');
		}
	}
}