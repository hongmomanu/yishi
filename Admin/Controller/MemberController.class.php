<?php
// 本类由系统自动生成，仅供测试用途
namespace Admin\Controller;
use Think\Controller;
class MemberController extends CommonController {
	//会员列表页面
	function index(){
		if(I('get.uname')){
			$map['uname'] = array('like','%'.I('get.uname').'%');
			$this->assign('keyword',I('get.uname'));
		}
		$this->_list('member',$map);
		$this->display();
	}
	//编辑会员
	function edit(){
		$action = I('post.action')?I('post.action'):'';
		if($action && $action == 'update'){
			$model = M('member');
			if(false !== $data = $model->create()){
				$condition['id'] = $data['id'];
				$data['expeirtime'] = date2time($data['expeirtime']);
				if($data['pwd'] != ''){
					$data['pwd'] = md5(trim($data['pwd']));
				}else{
					unset($data['pwd']);
				}
				if(false !== $model->where($condition)->save($data)){
					D('authgroupaccess')->addgroup($data['id'],I('post.group'));
					$this->success("用户信息更新成功",U('Member/index'));
				}else{
					$this->error("用户信息更新失败",U('Member/index'));
				}
			}else{
				$this->error($model->getError());
			}
		}else{
			$id = I('get.uid');
			if($id && is_numeric($id)){
				$info = D('member')->getById($id);
				$info['group'] = D('authgroupaccess')->getGroupid($info['id']);
				$this->assign('data',$info);
				//获取前台分组
				$group = D('authgroup')->getGroup('home');
				$this->assign('group',$group);
				$this->display();
			}else{
				$this->error('错误的参数',U('Member/index'));
			}
		}
	}
	//删除会员
	function del(){
		$id = I('get.id');
		if($id && is_numeric($id)){
			$model = M('member');
			$result = $model->delete($id);
			if(false !== $result){
				$this->success('删除用户成功',U('Member/index'));
			}else{
				$this->error($model->getError(),U('Member/index'));
			}
		}else{
			$this->error('错误的参数');
		}
	}
	//重置密码
	function repass(){
		$id = I('get.id');
		$result = M('user')->where('id='.$id)->setField('pass',md5('sxpfxb87315858'));
		if(false !== $result){
			$this->success('密码修改成功');
		}else{
			$this->success('密码修改失败');
		}
	}
	//添加会员
	function adduser(){
		$action = I('post.action')?I('post.action'):'';
		if($action && $action == 'add'){
			$model = D('member');
			if(false !== $data = $model->create()){
				if(false !== $model->add()){
					D('authgroupaccess')->addgroup($data['id'],I('post.group'));
					D('user')->adduser($data,I('post.group'));
					$this->success("添加用户成功",U('Admin/Member/index'));
				}else{
					$this->error("添加用户失败",U('Admin/Member/index'));
				} 
			}else{
				$this->error($model->getError());
			}
		}else{
			
				//获取前台分组
				$group = D('authgroup')->getGroup('home');
				$this->assign('group',$group);
				$this->display();
		}
	}
	//批量添加会员
	function adduserf(){
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
			$fv = array('A'=>'uname','B'=>'sex','C'=>'both','D'=>'xueli','E'=>'xuewei','F'=>'card','G'=>'email','H'=>'phone','I'=>'company','J'=>'room','K'=>'zhiwu','L'=>'zynx','M'=>'zyfw','N'=>'ysjb','O'=>'zgzsbh','P'=>'zyzsbh','Q'=>'address','R'=>'status','S'=>'groupid');
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
			foreach($data as $k=>$v){
				$groupid = $v['groupid'];
				unset($v['groupid']);
				$v['posttime'] = time();
				$v['pwd'] = md5('123456');
				if($model->checkuname($v['uname'])){
					$this->error('用户'.$v['uname'].'已存在');
				}else{
					$result = $model->add($v);
					if(false !== $result){
						D('authgroupaccess')->addgroup($result,$groupid);
						D('user')->adduser($v,$groupid);
					}else{
						$this->error($model->getError());
					}
				}
			}
			$this->success('批量添加用户完成,共添加'.count($data));
		}else{
			$this->display();
		}
	}
}