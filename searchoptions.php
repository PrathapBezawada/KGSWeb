<?php
$sval=$_POST['search'];
$d='';
if($sval=="farmer"){
	$d.="
	<form action='farmerresult.php' method='post'>
	<div class=\"serch_main\">
 <span class=\"search1\"> First Name </span>
 <input type=\"text\" name=\"fname\" class=\"txt_box_search\"> </div>
 <!-- <div class=\"serch_main\">
 <span class=\"search1\"> Last Name </span>
 <input type=\"text\" name=\"lname\" class=\"txt_box_search\"> </div> -->
 <div class=\"serch_main\">
 <span class=\"search1\"> Village</span>
 <input type=\"text\" name=\"village\" class=\"txt_box_search\"> </div>
 
  <input type=\"submit\" class=\"go\" Value=\"Go\" name=\"submit\" style=\"margin:20px 0px 0px 110px; float:left;\"/>
  </form> ";
}else{
	$d.="
	<form action='userresult.php' method='post'>
	<div class=\"serch_main\">
 <span class=\"search1\"> First Name </span>
 <input type=\"text\" name=\"fname\" class=\"txt_box_search\"> </div>
 <div class=\"serch_main\">
 <span class=\"search1\"> Last Name </span>
 <input type=\"text\" name=\"lname\" class=\"txt_box_search\"> </div>
 <div class=\"serch_main\">
 <span class=\"search1\"> User Id</span>
 <input type=\"text\" name=\"userid\" class=\"txt_box_search\"> </div>
 
  <input type=\"submit\" class=\"go\" Value=\"Go\" name=\"submit\" style=\"margin:20px 0px 0px 110px; float:left;\"/>
  </form> ";
}
echo $d;
?>