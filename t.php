<?php
/**
*@ Date         2010.04.07
*@ Author       华夏之星 PHP100.com
*@ Blog         http://hi.baidu.com/woaidelphi/blog
*/
$user_online = "count.php"; //保存人数的文件
touch($user_online);//如果没有此文件，则创建
$timeout = 30;//30秒内没动作者,认为掉线
$user_arr = file_get_contents($user_online);
$user_arr = explode('#',rtrim($user_arr,'#'));print_r($user_arr);
$temp = array();
foreach($user_arr as $value){
$user = explode(",",trim($value));
if (($user[0] != getenv('REMOTE_ADDR')) && ($user[1] > time())) {//如果不是本用户IP并时间没有超时则放入到数组中
array_push($temp,$user[0].",".$user[1]);
}
}
array_push($temp,getenv('REMOTE_ADDR').",".(time() + ($timeout)).'#'); //保存本用户的信息
$user_arr = implode("#",$temp);
//写入文件
$fp = fopen($user_online,"w");
flock($fp,LOCK_EX); //flock() 不能在NFS以及其他的一些网络文件系统中正常工作
fputs($fp,$user_arr);
flock($fp,LOCK_UN);
fclose($fp);
echo "当前有".count($temp)."人在线";
?>