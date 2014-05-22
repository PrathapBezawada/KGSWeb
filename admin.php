<?php
ini_set('max_input_time', 900);
ini_set('max_execution_time', 900);


session_start();
$activetab="report";
include 'header.php'
;
/*$username=$_POST['username'];
$pass=$_POST['password'];
if($username=="nunc" && $pass=="nunc"){
	$_SESSION['user']='nunc';
}else{
	$_SESSION['error']='nunc';
}
if(!isset($_SESSION['user']))
{header("location:index.php");}	*/

  ?>


<div class="midd_right2">
 <div class="main_heads">
   <div class="farmer_head">List of Reports  </div>
  
  <!-- <div class="gr_border"> </div>-->


 

<table border="0px" cellpadding="0" cellspacing="0" width="100%">
<tr>
<th>&nbsp;  </th>
<th>&nbsp; </th>
<th>&nbsp; </th>
<th>&nbsp; </th>
<th>&nbsp; </th>
</tr>
<tr>
<td><a href="recinv.php">Recommendation Inventory</a>  </td>
<td>&nbsp; </td>
<td>&nbsp; </td>
<td>&nbsp; </td>
<td>&nbsp; </td>
</tr>


<?php


if($_SESSION['user_id']=='admin' ||$_SESSION['user_id']=='superadmin' )
{
?>
    <td>&nbsp; </td>
    <td>&nbsp; </td>
    <td>&nbsp; </td>
    <td>&nbsp; </td>
    <td>&nbsp; </td>
    </tr>
<tr class="td_even">
<td><a href="farmerscount.php">Farmers Report </a>   </td>
<td>&nbsp; </td>
<td>&nbsp; </td>
<td>&nbsp; </td>
<td>&nbsp; </td>
</tr>
<tr>
<td>&nbsp; </td>
<td>&nbsp; </td>
<td>&nbsp; </td>
<td>&nbsp; </td>
<td>&nbsp; </td>
</tr>



    <tr class="td_even">
        <td><a href="usedfertilizerlist.php">Actual Usage of Fertilizers</a>   </td>
        <td>&nbsp; </td>
        <td>&nbsp; </td>
        <td>&nbsp; </td>
        <td>&nbsp; </td>
    </tr>
    <tr>
        <td>&nbsp; </td>
        <td>&nbsp; </td>
        <td>&nbsp; </td>
        <td>&nbsp; </td>
        <td>&nbsp; </td>
    </tr>


<?php

}
?>

    <tr class="td_even">
        <td><a href="fieldvisitlist.php">Field Visit </a>   </td>
        <td>&nbsp; </td>
        <td>&nbsp; </td>
        <td>&nbsp; </td>
        <td>&nbsp; </td>
    </tr>
    <tr >
        <td>&nbsp; </td>
        <td>&nbsp; </td>
        <td>&nbsp; </td>
        <td>&nbsp; </td>
        <td>&nbsp; </td>
    <tr class="td_even">
        <td ><a href="traininglist.php">Training Report </a>   </td>
        <td>&nbsp; </td>
        <td>&nbsp; </td>
        <td>&nbsp; </td>
        <td>&nbsp; </td>
    </tr>
<tr >
<td>&nbsp; </td>
<td>&nbsp; </td>
<td>&nbsp; </td>
<td>&nbsp; </td>
<td>&nbsp; </td>
</tr>

<tr class="td_even">
<td><a href="farmerreccount.php">Recommendation Report </a>   </td>
<td>&nbsp; </td>
<td>&nbsp; </td>
<td>&nbsp; </td>
<td>&nbsp; </td>
</tr>

    <tr>
        <td>&nbsp; </td>
        <td>&nbsp; </td>
        <td>&nbsp; </td>
        <td>&nbsp; </td>
        <td>&nbsp; </td>
    </tr>
<tr class="td_even">
<td>&nbsp;</td>
<td>&nbsp; </td>
<td>&nbsp; </td>
<td>&nbsp; </td>
<td>&nbsp; </td>
</tr>

<tr>
<td>&nbsp; </td>
<td>&nbsp; </td>
<td>&nbsp; </td>
<td>&nbsp; </td>
<td>&nbsp; </td>
</tr>

<tr class="td_even">
<td>&nbsp; </td>
<td>&nbsp; </td>
<td>&nbsp; </td>
<td>&nbsp; </td>
<td>&nbsp; </td>
</tr>
<tr>
<td>&nbsp; </td>
<td>&nbsp; </td>
<td>&nbsp; </td>
<td>&nbsp; </td>
<td>&nbsp; </td>
</tr>

<tr class="td_even">
<td>&nbsp; </td>
<td>&nbsp; </td>
<td>&nbsp; </td>
<td>&nbsp; </td>
<td>&nbsp; </td>
</tr>
<tr>
<td>&nbsp; </td>
<td>&nbsp; </td>
<td>&nbsp; </td>
<td>&nbsp; </td>
<td>&nbsp; </td>
</tr>

<tr class="td_even">
<td>&nbsp; </td>
<td>&nbsp; </td>
<td>&nbsp; </td>
<td>&nbsp; </td>
<td>&nbsp; </td>
</tr>
<tr>
<td>&nbsp; </td>
<td>&nbsp; </td>
<td>&nbsp; </td>
<td>&nbsp; </td>
<td>&nbsp; </td>
</tr>

<tr class="td_even">
<td>&nbsp; </td>
<td>&nbsp; </td>
<td>&nbsp; </td>
<td>&nbsp; </td>
<td>&nbsp; </td>
</tr>
<tr>
<td>&nbsp; </td>
<td>&nbsp; </td>
<td>&nbsp; </td>
<td>&nbsp; </td>
<td>&nbsp; </td>
</tr>

<tr class="td_even">
<td>&nbsp; </td>
<td>&nbsp; </td>
<td>&nbsp; </td>
<td>&nbsp; </td>
<td>&nbsp; </td>
</tr>
</table>

</div> </div>
 
<?php include 'footer.php';?>