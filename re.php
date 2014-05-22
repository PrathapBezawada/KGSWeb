<?php
include 'dbcon.php';
$q=mysql_query("select * from list group by district");
while($r=mysql_fetch_array($q)){
	$d=$r['district'];
	mysql_query("insert into district (district_name) values ('$d')");
	$did=mysql_insert_id();
	$q1=mysql_query("select * from list where district='$d' group by taluk");
	while($r1=mysql_fetch_array($q1)){
		$t=$r1['taluk'];
		mysql_query("insert into taluk (taluk_name,district_id) values ('$t','$did')");
		$tid=mysql_insert_id();
		$q2=mysql_query("select * from list where district='$d' and taluk='$t' group by hobli");
		while($r2=mysql_fetch_array($q2)){
			$h=$r2['hobli'];
			mysql_query("insert into hobli (hobli_name,taluk_id) values ('$h','$tid')");
			$hid=mysql_insert_id();
			$q3=mysql_query("select * from list where district='$d' and taluk='$t' and hobli='$h' group by village");
			while($r3=mysql_fetch_array($q3)){
				$v=$r3['village'];
				mysql_query("insert into village (village_name,hobli_id) values ('$v','$hid')");
				$vid=mysql_insert_id();
				echo $vid."<br>";
			}
		}
	}
	
}

?>