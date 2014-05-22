<?php
include 'dbcon.php';
if(isset($_POST['farmdelete'])){
	$sno=$_POST['sno1'];
	mysql_query("update farms set del=1 where fid='$sno'") or die(mysql_error());
	mysql_query("update farmer_rec set del=1 where farmer_id='$sno'") or die(mysql_error());
	echo "success";
}
if(isset($_REQUEST['sno'])){
	$sno=$_REQUEST['sno'];
	echo 'sno is'.$sno;
	exit;
		mysql_query("update farmers set del=1 where sno='$sno'") or die(mysql_error());
	echo "success";
}
else{
echo "Fail";
}
if(isset($_POST['uid'])){
	$sno=$_POST['uid'];
	mysql_query("update users set del=1 where sno='$sno'") or die(mysql_error());
	echo "success";
}
if(isset($_POST['faid'])){
	$sno=$_POST['faid'];
	mysql_query("update farms set del=1 where sno='$sno'") or die(mysql_error());

	mysql_query("update farmer_rec set del=1 where field_id='$sno'") or die(mysql_error());

	echo "success";
}



?>