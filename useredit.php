<?php 

//$activetab="home";
include 'header.php';

$uid=$_GET['uid'];
 $query=mysql_query("select * from users where userid='$uid'");
	 $result=mysql_fetch_object($query);
 ?>
 <script type="text/javascript" src="js/jquery-1.5.1.js"></script>
<script type="text/javascript" src="js/jquery.validate.js"></script>
<script type="text/javascript">
$(document).ready(function(){
$("#userform").validate({
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
});
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
$('#hobli').click(function()
{
	var hobli=$('#hobli').val();
	var dataString='hobli=' + hobli;
	$.ajax({
		data: dataString,
		type: "POST",
		url: 'place.php',
		success:function(response)
		{
			$('#village').html(response);
		}
		});
 });



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
			            minlength : "At least 3 characters long",
			            maxlength : "Should not exceed 50 characters",
             },
	    
	    
				lname:{
			            required : " required",
			            minlength : "At least 1 characters long",
			            maxlength : "Should not exceed 50 characters",
             },
	    
				gender:{
			            required : " required",
             },
	    
				userid:{
			            required : " required",
			            minlength : "At least 1 characters long",
			            maxlength : "Should not exceed 50 characters",
             },
	    
				password:{
			            required : " required",
			            minlength : "At least 1 characters long",
			            maxlength : "Should not exceed 50 characters",
             },
	    
				mobile:{
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

<div class="midd_right2">
 <div class="main_heads">
  <div class="farmer_head">User Form  </div>
  <form action="userdetails.php" method="post">
  <div class="btn_m">
  <?php if(isset($_GET['n'])){ $redirect_url="userlist.php";}else{$redirect_url="userdetails.php?uid=$uid"; }?>
  <?php if(isset($_GET['m'])){ $redirect_url="userresult.php";}else{$redirect_url="userdetails.php?uid=$uid"; }?>
  <button type="submit" name="submit" class="new" id="Save">Save</button>
  <button type="reset" name="cancel" class="new" onclick="window.location='<?php echo $redirect_url ?>';">Cancel</button>
  </div>
  
  <div class="gr_border">
  
  
  </div>
<div class="deta_head"> User Details: </div>

<div class="form_mainf">
<div class="form_mainleft">

  <div class="form_main1">
  <span class="form_left">* First Name
  </span>
  	 <?php if(isset($_GET['n'])){?> <input type="hidden" name="n" value="<?php echo "n" ?>" ><?php } ?>
     <?php if(isset($_GET['m'])){?> <input type="hidden" name="m" value="<?php echo "m" ?>" ><?php } ?>
    <input type="text" name="fname" id="fname" value="<?php echo $result->fname ?>" class="txt_box" maxlength="50">
  	<input type="hidden" name="update" >
  
  </div>
  <div class="form_main1">
  <span class="form_left">* Last Name

  </span>
  
    <input type="text" name="lname" id="lname" value="<?php echo $result->lname ?>" class="txt_box" maxlength="50">
  
  
  </div>
   <div class="form_main1">
  <span class="form_left">* Gender

  </span>
  
    <select class="drop_box" name="gender" id="gender"> 
     <option value="Male" <?php if($result->gender=="Male") echo "selected"; ?>> Male </option>  
    <option value="Female" <?php if($result->gender=="FEmale") echo "selected"; ?>> Female </option>  </select>  
  
  </div>
  <div class="form_main1">
  <span class="form_left">* Signin Id

  </span>
  <?php if(isset($_SESSION['superadmin'])){ ?>
    <input type="text" name="userid" id="userid" value="<?php echo $result->userid ?>" class="txt_box">
  <?php }else{ ?>
  	<input type="text" name="userid" id="userid" value="<?php echo $result->userid ?>" disabled class="txt_box" maxlength="50">
    <input type="hidden" name="userid" value="<?php echo $result->userid ?>"  class="txt_box">
  <?php } ?>
  
  </div>
  
  <div class="form_main1">
  <span class="form_left">* Password

  </span>
  
    <input type="text" name="password" id="password" value="<?php echo $result->password ?>" class="txt_box" maxlength="50">
  
  
  </div>
  <div class="form_main1">
  <span class="form_left"> Caste

  </span>
  
    <select class="drop_box" name="caste" id="caste">  <option value=""> --- Select --- </option> 
     <option value="SC" <?php if($result->caste=="SC") echo "selected"; ?>> SC </option>  
     <option value="ST"<?php if($result->caste=="ST") echo "selected"; ?> > ST </option> 
      <option value="OBC" <?php if($result->caste=="OBC") echo "selected"; ?>> OBC </option> 
       <option value="General" <?php if($result->caste=="General") echo "selected"; ?>> Gen </option> </select>  
  
  </div>
  <div class="form_main1">
  <span class="form_left"> Telephone #

  </span>
  
    <input type="text" name="telephone" value="<?php echo $result->telephone ?>" class="txt_box" maxlength="15" onkeypress="return isNumber(event)">
  
  
  </div>
  
  
  
  
  
  <div class="form_main1">
  <span class="form_left">* Mobile #

  </span>
  
    <input type="text" name="mobile" id="mobile" value="<?php echo $result->mobile ?>" class="txt_box" maxlength="15" onkeypress="return isNumber(event)">
  
  
  </div>
  <div class="form_main1">
  <span class="form_left">* Designation

  </span>
  
    <input type="text" name="designation" id="designation" value="<?php echo $result->designation ?>" class="txt_box" maxlength="50">
  
  
  </div>
  <div class="form_main1">
  <span class="form_left">* Role

  </span>
  
    <select class="drop_box" name="role" id="role"> 
    <option value="Super Admin"<?php if($result->role=="Super Admin") echo "selected"; ?> > Super Admin </option>
     <option value="ICRISAT"<?php if($result->role=="ICRISAT") echo "selected"; ?> > ICRISAT </option> 
     <option value="DISTRICT" <?php if($result->role=="DISTRICT") echo "selected"; ?>>DISTRICT</option>
    <option value="TALUK" <?php if($result->role=="TALUK") echo "selected"; ?>>TALUK</option>
    <option value="HOBLI" <?php if($result->role=="HOBLI") echo "selected"; ?>>HOBLI</option>
    <option value="VILLAGE" <?php if($result->role=="VILLAGE") echo "selected"; ?>>VILLAGE</option>
    <option value="FF"<?php if($result->role=="FF") echo "selected"; ?> > FF</option>
   </select>  
  
  </div>
  
   </div>
   
   <div class="form_mainright">
     
  
    <div class="form_main1">
  <span class="form_left"> Address

  </span>
  
 <textarea name="address" id="address" cols="" rows="" class="txt_box"><?php echo $result->address ?></textarea>
  
  
  </div>
  
          <div class="form_main1">
  <span class="form_left">* District 


  </span>
  
  
  <select name="district" id="district" class="txt_box1">
  <option value="">--district--</option>
  <?php $query1=mysql_query("select * from district group by district_name");
  echo "district is".$result->district;
  	while($result1=mysql_fetch_array($query1)){
	?>
	<option value="<?php echo $result1['district_name'] ?>" <?php if($result1['district_name']==$result->district){ echo "selected"; }?>><?php echo $result1['district_name'] ?></option>
	
	<?php	
		
	}
	
  ?>
  </select>
  </div>
   <div class="form_main1">
  <span class="form_left"> Taluk 


  </span>
  
   
  <select name="taluk" id="taluk" class="txt_box1">
  <?php if($result->role=="DISTRICT"){
	  
	?>  <option value=""></option> <?php
	  
  }else{ ?>
  <option value="<?php echo $result->taluk?>"><?php echo $result->taluk?></option>
  <?php } ?>
  </select>
  </div>
  <div class="form_main1">
  <span class="form_left"> Hobli


  </span>
  
   
  <select name="hobli" id="hobli" class="txt_box1">
  <?php if($result->role=="DISTRICT"){
	  
	?>  <option value=""></option> <?php
	  
  }else{ ?>
  <option value="<?php echo $result->hobli?>"><?php echo $result->hobli?></option>
   <?php } ?>
  </select>
  </div>
   <div class="form_main1">
  <span class="form_left"> Village


  </span>
  <!-- <input type="text" name="village" id="village" class="txt_box" value="<?php echo $result->village ?>"> -->
   
  
  <select name="village[]" id="village" multiple="multiple" class="txt_box1">
  <?php if($result->role=="DISTRICT"){
	  
	?>  <option value=""></option> <?php
	  
  }elseif($result->role == "TALUL"){ 
  ?>  <option value=""></option> <?php
  }else{
	  $v_array=$result->village;
            $v_array=explode(",",$v_array);
        foreach($v_array as $vlg){ ?>
      <option value="<?php echo $vlg?>" selected="selected"><?php echo $vlg?></option>
      <?php } ?>
   <?php } ?>
  </select>
  
  </div>
    
 <div class="form_main1">
  <span class="form_left">* RSK


  </span>
 
  
   <input type="text" name="rsk" id="rsk" value="<?php echo $result->rsk ?>" class="txt_box" maxlength="15">
  
  
  <!--
  
  <select name="rsk_*" id="rsk" class="drop_box">
	  <option value="<?php echo $result->rsk?> selected"><?php echo $result->rsk  ?></option>
	
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
  </div> </div>
   <div class="btn_ali" style="margin-left:733px;">
    <button type="submit" name="submit" class="new" id='Save_1'>Save</button>
  <button type="reset" name="cancel" class="new" onclick="window.location='<?php echo $redirect_url ?>';">Cancel</button>
  </div>
 </form>  
  
  
  </div> </div>
  
  <?php include 'footer.php'; ?>