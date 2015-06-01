<?php
/**
*author:quanyinzhong
*email:290551872@163.com
*website:http://www.35258.com
**/
namespace Admin\Model;
class ArticleModel extends \Think\Model{
	protected $_validate = array(
		array('title','','标题已存在',0,'unique',1), // 在新增的时候验证name字段是否唯一
	);
	protected $_auto = array (
			array('posttime','time',1,'function'), // 对update_time字段在更新的时候写入当前时间戳
			array('status','1'),
	);
}