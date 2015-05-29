<?php
/**
*author:quanyinzhong
*email:290551872@163.com
*website:http://www.35258.com
**/
namespace Admin\Controller;
use Admin\Controller\CommonController;
class SystemController extends CommonController{
	//分组列表
	function group(){
		$this->_list('auth_group');
		$this->display();
	}
	//增加分组
	function groupadd(){
		$action = I('post.action')?I('post.action'):'';
		if($action == 'add'){
			$address = D('auth_group');
			$data = $address->create();
			$address->type = 1;
			if(false !== $address->add()){
				D('Authgroup')->rebuildgroup();
				$this->success('亲，恭喜你哦，我又长大了');
			}else{
				$message = $address->getError();
				$this->error($message);
			}
		}else{
			$this->display();
		}
	}
	//编辑分组
	function groupedit(){
		$action = I('post.action')?I('post.action'):'';
		if($action == 'edit'){
			$address = D('auth_group');
			if(false == $data = $address->create()){
				$message = $address->getError();
				$this->error($message);
			}else{
				if(false !== $address->where("id=".$data['id'])->save()){
					D('Authgroup')->rebuildgroup();
					$this->success('亲，恭喜你哦，系统更新完毕');
				}else{
					$message = $address->getError();
					
					$this->error($message);
				}
			}
		}else{
			$id = I('get.id');
			$data = M('auth_group')->where('id='.$id)->find();
			$this->assign('data',$data);
			$this->display();
		}
	}
	//删除分组
	function groupdel(){
		$id = I('get.id');
		$this->_del('auth_group',$id);
	}
	//授权信息
	function role(){
		$action = I('post.action')?I('post.action'):'';
		if($action == 'edit'){
			$name = I('post.checkbox');
				$data['rules'] = implode(',',$name);
				$id = I('post.id');
				if(false !== D('auth_group')->where("id=".$id)->save($data)){
					D('Authgroup')->rebuildgroup();
					$this->success('亲，恭喜你哦，系统更新完毕');
				}else{
					$this->error('太遗憾了，费了这么力气还是失败了');
				}
		}else{
			$id = I('get.id');
			$data = M('auth_group')->where('id='.$id)->field('id,title,rules')->find();
			$this->assign('data',$data);
			$this->display();
		}
	}
	//账号列表
	function account(){
		$this->_list('sysuser');
		$this->display();
	}
	//增加账号
	function accountadd(){
		$action = I('post.action')?I('post.action'):'';
		if($action == 'add'){
			$address = D('admin');
			$data = $address->create();
			$address->pwd = md5('sxpfxb87315858');
			$room = I('post.room');
			$data['room'] = implode(',',$room);
			$result = $address->data($data)->add();
			if(false !== $result){
				$group['group_id'] = I('post.groupid');
				$group['uid'] = $result;
				M('auth_group_access')->data($group)->add();
				$this->success('亲，恭喜你哦，我又长大了');
			}else{
				$message = $address->getError();
				$this->error($message);
			}
		}else{
			$group = D('authgroup')->groupCache();
			$this->assign('group',$group);
			$room = D('Room')->RoomCache();
			$this->assign('room',$room);
			$this->display();
		}
	}
	//编辑账号
	function accountedit(){
		$action = I('post.action')?I('post.action'):'';
		if($action == 'edit'){
			$address = D('sysuser');
			if(false == $data = $address->create()){
				$message = $address->getError();
				$this->error($message);
			}else{
				if(false !== $address->where("id=".$data['id'])->save($data)){
					if(D('Authgroupaccess')->addgroup($data['id'],I("post.groupid"))){
						$this->success('亲，恭喜你哦，系统更新完毕');
					}else{
						$this->error('添加失败');
					}
				}else{
					$message = $address->getError();
					$this->error($message);
				}
			}
		}else{
			$id = I('get.id');
			$data = M('sysuser')->where('id='.$id)->find();
			$data['groupid'] = D('Authgroupaccess')->getGroupid($id);
			$this->assign('data',$data);
			$group = D('authgroup')->groupCache();
			$this->assign('group',$group);
			$this->display();
		}
	}
	//删除账号
	function accountdel(){
		$id = I('get.id');
		$this->_del('admin',$id);
	}
	
	//操作日志
	function actlog(){
		$this->display();
	}
	//系统日志
	function syslog(){
		$this->_list('loginlog');
		$this->display();
	}
	//重置密码
	function repass(){
		$id = I('get.id');
		$result = M('sysuser')->where('id='.$id)->setField('password',md5('sxpfxb87315858'));
		if(false !== $result){
			$this->success('修改成功');
		}else{
			$this->success('修改失败');
		}
	}
	//单页面管理
	function alonepage(){
		$this->_list('alonepage');
		$this->display();	
	}
	function aloneedit(){
		$dopost = I('post.action')?I('post.action'):'';
		if($dopost == 'save'){
			$model = M('alonepage');
			if(false !== $data = $model->create()){
				$condition['id'] = $data['id'];
				if(false !== $model->where($condition)->save($data)){
					$this->success('更新成功');
				}else{
					$this->error('更新失败');
				}
			}else{
				$this->error('数据错误');
			}
		}else{
			$id = I('get.id');
			$data = M('alonepage')->find($id);
			$this->assign('data',$data);
			$this->display();
		}
	}
}