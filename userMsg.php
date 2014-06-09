
<?php
session_start();
if(!($_SESSION['manageID'])){
 echo " <script >alert('您还未登陆，请先登陆！');window.location.href='http://localhost/managesystem/login.html';</script>";}
 
 
 include('conn.php');
 $sql='select * from userinfo where userID='.$_SESSION['manageID'];
 $result= @mysql_query($sql,$conn);
 $row= @mysql_fetch_assoc($result);
echo "{success:true,msg:'ok',root:".json_encode($row)."}";
 ?>

