<?php 
//$activetab="home";
include 'header.php';?>
<div class="midd_right1">
 <div class="main_heads">
  <div class="farmer_head">Admin - Users  List  </div>
  
  <div class="btn_m">
  <?php if(isset($_SESSION['superadmin'])){ ?>
  <button type="submit" name="submit" onclick="window.location='userform.php';" class="new">New</button> 
  <?php } ?>
  </div>
  
  
  
 <div style="float:left; overflow:scroll; height:400px; width:840px; margin-left:5px;">
 <table border="0px" cellpadding="0" cellspacing="0">

   <tr>
   <?php if($_SESSION['user_id']=='superadmin')
    {?>
   <th>&nbsp;  </th>
 <?php
 	}
 	?>
 
 <th> First Name  </th>
<th> Last Name</th>
<th> User ID</th>
<th> Role</th>
<th> Mobile Number</th>
<th> Designation</th>
<th> District</th>
<th> Taluk</th>
<th> Hobli</th>
<th> Village</th>
<th> Green SIM</th>
 </tr>
 <?php
 
 $query=mysql_query("select * from users where del!=1");
 
// $query=mysql_query("select * from users where role not in('Super Admin','FF') and  del!=1");
 
 
 $n=1;
	while($result=mysql_fetch_array($query)){
		if($n%2==0){$cls="td_even";}else{
		$cls="td_odd";}$n++;
?>
 <tr class="<?php echo $cls ?>">
   <?php if($_SESSION['user_id']=='superadmin')
     {?>
  
 <td><a href="useredit.php?uid=<?php echo $result['userid']?>&n=0" style='text-decoration:none; '>  Edit </a> </td>
 
  <?php
  	}
 	?>
 
 <td><a href="userdetails.php?uid=<?php echo $result['userid']?>" style='text-decoration:none; '><?php echo $result['fname']?> </a> </td>
  <td> <?php echo $result['lname']?></td>
   <td><?php echo $result['userid']?>  </td>
   <td><?php echo $result['role']?>  </td>
    <td> <?php echo $result['mobile']?> </td>
    <td  > <?php echo $result['designation']?> </td>
     <td> <?php echo $result['district']?> </td>
     <td><?php echo substr($result['taluk'],0,25)?> </td>
     <td><?php echo substr($result['hobli'],0,25)?> </td>
  <td> <?php echo substr($result['village'],0,25)?></td>
   <td> <?php if($result['green_simcard']==1){?><input type="checkbox" checked disabled="disabled" /> <?php }else{?><input type="checkbox" disabled="disabled" /><?php } ?></td>
   
     
     
      
 </tr>
<?php }
if($n<=17){
while($n<=17){
		if($n%2==0){$cls="td_even";}else{
		$cls="td_odd";}$n++;
?>
 <tr class="<?php echo $cls ?>">
 <td></td>
 <td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>


<td align="center"></td>
<td align="center"></td>

</tr>
<?php
}
} 

?> 
 
 </table> </div>
</div> 
</div>
<?php include 'footer.php';?>