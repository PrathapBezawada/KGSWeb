<?php
include 'dbcon.php';
/*if(isset($_POST['croptype'])){
	$taluk=$_POST['taluk'];
	$croptype=$_POST['croptype'];
	$district=$_POST['district'];
	$q=mysql_query("select * from rec where district='$district' and taluk='$taluk' and crop_type='$croptype'");
	$d="<table><tr><th>District</th><th>Taluk</th><th>Crop Type</th><th>UREA</th><th>DAP</th><th>MOP</th><th>Gypsum</th><th>Zinc Sulphate</th><th>Borax</th></tr>";
	while($r=mysql_fetch_array($q)){
		$d.="<tr>
		<td>".$r['district']."</td>
		<td>".$r['taluk']."</td>
		<td>".$r['crop_type']."</td>
		<td>".$r['urea']."</td>
		<td>".$r['dap']."</td>
		<td>".$r['mop']."</td>
		<td>".$r['gypsum']."</td>
		<td>".$r['zinc_sulphate']."</td>
		<td>".$r['borax']."</td>
		</tr>";
	}
	$d.="</table>";
	echo $d; 
}else */
	if(isset($_REQUEST['district'])){
	$district=$_REQUEST['district'];
	echo "<script>alert('here');</script>";
	$q=mysql_query("select * from rec where district='$district' group by taluk");
	$d="<option value=''>--taluk--</option>";
	while($r=mysql_fetch_array($q)){
		$d.="<option value='".$r['taluk']."'>".$r['taluk']."</option>";
	}
	$res['sel']="abc";
	echo json_encode($res); 
}/*elseif(isset($_POST['taluk'])){
	$taluk=$_POST['taluk'];
	$q=mysql_query("select * from rec where taluk='$taluk' group by crop_type");
	$d="<option value=''>--crop type--</option>";
	while($r=mysql_fetch_array($q)){
		$d.="<option value='".$r['crop_type']."'>".$r['crop_type']."</option>";
	}
	echo $d; 
}*/

 ?>