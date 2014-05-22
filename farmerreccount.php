<?php
session_start();
$activetab="report";
include 'header.php';
  ?>
<style> table{margin:2px 0px 0px 20px;} </style>

<script type="text/javascript">
$(document).ready(function(){

$('#district').change(function(){
	
	var district=$('#district').val();
	var dataString='district=' + district;
	if(district!=""){
	window.location="farmerreccount.php?d="+district;
	}else{
	window.location="farmerreccount.php";
	}/*$.ajax({
		data: dataString,
		type: "POST",
		url: 'recinvresponse.php',
		success:function(response){
			
			$('#taluk').html(response);
		}
	
	
	}); */
}); 

$('#taluk').change(function(){
	var district=$('#district').val();
	var taluk=$('#taluk').val();
	var dataString='taluk=' + taluk;

	if(taluk!=""){
	window.location="farmerreccount.php?d="+district+"&t="+taluk;
	}else{
	window.location="farmerreccount.php?d="+district;
	}
});
$('#croptype').change(function(){
	var district=$('#district').val();
	var taluk=$('#taluk').val();
	var croptype=$('#croptype').val();
	
	var dataString='taluk=' + taluk +'&district=' + district + '&croptype=' + croptype;
	
	
	if(croptype!="")
	{
	window.location="farmerreccount.php?d="+district+"&t="+taluk+"&c="+croptype;
	}else{
		window.location="farmerreccount.php?d="+district+"&t="+taluk;
	}
});
});
</script>
<?php if(isset($_GET['t']))
	{ 
		$clsname="midd_right2";}else{$clsname="midd_right2";}?>
		<div class="<?php echo $clsname?>">
		<div class="main_heads">
	  <div class="rec_drop">
    <div class="form_main_2">
    <span class="form_right_1"> <select name="district" id="district" class="txt_box1">
		<option value="">--District--</option>
  	<?php 
  		if(isset($_GET['d']))
  		{
  			$d=$_GET['d'];
  		} ?>
  	<?php 
  	$date=date('Y-m-d');
   	if($_SESSION['user_id']!="admin" && $_SESSION['user_id']!="admin")
   	{
				$user=$_SESSION['user_id'];
				
				
				$q_d=mysql_query("select * from users where sno=$user");
				$r=mysql_fetch_array($q_d);
				$u_d=$r['district'];
			  $query=mysql_query("select fr.district from farmers fr,farms f,farmer_rec frec where fr.district='$u_d' and fr.sno=f.fid and f.fid=frec.farmer_id and frec.date<='$date' group by fr.district order by fr.district");

				//$query=mysql_query("select fr.district from farmers fr,farms f,farmer_rec frec where fr.createdby='$user' and fr.sno=f.fid and f.fid=frec.farmer_id and frec.date<='$date' group by fr.district order by fr.district");
				while($result=mysql_fetch_array($query)){
				?>
				<option value="<?php echo $result['district'] ?>" <?php
				if($result['district']==$d)
				{ 
					echo "selected";
				} ?>><?php echo strtoupper($result['district']) ?></option>
				<?php	
	  }
   }
   else
   {
  	$query=mysql_query("select * from farmers fr,farms f,farmer_rec frec where fr.sno=f.fid and f.fid=frec.farmer_id and frec.date<='$date' group by fr.district order by fr.district");
  	while($result=mysql_fetch_array($query))
  	{
			?>
			<option value="<?php echo $result['district'] ?>" <?php if($result['district']==$d){ echo "selected";} ?>><?php echo strtoupper($result['district']) ?></option>
			<?php	
	 	}
   }
  	?>
  	</select>
  	</span>
    </div>
  	<div class="form_main_2">
    <span class="form_right_1">  <select name="taluk" id="taluk" class="txt_box1">
    <option value="">--Taluk--</option>
  <?php 
  if(isset($_GET['d']))
  {
		$district=$_GET['d'];
		$q1=mysql_query("select * from farmers where district='$district' group by taluk order by taluk");
		if(isset($_GET['t']))
		{
			$t=$_GET['t'];
		}
		while($r1=mysql_fetch_array($q1))
		{
			?><option value="<?php echo $r1['taluk']?>" <?php 
			if($r1['taluk']==$t)
			{
				echo "selected";
			} ?>><?php  echo $r1['taluk'] ?></option>";
			<?php 
		}
  }
  ?>
  </select></span>
   
  </div>
	<div class="form_main_2">
  <span class="form_right_1">
  <select name="croptype" id="croptype" class="txt_box1">
  <option value="">--Village--</option>
 <?php 
 if(isset($_GET['t']))
 {
  $district=$_GET['d'];
  $t=$_GET['t'];
	$q2=mysql_query("select * from farmers where district='$district' and taluk='$t' group by village order by village");
	if(isset($_GET['c']))
	{
		$c=$_GET['c'];}
		while($r2=mysql_fetch_array($q2))
		{
			?><option value="<?php echo $r2['village']?>" <?php if($r2['village']==$c){ echo "selected";} ?>><?php  echo $r2['village'] ?></option>";
			<?php
		}
 }
  ?>
  </select>
  </span>
  </div>   
  </div> 
 	<div id="cropdetails" style="float:left;">
	<?php
if(isset($_GET['c']))
{
	$d=$_GET['d'];
	$t=$_GET['t'];
	$c=$_GET['c'];
	if($_SESSION['user_id']!="admin")
	{
		$user=$_SESSION['user_id'];
		
	$q=mysql_query("select fr.fname from farmers fr,farms f,farmer_rec frec where fr.district='$d' and fr.taluk='$t' and fr.village='$c' and fr.sno=f.fid and f.fid=frec.farmer_id and frec.date<='$date'");
	}
	else
	{
	$q=mysql_query("select fr.fname from farmers fr,farms f,farmer_rec frec where fr.district='$d' and fr.taluk='$t' and fr.village='$c' and fr.sno=f.fid and f.fid=frec.farmer_id and frec.date<='$date'");
	}
	?>
	<table width="100%"><tr><th width='178px'>District</th><th width='178px'>Taluk</th><th width='178px'>Village</th><th width='178px'>No of Farmers</th></tr>
	<?php $i=1;
	$num=mysql_num_rows($q);
	if($i%2==0)
	{
		$td="td_even";
	}
	else
	{
		$td="td_odd";
	}
	$i++;
	echo "
	<tr class='".$td."'>
	<td>".$d."</td>
	<td>".$t."</td>
	<td>".$c."</td>
	<td align='center'>".$num."</td>

	</tr>";
  ?>
 </table> <?php
}
elseif(isset($_GET['t']))
{
	$d=$_GET['d'];
	$t=$_GET['t'];
//$q3=mysql_query("select * from rec group by district");
 ?>
	<table width="100%"><tr><th width='178px'>District</th><th width='178px'>Taluk</th><th width='178px'>Village</th><th width='178px'>No of Farmers</th></tr>
	<?php $date=date('Y-m-d');
		if($_SESSION['user_id']!="admin")
		{
			$user=$_SESSION['user_id'];
			$q2=mysql_query("select fr.village from farmers fr,farms f,farmer_rec frec where fr.district='$d' and fr.taluk='$t' and fr.sno=f.fid and f.fid=frec.farmer_id and frec.date<='$date' group by fr.village");
		}
		else
		{
			$q2=mysql_query("select fr.village from farmers fr,farms f,farmer_rec frec where fr.district='$d' and fr.taluk='$t' and fr.sno=f.fid and f.fid=frec.farmer_id and frec.date<='$date' group by fr.village");
		}
		$cc=0;$i=1;
		while($r2=mysql_fetch_array($q2))
		{
			$v=$r2['village'];
			if($_SESSION['user_id']!="admin" && $_SESSION['user_id']!="superadmin")
			{
				$user=$_SESSION['user_id'];
				$q3=mysql_query("select * from farmers fr,farms f,farmer_rec frec where fr.district='$d' and fr.taluk='$t' and fr.village='$v' and fr.sno=f.fid and f.fid=frec.farmer_id and frec.date<='$date' ");
			}
			else
			{
				$q3=mysql_query("select * from farmers fr,farms f,farmer_rec frec where fr.district='$d' and fr.taluk='$t' and fr.village='$v' and fr.sno=f.fid and f.fid=frec.farmer_id and frec.date<='$date'");
			}
			$num=mysql_num_rows($q3);
			$cc++;if($i%2==0){$td="td_even";}else{$td="td_odd";}$i++;
			if($num>0)
			{
				echo "
			<tr class='".$td."'>
			<td>".$d."</td>
			<td>".$t."</td>
			<td>".$v."</td>
			<td>".$num."</td>

			</tr>";
			}
			else
			{
				echo "
					<tr class='".$td."'>
							<td>".$d."</td>
							<td>".$t."</td>
							<td>".$v."</td>
							<td>0</td>

							</tr>";	
			}
		}

 ?>
 </table><?php

}
elseif(isset($_GET['d']))
{
	$d=$_GET['d'];

	//$q3=mysql_query("select * from rec group by district");

	 ?>
	<table width="100%"><tr><th width='178px'>District</th><th width='178px'>Taluk</th><th width='178px'>No of Farmers</th></tr>

	<?php $dc=0;

		$i=1;$date=date('Y-m-d');
		if($_SESSION['user_id']!="admin" && $_SESSION['user_id']!="admin")
		{
			$user=$_SESSION['user_id'];
		$q1=mysql_query("select fr.taluk from farmers fr,farms f,farmer_rec frec where fr.district='$d' and fr.sno=f.fid and f.fid=frec.farmer_id and frec.date<='$date' group by fr.taluk");
		}
		else
		{
			$q1=mysql_query("select fr.taluk from farmers fr,farms f,farmer_rec frec where fr.district='$d' and fr.sno=f.fid and f.fid=frec.farmer_id and frec.date<='$date' group by fr.taluk");
		}$tc=0;

		if(mysql_num_rows($q1)>0)
		{
			$date=date('Y-m-d');
		while($r1=mysql_fetch_array($q1))
		{
			$t=$r1['taluk'];
			if($_SESSION['user_id']!="admin")
			{
				$user=$_SESSION['user_id'];
				$q2=mysql_query("select * from farmers fr,farms f,farmer_rec frec where fr.district='$d' and fr.taluk='$t' and fr.sno=f.fid and f.fid=frec.farmer_id and frec.date<='$date'");
			}
			else
			{
				$q2=mysql_query("select * from farmers fr,farms f,farmer_rec frec where fr.district='$d' and fr.taluk='$t' and fr.sno=f.fid and f.fid=frec.farmer_id and frec.date<='$date'");
			}
			$num=mysql_num_rows($q2);
			if($num>0)
			{
			echo "
			<tr class='td_even'>
				<td >".$d."</td>
				<td >".$t."</td>
				<td>".$num."</td>
			</tr>";
			}
			else
			{
				echo "
				<tr class='td_even'>
					<td >".$d."</td>
					<td >".$t."</td>
					<td>0</td>
					</tr>";
			}	
		}
	}

 ?>
 </table><?php

}
else
{
 if($_SESSION['user_id']!="admin" && $_SESSION['user_id']!="superadmin")
 {
		$user=$_SESSION['user_id'];
		$q=mysql_query("select district from users where sno='$user'");
 }
 else
 {
	$q=mysql_query("select district from farmers group by district");
 }
//$q3=mysql_query("select * from rec group by district");


 ?>
	<table width="100%"><tr><th width='178px'>District</th><th width='178px'>No of Farmers</th></tr>
	<?php $dc=0;$i=1;
	while($r=mysql_fetch_array($q))
	{
		$d=$r['district'];$dc++;
		$date=date('Y-m-d');
		$q1=mysql_query("select fr.fname from farmers fr,farms f,farmer_rec frec where fr.district='$d' and fr.sno=f.fid and f.fid=frec.farmer_id and frec.date<='$date'") or die(mysql_error());
		$tc=0;
		$num=mysql_num_rows($q1);
		if($num>0)
		{
			$cc++;if($i%2==0){$td="td_even";}else{$td="td_odd";}$i++;
			echo "
			<tr class='".$td."'>
				<td >".$d."</td>
				<td>".$num."</td>
		</tr>";
		}
		else
		{
			echo "
			<tr class='".$td."'>
				<td >".$d."</td>
				<td>0</td>
		
		</tr>";
	}	
}
 ?>
 </table><?php
}
?>

</div>






</div> </div>
<?php include 'footer.php';?>