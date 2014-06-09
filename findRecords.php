<?php
session_start();
if(!($_SESSION['manageID'])){
echo "<script>alert('请先登录！');window.location.href='http://localhost/managesystem/login.html';</script>";
}


include("conn.php");
$byManage=$_POST['byManage'];
$beginTime=$_POST['beginTime'];
$endTime=$_POST['endTime'];
$sql='select * from record where manageID=manageID';
if($byManage=='' && $beginTime=='' && $endTime=='')
 echo '{success:true,msg:\'null\'}';
else{
	if($byManage)
	 $sql='select * from record where manageID='.$byManage;
	if($beginTime)
	  $sql.=" && date>='$beginTime'";
	if($endTime)
	  $sql.=" && date<='$endTime'";
	 // echo $sql;
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
}

?>
