<?php
session_start();
if(!($_SESSION['manageID'])){
echo "<script>alert('请先登录！');window.location.href='http://localhost/managesystem/login.html';</script>";
}
include("conn.php");
$start=$_POST['start'];
$limit=$_POST['limit'];
$input=$_POST['value'];


	if($input!=''){
	  $sql = "select userID,movetime,deptname,jobname,reason from moverecords,deptmsg where  userID=".$input." 
		 && deptmsg.deptnum=moverecords.deptnum limit ".$start.",".$limit;
	}else  $sql = "select userID,movetime,deptname,jobname,reason from moverecords,deptmsg where  
		  deptmsg.deptnum=moverecords.deptnum limit ".$start.",".$limit;
	//echo $sql;
	$result=mysql_query($sql,$conn);
	if($result){
	 $count=@mysql_num_rows($result);
	 if($count==0)
		$temp=array();
	  else{
		 while($row= mysql_fetch_assoc($result)){
		 $temp[]=$row;}
	  }
	
	 echo "{totalProperty:".$count.",root:".json_encode($temp)."}";
	 }

?>