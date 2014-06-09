<?php
session_start();
if(!($_SESSION['manageID'])){
echo "<script>alert('请先登录！');window.location.href='http://localhost/managesystem/login.html';</script>";
}

include('conn.php');
$userID=$_POST['userID'];
$date=date("Y-m-d");
$state=$_POST['state'];



$number=@mysql_num_rows(mysql_query("SELECT * FROM `userinfo` WHERE userID='$userID'"));
//echo $number;

 if($number==0) echo "{success:true,msg:'null'}";
else {
	$sql="insert into changestate (userID,date,state) values('$userID','$date','$state')";
	//echo $sql;
	$sql1="update userinfo set state='$state' where userID='$userID'";
	//echo $sql1;
	$result=mysql_query($sql,$conn);
	$result1=mysql_query($sql1,$conn);
	if($result && $result1){
	 echo "{success:true,msg:'ok'}";
	}else echo "{success:true,msg:'wrong'}";
}

?>
