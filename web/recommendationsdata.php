<?php
$district=$_REQUEST['district'];
$taluk=$_REQUEST['taluk'];
$taluk_main=$taluk;
include '../dbcon.php';
$response=array();
	$re=array();
	
	
	$district=trim($district);


		if($district ==='Mahabubnagar')
	 
	          {
	            
				 $taluk_main=$taluk;
	               $district='Bellary';
	               $taluk='Sandur';
             }

	if( (strpos($taluk,',') != false))
	{
		$taluk_arr=explode(',',$taluk);
		 foreach($taluk_arr as $tlk)
		 {
			$tlk=trim($tlk);
			$query=mysql_query("select * from rec where district='$district' and taluk='$tlk' order by crop_type");
			
				if(mysql_num_rows($query)>0)
				{
					while($result=mysql_fetch_array($query))
					{
						$response['crop_type']=$result['crop_type'];
						$response['urea']=$result['urea'];
						$response['dap']=$result['dap'];
						$response['mop']=$result['mop'];
						$response['gypsum']=$result['gypsum'];
						$response['zinc_sulphate']=$result['zinc_sulphate'];
						$response['borax']=$result['borax'];
						$response['ssp']=$result['ssp'];
						$response['ssp_urea']=$result['ssp_urea'];
						$response['ssp_gypsum']=$result['ssp_gypsum'];
						$response['ssp_dap']=$result['ssp_dap'];
						$response['taluk']=$tlk;
						array_push($re,$response);
					}
					//echo "<br>recommandations of".$tlk;
					//print_r($re);
				}
				else
					{
						$response['crop_type']="";
						$response['urea']="";
						$response['dap']="";
						$response['mop']="";
						$response['gypsum']="";
						$response['zinc_sulphate']="";
						$response['borax']="";
						$response['ssp']="";
						$response['ssp_urea']="";
						$response['ssp_gypsum']="";
						$response['ssp_dap']="";
				    $response['taluk']="";

						array_push($re,$response);
					}
		 }
	
}
	
else
{

	$query=mysql_query("select * from rec where district='$district' and taluk='$taluk' order by crop_type");
	//echo "select * from rec where district='$district' and taluk='$taluk' order by crop_type";
	if(mysql_num_rows($query)>0)
	{
		while($result=mysql_fetch_array($query))
		{
			$response['crop_type']=$result['crop_type'];
			$response['urea']=$result['urea'];
			$response['dap']=$result['dap'];
			$response['mop']=$result['mop'];
			$response['gypsum']=$result['gypsum'];
			$response['zinc_sulphate']=$result['zinc_sulphate'];
			$response['borax']=$result['borax'];
			$response['ssp']=$result['ssp'];
			$response['ssp_urea']=$result['ssp_urea'];
			$response['ssp_gypsum']=$result['ssp_gypsum'];
			$response['ssp_dap']=$result['ssp_dap'];
			$response['taluk']=$taluk_main;;

			array_push($re,$response);
		}
	}
	else
	{
		$response['crop_type']="";
		$response['urea']="";
		$response['dap']="";
		$response['mop']="";
		$response['gypsum']="";
		$response['zinc_sulphate']="";
		$response['borax']="";
		$response['ssp']="";
		$response['ssp_urea']="";
		$response['ssp_gypsum']="";
		$response['ssp_dap']="";
		$response['taluk']="";

		array_push($re,$response);
	}
}


$res1['CropRecommendations']=$re;
echo json_encode($res1);
?>