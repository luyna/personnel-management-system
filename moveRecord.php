<?php
session_start();
if(!($_SESSION['manageID'])){
echo "<script>alert('请先登录！');window.location.href='http://localhost/managesystem/login.html';</script>";
}

include('conn.php');
$userID=$_POST['userID'];
$time=$_POST['time'];
$dept=$_POST['dept'];
$job=$_POST['job'];
$reason=$_POST['reason'];
$temp = "SELECT deptnum FROM `deptmsg` WHERE deptname='$dept'";
$deptnum=@mysql_result(@mysql_query($temp,$conn),0);
$number=@mysql_num_rows(mysql_query("select * from userinfo  where userID=".$userID));
//echo $number;
if($number==1){
	$sql="insert into moverecords(userID,moveTime,deptnum,jobname,reason) values('$userID','$time','$deptnum','$job','$reason')";
	//echo $sql;
	$result=mysql_query($sql,$conn);
	if($result){
	 echo "{success:true,msg:'ok'}";
	}else echo "{success:true,msg:'wrong'}";
}
else echo "{success:true,msg:'null'}";
?>