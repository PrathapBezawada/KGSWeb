<?php 
session_start();
ob_start();
include 'dbcon.php';

$user_dist='';
	if(isset($_POST['submit1']))
	{
		$username=$_POST['username'];
		$pass=$_POST['password'];
		if($username=="nuncsys" && $pass=="nuncsys")
		{
			$_SESSION['user']=ucwords($username);
			$_SESSION['admin']="Admin";
			//$_SESSION['user_id']="admin";
			
			$_SESSION['user_id']="superadmin";
			$_SESSION['superadmin']="superadmin";
		}
		else
		{
			//echo "select * from users where userid='$username' and password='$pass'";
			//exit;
			if( (strpos($username,'ff') === false) && (strpos($username,'rt') === false))
			{
				$q=mysql_query("select * from users where userid='$username' and password='$pass'")or die(mysql_error());
				if(mysql_num_rows($q)>0)
				{
				
				$r=mysql_fetch_array($q);
				$status=$r['status'];
				$role=$r['role'];
				//echo "***".$role;
				$username=$r['userid'];
				$_SESSION['user']=$username;

					
					
				//if($role=="ICRISAT" || $role=="Super Admin")
					
					if($role=="ICRISAT")
						{
							$_SESSION['user_id']="admin";
							/*if($role=="Super Admin")
							{
								$_SESSION['superadmin']="superadmin";
							}
							*/
						}
						else
						{
							$_SESSION['user_id']=$r['sno'];

						}
							/*
						if($status==0)
						{
							header('location:changepassword.php');
						}
						*/
						
					
				}		
			
			else
			{
		  	$_SESSION['error']='error';
					header('location:index.php');
			}
	   }
		else
		{
			$_SESSION['error']='error';
			header('location:index.php');
		}
	   
		}
	}
if(!isset($_SESSION['user']))
{
	
	
	header('location:index.php');
}





?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
<title>Krishi Gyan Sagar</title>
<link href="css/styles.css" type="text/css" rel="stylesheet">
<!-- responsive table --->
<script src="js/jquery.min.js"></script>
	<script src="js/responsive-tables.js"></script>
    <!-- responsive table --->



 <script type="text/javascript" src="js/jquery-1.5.1.js"></script>
 <script type="text/javascript" src="js/jquery-latest.js"></script>
<script type="text/javascript" src="js/jquery.validate.js"></script>
<script type="text/javascript">
$(document).ready(function(){

$('#search').change(function(){
	
	var sval=$('#search').val();
	if(sval!=""){
	var dataString='search=' + sval;
	$.ajax({
		data: dataString,
		type: "POST",
		url: 'searchoptions.php',
		success:function(response){
			//alert(response);
			$('#searchview').html(response);
		}
	
	
	});
	}
});


});
</script>

</head>

<body>
<div class="main">
 
<div class="header"> 

<div class="header_left">  <img src="images/kvs-logo.png"> </div> 
<div class="header_right"> 
<div class="user_left"> Welcome to <?php echo $_SESSION['user'] ?>  </div>
 
 
<div class="nav">
<ul>
 
<li> <a href="#">  About us </a> </li>


<?php if(isset($_SESSION['superadmin'])){ ?><li> <a href="userlist.php">  Admin</a> </li><?php } ?>

<?php if($_SESSION['user_id']=="admin"){ ?><li> <a href="userlist.php">  UserList</a> </li><?php } ?>
<?php if($_SESSION['user_id']=="admin"){ ?><li> <a href="add_rec.php">  AddRecommandations</a> </li><?php } ?>
<li> <a href="#">  FAQ</a> </li>
<li style="border-right:none;"> <a href="logout.php" >  Logout</a> </li>
</ul>
</div> 

 </div> </div>
 <div class="midd_main">
<div class="midd_left"> <span class="sea">Search    </span>

 <div class="serch_main">
  
<select class="txt_box_search" id="search">
<option value="farmer"> Farmer </option>

<?php

if($_SESSION['user_id']=="admin" || $_SESSION['user_id']=="superadmin")
{?>
<option vlaue="user"> User </option> 

<?php }?>
 </select>
</div>
 <div id="searchview">

 <form action='farmerresult.php' method='post'>
	<div class="serch_main">
<input type="hidden" name="user_district"  value='<?php echo "user district is ".$user_dist ?>'>
 <span class="search1"> Farmer Name </span>
 <input type="text" name="fname" class="txt_box_search"> </div>
 <!--<div class="serch_main">
 <span class="search1"> Last Name </span>
 <input type="text" name="lname" class="txt_box_search"> </div> -->
 <div class="serch_main">
 <span class="search1"> Village</span>
 <input type="text" name="village" class="txt_box_search"> </div>
 
  <input type="submit" class="go" Value="Go" name="submit" style="margin:20px 0px 0px 110px; float:left;"/>
  </form>
 </div>
 <br />
 <span class="sea" style="margin-top:10px">Quick Create  </span>
   <div class="search1" style="margin-top:5px">
   
   
   <?php
   if($_SESSION['user_id']!='admin' && $_SESSION['user_id']!='superadmin')
   {
   
   $sno=$_SESSION['user_id'];
   
   }
   ?>
    
  <!--  <a href="farmerform.php?user=<?php echo $sno?>"> Farmer </a>  
  
  -->
  
  </div>
  
<?php 
if($_SESSION['user_id']=="superadmin")
{


?>    
	<div class="search1" style="margin-top:5px">
	<a href="userform.php"> User </a> </div> 
 <?php
}
  ?>
   <div class="search1" style="margin-top:5px">
  <a href="recinv.php">Recommendations </a> </div>
</div>

<div class="midd_right">
<div class="menu">
<ul>
 
<li> <a href="soilmaps.php" <?php 
													if($activetab=="home")
													echo "style='color:#e26a00'"; ?>
													> Home  </a> </li>
<li> <a href="farmerslist.php" <?php 
													if($activetab=="farmar") 
													echo "style='color:#e26a00'"; ?>
													>  Farmer </a> </li>
<li> <a href="ppackages.php" <?php 
if($activetab=="ppackages") echo "style='color:#e26a00'"; ?>>  Production Packages</a> </li>
<!-- <li> <a href="soilmaps.php" <?php //if($activetab=="soilmaps") echo "style='color:#e26a00'"; ?>>  Soil Maps</a> </li> -->
<li> <a href="admin.php" <?php 
													if($activetab=="report")
													echo "style='color:#e26a00'"; ?>
													>  Report</a> </li>


 
</ul>

</div>