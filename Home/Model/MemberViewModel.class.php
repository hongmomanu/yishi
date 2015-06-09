<?php
/**
*author:quanyinzhong
*email:290551872@163.com
*website:http://www.35258.com
**/
namespace Home\Model;
use Think\Model\ViewModel;
class MemberViewModel extends ViewModel{
	public $viewFields = array(
			'Member'=>array('id','uname','truename','phone','group1','group2','group3','sex','status','company','posttime','expeirtime'),
			'Auth_group_access'=>array('uid','group_id','_on'=>'Auth_group_access.uid=Member.id')
			);
}