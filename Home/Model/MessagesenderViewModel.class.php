<?php
/**
*author:quanyinzhong
*email:290551872@163.com
*website:http://www.35258.com
**/
namespace Home\Model;
use Think\Model\ViewModel;
class MessagesenderViewModel extends ViewModel{
	public $viewFields = array(
			'Message_sender'=>array('mid','from_uid','title','from_deleted','date'),
			'Message_receiver'=>array('rid','mid','to_uid','is_readed','is_deleted','_on'=>'Message_sender.mid=Message_receiver.mid')
			);
}