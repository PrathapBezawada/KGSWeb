<?php 
//$activetab="home";
include 'header.php'; ?>

<style>
label.error { float: none; color: red; padding-left: .5em; vertical-align: top; }
</style>
<script type="text/javascript" src="js/jquery-1.5.1.js"></script>
<script type="text/javascript" src="js/jquery.validate.js"></script>
<script type="text/javascript">
$(document).ready(function()
{
$('#district').click(function(){
		var district=$('#district').val();
		
	var dataString='district=' + district;
	
	
	if(district=='N/A')
	{
	 $('#taluk').text('N/A');
  }
	else	
	{
	$.ajax({
		data: dataString,
		type: "POST",
		url: 'place.php',
		success:function(response)
		{
				$('#taluk').html(response);
					
	  }
	});
  }
	
	
});
$('#taluk').click(function(){
	
	var taluk=$('#taluk').val();
	var dataString='taluk=' + taluk;
	
		if(taluk=='N/A')
		{
		 $('#hobli').text('N/A');
  }
  
  
  else
  	{
	$.ajax({
		data: dataString,
		type: "POST",
		url: 'place.php',
		success:function(response)
		{
				$('#hobli').html(response);
				
		}
	
		});
		}
	
	
});
$('#hobli').click(function(){
	var hobli=$('#hobli').val();
	var dataString='hobli=' + hobli;
	if(hobli=='N/A')
			{
			 //$('#village').text('N/A');
	  }
  else
  {
  	$.ajax({
		data: dataString,
		type: "POST",
		url: 'place.php',
		success:function(response){
		$('#village').html(response);
				
		}
	});
	}
	
	
});


/*
$("#role").change(function()
{

	val=$('#role option:selected').val();
	alert(val);
	if(val=='DISTRICT')
	{
		$("#taluk").hide();
		$("#hobli").hide();
		$("#village").hide();

	}
	else if(val=='TALUK')
	{
		$("#hobli").hide();
		$("#village").hide();
	}

});

*/



$("#userform").validate({
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
      gender: 
      {
				required: true,
				
			},
           
     userid: 
     {
      required: true,
      minlength: 1,
				maxlength:50
     },
     password:
     {
      required: true,
      minlength: 1,
				maxlength:50
     },
     
     
     
     
     telephone:
     {
		     
		      minlength: 10,
		      maxlength:15
     },
     
     
     
     mobile: 
     {
     required: true,
     minlength: 10,
     maxlength:15
     },
     role:
     {
      required: true,
     
     },
     
     designation:
     {
      required: true,
       minlength: 1,
       maxlength:50

     },
        
     district:
     {
      required: true,
     },
    
     rsk: 
     {
			 required: true,
			 minlength: 1,
			 maxlength:50
     },
     
          
      },
      
       messages:
	    { 
	    
	    fname : {
			            required : " required",
			            minlength : "At least 3 characters ",
			            maxlength : "max-limit 50 char",
             },
	    
	    
				lname:{
			            required : " required",
			            minlength : "At least 1 characters long",
			            maxlength : "allowed only 50 chars",
             },
	    
				gender:
						{
			            required : " required",
             },
	    
				userid:
				    {
			            required : " required",
			            minlength : "At least 1 characters long",
			            maxlength : "allowed only 50 characters",
             },
	    
				password:
						{
			            required : " required",
			            minlength : "At least 1 characters long",
			            maxlength : "Should not exceed 50 characters",
        		},
	    
				mobile:
						{
			            required : " required",
			            minlength : "At least 10 characters long",
			            maxlength : "Should not exceed 15 characters",
             },
        telephone:{
			            minlength : "At least 10 characters long",
			            maxlength : "Should not exceed 15 characters",
             },
	    
				district:{
			            required : " required",
			               },
	    
				role:{
			            required : " required",
			            },
	    
				designation:{
			            required : " required",
			            minlength : "At least 3 characters long",
			            maxlength : "Should not exceed 50 characters",
             },
	    
				rsk:{
			            required : " required",
			            minlength : "At least 3 characters long",
			            maxlength : "only 50 characters",
             },
	    
	   	}
});



$('#Save').click(function (e){

var gen_val;
var cast_val;
var role_val;
var dist_val;
var taluk_val;
var hobli_val;
var village_val;


gen_val=$('#gender option:selected').val();
cast_val=$('#caste option:selected').val();
role_val=$('#role option:selected').val();

dist_val=$('#district option:selected').val();
taluk_val=$('#taluk option:selected').val();
hobli_val=$('#hobli option:selected').val();
village_val=$('#village').val();

/*
$("input[name*='_*']").each(function ()
{
id=(this.id);
/*alert(id);
value=$('#'+id).val();
/*alert("valuie is "+value);
});


/*if((value=='')&&(gen_val=='')&&(cast_val=='')&&(role_val=='')&& (dist_val=='')&&(taluk_val=='')&&(hobli_val=='')&&(village_val==''))
{
alert("* fields should not be empty");

}


var mobile=$("#mobile").val();
flag=0;
if(value=='')
{
flag=1;
}
if((gen_val==''))
{
flag=1;
}
if((role_val==''))
{
flag=1;
//alert('flag is'+flag);
}


if(mobile=='')
{
 flag=1;
}


//alert(flag);

if(flag==1)
{
e.preventDefault();
alert("* fields should not be empty");

}
*/
if(role_val == "TALUK")
{
	if((taluk_val==''))
	{
		e.preventDefault();
		alert("Must Select Taluk");

	//alert('flag is'+flag);
	}
	
}



if(role_val == "TALUK")
{
	if((taluk_val==''))
	{
		e.preventDefault();
		alert("Must Select Taluk");

	//alert('flag is'+flag);
	}
}

if(role_val == "HOBLI")
{
	if((hobli_val==''))
	{
		e.preventDefault();
		alert("Must Select Hobli");

	//alert('flag is'+flag);
	}
}


if(role_val == "VILLAGE" || role_val == "Farm Facilitator")
{
	if(taluk_val=='')
	{
		e.preventDefault();
		alert("Must Select Taluk");
	}
	elseif(hobli_val=='' || village_val == '')
	{
		e.preventDefault();
		alert("Must Select Hobli and Village");
	}
}

});


$('#Save_1').click(function (e){

var gen_val;
var cast_val;
var role_val;
var dist_val;
var taluk_val;
var hobli_val;
var village_val;


gen_val=$('#gender option:selected').val();
cast_val=$('#caste option:selected').val();
role_val=$('#role option:selected').val();

dist_val=$('#district option:selected').val();
taluk_val=$('#taluk option:selected').val();
hobli_val=$('#hobli option:selected').val();




/*
$("input[name*='_*']").each(function ()
{
id=(this.id);
/*alert(id);
value=$('#'+id).val();
/*alert("valuie is "+value);
});


/*if((value=='')&&(gen_val=='')&&(cast_val=='')&&(role_val=='')&& (dist_val=='')&&(taluk_val=='')&&(hobli_val=='')&&(village_val==''))
{
alert("* fields should not be empty");

}
flag=0;
var mobile=$("#mobile").val();

if(value=='')
{
flag=1;
}
if((gen_val==''))
{
flag=1;
}
if((role_val=='') || (dist_val==''))
{
flag=1;
//alert('flag is'+flag);
}


if(mobile=='')
{
 flag=1;
}


//alert(flag);

if(flag==1)
{
e.preventDefault();
alert("* fields should not be empty");

}
*/
// 	document.getElementById("userform").submit();
if(role_val == "TALUK")
{
	if((taluk_val==''))
	{
		e.preventDefault();
		alert("Must Select Taluk");

	//alert('flag is'+flag);
	}
}


if(role_val == "HOBLI")
{
	if((taluhobli_val==''))
	{
		e.preventDefault();
		alert("Must Select Hobli");

	//alert('flag is'+flag);
	}
}




if(role_val == "VILLAGE" || role_val == "Farm Facilitator")
{
	if(taluk_val=='')
	{
		e.preventDefault();
		alert("Must Select Taluk");
	}else if(hobli_val=='')
	{
		e.preventDefault();
		alert("Must Select Hobli ");
	}
	else{
		 $('#village').each(function () {
    if (!$(this).find("option:selected").length) {
       e.preventDefault();
        alert('Must Select Village');
        
    }
		 });
	}
}
else{
	//alert("here");
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
  <div class="farmer_head">User Form  </div>
  <form action="userdetails.php" method="post" id="userform">
  <div class="btn_m">
  <button type="submit" name="submit" class="new" id='Save'>Save</button>
  <button type="reset" name="cancel" class="new" onclick="window.location='userlist.php';">Cancel</button> 
  </div>
  
  <div class="gr_border">
  
  
  </div>
<div class="deta_head"> User Details: </div>

<div class="form_mainf">
<div class="form_mainleft">

  <div class="form_main1"><span > </span>
  <span class="form_left">* First Name
  </span>
  
    <input type="text" name="fname" id="fname" class="txt_box" maxlength="50">  
  </span>
  
  
  </div>
  <div class="form_main1">
  <span class="form_left"> * Last Name

  </span>
  
    <input type="text" name="lname" id="lname" class="txt_box" maxlength="50">
  
  
  </div>
  <div class="form_main1">
  <span class="form_left"> * Gender

  </span>
  
    <select name="gender" id="gender" class="drop_box"> 
      <option value="">--Select--</option>

   <!-- <option value="N/A"> N/A </option> -->
<option value="Male">Male</option><option value="Female">Female</option></select>
  
  
  </div>
  
  <div class="form_main1">
  <span class="form_left"> * Signin Id

  </span>
  
    <input type="text" name="userid" id="userid" class="txt_box" maxlength="50">
  
  
  </div>
  
  <div class="form_main1">
  <span class="form_left">* Password

  </span>
  
    <input type="Password" name="password" id="password"  class="txt_box" maxlength="50">
  
  </div>
  <div class="form_main1">
  <span class="form_left">  Caste

  </span>
  
    <select class="drop_box" name="caste" id="caste">  <option value=""> --- Select --- </option> 
     <!--<option value="N/A"> N/A </option> -->
     <option value="SC"> SC </option>  
     <option value="ST"> ST </option> 
      <option value="OBC"> OBC </option> 
       <option value="General"> * Gen </option> </select>  
  
  </div>
  <div class="form_main1">
  <span class="form_left"> Telephone #

  </span>
  
    <input type="text" name="telephone"  class="txt_box" maxlength="15" onkeypress="return isNumber(event)">
  
  
  </div>
  
  
  
  
  
  <div class="form_main1">
  <span class="form_left"> * Mobile #

  </span>
  
    <input type="text" name="mobile" id="mobile" class="txt_box" maxlength="15"  onkeypress="return isNumber(event)" >
  
  
  </div>
  <div class="form_main1">
  <span class="form_left"> * Designation 

  </span>
  
    <input type="text" name="designation" id="designation" class="txt_box" maxlength="50">
  
  
  </div>
  <div class="form_main1">
  <span class="form_left"> * Role

  </span>
  
    <select name="role" id="role" class="drop_box">
    <option value="">--role--</option>
    <!--<option value="Super Admin">Super Admin</option>-->
    <option value="ICRISAT">ICRISAT</option>
    <option value="DISTRICT">DISTRICT</option>
    <option value="TALUK">TALUK</option>
    <option value="HOBLI">HOBLI</option>
    <option value="VILLAGE">VILLAGE</option>
    <option value="FF">FF</option>
    </select>
  
  
  </div>
  
   </div>
   
   <div class="form_mainright">
     
  
    <div class="form_main1">
  <span class="form_left">  Address

  </span>
  
 <textarea name="address" id="address" cols="" rows="" id="adress" class="txt_box" maxlength="50"></textarea>
  
  
  </div>
  
      <div class="form_main1">
  <span class="form_left"> * District 


  </span>
  
  <!-- <input type="text" name="district"  class="txt_box"> -->
  <select name="district" id="district" class="drop_box">
  <option value="">--district--</option>
  <option value="N/A"> N/A </option> 

  <?php $query=mysql_query("select * from district group by district_name");
  	while($result=mysql_fetch_array($query)){
	?>
	<option value="<?php echo $result['district_name'] ?>"><?php echo $result['district_name'] ?></option>
	
	<?php	
		
	}
	
  ?>
  </select>
  </div>
  
  
       <div class="form_main1">
  <span class="form_left">  Taluk 


  </span>
  
   <!-- <input type="text" name="taluk"  class="txt_box"> -->
   <select name="taluk" id="taluk" class="drop_box">
  <option value="">--taluk--</option>
  <option value="N/A"> N/A </option> 

  
  </select>
  
  </div>
        <div class="form_main1">
  <span class="form_left">  Hobli 


  </span>
  
  <!-- <input type="text" name="hobli"  class="txt_box"> -->
  <select name="hobli" id="hobli" class="drop_box">
  <option value="">--hobli--</option>
  <option value="N/A"> N/A </option> 

  </select>
  </div>
           <div class="form_main1">
  <span class="form_left"> Village


  </span>
  
 <!-- <input type="text" name="village" id="village" class="txt_box"> -->
   <select name="village[]" id="village" multiple="multiple" class="drop_box">
  </select>
  </div>
 <div class="form_main1">
  <span class="form_left"> * RSK


  </span>


  
   <input type="text" name="rsk" id="rsk" class="txt_box" maxlength="50">
  

  <!--
  
  
<select name="rsk_*" id="rsk" class="drop_box">
  <option value="">--RSK--</option>

<?php
	$query=mysql_query("select distinct(rsk) from users where date='2013-08-05'");
	
	while($result=mysql_fetch_array($query))
	{
	
	?>
	<option value="<?php echo $result['rsk'] ?>"><?php echo $result['rsk']?></option>
	
	<?php
			
	}

?>
  </select>  
  -->
  
  </div>
  
  
  
  <div class="form_main1">
  <span class="form_left"> Green SIM Card 


  </span>
  
  <!-- <input type="checkbox" name="gsc" class="txt_box">-->
  <span>
   &nbsp&nbsp<input type="checkbox" name="gsc" >
  </span>
  </div>
 <!-- <span class="form_left" style='color:red';> * fields should be mandatory </span>-->

  </div> </div>
  
   
   <div class="btn_ali" style="margin-left:733px;">
   <button type="submit" name="submit" class="new" id='Save_1'>Save</button>
      <button type="reset" name="cancel" class="new" onclick="window.location='userlist.php';">Cancel</button> </div>
 
 </form>  
  
  
  </div> </div>
  
  <?php include 'footer.php'; ?>