<?php
/**
*@ Date         2010.04.07
*@ Author       ����֮�� PHP100.com
*@ Blog         http://hi.baidu.com/woaidelphi/blog
*/
$user_online = "count.php"; //�����������ļ�
touch($user_online);//���û�д��ļ����򴴽�
$timeout = 30;//30����û������,��Ϊ����
$user_arr = file_get_contents($user_online);
$user_arr = explode('#',rtrim($user_arr,'#'));print_r($user_arr);
$temp = array();
foreach($user_arr as $value){
$user = explode(",",trim($value));
if (($user[0] != getenv('REMOTE_ADDR')) && ($user[1] > time())) {//������Ǳ��û�IP��ʱ��û�г�ʱ����뵽������
array_push($temp,$user[0].",".$user[1]);
}
}
array_push($temp,getenv('REMOTE_ADDR').",".(time() + ($timeout)).'#'); //���汾�û�����Ϣ
$user_arr = implode("#",$temp);
//д���ļ�
$fp = fopen($user_online,"w");
flock($fp,LOCK_EX); //flock() ������NFS�Լ�������һЩ�����ļ�ϵͳ����������
fputs($fp,$user_arr);
flock($fp,LOCK_UN);
fclose($fp);
echo "��ǰ��".count($temp)."������";
?>