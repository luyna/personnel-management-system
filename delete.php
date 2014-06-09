<?php
session_start();
if(!($_SESSION['manageID'])){
echo "<script>alert('请先登录！');window.location.href='http://localhost/managesystem/login.html';</script>";
}

include('conn.php');
//$state=$_POST['state'];
$id=$_POST['id'];
//$id=$GLOBALS['HTTP_RAW_POST_DATA'] ;
//[{\'a\':2321,\'b\':\'gsd\',\'c\':\'dww\'}...] 将后台获得的该形式数据转化成json
if(get_magic_quotes_gpc()==1){
   $id = stripslashes($id);
}

$arr=json_decode($id);
$is_suc=true;
//echo $state;

//if($state='0') {
	foreach($arr as $key=>$value){
		$sql="delete from userinfo where userID=".$value->userID;  //$value是对象，不能用$value['userID']
		$result=@mysql_query($sql,$conn);
		if(!$result)
		   $is_suc=false;
	}
/*}
else {
     foreach($arr as $key=>$value){
		$sql="update userinfo set state=".$state." where userID=".$value->userID;  //$value是对象，不能用$value['userID']
		$result=@mysql_query($sql,$conn);
		if(!$result)
		   $is_suc=false;
	}
} */
 
if($is_suc)
  echo '{success:true,msg:\'ok\'}';
 else echo '{success:true,msg:\'删除失败\'}';

?>