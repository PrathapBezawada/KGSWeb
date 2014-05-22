<?php
$userid=$_REQUEST['userid'];

include '../dbcon.php';
/*
$query=mysql_query("select hobli,village from users where sno='$userid' and del!=1 ");

$res_array= array();

if(mysql_num_rows($query)>0)
{

	while($result=mysql_fetch_array($query))
	{

		$response = array();
		$hobli=$result['hobli'];
		$villages=explode(",",$result['village']);

 		$i=0;
		foreach($villages as $village)
		{
			if($i==0)
				$response['village']=$village;
			else
				$response['village']=$response['village'].",".$village;
			$i++;

 		}
		$response['hobli'] =$hobli;

 	  $res_array[]=$response;
	}
 }

$res['VillageListResult']=$res_array;
echo json_encode($res);
*/







$query=mysql_query("select hobli,village,taluk from users where sno='$userid' and del!=1 ");

 //echo "select hobli,village from users where sno='$userid' and del!=1 ";
$res_array= array();

if(mysql_num_rows($query)>0)
{

	while($result=mysql_fetch_array($query))
	{

		$response = array();
		$village=$result['village'];
		$villages=explode(",",$result['village']);


		$taluk=$result['taluk'];
			//echo "taluk is ".$taluk;
		foreach($villages as $village)
				{

					$village=trim($village);

							//echo "<br>village is ".$village;
							$query1=mysql_query("select hobli_id from village where village_name='$village'");
						//	echo "<br>select hobli_id from village where village_name='$village'";
							$result1=mysql_fetch_array($query1);
							$hobli_id=$result1['hobli_id'];
						//	echo "<br>hobli is is ".$hobli_id;

							if( (strpos($taluk,',') != false))
								{
									$taluk_arr=explode(',',$taluk);
									 foreach($taluk_arr as $tlk)
									 {
											$tlk=trim($tlk);
											$query3=mysql_query("select taluk_id from taluk where taluk_name='$tlk'");
											$r3=mysql_fetch_array($query3);
											$taluk_id=$r3['taluk_id'];
											$query2=mysql_query("select hobli_name from hobli where hobli_id='$hobli_id' and taluk_id='$taluk_id'");
											//echo "select hobli_name from hobli where hobli_id='$hobli_id' and taluk_id='$taluk_id'";
											if(mysql_num_rows($query2)>0)
											{

												$r2=mysql_fetch_array($query2);
												$hobli=$r2['hobli_name'];
												$response['village']=$village;
												$response['hobli']=$hobli;
												$response['taluk']=$tlk;
												$i++;
									    }
								   }
								   	$res_array1[]=$response;
								}
							else
							{
							 $query3=mysql_query("select taluk_id from taluk where taluk_name='$taluk' ");
							$r3=mysql_fetch_array($query3);

							$taluk_id=$r3['taluk_id'];


							$query2=mysql_query("select hobli_name from hobli where taluk_id='$taluk_id' and hobli_id='$hobli_id'");
					  	//echo "select hobli_name from hobli where taluk_id='$taluk_id' and hobli_id='$hobli_id'";
					  	$r2=mysql_fetch_array($query2);
							$hobli=$r2['hobli_name'];

							//echo "<br>hobli name is".$hobli;

							//$query3=mysql_query("select taluk_name from taluk where taluk_id='$taluk_id'");

						//	echo "select taluk_name from taluk where taluk_id='$taluk_id'";

							//$r3=mysql_fetch_array($query3);
						//	$taluk=$r3['taluk_name'];

							$response['village']=$village;
							$response['hobli']=$hobli;
							$response['taluk']=$taluk;
							$i++;
							$res_array1[]=$response;
	         }
 					}

		   }

	 		 	  $res_array=$res_array1;


	 }

	$res['VillageListResult']=$res_array;
	echo json_encode($res);











?>