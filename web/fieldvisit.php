<?php
include '../dbcon.php';
error_reporting(E_ALL);
$html='';
$req=(string)$_REQUEST['syncxml'];

/*
$req='<?xml version=\'1.0\' encoding=\'UTF-8\' standalone=\'yes\' ?><Fieldvisits><Fieldvisitor Id="a476838d-ed6c-4a53-940c-96b735e85f6f" UserName="ffchk1" FarmerID="2000002398" FarmID="583" Title="" State="Andhra" District="Nellore" Taluk="Kovur" Village="Ramanapalem" Purpose="Pre-sowing Visit" Observation="testing observation" Recommendation="testing comments" Image="" Date="05/04/2014" Latitude="17.4305772" Longitude="/storage/sdcard0/Samsung/Image/1024x600_05.jpg" /></Fieldvisits>';
*/

        $req = stripslashes($req);
        $xml = simplexml_load_string($req);
        $html="<?xml version=\"1.0\" encoding=\"utf-8\"?>";
        $html = $html ."<". $xml->getName().">";
        $psd='';
        $fsd='';
        $date=date('Y-m-d');
        $array=array();
        $array['abc']="abc";
        $fv_user='';
        $fv_state='';
        foreach ($xml->children() as $child)
        {
        //echo $child->getName();
                foreach($child->attributes() as $key => $val)
                {

                    if($key=='Id')
                    {
                        $fv_id=$val;
                    }
                    if($key==='UserName')
                    {
                        $fv_user =$val;
                    }
                    if($key==='FarmerID')
                    {
                        $fv_farmer_id=$val;
                    }
                    if($key==='FarmID')
                    {
                        $fv_farm_id=$val;
                    }
                    if($key==='Date')
                    {
                    $fv_date=trim($val);
                    }
                    if($key==='Title')
                    {
                    $fv_title=$val;
                    }
                    if($key==='Purpose')
                    {
                    $fv_purpose=$val;
                    }
                    if($key==='Observation')
                    {
                        $fv_observation=$val;
                    }
                    if($key==='Recommendation')
                    {
                    $fv_rec=$val;
                    }
                    if($key==='Image')
                    {
                    $fv_image=$val;
                    } if($key==='Latitude')
                    {
                    $fv_lat=$val;
                    }
                    if($key==='Longitude')
                    {
                    $fv_lng=$val;
                    }
                    if($key==='Date')
                    {
                    $fv_date=$val;
                    }
                    if($key=='State')
                    {
                        $fv_state=$val;
                    }
                    if($key=='District')
                    {
                        $fv_district=$val;
                    }
                    if($key=='Taluk')
                    {
                        $fv_taluk=$val;
                    }
                    if($key=='Hobli')
                    {
                        $fv_hobli=$val;
                    }
                    if($key=='Village')
                    {
                        $fv_village=$val;
                    }

                }
                $query="insert into fieldvisit(fv_state,fv_district,fv_taluk,fv_village,fv_purpose,fv_title,fv_observation,fv_rec,fv_user, fv_picture,fv_lat,fv_lng,fv_Date,fv_farmer_id,fv_farm_id,fv_hobli)
                values('$fv_state','$fv_district','$fv_taluk','$fv_village','$fv_purpose','$fv_title','$fv_observation','$fv_rec','$fv_user','$fv_image','$fv_lat','$fv_lng','$fv_date','$fv_farmer_id','$fv_farm_id','$fv_hobli')";
                //echo $query."<br>";
                mysql_query($query);
                $fv_new_id=mysql_insert_id();
            //echo $fv_new_id;
                $html.="<".$child->getName()." oldid=\"".$fv_id."\" newid=\"".$fv_new_id."\" status=\"true\"/>";
                }

$html.="</". $xml->getName().">";
echo $html;



