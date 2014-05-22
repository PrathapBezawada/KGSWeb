<?php
$uid=$_REQUEST['userid'];
$dist=$_REQUEST['district'];
$taluk=$_REQUEST['taluk'];

//$uid='';
//$dist='Bijapur';
//$taluk='Bagewadi';
include '../dbcon.php';
$response=array();
$re=array();
//$query=mysql_query("select * from farms where fid='$fid' and del!=1");


$query=mysql_query("select district_id from district where district_name='$dist'");
$result=mysql_fetch_array($query);
$dist_id=$result['district_id'];
//echo "dist id is".$dist_id;

$query=mysql_query("select taluk_id from taluk where taluk_name='$taluk' and district_id='$dist_id'");
$result=mysql_fetch_array($query);
$taluk_id=$result['taluk_id'];
//echo "taluk id is".$taluk_id;


$query=mysql_query("select hobli_id from hobli where taluk_id='$taluk_id' ");
$result=mysql_fetch_array($query);
$hobli_id=$result['hobli_id'];
//echo "hobli id is".$hobli_id;


$query=mysql_query("select village_name from village where hobli_id='$hobli_id'");


if(mysql_num_rows($query)>0)
{
	while($result=mysql_fetch_array($query))
	{


		$response['village']=$result['village_name'];
		array_push($re,$response);
	}
}
else
{
		$response['village']="";
		array_push($re,$response);
}
$res1['Villages']=$re;

echo json_encode($res1);
?>

















