<?php
// 本类由系统自动生成，仅供测试用途
namespace Admin\Controller;
use Think\Controller;
class NewsController extends CommonController {
	function index(){
		$this->_list('article');
		$this->display();
	}
	//添加资讯
	function newsadd(){
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
			$this->assign('sort',$sort);
			$this->display();
		}
	}
	//编辑资讯
	function newsedit(){
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
			$this->assign('sort',$sort);
			$this->display();
		}
	}
	//删除资讯
	function newsdel(){
		$result = M('article')->delete(I('get.id'));
		if(false !== $result){
			$this->success('删除成功',U('News/index'));
		}else{
			$this->error('删除失败');
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
			$sort = D('sort')->CacheSort();
			$this->assign('sort',$sort);
			$this->display();
		}
	}
	//添加分类
	function addsort(){
		$action = I('post.action')?I('post.action'):'';
		if($action == 'add'){
			$model = D('sort');
			if(false !== $data = $model->create()){
				if(false !== $model->add()){
					S('sortcache',NULL);
					$this->success('添加成功');
				}else{
					$this->error($model->getError());
				}
			}else{
				$this->error($model->getError());
			}
		}else{
			$sort = D('sort')->CacheSort();
			$this->assign('sort',$sort);
			$this->display();
		}
	}
}