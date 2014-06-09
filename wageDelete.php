<?php
session_start();
if(!($_SESSION['manageID'])){
echo "<script>alert('请先登录！');window.location.href='http://localhost/managesystem/login.html';</script>";
}

include('conn.php');
$id=$_POST['id'];
//$id=$GLOBALS['HTTP_RAW_POST_DATA'] ;
//[{\'a\':2321,\'b\':\'gsd\',\'c\':\'dww\'}...] 将后台获得的该形式数据转化成json
if(get_magic_quotes_gpc()==1){
   $id = stripslashes($id);
}

$arr=json_decode($id);
$is_suc=true;

	foreach($arr as $key=>$value){
		$sql="delete from wage where userID=".$value->userID." && month='$value->month'";   //$value是对象，不能用$value['userID']
		//echo $sql;
		$result=@mysql_query($sql,$conn);
		if(!$result)
		   $is_suc=false;
	}

 
if($is_suc)
  echo '{success:true,msg:\'ok\'}';
 else echo '{success:true,msg:\'删除失败\'}';

?>