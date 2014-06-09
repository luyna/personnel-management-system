<?php
session_start();
if(!($_SESSION['manageID'])){
echo "<script>alert('请先登录！');window.location.href='http://localhost/managesystem/login.html';</script>";
}

include('conn.php');

$array=$_POST['data'];
//[{\'a\':2321,\'b\':\'gsd\',\'c\':\'dww\'}...] 将后台获得的该形式数据转化成json
if(get_magic_quotes_gpc()==1){
   $array = stripslashes($array);
}
 $arr= json_decode($array);
 $is_suc=true;
foreach($arr as $k=>$val){
    $sql="delete from wage where userID=".$val->userID." && month='$val->month'";  //$value是对象，不能用$value['userID']
    $result=@mysql_query($sql,$conn);
    if(!$result)
	   $is_suc=false;
}
 
foreach($arr as $key=>$value){
	$sql2="insert into wage (userID,month,basewage,prize,allowance,extrawork) values ( '$value->userID','$value->month','$value->basewage','$value->prize','$value->allowance','$value->extrawork');";  
	   
    $result1=@mysql_query($sql2,$conn);
    if(!$result1)
	   $is_suc=false;
}
//print_r($arr);
if($is_suc)
  echo '{success:true,msg:\'ok\'}';
 else echo '{success:true,msg:\'保存失败\'}';


?>