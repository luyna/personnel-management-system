<?php
session_start();
if(!($_SESSION['manageID'])){
echo "<script>alert('请先登录！');window.location.href='http://localhost/managesystem/login.html';</script>";
}

 
header("Content-Type","application/force-download");
header("Content-Type","application/vnd.ms-excel");
header("Content-Disposition","attachment;filename=export.xls");
echo ''.$_POST["exportContent"];

?>