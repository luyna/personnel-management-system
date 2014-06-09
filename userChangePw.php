<?php
session_start();
if(!($_SESSION['manageID'])){
echo "<script>alert('请先登录！');window.location.href='http://localhost/managesystem/login.html';</script>";
}
include('conn.php');
$orign=$_POST['orign'];
$change=$_POST['change'];
$confirm=$_POST['confirm'];
$id=$_SESSION['manageID']; 

$select="select password from employee where userID=".$id;
$result=@mysql_result(@mysql_query($select,$conn),0);
if($result!=$orign)
   echo '{success:true,msg:\'wrong\'}';
else if($change!=$confirm){
   echo '{success:true,msg:\'different\'}';
 }
 else{
	  $sql="update employee set password='$change' where userID=$id";
	  $result =@mysql_query($sql,$conn);
	  if($result)
		  echo '{success:true,msg:\'密码更新成功\'}';
	   else echo '{success:true,msg:\'密码更改失败\'}';
  }
?>
