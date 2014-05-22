<?php
include '../dbcon.php';
error_reporting(E_ALL);
$html='';
$req=(string)$_REQUEST['syncxml'];


/*
$req='<?xml version=\'1.0\' encoding=\'UTF-8\' standalone=\'yes\' ?><audiosList><audios><audio Id="a8f75bcc-f163-4ecf-ab4e-16a8ac510858" Title="Test" Description="Test Device" audio_path="20140511_171001.jpg" type="Image" Date="2014-05-11" /><audio Id="b06b670b-390d-4432-9dc7-2fac03785161" Title="Test img2" Description="Testing" audio_path="1024X600_02.jpg" type="Image" Date="2014-05-11" /><audio Id="9c365eff-dea9-47d2-8eb9-a0be9d6865b6" Title="Testt audio" Description="Testing audio" audio_path="20140511_171130.mp4" type="audio" Date="2014-05-11" /><audio Id="dd1816ec-5274-439f-94fe-371e335c0ed5" Title="Test2" Description="Videi" audio_path="20140505_175723.mp4" type="audio" Date="2014-05-11" /></audios></audiosList>';
*/
$req = stripslashes($req);
$xml = simplexml_load_string($req);
$html="<?xml version=\"1.0\" encoding=\"utf-8\"?>";
$html = $html ."<". $xml->getName().">";
//echo $xml->getName();
$psd='';
$fsd='';
$date=date('Y-m-d');
$array=array();
$array['abc']="abc";
$fv_user='';
$fv_state='';
$tr_record='';
foreach ($xml->children() as $child1)
{
    //echo "<br>".$child->getName();

    foreach ($child1->children() as $child)
    {


        foreach($child->attributes() as $key => $val)
        {

            if($key=='Id')
            {
                $id=$val;
            }
            if($key==='Title')
            {
                $title=$val;
            }
            if($key=='Description')
            {
                $description=$val;
            }
            if($key=='audio_path')
            {
                $audio_path=$val;
            }
            if($key=='type')
            {
                $type=$val;
            }
            if($key=='Date')
            {
                $date=$val;
            }


        }
        $url="http://www.krishigyansagar.com/fphotos/test/".$audio_path;
        $query=" INSERT INTO `audio`(`tittle`, `url`, `thumbnail`, `audio_length`, `description`, `audio_path`, `type`, `date`)
  VALUES ('$title', '$url', '', '', '$description', '$audio_path', '$type', '$date')";



        //echo $query."<br>";
        mysql_query($query);
        $v_new_id=mysql_insert_id();
        //echo $fv_new_id;
        $html.="<".$child->getName()." oldid=\"".$id."\" newid=\"".$v_new_id."\" status=\"true\"/>";
    }
}

$html.="</". $xml->getName().">";
echo $html;



