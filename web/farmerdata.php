<?php
$userid=$_REQUEST['userid'];
include '../dbcon.php';
$response=array();
	$re=array();


			$q_d=mysql_query("select * from users where sno='$userid' ");
			$r_d=mysql_fetch_array($q_d);
			$u_d=$r_d['district'];
			$u_t=$r_d['taluk'];
			$u_h=$r_d['hobli'];
			if($r_d['role']=='DISTRICT')
			{
				$query=mysql_query("select * from farmers where district='$u_d' and del!=1 order by sno desc ");

			}
			elseif($r_d['role']=='TALUK')
			{
				$query=mysql_query("select * from farmers where taluk='$u_t'  and  district='$u_d' and del!=1 order by sno desc ");
			}
			elseif($r_d['role']=='HOBLI')
			{
				$query=mysql_query("select * from farmers where hobli='$u_h' and taluk ='$u_t'and del!=1 order by sno desc ");
			}
			else
			{
				$query=mysql_query("select * from farmers where createdby='$userid' and del!=1 order by sno desc ");

		 }

//$query=mysql_query("select * from farmers where createdby='$userid' and del!=1");
if(mysql_num_rows($query)>0){

	while($result=mysql_fetch_array($query)){
		$response['farmerid']=$result['sno'];
		$response['fname']=$result['fname'];
		$response['lname']=$result['lname'];
		$response['fathername']=$result['fatname'];
		$response['mobile']=$result['mobile'];
		$response['telephone']=$result['telephone'];
		$response['address']=$result['address'];
		$response['district']=$result['district'];
		$response['taluk']=$result['taluk'];
		$response['hobli']=$result['hobli'];
		$response['village']=$result['village'];
		$response['caste']=$result['caste'];
		$response['gender']=$result['gender'];
		$response['ID_type']=$result['ID_type'];
		$response['ID_no']=$result['ID_no'];
		$response['area_total']=$result['area_total'];
		$response['rainfed']=$result['rainfed'];
		$response['irrigated']=$result['irrigated'];
		$response['plantation']=$result['plantation'];
		$response['fallow']=$result['fallow'];
		$response['surveyno']=$result['surveyno'];
		$response['date']=$result['date'];
		$response['modifiedby']=$result['modifiedby'];
		$response['modified_date']=$result['modified_date'];
		$response['createdby']=$result['createdby'];
		$response['Photo']="http://www.krishigyansagar.com/fphotos/".$result['district']."/".$result['Photo'];
		$response['photo_id']=$result['photo_id'];
		$response['Loc-Lat']=$result['Loc_Lat'];
		$response['Loc-Long']=$result['Loc_Long'];
		$response['Loc-Altitude']=$result['Loc-Altitude'];
		$response['Loc-Accuracy']=$result['Loc-Accuracy'];


		array_push($re,$response);
}
}else{
		$response['farmerid']="";
		$response['fname']="";
		$response['lname']="";
		$response['fathername']="";
		$response['mobile']="";
		$response['telephone']="";
		$response['address']="";
		$response['district']="";
		$response['taluk']="";
		$response['hobli']="";
		$response['village']="";
		$response['caste']="";
		$response['gender']="";
		$response['ID_type']="";
		$response['ID_no']="";
		$response['area_total']="";
		$response['rainfed']="";
		$response['irrigated']="";
		$response['plantation']="";
		$response['fallow']="";
		$response['surveyno']="";
		$response['date']="";
		$response['modifiedby']="";
		$response['modified_date']="";
		$response['createdby']="";
		$response['Photo']="http://www.billzee.com/fphoto/".$result['Photo'];
		$response['photo_id']="";
		$response['Loc-Lat']="";
		$response['Loc-Long']="";
		$response['Loc-Altitude']="";
		$response['Loc-Accuracy']="";
		array_push($re,$response);
}
$res1['FarmerListResult']=$re;
echo json_encode($res1);
?>