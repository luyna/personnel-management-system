
<?php
session_start();
if(!($_SESSION['manageID'])){
 echo " <script >alert('您还未登陆，请先登陆！');window.location.href='http://localhost/managesystem/login.html';</script>";}
 
 
 include('conn.php');
 $sql0='select dept from userinfo where userID='.$_SESSION['manageID'];
 $result0=@mysql_query($sql0,$conn);
 $dept=@mysql_result($result0,$count,"dept");

 $sql="select userID,username from userinfo where dept='$dept'";

 $result= @mysql_query($sql,$conn);
  $count=@mysql_num_rows($result);
	 if($count==0)
		$temp=array();
	  else{
		 while($row= mysql_fetch_assoc($result)){
		 $temp[]=$row;}
	  }
	
	 echo "{success:true,msg:'ok',totalProperty:".$count.",root:".json_encode($temp)."}";

 ?>

