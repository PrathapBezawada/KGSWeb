<?php
include '../dbcon.php';
error_reporting(E_ALL);
$html='';

$html="<?xml version=\"1.0\" encoding=\"utf-8\"?>";
$html = $html ."<audios>";
$q=mysql_query("select * from audio");

while($r=mysql_fetch_array($q))
{
    $html = $html ."<audio>";
    $html = $html ."<title>".$r['tittle']."</title>";
    $html = $html ."<lenght>".$r['audio_length']."</lenght>";
    $html = $html ."<thumbnail>".$r['thumbnail']."</thumbnail>";
    $html = $html ."<audiourl>".$r['url']."</audiourl>";
    $html = $html ."</audio>";


}
$html = $html ."</audios>";
echo $html;



