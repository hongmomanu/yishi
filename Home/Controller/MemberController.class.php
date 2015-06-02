<?php
// 本类由系统自动生成，仅供测试用途
namespace Home\Controller;
use Think\Controller;
class MemberController extends CommonController {
	public function _empty(){
		echo 1;
	}
	function index(){
		//获取用户组名称
		$group = D('authgroup')->getById(session('groupid'));
		$this->assign('group',$group);
		$this->display();
	}
	//个人资料修改
	function info(){
		if(IS_POST){
			$model = D('Member');
			if(false !== $data = $model->create()){
				if (! empty ( $_FILES ['photo'] ['name'] ))
				{
					//上传
					$upload = new \Think\Upload();// 实例化上传类
					$upload->maxSize   =     514572800 ;// 设置附件上传大小
					$upload->exts      =     array('zip','pdf');// 设置附件上传类型
					$upload->savePath  =      './'; // 设置附件上传目录    // 上传单个文件
					$upload->saveName = array('uniqid','');
					$upload->autoSub  = true;
					$upload->subName  = array('date','Ymd');
					$info = $upload->uploadOne($_FILES['photo']);
					if(!$info) {// 上传错误提示错误信息
						$this->error($upload->getError());
					}
					$data['avatar'] =  '/Uploads'.str_replace('.', '', $info['savepath']).$info['savename'];
				}
				$condition['id'] = session('uid');
				unset($data['pwd']);
				if(false !== $model->where($condition)->save($data)){
					echo $model->getLastsql();
					die();
					$this->success('用户信息修改成功');
				}else{
					$this->error($model->getError());
				}
			}else{
				$this->error($model->getError());
			}
		}else{
			$info = D('Member')->getUserInfobyid(session('uid'));
			$this->assign('info',$info);
			if(session('groupid') == '4'){
			$this->display();
			}else{
				$this->display('oinfo');
			}
		}
	}
	//修改密码
	function password(){
		if(IS_POST){
			$pass = I('post.pass');
			$repass = I('post.repass');
			if($pass == '' || $repass == ''){
				$this->error('密码不能为空');
			}else if($pass != $repass){
				$this->error('两次输入的密码不一致');
			}else{
				$data['pwd'] = md5($pass);
				$condition['id'] = session('uid');
				if(false !== M('member')->where($condition)->save($data)){
					$this->success('户名密码修改成功');
				}else{
					$this->error('用户密码修改失败');
				}
			}
		}else{
			$this->display();
		}
	}
	//站内信息
	function message(){
		$condition['from_uid'] = is_login();
		$this->_list('message_sender',$condition,'mid');
		$this->display();
	}
	//收件箱
	function inputbox(){
		
		$model = D('MessagesenderView');
		$map['Message_receiver.to_uid'] = is_login();
		//取得满足条件的记录数
		$count = $model->where($map)->count('id');
		$Rows = 15;
		//创建分页对象
		//获取分页数
		$pageId = $_GET['page'];
		$pageId = $pageId == "" ? 1 : $pageId;
		$pageCount = ceil($count / $Rows);
		$url = CONTROLLER_NAME.'/'.ACTION_NAME;
		
		//分页查询数据
		$list = $model->where($map)->order('Message_receiver.rid DESC')->page($pageId,$Rows)->select();
		//echo $model->getLastsql();
		
		//分页跳转的时候保证查询条件
		$f = '';
		
		foreach ($map as $key => $val) {
			if (!is_array($val)) {
				$f .= "/$key/" . urlencode($val);
			}else{
				$types = array('applytime','zitime','ordertime');
				if(in_array($key, $types)){
					$f .= '/type/'.$key;
				}
				if($key == 'phone'){
					$f .= "/$key/" .str_replace('%', '', $val['1']);
				}else{
					$newtime = explode(',', $val['1']);
					$f .= '/time1/'.date('Y-m-d',$newtime['0']).'/time2/'.date('Y-m-d',$newtime['1']);
				}
				 
			}
		}
		$page = pagerank($pageCount,$pageId,$count,$url,$f);
		//dump($list);
		//模板赋值显示
		$this->assign('list', $list);
		$this->assign('page',$page);
		$this->display();
	}
	//查看站内信
	function messageview(){
		$id = I('get.mid');
		$condition['mid'] = $id;
		$data = M('message_sender')->where($condition)->find();
		if(empty($data)){
			$this->error('站内信已删除');
		}
		$map['mid'] = $data['mid'];
		M('message_receiver')->where($condition)->setField('is_readed',1);
		$ruserid = $data['to_uids'];
		$nuid = explode(',', $ruserid);
		if(is_array($nuid)){
			foreach($nuid as $k=>&$v){
				$v = getUserInfo($v,'truename');
			}
			$userinfo = implode(',', $nuid);
		}else{
			$userinfo = getUserInfo($ruserid,'truename');
		}
		$data['ruser'] = $userinfo;
		$this->assign('data',$data);
		$this->display();
	}
	//下载附件
	function download(){
		$path = I('get.path');
		$file = '.'.Hd($path,2);
		if(is_file($file)) {
			header("Content-Type: application/force-download");
			header("Content-Disposition: attachment; filename=".basename($file));
			readfile($file);
			exit;
		}else{
			$this->error('文件不存在');
		}
			
	}
	//发送站内信
	function sendmessage(){
		$dopost = I('post.action')?I('post.action'):'';

		if($dopost == 'send'){

		 trace('sendmessage',$dopost);
				if($_FILES['fujian']['error'] != 4){
				//上传
				$upload = new \Think\Upload();// 实例化上传类
				$upload->maxSize   =     3145728 ;// 设置附件上传大小
				$upload->exts      =     array('zip','pdf');// 设置附件上传类型
				$upload->savePath  =      './'; // 设置附件上传目录    // 上传单个文件
				$upload->saveName = array('uniqid','');
				$upload->autoSub  = true;
				$upload->subName  = array('date','Ymd');
				$info = $upload->uploadOne($_FILES['fujian']);
				if(!$info) {// 上传错误提示错误信息
					$this->error($upload->getError());
				}
				$path = '/Uploads'.str_replace('.', '', $info['savepath']).$info['savename'];
				$file = '<a href="'.U('Member/download',array('path'=>Hd($path))).'">点此下载附件</a>';
				}
			$content = I('post.content').'<br />'.$file;
			$title = I('post.title');
			$type = I('post.type');
			if($type == 4){
				//$uids = I('post.uids');
				$uids = session('mailuser');
				if($uids == ''){
					$this->error('发送用户为空');
				}else{
					$user = explode(',', $uids);
					
						$m['from_uid'] = is_login();
						$m['title'] = $title;
						$m['content'] = $content;
						$m['date'] = time();
						$m['to_uids'] = $uids;
						if(false !== $id = M('message_sender')->add($m)){
							foreach($user as $v){
							$n['mid'] = $id;
							$n['to_uid'] = $v;
							M('message_receiver')->add($n);
							}
						}
						session('mailuser','');
					$this->success('全部信息发送完毕');
					
				}
			}else{
				//根据类型获取所有会员数据
				$model = D('MemberView');

				$map['Member.group1'] = is_login();
				if($type == 1){
					$map['Auth_group_access.group_id'] = 2;
				}else if($type == 2){
					$map['Auth_group_access.group_id'] = 3;
				}else{
					$map['Auth_group_access.group_id'] = 4;
				}
				$data = $model->where($map)->select();
				if(empty($data)){
					$this->error('接受用户群为0，发送终止');
				}else{
					$users = array();
					foreach($data as $key=>$value){

						array_push($users,$value['id']);
					}
					$newuser = implode(',', $users);

					trace('data',$newuser);
					
						$m['from_uid'] = is_login();
						$m['title'] = $title;
						$m['content'] = $content;
						$m['date'] = time();
						$m['to_uids'] = $newuser;



						if(false !== $id = M('message_sender')->add($m)){



							foreach($data as $k=>$v){
							trace('data1111ss',$newuser);
							$n['mid'] = $id;
							$n['to_uid'] = $v['id'];
							M('message_receiver')->add($n);
							
						}
					}
					$this->success('全部信息发送完毕');
					
				}
			}

		}else{
			if(session('groupid') == 1){
				$list = '<option value="1">所有分会</option><option value="2">所有单位</option><option value="3">所有个人会员</option>';
			}else if(session('groupid') == 2){
				$list = '<option value="2">所有单位</option><option value="3">所有个人会员</option>';
			}else{
				$this->error('您无权发送站内信');
			}
			$this->assign('list',$list);
			$this->display();
		}
	}
	//收藏
	function collect(){
		$map['uid'] = session('uid');
		$this->_list('collect',$map);
		$this->display();
	}
	//账号充值
	function pay(){
		$this->display();
	}
	//新增用户
	function adduser(){
		if(IS_POST){
			$model = D('member');
			if(false !== $data = $model->create()){
				if(session('groupid') == 1){
					$data['group1'] = session('uid');
				}else if(session('groupid') == 2){
					$data['group2'] = session('uid');
				}else if(session('groupid') == 3){
					$data['group3'] = session('uid');
				}
				$data['expeirtime'] = time()+86400*365;
				$data['status'] = 1;
				$data['email'] = time().$data['uname'].'@yishiwang.com';
				$result = $model->add($data);
				if(false !== $result){
					D('authgroupaccess')->addgroup($result,I('post.groupid'));
					D('user')->adduser($data,I('post.groupid'));
					$this->success('添加用户成功');
				}else{
					$this->error($model->getError());
				}
			}else{
				$this->error($model->getError());
			}
		}else{
			//获取分组
		/* 	$groupid = session('groupid');
			if($groupid == 1){
				$select = array(array('id'=>'2','title'=>'分会'),array('id'=>'3','title'=>'医院'),array('id'=>'4','title'=>'个人'));
			}else if($groupid == 2 || $groupid == 3){
				$select = array(array('id'=>'4','title'=>'个人'));
			}
			$this->assign('select',$select); */
			$type = I('get.type');
			$this->assign('type',$type);
			if(I('get.type') == 4){
			$this->display();
			}else{
			$this->display('oadduser');
			}
		}
	}
	//批量新增账号
	function fadduser(){
		if(IS_POST){
			if (! empty ( $_FILES ['file_stu'] ['name'] ))
			{
				$tmp_file = $_FILES ['file_stu'] ['tmp_name'];
				$file_types = explode ( ".", $_FILES ['file_stu'] ['name'] );
				$file_type = $file_types [count ( $file_types ) - 1];
				/*判别是不是.xls文件，判别是不是excel文件*/
				if (strtolower ( $file_type ) != "xls")
				{
					$this->error ( '不是Excel文件，重新上传' );
				}
				/*设置上传路径*/
				$savePath = APP_PATH.'Public/';
					
				/*以时间来命名上传的文件*/
				$str = date ( 'Ymdhis' );
				$file_name = $str . "." . $file_type;
					
				/*是否上传成功*/
				if (!copy( $tmp_file, $savePath . $file_name ))
				{
					$this->error ( '上传失败' );
				}
			}
			//$data = import($savePath.$file_name);
			$filePath = $savePath.$file_name;
			vendor("PHPExcel.PHPExcel");
			vendor("PHPExcel.PHPExcel.Writer.Excel5");
			vendor("PHPExcel.PHPExcel.Writer.Excel2007");
			$PHPExcel = new \PHPExcel();
			/**默认用excel2007读取excel，若格式不对，则用之前的版本进行读取*/
			$PHPReader = new \PHPExcel_Reader_Excel2007();
			if(!$PHPReader->canRead($filePath)){
				$PHPReader = new \PHPExcel_Reader_Excel5();
				if(!$PHPReader->canRead($filePath)){
					echo 'no Excel';
					return;
				}
			}
				
			$PHPExcel = $PHPReader->load($filePath);
			$currentSheet = $PHPExcel->getSheet(0);  //读取excel文件中的第一个工作表
			$allColumn = $currentSheet->getHighestColumn(); //取得最大的列号
			$allRow = $currentSheet->getHighestRow(); //取得一共有多少行
			$erp_orders_id = array();  //声明数组
			$data = array();
			//echo $allRow;
			/**从第二行开始输出，因为excel表中第一行为列名*/
			$fv = array('A'=>'uname','B'=>'groupid');
			for($currentRow = 2;$currentRow <= $allRow;$currentRow++){
					
				/**从第A列开始输出*/
				for($currentColumn= 'A';$currentColumn<= $allColumn; $currentColumn++){
						
					$val = $currentSheet->getCellByColumnAndRow(ord($currentColumn) - 65,$currentRow)->getValue();/**ord()将字符转为十进制数*/
					if($val!=''){
						$name = $fv[$currentColumn];
						$erp_orders_id[$name] = $val;
					}
					/**如果输出汉字有乱码，则需将输出内容用iconv函数进行编码转换，如下将gb2312编码转为utf-8编码输出*/
					//echo iconv('utf-8','gb2312', $val)."\t";
						
				}
				array_push($data,$erp_orders_id);
				$erp_orders_id = array();
			}
				
			unlink($filePath);
			$model = D('Member');
			$erroruser = array();
			foreach($data as $k=>&$v){
				$groupid = $v['groupid'];
				unset($v['groupid']);
				$v['expeirtime'] = time()+86400*365;
				
				$v['posttime'] = time();
				$v['pwd'] = md5('123456');
				$v['email'] = time().$data['uname'].'@yishiwang.com';

				if(session('groupid') == 1){
					$allgroupid = array('2','3','4');
					$v['group1'] = session('uid');
				}else if(session('groupid') == 2){
					$allgroupid = array('3','4');
					$v['group2'] = session('uid');
				}else if(session('groupid') == 3){
					$allgroupid = array('4');
					$v['group3'] = session('uid');
				}
				if(!in_array($groupid,$allgroupid)){
					echo '用户'.$v['uname'].'分组错误<br />';
				}
				$condition['uname'] = $v['uname'];
				$user = $model->where($condition)->find();
				if($user){
					echo '添加用户'.$v['uname'].'失败，该账号已存在<br />';
				}else{		
					$result = $model->add($v);
					if(false !== $result){
						D('authgroupaccess')->addgroup($result,$groupid);
						D('user')->adduser($v,$groupid);
						echo '添加用户'.$v['uname'].'成功<br />';
					}else{
						echo '添加用户'.$v['uname'].'失败,失败原因:'.$model->getError().'<br />';
						//$this->error($model->getError());
					}
				}
				ob_flush();
				flush();
				sleep(1);
				
			}
			echo '<a href="'.U("Member/fadduser").'">返回用户管理</a>';
			/* if(count($erroruser) == 0){
				//$this->success('批量添加用户完成,共添加'.count($data));
			}else{
				echo '添加完成，共有下列用户手机号码重复';
				foreach($erroruser as $erruser=>$errvalu){
					echo '姓名'.$errvalu['truename'].'电话'.$errvalu['phone'];
				}
				echo '<a href="'.U("Member/fadduser").'">返回用户管理</a>';
			} */
			
		}else{
			$this->display();
		}
	}
	//会员管理
	function users(){
		$type = I('get.type');
		if(!I('get.uid')){
				if(session('groupid') == 1){
					$map['group1'] = I('get.uid')?I('get.uid'):session('uid');
				}else if(session('groupid') == 2){
					$map['group2'] = I('get.uid')?I('get.uid'):session('uid');
				}else if(session('groupid') == 3){
					$map['group3'] = I('get.uid')?I('get.uid'):session('uid');
				}
		}else{
			$groupid = D('authgroupaccess')->getGroupid(I('get.uid'));
			if($groupid == 1){
				$map['group1'] = I('get.uid');
			}else if($groupid == 2){
				$map['group2'] = I('get.uid');
			}else if($groupid == 3){
				$map['group3'] = I('get.uid');
			}
		}
		$model = D('MemberView');
		$map['Auth_group_access.group_id'] = $type;
		if(I('get.uname')){
			$map['uname'] = array('like','%'.I('get.uname').'%');
		}
		//echo $model->getLastsql();
		//
		$count = $model->where($map)->count('id');
		//创建分页对象
		//获取分页数
		$pageId = $_GET['page'];
		$pageId = $pageId == "" ? 1 : $pageId;
		$pageCount = ceil($count / 10);
		$url = CONTROLLER_NAME.'/'.ACTION_NAME;
		
		//分页查询数据
		$list = $model->where($map)->order('id desc')->page($pageId,10)->select();
		//echo $model->getLastsql();
		//分页跳转的时候保证查询条件
		$f = '';
		
		foreach ($map as $key => $val) {
			if (!is_array($val)) {
				$f .= "/$key/" . urlencode($val);
			}else{
				$types = array('applytime','zitime','ordertime');
				if(in_array($key, $types)){
					$f .= '/type/'.$key;
				}
				if($key == 'phone'){
					$f .= "/$key/" .str_replace('%', '', $val['1']);
				}else{
					$newtime = explode(',', $val['1']);
					$f .= '/time1/'.date('Y-m-d',$newtime['0']).'/time2/'.date('Y-m-d',$newtime['1']);
				}
					
			}
		}
		$page = pagerank($pageCount,$pageId,$count,$url,$f);
		//dump($list);
		$this->assign('list', $list);
		$this->assign('page',$page);
		$this->display();
	}
	//禁用账户
	function changestatus(){
		$status = I('get.status');
		if(is_numeric($status)){
			$condition['id'] = I('get.id');
			if(false !== M('member')->where($condition)->setField('status',$status)){
				$this->success('修改账户成功');
			}else{
				$this->error('修改账户失败');
			}
		}else{
			$this->error('错误的参数');
		}
	}
	//编辑用户
	function edit(){
		if(IS_POST){
			$model = D('Member');
			if(false !== $data = $model->create()){
				$condition['id'] = $data['id'];
				unset($data['pwd']);
				if(false !== $model->where($condition)->save($data)){
					$this->success('用户信息修改成功');
				}else{
					$this->error($model->getError());
				}
			}else{
				$this->error($model->getError());
			}
		}else{
			$id = I('get.id');
			if(is_numeric($id)){
				$map['id'] = $id;
				if(session('groupid') == 1){
					$map['group1'] = session('uid');
				}else if(session('groupid') == 2){
					$map['group2'] = session('uid');
				}else if(session('groupid') == 3){
					$map['group3'] = session('uid');
				}
				$info = M('member')->where($map)->find();
				$this->assign('info',$info);
				$this->display();
			}else{
				$this->error('错误的参数');
			}
		}
	}
	//公告管理
	function article(){
		if(I('get.title')){
			$map['title'] = array('like','%'.I('get.title').'%');
			$this->assign('keyword',I('get.title'));
		}
		if(session('groupid')!= 1){
		$map['uid'] = is_login();
		}
		$map['sort'] = 7;
		$this->_list('article',$map);
		$this->display();
	}
	function articleadd(){
		$dopost = I('post.action')?I('post.action'):'';
		if($dopost == 'add'){
				$model = D('article');
				if(false !== $data = $model->create()){
					$data['sort'] = 7;
					if(false !== $model->add($data)){
						if(session('groupid')==1){
						$this->success('公告添加成功',U('Member/article'));
						}else{
						$this->success('公告添加成功，请等待审核',U('Member/article'));
						}
					}else{
						$this->error('添加公告失败');
					}
				}else{
					$this->error('数据有误');
				}
		}else{
			
			$this->display();
		}
	}
	function articleedit(){
		$dopost = I('post.action')?I('post.action'):'';
		if($dopost == 'update'){
			$model = M('article');
			if(false !== $data = $model->create()){
				$condition['id'] = $data['id'];
				if(session('groupid') != 1){
					$condition['uid'] = is_login();
				}
				$data['status'] = getArticlestatus();
				if(false !== $model->where($condition)->save($data)){
					$this->success('公告修改成功',U('Member/article'));
				}else{
					$this->error('公告修改失败');
				}
			}else{
				$this->error('数据有误');
			}
		}else{
			$condition['id'] = I('get.id');
			if(session('groupid') != 1 ){
				$condition['uid'] = is_login();
			}
			$data = M('article')->where($condition)->find();
			if(empty($data)){
				$this->error('公告不存在或已被删除');
			}else if($data['status'] != 2 && session('groupid') != 1){
				$this->error('公告禁止编辑');
			}
			$this->assign('data',$data);
			$this->display();
		}
	}
	function articledel(){
		$condition['uid'] = is_login();
		if(session('groupid') != 1){
			$condition['id'] = I('get.id');
		}
		
		$result = M('article')->where($condition)->setField('status',3);
		if(false !== $result){
			$this->success('公告删除成功');
		}else{
			$this->error('公告删除失败');
		}
	}
	function articletop(){
		if(session('groupid') != 1){
			$this->error('您无权置顶公告');
			
		}
		$condition['id'] = I('get.id');
		M('article')->where("istop = 1")->setField('istop',0);
		$result = M('article')->where($condition)->setField('istop',1);
		if(false !== $result){
			$this->success('公告置顶成功');
		}else{
			$this->error('公告置顶失败');
		}
	}
	function articlestatus(){
		if(I('get.title')){
			$map['title'] = array('like','%'.I('get.title').'%');
			$this->assign('keyword',I('get.title'));
		}
		$map['sort'] = 7;
		$map['status'] = 0;
		$this->_list('article',$map);
		$this->display();
	}
	//审核公告
	function articlechangestatus(){
		
		if(session('groupid') != 1){
			$this->error('您无权操作');
		}
		$type = I('get.type');
		if($type == 'fabu'){
			$data['status'] = 1;
		}else{
			$data['status'] = 2;
		}
		$condition['id'] = I('get.id');
		$ndata = D('article')->getNewsByid($condition['id']);
		if($ndata['status'] == 1){
			$this->error('该公告已发布，您无权操作');
		}else if($type == 'fabu' && $ndata['status'] != 0){
			$this->error('公告已驳回,尚未提交');
		}else if($type == 'bohui' && $ndata['status'] != 0){
			$this->error('公告状态异常');
		}else{
			$result = M('article')->where($condition)->save($data);
			if(false !== $result){
				$this->success('操作成功');
			}else{
				$this->error('操作失败');
			}
		}
	}
	//驳回公告操作
	function bohui(){
		$dopost = I('post.action')?I('post.action'):'';
		if($dopost == 'save'){
			$id = I('post.id');
			$content = I('post.cts');
			$data['status'] = 2;
			$data['reason'] = $content;
			$condition['id'] = $id;
			$result = M('article')->where($condition)->save($data);
			if(false !== $result){
				$m['status'] = 1;
				//发送站内信
				$article = D('article')->getNewsByid($id);
				$uid = $article['uid'];
				$m['from_uid'] = is_login();
				$m['title'] = '您的公告'.$article['title'].'被驳回';
				$m['content'] = $content;
				$m['date'] = time();
				if(false !== $id = M('message_sender')->add($m)){
					$n['mid'] = $id;
					$n['to_uid'] = $uid;
					M('message_receiver')->add($n);
						
				}
			}else{
				$m['status'] = 2;
			}
			$this->ajaxReturn($m,'json');
		}else{
			$id = I('get.id');
			$article = D('article')->getNewsByid($id);
			if($article['status'] == 1){
				$this->error('该文章已经发布无法操作');
			}
			$this->assign('article',$article);
			$this->display();
		}
	}
	//统计
	function tongji(){
		//获取培训项目
		if(session('groupid') == 1){
			$pxxm = M('project')->select();
		}else{
			$map['uid'] = is_login();
			$pxxm = M('project')->where($map)->select();
		}
		
		$this->assign('pxxm',$pxxm);
		if(IS_POST){
			$sex = I('post.sex')?I('post.sex'):'';
			$start = I('post.start')?I('post.start'):0;
			$end = I('post.end')?I('post.end'):0;
			$ysjb = I('post.ysjb')?I('post.ysjb'):'';
			$xueli = I('post.xueli')?I('post.xueli'):'';
			$zyfw = I('post.zyfw')?I('post.zyfw'):'';
			$project = I('post.project')?I('post.project'):'';
			if(session('groupid') == 1){
				if($project == 0){
					if($sex != 0){
						$condition['sex'] = $sex;
					}
					if($end != 0 ){
						$condition['age'] = array('between',$start.','.$end);
					}
					if($ysjb != 0){
						$condition['ysjb'] = $ysjb;
					}
					if($xueli != 0){
						$condition['xueli'] = $xueli;
					}
					if($zyfw != 0){
						$condition['zyfw'] = $zyfw;
					}
				}else{
					$map['Project.id'] = $project;
					$data = D('projectView')->where($map)->select();
					$uids = array();
					foreach($data as $k=>$v){
						array_push($uids, $v['uid']);
					}
					$uid = implode(',', $uids);
					if($sex != 0){
						$condition['sex'] = $sex;
					}
					if($end != 0 ){
						$condition['age'] = array('between',$start.','.$end);
					}
					if($ysjb != 0){
						$condition['ysjb'] = $ysjb;
					}
					if($xueli != 0){
						$condition['xueli'] = $xueli;
					}
					if($zyfw != 0){
						$condition['zyfw'] = $zyfw;
					}
					$condition['id'] = array('in',$uid);
					$ts['pid'] = $project;
					$ts['sid'] = 0;
					//参与人数
					$people = M('mytask')->where($ts)->select();
					$count1 = count($people);
					$newcount = array();
					foreach($people as $k=>$v){
						if($v['isover'] == 1){
							array_push($newcount,$v);
						}
					}
					$count2 = count($newcount);
					$count3  = ceil($count2/$count1);
				}
			}else if(session('groupid') == 2){
			
				if($project == 0){
					$condition['group2'] = is_login();
					if($sex != 0){
						$condition['sex'] = $sex;
					}
					if($end != 0 ){
						$condition['age'] = array('between',$start.','.$end);
					}
					if($ysjb != 0){
						$condition['ysjb'] = $ysjb;
					}
					if($xueli != 0){
						$condition['xueli'] = $xueli;
					}
					if($zyfw != 0){
						$condition['zyfw'] = $zyfw;
					}
				}else{
					$map['Project.id'] = $project;
					$data = D('projectView')->where($map)->select();
					$uids = array();
					foreach($data as $k=>$v){
						array_push($uids, $v['uid']);
					}
					$uid = implode(',', $uids);
					if($sex != 0){
						$condition['sex'] = $sex;
					}
					if($end != 0 ){
						$condition['age'] = array('between',$start.','.$end);
					}
					if($ysjb != 0){
						$condition['ysjb'] = $ysjb;
					}
					if($xueli != 0){
						$condition['xueli'] = $xueli;
					}
					if($zyfw != 0){
						$condition['zyfw'] = $zyfw;
					}
					$condition['id'] = array('in',$uid);
					$ts['pid'] = $project;
					$ts['sid'] = 0;
					//参与人数
					$people = M('mytask')->where($ts)->select();
					$count1 = count($people);
					$newcount = array();
					foreach($people as $k=>$v){
						if($v['isover'] == 1){
							array_push($newcount,$v);
						}
					}
					$count2 = count($newcount);
					$count3  = ceil($count2/$count1);
				}
			}else if(session('groupid') == 3){
				if($project == 0){
					$condition['group3'] = is_login();
					if($sex != 0){
						$condition['sex'] = $sex;
					}
					if($end != 0 ){
						$condition['age'] = array('between',$start.','.$end);
					}
					if($ysjb != 0){
						$condition['ysjb'] = $ysjb;
					}
					if($xueli != 0){
						$condition['xueli'] = $xueli;
					}
					if($zyfw != 0){
						$condition['zyfw'] = $zyfw;
					}
				}else{
					$map['Project.id'] = $project;
					$data = D('projectView')->where($map)->select();
					$uids = array();
					foreach($data as $k=>$v){
						array_push($uids, $v['uid']);
					}
					$uid = implode(',', $uids);
					if($sex != 0){
						$condition['sex'] = $sex;
					}
					if($end != 0 ){
						$condition['age'] = array('between',$start.','.$end);
					}
					if($ysjb != 0){
						$condition['ysjb'] = $ysjb;
					}
					if($xueli != 0){
						$condition['xueli'] = $xueli;
					}
					if($zyfw != 0){
						$condition['zyfw'] = $zyfw;
					}
					$condition['id'] = array('in',$uid);
					$ts['pid'] = $project;
					$ts['sid'] = 0;
					//参与人数
					$people = M('mytask')->where($ts)->select();
					$count1 = count($people);
					$newcount = array();
					foreach($people as $k=>$v){
						if($v['isover'] == 1){
							array_push($newcount,$v);
						}
					}
					$count2 = count($newcount);
					$count3  = ceil($count2/$count1);
				}
			}else{
				$this->error('无权限');
			}
			$this->assign('count1',$count1?$count1:0);
			$this->assign('count2',$count2?$count2:0);
			$this->assign('count3',$count3?$count3:0);
			$this->display();
		}else{
		//当前在线用户
		$user_online = "count.php"; //保存人数的文件
		touch($user_online);//如果没有此文件，则创建
		$timeout = 30;//30秒内没动作者,认为掉线
		$user_arr = file_get_contents($user_online);
		$user_arr = explode('#',rtrim($user_arr,'#'));
		$temp = array();
		foreach($user_arr as $value){
			$user = explode(",",trim($value));
			if (($user[0] != getenv('REMOTE_ADDR')) && ($user[1] > time())) {//如果不是本用户IP并时间没有超时则放入到数组中
				array_push($temp,$user[0].",".$user[1]);
			}
		}
		array_push($temp,getenv('REMOTE_ADDR').",".(time() + ($timeout)).'#'); //保存本用户的信息
		$user_arr = implode("#",$temp);


		$this->assign('countper',count($temp));
		//trace('hhh',session('groupid'));
			if(session('groupid') == 1){
				
				
				$data['pxxm'] = M('project')->count();
				//培训人数统计
				$condition['sid'] = 0;
				$data['pxperson'] = M('mytask')->where($condition)->count();
				//培训学分
				$data['totalscore'] = D('project')->socre();
				$data['fenhui'] = D('MemberView')->where('Auth_group_access.group_id = 2')->count();
				$data['tuanti'] = D('MemberView')->where('Auth_group_access.group_id = 3')->count();
				$data['person'] = D('MemberView')->where('Auth_group_access.group_id = 4')->count();
				$data['man'] = M('member')->where('sex = 1')->count();
				$data['woman'] = M('member')->where('sex = 2')->count();
				$data['zhuanke'] = M('member')->where('xueli = 1')->count();
				$data['benke'] = M('member')->where('xueli = 2')->count();
				$data['yanjiusheng'] = M('member')->where('xueli = 3')->count();
				$data['qita'] = M('member')->where('xueli = 4')->count();
				$data['linchuang'] = M('member')->where('zyfw = 1')->count();
				$data['kouqiang'] = M('member')->where('zyfw = 2')->count();
				$data['gonggongweisheng'] = M('member')->where('zyfw = 3')->count();
				$data['zhongyi'] = M('member')->where('zyfw = 4')->count();
				$data['zyys'] = M('member')->where('ysjb = 1')->count();
				$data['zyzlys'] = M('member')->where('ysjb = 2')->count();
				$newchar = implode(',',$data);
				$this->assign('newchar',$newchar);
				$this->assign('data',$data);
				$this->display();
			}else if(session('groupid') == 2){
				$data['pxxm'] = M('project')->where("uid = ".is_login())->count();
				//培训人数统计
				$condition['sid'] = 0;
				$data['pxperson'] = M('mytask')->where($condition)->count();
				//培训学分
				$data['totalscore'] = D('project')->socre(is_login());
				$data['tuanti'] = D('MemberView')->where('Auth_group_access.group_id = 3 and Member.group2 = '.is_login())->count();
				$data['person'] = D('MemberView')->where('Auth_group_access.group_id = 4 and Member.group2 = '.is_login())->count();
				$data['man'] = M('member')->where('sex = 1 and group2 = '.is_login())->count();
				$data['woman'] = M('member')->where('sex = 2 and group2 = '.is_login())->count();
				$data['zhuanke'] = M('member')->where('xueli = 1 and group2 = '.is_login())->count();
				$data['benke'] = M('member')->where('xueli = 2 and group2 = '.is_login())->count();
				$data['yanjiusheng'] = M('member')->where('xueli = 3 and group2 = '.is_login())->count();
				$data['qita'] = M('member')->where('xueli = 4 and group2 = '.is_login())->count();
				$data['linchuang'] = M('member')->where('zyfw = 1 and group2 = '.is_login())->count();
				$data['kouqiang'] = M('member')->where('zyfw = 2 and group2 = '.is_login())->count();
				$data['gonggongweisheng'] = M('member')->where('zyfw = 3 and group2 = '.is_login())->count();
				$data['zhongyi'] = M('member')->where('zyfw = 4 and group2 = '.is_login())->count();
				$data['zyys'] = M('member')->where('ysjb = 1 and group2 = '.is_login())->count();
				$data['zyzlys'] = M('member')->where('ysjb = 2 and group2 = '.is_login())->count();
				$newchar = implode(',',$data);
				$this->assign('newchar',$newchar);
				$this->assign('data',$data);
				$this->display('group2');
			}else if(session('groupid') == 3){
				$data['pxxm'] = M('project')->where("uid = ".is_login())->count();
				//培训人数统计
				$condition['sid'] = 0;
				$data['pxperson'] = M('mytask')->where($condition)->count();
				//培训学分
				$data['totalscore'] = D('project')->socre(is_login());
				$data['person'] = D('MemberView')->where('Auth_group_access.group_id = 4 and Member.group2 = '.is_login())->count();
				$data['man'] = M('member')->where('sex = 1 and group2 = '.is_login())->count();
				$data['woman'] = M('member')->where('sex = 2 and group2 = '.is_login())->count();
				$data['zhuanke'] = M('member')->where('xueli = 1 and group2 = '.is_login())->count();
				$data['benke'] = M('member')->where('xueli = 2 and group2 = '.is_login())->count();
				$data['yanjiusheng'] = M('member')->where('xueli = 3 and group2 = '.is_login())->count();
				$data['qita'] = M('member')->where('xueli = 4 and group2 = '.is_login())->count();
				$data['linchuang'] = M('member')->where('zyfw = 1 and group2 = '.is_login())->count();
				$data['kouqiang'] = M('member')->where('zyfw = 2 and group2 = '.is_login())->count();
				$data['gonggongweisheng'] = M('member')->where('zyfw = 3 and group2 = '.is_login())->count();
				$data['zhongyi'] = M('member')->where('zyfw = 4 and group2 = '.is_login())->count();
				$data['zyys'] = M('member')->where('ysjb = 1 and group2 = '.is_login())->count();
				$data['zyzlys'] = M('member')->where('ysjb = 2 and group2 = '.is_login())->count();
				$newchar = implode(',',$data);
				$this->assign('newchar',$newchar);
				$this->assign('data',$data);
				$this->display('group3');
			}else{
				$this->error('无权限');
			}
		}
	}

	function tongjiweb(){
    		//获取培训项目
    		if(session('groupid') == 1){
    			$pxxm = M('project')->select();
    		}else{
    			$map['uid'] = is_login();
    			$pxxm = M('project')->where($map)->select();
    		}

    		$this->assign('pxxm',$pxxm);
    		if(IS_POST){

    			$starttime = I('post.starttime')?I('post.starttime'):0;
    			$endtime = I('post.$endtime')?I('post.$endtime'):0;
    			$this->assign('starttime',$starttime);
    			$this->assign('endtime',$endtime);

    			$this->display();
    		}else{
    		//当前在线用户
    		$user_online = "count.php"; //保存人数的文件
    		touch($user_online);//如果没有此文件，则创建
    		$timeout = 30;//30秒内没动作者,认为掉线
    		$user_arr = file_get_contents($user_online);
    		$user_arr = explode('#',rtrim($user_arr,'#'));
    		$temp = array();
    		foreach($user_arr as $value){
    			$user = explode(",",trim($value));
    			if (($user[0] != getenv('REMOTE_ADDR')) && ($user[1] > time())) {//如果不是本用户IP并时间没有超时则放入到数组中
    				array_push($temp,$user[0].",".$user[1]);
    			}
    		}
    		array_push($temp,getenv('REMOTE_ADDR').",".(time() + ($timeout)).'#'); //保存本用户的信息
    		$user_arr = implode("#",$temp);


    		$this->assign('countper',count($temp));

    			if(session('groupid') >= 1){
			        $starttime = date("Y-m-d",time()-24*60*60*10);
    		        $endtime = date("Y-m-d",time());

                    //进行原生的SQL查询
                    $str=" where time >= unix_timestamp('" . $starttime . "') and time <=unix_timestamp('". $endtime ."')  GROUP BY date( from_unixtime( time ) )";


					$project = M('loginlog')->query('select date( from_unixtime( time ) ) AS date, count( * ) AS num from __TABLE__'  .  $str);


    		        $this->assign('starttime',$starttime);
                    $this->assign('endtime',$endtime);

                    $timearr = array();
                    $dataarr = array();
                    foreach($project as $value){
                        array_push($timearr,$value['date']);
                        array_push($dataarr,$value['num']);
                    }
                    dump($timearr);
                    $this->assign('timearr',$timearr);
                    $this->assign('dataarr',$dataarr);
    				$this->display();
    			}else{
    				$this->error('无权限');
    			}
    		}
    	}
	function tongji2(){
		if(IS_GET){
			$sex = I('get.sex')?I('get.sex'):'';
			$start = I('get.start')?I('get.start'):0;
			$end = I('get.end')?I('get.end'):0;
			$ysjb = I('get.ysjb')?I('get.ysjb'):'';
			$xueli = I('get.xueli')?I('get.xueli'):'';
			$zyfw = I('get.zyfw')?I('get.zyfw'):'';
			$project = I('get.project')?I('project'):'';
			if(session('groupid') == 1){
				if($project == 0){
					if($sex != 0){
						$condition['sex'] = $sex;
					}
					if($end != 0 ){
						$condition['age'] = array('between',$start.','.$end);
					}
					if($ysjb != 0){
						$condition['ysjb'] = $ysjb;
					}
					if($xueli != 0){
						$condition['xueli'] = $xueli;
					}
					if($zyfw != 0){
						$condition['zyfw'] = $zyfw;
					}
				}else{
					$map['Project.id'] = $project;
					$data = D('projectView')->where($map)->select();
					$uids = array();
					foreach($data as $k=>$v){
						array_push($uids, $v['uid']);
					}
					$uid = implode(',', $uids);
					if($sex != 0){
						$condition['sex'] = $sex;
					}
					if($end != 0 ){
						$condition['age'] = array('between',$start.','.$end);
					}
					if($ysjb != 0){
						$condition['ysjb'] = $ysjb;
					}
					if($xueli != 0){
						$condition['xueli'] = $xueli;
					}
					if($zyfw != 0){
						$condition['zyfw'] = $zyfw;
					}
					$condition['id'] = array('in',$uid);
						$ts['pid'] = $project;
					$ts['sid'] = 0;
					//参与人数
					$people = M('mytask')->where($ts)->select();
					$count1 = count($people);
					$newcount = array();
					foreach($people as $k=>$v){
						if($v['isover'] == 1){
							array_push($newcount,$v);
						}
					}
					$count2 = count($newcount);
					$count3  = ceil($count2/$count1);
				}
			}else if(session('groupid') == 2){
				
			if($project == 0){
				$condition['group2'] = is_login();
					if($sex != 0){
						$condition['sex'] = $sex;
					}
					if($end != 0 ){
						$condition['age'] = array('between',$start.','.$end);
					}
					if($ysjb != 0){
						$condition['ysjb'] = $ysjb;
					}
					if($xueli != 0){
						$condition['xueli'] = $xueli;
					}
					if($zyfw != 0){
						$condition['zyfw'] = $zyfw;
					}
				}else{
					$map['Project.id'] = $project;
					$data = D('projectView')->where($map)->select();
					$uids = array();
					foreach($data as $k=>$v){
						array_push($uids, $v['uid']);
					}
					$uid = implode(',', $uids);
					if($sex != 0){
						$condition['sex'] = $sex;
					}
					if($end != 0 ){
						$condition['age'] = array('between',$start.','.$end);
					}
					if($ysjb != 0){
						$condition['ysjb'] = $ysjb;
					}
					if($xueli != 0){
						$condition['xueli'] = $xueli;
					}
					if($zyfw != 0){
						$condition['zyfw'] = $zyfw;
					}
					$condition['id'] = array('in',$uid);
					$ts['pid'] = $project;
					$ts['sid'] = 0;
					//参与人数
					$people = M('mytask')->where($ts)->select();
					$count1 = count($people);
					$newcount = array();
					foreach($people as $k=>$v){
						if($v['isover'] == 1){
							array_push($newcount,$v);
						}
					}
					$count2 = count($newcount);
					$count3  = ceil($count2/$count1);
				}
			}else if(session('groupid') == 3){
			if($project == 0){
				$condition['group3'] = is_login();
					if($sex != 0){
						$condition['sex'] = $sex;
					}
					if($end != 0 ){
						$condition['age'] = array('between',$start.','.$end);
					}
					if($ysjb != 0){
						$condition['ysjb'] = $ysjb;
					}
					if($xueli != 0){
						$condition['xueli'] = $xueli;
					}
					if($zyfw != 0){
						$condition['zyfw'] = $zyfw;
					}
				}else{
					$map['Project.id'] = $project;
					$data = D('projectView')->where($map)->select();
					$uids = array();
					foreach($data as $k=>$v){
						array_push($uids, $v['uid']);
					}
					$uid = implode(',', $uids);
					if($sex != 0){
						$condition['sex'] = $sex;
					}
					if($end != 0 ){
						$condition['age'] = array('between',$start.','.$end);
					}
					if($ysjb != 0){
						$condition['ysjb'] = $ysjb;
					}
					if($xueli != 0){
						$condition['xueli'] = $xueli;
					}
					if($zyfw != 0){
						$condition['zyfw'] = $zyfw;
					}
					$condition['id'] = array('in',$uid);
					$ts['pid'] = $project;
					$ts['sid'] = 0;
					//参与人数
					$people = M('mytask')->where($ts)->select();
					$count1 = count($people);
					$newcount = array();
					foreach($people as $k=>$v){
						if($v['isover'] == 1){
							array_push($newcount,$v);
						}
					}
					$count2 = count($newcount);
					$count3  = ceil($count2/$count1);
				}
			}else{
				$this->error('无权限');
			}
			$this->assign('count1',$count1);
			$this->assign('count2',$count2);
			$this->assign('count3',$count3);
			//$this->_list('member',$condition);
			$this->display('cx');
		}
	}
	function selectuser(){
		$this->display();
	}
	function selectgroupdo(){
		if(IS_AJAX){
			$groupid = I('post.gid');
			$uids = D('authgroupaccess')->selectgroup($groupid);
			$condition['id'] = array('in',$uids);
			$data = M('member')->where($condition)->field('id,uname')->select();
			$select = '<option value="0">请选择单位</option>';
			foreach($data as $k=>$v){
				$select .= '<option value="'.$v['id'].'">'.$v['uname'].'</option>';
			}
			$this->ajaxReturn($select,'json');
		}
	}
	function selectuserdo(){
		if(IS_AJAX){
			$fid = I('post.faid');
			$sid = I('post.sonid');
			$uname = trim(I('post.name'));
			if($uname != ''){
				$condition['uname'] = array('like','%'.$uname.'%');
				
			}
			if($fid == 1){
				//调取所有会员
				$uids = D('authgroupaccess')->selectgroup($fid);
				$condition['group1'] = array('in',$uids);
				$condition['id'] = array('in',$uids);
				$condition['_logic'] = 'or';
			
			}else{
				if($sid == 0){
					$uids = D('authgroupaccess')->selectgroup($fid);
					if($fid == 2){
						$condition['group2'] = array('in',$uids);
					}else{
						$condition['group3'] = array('in',$uids);
					}
					$condition['id'] = array('in',$uids);
					$condition['_logic'] = 'or';
				}else{
					if($fid == 2){
						$condition['group2'] = $sid;
					}else{
						$condition['group3'] = $sid;
					}
					$condition['id'] = array('in',$sid);
					$condition['_logic'] = 'or';
				}
			}
			
			$user = M('member')->where($condition)->field('id,uname,truename')->select();
			//echo M('member')->getLastsql();
				$chk = '';
				$mailuser = session('mailuser');
				foreach($user as $k=>$v){
					$chk .= '<li><input type="checkbox" '.retrunChecks($mailuser,$v['id']).' id="'.$v['id'].'" name="uid[]" value="'.$v['id'].'" onclick="addv(this.value)">'.$v['uname'].'('.$v['truename'].')</li>';
				}
			$this->ajaxReturn($chk,'json');
		}
	}
	function showusers(){
		//$ids = I('get.uids');
		$ids = session('mailuser');
		
		$condition['id'] = array('in',$ids);
		$data = M('member')->where($condition)->field('id,truename,company')->select();
		$total = M('member')->where($condition)->count();
		
		$this->assign('data',$data);

		$this->assign('total',$total);
		$this->display();
	}
	//用户处理
	function mailuser(){
		if(IS_AJAX){
			$action = I('post.action')?I('post.action'):'';
			$id = I('post.uid');
			if($action == 'add'){
					$mailuser = session('mailuser');
					if(empty($mailuser)){
						$suser = array();
						$suser[] = $id;
						session('mailuser',implode(',', $suser));
					}else{
						$suser = explode(',', $mailuser);
						if(!in_array($id, $suser)){
							$suser[] = $id;
							session('mailuser',implode(',', $suser));
						}
					}
					$this->ajaxReturn(1,'json');
			}else{
				$mailuser = session('mailuser');
				if(!empty($mailuser)){
					$suser = explode(',', $mailuser);
					foreach($suser as $k=>&$v){
						if($v === $id){
							unset($suser[$k]);
						}
					}
					session('mailuser',implode(',', $suser));
					$this->ajaxReturn(1,'json');
				}	
			}
		}
		
	}
	
	
}
