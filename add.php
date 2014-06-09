<?php
session_start();
if(!($_SESSION['manageID'])){
echo "<script>alert('请先登录！');window.location.href='http://localhost/managesystem/login.html';</script>";
}
?>

<?php
 include("conn.php");
 $dosubmit=$_POST['dosubmit'];
 if($dosubmit){
    $UserID=$_POST['userID'];
	$Username=$_POST['username'];
	$Sex=$_POST['sex'];
	$Birth=$_POST['birth'];
	$Id=$_POST['id'];
	$Marriage=$_POST['marriage'];
	$Nation=$_POST['nation'];
	$Zzmm=$_POST['zzmm'];
	$Tel=$_POST['tel'];
	$Addr=$_POST['addr'];
	$Dept=$_POST['dept'];
	$Job=$_POST['job'];
	$State=$_POST['state'];
	$Edu=$_POST['edu'];
	$Spec=$_POST['spec'];
    $Foreign=$_POST['fore'];
	$School=$_POST['school'];
	$GraduateTime=$_POST['graduateTime'];
	$BeginTime=$_POST['beginTime'];
	$EndTime=$_POST['endTime'];
	$Mark=$_POST['mark'];
	 $is_suc=true;
	 
 $temp = "SELECT deptnum FROM `deptmsg` WHERE deptname='$Dept'";
 $deptnum=@mysql_result(@mysql_query($temp,$conn),0);


 $sql = "INSERT INTO `system`.`userinfo` (`userID`,`username`,  `sex`, `birth`, `id`,`marriage`, `nation`, `zzmm`,  `tel`, `addr`, `deptnum`, `job`, `state`, `edu`, `spec`, `fore`, `school`, `graduateTime`, `beginTime`, `endTime`, `mark`) VALUES ('$UserID','$Username','$Sex','$Birth','$Id','$Marriage','$Nation','$Zzmm','$Tel',
	     '$Addr','$deptnum','$Job','$State','$Edu','$Spec','$Foreign','$School','$GraduateTime','$BeginTime','$EndTime','$Mark');";
 
 /*$sql="insert into userinfo(userID,username,sex,birth,id,marriage,nation,zzmm,tel,addr,deptnum,job,state,edu,spec,school,graduateTime,beginTime,endTime,mark) values('$UserID','$Username','$Sex','$Birth','$Id','$Marriage','$Nation','$Zzmm','$Tel',
	     '$Addr','$deptnum','$Job','$State','$Edu','$Spec','$School','$GraduateTime','$BeginTime','$EndTime','$Mark');";*/
// echo $sql;
 
  $number1=@mysql_num_rows(mysql_query("select * from userinfo  where userID=".$UserID));
  $number2=@mysql_num_rows(mysql_query("select * from userinfo  where id=".$Id));
 if($number1!=0)
    echo '{success:true,msg:\'该员工已存在,请重新输入\'}';
  else if( $number2==0) 
  {
       
       $result= @mysql_query($sql,$conn);
      if($result==false)
         $is_suc=false;
      else $is_suc=true;
	  //echo $sql;
      echo $is_suc?'{success:true,msg:\'ok\'}':'{success:true,msg:\'插入失败，请重试\'}';
    } else echo '{success:true,msg:\'id\'}';

 }

?>


