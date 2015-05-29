<?php
/**
*author:quanyinzhong
*email:290551872@163.com
*website:http://www.35258.com
**/
namespace Admin\Controller;
use Think\Controller;
class NetworkController extends CommonController{
	//网络报表
	function netcount(){
		$data = M('baidu')->select();
		foreach($data as $k=>&$v){
			$url['0'] = I('get.time1')?I('get.time1'):date('Y-m-d',time());
			$url['1'] = I('get.time2')?I('get.time2'):date('Y-m-d',time());
			if($v['type'] == 1){
				$result = D('sem')->getInfo($v['id'],$url);
				$v['yyl'] = $result['yy'];
				$v['ldl'] = $result['ldl'];
				$v['yxdh'] = $result['yxdh'];
				$v['jjdh'] = $result['jjdh'];
				$v['dzl'] = $result['djl'];
			}else{
				//saifutong
				$result = D('saifutong')->getInfo($v['id'],$url);
				$v['yyl'] = $result['yy'];
				$v['ldl'] = $result['ldl'];
				$v['yxdh'] = $result['yxdh'];
				$v['jjdh'] = $result['jjdh'];
				$v['dzl'] = $result['djl'];
			}
		}
		$this->assign('url',$url);
		$this->assign('data',$data);
		$this->display();
	}
	//竞价分析
	function baidu(){
		$this->_list('sem');
		$result = D('Baidu')->returnByType(1);
		$this->assign('result',$result);
		$this->display();
	}
	//添加竞价分析
	function addbaidu(){
		$action = I('post.action')?I('post.action'):'';
		if($action == 'add'){
			$model = D('sem');
			$data = $model->create();
			//获取病种id
			$ids = D('disease')->returnDiseaseId();
			$dis = array();
			foreach($ids as $v){
				$dis['d_'.$v] = I('post.d_'.$v);
			}
			$data['disease'] = serialize($dis);
			//获取地区id
			$addressid = D('address')->returnAddressId();
			$data['ptime'] = date2time($data['ptime']);
			if(false !== D('Sem')->checks($data['ptime'],$data['pid'])){
					$this->error('数据已存在');
			}
			unset($v);
			$adis = array();
			foreach($addressid as $v){
				$adis['s_'.$v] = I('post.s_'.$v);
			}
			$data['area'] = serialize($adis);
			//dump(unserialize($f));
			$result = D('sem')->data($data)->add();
			if(false !== $result){
				$this->success('数据添加成功');
			}else{
				$message = $model->getError();
				$this->error($message);
			}
		}else{
			//竞价媒体
			$result = D('Baidu')->returnByType(1);
			$this->assign('result',$result);
			//病种
			$disease = D('Disease')->diseaseCache();
			$this->assign('disease',$disease);
			//地区
			$address = D('Address')->areaCache();
			$this->assign('address',$address);
			$this->display();
		}
	}
	//整合营销
	function news(){
		$this->_list('saifutong');
		$result = D('Baidu')->returnByType(2);
		$this->assign('result',$result);
		$this->display();
	}
	//添加整合营销
	function addnews(){
		$action = I('post.action')?I('post.action'):'';
		if($action == 'add'){
			$model = D('saifutong');
			$data = $model->create();
			if(false === $data){
				$message = $model->getError();
				$this->error($message);
			}else{
				$data['ptime'] = date2time($data['ptime']);
				if(false !== D('Saifutong')->checks($data['ptime'],$data['pid'])){
					$this->error('数据已存在');
				}
				if(false !== $model->data($data)->add()){
					$this->success('数据添加成功');
				}else{
					$message = $model->getError();
					$this->error($message);
				}
			}
		}else{
			$result = D('Baidu')->returnByType(2);
			$this->assign('result',$result);
			$this->display();
		}
	}
}