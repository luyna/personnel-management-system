<?php
session_start();
if(!($_SESSION['manageID'])){
echo "<script>alert('请先登录！');window.location.href='http://localhost/managesystem/login.html';</script>";
}

include("conn.php");
$text=$_POST['editor'];
$date= date('Y-m-d');
$manageID=$_SESSION['manageID'];
if($text!=''){
	$sql="insert  into record values ('$manageID','$date','$text')"; 
	$result=@mysql_query($sql,$conn);
	if($result){
	 echo '{success:true,msg:\'ok\'}';
	}else echo '{success:true,msg:\'wrong\'}';
} else echo '{success:true,msg:\'null\'}';
?>

