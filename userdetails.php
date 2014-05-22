<?php 
ob_start();
//$activetab="home";
include 'header.php';?>
<script type="text/javascript">
$(document).ready(function(){

$('#delete').click(function(){
	
	var uid=$('#uid').val();
	//alert(sno);
	var r=confirm("Are you sure to delete!")
	if (r==true)
 	 {
  	
	if(uid!=""){
	var dataString='uid=' + uid;
	$.ajax({
		data: dataString,
		type: "POST",
		url: 'delete.php',
		success:function(response){
			//alert(response);
			//$('#searchview').html(response);
			window.location='userlist.php';
		}
	
	
	});
	}
	}
});


});
</script>
<div class="midd_right1">
 <div class="main_heads">
  <div class="farmer_head">User Details View </div>  <?php if(isset($_GET['m'])){?> <div style="float:left; margin-left:25px;"> <!--<a href="userresult.php">Back to Results</a>--></div><?php } ?>
   <?php
  include 'dbcon.php';
   if(isset($_POST['submit'])){
	 $fname=$_POST['fname'];
	 $lname=$_POST['lname'];
	 $uid=$_POST['userid'];
	 $password=$_POST['password'];
	 $caste=$_POST['caste'];
	 $tel=$_POST['telephone'];
	 $mobile=$_POST['mobile'];
	 $role=$_POST['role'];
	 $district=$_POST['district'];
	 //$taluk=$_POST['taluk_*'];
	 $rsk=$_POST['rsk'];
	 //$hobli=$_POST['hobli_*'];
	 $designation=$_POST['designation'];
	 if($role == "DISTRICT"){
	 	$taluk=""; $i=0;
		$q1=mysql_query("select t.taluk_name from taluk t,district d where d.district_id=t.district_id and d.district_name='$district'");
		while($r1=mysql_fetch_array($q1)){
			if($i ==0)
				$taluk=$taluk.$r1[0];
			else
				$taluk=$taluk.", ".$r1[0];
			$i++;
		}
		$hobli="";
		$i=0;
		$q1=mysql_query("select h.hobli_name from hobli h,taluk t,district d where h.taluk_id=t.taluk_id and d.district_id=t.district_id and  d.district_name='$district'");
		while($r1=mysql_fetch_array($q1)){
			if($i ==0)
				$hobli=$hobli.$r1[0];
			else
				$hobli=$hobli.", ".$r1[0];
			$i++;
		}
		$village="";
		$i=0;
		$q1=mysql_query("select v.village_name from village v,hobli h,taluk t,district d where v.hobli_id=h.hobli_id and h.taluk_id=t.taluk_id and d.district_id=t.district_id and d.district_name='$district'");
		while($r1=mysql_fetch_array($q1)){
			if($i ==0)
				$village=$village.$r1[0];
			else
				$village=$village.", ".$r1[0];
			$i++;
			//echo "***".$village;
		}
	 }elseif($role == "TALUK")
	 {
	 	$taluk=$_POST['taluk'];
		$hobli="";
		$i=0;
		$q1=mysql_query("select h.hobli_name from hobli h,taluk t where h.taluk_id=t.taluk_id and  t.taluk_name='$taluk'");
		while($r1=mysql_fetch_array($q1)){
			if($i ==0)
				$hobli=$hobli.$r1[0];
			else
				$hobli=$hobli.", ".$r1[0];
			$i++;
		}
		$village="";
		$i=0;
		$q1=mysql_query("select v.village_name from village v,hobli h,taluk t where v.hobli_id=h.hobli_id and h.taluk_id=t.taluk_id and t.taluk_name='$taluk'");
		while($r1=mysql_fetch_array($q1)){
			if($i ==0)
				$village=$village.$r1[0];
			else
				$village=$village.", ".$r1[0];
			$i++;
		}
	 }
	 
	 elseif($role == "HOBLI")
	 {
	    $taluk=$_POST['taluk'];
	 	 	$hobli=$_POST['hobli'];
	 		$i=0;
	 			
					$q_t=mysql_query("select taluk_id from taluk where taluk_name='$taluk'");	
					$r_t=mysql_fetch_array($q_t);
					$taluk_id=$r_t['taluk_id'];
					//$q1=mysql_query("select * from hobli h,village v where h.hobli_name='$hobli' and h.hobli_id=v.hobli_id  and h.taluk_id='$taluk_id' group by village_name");

	 		$q1=mysql_query("select v.village_name from village v,hobli h where v.hobli_id=h.hobli_id and  h.hobli_name='$hobli' and h.taluk_id='$taluk_id'");
	 		while($r1=mysql_fetch_array($q1))
	 		{
	 			if($i ==0)
	 				$village=$village.$r1[0];
	 			else
	 				$village=$village.", ".$r1[0];
	 			$i++;
	 		}
	 		
	 }
	 
	 
	 else{
		 $taluk=$_POST['taluk'];
		 $hobli=$_POST['hobli'];
		 $village=$_POST['village'];
		
		 if(is_array($village))
		 {
		 $village=implode(",",$village);
		 //echo $village;
		 }
			 
	 }
	 //echo "*****************************".$village;
	 $address=$_POST['address'];
	 $gsc=$_POST['gsc'];
	 $date=date('Y-m-d');
	 $gender=$_POST['gender'];
	 $user_id=$_SESSION['user_id'];
	 
	 
	 
	 if($gsc=="on"){ $g=1; }else{ $g=0;}
	 if(isset($_POST['update']))
	 {
		 
		 mysql_query("update `users` set `fname`='$fname', `lname`='$lname', `userid`='$uid', `password`='$password', `mobile`='$mobile', `telephone`='$tel', `caste`='$caste', `address`='$address', `district`='$district', `taluk`='$taluk', `village`='$village', `rsk`='$rsk', `green_simcard`='$g',gender='$gender', `designation`='',hobli='$hobli',modifiedby='$user_id',modified_date='$date',designation='$designation', role='$role' where userid='$uid'") or die(mysql_error());
	 }
	 else
	 {
	 mysql_query("INSERT INTO `users` ( `fname`, `lname`, `userid`, `password`, `mobile`, `telephone`, `caste`, `address`, `district`, `taluk`, `village`, `rsk`, `green_simcard`, `designation`,`hobli`,`date`,`createdby`,`role`,`gender`) VALUES ('$fname', '$lname', '$uid', '$password', '$mobile', '$tel', '$caste', '$address', '$district', '$taluk', '$village', '$rsk', '$g', '$designation','$hobli','$date','$user_id', '$role','$gender');") or die(mysql_error());
	 
	 
	 }
	 if(isset($_POST['n'])){header('location:userlist.php');}
	 if(isset($_POST['m'])){header('location:userresult.php');}
	 $query=mysql_query("select * from users where userid='$uid'");
	 $result=mysql_fetch_object($query);
	 }
	 if(isset($_GET['uid'])){
		 $uid=$_GET['uid'];
	 	$query=mysql_query("select * from users where userid='$uid'");
		 $result=mysql_fetch_object($query);
		 
	 } 
	 ?>
  <div class="btn_m">
  <?php if(isset($_SESSION['superadmin'])){ ?>
  
   <button type="submit" name="submit" onclick="window.location='userform.php';" class="new">New</button>
    <?php } ?>
   <button type="submit" name="submit" onclick="window.location='userlist.php';" class="new">Back</button>
   <?php if(isset($_SESSION['superadmin'])){ ?>
  <button type="submit" name="submit" onclick="window.location='useredit.php?uid=<?php echo $uid ?>';" class="new">Edit</button>
  <button name="delete" id="delete" class="new">Delete</button>
   <?php }
   
   
   ?>

  <input type="hidden" name="uid" id="uid" value="<?php echo $result->sno ?>" />
   </div>
  
  <div class="gr_border">
  
  
  </div>
 
<div class="deta_head"> User Details: </div>
<div class="form_mainf">
<div class="form_mainleft">
<div class="form_main1">
  <span class="form_left">Serial Number

  </span>
  
   <span class="form_right"> <?php echo $result->sno ?> </span>
  
  
  </div>
  <div class="form_main1">
  <span class="form_left"> First Name
  </span>
  
   <span class="form_right"> <?php echo $result->fname ?> </span>
  
  
  </div>
  <div class="form_main1">
  <span class="form_left"> Last Name

  </span>
  
   <span class="form_right"> <?php echo $result->lname ?> </span>
  
  
  </div>
  <div class="form_main1">
   <span class="form_left">Gender </span>
  
   <span class="form_right"> <?php echo $result->gender ?> </span>
  
  
  </div>
  <div class="form_main1">
  <span class="form_left"> Signin Id

  </span>
  
   <span class="form_right"> <?php echo $result->userid ?> </span>
  
  
  </div>
  
  <div class="form_main1">
  <span class="form_left"> Password

  </span>
  
   <span class="form_right"> <?php echo $result->password ?> </span>
  
  
  </div>
  
  <div class="form_main1">
  <span class="form_left"> Mobile #

  </span>
  
   <span class="form_right"> <?php echo $result->mobile ?> </span>
  
  
  </div>
  <div class="form_main1">
  <span class="form_left"> Designation

  </span>
  
   <span class="form_right"> <?php echo $result->designation ?> </span>
  
  
  </div>
  <div class="form_main1">
  <span class="form_left"> Role

  </span>
  
   <span class="form_right"> <?php echo $result->role ?> </span>
  
  
  </div>
  
   </div>
   
   <div class="form_mainright">
  <div class="form_main1">
  <span class="form_left"> Telephone #

  </span>
  
   <span class="form_right"> <?php echo $result->telephone ?> </span>
  
  
  </div>
  <div class="form_main1">
  <span class="form_left"> Caste

  </span>
  
  <span class="form_right"> <?php echo $result->caste ?> </span>
  
  </div>
    <div class="form_main1">
  <span class="form_left"> Address

  </span>
  
 <span class="form_right"> <?php echo $result->address ?> </span>
  
  
  </div>
  
      <div class="form_main1">
  <span class="form_left"> District 


  </span>
  
  <span class="form_right"> <?php echo $result->district ?> </span>
  
  </div>
  
       <div class="form_main1">
  <span class="form_left"> Taluk 


  </span>
  
  <span class="form_right"> <?php echo $result->taluk ?> </span>
  
  </div>
  <div class="form_main1">
  <span class="form_left"> Hobli


  </span>
  
  <span class="form_right"> <?php echo $result->hobli ?> </span>
  
  </div>
  
  <div class="form_main1">
  <span class="form_left"> Village


  </span>
  
  <span class="form_right"> <?php echo $result->village ?> </span>
  
  </div>
  <div class="form_main1">
  <span class="form_left"> RSK


  </span>
  
  <span class="form_right"> <?php echo $result->rsk ?> </span>
  
  </div>
  <div class="form_main1">
  <span class="form_left"> Green SIM Card


  </span>
  
  <span class="form_right"> <?php if($result->green_simcard==1){?> <input type="checkbox" checked disabled><?php }else{?> <input type="checkbox" disabled><?php } ?> </span>
  
  </div>
 
  </div> </div>
  
  
  <div class="deta_head"> Extra Information: </div>
<div class="form_mainf">
<div class="form_mainf">
<div class="form_mainleft">
  
	<div class="form_main1">
  <span class="form_left"> Created Date
  </span>
  
   <span class="form_right"> <?php 
   $ds=explode("-",$result->date);
$d=array_pop($ds);
$m=array_pop($ds);
$y=array_pop($ds);
$dt=$d."-".$m."-".$y;
   echo $dt; ?> </span>
   
  </div>
  <div class="form_main1">
  <span class="form_left"> Created By
  </span>
  
   <span class="form_right"> <?php echo $result->createdby; ?> </span>
   
  </div>
   <div class="form_main1">
  <span class="form_left"> User Id
  </span>
  
   <span class="form_right"> <?php echo $result->sno; ?> </span>
   
  </div>
   
   </div>
   
   <div class="form_mainright">
  
   <div class="form_main1">
  <span class="form_left">  Last Modified Date


  </span>
  
  <span class="form_right"> <?php
  
  $ds=explode("-",$result->modified_date);
$d=array_pop($ds);
$m=array_pop($ds);
$y=array_pop($ds);
$dt=$d."-".$m."-".$y;
 echo $dt; ?> </span>
  
  </div>
 <div class="form_main1">
  <span class="form_left"> Modified By
  </span>
  
   <span class="form_right"> <?php echo $result->modifiedby; ?> </span>
   
  </div>
 
  </div> </div>
   
   </div> 
   <!--
  <div class="btn_ali">
   <span class="new" style="margin-left:250px;"> <a href="userdetails.html">Save  </a> </span>
  <span class="new1"> <a href="userform.html">Cancel  </a> </span> </div>-->
  
  </div> </div>
  <?php include 'footer.php'; ?>