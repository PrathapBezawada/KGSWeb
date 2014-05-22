<?php
session_start();
$activetab="ppackages";
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

 if(isset($_GET['c'])){
 	$clsname="midd_right1";
 }else{
 	$clsname="midd_right2";
 }
 
  ?>

<div class="<?php echo $clsname ?>">
 <div class="main_heads">

 <div>
  <div class="farmer_head">Crop Details(Source for all Package of Practices: UAS, Raichur)
  <!--
    <button type='sumit'name="add" class="new" onclick="window.location='packageuplaod.php';">Add Package</button>
-->

  </div>
  <div class="far_name"><?php if(isset($_GET['c'])){
	$cn=$_GET['c']; $cns=explode(".",$cn);
	array_pop($cns);
	$cs=array_pop($cns);
	echo str_replace("-"," ",$cs);
  } ?></div>
  </div>
   <div class="gr_border"> </div>
  
  

 <div> 
<script type="text/javascript">
$(document).ready(function(){

$('#district').change(function(){
	
	var district=$('#district').val();
	var dataString='district=' + district;
	window.location="ppackages.php?d="+district;
	
}); 
});
</script>
 

<div class="pdfdisplay" style="float:left;">
<?php 
$directory="crops/";
if(isset($_GET['c'])){
	$c=$_GET['c'];
$head = '<a href="ppackages.php">Back to crops</a><br><br>'; 
      echo $head;
			$src = "crops/".$c;
			$content = '<iframe frameborder="0" height="700" width="865" src="'.$src.'"></iframe>';
			echo $content;
}else{
	
	$crops = "<table>";$i=0;$j=0;
		 foreach (scandir($directory) as $file)
		 { 
		   if ('.' === $file) continue;
       if ('..' === $file) continue;
       if($i==0){$crops.="<tr class='td_even'>";$j++;}if($i%2==0){ if($j%2==0){$crops.="</tr><tr class='td_even'>";}else{$crops.="</tr><tr class='td_odd'>";} $j++;}$i++;
	   $file_name = basename($file, ".pdf");
	   $crops.= "<td width='575px' align='center'><a href='ppackages.php?c={$file}'>{$file_name}</a></td>";
     }
     $crops.="</tr></table>";
	echo $crops;
}
?>
</div>
 


</div>  </div>
</div>
<?php include 'footer.php';?>