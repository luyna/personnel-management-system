<?php
session_start();
if(!($_SESSION['manageID'])){
echo "<script>alert('请先登录！');window.location.href='http://localhost/managesystem/login.html';</script>";
}


include("conn.php");

$sql='select * from backup.backup ';

$result=@mysql_query($sql,$conn);
$count=@mysql_num_rows($result);
if($count==0)
$temp=array();
else{
 //mysql_fetch_array必须写在这里，不能放在循环外的变量里
 while($row= mysql_fetch_assoc($result)){
 $temp[]=$row;}
}

echo "{success:true,msg:'ok',totalProperty:".$count.",root:".json_encode($temp)."}";


?>

