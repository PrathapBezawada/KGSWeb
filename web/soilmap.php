<?php
$district=$_REQUEST['district'];
include '../dbcon.php';
$response=array();
	$re=array();
	$directory="/home/krishigy/public_html/maps/".$district."/";
	$crops = "";$n=1;
		 foreach (scandir($directory) as $file)
		 {
		   if ('.' === $file) continue;
       if ('..' === $file) continue;

       $file_name = basename($file, ".pdf");
	   $exts=explode(".",$file_name);
	   $ext=array_pop($exts);
	   if($ext!="jpg") continue;
	   $f=implode(".",$exts);
	   $exts=explode("_",$f);
	   $f=ucwords(array_pop($exts));
	   $dct=str_replace("/home/krishigy/public_html","http://www.krishigyansagar.com",$directory);
	   $cs=substr($file_name,0,-4);
	   $css=explode("_",$cs);
	   $cn=array_pop($css);
     $response['cropname']=$cn;
	$response['cropurl']=$dct.$file_name;

array_push($re,$response);
		 }
$res1['SoilMaps']=$re;
echo json_encode($res1);
?>