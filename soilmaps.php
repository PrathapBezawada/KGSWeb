<?php
session_start();
$activetab="home";
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
<?php 
if(isset($_GET['d'])){
$clsname="midd_right1";
}else{
$clsname="midd_right1";
}
?>

<div class="<?php echo $clsname ?>">
 <div class="main_heads">
 <link rel="stylesheet" href="colorbox.css" />
		<script src="js/jquery.colorbox.js"></script>
		<script>
			$(document).ready(function(){
				//Examples of how to assign the Colorbox event to elements
				$(".group1").colorbox({rel:'group1'});
				
			});
		</script>
<script type="text/javascript">
$(document).ready(function(){

$('#district').change(function(){
	
	var district=$('#district').val();
	var dataString='district=' + district;
	if(district!=""){
	window.location="soilmaps.php?d="+district;
	}else{
	window.location="soilmaps.php";
	}
	
});
 
});

</script>
<div style="float:left;margin-left:10px;">
<div style="margin-top:5px"><span style="float:left; font-size:12px;">Soil Maps</span>
 <span class="form_right" style="float:left;margin-bottom:5px;margin-top:-6px"> <select name="district" id="district" class="txt_box1">
  <option value="">--Select District--</option>
  <?php if(isset($_GET['d'])){$d=$_GET['d'];} ?>
  <?php 
 if($_SESSION['user_id']!="admin"){
		$user=$_SESSION['user_id'];
		$query=mysql_query("select district from users where sno='$user' order by district");
		while($result=mysql_fetch_array($query)){
	?>
	<option value="<?php echo $result['district'] ?>" <?php if($result['district']==$d){ echo "selected";} ?>><?php echo $result['district'] ?></option>
	
	<?php	
		
	}
 }else{
  $query=mysql_query("select * from district order by district_name");
  while($result=mysql_fetch_array($query)){
	?>
	<option value="<?php echo $result['district_name'] ?>" <?php if($result['district_name']==$d){ echo "selected";} ?>><?php echo $result['district_name'] ?></option>
	
	<?php	
		
	}
	
 
 } ?>
 
  </select>
   </span>
   <div style="float:left; width:520px; font-size:12px;">
   <?php
   if(isset($_GET['d'])){
	$d=$_GET['d'];
   	echo $d." <b>District Soil Maps</b>";
   }else{
		echo "<b>Karnataka State Map</b>";  
	}
   ?>
   </div>
   <!--
     <button type="submit" name="submit" onclick="window.location='soilmap_upload.php';" class="new">Add New soil map</button>
    -->
   </div>
</div>
<div class="gr_border"> </div>
<div class="mapsdisplay" style="margin-top:30px">
<?php 
if(isset($_GET['d'])){
	$d=$_GET['d'];
	
	$directory="maps/".$d."/";
	$crops = "";$n=1;
		 foreach (scandir($directory) as $file)
		 { 
		   if ('.' === $file) continue;
       if ('..' === $file) continue;
	   
       $file_name = basename($file, ".pdf");
	   $exts=explode(".",$file_name);
	   $ext=array_pop($exts);
	   if($ext!="jpg") continue;
	   $f=implode(".",$exts);
	   $exts=explode("_",$f);
	   $f=ucwords(array_pop($exts));
	   $dct=str_replace("","",$directory);
       $crops.= "<div style='float:left;margin-right:25px;width:250px;'><div id='map-".$n."' style='margin-left:70px;margin-top:10px'> {$f}</div>";
	   $crops.= "<div id='maps-".$n."' class='maps'> <a class='group1' title='$f Map of $d' href='".$dct.$file_name."'> <img width='200' height='200' src='".$dct.$file_name."' ></a></div></div>";
	   $n++;
     }
     
	echo $crops;
}else{
	?>
    <div class="map_i"><img src="img/karnatakamap.JPG" /></div>
	<?php
	}
?>
</div>
<?php 


?>



</div> 
</div>
<?php include 'footer.php';?>