<?php 
//$activetab="Add_Recommandations";
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
		}
		});
     });

     });

</script>

<div class="midd_right1">

 <div class="main_heads">
  <div class="farmer_head">New Recommandations </div>
  <form action="save_rec.php" name="farmer_form" id="farmer_form" method="post" enctype="multipart/form-data">
  <div class="btn_m">
  <button type="submit" name="submit" id="Rec_Save" class="new">Save</button><button type="reset" name="cancel" class="new" onclick="window.location='farmerslist.php';">Cancel</button>
  </div>
  
  <div class="gr_border">
  
  
  </div>
  
<div class="deta_head"> Add Recommandations: </div>
<div class="form_mainf">
<div class="form_mainleft">
  <div class="form_main1">
  <span class="form_left"> Crop Name
  </span>
  
    <input type="text" name="crop_type"  class="txt_box" maxlength="50">
  
  
  </div>
  <div class="form_main1">
  <span class="form_left"> Urea

  </span>
  
    <input type="text" name="urea"  class="txt_box" maxlength="50">
  
  
  </div>
   <div class="form_main1">
  <span class="form_left"> Dap
 </span>
  
    <input type="text" name="dap"  class="txt_box" maxlength="50">
  
  
  </div>
  
  <div class="form_main1">
  <span class="form_left"> Mop

  </span>
  
    <input type="text" name="mop" maxlength="15"  class="txt_box" onkeypress="return isNumber(event)">
  
  
  </div>
  
  <div class="form_main1">
  <span class="form_left"> Gypsum

  </span>
  
    <input type="text" name="gypsum"  class="txt_box"  maxlength="15" onkeypress="return isNumber(event)">
  
  
  </div>
  
  
  
   <div class="form_main1">
	  <span class="form_left"> Zinc_sulphate
		  </span>
	     <input type="text" name="zinc_sulphate"  class="txt_box"  maxlength="15" onkeypress="return isNumber(event)">
			  
  </div>
     <div class="form_main1">
	  <span class="form_left"> Agribor
	
	  </span>
	 	    <input type="text" name="agribor"  class="txt_box"  maxlength="15" onkeypress="return isNumber(event)">
		  
  </div>
	     
		    <div class="form_main1">
	  <span class="form_left"> Borax
	
	  </span>
	 	    <input type="text" name="borax"  class="txt_box"  maxlength="15" onkeypress="return isNumber(event)">
		  
  </div>
	       
   </div>
   <div class="form_mainright">
    <div class="form_main1">
	  <span class="form_left"> SSP
	
	  </span>
	    <input type="text" name="ssp"  class="txt_box"  maxlength="15" onkeypress="return isNumber(event)">

   </div>
 	        <div class="form_main1">
	  <span class="form_left"> SSP Urea
	
	  </span>
	 		    <input type="text" name="ssp_urea"  class="txt_box"  maxlength="15" onkeypress="return isNumber(event)">
	  
  </div>
	     
		  
	     
		    <div class="form_main1">
	  <span class="form_left"> SSP Gypsum
	
	  </span>
	 		    <input type="text" name="ssp_gypsum"  class="txt_box"  maxlength="15" onkeypress="return isNumber(event)">
	  
  </div>
	     
		 
		  <div class="form_main1">
	  <span class="form_left"> SSP Dap
	
	  </span>
	 			    <input type="text" name="ssp_dap"  class="txt_box"  maxlength="15" onkeypress="return isNumber(event)">
  
  </div>
	      
  
       
    <div class="form_main1">
	  				<span class="form_left"> District 
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
  <span class="form_left"> Taluk 


  </span>
  
   
   
   <select name="taluk" id="taluk_" class="txt_box1">
  <option id='default' value="Select taluk">--Select taluk--</option>
  
  </select>
  </div>
  
  
  

  
 
  </div> 
  
  </form>
  </div> </div>
  
<?php include 'footer.php'; ?>




