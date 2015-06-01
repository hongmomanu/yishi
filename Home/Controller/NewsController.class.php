<?php
// 本类由系统自动生成，仅供测试用途
namespace Home\Controller;
use Think\Controller;
class NewsController extends CommonController {
	function index(){
		if(session('groupid') != 1){
			$this->error('无权操作');
		}
		$map['sort'] = array('neq','7');
		$this->_list('article',$map);
		$this->display();
	}
	//添加资讯
	function newsadd(){
		if(session('groupid') != 1){
			$this->error('无权操作');
		}
		if(IS_POST){
			$model = D('article');
			if(false !== $data = $model->create()){
				if(false !== $model->add()){
					$this->success('添加成功',U('News/index'));
				}else{
					$this->error($model->getError());
				}
			}else{
				$this->error($model->getError());
			}
		}else{
			//获取分类
			$sort = D('sort')->CacheSort();
			foreach($sort as $k=>$v){
				if($v['name'] == '公告管理'){
					unset($sort[$k]);
				}
			}
			$this->assign('sort',$sort);
			$this->display();
		}
	}
	//编辑资讯
	function newsedit(){
		if(session('groupid') != 1){
			$this->error('无权操作');
		}
		if(IS_POST){
			$model = D('article');
			if(false !== $data = $model->create()){
				$condition['id'] = $data['id'];
				if(false !== $model->where($condition)->save()){
					$this->success('更新成功',U('News/index'));
				}else{
					$this->error($model->getError());
				}
			}else{
				$this->error($model->getError());
			}
		}else{
			$data = M('article')->find(I('get.id'));
			$this->assign('data',$data);
			//获取分类
			$sort = D('sort')->CacheSort();
			foreach($sort as $k=>$v){
				if($v['name'] == '公告管理'){
					unset($sort[$k]);
				}
			}
			$this->assign('sort',$sort);
			$this->display();
		}
	}
	//删除资讯
	function newsdel(){
		if(session('groupid') != 1){
			$this->error('无权操作');
		}
		$result = M('article')->delete(I('get.id'));
		if(false !== $result){
			$this->success('删除成功',U('News/index'));
		}else{
			$this->error('删除失败');
		}
	}
}