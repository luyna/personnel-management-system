<?php
session_start();
if(!($_SESSION['manageID'])){
echo "<script>alert('请先登录！');window.location.href='http://localhost/managesystem/login.html';</script>";
}
include("conn.php");
$sql="delete from userinfo";
$result=@mysql_query($sql,$conn);
if($result)
  echo '{success:true,msg:\'删除成功\'}';
 else echo '{success:true,msg:\'删除失败\'}';
?>
