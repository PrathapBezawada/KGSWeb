<?php
include 'dbcon.php';

ob_start();

header("Content-Type: application/vnd.ms-excel");
if($_SESSION['user_id']!="admin" && $_SESSION['user_id']!="superadmin" )
{
    $user=$_SESSION['user_id'];
    $query = "select * from farmers where createdby='$user' and del!=1 order by fname asc";
}

else
{
    $query=mysql_query("select * from farmers");


}
echo 'First Name' . "\t" . 'Last Name' . "\t" . 'Phone' . "\t" . 'Gender' . "\t" . 'Father Name' . "\t" . 'District'. "\t" . 'Taluk'. "\t" . 'Hobli'. "\t" . 'Village'. "\t" . 'Toal Area'. "\t" . 'Rainfed'. "\t" . 'Irrigated'. "\t" . 'Plantation'. "\t" . 'Fallow'. "\t" . 'Survey No'."\n";

while($result=mysql_fetch_array($query))
{
echo $result['fname'] . "\t" . $result['lname'] . "\t" . $result['mobile']  . "\t" . $result['gender']  . "\t" . $result['fatname']  . "\t" . $result['district	']  . "\t" . $result['taluk'] . "\t" . $result['hobli']. "\t" . $result['village']. "\t" . $result['area_total']. "\t" . $result['rainfed']. "\t" . $result['irrigated']. "\t" . $result['plantation']. "\t" . $result['fallow']. "\t" . $result['surveyno'].  "\n";


}

header("Content-disposition: attachment; filename=famerslist.xls");







?>