
<?php
 include 'header.php';
 
?>
<style>
label.error { float: none; color: red; padding-left: .5em; vertical-align: top; }
</style>
<?php
    
	 $district=$_POST['district'];
	    $taluk=$_POST['taluk'];
	    $crop_type=$_POST['crop_type'];
	    $urea=$_POST['urea'];
	    $dap=$_POST['dap'];
	    $mop=$_POST['mop'];
	    $gypsum=$_POST['gypsum'];
	    $zinc_sulphate=$_POST['zinc_sulphate'];
	    $agribor=$_POST['agribor'];
	    $borax=$_POST['borax'];
	    $ssp=$_POST['ssp'];
	    $ssp_urea=$_POST['ssp_urea'];
	    $ssp_gypsum=$_POST['ssp_gypsum'];
	    $ssp_dap=$_POST['ssp_dap'];
	 
 
	   $insert="insert into rec (`district`,`taluk`,`crop_type`,`urea`,`dap`,`mop`,`gypsum`,`zinc_sulphate`,`agribor`,`borax`,`ssp`,`ssp_urea`,`ssp_gypsum`,`ssp_dap`) values ('$district','$taluk','$crop_type','$urea','$dap','$mop','$gypsum','$zinc_sulphate','$agribor','$borax','$ssp','$ssp_urea','$ssp_gypsum','$ssp_dap')";
	  // echo $insert;
	  // $result=mysql_query($insert);

   

?>
   <br></br><div>Successfully saved</div>
  <a href="http://krishigyansagar.com/add_rec.php">Add New</a>