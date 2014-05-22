<?php
include 'dbcon.php';
if(isset($_POST['district'])){
	$district=$_POST['district'];
	$q=mysql_query("select * from district d,taluk t where d.district_name='$district' and d.district_id=t.district_id group by taluk_name");
	//echo "select * from district d,taluk t where d.district_name='$district' and d.district_id=t.district_id group by taluk_name";
	$d="<option value=''id='defualt'>--Select taluk--</option>";
	while($r=mysql_fetch_array($q)){
		$d.="<option value='".$r['taluk_name']."'>".$r['taluk_name']."</option>";
	}
	echo $d; 
}elseif(isset($_POST['taluk']))
{

	$taluk=$_POST['taluk'];
	$taluk=trim($taluk);
	echo $taluk;
	$q=mysql_query("select * from taluk t,hobli h where t.taluk_name='$taluk' and t.taluk_id=h.taluk_id group by hobli_name");
	echo "select * from taluk t,hobli h where t.taluk_name='$taluk' and t.taluk_id=h.taluk_id group by hobli_name";
	$d="<option value=''id='defualt'>--Select hobli--</option>";
	while($r=mysql_fetch_array($q)){
		$d.="<option value='".$r['hobli_name']."'>".$r['hobli_name']."</option>";
		
	}
	echo $d; 
}elseif(isset($_POST['hobli'])){
	$hobli=$_POST['hobli'];
	$hobli=trim($hobli);
	echo $hobli;
	if(isset($_POST['hobli1']))
		{
			$hobli1=$_POST['hobli1'];
			$hobli1=trim($hobli1);
			$hobli=$hobli.'&'.$hobli1;
	  }
	
	$q=mysql_query("select * from hobli h,village v where h.hobli_name='$hobli' and h.hobli_id=v.hobli_id group by village_name");


	$d="<option value=''id='defualt'>--Select village--</option>";
	while($r=mysql_fetch_array($q)){
		$d.="<option value='".$r['village_name']."'>".$r['village_name']."</option>";
	}
	echo $d; 
	}
	
	elseif(isset($_POST['hobli_name']))
	{
		$hobli=$_POST['hobli_name'];
		$hobli=trim($hobli);
		$taluk=$_POST['taluk_name'];
		echo $hobli;
		echo $taluk;
			$taluk=trim($taluk);
		$q_t=mysql_query("select taluk_id from taluk where taluk_name='$taluk'");	
		echo "select taluk_id from taluk where taluk_name='$taluk'";
		$r_t=mysql_fetch_array($q_t);
		$taluk_id=$r_t['taluk_id'];
		
		if(isset($_POST['hobli1']))
			{
				$hobli1=$_POST['hobli1'];
				$hobli1=trim($hobli1);
				$hobli=$hobli.'&'.$hobli1;
		  }
		
		$q=mysql_query("select * from hobli h,village v where h.hobli_name='$hobli' and h.hobli_id=v.hobli_id  and h.taluk_id='$taluk_id' group by village_name");
	
	echo "select * from hobli h,village v where h.hobli_name='$hobli' and h.hobli_id=v.hobli_id  and h.taluk_id='$taluk_id' group by village_name";
	
		$d="<option value='' id='defualt'>--Select village--</option>";
		while($r=mysql_fetch_array($q)){
			$d.="<option value='".$r['village_name']."'>".$r['village_name']."</option>";
	}
	
	echo $d; 
}


 ?>