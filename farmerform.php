<?php 
$activetab="farmar";
include 'header.php';
?>
<style>
label.error { float: none; color: red; padding-left: .5em; vertical-align: top; }
</style>
<script type="text/javascript" src="js/jquery-1.5.1.js"></script>
<script type="text/javascript" src="js/jquery.validate.js"></script>
<script type="text/javascript">
$(document).ready(function(){

$('#district_').change(function(){

var selectdis= $("#district_ option:selected").text();
			
	var district=$('#district_').val();

	var dataString='district=' + district;
	
	
	$.ajax({
		data: dataString,
		type: "POST",
		url: 'place.php',
		success:function(response)
		{
			$('#taluk_').html(response);
			$("#defualt").hide();

		}
	
	
	});
});
$('#taluk_').click(function(){
	
	var taluk=$('#taluk_').val();
	
	var dataString='taluk=' + taluk;
	$.ajax({
		data: dataString,
		type: "POST",
		url: 'place.php',
		success:function(response){
			
			$('#hobli').html(response);
			$("#defualt").hide();
			$("<option>Select village</option>", {value: "default"}).appendTo('#village');

			
		}
	
	
	});
});
$('.jdatlks').click(function(){
	
	var taluk=$('.jdatlks').val();
	
	var dataString='taluk=' + taluk;
	//alert(dataString)
	$.ajax({
		data: dataString,
		type: "POST",
		url: 'place.php',
		success:function(response){
			

			$('.jdahobli').html(response);
			$("#defualt").hide();
			
		}
	
	
	});
	
	
	
		
});



$('.jdahobli').click(function(){
	
	var hobli=$('.jdahobli').val();
	var taluk=$('.jdatlks').val();

	var dataString='hobli_name=' + hobli+'&taluk_name='+taluk;
	$.ajax({
		data: dataString,
		type: "POST",
		url: 'place.php',
		success:function(response){
			
			$('.jdavillage').html(response);
			$("#defualt").hide();

		}
	
	
	});
});


$('.jdavillage').click(function(){
	$("#defualt").hide();

});


$('#hobli').change(function(){
	var hobli=$('#hobli').val();
	var taluk=$('#taluk_').val();

	//alert('hobli');
	if(hobli.indexOf('&') === -1)
	{
	var dataString='hobli_name=' + hobli+'&taluk_name='+taluk;
	}
	else
	{
	var hobli_arr=hobli.split("&"); 
	var dataString='hobli='+hobli_arr[0]+'&hobli1='+hobli_arr[1]+'&taluk_name='+taluk;;
	
	}
	
	$("#village").click(function(){
		$("#defualt").hide();
	
});
	//alert(dataString)
	
	$.ajax({
		data: dataString,
		type: "POST",
		url: 'place.php',
		success:function(response){
	//alert(response)
			$('#village').html(response);
			$("#defualt").hide();
		}
	
	
	});
		});
	
	
	
  
	 
	
	
	$("#farmer_form").validate({
	      rules:
	      {
	      fname:
	      {
	      required: true,
	      minlength: 1,
	      maxlength:50
	      },
	      lname: 
	         {
	         required: true,
	         minlength: 1,
	      maxlength:50
	       },
	        
	        
	     mobile: 
	     {
	     required: true,
	     phonevalidation: true,
	     minlength: 10,
	      maxlength:15
	     },
	     telephone:
	     {
				 minlength : 10,
				 maxlength : 15
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
	     id_no:
	     {
	       minlength : 3,
			   maxlength : 50
	     
	     },
	     fatname:
	     {
				 minlength : 3,
				 maxlength : 50
			 	     
	     },
	     
	     
	     
	    	     
	   },
	    messages:
	    {
	    
	     fname : {
						            required : " required",
						            maxlength : "Should not exceed 50 characters",
			             },
	   	
	    	lname: {
						            required : " required",
						            maxlength : "Should not exceed 50 characters",
			             }, 
	    	mobile: {
						            required : " required",
						            minlength : "Min 10 digits",
						            maxlength : "Should not exceed 15 digits",
			             },
			  		
					     
				
	     
	    	district:
	    	{
	    		required : " required",
	    	},
	    	hobli:
	    	{
	    		required : " required",
	    	},
	    	
	    	taluk:
	    	{
	    		required : " required",
	    	},
	    	village:
	    	{
	    		required : " required", 
	     }
   }
 });
	    
	    
	    
	     $.validator.addMethod("phonevalidation",
			           function(value, element) {
			                   return /^[A-Za-z\d=#$%@_ -]+$/.test(value);
			           },
			   "Please enter a valid phone number."
   );
	    
	    
	    
	        
	    $("#Farmer_Save").click(function(e)
			{
			
				
				 var ta=$("#area_total").val();
					var rainfed=$("#rainfed").val();
					var irrigated= $("#irrigated").val(); 
					var plantation=$("#plantation").val();
					var fallow=$("#fallow").val();
					//alert("ta is"+ta);
				//	var total=parseInt(rainfed)+parseInt(irrigated)+parseInt(plantation)+parseInt(fallow);
				var total=(+rainfed)+(+irrigated)+(+plantation)+(+fallow);
			  // alert("total is"+total);
			  
			   if(ta!=total)
			   {
			     
			  e.preventDefault();
			   alert('toatal farm area should be equal to sum of all other areas');
			
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

<div class="midd_right1">

 <div class="main_heads">
  <div class="farmer_head">New Farmer </div>
  <form action="farmerdetails.php" name="farmer_form" id="farmer_form" method="post" enctype="multipart/form-data">
  <div class="btn_m">
  <button type="submit" name="submit" id="Farmer_Save" class="new">Save</button><button type="reset" name="cancel" class="new" onclick="window.location='farmerslist.php';">Cancel</button>
  </div>
  
  <div class="gr_border">
  
  
  </div>
  
<div class="deta_head"> Farmer Details: </div>
<div class="form_mainf">
<div class="form_mainleft">
  <div class="form_main1">
  <span class="form_left">* First Name
  </span>
  
    <input type="text" name="fname"  class="txt_box" maxlength="50">
  
  
  </div>
  <div class="form_main1">
  <span class="form_left">* Last Name

  </span>
  
    <input type="text" name="lname"  class="txt_box" maxlength="50">
  
  
  </div>
  <div class="form_main1">
  <span class="form_left"> Gender

  </span>
  
    <select name="gender" class="drop_box"><option value="Male">Male</option><option value="Female">Female</option></select>
  
  
  </div>
  <div class="form_main1">
  <span class="form_left"> Father Name

  </span>
  
    <input type="text" name="fatname"  class="txt_box" maxlength="50">
  
  
  </div>
  
  <div class="form_main1">
  <span class="form_left">* Mobile #

  </span>
  
    <input type="text" name="mobile" maxlength="15"  class="txt_box" onkeypress="return isNumber(event)">
  
  
  </div>
  
  <div class="form_main1">
  <span class="form_left"> Telephone #

  </span>
  
    <input type="text" name="telephone"  class="txt_box"  maxlength="15" onkeypress="return isNumber(event)">
  
  
  </div>
  <div class="form_main1">
  <span class="form_left"> Caste

  </span>
  
    <select name="caste" class="drop_box"  >  <option value=''> --- Select --- </option> 
     <option value="SC"> SC </option>  
     <option value="ST"> ST </option> 
      <option value="OBC"> OBC </option> 
       <option value="General"> Gen </option> </select>  
  
  </div>
  <div class="form_main1">
  <span class="form_left"> Upload Image

  </span>
  
    <input type="file" name="image" value="Upload"  class="txt_box">
  
  
  </div>
  
   <div class="form_main1">
	  <span class="form_left"> Farm Facilitator
	
	  </span>
	  
	    <select name="ff" class="drop_box"  >  
	    <option value=""> --- FF --- </option> 
	    <?php
	    
	    $query=mysql_query("select fname from users where role='FF'");
	    while($result=mysql_fetch_array($query))
	    {
	    
	    ?>
	    	     <option value="<?php echo $result['fname'] ?>"> <?php echo $result['fname']?> </option>
	     <?php
	     
	     }
	     ?>
	     </select>  
				  
  </div>
	      
  
   </div>
   
   <div class="form_mainright">
  
    <div class="form_main1">
  <span class="form_left"> Address

  </span>
  
 <textarea name="address" cols="" rows=""  class="txt_box"></textarea>
  
  
  </div>
       
  
   <?php
   $userid=$_REQUEST['user'];
   $dist='';
   $taluk='';
   if($userid)
   {
    $query=mysql_query("select * from users where sno='$userid'");
	  	while($result=mysql_fetch_array($query))
	  	{
	  		$dist=$result['district'];
	  		$taluk=$result['taluk'];
			$hobli=$result['hobli'];
			$village=$result['village'];
			$role=$result['role'];
	  	}
		
	  	?>
	  	
	  	  
	  	  <input type="hidden" name="userid" id="userid" value="<?php echo $userid?>" />
	  	    
				  
			<?php if($role == "DISTRICT")
			{
				?>
                <div class="form_main1">
  				<span class="form_left">* District 
    			</span>
                <input type="text" name="district"  class="txt_box" value="<?php echo $dist ?>" readonly>
                </div>
                <div class="form_main1">
				  <span class="form_left">* Taluk 
				  </span>
                  <select class="jdatlks drop_box" name="taluk" >
                  <option id='defualt' value='Select Taluk'>--Select Taluk--</option>
				  <?php $tlks=explode(",",$taluk);
				  	foreach($tlks as $tl)
				  	{
						?>
                        <option value="<?php echo $tl ?>"><?php echo $tl ?></option>
                        <?php
						
						}
						?>
				  </select>
				</div>
                <div class="form_main1">
				  <span class="form_left">* Hobli 
				  </span>
                  <select class="jdahobli drop_box" name="hobli" >
                  <option id='default' value='Select hobli'>--Select Hobli--</option>
				  
				  </select>
				</div>
                <div class="form_main1">
				  <span class="form_left">* Village
				  </span>
                  <select class="jdavillage drop_box" name="village" >
                  
                  <option id='default' value="Select village">--Select village--</option>
				  
				  </select>
				</div>
                 <?php
				
			}
			elseif($role == "TALUK")
			{
				?>
                <div class="form_main1">
  				<span class="form_left">* District 
    			</span>
                <input type="text" name="district"  class="txt_box" value="<?php echo $dist ?>" readonly>
                </div>
                <div class="form_main1">
				  <span class="form_left">* Taluk 
				  </span>
				    <input type="text" name="taluk" class="jdatlks drop_box" class="txt_box" value="<?php echo $taluk ?>" readonly>
				 </div>
                 <div class="form_main1">
				  <span class="form_left">* Hobli
				  </span>
                  <select class="jdahobli drop_box" name="hobli" >
                  <option id='default' value="Select Hobli">--Select Hobli--</option>

				  <?php $hbls=explode(",",$hobli);
				  	foreach($hbls as $hb)
				  	{
						?>
                        <option value="<?php echo $hb ?>"><?php echo $hb ?></option>
                        <?php
						
			  	  }
					?>
				  </select>
				</div>
                
                <div class="form_main1">
				  <span class="form_left">* Village
				  </span>
                  <select class="jdavillage drop_box" name="village" >
                  <option id='default' value="Select village">--Select village--</option>
				  
				  </select>
				</div>
                 <?php
				
			}
			
			
			elseif($role == "HOBLI")
			{
				?> 
			   <div class="form_main1">
			  				<span class="form_left">* District 
			    			</span>
			                <input type="text" name="district"  class="txt_box" value="<?php echo $dist ?>" readonly>
			                </div>
			                <div class="form_main1">
							  <span class="form_left">* Taluk 
							  </span>
							    <input type="text" name="taluk"  class="txt_box" value="<?php echo $taluk ?>" readonly>
							 </div>
			                 <div class="form_main1">
				  <span class="form_left">* Hobli
				  </span>
										   <input type="text" name="hobli"  class="txt_box" value="<?php echo $hobli ?>" readonly>
							 </div>
							 
							 
								<div class="form_main1">
									<span class="form_left">* Village
									</span>
									<select id="village" class="txt_box1" name="village" >
									<?php 
									
									
									
									
									$villages=explode(",",$village);
									?>
															<option id='default' value="Select village">--Select village--</option>
										<?php
										     foreach($villages as $v)
															{
															 ?>
															  
																 <option value="<?php echo $v ?>"><?php echo $v ?></option>
																 <?php
															}	?>
									</select>
								</div>
			<?php
			}
			
			
			
			else
			{
			?>	  
				  <div class="form_main1">
  				<span class="form_left">* District 
    			</span>
                <input type="text" name="district"  class="txt_box" value="<?php echo $dist ?>" readonly>
                </div>
                  <div class="form_main1">
				  <span class="form_left">* Taluk 
				
				
				  </span>
				  
				    <input type="text" name="taluk"  class="txt_box" value="<?php echo $taluk ?>" readonly>
				 </div>
                 <div class="form_main1">
				  <span class="form_left">* Hobli
				
				
				  </span>
				  
				    <input type="text" name="hobli"  class="txt_box" value="<?php echo $hobli ?>" readonly>
				 </div>
                 <div class="form_main1">
				  <span class="form_left">* Village 
				
				
				  </span>
				  	<!-- <input type="text" name="village"  class="txt_box" value="<?php echo $village ?>" readonly> -->
				    <select name="village" class="drop_box"  id='village'>
				    
                    <?php  $v_array=$village;
							$v_array=explode(",",$v_array);
							foreach($v_array as $vlg)
							{?>
                    <option value="<?php echo $vlg ?>"><?php echo $vlg ?></option>
						  <?php
						  }
							?>
              </select>
          </div>
          <?php 
         } ?>
	  	  
  <?php  	
	 } 	
 else
 {
	?>
  <div class="form_main1">
	  				<span class="form_left">* District 
    			</span>
    			
  <select name="district" id="district_" class="drop_box">
  <option id='default' value="--Select district--">--Select district--</option>
  <?php $query=mysql_query("select * from district group by district_name");
  	while($result=mysql_fetch_array($query))
  	{
	?>
	<option value="<?php echo $result['district_name'] ?>"><?php echo $result['district_name'] ?></option>
	<?php	
				
		}
		?>
	
  </select>
  </div>
  
  
   <div class="form_main1">
  <span class="form_left">* Taluk 


  </span>
  
   
   
   <select name="taluk" id="taluk_" class="txt_box1">
  <option id='default' value="Select taluk">--Select taluk--</option>
  
  </select>
  </div>
          <div class="form_main1">
  <span class="form_left">* Hobli 


  </span>
  
  <!-- <input type="text" name="hobli"  class="txt_box"> -->
  <select name="hobli" id="hobli" class="txt_box1">
  <option id='default' value="Select hobli">--Select hobli--</option>
  <?php
	
	
	$query=mysql_query("select taluk_id from taluk where taluk_name='$taluk'");
	$result=mysql_fetch_array($query);

	$taluk_id=$result['taluk_id'];
	
	
	$query1=mysql_query("select * from hobli where taluk_id='$taluk_id'");

	while($result1=mysql_fetch_array($query1))
		{
	
	?>
	  <option value="<?php echo $result1['hobli_name'] ?>"><?php echo $result1['hobli_name'] ?></option>
	<?php
	 }
 
  ?>
  
    
  </select>
  </div>
             <div class="form_main1">
  <span class="form_left">* Village


  </span>
  
 <!--  <input type="text" name="village"  class="txt_box"> -->
  <select name="village" id="village" class="txt_box1" >
  <option value="defualt">--Select village--</option>
  
  </select>
  </div>
  <?php	
			
}
		
  ?>
  
  

  
    
  
  <!--
     <div class="form_main1">
     
  <span class="form_left"> Pin Code


  </span>
  
   <input type="text" name="pincode"  class="txt_box">
  
  </div>-->
 <div class="form_main1">
   <span class="form_left"> ID type
 
 
   </span>
   
   <select name="id_type" id="id_type" class="txt_box1" >
   <option value="">--ID--</option>
   <option value="AdharCard">AdharCard</option>
   <option value="DrivingLicense">DrivingLicense</option>
   <option value="PANCard">PANCard</option>
   <option value="Passport">Passport</option>
   <option value="RationCard">RationCard</option>
   <option value="VoterCard">VoterCard</option>
   
   
   </select>
  </div>  
  
    <div class="form_main1">
	  <span class="form_left"> ID #.
	
	
	  </span>
	  
	   <input type="text" name="id_no"  class="txt_box" maxlength="50">
	  
  </div>
  
  
  </div> </div>
  <div class="deta_head"> Farm Information: </div>
  <div class="form_mainf">
<div class="form_mainleft">
  <div class="form_main1">
  <span class="form_left"> Area total(acre)
  </span>
  
    <input type="text" name="area_total" id="area_total" class="txt_box" maxlength="15" onkeypress="return isNumber(event)">
  
  
  </div>
  <div class="form_main1">
  <span class="form_left">  Rainfed (acre)

  </span>
  
    <input type="text" name="rainfed"  id="rainfed" class="txt_box" maxlength="15" onkeypress="return isNumber(event)">
  
  
  </div>
  <div class="form_main1">
  <span class="form_left"> Irrigated (acre)

  </span>
  
    <input type="text" name="irrigated" id="irrigated" class="txt_box" maxlength="15" onkeypress="return isNumber(event)" >
  
  
  </div>
  
	       <div class="form_main1">
	  <span class="form_left">  Plantation (acre)
	
	
	  </span>
	  
	   <input type="text" name="plantation"  id="plantation"  class="txt_box" maxlength="15" onkeypress="return isNumber(event)">
	  
	  </div>
	        
   
  
   
   
   </div>
   
   <div class="form_mainright">
  
     
  
        <div class="form_main1">
			 	  <span class="form_left"> Fallow (acre)
			 	
			 	
			 	  </span>
			 	  
			 	   <input type="text" name="fallow"  id="fallow" class="txt_box" maxlength="15" onkeypress="return isNumber(event)">
			 	  
  </div>
  
           <div class="form_main1">
  <span class="form_left"> Survey No


  </span>
  
   <input type="text" name="surveyno"  class="txt_box" >
  
  </div>
   <div class="form_main1">
	  <span class="form_left"> Farmer Latitude
	
	
	  </span>
	  
	   <input type="text" name="farmer_lat"  class="txt_box" maxlength="15">
	  
  </div> <div class="form_main1">
  <span class="form_left"> Farmer Longitude

  </span>
  
  
   <input type="text" name="farmer_long"  class="txt_box" maxlength="15">
  
  </div>
  
 <div class="btn_ali">
   <button type="submit" name="submit" id="Farmer_Save1" class="new" >Save</button><button type="reset" name="cancel" class="new" onclick="window.location='farmerslist.php';">Cancel</button>
    </div>
    </div>
  </div> 
  
  </form>
  </div> </div>
  
<?php include 'footer.php'; ?>