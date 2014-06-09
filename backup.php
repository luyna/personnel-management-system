<?php
session_start();
if(!($_SESSION['manageID'])){
echo "<script>alert('请先登录！');window.location.href='http://localhost/managesystem/login.html';</script>";
}

include("conn.php");


$name=$_POST['name'];
$date=date('Y-m-d');
$sql1="select * from backup.backup where name='$date.$name.sql'";
$count=@mysql_num_rows(mysql_query($sql1,$conn));
//echo $count;
if($count!=0){
echo "{success:true,msg:'exist'}";
}else {
   system("D:\php\MySQL-5.0.90\bin\mysqldump -h localhost -u root -pm123 system  >D:\php\htdocs\managesystem\backup\\$date.$name.sql",$suc);  //注意文件名前有两个\\  //echo $suc;
   if($suc==1){echo "{success:true,msg:'false'}";}
   else{
	   $sql2="insert into backup.backup (date,name) values('$date','$date.$name.sql')";
	   $result=@mysql_query($sql2,$conn);
	   if($result){
		 echo "{success:true,msg:'ok'}";
	   }
	   else echo "{success:true,msg:'wrong'}";
  }
}


?>