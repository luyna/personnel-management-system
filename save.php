<?php
session_start();
if(!($_SESSION['manageID'])){
echo "<script>alert('请先登录！');window.location.href='http://localhost/managesystem/login.html';</script>";
}

include('conn.php');
//$json=$GLOBALS['HTTP_RAW_POST_DATA'] ;//php接收json数据保存在$GLOBALS['HTTP_RAW_POST_DATA']中
$array=$_POST['data'];
//[{\'a\':2321,\'b\':\'gsd\',\'c\':\'dww\'}...] 将后台获得的该形式数据转化成json
if(get_magic_quotes_gpc()==1){
   $array = stripslashes($array);
}
 $arr= json_decode($array);
 $is_suc=true;
 
 /*
foreach($arr as $k=>$val){
    $sql="delete from userinfo where userID='$val->userID'";  //$value是对象，不能用$value['userID']
	echo $sql;
    $result=@mysql_query($sql,$conn);
    if(!$result)
	   $is_suc=false;
}
 */
 
 

foreach($arr as $key=>$value){
 
	
    $temp = "SELECT deptnum FROM `deptmsg` WHERE deptname='$value->deptname'";
    $deptnum=@mysql_result(@mysql_query($temp,$conn),0);
	$sql="update userinfo set username='$value->username',sex='$value->sex',birth='$value->birth',id='$value->id',marriage='$value->marriage',nation='$value->nation',zzmm='$value->zzmm',tel='$value->tel',addr='$value->addr',deptnum='$deptnum',job='$value->job',state='$value->state',fore='$value->fore',edu='$value->edu',spec='$value->spec',graduateTime='$value->graduateTime',school='$value->school',beginTime='$value->beginTime',endTime='$value->endTime',mark='$value->mark' where userID='$value->userID'";
	 // echo $sql; 
    $result1=@mysql_query($sql,$conn);
    if(!$result1)
	   $is_suc=false;
}
//print_r($arr);
if($is_suc)
  echo '{success:true,msg:\'ok\'}';
 else echo '{success:true,msg:\'保存失败\'}';


?>