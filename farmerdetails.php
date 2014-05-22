<?php

error_reporting(E_ALL);

ob_start();
$activetab="farmar";
include 'header.php';

if(isset($_POST['submit']))
{
$fname=$_POST['fname'];
$lname=$_POST['lname'];
$fatname=$_POST['fatname'];
$mobile=$_POST['mobile'];
$telephone=$_POST['telephone'];
$caste=$_POST['caste'];
$district=$_POST['district'];
$address=$_POST['address'];
$taluk=$_POST['taluk'];
$village='';
$id_type=$_POST['id_type'];
$id_no=$_POST['id_no'];
$area_total=$_POST['area_total'];
$rainfed=$_POST['rainfed'];
$irrigated=$_POST['irrigated'];
$plantation=$_POST['plantation'];
$fallow=$_POST['fallow'];
$surveyno=$_POST['surveyno'];
$farmer_lat=$_POST['farmer_lat'];
$farmer_long=$_POST['farmer_long'];
//$pincode=$_POST['pincode'];
$hobli=$_POST['hobli'];
$date=date('Y-m-d');
$gender=$_POST['gender'];
$user_id=$_SESSION['user_id'];
$village1='';
$ipath='';
$userid='';

	$village=$_POST['village'];

if(isset($_POST['sno']))
{
		$sno=$_POST['sno'];
				if (is_uploaded_file($_FILES['image']['tmp_name']))
				{
						if (!file_exists("/home/krishigy/public_html/fphotos/" . $district))
						{
								mkdir("/home/krishigy/public_html/fphotos/" . $district, 0777, true);
						}
					move_uploaded_file($_FILES["image"]["tmp_name"],"/home/krishigy/public_html/fphotos/" . $district."/".$_FILES["image"]["name"]);
					$ipath=$_FILES["image"]["name"];

					if($_SESSION['user_id']=='admin')
					{
					$ff=$_POST['ff'];
					 $q1=mysql_query("select * from users where fname='$ff'");
					 $r1=mysql_fetch_array($q1);
					 $ff_sno=$r1['sno'];

						mysql_query("update farmers set fname='$fname', lname='$lname', fatname='$fatname', mobile='$mobile', telephone='$telephone', caste='$caste', address='$address', district='$district', taluk='$taluk',village='$village',ID_type='$id_type',ID_no='$id_no',area_total='$area_total', rainfed='$rainfed', irrigated='$irrigated', plantation='$plantation', fallow='$fallow', surveyno='$surveyno',hobli='$hobli',modifiedby='$ff_sno',modified_date='$date',Photo='$ipath',gender='$gender',Loc_Lat='$farmer_lat',Loc_Long='$farmer_long' where sno='$sno'")or die(mysql_error());

					}

					 else
					 {
						mysql_query("update farmers set fname='$fname', lname='$lname', fatname='$fatname', mobile='$mobile', telephone='$telephone', caste='$caste', address='$address', district='$district', taluk='$taluk',village='$village',ID_type='$id_type',ID_no='$id_no',area_total='$area_total', rainfed='$rainfed', irrigated='$irrigated', plantation='$plantation', fallow='$fallow', surveyno='$surveyno',hobli='$hobli',modifiedby='$user_id',modified_date='$date',Photo='$ipath',gender='$gender',Loc_Lat='$farmer_lat',Loc_Long='$farmer_long' where sno='$sno'")or die(mysql_error());
					 }
					}
					else
					{
							if($_SESSION['user_id']=='admin')
							{
							 $ff=$_POST['ff'];
							 $q1=mysql_query("select * from users where fname='$ff'");
							 $r1=mysql_fetch_array($q1);
							 $ff_sno=$r1['sno'];

								mysql_query("update farmers set fname='$fname', lname='$lname', fatname='$fatname', mobile='$mobile', telephone='$telephone', caste='$caste', address='$address', district='$district', taluk='$taluk',village='$village',ID_type='$id_type',ID_no='$id_no',area_total='$area_total', rainfed='$rainfed', irrigated='$irrigated', plantation='$plantation', fallow='$fallow', surveyno='$surveyno',hobli='$hobli',modifiedby='$ff_sno',modified_date='$date',gender='$gender',Loc_Lat='$farmer_lat',Loc_Long='$farmer_long' where sno='$sno'")or die(mysql_error());

							}


							else
							{
							mysql_query("update farmers set fname='$fname', lname='$lname', fatname='$fatname', mobile='$mobile', telephone='$telephone', caste='$caste', address='$address', district='$district', taluk='$taluk',village='$village',ID_type='$id_type',ID_no='$id_no',area_total='$area_total', rainfed='$rainfed', irrigated='$irrigated', plantation='$plantation', fallow='$fallow', surveyno='$surveyno',hobli='$hobli',modifiedby='$user_id',modified_date='$date', gender='$gender',Loc_Lat='$farmer_lat',Loc_Long='$farmer_long' where sno='$sno'")or die(mysql_error());

							}
				}
}
else
{
	if (is_uploaded_file($_FILES['image']['tmp_name']))
	{
			if (!file_exists("/home/krishigy/public_html/fphotos/" . $district))
			{
					mkdir("/home/krishigy/public_html/fphotos/" . $district, 0777, true);
			}
    move_uploaded_file($_FILES["image"]["tmp_name"],"/home/krishigy/public_html/fphotos/" .$district."/". $_FILES["image"]["name"]);
	  $ipath=$_FILES["image"]["name"];
  }
	if($_SESSION['user_id']=='admin')
		{
			$ff=$_POST['ff'];
			$q1=mysql_query("select * from users where fname='$ff'");
			$r1=mysql_fetch_array($q1);
			$ff_sno=$r1['sno'];
			$q=mysql_query("insert into farmers( fname, lname, fatname, mobile, telephone, caste, address, district, taluk, village,ID_type,ID_no, area_total, rainfed, irrigated, plantation, fallow, surveyno,hobli,date,createdby,Photo, gender,Farm_Facilitator,Loc_Lat,Loc_Long) values('$fname', '$lname', '$fatname', '$mobile', '$telephone', '$caste',  '$address','$district', '$taluk', '$village', '$id_type','$id_no','$area_total', '$rainfed', '$irrigated', '$plantation', '$fallow','$surveyno','$hobli','$date','$ff_sno','$ipath', '$gender','$ff','$farmer_lat','$farmer_long')");


		}
		else
		{
			$q=mysql_query("insert into farmers( fname, lname, fatname, mobile, telephone, caste, address, district, taluk, village,ID_type,ID_no, area_total, rainfed, irrigated, plantation, fallow, surveyno,hobli,date,createdby,Photo, gender,Loc_Lat,Loc_Long) values('$fname', '$lname', '$fatname', '$mobile', '$telephone', '$caste',  '$address','$district', '$taluk', '$village', '$id_type','$id_no','$area_total', '$rainfed', '$irrigated', '$plantation', '$fallow','$surveyno','$hobli','$date','$user_id','$ipath', '$gender','$farmer_lat','$farmer_long')");

  	}

}
if(isset($_POST['n'])){header('location:farmerslist.php');}
if(isset($_POST['m'])){header('location:farmerresult.php');}
$w=mysql_query("select * from farmers order by sno desc") or die(mysql_error());
$c=mysql_fetch_array($w);
}
if(isset($_GET['sno']) || isset($_POST['sno']) ){
	if(isset($_GET['sno']))
	$sno=$_GET['sno'];
	if(isset($_POST['sno']))
	$sno=$_POST['sno'];
$w=mysql_query("select * from farmers where sno='$sno'") or die(mysql_error());
$c=mysql_fetch_array($w);
}
?>
<link type='text/css' href='css/demo.css' rel='stylesheet' media='screen' />
<link type='text/css' href='css/basic.css' rel='stylesheet' media='screen' />
<link type='text/css' href='css/jquery-ui.css' rel='stylesheet' media='screen' />
<link href="SpryAssets/SpryTabbedPanels.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="colorbox.css" />
<link type='text/css' href='css/demo.css' rel='stylesheet' media='screen' />

<script type='text/javascript' src='js/jquerymodal.js'></script>
<script type='text/javascript' src='js/jquery.simplemodal.js'></script>
<script type='text/javascript' src='js/jquery.ui.core.js'></script>
<script type='text/javascript' src='js/jquery.ui.widget.js'></script>
<script type='text/javascript' src='js/jquery.ui.dialog.js'></script>
<script type='text/javascript' src='js/basic.js'></script>
 <script src="SpryAssets/SpryTabbedPanels.js" type="text/javascript"></script>
<style type="text/css">

    .simplemodal-wrap{
        color: black !important;
        font-size: 12px !important;
    }
    
</style>
<script src="js/jquery.colorbox.js"></script>
		<script>
			$(document).ready(function(){
				//Examples of how to assign the Colorbox event to elements
				$(".farmer_photo").colorbox({rel:'group1'});

			});
</script>
<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>

<script type="text/javascript">
$(document).ready(function(){

$('#delete').click(function(){

	var sno=$('#sno').val();
	//alert(sno);
	var r=confirm("Are you sure to delete!")
	if (r==true)
 	 {

	if(sno!=""){
	var dataString='sno=' + sno;
	$.ajax({
		data: dataString,
		type: "POST",
		url: 'delete.php',
		success:function(response){
			//alert(response);
			//$('#searchview').html(response);
			window.location='farmerslist.php';
		}


	});
	}
	}
});
$('#farm_delete').click(function(){

	var sno=$('#sno').val();
	//alert(sno);
	var r=confirm("Are you sure to delete!")
	if (r==true)
 	 {

	if(sno!="")
	{
	var dataString='sno1=' + sno+'&farmdelete=all';
	$.ajax({
		data: dataString,
		type: "POST",
		url: 'delete.php',
		success:function(response){
			//alert(response);
			//$('#searchview').html(response);
			window.location='farmerslist.php';
		}


	});
	}
	}
});
/*
    $(".modal11").dialog({
        autoOpen:false,

        height: 300,
        width: 300,
        modal: true,
        title:"field visit details",
        open: function(event, ui) { $(".ui-dialog-titlebar").show(); }
    });

    $('.basic11').click(function()
        {
            id=this.id;
            id=id.substr(6);
            alert(id);
            // $("#basic-modal-content7-"+id).dialog("open");
            target=$(".modal11").attr("id");
            alert("target id is"+target);
            $(".modal11").dialog("open");

        }
    );
*/

});
</script>
<div class="midd_right1">
 <div class="main_heads">
  <div class="farmer_head">Farmer Details View </div>
    <div class="btn_m">
  <?php if(isset($_GET['m'])){?>


  <button type="submit" name="submit" onclick="window.location='farmerresult.php';" class="new">Back</button>

  <?php
  }
  else
  {?>

  <button type="submit" name="submit" onclick="window.location='farmerslist.php';" class="new">Back</button>

 <?php
 	$user_sno=$c['createdby'];
 	$userid='';

 	if($_SESSION['user_id']==$user_sno)
 	{
 		$userid=$user_sno;

 	}


 } ?>

 <!--
  <button type="submit" name="submit" onclick="window.location='farmerform.php?user=<?php echo $userid ?>';" class="new">New</button>
  <button type="submit" name="submit" onclick="window.location='farmeredit.php?sno=<?php echo $c['sno'] ?>';" class="new">Edit</button>
 -->
  <?php

        $farmerid= $c['sno'];


  if(isset($_SESSION['superadmin']))
  {?>
     <button type="submit" name="submit" onclick="window.location='farmerform.php?user=<?php echo $userid ?>';" class="new">New</button>
    <button type="submit" name="submit" onclick="window.location='farmeredit.php?sno=<?php echo $c['sno'] ?>';" class="new">Edit</button>
	  <button name="delete" id="delete" class="new">Delete</button>
		<?php
	}
		?>

  <input type="hidden" name="sno" id="sno" value="<?php echo $c['sno'] ?>" />
  </div>

  <div class="gr_border">


  </div>
<div class="deta_head"> Farmer Details: </div>
<div class="form_mainf">
<div class="form_mainleft">
  <div class="form_main1">
  <span class="form_left"> First Name
  </span>

   <span class="form_right"> <?php echo $c['fname']?>  </span>


  </div>
  <div class="form_main1">
  <span class="form_left"> Last Name

  </span>

   <span class="form_right"> <?php echo $c['lname']; ?>  </span>


  </div>
  <div class="form_main1">
  <span class="form_left"> Gender

  </span>

   <span class="form_right"> <?php echo $c['gender']; ?>  </span>


  </div>
  <div class="form_main1">
  <span class="form_left"> Father Name

  </span>

   <span class="form_right"> <?php echo $c['fatname'] ;?> </span>


  </div>

  <div class="form_main1">
  <span class="form_left"> Mobile #

  </span>

   <span class="form_right"> <?php echo $c['mobile']; ?> </span>


  </div>

  <div class="form_main1">
  <span class="form_left"> Telephone #

  </span>

   <span class="form_right"> <?php echo $c['telephone']; ?></span>


  </div>
  <div class="form_main1">
  <span class="form_left"> Caste

  </span>

  <span class="form_right"> <?php echo $c['caste']; ?> </span>

  </div>

   </div>

   <div class="form_mainright">
   <div class="form_main1">
  <span class="form_left"> Address

  </span>

 <span class="form_right"> <?php echo $c['address'] ;?> </span>


  </div>


         <div class="form_main1">
  <span class="form_left"> District


  </span>

  <span class="form_right"><?php echo $c['district']; ?> </span>

  </div>
   <div class="form_main1">
  <span class="form_left"> Taluk


  </span>

  <span class="form_right"> <?php echo $c['taluk']; ?> </span>

  </div>
   <div class="form_main1">
  <span class="form_left"> Hobli


  </span>

  <span class="form_right"> <?php echo $c['hobli']; ?> </span>

  </div>
  <div class="form_main1">
  <span class="form_left"> Village


  </span>

  <span class="form_right"> <?php echo $c['village']; ?> </span>

  </div>


   <div class="form_main1">
	  <span class="form_left"> ID type
	  </span>
	  <span class="form_right"> <?php echo $c['ID_type']; ?> </span>

  </div>

   <div class="form_main1">
	  <span class="form_left"> ID #
		  </span>

	  <span class="form_right"> <?php echo $c['ID_no']; ?> </span>

  </div>

 <!--

           <div class="form_main1">
  <span class="form_left"> Pin Code


  </span>

  <span class="form_right"> <?php echo $c['pincode']; ?> </span>

  </div>
 -->
  </div>
  <div class="far_photo">
  <a href="<?php if($c['Photo']==""){echo "fphotos/Lighthouse.jpg";}else{echo "fphotos/". $c['district']."/". $c['Photo'];}?>" title="<?php echo $c['fname'] ?>" class="farmer_photo"> <img src="<?php if($c['Photo']==""){echo "fphotos/Lighthouse.jpg";}else{echo "fphotos/".$c['district']."/".$c['Photo'];}?>" width="75" height="75" /></a>
  </div>
  </div>

  <div class="deta_head"> Farm Information: </div>
  <div class="form_mainf">
<div class="form_mainleft">
  <div class="form_main1">
  <span class="form_left"> Area total(acre)
  </span>

   <span class="form_right"> <?php echo $c['area_total']; ?> </span>


  </div>
  <div class="form_main1">
  <span class="form_left">  Rainfed (acre)

  </span>

   <span class="form_right"><?php echo $c['rainfed']; ?></span>


  </div>
  <div class="form_main1">
  <span class="form_left"> Irrigated (acre)

  </span>

   <span class="form_right"><?php echo $c['irrigated']; ?></span>


  </div>





   </div>

   <div class="form_mainright">





       <div class="form_main1">
  <span class="form_left">  Plantation (acre)


  </span>

  <span class="form_right"> <?php echo $c['plantation']; ?> </span>

  </div>
         <div class="form_main1">
  <span class="form_left"> Fallow (acre)


  </span>

  <span class="form_right"> <?php echo $c['fallow']; ?> </span>

  </div>
           <div class="form_main1">
  <span class="form_left"> Survey No


  </span>

  <span class="form_right"><?php echo $c['surveyno']; ?> </span>

  </div>

  </div> </div>
    <div class="deta_head"> Extra Information: </div>
  <div class="form_mainf">
<div class="form_mainleft">

	<div class="form_main1">
  <span class="form_left"> Created Date
  </span>

   <span class="form_right"> <?php $ds=explode("-",$c['date']);
$d=array_pop($ds);
$m=array_pop($ds);
$y=array_pop($ds);
$dt=$d."-".$m."-".$y;
echo $dt; ?> </span>

  </div>
  <div class="form_main1">
  <span class="form_left"> Owner
  </span>

   <span class="form_right"> <?php
   $i=$c['createdby'];
   $query2=mysql_query("select * from users where sno='$i'");
   $r=mysql_fetch_array($query2);


   echo $r['userid'] ?>

  </span>

  </div>
  <div class="form_main1">
  <span class="form_left"> Created By
  </span>

   <span class="form_right"> <?php
   $i=$c['createdby'];
   $query2=mysql_query("select * from users where sno='$i'");
   $r=mysql_fetch_array($query2);


   echo $r['userid'] ?>

  </span>

  </div>


   </div>

   <div class="form_mainright">

   <div class="form_main1">
  <span class="form_left">  Last Modified Date


  </span>

  <span class="form_right"> <?php $ds=explode("-",$c['modified_date']);
$d=array_pop($ds);
$m=array_pop($ds);
$y=array_pop($ds);
$dt=$d."-".$m."-".$y;
echo $dt; ?> </span>

  </div>
 <div class="form_main1">
  <span class="form_left"> Modified By
  </span>

   <span class="form_right"> <?php
   $i=$c['modifiedby'];
   //$query2=mysql_query("select * from users where sno='$i'");
   //$r=mysql_fetch_object($query2);


   echo $r['userid'] ?>


   </span>

  </div>
 <div class="form_main1">
  <span class="form_left"> Farmer Id
  </span>

   <span class="form_right"> <?php echo $c['sno']; ?> </span>

  </div>
  </div>

  <!--
   <div class="form_main1">
   <span class="form_left"> <strong> <a href="locationMap.php?sno=<?php echo $c['sno'] ?>"  style='text-decoration:none; '>Location Map</a></strong>

   </span>


  </div>
 -->




  </div> </div>
 <!-- <div class="btn_ali">
   <span class="new" style="margin-left:250px;"> <a href="farmerdetails.html">Save  </a> </span>
  <span class="new1"> <a href="farmerform.html">Cancel  </a> </span> </div>-->
 <div id="TabbedPanels1" class="TabbedPanels">
   <ul class="TabbedPanelsTabGroup">
     <li class="TabbedPanelsTab" tabindex="0">Farms</li>
     <li class="TabbedPanelsTab" tabindex="0">Recommendations</li>
   </ul>
   <div class="TabbedPanelsContentGroup">
     <div class="TabbedPanelsContent">
     <!-- Farms content starts here -->
     <div class="btn_m">
  <button name="submit" onclick="window.location='farmform.php?fid=<?php echo $c['sno'] ?>';" class="new">New</button>


  <?php
	  if(isset($_SESSION['superadmin']))
	  {

	  ?>
  		<button name="farm_delete" id="farm_delete" class="new">Delete All</button>
  	<?php
  	}
  	?>


  	</div>
      <table border="0px" cellpadding="0" cellspacing="0" width="100%">
   <tr>
   <th>&nbsp;  </th>
<th>Farm Name</th>
<th>Total Farm Area</th>
<th>Cultivation Area</th>
<th>Crop Name</th>
<th>Village</th>
<th>Farm Map</th>
 <th>Used Fertilizers</th>
 <th> Crop Cutting Experiment </th>

</tr>
<?php
$fid=$c['sno'];
$crop='';
$faid='';
$farm_name='';
$date_='';
$query1=mysql_query("select * from farms where fid='$fid' and del!=1");



$i=1;
 $cultivation_area='';

          $arr=array();
if(mysql_num_rows($query1)>0){

	if($i%2==0){$td="td_even";}else{$td="td_odd";}$i++;
while($result1=mysql_fetch_array($query1))
          {

                        $faid=$result1['sno'];
          array_push($arr,$faid);
                    ?>
                    <tr class="<?php echo $td ?>">
                    <td></td><td><a href="farmdetails.php?fid=<?php echo $fid ?>&faid=<?php echo $faid ?>&district=<?php echo $c['district'] ?>"><?php
                    $farm_name=$result1['farm_name'];
                    echo $result1['farm_name'] ?></a></td>
                    <td><?php echo $result1['total_farm_area'] ?></td>
                    <td><?php echo $result1['cultivation_area'] ?></td>
                    <td><?php
                    $crop=$result1['crop_name'];
                    echo $result1['crop_name'] ?></td>
                    <td><?php echo $result1['village'] ;
                    ?></td>
                    <td><a href="Farm_map_location.php?sno=<?php echo $result1['sno'] ?>"style='text-decoration:none; '>View</a></td>

                        <td>
                        <a name='basic' style='color:blue;' onclick="modal_view6('<?php echo $result1['sno'] ?>')" class='basic'>View</a> </div>
                           </td>
       <td><a href="ccedetails.php?file=farmresult&farmerid=<?php echo $farmerid ?> &field_id=<?php echo$faid ?>" style='color:blue;'>view </a></td>

                    <?php
                      $cultivation_area=$result1['cultivation_area'];                           ?>


<?php


        }

} ?>
</table>
     <!-- Farms ends here -->
     </div>




     <div class="TabbedPanelsContent">
     <!-- Recommendations tab starts here -->

     <div class="recform">
     <table border="0px" cellpadding="0" cellspacing="0" width="100%">
   <tr>
   <th>&nbsp;  </th>
            <th>Farm Name</th>
            <th>Crop Name</th>
            <th>Urea</th>
            <th>DAP</th>
            <th>MOP</th>
            <th>Gypsum</th>
            <th>Zinc Sulphate</th>
            <th>Borax</th>
            <th>ssp</th>
            <th>ssp_urea</th>
            <th>ssp_gypsum</th>
            <th>ssp_dap</th>
            <th>Date</th>
</tr>
<?php
$fid=$c['sno'];
$d=$c['district'];
$t=$c['taluk'];

//$query2=mysql_query("select * from rec where district='$d' and taluk='$t' and crop_type='$crop'") or die(mysql_error());

//echo "select * from rec where district='$d' and taluk='$t' and crop_type='$c'";


$query2=mysql_query("select * from farmer_rec fr,farms f where fr.farmer_id='$fid' and fr.field_id=f.sno and fr.del!=1") or die(mysql_error());

if(mysql_num_rows($query2)>0)
{
	$i=1;


while($result2=mysql_fetch_array($query2))
{
	$query_f=mysql_query("select cultivation_area from farms where fid='$fid' and sno=".$result2['field_id']." and  del!=1");

while($r_f=mysql_fetch_array($query_f))
{


            $ca=$r_f['cultivation_area'];
            if($i%2==0){$td="td_even";}else{$td="td_odd";}$i++;
            ?>
            <tr class="<?php echo $td ?>">
            <td></td>
            <td><?php echo $result2['farm_name'] ?></td>
            <td><?php echo $result2['crop_name'] ?></td>
            <td><?php

            //echo 'urea is'.$result2['urea'].'<br>';

            echo ($ca)*($result2['urea']/2.5) ?></td>
            <td><?php
            //echo 'dap is'.$result2['dap'].'<br>';
            echo ($ca)*($result2['dap']/2.5)?></td>
            <td><?php
            //echo 'mop is'.$result2['mop'].'<br>';
            echo ($ca)*($result2['mop']/2.5)?></td>
            <td><?php
            //echo 'gypsum is'.$result2['gypsum'].'<br>';
            echo ($ca)*($result2['gypsum']/2.5) ?></td>
            <td><?php
            //echo 'zinc_sulphate is'.$result2['zinc_sulphate'].'<br>';
            echo ($ca)*($result2['zinc_sulphate']/2.5) ?></td>
            <td><?php
            //echo 'borax is'.$result2['borax'].'<br>';
            echo ($ca)*($result2['borax']/2.5) ?></td>
            <td><?php
            //echo 'ssp is'.$result2['ssp'].'<br>';
            echo ($ca)*($result2['ssp']/2.5) ?></td>
            <td><?php
            //echo 'ssp_urea is'.$result2['ssp_urea'].'<br>';
            echo ($ca)*($result2['ssp_urea']/2.5) ?></td>
            <td><?php
            //echo 'ssp_gypsum is'.$result2['ssp_gypsum'].'<br>';
            echo ($ca)*($result2['ssp_gypsum']/2.5) ?></td>
            <td><?php
            //echo 'ssp_dap is'.$result2['ssp_dap'].'<br>';
             echo ($ca)*($result2['ssp_dap']/2.5) ?></td>
            <td><?php
            $ds=explode("-",$result2['date']);
            $d=array_pop($ds);
            $m=array_pop($ds);
            $y=array_pop($ds);
            $dt=$d."-".$m."-".$y;
 echo $dt ?></td>
</tr>


             <?php

             }
         }

} ?>
</table>
     </div>
     <!-- Recommendations ends here -->
     </div>
   </div>
 </div>
 </div>
</div>





</div>


<?php
for($i=0;$i<count($arr);$i++)
{
?>


<div id="basic-modal-content6-<?php echo $arr[$i]?>" class="modal6" style="display:none">
<h3> <span style="color:#000;"></span> </h3>
<?php $fid=$arr[$i];

$q=mysql_query("select * from farms where sno='$fid'");
$res=mysql_fetch_array($q);
$f_urea=$res['field_urea'];
$f_dap=$res['field_dap'];
$f_potash=$res['field_potash'];
$f_complex=$res['field_complex'];
$f_zinc=$res['field_zinc'];
$f_borax=$res['field_borax'];
$f_gypsum=$res['field_gypsum'];
?>  <div>
    <div>  Actually Used Fertilizers </div>
    <div class="gr_border">


    </div>
    <div class="form_main1">
        <span class="form_left">Urea</span>
        <span style="margin-left:10px"> <?php echo $f_urea ?></span>
    </div>
    <div class="form_main1">
        <span class="form_left">Dap</span>
        <span style="margin-left:10px"> <?php echo $f_dap ?></span>
    </div>
    <div class="form_main1">
        <span class="form_left">Potash</span>
        <span style="margin-left:10px"> <?php echo $f_potash ?></span>
    </div>
    <div class="form_main1">
        <span class="form_left">Complex</span>
        <span style="margin-left:10px"> <?php echo $f_complex ?></span>
    </div>
    <div class="form_main1">
        <span class="form_left">Zinc Sulphate</span>
        <span style="margin-left:10px"> <?php echo $f_zinc ?></span>
    </div>
    <div class="form_main1">
        <span class="form_left">Borax</span>
        <span style="margin-left:10px"> <?php echo $f_borax ?></span>
    </div>
    <div class="form_main1">
        <span class="form_left">Gypsum</span>
        <span style="margin-left:10px"> <?php echo $f_gypsum ?></span>
    </div>

</div>

            <?php
            }
            ?>





            <?php include 'footer.php';?>
<script type="text/javascript">
<!--
var TabbedPanels1 = new Spry.Widget.TabbedPanels("TabbedPanels1");
//-->
</script>
