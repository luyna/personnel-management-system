<?php
session_start();
if(!($_SESSION['manageID'])){
echo "<script>alert('请先登录！');window.location.href='http://localhost/managesystem/login.html';</script>";
}

include('conn.php');
$userID=$_POST['userID'];
$month=$_POST['month'];
$basewage=$_POST['basewage'];
$allowance=$_POST['allowance'];
$prize=$_POST['prize'];
$extrawork=$_POST['extrawork'];

$number=@mysql_num_rows(mysql_query("select * from userinfo  where userID=".$userID));
//echo $number;
if($number==1){
	$sql="insert into wage (userID,month,basewage,allowance,prize,extrawork) values('$userID','$month','$basewage','$allowance','$prize','$extrawork')";
	//echo $sql;
	$result=mysql_query($sql,$conn);
	if($result){
	 echo "{success:true,msg:'ok'}";
	}else echo "{success:true,msg:'wrong'}";
}
else echo "{success:true,msg:'null'}";
?>
