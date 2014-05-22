<?php
include '../dbcon.php';
error_reporting(E_ALL);
$html='';
$req=(string)$_REQUEST['syncxml'];


/*
$req='<?xml version=\'1.0\' encoding=\'UTF-8\' standalone=\'yes\' ?><TrainingRecords><TrainingRecord Id="1fed96d0-a891-4005-a31c-7052f5426198" UserId="1000004170" UserName="ffchk1" TrainingLevel="Taluk level" State="Karnataka" District="Bangalore(R)" Taluk="Doddaballapura" Hobli="Sasalu" Village="Test" Male="67" Female="78" TrainingTopic="test" TrainingFeedback="tefg" Image="sm_7.jpg" Date="1900/1/31 " Latitude="17.4304539" Longitude="78.4410732" /></TrainingRecords>';
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
$tr_record='';
foreach ($xml->children() as $child)
{
    //echo $child->getName();
    foreach($child->attributes() as $key => $val)
    {

        if($key=='Id')
        {
            $tr_id=$val;
        }


        if($key==='UserName')
        {
            $tr_username =$val;
        }
        if($key==='TrainingLevel')
        {
            $tr_level=$val;
        }
        if($key=='State')
        {
            $tr_state=$val;
        }
        if($key=='District')
        {
            $tr_district=$val;
        }
        if($key=='Taluk')
        {
            $tr_taluk=$val;
        }
        if($key=='Hobli')
        {
            $tr_hobli=$val;
        }
        if($key=='Village')
        {
            $tr_village=$val;
        }
        if($key=='Male')
        {
            $tr_male=$val;
        }
        if($key=='Female')
        {
            $tr_female=$val;
        }
        if($key=='TrainingTopic')
        {
            $tr_topic=$val;
        }
        if($key=='TrainingFeedback')
        {
            $tr_feedback=$val;
        }

        if($key==='Image')
        {
            $tr_image=$val;
        }
        if($key==='Date')
        {
            $tr_date=$val;
        }
        if($key==='Latitude')
        {
         $tr_lat=$val;
        }
        if($key==='Longitude')
        {
            $tr_lng=$val;
        }


    }
    $query="insert into training (tr_username,tr_level,tr_state,tr_district,tr_taluk,tr_hobli,tr_village, tr_male,tr_female,tr_topic,tr_feedback,tr_image,tr_lat,tr_lng,tr_date)
					values ('$tr_username','$tr_level','$tr_state','$tr_district','$tr_taluk','$tr_hobli','$tr_village','$tr_male','$tr_female','$tr_topic','$tr_feedback','$tr_image','$tr_lat','$tr_lng','$tr_date')";




    //echo $query."<br>";
    mysql_query($query);
    $tr_new_id=mysql_insert_id();
    //echo $fv_new_id;
    $html.="<".$child->getName()." oldid=\"".$tr_id."\" newid=\"".$tr_new_id."\" status=\"true\"/>";
}

$html.="</". $xml->getName().">";
echo $html;



