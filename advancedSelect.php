<?php
session_start();
if(!($_SESSION['manageID'])){
echo "<script>alert('请先登录！');window.location.href='http://localhost/managesystem/login.html';</script>";
}
include("conn.php");
$username=$_POST['username'];
$marriage=$_POST['marriage'];
$sex=$_POST['sex'];
$dept=$_POST['dept'];
$edu=$_POST['edu'];
$age0=$_POST['age0'];
$age1=$_POST['age1'];
$state=$_POST['state'];
//$basewage1=$_POST['basewage1'];
$beginTime0=$_POST['beginTime0'];
$beginTime1=$_POST['beginTime1'];
$graduateTime0=$_POST['graduateTime0'];
$graduateTime1=$_POST['graduateTime1'];
$now=date("Y-m-d");
if($username=='' && $marriage=='' && $sex=='' && $dept=='' && $edu=='' && $age0=='' && $age1=='' 
 && $state=='' && $beginTime0=='' && $beginTime1=='' && $graduateTime0=='' && $graduateTime1=='')
  echo '{success:true,msg:\'null\'}';
else{
	$sql="select userID,username,sex,birth,id,marriage,nation,zzmm,tel,addr,deptname,job,
   state,edu,spec,fore,school,graduateTime,beginTime,endTime,mark from userinfo,deptmsg where userinfo.deptnum=deptmsg.deptnum  ";
	if($username!=null){
	  $sql.=" && username='$username' ";
	}
	if($marriage!=null)
	{$sql.="&& marriage='$marriage' ";}
	if($sex!=null)
	{$sql.="&& sex='$sex' ";}
	if($dept!=null){
	$sql.="&& deptname='$dept' ";
	}
	if($state!=null){
	$sql.="&& state='$state' ";
	}
	if($edu!=null){
	 $sql.="&& edu='$edu' ";
	}
	if($age0!=null){
	 $sql.="&& birth>='$age0' ";
	}
	if($age1!=null){
	 $sql.="&& birth<='$age1' ";
	}
	if($graduateTime0 != null){
	  $sql.=" && graduateTime>='$graduateTime0' ";
	}
	if($graduateTime1 != null){
	  $sql.=" && graduateTime<='$graduateTime1' ";
	}
	if($beginTime0 != null){
	  $sql.=" && beginTime>='$beginTime0' ";
	}
	if($beginTime1 != null){
	  $sql.=" && beginTime<='$beginTime1' ";
	}
	//echo $sql;
	$result=@mysql_query($sql,$conn);
	 $count=@mysql_num_rows($result);
	 if($count==0)
		$temp=array();
	  else{
		 //mysql_fetch_array必须写在这里，不能放在循环外的变量里
		 while($row= mysql_fetch_assoc($result)){
		 $temp[]=$row;}
	  }
	
	 echo "{success:true,msg:'ok',totalProperty:".$count.",root:".json_encode($temp)."}";
}
 
?>