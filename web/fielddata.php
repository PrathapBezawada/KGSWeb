<?php
$fid=$_REQUEST['farmerid'];
include '../dbcon.php';
$response=array();
	$re=array();
$query=mysql_query("select * from farms where fid='$fid' and del!=1");
if(mysql_num_rows($query)>0){
	
	while($result=mysql_fetch_array($query)){
$response['fieldid']=$result['sno'];
$response['farm_name']=$result['farm_name'];
$response['fields']=$result['fields'];
$response['total_farm_area']=$result['total_farm_area'];
$response['cultivation_area']=$result['cultivation_area'];
$response['crop_name']=$result['crop_name'];
$response['crop_variety']=$result['crop_variety'];
$response['village']=$result['village'];
        $response['year']=$result['year'];
        $response['season']=$result['season'];
        $response['sowing_date']=$result['sowing_date'];
        $response['field_image']=$result['field_image'];
        $response['govtsubsidy']=$result['govtsubsidy'];
        $response['seed_rate']=$result['seed_rate'];
        $response['seed_source']=$result['seed_source'];
        $response['field_urea']=$result['field_urea'];
        $response['field_dap']=$result['field_dap'];
        $response['field_potash']=$result['field_potash'];
        $response['field_complex']=$result['field_complex'];
        $response['field_zinc']=$result['field_zinc'];
        $response['field_borax']=$result['field_borax'];
        $response['field_gypsum']=$result['field_gypsum'];
        $response['farm_lat']=$result['farm_lat'];
        $response['farm_long']=$result['farm_long'];


array_push($re,$response);
}
}else{
	$response['fieldid']="";
    $response['farm_name']="";
    $response['fields']="";
    $response['total_farm_area']="";
    $response['cultivation_area']="";
    $response['crop_name']="";
    $response['crop_variety']="";
    $response['village']="";
    $response['year']="";
    $response['season']="";
    $response['sowing_date']="";
    $response['field_image']="";
    $response['govtsubsidy']="";
    $response['seed_rate']="";
    $response['seed_source']="";
    $response['field_urea']="";
    $response['field_dap']="";
    $response['field_potash']="";
    $response['field_complex']="";
    $response['field_zinc']="";
    $response['field_borax']="";
    $response['field_gypsum']="";
    $response['farm_lat']="";
    $response['farm_long']="";

array_push($re,$response);
}
$res1['FieldListResult']=$re;
echo json_encode($res1);
?>