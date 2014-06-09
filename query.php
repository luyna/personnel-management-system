<?php
session_start();
if(!($_SESSION['manageID'])){
echo "<script>alert('请先登录！');window.location.href='http://localhost/managesystem/login.html';</script>";
}
include("conn.php");
$start=$_POST['start'];
$limit=$_POST['limit'];
$node=$_POST['leaf'];
$input=$_POST['value'];

//if($node=='all'){
  // $sql="select * from userinfo limit ".$start.",".$limit;
   //$count=@mysql_num_rows(mysql_query("select * from userinfo "));
 //}
 //else 
  $sql="select userID,username,sex,birth,id,marriage,nation,zzmm,tel,addr,deptname,job,state,edu,spec,
     fore,school,graduateTime,beginTime,endTime,mark from userinfo,deptmsg where userinfo.deptnum=deptmsg.deptnum ";
 if($node=='userID'){
   $sql.="&& userID='$input' limit ".$start.",".$limit;
   $result=mysql_query($sql,$conn);
   $count=@mysql_num_rows($result);
 }
 else if($node=='username'){
    $sql.="&& username='$input' limit ".$start.",".$limit;
   $result=mysql_query($sql,$conn);
   $count=@mysql_num_rows($result);
 }
 else if($node=='sex'){
    $sql.="&& sex='$input' limit ".$start.",".$limit;
    $result=mysql_query($sql,$conn);
   $count=@mysql_num_rows($result);
 }
 else if($node=='edu'){
   $sql.="&& edu= '$input' limit ".$start.",".$limit;
  $result=mysql_query($sql,$conn);
   $count=@mysql_num_rows($result);
 }
 else if($node=='dept'){
   $sql.=" && deptname='$input' limit ".$start.",".$limit;
   $result=mysql_query($sql,$conn);
   $count=@mysql_num_rows($result);
 }
  else if($node=='state'){
   $sql.=" && state='$input' limit ".$start.",".$limit;
   $result=mysql_query($sql,$conn);
   $count=@mysql_num_rows($result);
 }
 else if($node=='marriage'){
   $sql.="&& marriage='$input' limit ".$start.",".$limit;
   $result=mysql_query($sql,$conn);
   $count=@mysql_num_rows($result);
 }
 else if($node=='id'){
  $sql.="&& id ='$input' limit ".$start.",".$limit;
  $result=mysql_query($sql,$conn);
  $count=@mysql_num_rows($result);
 }



//echo $sql;
 if($count==0)
    $temp=array();
  else{
     //mysql_fetch_array必须写在这里，不能放在循环外的变量里
     while($row= mysql_fetch_assoc($result)){
	 $temp[]=$row;}
  }

 echo "{totalProperty:".$count.",root:".json_encode($temp)."}";
?>
