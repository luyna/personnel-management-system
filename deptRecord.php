<?php
session_start();
if(!($_SESSION['manageID'])){
echo "<script>alert('请先登录！');window.location.href='http://localhost/managesystem/login.html';</script>";
}

include('conn.php');
$deptnum=$_POST['deptnum'];
$deptname=$_POST['deptname'];
$deptmanager=$_POST['deptmanager'];
$employeenum=$_POST['employeenum'];
$deptdescribe=$_POST['deptdescribe'];


$number=@mysql_num_rows(mysql_query("SELECT * FROM `deptmsg` WHERE deptnum='$deptnum'"));
$number1=@mysql_num_rows(mysql_query("SELECT * FROM `userinfo` WHERE userID='$deptmanager'"));
//echo $number;
if($number!=0) echo "{success:true,msg:'exist'}";
else if($number1==0) echo "{success:true,msg:'managernull'}";
else {
	$sql="insert into deptmsg (deptnum,deptname,employeenum,deptmanager,deptdescribe) values('$deptnum','$deptname','$employeenum','$deptmanager','$deptdescribe')";
	//echo $sql;
	$sql1="update userinfo set deptnum='$deptnum',job='部门经理' where userID='$deptmanager'";
	//echo $sql1;
	$result=mysql_query($sql,$conn);
	$result1=mysql_query($sql1,$conn);
	if($result && $result1){
	 echo "{success:true,msg:'ok'}";
	}else echo "{success:true,msg:'wrong'}";
}

?>