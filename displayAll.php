<?php
session_start();
if(!($_SESSION['manageID'])){
echo "<script>alert('请先登录！');window.location.href='http://localhost/managesystem/login.html';</script>";
}
include("conn.php");
//$state=$_POST['state'];
$start=$_POST['start'];
$limit=$_POST['limit'];



   $sql="select userID,username,sex,birth,id,marriage,nation,zzmm,tel,addr,deptname,job,
   state,edu,spec,fore,school,graduateTime,beginTime,endTime,mark from userinfo,deptMsg where userinfo.deptnum=deptmsg.deptnum   limit ".$start.",".$limit;
   $count=@mysql_num_rows(mysql_query("select * from userinfo "));
    $result= mysql_query($sql,$conn);
 if($count==0)
    $temp=array();
  else{
     //mysql_fetch_array必须写在这里，不能放在循环外的变量里
     while($row= mysql_fetch_assoc($result)){
	 $temp[]=$row;}
  }
  echo "{totalProperty:".$count.",root:".json_encode($temp)."}";
/*if($result)
 echo "{success:true,msg:\'ok\',totalProperty:".$count.",root:".json_encode($temp)."}";
 else echo "{success:true,msg:\'wrong\'}";*/
?>
