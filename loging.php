
<?php
session_start();
include("conn.php");
  
$dosubmit = $_POST['dosubmit'];

 if($dosubmit){
     $user=$_POST['manageID'];
     $password=$_POST['password'];
	// $manage=$_POST['manage'];
	 //$employee=$_POST['employee'];
	 $identity=$_POST['identity'];
     $is_suc=false;

	 if($identity=='manage' ){
	    $sql='select * from manage where manageID='.$user;    	
	 }else if($identity=='employee'){
	    $sql='select * from employee where userID='.$user;
	 }
	 $result=@mysql_query($sql,$conn);
	 
  $pas=@mysql_result($result,$count,"password");
  if($identity=='manage')
     $u=@mysql_result($result,$count,"manageID");
  else if($identity=='employee') $u=@mysql_result($result,$count,"userID");

 
 $_SESSION['password']=$pas;
 $_SESSION['manageID']=$u;

  
  if($result==false)
     $is_suc=false;
  else if($pas == $password)
	   $is_suc=true;
    if( $is_suc){
	  echo '{success:true,msg:\'ok\'}';
	}else if($is_suc==false){
	   echo '{success:true,msg:\'用户ID或密码输入错误\'}';
	}
}


?>

