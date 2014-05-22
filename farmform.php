<?php 
session_start();
//$activetab="home";
include 'header.php'; 
include 'dbcon.php';

?>
<script type="text/javascript" src="js/jquery-1.5.1.js"></script>
<script type="text/javascript" src="js/jquery.validate.js"></script>
<script type="text/javascript">
$(document).ready(function(){
/*$("#userform").validate({
  rules: {
    userid: {
      required: true,
      number: true
    }
  },messages:{
  	userid:{
		number:"User id must be numeric"
		}
  }
});*/
$('#district').change(function(){
	
	var district=$('#district').val();
	var dataString='district=' + district;
	$.ajax({
		data: dataString,
		type: "POST",
		url: 'place.php',
		success:function(response){
			
			$('#taluk').append(response);
		}
	
	
	});
});
$('#taluk').change(function(){
	
	var taluk=$('#taluk').val();
	var dataString='taluk=' + taluk;
	$.ajax({
		data: dataString,
		type: "POST",
		url: 'place.php',
		success:function(response){
			$('#hobli').append(response);
		}
	
	
	});
});
$('#hobli').change(function(){
	var hobli=$('#hobli').val();
	var dataString='hobli=' + hobli;
	$.ajax({
		data: dataString,
		type: "POST",
		url: 'place.php',
		success:function(response){
			$('#village').append(response);
		}
	
	
	});
});
/*
$("input[id*='_*']").keyup(function(){
    var val = $(this).val();
    if(isNaN(val)){
         val = val.replace(/[^0-9\.]/g,'');
         if(val.split('.').length>2) 
             val =val.replace(/\.+$/,"");
    }
    $(this).val(val); 
});

*/




	$("#farm_form").validate({
	      rules:
	      {
					
					farmname:
					{
					 maxlength:50
					},
					crvariety:
					{
						maxlength:50
					},
					
					farmarea:
					{
						required: true,
						minlength: 1,
						maxlength:15
					},
					carea: 
						 {
						 required: true,
						 minlength: 1,
						 maxlength:15
					 },
					 
					 flat:
					 {
					 
					  maxlength:50
					 },
					 flong:
					 {
					  maxlength:50
					 
					 }
	      },
	    messages:
	    {
	    
	    
	    	farmname:
				{
					 maxlength:"Should not exceed 50 digits",
				},
				crvariety:
					{
						maxlength:"Should not exceed 50 digits",
					},
	    
	    	farmarea:
	    	{
	    	 required : " required",
										            minlength : "At least 1 digits long",
										            maxlength : "Should not exceed 15 digits",
			   
	    	},
	    	carea:{
	    	
	    	 required : " required",
										            minlength : "At least 1 digits long",
										            maxlength : "Should not exceed 15 digits",
			   
	    	
	    	},
	     flat:
				{

				  maxlength:"Should not exceed 50 digits",
				},
				flong:
				{
				  maxlength:"Should not exceed 50 digits",

				}
		}

	    
	  });

});





function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    keychar = String.fromCharCode(charCode);
    
    if (charCode > 31 && (charCode < 48 || charCode > 57) && (keychar!='.')) 
    {
        return false;
    }
    return true;
}



</script>
<?php 
	if(isset($_POST['submit'])){
		$farmname=$_POST['farmname'];
		$farmarea=$_POST['farmarea'];
		$carea=$_POST['carea'];
		$crname=$_POST['crname'];
		$village=$_POST['village'];
		$fid=$_POST['fid'];
		$crvariety=$_POST['crvariety'];
		$fields=$_POST['fields'];
		$flat=$_POST['flat'];
		$flong=$_POST['flong'];
		
		mysql_query("INSERT INTO `farms` (`fid`, `farm_name`, `total_farm_area`, `cultivation_area`, `crop_name`, `village`, `del`, `fields`, `crop_variety`,`farm_lat`,`farm_long`) VALUES ('$fid', '$farmname', '$farmarea', '$carea', '$crname', '$village', '0', '$fields', '$crvariety','$flat','$flong');") or die(mysql_error());
		$id=mysql_insert_id();
		$query1=mysql_query("select * from farmers where sno='$fid'");
		$result1=mysql_fetch_object($query1);
		$district=$result1->district;
		$taluk=$result1->taluk;
		$query2=mysql_query("select * from rec where district='$district' and taluk='$taluk' and crop_type='$crname'") or die(mysql_error());
		if(mysql_num_rows($query2)>0){
		$result2=mysql_fetch_array($query2);
		$urea=$result2['urea'];
		$dap=$result2['dap'];
		$mop=$result2['mop'];
		$gypsum=$result2['gypsum'];
		$zinc_sulphate=$result2['zinc_sulphate'];
		$borax=$result2['borax'];
		$ssp=$result2['ssp'];
		$ssp_urea=$result2['ssp_urea'];	
		$ssp_gypsum=$result2['ssp_gypsum'];	
		$ssp_dap=$result2['ssp_dap'];
	
		}
		else{
		$urea="";
		$dap="";
		$mop="";
		$gypsum="";
		$zinc_sulphate="";
		$borax="";
		$ssp="";
		$ssp_urea="";	
		$ssp_gypsum="";	
		$ssp_dap="";
		}
		$date=date('Y-m-d');
		

  mysql_query("insert into farmer_rec (farmer_id,field_id,urea,dap,mop,gypsum,zinc_sulphate,borax,ssp,ssp_urea,ssp_gypsum,ssp_dap,date) values ('$fid','$id','$urea','$dap','$mop','$gypsum','$zinc_sulphate','$borax','$ssp','$ssp_urea','$ssp_gypsum','$ssp_dap','$date')")or die(mysql_error());
		//echo $id;
		
		
		header("location:farmerdetails.php?sno=$fid");
	
	}
?>

<div class="midd_right2">
 <div class="main_heads">
 <?php 
 if(isset($_GET['fid'])){
 $fid=$_GET['fid']; ?>
  <div class="farmer_head">Farm Form  </div>
  <form action="" method="post" id="farm_form" name='farm_form'>
  <div class="btn_m">
  <button type="submit" name="submit" class="new">Save</button>
  <button type="reset" name="cancel" class="new" onclick="window.location='farmerdetails.php?sno=<?php echo $fid ?>';">Cancel</button> 
  </div>
  
  <div class="gr_border">
  
  
  </div>
<div class="deta_head"> Farm Details(In Acres): </div>

<div class="form_mainf">
<div class="form_mainleft">

  <div class="form_main1">
  <span class="form_left"> Farm Name
  </span>
  
    <input type="text" name="farmname" class="txt_box" maxlength="50">
  	<input type="hidden" name="fid" value="<?php echo $fid ?>"  />
  
  </div>
  
  
  <!--
  <div class="form_main1">
  <span class="form_left"> # Fields

  </span>
  
    <input type="text" name="fields" class="txt_box">
  
  
  </div>
  -->
  <div class="form_main1">
  <span class="form_left">* Total Farm Area

  </span>
  
    <input type="text" name="farmarea" id="farmarea_*" class="txt_box"  maxlength="15" class="txt_box" onkeypress="return isNumber(event)">
  
  
  </div>
  
  <div class="form_main1">
  <span class="form_left">* Cultivation Area

  </span>
  
    <input type="text" name="carea" id="carea_*" class="txt_box" class="txt_box" maxlength="15" onkeypress="return isNumber(event)">
  
  
  </div>
  
    <div class="form_main1">
	  <span class="form_left"> Crop Name
	
	  </span>
	  
	    <select name="crname" class="txt_box">
	    <option value="">--Crop--</option>
	    <?php
	    $query=mysql_query("select district,taluk from farmers where sno='$fid'");
	    $result=mysql_fetch_array($query);
	     $d=$result['district'];
	    $t=$result['taluk'];
	    $q1=mysql_query("select * from rec where district='$d' and taluk='$t' group by crop_type");
	    
	    //echo "select * from rec where district='$d' and taluk='$t' group by crop_type";
			while($r1=mysql_fetch_array($q1))
			{
				echo "<option value='".$r1['crop_type']."'>".$r1['crop_type']."</option>";	
			}
		?>
	    </select>
	  
	  
  </div>
  
    
   </div>
   
   <div class="form_mainright">
  
  <div class="form_main1">
  <span class="form_left"> Crop Variety

  </span>
  
    <input type="text" name="crvariety" class="txt_box" maxlength="50">
  
  
  </div>
  
  <div class="form_main1">
  <span class="form_left"> Village

  </span>
  
    <select name="village" class="txt_box">
    <option value="">--village--</option>
    
    <?php 
  
			$q=mysql_query("select district,taluk,hobli from farmers where sno='$fid'");
		  $result=mysql_fetch_array($q);
			$dist=$result['district'];
			$taluk=$result['taluk'];
			$hobli=$result['hobli'];
		
			
			$query=mysql_query("select district_id from district where district_name='$dist'");
			
			//echo "select district_id from district where district_name='$dist'<br>";
			$result=mysql_fetch_array($query);
			$dist_id=$result['district_id'];
			
			$query=mysql_query("select taluk_id from taluk where taluk_name='$taluk' and district_id='$dist_id'");
			$result=mysql_fetch_array($query);
			$taluk_id=$result['taluk_id'];
			//echo "select taluk_id from taluk where taluk_name='$taluk' and district_id='$dist_id'<br>";
			
			$query=mysql_query("select hobli_id from hobli where taluk_id='$taluk_id' and hobli_name='$hobli'");
			$result=mysql_fetch_array($query);
			
			//echo "select hobli_id from hobli where taluk_id='$taluk_id' and hobli_name='$hobli'<br>";
		
			$hobli_id=$result['hobli_id'];
			//echo "hobli".$hobli_id."<br>";
			
			$query=mysql_query("select village_name from village where hobli_id='$hobli_id'");
			
			
			if(mysql_num_rows($query)>0)
			{
 				while($result=mysql_fetch_array($query))
	    {
			
		?>
    <option value="<?php echo $result['village_name']; ?>"> <?php echo $result['village_name']; ?></option>
    <?php 
       }}
     	?>
    
    </select>
  
  
  </div> 
   <div class="form_main1">
	  <span class="form_left"> Farm Latitude
	
	  </span>
	  
	    <input type="text" name="flat" class="txt_box" maxlength="15">
	  
	  
  </div> <div class="form_main1">
  <span class="form_left"> Farm Longtude

  </span>
  
    <input type="text" name="flong" class="txt_box" maxlength="15">
  
  
  </div>
   
  </div> </div>
 
   <div class="btn_ali" style="margin-left:733px;">
    <button type="submit" name="submit" class="new">Save</button>
  <button type="reset" name="cancel" class="new" onclick="window.location='farmerdetails.php?sno=<?php echo $fid ?>';">Cancel</button> </div>
 </form>  
<?php } 
?>  
  
  </div> </div>
  
  <?php include 'footer.php'; ?>