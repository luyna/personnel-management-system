<?php
session_start();
if(!($_SESSION['manageID'])){
echo "<script>alert('请先登录！');window.location.href='http://localhost/managesystem/login.html';</script>";
}

if(isset($_SESSION['manageID'])){
    unset($_SESSION['manageID']);
}
if(session_destroy()){
  echo '{success:true,msg:\'ok\'}';
 }else echo '{success:false,msg:\'注销失败\'}';

?>