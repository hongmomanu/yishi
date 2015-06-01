<?php
// 本类由系统自动生成，仅供测试用途
namespace Admin\Controller;
use Think\Controller;
class ProjectController extends CommonController {
	//上线项目列表
	function online(){
		$map['status'] = 1;
		$this->_list('project',$map);
		$this->display();
	}
	//编辑上线项目
	function onlineedit(){
		$action = I('post.action')?I('post.action'):'';
		if($action == 'edit'){
			
		}else{
			$pid = I('get.pid');
			if($pid && is_numeric($pid)){
				$data = D('project')->getInfoById($pid);
				$this->assign('data',$data);
				//项目分类
				$sort = D('Sort')->CacheSort();
				$this->assign('sort',$sort);
				//获取省份
				$city = D('Area')->getCityByPid(0);
				$this->assign('city',$city);
				//获取城市
				$country = D('Area')->getCityByPid($data['city']);
				$this->assign('country',$country);
				$this->display();
			}else{
				$this->error('错误的参数');	
			}
			
		}
	}
	//未审核项目列表
	function offline(){
		$map['status'] = array('in','2,3');
		$this->_list('project',$map);
		$this->display();
	}
	//回收站项目
	function recyled(){
		$map['status'] = 4;
		$this->_list('project',$map);
		$this->display();
	}
	//项目支持
	function delorder(){
		$this->_list('paylist');
		$this->display();
	}
	//查看支持详情
	function payview(){
		
	}
	//项目点评
	function comment(){
		$this->_list('comment');
		$this->display();
	}
	//移到回收站
	function putrecyle(){
		$id = I('get.id');
		if(is_numeric($id)){
			$condition['id'] = $id;
			$result = M('project')->where($condition)->setField('status',4);
			if(false !== $result){
				$this->success('移动到回收站成功');
			}else{
				$this->error('移动到回收站失败');
			}
		}else{
			$this->error('错误的参数');
		}
	}
	//项目回报
	function subitem(){
		$map['pid'] = I('get.id');
		$this->_list('huibao',$map);
		$this->display();
	}
	//删除项目汇报
	function delsubitem(){
		$id = I('get.id');
		if($id){
			$result = M('huibao')->delete($id);
			if(false !== $result){
				$this->success('删除项目回报成功');
			}else{
				$this->error('删除项目汇报失败');
			}
		}else{
			$this->error('参数错误');
		}
	}
	//编辑项目回报
	function editsubitem(){
		$action = I('post.action')?I('post.action'):'';
		if($action == 'update'){
			$model = M('huibao');
			if(false !== $data = $model->create()){
				$condition['id'] = $data['id'];
				$result = $model->where($condition)->save();
				if(false !== $result){
					$this->success('更新成功');
				}else{
					$this->error($model->getError());
				}
			}else{
				$this->error($model->getError());
			}
		}else{
			$data = M('huibao')->find(I('get.id'));
			$this->assign('data',$data);
			$this->display();
		}
	}
	//分类
	function sort(){
		$this->_list('sort');
		$this->display();
	}
	//删除分类
	function delsort(){
		if(is_numeric(I('get.id'))){
			$result = M('sort')->delete(I('get.id'));
			if(false !== $result){
				S('sortcache',NULL);//清楚缓存
				$this->success('删除成功');
			}else{
				$this->error('删除失败');
			}
		}else{
			$this->error('错误的参数');
		}
	}
	//编辑分类
	function editsort(){
		$action = I('post.action')?I('post.action'):'';
		if($action == 'update'){
			$model = M('sort');
			if(false !== $data = $model->create()){
				$condition['id'] = $data['id'];
				if(false !== $model->where($condition)->save()){
					S('sortcache',NULL);
					$this->success('修改成功');
				}else{
					$this->error($model->getError());
				}
			}else{
				$this->error($model->getError());
			}
		}else{
			$data = M('sort')->find(I('get.id'));
			$this->assign('data',$data);
			$this->display();
		}
	}
}