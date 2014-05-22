<?php
include '../dbcon.php';
error_reporting(E_ALL);


  	$html='';
	
  	$req=(string)$_REQUEST['syncxml'];



/*$req='<?xml version=\'1.0\' encoding=\'UTF-8\' standalone=\'yes\' ?><FarmFacilitators><FarmFacilitator Id="1000004218" Name="ffchk5" Taluk="Chikmagalur" District="Chikmagalur" Partial_Sync_Date="Tue May 20 13:56:21 GMT+05:30 2014" Full_Sync_Date="Tue May 20 12:55:03 GMT+05:30 2014"><Farmers /><Fields><Field Farmer_ID="2000002657" Farm_ID="762" Farm_Name="Farm3" Field_Image="11444152231.png" Year="2018" Season="Kharif" Survey_No="" Sowing_Date="2014-5-20" Seed_Rate="" Seed_Source="Select Seed Source" Govt_Subsidy="" Urea="0" Dap="0" Potash="0" Complex="0" Zinc="0" Borax="0" Gypsum="0" Fields="" Farm_Area="34" Cult_Area="23" Crop_Name="Cardamom" Crop_Variety="" Farm_Village="Indavara" Created_Date="Tue May 20 13:47:44 GMT+05:30 2014" LastModified_Date="Tue May 20 13:56:34 GMT+05:30 2014" Latitude="17.430707713978737" Longitude="78.44137414054671" /></Fields></FarmFacilitator></FarmFacilitators>';
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
foreach ($xml->children() as $child)
{
	//echo $child->getName();
	foreach($child->attributes() as $key => $val) 
	{ 
		if($key=='Id')
		$ffc_id=$val;
		
		if($key==='Name')
		{
		$ff_name=$val;
		
		}
			
		if($key==='Taluk')
		{
		 $ff_Taluk=trim($val);
		 }
	   if($key==='District')
		  {
		  $district=$val;
		  }
		if($key==='Partial_Sync_Date')
		  {
		  $psd=$val;
		  }
		if($key==='Full_Sync_Date')
		{
		  $fsd=$val;
		} 
	}
	$query=mysql_query("select sno from users where userid='$ff_name' and taluk='$ff_Taluk' and district='$district' ");
  	$result1=mysql_fetch_array($query);
	$ffid=$result1['sno'];
	mysql_query("update users set last_partial_sync_date='$psd',last_full_sync_date='$fsd' where sno='$ffid'")or die(mysql_error()); 
	$html= $html ."<".$child->getName()." oldid=\"$ffc_id\" newid=\"$ffc_id\" >" ;
    $farmer_dist=$farmer_taluk='';
	foreach( $child->children() as $farmers)
	{
		$ftype=$farmers->getName();
		$html.="<".$ftype.">";
		if($ftype=="Farmers"){
			foreach( $farmers->children() as $frs)
			{
				
				//echo $frs->getName();
				foreach($frs->attributes() as $key => $val) 
				{
					if($key=='Farmer_ID')
					$farmer_id=$val;
					else if($key=='First_Name')	
					$farmer_fname=$val;
					else if($key=='Last_Name')	
					$farmer_lname=$val;
					else if($key=='Sex')	
					$farmer_gender=$val;
					else if($key=='Father_Name')	
					$farmer_fathername=$val;
					else if($key=='Mobile_No')	
					$farmer_mobile=$val;
					else if($key=='Telephone_No')	
					$farmer_tele=$val;
					else if($key=='Caste')	
					$farmer_caste=$val;
					else if($key=='District')	
					$farmer_dist=$val;
					else if($key=='Taluk')	
					$farmer_taluk=$val;
					else if($key=='Hobli')	
					$farmer_hobli=$val;
					else if($key=='Village')	
					$farmer_village=$val;
					else if($key=='PinCode')	
					$farmer_pincode=$val;
					else if($key=='Farmer_Image')	
					$image=$val;
					else if($key=='Total_Acre')	
					$farmer_area=$val; 
					else if($key=="Rain_Fed")	
					$farmer_rain=$val; 
					else if($key=="Irrigated")	
					$farmer_irr=$val;
					else if($key=="Plantation")	
					$farmer_plant=$val;
					else if($key=="Fallow")	
					$farmer_fallow=$val;
					else if($key=="Survey_No")	
					$farmer_survey=$val;
					else if($key=="ID_Type")	
					$farmer_id_type=$val;
					else if($key=="ID_No")	
					$farmer_id_no=$val;
					else if($key=="Latitude")	
					$farmer_lat=$val;
					else if($key=="Longitude")	
					$farmer_long=$val;
					//else //echo $key;
					
				}
				$query=mysql_query("select * from farmers where sno='$farmer_id'");
				if(mysql_num_rows($query)>0 )
				{
				// mysql_query("update `farmers` set fname = '$farmer_fname',lname = '$farmer_lname', telephone='$farmer_tele', `gender`='$farmer_gender', `fatname`='$farmer_fathername', `mobile`='$farmer_mobile',`caste`='$farmer_caste', `address`='$farmer_address', `district`='$farmer_dist', `taluk`='$farmer_taluk', `hobli`='$farmer_hobli', `village`='$farmer_village', `pincode`='$farmer_pincode', `area_total`='$farmer_area', `rainfed`='$farmer_rain', `irrigated`='$farmer_irr', `plantation`='$farmer_plant', `fallow`='$farmer_fallow', `surveyno`='$farmer_survey',`modifiedby`='$ffid',`modified_date`='$date',`createdby`='$ffid',photo='$image' where sno='$farmer_id'") or die(mysql_error());
				  mysql_query("update `farmers` set fname = '$farmer_fname',lname = '$farmer_lname', telephone='$farmer_tele', `gender`='$farmer_gender', `fatname`='$farmer_fathername', `mobile`='$farmer_mobile',`caste`='$farmer_caste',`district`='$farmer_dist', `taluk`='$farmer_taluk', `hobli`='$farmer_hobli', `village`='$farmer_village',ID_type='$farmer_id_type',ID_no='$farmer_id_no', `area_total`='$farmer_area', `rainfed`='$farmer_rain', `irrigated`='$farmer_irr', `plantation`='$farmer_plant', `fallow`='$farmer_fallow', `surveyno`='$farmer_survey', `date`= '$date',`modifiedby`='$ffid',`modified_date`='$date',`createdby`='$ffid',photo='$image',Loc_Lat='$farmer_lat',Loc_Long='$farmer_long' where sno='$farmer_id'") or die(mysql_error());
  				$fr_id=$farmer_id;
				}
				else
				{
				
				//mysql_query("INSERT INTO `farmers`(`fname`,`lname`, `telephone`, `gender`, `fatname`, `mobile`,  `caste`, `address`, `district`, `taluk`, `hobli`, `village`, `pincode`, `area_total`, `rainfed`, `irrigated`, `plantation`, `fallow`, `surveyno`, `date`, `modifiedby`, `modified_date`, `createdby`,photo) VALUES ('$farmer_fname','$farmer_lname','$farmer_tele', '$farmer_gender', '$farmer_fathername', '$farmer_mobile', '$farmer_caste', '$farmer_address', '$farmer_dist', '$farmer_taluk', '$farmer_hobli', '$farmer_village', '$farmer_pincode', '$farmer_area', '$farmer_rain', '$farmer_irr', '$farmer_plant', '$farmer_fallow', '$farmer_survey', '$date', '$ffid', '$date', '$ffid','$image')") or die(mysql_error());
				 
				 mysql_query("INSERT INTO `farmers`(`fname`,`lname`, `telephone`, `gender`, `fatname`, `mobile`,  `caste`, `district`, `taluk`, `hobli`, `village`,ID_type,ID_no,`area_total`, `rainfed`, `irrigated`, `plantation`, `fallow`, `surveyno`, `date`, `modifiedby`, `modified_date`, `createdby`,photo,Loc_Lat,Loc_Long)
				 VALUES ('$farmer_fname','$farmer_lname','$farmer_tele', '$farmer_gender', '$farmer_fathername', '$farmer_mobile', '$farmer_caste','$farmer_dist', '$farmer_taluk', '$farmer_hobli', '$farmer_village','$farmer_id_type','$farmer_id_no','$farmer_area', '$farmer_rain', '$farmer_irr', '$farmer_plant', '$farmer_fallow', '$farmer_survey', '$date', '$ffid', '$date', '$ffid','$image','$farmer_lat','$farmer_long')") or die(mysql_error());
				 $fr_id=mysql_insert_id();
  			}



				 //echo $farmer_id;
				 //echo $fr_id;
				// $fff='a'.$farmer_id;
				 $array[(string)$farmer_id]=trim($fr_id);
				 //$array['abc']="abcd";
				// echo "here";
				$html.="<".$frs->getName()." oldid=\"".$farmer_id."\" newid=\"".$fr_id."\" status=\"true\"/>";
			}
		}
		elseif($ftype=="Fields")
		{
			//$array['abc']="abcd";
			//print_r($array);
			foreach( $farmers->children() as $flds)
			{
				//echo $flds->getName();
				foreach($flds->attributes() as $key => $val) 
				{
					if($key=='Farm_ID')
					$field_old_id=$val;
					if($key=='Farmer_ID')
					$field_farmer_id=$val;
					 
					if($key==='Farm_Name') 
					$field_name=$val;
					if($key=== 'Fields')
					$field_fields=$val;
					
					if($key==='Crop_Name') 
					$field_cropname=$val;
					
					if($key==='Crop_Variety')
					$field_cropVariety=$val;
					
					if($key==='Farm_Village')
					$field_village=$val;
					
					
					if($key==='Farm_Area')
					$field_totalArea=$val;
					
					if($key==='Cult_Area')
					$field_cultivationArea=$val;
						
					if($key==='Latitude')
					$field_lat=$val;
					
					
				 if($key==='Longitude')
				 $field_long=$val;

                    if($key==='Year')
                        $field_year=$val;

                    if($key==='Season')
                        $field_season=$val;

                    if($key==='Survey_No')
                        $field_surveyno=$val;

                    if($key==='Sowing_Date')
                        $field_sowing=$val;

                    if($key==='Seed_Rate')
                        $field_seedrate=$val;

                    if($key==='Seed_Source')
                        $field_seedsrc=$val;

                    if($key==='Govt_Subsidy')
                        $field_govtsubsidy=$val;

                    if($key==='Urea')
                        $field_urea=$val;

                    if($key==='Dap')
                        $field_dap=$val;

                    if($key==='Potash')
                        $field_potash=$val;

                    if($key==='Complex')
                        $field_complex=$val;

                    if($key==='Zinc')
                        $field_zinc=$val;

                    if($key==='Borax')
                        $field_borax=$val;

                    if($key==='Gypsum')
                        $field_gypsum=$val;

                    if($key  ==='Field_Image')
                        $field_image=$val;


				}



				//if(count($array)>0){
				if(array_search(trim($field_farmer_id),array_keys($array))!="")
				{
					$f_id=$array[(string)$field_farmer_id];
				}
				else
				{
					$f_id=$field_farmer_id;
				}
				$query=mysql_query("select * from farms where sno='$field_old_id' and fid='$f_id'");


				if(mysql_num_rows($query)>0 )
				{

                    //echo "update `farms` set farm_name='$field_name',`fields`='$field_fields',`total_farm_area`=$field_totalArea, `cultivation_area`='$field_cultivationArea', `crop_name`='$field_cropname', `crop_variety`='$field_cropVariety',`village`='$field_village',`del`=0 , `farm_lat`='$field_lat' ,`farm_long`='$field_long',`year`='$field_year',`season`='$field_season',`sowing_date`='$field_sowing',`field_image=`'$field_image',`govtsubsidy`='$field_govtsubsidy',`seed_rate`='$field_seedrate',`seed_source`='$field_seedsrc',`field_urea`='$field_urea',`field_dap`='$field_dap',`field_potash`='$field_potash',`field_complex`='$field_complex',`field_zinc`='$field_zinc',`field_borax`='$field_borax',`field_gypsum`='$field_gypsum',`field_survey_no`='$field_surveyno' where sno='$field_old_id' and fid='$f_id' ";

                    mysql_query("update `farms` set farm_name='$field_name',`fields`='$field_fields',`total_farm_area`=$field_totalArea, `cultivation_area`='$field_cultivationArea', `crop_name`='$field_cropname', `crop_variety`='$field_cropVariety',`village`='$field_village',`del`=0 , `farm_lat`='$field_lat' ,`farm_long`='$field_long',`year`='$field_year',`season`='$field_season',`sowing_date`='$field_sowing',`field_image`='$field_image',`govtsubsidy`='$field_govtsubsidy',`seed_rate`='$field_seedrate',`seed_source`='$field_seedsrc',`field_urea`='$field_urea',`field_dap`='$field_dap',`field_potash`='$field_potash',`field_complex`='$field_complex',`field_zinc`='$field_zinc',`field_borax`='$field_borax',`field_gypsum`='$field_gypsum',`field_survey_no`='$field_surveyno' where sno='$field_old_id' and fid='$f_id' ")or die(mysql_error());
				 $field_new_id=$field_old_id;


				
				$query1=mysql_query("select * from farmers where sno='$f_id'");
										$result1=mysql_fetch_object($query1);
										$district=$result1->district;
										$taluk=$result1->taluk;
										//echo "select * from rec where district='$district' and taluk='$taluk' and crop_type='$crname'";
										$query2=mysql_query("select * from rec where district='$district' and taluk='$taluk' and crop_type='$field_cropname'") or die(mysql_error());
									
										if(mysql_num_rows($query2)>0)
										{
											$result2=mysql_fetch_array($query2);
											$urea=$result2['urea'];
											$dap=$result2['dap'];
											$mop=$result2['mop'];
											$gypsum=$result2['gypsum'];
											$zinc_sulphate=$result2['zinc_sulphate'];
											$borax=$result2['borax'];
											$ssp=$result2['ssp'];
											$ssp_urea=$result2['ssp_urea'];	
											$ssp_gypsum=$result2['ssp_gypsum'];	
											$ssp_dap=$result2['ssp_dap'];
										}
										else
										{
											$urea="";
											$dap="";
											$mop="";
											$gypsum="";
											$zinc_sulphate="";
											$borax="";
											$ssp="";
											$ssp_urea="";	
											$ssp_gypsum="";	
											$ssp_dap="";
										}
										$date=date('Y-m-d');
										
				
									//echo "update  farmer_rec  set urea='$urea',dap='$dap',mop='$mop',gypsum='$gypsum',zinc_sulphate='$zinc_sulphate',borax='$borax',ssp='$ssp',ssp_urea='$ssp_urea',ssp_gypsum='$ssp_gypsum',ssp_dap='$ssp_dap',date='$date' where farmer_id='$f_id' and field_id='$field_old_id'";

				   mysql_query("update  farmer_rec  set urea='$urea',dap='$dap',mop='$mop',gypsum='$gypsum',zinc_sulphate='$zinc_sulphate',borax='$borax',ssp='$ssp',ssp_urea='$ssp_urea',ssp_gypsum='$ssp_gypsum',ssp_dap='$ssp_dap',date='$date' where farmer_id='$f_id' and field_id='$field_old_id'")or die(mysql_error());
					

					
				}
				else
				{
							//	mysql_query("INSERT INTO `farms`(`fid`, `farm_name`, `fields`,`total_farm_area`, `cultivation_area`, `crop_name`, `crop_variety`, `village`, `del`)	VALUES ('$f_id','$field_name', '$field_fields', '$field_totalArea','$field_cultivationArea','$field_cropname','$field_cropVariety','$field_village', '0')");


								mysql_query("INSERT INTO `farms`(`fid`, `farm_name`, `fields`,`total_farm_area`, `cultivation_area`, `crop_name`, `crop_variety`, `village`, `del`, `farm_lat`,`farm_long`,`year`,`season`,`sowing_date`,`field_image`,`govtsubsidy`,`seed_rate`,`seed_source`,`field_urea`,`field_dap`,`field_potash`,`field_complex`,`field_zinc`,`field_borax`,`field_gypsum`,`field_survey_no`,`district`,`taluk`)
							VALUES ('$f_id','$field_name', '$field_fields', '$field_totalArea','$field_cultivationArea','$field_cropname','$field_cropVariety','$field_village', '0','$field_lat','$field_long', '$field_year','$field_season','$field_sowing','$field_image','$field_govtsubsidy','$field_seedrate','$field_seedsrc','$field_urea','$field_dap','$field_potash','$field_complex','$field_zinc','$field_borax ','$field_gypsum','$field_surveyno','$district','$ff_Taluk')");



                    /*echo "INSERT INTO `farms`(`fid`, `farm_name`, `fields`,`total_farm_area`, `cultivation_area`, `crop_name`, `crop_variety`, `village`, `del`, `farm_lat`,`farm_long`,`year`,`season`,`sowing_date`,`filed_image`,`govtsubsidy`,`seed_rate`,`seed_source`,`field_urea`,`field_dap`,`field_potash`,`field_complex`,`field_zinc`,`field_borax`,`field_gypsum`,`field_survey_no`,`district`,`taluk`)
							VALUES ('$f_id','$field_name', '$field_fields', '$field_totalArea','$field_cultivationArea','$field_cropname','$field_cropVariety','$field_village', '0','$field_lat','$field_long', '$field_year','$field_season','$field_sowing','$field_image','$field_govtsubsidy','$field_seedrate','$field_seedsrc','$field_urea','$field_dap','$field_potash','$field_complex','$field_zinc','$field_borax ','$field_gypsum','$field_surveyno','$farmer_dist','$farmer_taluk') <br>";*/

                    $field_new_id=mysql_insert_id();
				     //echo 'new field id is'.$field_new_id.'<br>';
				    $id=mysql_insert_id();
						$query1=mysql_query("select * from farmers where sno='$f_id'");
						$result1=mysql_fetch_object($query1);
						$district=$result1->district;
						$taluk=$result1->taluk;
						//echo "select * from rec where district='$district' and taluk='$taluk' and crop_type='$crname'";
						$query2=mysql_query("select * from rec where district='$district' and taluk='$taluk' and crop_type='$field_cropname'") or die(mysql_error());
					
						if(mysql_num_rows($query2)>0)
						{
							$result2=mysql_fetch_array($query2);
							$urea=$result2['urea'];
							$dap=$result2['dap'];
							$mop=$result2['mop'];
							$gypsum=$result2['gypsum'];
							$zinc_sulphate=$result2['zinc_sulphate'];
							$borax=$result2['borax'];
							$ssp=$result2['ssp'];
							$ssp_urea=$result2['ssp_urea'];	
							$ssp_gypsum=$result2['ssp_gypsum'];	
							$ssp_dap=$result2['ssp_dap'];
						}
						else
						{
							$urea="";
							$dap="";
							$mop="";
							$gypsum="";
							$zinc_sulphate="";
							$borax="";
							$ssp="";
							$ssp_urea="";	
							$ssp_gypsum="";	
							$ssp_dap="";
						}
						$date=date('Y-m-d');
						//	mysql_query("insert into farmer_rec (farmer_id,field_id,urea,dap,mop,gypsum,zinc_sulphate,borax,date) values ('$f_id','$id','$urea','$dap','$mop','$gypsum','$zinc_sulphate','$borax','$date')")or die(mysql_error());
					  mysql_query("insert into farmer_rec (farmer_id,field_id,urea,dap,mop,gypsum,zinc_sulphate,borax,ssp,ssp_urea,ssp_gypsum,ssp_dap,date) values ('$f_id','$id','$urea','$dap','$mop','$gypsum','$zinc_sulphate','$borax','$ssp','$ssp_urea','$ssp_gypsum','$ssp_dap','$date')")or die(mysql_error());
				}
						$html.="<".$flds->getName()." Farmer_ID=\"".$f_id."\" oldid=\"".$field_old_id."\" newid=\"".$field_new_id."\" status=\"true\"/>";
			}
		}
		$html.="</".$ftype.">";
	}
	$html.="</".$child->getName().">";
}
$html.="</". $xml->getName().">";
echo $html;














