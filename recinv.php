<?php
ini_set('max_input_time', 900);
ini_set('max_execution_time', 900);

session_start();
$activetab="report";
include 'header.php';
/*$username=$_POST['username'];
$pass=$_POST['password'];
if($username=="nunc" && $pass=="nunc"){
	$_SESSION['user']='nunc';
}else{
	$_SESSION['error']='nunc';
}
if(!isset($_SESSION['user']))
{header("location:index.php");}	*/

  ?>

<style> table{margin:2px 0px 0px 20px;}
.table_th
{
color:yellow;
}

</style>

<script type="text/javascript">
$(document).ready(function(){

$('#district').change(function(){

	var district=$('#district').val();
	var dataString='district=' + district;
	if(district!=""){
	window.location="recinv.php?d="+district;
	}else{
	window.location="recinv.php";
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

	/*$.ajax({
		data: dataString,
		type: "POST",
		url: 'recinvresponse.php',
		success:function(response){
			$('#croptype').html(response);
		}


	}); */

	taluk=$.trim(taluk);

	if(taluk!=""){
	window.location="recinv.php?d="+district+"&t="+taluk;
	}else{
	window.location="recinv.php?d="+district;
	}
});


$('#croptype').change(function(){
	var district=$('#district').val();
	var taluk=$('#taluk').val();
	var croptype=$('#croptype').val();

	var dataString='taluk=' + taluk +'&district=' + district + '&croptype=' + croptype;

	/*$.ajax({
		data: dataString,
		type: "POST",
		url: 'recinvresponse.php',
		success:function(response){
			$('#cropdetails').html(response);
		}


	}); */
	if(croptype!=""){
	window.location="recinv.php?d="+district+"&t="+taluk+"&c="+croptype;
	}else{
		window.location="recinv.php?d="+district+"&t="+taluk;
	}
});




});
</script>
<?php
	if(isset($_GET['t']))
	{
		$clsname="midd_right1";
	}
	else
	{$clsname="midd_right1";}?>
		<div class="<?php echo $clsname?>">
		 <div class="main_heads">

		 <div class="rec_drop">
		 <div class="sels" style="float:left">
		 <div class="form_main_2">


			 <span class="form_right_1"> <select name="district" id="district" class="txt_box1">
			<option value="">--District--</option>
			<?php if(isset($_GET['d']))
			{
				$d=$_GET['d'];
			} ?>
			<?php

		 if($_SESSION['user_id']!="admin" && $_SESSION['user_id']!="superadmin")
		 {
			$user=$_SESSION['user_id'];
			$query=mysql_query("select district from users where sno='$user' order by district");
			while($result=mysql_fetch_array($query))
			{
			?>
			<option value="<?php echo $result['district'] ?>" <?php if($result['district']==$d){ echo "selected";} ?>><?php echo strtoupper($result['district']) ?></option>

			<?php
			}
  	 }
		 else
		 {
			$query=mysql_query("select * from district order by district_name");
				while($result=mysql_fetch_array($query)){
			?>
			<option value="<?php echo $result['district_name'] ?>" <?php if($result['district_name']==$d){ echo "selected";} ?>><?php echo strtoupper($result['district_name']) ?></option>

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
  $district=trim($district);
  echo '<br>'.$district;
  if($district=='Mahabubnagar')
    {
	$user=$_SESSION['user'];

	echo 'user id is'.$user;
   $q1=mysql_query("select taluk from users where userid='$user'");

  }
  else
  {
	$q1=mysql_query("select * from rec where district='$district' group by taluk order by taluk");
	}
	if(isset($_GET['t'])){$t=$_GET['t'];

		$t=trim($t);

		echo 'taluk is'.$t;
		}

	while($r1=mysql_fetch_array($q1)){
		?><option value="<?php echo trim($r1['taluk'])?>" <?php if(trim($r1['taluk'])==$t){ echo "selected";} ?>><?php  echo $r1['taluk'] ?></option>";
	<?php }
  }
  ?>
  </select></span>


  </div>

<div class="form_main_2">


   <span class="form_right_1">
   <select name="croptype" id="croptype" class="txt_box1">
  <option value="">--Crop Type--</option>
 <?php if(isset($_GET['t'])){
  $district=$_GET['d'];
  $t=$_GET['t'];
  $t=trim($t);
  if($district=='Mahabubnagar')
  						{
  							$d_main=$district;
  					        $district='Bellary';
                             $t='Sandur';

                          }
	$q2=mysql_query("select * from rec where district='$district' and taluk='$t' group by crop_type order by crop_type asc");
	if(isset($_GET['c'])){$c=$_GET['c'];}
	while($r2=mysql_fetch_array($q2)){
		?><option value="<?php echo $r2['crop_type']?>" <?php if($r2['crop_type']==$c){ echo "selected";} ?>><?php  echo $r2['crop_type'] ?></option>";
	<?php }
 }
  ?>
  </select>

  </span>
  </div>
  </div>
  <div class="notes"  >
 <div style="float:left;margin-right:5px;  font-size:12px"> Note:</div>
<div style="float:left; font-size:12px;">
<div>
 1. All the recommendations are measured in (KG/H)
</div>
<div>
2. If SSP is used Urea, Gypsum, DAP quantity changes as shown after the SSP column and rest other Fertilizer like MOP, Zinc and Borax remains same
</div>
</div>
 </div>

  </div>

<div id="cropdetails" style="float:left;">

<?php
if(isset($_GET['c']))
{
	$d=$_GET['d'];
	$t=$_GET['t'];
	$t=trim($t);
	$c=$_GET['c'];
	if($d=='Mahabubnagar')
	  						{
	  							$d_main=$d;
	  					        $d='Bellary';
	                             $t='Sandur';

                          }
	$q=mysql_query("select * from rec where district='$d' and taluk='$t' and crop_type='$c' ");

	//echo "select * from rec where district='$d' and taluk='$t' and crop_type='$c'";
?>

	<table width="90%"  class="responsive"><tr><th width='178px'>District</th><th width='178px'>Taluk</th><th width='178px'>Crop Type</th><th>UREA</th><th>DAP</th><th>MOP</th><th>Gypsum</th><th>Zinc Sulphate</th><th>Agribor</th><th>Borax</th><th style="color:yellow;">SSP</th><th style="color:yellow;">UREA</th><th style="color:yellow;">Gypsum</th><th style="color:yellow;">DAP</th></tr>
	<?php $i=1;
	while($r=mysql_fetch_array($q))
	{
		if($i%2==0){$td="td_even";}else{$td="td_odd";}$i++;
		if($d_main=='Mahabubnagar')
									{
										$r['district']=$d_main;
									$user=$_SESSION['user'];


									   $query1=mysql_query("select taluk from users where userid='$user'");
			                          $re1= mysql_fetch_array($query1);
			                          $r['taluk']=$re1['taluk'];
                          }
		echo "
		<tr class='".$td."'>
				<td>".$r['district']."</td>
				<td>".$r['taluk']."</td>
				<td>".$r['crop_type']."</td>
				<td align='center'>".$r['urea']."</td>
				<td align='center'>".$r['dap']."</td>
				<td align='center'>".$r['mop']."</td>
				<td align='center'>".$r['gypsum']."</td>
				<td align='center'>".$r['zinc_sulphate']."</td>
				<td align='center'>".$r['agribor']."</td>
				<td align='center'>".$r['borax']."</td>
				<td align='center'  style='background-color:#d5dcad;'>".$r['ssp']."</td>
				<td align='center'  style='background-color:#d5dcad;'>".$r['ssp_urea']."</td>
				<td align='center'  style='background-color:#d5dcad;'>".$r['ssp_gypsum']."</td>
				<td align='center'  style='background-color:#d5dcad;'>".$r['ssp_dap']."</td>
				</tr>";
	} ?>
 	</table> <?php
}
elseif(isset($_GET['t']))
{
$d=$_GET['d'];
	$t=$_GET['t'];
	$t=trim($t);
//$q3=mysql_query("select * from rec group by district");
if($d=='Mahabubnagar')
						{
							$d_main=$d;
					        $d='Bellary';
                            $t='Sandur';
                          }


 ?>
	<table width="90%" style="width:95%;"  class="responsive"><tr><th width='178px'>District</th><th width='178px'>Taluk</th><th width='178px'>Crop Type</th><th>UREA</th><th>DAP</th><th>MOP</th><th>Gypsum</th><th>Zinc Sulphate</th><th>Agribor</th><th>Borax</th><th style="color:yellow;">SSP</th><th style="color:yellow;">UREA</th><th style="color:yellow;">Gypsum</th><th style="color:yellow;">DAP</th></tr>

<?php

		$q2=mysql_query("select * from rec where district='$d' and taluk='$t' order by crop_type asc");
		$cc=0;$i=1;
		while($r2=mysql_fetch_array($q2))
		{
			$cc++;
			if($i%2==0)
			{
				$td="td_even";
			}
			else
			{
				$td="td_odd";
			}$i++;
			if($d_main=='Mahabubnagar')
									{
										$d=$d_main;
									$user=$_SESSION['user'];


									   $query1=mysql_query("select taluk from users where userid='$user'");
			                          $re1= mysql_fetch_array($query1);
			                          $t=$re1['taluk'];
                          }
						  
			echo "
  <tr class='".$td."'>
		<td>".$d."</td>
		<td>".$t."</td>
		<td>".$r2['crop_type']."</td>
		<td align='center'>".$r2['urea']."</td>
		<td align='center'>".$r2['dap']."</td>
		<td align='center'>".$r2['mop']."</td>
		<td align='center'>".$r2['gypsum']."</td>
		<td align='center'>".$r2['zinc_sulphate']."</td>
		<td align='center'>".$r2['agribor']."</td>
		<td align='center'>".$r2['borax']."</td>
		<td align='center'  style='background-color:#d5dcad;'>".$r2['ssp']."</td>
		<td align='center'  style='background-color:#d5dcad;'>".$r2['ssp_urea']."</td>
		<td align='center'  style='background-color:#d5dcad;'>".$r2['ssp_gypsum']."</td>
		<td align='center'  style='background-color:#d5dcad;'>".$r2['ssp_dap']."</td>
		</tr>";
		}

 ?>
 </table><?php

}
elseif(isset($_GET['d']))
{
	$d=$_GET['d'];
//$q3=mysql_query("select * from rec group by district");


 ?>
	<table width="90%" style="width:95%;"  class="responsive"><tr><th width='178px'>District</th><th width='178px'>Taluk</th><th width='178px'>Crop Type</th><th>UREA</th><th>DAP</th><th>MOP</th><th>Gypsum</th><th>Zinc Sulphate</th><th>Agribor</th><th>Borax</th><th style="color:yellow;">SSP</th><th style="color:yellow;">UREA</th><th style="color:yellow;">Gypsum</th><th style="color:yellow;">DAP</th></tr>

<?php $dc=0;

	$i=1;
if($d='Mahabubnagar')
{
	$d_main=$d;
	$d='Bellary';


}
	$q1=mysql_query("select taluk from rec where district='$d' group by taluk ");

	//echo "select taluk from rec where district='$d' group by taluk ";

	$tc=0;
	while($r1=mysql_fetch_array($q1)){
		$t=$r1['taluk'];$tc++;
		$q2=mysql_query("select * from rec where district='$d' and taluk='$t' order by crop_type asc");

		//echo "select * from rec where district='$d' and taluk='$t' order by crop_type asc";

		$cc=0;
		while($r2=mysql_fetch_array($q2)){
			$cc++;if($i%2==0){$td="td_even";}else{$td="td_odd";}$i++;
			if($d_main=='Mahabubnagar')
						{
							$d=$d_main;
						$user=$_SESSION['user'];


						   $query1=mysql_query("select taluk from users where userid='$user'");
                          $re1= mysql_fetch_array($query1);
                          $t=$re1['taluk'];

						}
			echo "
<tr class-'".$td."'>
		<td >".$d."</td>
		<td>".$t."</td>
		<td>".$r2['crop_type']."</td>
		<td align='center'>".$r2['urea']."</td>
		<td align='center'>".$r2['dap']."</td>
		<td align='center'>".$r2['mop']."</td>
		<td align='center'>".$r2['gypsum']."</td>
		<td align='center'>".$r2['zinc_sulphate']."</td>
		<td align='center'>".$r2['agribor']."</td>
		<td align='center'>".$r2['borax']."</td>
		<td align='center'  style='background-color:#d5dcad;'>".$r2['ssp']."</td>
		<td align='center'  style='background-color:#d5dcad;'>".$r2['ssp_urea']."</td>
		<td align='center'  style='background-color:#d5dcad;'>".$r2['ssp_gypsum']."</td>
		<td align='center'  style='background-color:#d5dcad;'>".$r2['ssp_dap']."</td>
		</tr>";
		}
	}

 ?>
 </table><?php

}else{
 if($_SESSION['user_id']!="admin" && $_SESSION['user_id']!="superadmin"){
		$user=$_SESSION['user_id'];
		$q=mysql_query("select district from users where sno='$user'");
 }else{
$q=mysql_query("select district from rec group by district LIMIT 1,100");
 }
//$q3=mysql_query("select * from rec group by district");


 ?>
	<table width="90%" style="width:95%;"  class="responsive"><tr><th width='178px'>District</th><th width='178px'>Taluk</th><th width='178px'>Crop Type</th><th>UREA</th><th>DAP</th><th>MOP</th><th>Gypsum</th><th>Zinc Sulphate</th><th>Agribor</th><th>Borax</th><th style="color:yellow;">SSP</th><th style="color:yellow;">UREA</th><th style="color:yellow;">Gypsum</th><th style="color:yellow;">DAP</th></tr>

<?php $dc=0;$i=1;
while($r=mysql_fetch_array($q)){
	$d=$r['district'];$dc++;
	$q1=mysql_query("select taluk from rec where district='$d' group by taluk");

	//echo "select taluk from rec where district='$d' group by taluk";

	$tc=0;
	while($r1=mysql_fetch_array($q1)){
		$t=$r1['taluk'];$tc++;
		$q2=mysql_query("select * from rec where district='$d' and taluk='$t' order by crop_type asc");
		$cc=0;

		//echo "select * from rec where district='$d' and taluk='$t' order by crop_type asc";

		while($r2=mysql_fetch_array($q2)){
			$cc++;if($i%2==0){$td="td_even";}else{$td="td_odd";}$i++;
			echo "
<tr class='".$td."'>
		<td >".$d."</td>
		<td>".$t."</td>
		<td>".$r2['crop_type']."</td>
		<td align='center'>".$r2['urea']."</td>
		<td align='center'>".$r2['dap']."</td>
		<td align='center'>".$r2['mop']."</td>
		<td align='center'>".$r2['gypsum']."</td>
		<td align='center'>".$r2['zinc_sulphate']."</td>
		<td align='center'>".$r2['agribor']."</td>
		<td align='center'>".$r2['borax']."</td>
		<td align='center'  style='background-color:#d5dcad;'>".$r2['ssp']."</td>
		<td align='center' style='background-color:#d5dcad;'>".$r2['ssp_urea']."</td>
		<td align='center' style='background-color:#d5dcad;'>".$r2['ssp_gypsum']."</td>
		<td align='center' style='background-color:#d5dcad;'>".$r2['ssp_dap']."</td>
		</tr>";
		}
	}
}
 ?>
 </table><?php
}
?>

</div>


</div> </div>
<?php include 'footer.php';?>