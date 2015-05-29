<?php
/**
*author:quanyinzhong
*email:290551872@163.com
*website:http://www.35258.com
**/
namespace Home\Model;
class ArticleModel extends \Think\Model{
	protected $_auto = array (
			array('posttime','time',1,'function'), // 对update_time字段在更新的时候写入当前时间戳
			array('status','getArticlestatus',1,'function'), // 对update_time字段在更新的时候写入当前时间戳
			array('uid','is_login',1,'function'), // 对update_time字段在更新的时候写入当前时间戳

	);
	//根据分类调取文章
	public static function getNewsList($sort,$num){
		$condition['sort'] = $sort;
		$condition['status'] = 1;
		$data = M('article')->where($condition)->Field('id,title,posttime,istop')->order('istop DESC,id DESC')->limit($num)->select();
		return $data;
	}
	//获取单片文章
	public static function getNewsByid($id){
		$data = M('article')->find($id);
		return $data;
	}
	public static function getcontent(){
		$map['sort'] = 7;
		$map['status'] = 1;
		$data = M('article')->where($map)->order("id DESC")->find();
		$result = '<a href="'.U("Index/article",array('id'=>$data['id'])).'">'.$data['title'].'</a>';
		return $result;
	}
}
