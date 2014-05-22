<?php
include '../dbcon.php';
error_reporting(E_ALL);
$html='';
$req=(string)$_REQUEST['syncxml'];

/*
 $req='<?xml version=\'1.0\' encoding=\'UTF-8\' standalone=\'yes\'?>
 <CCEList>
 		<CCE Id="1"  UserName="ffchk1" FarmerID="2000002398" FarmID="583" Harvest_Date="4-11-2014" Harvest_Area="45" Fw_Pod_Fp="78" Fw_Fodder_Fp="89" Fw_Pod_Ip="6" Fw_Fodder_Ip="47" Ssfw_Pod_Fp="67" Ssfw_Fodder_Fp="67" Ssfw_Pod_Ip="45" Ssfw_Fodder_Ip="54" Cce_Image="" Latitude="78.4404465" Longitude="17.4336884" >

	</CCE>
 </CCEList>';


*/
$req = stripslashes($req);
$xml = simplexml_load_string($req);
$html="<?xml version=\"1.0\" encoding=\"utf-8\"?>";
$html = $html ."<". $xml->getName().">";

$date=date('Y-m-d');
$array=array();


foreach ($xml->children() as $child)
{
    //echo $child->getName();
    foreach($child->attributes() as $key => $val)
    {
        if($key==='ID')
        {
            $cce_old_id =$val;
        }

        if($key==='User_Name')
        {
            $cce_username =$val;
        }
        if($key==='FarmerID')
        {
            $cce_farmer_id=$val;
        }
        if($key==='FarmID')
        {
            $cce_farm_id=$val;
        }
        if($key==='Harvest_Date')
        {
            $cce_harvest_date=$val;
        }
        if($key==='Harvest_Area')
        {
            $cce_harvest_area=$val;
        }
        if($key==='Fw_Pod_Fp')
        {
            $cce_fw_pod_fp=$val;
        }
        if($key==='Fw_Fodder_Fp')
        {
            $cce_fodder_fp=$val;
        }
        if($key==='Fw_Pod_Ip')
        {
            $cce_pod_ip=$val;
        }
        if($key==='Fw_Fodder_Ip')
        {
            $cce_fw_fodder_ip=$val;
        }
        if($key==='Ssfw_Pod_Fp')
        {
             $cce_ssfw_pod_fp=$val;
        }
        if($key==='Ssfw_Fodder_Fp')
        {
            $cce_ssfw_fodder_fp=$val;
        }
        if($key==='Ssfw_Pod_Ip')
        {
            $cce_ssfw_pod_ip=$val;
        }
        if($key==='Ssfw_Fodder_Ip')
        {
            $cce_ssfw_fodder_ip=$val;
        }

        if($key==='Cce_Image')
        {
            $cce_image=$val;
        }
        if($key==='Latitude')
        {
            $cce_lat=$val;
        }
        if($key==='Longitude')
        {
             $cce_long=$val;
        }



    }
    $q=mysql_query("select  * from cce where sno='$cce_old_id'");

    $r=mysql_fetch_array($q);
    if(mysql_num_rows($q)>0)
    {
        $query="update cce set cce_username='$cce_username',cce_farmer_id='$cce_farmer_id',cce_farm_id='$cce_farm_id',cce_harvest_date='$cce_harvest_date',cce_harvest_area='$cce_harvest_area',
        cce_fw_pod_fp='$cce_fw_pod_fp',cce_fodder_fp='$cce_fodder_fp',cce_pod_ip='$cce_pod_ip',cce_fw_fodder_ip='$cce_fw_fodder_ip',cce_ssfw_pod_fp='$cce_ssfw_pod_fp',cce_ssfw_fodder_fp='$cce_ssfw_fodder_fp',cce_ssfw_pod_ip='$cce_ssfw_pod_ip',cce_ssfw_fodder_ip='$cce_ssfw_fodder_ip',cce_image='$cce_image',cce_lat='$cce_lat',cce_long='$cce_long' where sno='$cce_old_id'";

       // echo 'query is'.$query;
        mysql_query($query);


        $cce_new_id=$cce_old_id;
    }
    else
    {

    $query="insert into cce(cce_username,cce_farmer_id,cce_farm_id,cce_harvest_date,cce_harvest_area,cce_fw_pod_fp,cce_fodder_fp,cce_pod_ip,cce_fw_fodder_ip, cce_ssfw_pod_fp,cce_ssfw_fodder_fp,cce_ssfw_pod_ip,cce_ssfw_fodder_ip,cce_image,cce_lat,cce_long)
    values('$cce_username','$cce_farmer_id','$cce_farm_id','$cce_harvest_date','$cce_harvest_area','$cce_fw_pod_fp','$cce_fodder_fp','$cce_pod_ip','$cce_fw_fodder_ip','$cce_ssfw_pod_fp','$cce_ssfw_fodder_fp','$cce_ssfw_pod_ip','$cce_ssfw_fodder_ip','$cce_image','$cce_lat','$cce_long')";
        mysql_query($query);
        $cce_new_id=mysql_insert_id();
    }
   
    //echo $cce_new_id;
    $html.="<".$child->getName(). " oldid=\"".$cce_old_id."\" newid=\"".$cce_new_id."\" status=\"true\"/>";

}

$html.="</". $xml->getName().">";
echo $html;



