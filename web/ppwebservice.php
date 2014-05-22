<?php

$useid=$_RESUEST['userid'];
$district=$_REQUEST['district'];
$crop=$_REQUEST['crop_type'];

$crop='Audadal-Yallu';
$filename=$crop.'pdf';
$filename='Audadal-Yallu.pdf';
//$filename='Audadal-Yallu.pdf';
header('Content-type: application/pdf');
// It will be called downloaded.pdf
header('Content-Disposition: attachment; filename="downloaded.pdf"');
//header('Content-Disposition: attachment; filename='.$crop.".pdf");
// The PDF source is in original.pdf
readfile('crops/'.$filename);
//readfile('../crops/'.$filename);




?>

