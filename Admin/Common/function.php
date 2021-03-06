<?php
/**
*author:quanyinzhong
*email:290551872@163.com
*website:http://www.xablackcat.com
**/

//转换成GB2312字符
function GetGB2312String($name)
{
$tostr = "";
for($i=0;$i<strlen($name);$i++)
{
   $curbin = ord(substr($name,$i,1));
   if($curbin < 0x80)
   {
    $tostr .= substr($name,$i,1);
   }elseif($curbin < bindec("11000000")){
    $str = substr($name,$i,1);
    $tostr .= "&#".ord($str).";";
   }elseif($curbin < bindec("11100000")){
    $str = substr($name,$i,2);
    $tostr .= "&#".GetUnicodeChar($str).";";
    $i += 1;
   }elseif($curbin < bindec("11110000")){
    $str = substr($name,$i,3);
    $gstr= iconv("UTF-8","GB2312",$str);
    if(!$gstr)
    {
    $tostr .= "&#".GetUnicodeChar($str).";";
    }else{
    $tostr .= $gstr;
    }

    $i += 2;
   }elseif($curbin < bindec("11111000")){
    $str = substr($name,$i,4);
    $tostr .= "&#".GetUnicodeChar($str).";";

    $i += 3;
   }elseif($curbin < bindec("11111100")){
    $str = substr($name,$i,5);
    $tostr .= "&#".GetUnicodeChar($str).";";

    $i += 4;
   }else{
    $str = substr($name,$i,6);
    $tostr .= "&#".GetUnicodeChar($str).";";

    $i += 5;
   }
}

return $tostr;
}

function GetUnicodeChar($str)
{
$temp = "";
for($i=0;$i<strlen($str);$i++)
{
   $x = decbin(ord(substr($str,$i,1)));
   if($i == 0)
   {
    $s = strlen($str)+1;
    $temp .= substr($x,$s,8-$s);
   }else{
    $temp .= substr($x,2,6);
   }
}
return bindec($temp);
}
//返回checked
function retrunCheck($x,$y){
	if($x == $y){
		return 'checked="checked"';
	}
}

function retrunChecks($string,$value){
	$array = explode(",",$string);
	if(in_array($value,$array) && $value !=0){
		return 'checked="checked"';
	}
}

//返回selected
function retrunSelect($x,$y){
	if($x == $y){
		return 'selected="selected"';
	}
}
//返回男女
function gender($num){
	$gen = array('1'=>'男','2'=>'女');
	return $gen[$num];
}
//返回状态
function getStatus($num){
	$st = array('失败','成功');
	return $st[$num];
}

/**
 +----------------------------------------------------------
 * 字符串截取，支持中文和其他编码
 +----------------------------------------------------------
 * @static
 * @access public
 +----------------------------------------------------------
 * @param string $str 需要转换的字符串
 * @param string $start 开始位置
 * @param string $length 截取长度
 * @param string $charset 编码格式
 * @param string $suffix 截断显示字符
 +----------------------------------------------------------
 * @return string
 +----------------------------------------------------------
 */
function msubstr($str, $start=0, $length, $charset="utf-8", $suffix=true)
{
    if(function_exists("mb_substr"))
        return mb_substr($str, $start, $length, $charset);
    elseif(function_exists('iconv_substr')) {
        return iconv_substr($str,$start,$length,$charset);
    }
    $re['utf-8']   = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|[\xe0-\xef][\x80-\xbf]{2}|[\xf0-\xff][\x80-\xbf]{3}/";
    $re['gb2312'] = "/[\x01-\x7f]|[\xb0-\xf7][\xa0-\xfe]/";
    $re['gbk']    = "/[\x01-\x7f]|[\x81-\xfe][\x40-\xfe]/";
    $re['big5']   = "/[\x01-\x7f]|[\x81-\xfe]([\x40-\x7e]|\xa1-\xfe])/";
    preg_match_all($re[$charset], $str, $match);
    $slice = join("",array_slice($match[0], $start, $length));
    if($suffix) return $slice."…";
    return $slice;
}


/*返回散列校验*/
function Hah(){
	$hash = md5('qinxue-Qinxue-hash-md5-'.time().'!@#$%^&*');
	$_SESSION['v_mobile_check'] = md5($hash);
	return $hash;
}




//删除文件(慎用)
function rmFiles($d){
	$dir=opendir($d);
	while (false !== ($file = readdir($dir))){
		if($file =="." || $file==".."){}
		else{
			if(is_dir($d.'/'.$file)){
					rmFiles($d.'/'.$file);
			}else{
				unlink($d."/".$file);
			}
		}
	}
	return true;
}

//返回文件大小
function change_size($fileSize_int)//文件名  
   {  
       if($fileSize_int>1024)  
       {  
          $fileSizeNew_int=$fileSize_int/1024;//转换为K  
          $unit_str='KB';  
            if($fileSizeNew_int>1024)  
             {  
              $fileSizeNew_int=$fileSizeNew_int/1024;//转换为M  
              $unit_str='MB';  
             }  
          $fileSizeNew_arr=explode('.',$fileSizeNew_int);  
          $fileSizeNew_str=$fileSizeNew_arr[0].'.'.substr($fileSizeNew_arr[1],0,2).$unit_str;  
       } else{
       	$fileSizeNew_str = $fileSize_int." B"; 
       } 
       return $fileSizeNew_str;  
   } 
//转换unix时间戳
function date2time($tdata){
	date_default_timezone_set('ETC/GMT-8'); 
	return strtotime($tdata);
}
//获取当天，当月的unix时间戳
function udate($num='2'){
	$now = time();  
	if($num == '1'){
		//返回当月
		/*$monthstart = date2time(date('Y-m-01',time()));
		$monthend = date2time(date('Y-m-t',time()));
		$s = array($monthstart,$monthend);*/
		$y=date("Y",time());
		$m=date("m",time());
		$d=date("d",time());
		$t0=date('t');           // 本月一共有几天
		$t1=mktime(0,0,0,$m,1,$y);        // 创建本月开始时间 
		$t2=mktime(23,59,59,$m,$t0,$y);       // 创建本月结束时间
		$s = array($t1,$t2);
	}else if($num == '3'){
		//返回上月
		  $time=strtotime(date('Y-m-d'));
		  $firstday=date('Y-m-01',strtotime(date('Y',$time).'-'.(date('m',$time)-1).'-01'));
		  $lastday=date('Y-m-d',strtotime("$firstday +1 month -1 day"));
		  $lastmonthf = date2time($firstday." 00:00:00");
		  $lastmonthe = date2time($lastday."23:59:59");
		  $s = array($lastmonthf,$lastmonthe);
	}else if($num == 'yestarday'){
		//昨天
		   $time = strtotime('-1 day', $now);  
		   $beginTime = strtotime(date('Y-m-d 00:00:00', $time));  
		   $endTime = strtotime(date('Y-m-d 23:59:59', $time)); 
		   $s = array($beginTime,$endTime); 
	}else if($num == 'week'){
		//本周
		$time = '1' == date('w') ? strtotime('Monday', $now) : strtotime('last Monday', $now);  
	    $beginTime = strtotime(date('Y-m-d 00:00:00', $time));  
	    $endTime = strtotime(date('Y-m-d 23:59:59', strtotime('Sunday', $now)));
	    $s = array($beginTime,$endTime);  
	}else{
		//返回当天
		$year = date("Y");
		$month = date("m");
		$day = date("d");
		$dayBegin = mktime(0,0,0,$month,$day,$year);//当天开始时间戳
		$dayEnd = mktime(23,59,59,$month,$day,$year);//当天结束时间戳
		$s = array($dayBegin,$dayEnd);
	}
	return $s;
}
//获取某个时间段的时间戳
function getnewtime($t){
		$year = date("Y");
		$month = date("m");
		$day = date("d");
		$dayBegin = mktime(($t-1),0,0,$month,$day,$year);//当天开始时间戳
		$dayEnd = mktime(($t-1),59,59,$month,$day,$year);//当天结束时间戳
		$s = array($dayBegin,$dayEnd);
		return $s;
}
//返回分组名称
function getGroup($uid){
	if($uid){
		$groupid = D('Authgroupaccess')->getGroupid($uid);
		$data = D('Authgroup')->getById($groupid);
		if($data){
			$name = $data['title'];
		}else{
			$name = "你是外星人吧";
		}
	}else{
		return false;
	}
	return $name;
}
//发送短信
function sms($content,$phone,$type){
	if($content && $phone && $type){
		import("@.ORG.Http");
		$url = "http://wx.35258.com/user-api.html";
		$data['u'] = 'sxpfs';
		$data['p'] = md5('wo2wojia');
		$data['g'] = ($type == 1?10:12);
		$data['c'] = urlencode($content);
		$data['m'] = $phone;
		$http = new Http();
		$result = $http->DoPost($url,$data);
		$f['content'] = $type;
		$f['api'] = $result;
		$f['posttime'] = time();
		$f['phone'] = $phone;
		M('Smslog')->data($f)->add();
		//return trim(strval($result))=='发送成功' ? true : strval($result);
		if($result == "短信发送成功"){
			return true;
		}else{
			return false;
		}
	}else{
		return false;
	}
}
//序列好加密
function Hd($content,$type='1'){
	//1为加密，2为解密
	if($type == 2){
		$c = base64_decode($content);
		$nums =substr($c, 5);
	}else{
		$nums = base64_encode('sxpfs'.$content);
	}
	return $nums;
}
function array2json($arr)
{
	if (function_exists('json_encode')) return json_encode($arr);
	$keys = array_keys($arr);
	$isarr = true;
	$json = "";
	for($i=0;$i<count($keys);$i++)
	{
		if ($keys[$i] !== $i)
		{
			$isarr = false;
			break;
		}
	}
	$json = $space;
	$json.= ($isarr)?"[":"{";
	for($i=0;$i<count($keys);$i++)
	{
		if ($i!=0) $json.= ",";
		$item = $arr[$keys[$i]];
		$json.=($isarr)?"":$keys[$i].':';
		if (is_array($item))
			$json.=array2json($item);
		else if (is_string($item))
			$json.='"'.str_replace(array("\r","\n"),"",$item).'"';
		else $json.=$item;
	}
	$json.= ($isarr)?"]":"}";
	return $json;
}
//导出报名列表
function OutPutReg($list,$agency='皮防所'){
	if($list){
		ob_start();
		define("FILETYPE","xls");
		header("Content-type:application/vnd.ms-excel");
		if(FILETYPE=="xls")
		header("Content-Disposition:filename=".$agency.".xls");
		else
		header("Content-Disposition:filename=".$agency.".csv");
		echo GetGB2312String("姓\t名\t昵称\tQQ号\t家庭手机\t工作手机\t其他手机\t家庭电话\t工作电话\t其他电话\t家庭传真\t工作传真\t公司/部门\t家庭地址\t工作地址\t其他地址\t备注\t电子邮件\t家庭邮箱\t办公邮箱\t网址\t家庭网址\t办公网址\t生日\t职务\n");
		foreach($list as $k=>&$v){
			echo GetGb2312String("$v[name]\t\t\t\t$v[phone]\t\t\t\t\t\t\t\t\t$v[address]\t\t\t$v[zixun]\t\t\t\t\t\t\t\t\n");
		}
	}else{
		return false;
	}
}
//分页
function pagerank($pages,$nowpage,$total,$url,$parmar=''){
	if($nowpage > 1 && $nowpage < $pages){
		$page = '<input type="button" class="dtPageButton" onclick="window.location.href=\''.U($url,array('page'=>'1')).$parmar.'\'" style="cursor:pointer;" name="dtBtnIndex" value="首页">';
		$page .= '<input type="button" class="dtPageButton" onclick="window.location.href=\''.U($url,array('page'=>($nowpage-1))).$parmar.'\'" style="cursor:pointer;" name="dtBtnIndex" value="上一页">';
		$page .= '<input class="dtPageButton" type="button" onclick="window.location.href=\''.U($url,array('page'=>($nowpage+1))).$parmar.'\'" style="cursor:pointer;" value="下一页" name="dtBtnIndex">';
		$page .= '<input type="button" class="dtPageButton" onclick="window.location.href=\''.U($url,array('page'=>$pages)).$parmar.'\'" style="cursor:pointer;" name="dtBtnIndex" value="尾页">';
		$page .= '<input type="text" class="dtPageInput" name="jump" id="jump">';
		$page .= '<input type="button" class="dtPageButton" name="dtBtnIndex" value="跳转" style="cursor:pointer;" onclick="window.location.href=\'#\'">&nbsp;&nbsp;&nbsp;&nbsp;';
		$page .= '<span>共有'.$total.' 条纪录  共'.$pages.' 页  本页第 '.$nowpage.' 页</span>';
	}else if($nowpage == $pages){
		if($nowpage == $pages && $pages == 1){
			$page = '<input type="button" class="dtPageButton" name="dtBtnIndex" value="首页" disabled>';
			$page .= '<input type="button" class="dtPageButton" name="dtBtnIndex" value="上一页" disabled>';
			$page .= '<input type="button" class="dtPageButton" name="dtBtnIndex" value="下一页" disabled>';
			$page .= '<input type="button" class="dtPageButton" name="dtBtnIndex" value="尾页" disabled>';
			$page .= '<input type="text" class="dtPageInput" name="jump" id="jump">';
			$page .= '<input type="button" class="dtPageButton" name="dtBtnIndex" value="跳转" disabled>&nbsp;&nbsp;&nbsp;&nbsp;';
			$page .= '<span>共有'.$total.' 条纪录  共'.$pages.' 页  本页第 '.$nowpage.' 页</span>';
		}else{
			$page = '<input type="button" class="dtPageButton" onclick="window.location.href=\''.U($url,array('page'=>'1')).$parmar.'\'" style="cursor:pointer;" name="dtBtnIndex" value="首页">';
			$page .= '<input type="button" class="dtPageButton" onclick="window.location.href=\''.U($url,array('page'=>($nowpage-1))).$parmar.'\'" style="cursor:pointer;" name="dtBtnIndex" value="上一页">';
			$page .= '<input type="button" class="dtPageButton" name="dtBtnIndex" value="下一页" disabled>';
			$page .= '<input type="button" class="dtPageButton" name="dtBtnIndex" value="尾页" disabled>';
			$page .= '<input type="text" class="dtPageInput" name="jump" id="jump">';
			$page .= '<input type="button" class="dtPageButton" name="dtBtnIndex" value="跳转" style="cursor:pointer;" onclick="window.location.href=\'#\'">&nbsp;&nbsp;&nbsp;&nbsp;';
			$page .= '<span>共有'.$total.' 条纪录  共'.$pages.' 页  本页第 '.$nowpage.' 页</span>';
		}
	}else if($total == 0){
		$page = '<input type="button" class="dtPageButton" name="dtBtnIndex" value="首页" disabled>';
		$page .= '<input type="button" class="dtPageButton" name="dtBtnIndex" value="上一页" disabled>';
		$page .= '<input class="dtPageButton" type="button" value="下一页" name="dtBtnIndex" disabled>';
		$page .= '<input type="button" class="dtPageButton" name="dtBtnIndex" value="尾页" disabled>';
		$page .= '<input type="text" class="dtPageInput" name="jump" id="jump">';
		$page .= '<input type="button" class="dtPageButton" name="dtBtnIndex" value="跳转" disabled>&nbsp;&nbsp;&nbsp;&nbsp;';
		$page .= '<span>共有'.$total.' 条纪录  共'.$pages.' 页  本页第 '.$nowpage.' 页</span>';
	}else{
		$page = '<input type="button" class="dtPageButton" name="dtBtnIndex" value="首页" disabled>';
		$page .= '<input type="button" class="dtPageButton" name="dtBtnIndex" value="上一页" disabled>';
		$page .= '<input class="dtPageButton" type="button" onclick="window.location.href=\''.U($url,array('page'=>($nowpage+1))).$parmar.'\'" style="cursor:pointer;" value="下一页" name="dtBtnIndex">';
		$page .= '<input type="button" class="dtPageButton" onclick="window.location.href=\''.U($url,array('page'=>$pages)).$parmar.'\'" style="cursor:pointer;" name="dtBtnIndex" value="尾页">';
		$page .= '<input type="text" class="dtPageInput" name="jump" id="jump">';
		$page .= '<input type="button" class="dtPageButton" name="dtBtnIndex" value="跳转" style="cursor:pointer;" onclick="window.location.href=\'#\'">&nbsp;&nbsp;&nbsp;&nbsp;';
		$page .= '<span>共有'.$total.' 条纪录  共'.$pages.' 页  本页第 '.$nowpage.' 页</span>';
	}
	return $page;
}
//检查验证码
function check_verify($code, $id = 1){
    $verify = new \Think\Verify();
    return $verify->check($code, $id);
}
/**
 * 检测用户是否登录
 * @return integer 0-未登录，大于0-当前登录用户ID
 * @author 麦当苗儿 <zuojiazi@vip.qq.com>
 */
function is_login(){
    $user = session('auid');

    if (empty($user)) {
        return false;
    } else {
        return session('auid');
    }
}
/**
 * 检测当前用户是否为管理员
 * @return boolean true-管理员，false-非管理员
 * @author 麦当苗儿 <zuojiazi@vip.qq.com>
 */
function is_administrator(){
    if(intval(session('groupid')) === C('USER_ADMINISTRATOR')){
    	return true;
    }else{
    	return false;
    }
}
function action_log($action = null, $model = null, $record_id = null, $user_id = null){

    //参数检查
    if(empty($action) || empty($model) || empty($record_id)){
        return '参数不能为空';
    }
    if(empty($user_id)){
        $user_id = is_login();
    }

    //查询行为,判断是否执行
    $action_info = M('Action')->getByName($action);
    if($action_info['status'] != 1){
        return '该行为被禁用或删除';
    }

    //插入行为日志
    $data['action_id']      =   $action_info['id'];
    $data['user_id']        =   $user_id;
    $data['action_ip']      =   ip2long(get_client_ip());
    $data['model']          =   $model;
    $data['record_id']      =   $record_id;
    $data['create_time']    =   NOW_TIME;

    //解析日志规则,生成日志备注
    if(!empty($action_info['log'])){
        if(preg_match_all('/\[(\S+?)\]/', $action_info['log'], $match)){
            $log['user']    =   $user_id;
            $log['record']  =   $record_id;
            $log['model']   =   $model;
            $log['time']    =   NOW_TIME;
            $log['data']    =   array('user'=>$user_id,'model'=>$model,'record'=>$record_id,'time'=>NOW_TIME);
            foreach ($match[1] as $value){
                $param = explode('|', $value);
                if(isset($param[1])){
                    $replace[] = call_user_func($param[1],$log[$param[0]]);
                }else{
                    $replace[] = $log[$param[0]];
                }
            }
            $data['remark'] =   str_replace($match[0], $replace, $action_info['log']);
        }else{
            $data['remark'] =   $action_info['log'];
        }
    }else{
        //未定义日志规则，记录操作url
        $data['remark']     =   '操作url：'.$_SERVER['REQUEST_URI'];
    }

    M('ActionLog')->add($data);

    if(!empty($action_info['rule'])){
        //解析行为
        $rules = parse_action($action, $user_id);

        //执行行为
        $res = execute_action($rules, $action_info['id'], $user_id);
    }
}

/**
 * 解析行为规则
 * 规则定义  table:$table|field:$field|condition:$condition|rule:$rule[|cycle:$cycle|max:$max][;......]
 * 规则字段解释：table->要操作的数据表，不需要加表前缀；
 *              field->要操作的字段；
 *              condition->操作的条件，目前支持字符串，默认变量{$self}为执行行为的用户
 *              rule->对字段进行的具体操作，目前支持四则混合运算，如：1+score*2/2-3
 *              cycle->执行周期，单位（小时），表示$cycle小时内最多执行$max次
 *              max->单个周期内的最大执行次数（$cycle和$max必须同时定义，否则无效）
 * 单个行为后可加 ； 连接其他规则
 * @param string $action 行为id或者name
 * @param int $self 替换规则里的变量为执行用户的id
 * @return boolean|array: false解析出错 ， 成功返回规则数组
 * @author huajie <banhuajie@163.com>
 */
function parse_action($action = null, $self){
    if(empty($action)){
        return false;
    }

    //参数支持id或者name
    if(is_numeric($action)){
        $map = array('id'=>$action);
    }else{
        $map = array('name'=>$action);
    }

    //查询行为信息
    $info = M('Action')->where($map)->find();
    if(!$info || $info['status'] != 1){
        return false;
    }

    //解析规则:table:$table|field:$field|condition:$condition|rule:$rule[|cycle:$cycle|max:$max][;......]
    $rules = $info['rule'];
    $rules = str_replace('{$self}', $self, $rules);
    $rules = explode(';', $rules);
    $return = array();
    foreach ($rules as $key=>&$rule){
        $rule = explode('|', $rule);
        foreach ($rule as $k=>$fields){
            $field = empty($fields) ? array() : explode(':', $fields);
            if(!empty($field)){
                $return[$key][$field[0]] = $field[1];
            }
        }
        //cycle(检查周期)和max(周期内最大执行次数)必须同时存在，否则去掉这两个条件
        if(!array_key_exists('cycle', $return[$key]) || !array_key_exists('max', $return[$key])){
            unset($return[$key]['cycle'],$return[$key]['max']);
        }
    }

    return $return;
}
/**
* 对查询结果集进行排序
* @access public
* @param array $list 查询结果
* @param string $field 排序的字段名
* @param array $sortby 排序类型
* asc正向排序 desc逆向排序 nat自然排序
* @return array
*/
function list_sort_by($list,$field, $sortby='asc') {
   if(is_array($list)){
       $refer = $resultSet = array();
       foreach ($list as $i => $data)
           $refer[$i] = &$data[$field];
       switch ($sortby) {
           case 'asc': // 正向排序
                asort($refer);
                break;
           case 'desc':// 逆向排序
                arsort($refer);
                break;
           case 'nat': // 自然排序
                natcasesort($refer);
                break;
       }
       foreach ( $refer as $key=> $val)
           $resultSet[] = &$list[$key];
       return $resultSet;
   }
   return false;
}
//根据id信息获取地区名称
function getAreaName($id){
	$address = D('address')->getById($id);
	if(empty($address)){
		$result = '未知';
	}else{
		$result = $address['name'];
	}
	return $result;
}
function array_sort($arr,$keys,$type='asc'){
	$keysvalue = $new_array = array();
	foreach ($arr as $k=>$v){
		$keysvalue[$k] = $v[$keys];
	}
	if($type == 'asc'){
		asort($keysvalue);
	}else{
		arsort($keysvalue);
	}
		reset($keysvalue);
	foreach ($keysvalue as $k=>$v){
		$new_array[$k] = $arr[$k];
	}
	return $new_array;
} 
function exportExcel($expTitle,$expCellName,$expTableData){
        $xlsTitle = iconv('utf-8', 'gb2312', $expTitle);//文件名称
        $fileName = $_SESSION['loginAccount'].date('_YmdHis');//or $xlsTitle 文件名称可根据自己情况设定
        $cellNum = count($expCellName);
        $dataNum = count($expTableData);
        vendor("PHPExcel.PHPExcel");
        $objPHPExcel = new \PHPExcel();
        $cellName = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AA','AB','AC','AD','AE','AF','AG','AH','AI','AJ','AK','AL','AM','AN','AO','AP','AQ','AR','AS','AT','AU','AV','AW','AX','AY','AZ');
        
        $objPHPExcel->getActiveSheet(0)->mergeCells('A1:'.$cellName[$cellNum-1].'1');//合并单元格
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', $expTitle.'  Export time:'.date('Y-m-d H:i:s'));  
        for($i=0;$i<$cellNum;$i++){
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellName[$i].'2', $expCellName[$i][1]); 
        } 
          // Miscellaneous glyphs, UTF-8   
        for($i=0;$i<$dataNum;$i++){
          for($j=0;$j<$cellNum;$j++){
            $objPHPExcel->getActiveSheet(0)->setCellValue($cellName[$j].($i+3), $expTableData[$i][$expCellName[$j][0]]);
          }             
        }  
        
        header('pragma:public');
        header('Content-type:application/vnd.ms-excel;charset=utf-8;name="'.$xlsTitle.'.xls"');
        header("Content-Disposition:attachment;filename=$fileName.xls");//attachment新窗口打印inline本窗口打印
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');  
        $objWriter->save('php://output'); 
        exit;   
}
function getBrowse(){
    if(!empty($_SERVER['HTTP_USER_AGENT'])){  
    $br = $_SERVER['HTTP_USER_AGENT'];  
    if (preg_match('/MSIE/i',$br)) {      
               $br = 'MSIE';  
             }elseif (preg_match('/Firefox/i',$br)) {  
     $br = 'Firefox';  
    }elseif (preg_match('/Chrome/i',$br)) {  
     $br = 'Chrome';  
       }elseif (preg_match('/Safari/i',$br)) {  
     $br = 'Safari';  
    }elseif (preg_match('/Opera/i',$br)) {  
        $br = 'Opera';  
    }else {  
        $br = 'Other';  
    }  
    return $br;  
   }else{
   	return "获取浏览器信息失败！";
   }  
}
 function GetOs(){  
     $user_OSagent = $_SERVER['HTTP_USER_AGENT']; 
	        if(strpos($user_OSagent,"NT 6.1")){ 
	            $visitor_os ="Windows 7";  
	        } elseif(strpos($user_OSagent,"NT 5.1")) {  
	           $visitor_os ="Windows XP (SP2)";  
	        } elseif(strpos($user_OSagent,"NT 5.2") && strpos($user_OSagent,"WOW64")){  
	           $visitor_os ="Windows XP 64-bit Edition";  
	       } elseif(strpos($user_OSagent,"NT 5.2")) { 
	            $visitor_os ="Windows 2003";  
	       } elseif(strpos($user_OSagent,"NT 6.0")) { 
	            $visitor_os ="Windows Vista";  
	        } elseif(strpos($user_OSagent,"NT 5.0")) { 
	          $visitor_os ="Windows 2000";  
	        } elseif(strpos($user_OSagent,"4.9")) { 
	           $visitor_os ="Windows ME"; 
	        } elseif(strpos($user_OSagent,"NT 4")) { 
	           $visitor_os ="Windows NT 4.0"; 
	        } elseif(strpos($user_OSagent,"98")) { 
	          $visitor_os ="Windows 98"; 
	       } elseif(strpos($user_OSagent,"95")) { 
	            $visitor_os ="Windows 95"; 
	        }elseif(strpos($user_OSagent,"NT")) { 
	            $visitor_os ="Windows 较高版本"; 
	        }elseif(strpos($user_OSagent,"Mac")) { 
	            $visitor_os ="Mac"; 
	        } elseif(strpos($user_OSagent,"Linux")) {  
	            $visitor_os ="Linux"; 
	        } elseif(strpos($user_OSagent,"Unix")) { 
	            $visitor_os ="Unix"; 
	        } elseif(strpos($user_OSagent,"FreeBSD")) { 
	            $visitor_os ="FreeBSD"; 
	        } elseif(strpos($user_OSagent,"SunOS")) { 
	            $visitor_os ="SunOS";  
	        } elseif(strpos($user_OSagent,"BeOS")) { 
	            $visitor_os ="BeOS";  
	        } elseif(strpos($user_OSagent,"OS/2")) { 
	            $visitor_os ="OS/2"; 
	        } elseif(strpos($user_OSagent,"PC")) { 
	            $visitor_os ="Macintosh"; 
	        } elseif(strpos($user_OSagent,"AIX")) { 
	            $visitor_os ="AIX"; 
	        } elseif(strpos($user_OSagent,"IBM OS/2")) { 
	            $visitor_os ="IBM OS/2"; 
	        } elseif(strpos($user_OSagent,"BSD")) { 
	            $visitor_os ="BSD"; 
	       } elseif(strpos($user_OSagent,"NetBSD")) { 
	            $visitor_os ="NetBSD"; 
	        } else { 
	           $visitor_os ="其它操作系统"; 
	        } 
	        return $visitor_os;  
  }
 //创建文件夹 的函数
function makeDir($path) {
        if (empty ( $path )) {
            echo "路径不能为空";
        }
        $dirs = array ();
        $path = preg_replace ( '/(\/){2,}|{\\\}{1,}/', '/', $path );
        $dirs = explode ( "/", $path );
        $path = "";
        foreach ( $dirs as $folder ) {
            $path .= $folder . "/";
            if (! is_dir ( $path )) {
                mkdir ( $path, 0700 );
            }
        }
        if (is_dir ( $path )) {
            return TRUE;
        } else {
            return FALSE;
        }
	}
//获取用户信息
	function Userinfo($uid,$type){
		$info = D('User')->getById($uid,$type);
		if($type == ''){
			return $info;
		}else{
			if($info == NULL){
				return '未知用户';
			}else{
				return $info;
			}
		}
	
	}
	//根据id获取分类
	function sortinfo($id,$type){
		$data = D('sort')->getSortById($id);
		if($type){
			if($id == 0){
				return '根分类';
			}else{
				return $data[$type];
			}
			
		}else{
			return $data;
		}
	}
	//根据用户id返回分组名称
	function userType($uid){
		$groupid = D('Authgroupaccess')->getGroupid($uid);
		$title = D('Authgroup')->getById($groupid);
		return $title['title'];
	}