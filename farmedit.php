<?php 
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


});
</script>
<?php 
	if(isset($_POST['submit'])){
		$farmname=$_POST['farmname'];
		$farmarea=$_POST['farmarea'];
		$carea=$_POST['carea'];
		$crname=$_POST['crname'];
		$village=$_POST['village'];
		$faid=$_POST['faid'];
		$fid=$_POST['fid'];
		$crvariety=$_POST['crvariety'];
		$fields=$_POST['fields'];
		$farm_lat=$_POST['farm_lat'];
		$farm_long=$_POST['farm_long'];
		mysql_query("update farms set `farm_name`='$farmname', `total_farm_area`='$farmarea', `cultivation_area`='$carea', `crop_name`='$crname', `village`='$village',  `fields`='$fields', `crop_variety`='$crvariety',farm_lat='$farm_lat',farm_long='$farm_long' where sno='$faid'") or die(mysql_error());
		$query1=mysql_query("select * from farmers where sno='$fid'");
		$result1=mysql_fetch_object($query1);
		$district=$result1->district;
		$taluk=$result1->taluk;
		//echo "select * from rec where district='$district' and taluk='$taluk' and crop_type='$crname'";
		$query2=mysql_query("select * from rec where district='$district' and taluk='$taluk' and crop_type='$crname'") or die(mysql_error());
		if(mysql_num_rows($query2)>0){
		$result2=mysql_fetch_array($query2);
		$urea=$result2['urea'];
		$dap=$result2['dap'];
		$mop=$result2['mop'];
		$gypsum=$result2['gypsum'];
		$zinc_sulphate=$result2['zinc_sulphate'];
		$borax=$result2['borax'];
		}else{
			$urea="";
		$dap="";
		$mop="";
		$gypsum="";
		$zinc_sulphate="";
		$borax="";
			}
		$date=date('Y-m-d');
		mysql_query("update farmer_rec set urea='$urea',dap='$dap',mop='$mop',gypsum='$gypsum',zinc_sulphate='$zinc_sulphate',borax='$borax',date='$date' where field_id='$faid'")or die(mysql_error());
		
	header("location:farmerdetails.php?sno=$fid");
		
	
	}
?>

<div class="midd_right2">
 <div class="main_heads">
 <?php 
 if(isset($_GET['faid'])){
 $faid=$_GET['faid']; 
 $fid=$_GET['fid']; 
 $query=mysql_query("select * from farms where sno='$faid'");
 $result=mysql_fetch_object($query);
 ?>
  <div class="farmer_head">Farm Form  </div>
  <form action="" method="post" id="userform">
  <div class="btn_m">
  <button type="submit" name="submit" class="new">Save</button>
  <button type="reset" name="cancel" class="new" onclick="window.location='farmdetails.php?fid=<?php echo $fid ?>&faid=<?php echo $faid ?>';">Cancel</button> 
  </div>
  
  <div class="gr_border">
  
  
  </div>
<div class="deta_head"> Farm Details: </div>

<div class="form_mainf">
<div class="form_mainleft">

  <div class="form_main1">
  <span class="form_left"> Farm Name
  </span>
  
    <input type="text" name="farmname" value="<?php echo $result->farm_name ?>" class="txt_box" maxlength="50">
  	<input type="hidden" name="faid" value="<?php echo $faid ?>"  />
    <input type="hidden" name="fid" value="<?php echo $result->fid ?>"  />
  
  </div>
  <!--
  <div class="form_main1">
  <span class="form_left"> # Fields

  </span>
  
    <input type="text" name="fields" value="<?php echo $result->fields ?>" class="txt_box">
  
  
  </div>-->
  <div class="form_main1">
  <span class="form_left"> Total Farm Area

  </span>
  
    <input type="text" name="farmarea" value="<?php echo $result->total_farm_area ?>"  maxlength="15" class="txt_box" onkeypress="return isNumber(event)">
  
  
  </div>
  
  <div class="form_main1">
  <span class="form_left"> Cultivation Area

  </span>
  
    <input type="text" name="carea" id="carea" value="<?php echo $result->cultivation_area ?>" maxlength="15" class="txt_box" onkeypress="return isNumber(event)">
  
  
  </div>
  
  
  
    
  
   
    <div class="form_main1">
  <span class="form_left"> Crop Name

  </span>
  	<select name="crname" class="txt_box">
    <option value="">--Crop--</option>
    <?php $q1=mysql_query("select * from rec group by crop_type ");
  	while($r1=mysql_fetch_array($q1)){
			echo "<option value='".$r1['crop_type']."'";if($result->crop_name==$r1['crop_type']){ echo " selected";} echo ">".$r1['crop_type']."</option>";	
	}
	?>
    </select>
   
  
  
  </div>
  </div>
  <div class="form_mainright">

  <div class="form_main1">
  <span class="form_left"> Crop Variety

  </span>
  
    <input type="text" name="crvariety" value="<?php echo $result->crop_variety?>" class="txt_box" maxlength="50">
  
  
  </div>
  
  <div class="form_main1">
  <span class="form_left"> Village

  </span>
  
    <select name="village" class="txt_box">
    <option value="">--village--</option>
    
      <?php 
		  	$q=mysql_query("select district,taluk,hobli from farmers where sno='$fid'");
					  $result1=mysql_fetch_array($q);
						$dist=$result1['district'];
						$taluk=$result1['taluk'];
						$hobli=$result1['hobli'];	
				
						//echo "district is ".$dist."taluk is ". $taluk."hobli is ".$hobli."<br>";
						$query=mysql_query("select district_id from district where district_name='$dist'");
						$result1=mysql_fetch_array($query);
						$dist_id=$result1['district_id'];
						//	echo "district_id is ".$dist_id;
							
						$query=mysql_query("select taluk_id from taluk where taluk_name='$taluk' and district_id='$dist_id'");
						$result1=mysql_fetch_array($query);
						$taluk_id=$result1['taluk_id'];
							//echo "taluk_id is ".$taluk_id;
							
						$query=mysql_query("select hobli_id from hobli where taluk_id='$taluk_id' and hobli_name='$hobli'");
						$result1=mysql_fetch_array($query);
						$hobli_id=$result1['hobli_id'];
						//echo "hobli id is ".$hobli_id;
						
						$query=mysql_query("select village_name from village where hobli_id='$hobli_id'");
						
						
						if(mysql_num_rows($query)>0)
						{
			 				while($result1=mysql_fetch_array($query))
	           {
	          // echo "viallage name".$result1['village_name'];		 
    ?>
     <option value="<?php echo $result1['village_name']; ?>" <?php if($result1['village_name']==$result->village){ echo "selected";} ?> > <?php echo $result1['village_name'] ?></option>
     <?php 
       }}
     	?>

    </select>
  
  
  </div> 
    <div class="form_main1">
	  <span class="form_left"> Farm Latitude
	
	  </span>
	  
	    <input type="text" name="farm_lat" value="<?php echo $result->farm_lat; ?>" class="txt_box" maxlength="15" >
	  
	  
  </div>  <div class="form_main1">
  <span class="form_left"> Farm Longitude

  </span>
  
    <input type="text" name="farm_long" value="<?php echo $result->farm_long;?>" class="txt_box" maxlength="15">
  
  
  </div>
   
  </div> </div>
   <div class="btn_ali" style="margin-left:733px;">
    <button type="submit" name="submit" class="new">Save</button>
  <button type="reset" name="cancel" class="new" onclick="window.location='farmdetails.php?fid=<?php echo $fid ?>&faid=<?php echo $faid ?>';">Cancel</button> </div>
 </form>  
<?php } ?>  
  
  </div> </div>
  
  <?php include 'footer.php'; ?>