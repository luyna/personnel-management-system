<?php
session_start();
if(!($_SESSION['manageID'])){
echo "<script>alert('请先登录！');window.location.href='http://localhost/managesystem/login.html';</script>";
}

include('conn.php');
$userID=$_POST['userID'];
$date=$_POST['date'];
$content=$_POST['content'];
$result=$_POST['result'];
$number=@mysql_num_rows(mysql_query("select * from userinfo  where userID=".$userID));
//echo $number;
if($number==1){
	$sql="insert into train (userID,date,content,result) values('$userID','$date','$content','$result')";
	//echo $sql;
	$result=mysql_query($sql,$conn);
	if($result){
	 echo "{success:true,msg:'ok'}";
	}else echo "{success:true,msg:'wrong'}";
}
else echo "{success:true,msg:'null'}";
?>