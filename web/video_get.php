<?php
include '../dbcon.php';
error_reporting(E_ALL);
$html='';

$html="<?xml version=\"1.0\" encoding=\"utf-8\"?>";
$html = $html ."<videos>";
$q=mysql_query("select * from video");

while($r=mysql_fetch_array($q))
{
    $html = $html ."<video>";
    $html = $html ."<title>".$r['title']."</title>";
    $html = $html ."<lenght>".$r['video_length']."</lenght>";
    $html = $html ."<thumbnail>".$r['thumbnail']."</thumbnail>";
    $html = $html ."<videourl>".$r['url']."</videourl>";
    $html = $html ."</video>";


}
$html = $html ."</videos>";
echo $html;



