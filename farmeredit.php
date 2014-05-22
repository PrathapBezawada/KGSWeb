<?php 
error_reporting(E_ALL);

$activetab="farmar";
include 'header.php';
$sno=$_GET['sno'];
$query=mysql_query("select * from farmers where sno='$sno'");
$result=mysql_fetch_object($query);
?>
<script type="text/javascript" src="js/jquery-1.5.1.js"></script>
<script type="text/javascript" src="js/jquery.validate.js"></script>
<script type="text/javascript">
$(document).ready(function(){

$('#district').click(function(){
	
	var district=$('#district').val();
	var dataString='district=' + district;
	$.ajax({
		data: dataString,
		type: "POST",
		url: 'place.php',
		success:function(response){
			
			$('#taluk').html(response);
		}
	
	
	});
});
$('#taluk').click(function(){
	
	var taluk=$('#taluk').val();
	var dataString='taluk=' + taluk;
	$.ajax({
		data: dataString,
		type: "POST",
		url: 'place.php',
		success:function(response){
			$('#hobli').html(response);
		}
	
	
	});
});
$('#hobli').click(function(){
	var hobli=$('#hobli').val();
	var dataString='hobli=' + hobli;
	$.ajax({
		data: dataString,
		type: "POST",
		url: 'place.php',
		success:function(response){
			$('#village').html(response);
		}
	
	
	});
});


$("#farmer_form").validate({
	      rules:
	      {
	      fname:
	      {
	      required: true,
	      minlength: 1
	      },
	      lname: 
	         {
	         required: true,
	         minlength: 1
	       },
	        
	        
	     mobile: 
	     {
	     required: true,
	     minlength: 10
	     },
	    
	     
	     district:
	     {
	      required: true,
	     },
	     hobli:
	     {
	     required: true,
	     },
	     taluk:
	     {
	     required: true,
	     },
	     village: 
	     {
	     required: true,
	     },
	     
	     
	      },
	    messages:
	    {
	    	fname:"required",
	    	lname:"required", 
	    	mobile:"required",
	    	district:"required",
	    	hobli:"required", 
	    	taluk:"required",
	    	village:"required", 
	    }

	    
	    });
	    
	    
	    
	    
	    $("#Farmer_Save").click(function(e)
			{
					var ta=$("#area_total").val();
					var rainfed=$("#rainfed").val();
					var irrigated= $("#irrigated").val(); 
					var plantation=$("#plantation").val();
					var fallow=$("#fallow").val();
					
				//	var total=parseInt(rainfed)+parseInt(irrigated)+parseInt(plantation)+parseInt(fallow);
				var total=(+rainfed)+(+irrigated)+(+plantation)+(+fallow);
				
			
			
	   if(ta!=total)
			   {
			   e.preventDefault();
				 alert('total farm area should be equal to sum of all other areas');

			   
			   }
			   
			   else
			   {
			   
			   	
			   
			   }
			   
			});
	    
	    $("#Farmer_Save1").click(function(e)
						{
								var ta=$("#area_total").val();
								var rainfed=$("#rainfed").val();
								var irrigated= $("#irrigated").val(); 
								var plantation=$("#plantation").val();
								var fallow=$("#fallow").val();
								
							//	var total=parseInt(rainfed)+parseInt(irrigated)+parseInt(plantation)+parseInt(fallow);
							var total=(+rainfed)+(+irrigated)+(+plantation)+(+fallow);
						  
						   if(ta!=total)
						   {
						     
						  e.preventDefault();
						  alert('toatal farm area should be equal to sum of all other areas');
						
						   }
						   
			});
	    




});




function isNumber(evt)
{
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

<div class="midd_right1">

 <div class="main_heads">
  <div class="farmer_head"> Farmer Edit </div>
  <form action="farmerdetails.php" method="POST" id="farmer_form" enctype="multipart/form-data">
  <div class="btn_m">
  <?php if(isset($_GET['n'])){ $redirect_url="farmerslist.php";}else{$redirect_url="farmerdetails.php?sno=$sno"; }?>
  <?php if(isset($_GET['m'])){ $redirect_url="farmerresult.php";}else{$redirect_url="farmerdetails.php?sno=$sno"; }?>
  <button type="submit" name="submit" class="new" id="Farmer_Save">Save</button><button type="reset" name="cancel" class="new" onclick="window.location='<?php echo $redirect_url ?>';">Cancel</button> </div>
  
  <div class="gr_border">
  
  
  </div>
  
<div class="deta_head"> Farmer Details: </div>
<div class="form_mainf">
<div class="form_mainleft">
  <div class="form_main1">
  <span class="form_left">* First Name
  </span>
  <?php if(isset($_GET['n'])){?> <input type="hidden" name="n" value="<?php echo "n" ?>" ><?php } ?>
  <?php if(isset($_GET['m'])){?> <input type="hidden" name="m" value="<?php echo "m" ?>" ><?php } ?>
  <input type="text" name="fname"  value="<?php echo $result->fname?>" class="txt_box" maxlength="50">
  <input type="hidden" name="sno" value="<?php echo $sno ?>" >
  
  </div>
  <div class="form_main1">
  <span class="form_left">* Last Name

  </span>
  
    <input type="text" name="lname"  value="<?php echo $result->lname?>" class="txt_box"> maxlength="50"
  
  
  </div>
   <div class="form_main1">
  <span class="form_left"> Gender

  </span>
  
    <select class="drop_box" name="gender"> 
     <option value="Male" <?php if($result->gender=="Male") echo "selected"; ?>> Male </option>  
    <option value="Female" <?php if($result->gender=="FEmale") echo "selected"; ?>> Female </option>  </select>  
  
  </div>
  <div class="form_main1">
  <span class="form_left"> Father Name

  </span>
  
    <input type="text" name="fatname"  value="<?php echo $result->fatname?>" class="txt_box" maxlength="50">
  
  
  </div>
  
  <div class="form_main1">
  <span class="form_left">* Mobile #

  </span>
  
    <input type="text" name="mobile"  value="<?php echo $result->mobile?>" class="txt_box" maxlength="15" onkeypress="return isNumber(event)">
 
  </div>
  
  <div class="form_main1">
  <span class="form_left"> Telephone #

  </span>
  
    <input type="text" name="telephone"  value="<?php echo $result->telephone?>"  class="txt_box" maxlength="15" onkeypress="return isNumber(event)">
  
  </div>
  <div class="form_main1">
  <span class="form_left"> Caste

  </span>
  
    <select name="caste" class="drop_box"  >  <option value=''> --- Select --- </option> 
     <option value="SC" <?php if($result->caste=="SC") echo "selected"; ?>> SC </option>  
     <option value="ST" <?php if($result->caste=="ST") echo "selected"; ?>> ST </option> 
      <option value="OBC" <?php if($result->caste=="OBC") echo "selected"; ?>> OBC </option> 
       <option value="General" <?php if($result->caste=="General") echo "selected"; ?>> Gen </option> </select>  
  
  </div>
  <div class="form_main1">
  <span class="form_left"> Change/Upload Image

  </span>
  
    <input type="file" name="image" value="Upload"  class="txt_box">
  
  
  </div>
  
  <?php
	  if($_SESSION['user_id']=="admin")
	  {
	   ?>
	   
	   <div class="form_main1">
		  <span class="form_left"> Farm Facilitator
		
		  </span>
		  
		    <select name="ff" class="drop_box"  >  
		    <option value=""> --- FF --- </option> 
		    <?php
		    
		    $query=mysql_query("select fname from users where role='FF'");
		    while($result_=mysql_fetch_array($query))
		    {
		    
		    ?>
		    	     <option value="<?php echo $result_['fname'] ?>"> <?php echo $result_['fname']?> </option>
		     <?php
		     
		     }
		     ?>
		     </select>  
					  
	  </div>
		    <?php
		     
		    }
		    
	    ?>
  
  
   </div>
   
   <div class="form_mainright">
  
    <div class="form_main1">
  <span class="form_left"> Address

  </span>
  
 <textarea name="address" cols="" rows=""  class="txt_box"><?php echo $result->address?></textarea>
  
  
  </div>
        <div class="form_main1">
  <span class="form_left">* District 


  </span>
  <!--
  
  <select name="district" id="district" class="txt_box1">
  <option value="">--district--</option>
  <?php $query1=mysql_query("select * from district group by district_name");
  	while($result1=mysql_fetch_array($query1)){
	?>
	<option value="<?php echo $result1['district_name'] ?>" <?php if($result->district==$result1['district_name']){ echo "selected"; }?>><?php echo $result1['district_name'] ?></option>
	
	<?php	
		
	}
	
  ?>
  </select>-->
  
      <input type="text" name="district"  value="<?php echo $result->district?>"  class="txt_box" readonly>

  
  
  </div>
   <div class="form_main1">
  <span class="form_left">* Taluk 


  </span>
  <!--
   
  <select name="taluk" id="taluk" class="txt_box1">
  <option value="<?php echo $result->taluk?>"><?php echo $result->taluk?></option>
  
  </select>-->
  
        <input type="text" name="taluk"  value="<?php echo $result->taluk?>"  class="txt_box" readonly>

  </div>
  <div class="form_main1">
  <span class="form_left">* Hobli


  </span>
  
   
  <select name="hobli" id="hobli" class="txt_box1">
  <option value="<?php echo $result->hobli?>"><?php echo $result->hobli?></option>
  
  
  
  
  
  </select>
  </div>
   <div class="form_main1">
  <span class="form_left">* Village


  </span>
  
  
  <select name="village" id="village" class="txt_box1">
  <?php $villages=explode(",",$result->village);
  		foreach($villages as $village){
   ?>
  <option value="<?php echo $village?>" selected="selected"><?php echo $village?></option>
  <?php } ?>
  
  </select>
  </div>
  
  
  
	  <div class="form_main1">
	  <span class="form_left"> ID type
	
	  </span>
	  
  <select name="id_type" id="id_type" class="txt_box1" >
   <?php
   $idtype_arr=array('AdharCard','Driving License','DrivingLicense','PAN Card','Passport','RationCard','VoterCard');

   foreach($idtype_arr as $id_type)
	 {
	 ?>
	 
	 <option value='<?php echo $id_type?>'<?php  if($id_type==$result->ID_type){ echo 'selected';}?>><?php echo $id_type ?></option>
	 
	 <?php
	 }
   ?>

<!--
   <option value="Adhar Card">Adhar Card</option>
   <option value="Driving License">Driving License</option>
   <option value="PAN Card">PAN Card</option>
   <option value="Passport">Passport</option>
   <option value="Ration Card">Ration Card</option>
   <option value="Voter Card">Voter Card</option>	  </div>
-->
  </select>
  </div>
	  <div class="form_main1">
	  <span class="form_left"> ID #
	
	  </span>
	   <input type="text" name="id_no"  value="<?php echo $result->ID_no?>"  class="txt_box" maxlength="50">
	 </div>
    

    
  
  <!--
     <div class="form_main1">
  <span class="form_left"> Pin Code


  </span>
  
   <input type="text" name="pincode"  value="<?php echo $result->pincode?>" class="txt_box">
  
  </div>
 -->
  </div> </div>
  <div class="deta_head"> Farmer Information: </div>
  <div class="form_mainf">
<div class="form_mainleft">
  <div class="form_main1">
  <span class="form_left"> Area total(acre)
  </span>
  
    <input type="text" name="area_total" id="area_total" value="<?php echo $result->area_total?>" class="txt_box" onkeypress="return isNumber(event)">
  
  
  </div>
  <div class="form_main1">
  <span class="form_left">  Rainfed (acre)

  </span>
  
    <input type="text" name="rainfed" id="rainfed" value="<?php echo $result->rainfed?>" class="txt_box" onkeypress="return isNumber(event)">
  
  
  </div>
  <div class="form_main1">
  <span class="form_left"> Irrigated (acre)

  </span>
  
    <input type="text" name="irrigated" id="irrigated" value="<?php echo $result->irrigated?>" class="txt_box" onkeypress="return isNumber(event)">
  
  
  </div>
  
   
  
   
   
   </div>
   
   <div class="form_mainright">
  
     
  
       
  
       <div class="form_main1">
  <span class="form_left">  Plantation (acre)


  </span>
  
   <input type="text" name="plantation" id="plantation"  value="<?php echo $result->plantation?>" class="txt_box" maxlength="15" onkeypress="return isNumber(event)">
  
  </div>
         <div class="form_main1">
  <span class="form_left"> Fallow (acre)


  </span>
  
   <input type="text" name="fallow" id="fallow" value="<?php echo $result->fallow?>"  class="txt_box" maxlength="15" onkeypress="return isNumber(event)">
  
  </div>
           <div class="form_main1">
  <span class="form_left"> Survey No


  </span>
  
   <input type="text" name="surveyno"  value="<?php echo $result->surveyno?>" class="txt_box" maxlength="15">
  
  
  
   <div class="form_main1">
		  <span class="form_left"> Farmer Latitude
		
		
		  </span>
		  
		   <input type="text" name="farmer_lat" value="<?php echo $result->Loc_Lat?>"  class="txt_box" maxlength="15">
		  
	  </div> <div class="form_main1">
	  <span class="form_left"> Farmer Longitude
	
	  </span>
	  
	  
	   <input type="text" name="farmer_long" value="<?php echo $result->Loc_Long?>"   class="txt_box" maxlength="15">
	  
  </div>
  
  
  
  </div>
 <div class="btn_ali" >
 
   <button type="submit" name="submit" class="new" id="Farmer_Save1">Save</button><button type="reset" name="cancel" class="new" onclick="window.location='<?php echo $redirect_url ?>';">Cancel</button>
    </div>
    </div>
  </div> 
  
  </form>
  </div> </div>
  
<?php include 'footer.php'; ?>