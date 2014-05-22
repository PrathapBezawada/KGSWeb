<?php
$username=$_REQUEST['username'];
$password=$_REQUEST['password'];
include '../dbcon.php';
//echo "user di is".$username;
//$query=mysql_query("select * from users where userid='$username' and password='$password' where role='FF'");

$query=mysql_query("select * from users where userid='$username' and password='$password' and  role in ('FF','DISTRICT','TALUK','HOBLI') and designation not in('AA','SO-ICRISAT','VS-ICRISAT')");
//$query=mysql_query("select * from users where userid='$username' and password='$password' and  role in ('FF','DISTRICT','TALUK','HOBLI') ");
//echo "select * from users where userid='$username' and password='$password' and  role in ('FF','DISTRICT','TALUK','HOBLI') and designation not in('SO-ICRISAT','VS-ICRISAT')";

 //echo "select * from users where userid='$username' and password='$password' and  role in ('FF','DISTRICT','TALUK','HOBLI') and designation not in('AA','SO-ICRISAT','VS-ICRISAT')";
if(mysql_num_rows($query)>0){
	$result=mysql_fetch_array($query);
	$villages=explode(",",$result['village']);
		$i=0;
		foreach($villages as $village)
		{
		$village;
			if($i==0)
				$response['village']=$village;
			else
				$response['village']=$response['village'].",".$village;
			$i++;
		}
$response['loginstatus']="true";
$response['username']=$result['userid'];
$response['userid']=$result['sno'];
$response['district']=$result['district'];
$response['taluk']=$result['taluk'];
$response['hobli']=$result['hobli'];
$response['Partial_Sync_Date']=$result['last_partial_sync_date'];
$response['Full_Sync_Date']=$result['last_full_sync_date'];
$response['role']=$result['role'];


}else{
	$response['loginstatus']="false";
	$response['username']="";
	$response['userid']="";
	$response['district']="";
	$response['taluk']="";
	$response['village']="";
	$response['hobli']="";
	$response['Partial_Sync_Date']="";
	$response['Full_Sync_Date']="";
 $response['Full_Sync_Date']="";

}
echo json_encode($response);



?>