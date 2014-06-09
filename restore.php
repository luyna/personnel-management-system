<?php
session_start();
if(!($_SESSION['manageID'])){
echo "<script>alert('请先登录！');window.location.href='http://localhost/managesystem/login.html';</script>";
}

include("conn.php");


$name=$_POST['name'];

system("D:\php\MySQL-5.0.90\bin\mysql -h localhost -u root -pm123 system <D:\php\htdocs\managesystem\backup\$name",$suc);  
//注意文件名前有两个\\ ,不然会出错 //echo $suc;
if($suc==1){echo "{success:true,msg:'false'}";}
else if($suc==0) echo "{success:true,msg:'ok'}";



?>