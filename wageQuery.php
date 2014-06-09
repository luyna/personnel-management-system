<?php
session_start();
if(!($_SESSION['manageID'])){
echo "<script>alert('请先登录！');window.location.href='http://localhost/managesystem/login.html';</script>";
}
include("conn.php");
//$start=$_POST['start'];
//$limit=$_POST['limit'];
$userID=$_POST['userID'];
$month=$_POST['month'];

$number=@mysql_num_rows(mysql_query("select * from userinfo  "));
$sql="select userID,month,basewage,allowance,prize,extrawork,allowance+prize+basewage+extrawork as total from wage where userID=userID && month=month";
//echo $sql;
	if($userID!=''){
	  $sql .= "&& userID=".$userID;
	  $number=@mysql_num_rows(mysql_query("select * from userinfo  where userID=".$userID));
	}
	if($month!=''){
	  $sql .= "&& month='$month'";
	} 

	//echo $sql;
if($number!=0){
		$result=mysql_query($sql,$conn);
	  if($result){
		 $count=@mysql_num_rows($result);
		 if($count==0)
			$temp=array();
		  else{
			 while($row= mysql_fetch_assoc($result)){
			 $temp[]=$row;}
		  }
		
		 echo "{success:true,msg:'ok',totalProperty:".$count.",root:".json_encode($temp)."}";
	}else echo "{success:true,msg:'wrong'}";
}else echo "{success:true,msg:'null'}";
?>