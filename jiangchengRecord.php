<?php
session_start();
if(!($_SESSION['manageID'])){
echo "<script>alert('请先登录！');window.location.href='http://localhost/managesystem/login.html';</script>";
}

include('conn.php');
$userID=$_POST['userID'];
$date=$_POST['date'];
$score=$_POST['score'];
$type=$_POST['type'];
$reason=$_POST['reason'];

$number=@mysql_num_rows(mysql_query("select * from userinfo  where userID=".$userID));
//echo $number;
if($number==1){
	$sql="insert into jiangcheng(userID,date,type,score,reason) values('$userID','$date','$type','$score','$reason')";
	//echo $sql;
	$result=mysql_query($sql,$conn);
	if($result){
	 echo "{success:true,msg:'ok'}";
	}else echo "{success:true,msg:'wrong'}";
}
else echo "{success:true,msg:'null'}";
?>