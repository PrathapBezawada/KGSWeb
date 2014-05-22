<?php 
//$activetab="home";
include 'header.php'; 
include 'dbcon.php';
?>
<div class="midd_right2" style="height: 550px;">
 <div class="main_heads">
 <script type="text/javascript">
$(document).ready(function(){

$('#delete').click(function(){
	
	var faid=$('#faid').val();
	var fid=$('#fid').val();
	//alert(sno);
	var r=confirm("Are you sure to delete!")
	if (r==true)
 	 {
  	
	if(faid!=""){
	var dataString='faid=' + faid;
	$.ajax({
		data: dataString,
		type: "POST",
		url: 'delete.php',
		success:function(response){
			//alert(response);
			//$('#searchview').html(response);
			window.location='farmerdetails.php?sno='+fid;
		}
	
	
	});
	}
	}
});


});
</script>
 <?php 
 if(isset($_GET['fid'])){
 $fid=$_GET['fid']; 
 $faid=$_GET['faid'];
 $farmer_district=$_GET['district'];
 $query1=mysql_query("select * from farms where sno='$faid'");
 $result1=mysql_fetch_array($query1);

 ?>
  <div class="farmer_head">Farm details  </div>
  
  
  <div style="float:left;margin-left:20px"><a href="farmerdetails.php?sno=<?php echo $fid ?>">Back to Details</a></div>
  <div class="btn_m">
<?php
if(isset($_SESSION['superadmin'])) 
  {?>
     <button type="reset" name="cancel" class="new" onclick="window.location='farmform.php?fid=<?php echo $fid ?>';">New</button> 
     <button type="submit" name="submit" onclick="window.location='farmerform.php?user=<?php echo $userid ?>';" class="new">New</button>
    <button type="submit" name="submit" onclick="window.location='farmeredit.php?sno=<?php echo $c['sno'] ?>';" class="new">Edit</button>
	  <button name="delete" id="delete" class="new">Delete</button>
		<?php
	}?>
	  </div>
  
  <div class="gr_border">
  
  
  </div>
<div class="deta_head"> Farm Details: </div>

<div class="form_mainf">
<div class="form_mainleft">

  <div class="form_main1">
  <span class="form_left"> Farm Name
  </span>
  
  <span style="margin-left:10px">  <?php echo $result1['farm_name']; ?> </span>
  	<input type="hidden" name="fid" id="fid" value="<?php echo $fid ?>"  />
    <input type="hidden" name="faid" id="faid" value="<?php echo $faid ?>"  />
  
  </div>
  <!--
  <div class="form_main1">
  
  <span class="form_left"> # Fields

  </span>
  
   <span style="margin-left:10px"> <?php echo $result1['fields']; ?></span>
  
  
  </div>-->
  <div class="form_main1">
  <span class="form_left"> Total Farm Area

  </span>
  
   <span style="margin-left:10px"> <?php echo $result1['total_farm_area']; ?></span>
  
  
  </div>
  
  <div class="form_main1">
  <span class="form_left"> Cultivation Area

  </span>
  
   <span style="margin-left:10px"> <?php echo $result1['cultivation_area']; ?></span>
  
  
  </div>

    <div class="form_main1">
  <span class="form_left"> Crop Name

  </span>


        <span style="margin-left:10px"> <?php echo $result1['crop_name']; ?></span>



    </div>
    <div class="form_main1">
  <span class="form_left"> Crop Variety

  </span>

        <span style="margin-left:10px">  <?php echo $result1['crop_variety']; ?> </span>


    </div>

    <div class="form_main1">
  <span class="form_left"> Village

  </span>

   <span style="margin-left:10px">
    <?php echo $result1['village']; ?>
	 </span>
    </div>

    <div class="form_main1">
	  <span class="form_left">Farm Latitude

	  </span>

        <span style="margin-left:10px">  <?php echo $result1['farm_lat']; ?> </span>
    </div>
        <div class="form_main1">
  <span class="form_left"> Farm Longitude

  </span>

            <span style="margin-left:10px">  <?php echo $result1['farm_long']; ?> </span>


        </div>
    <div class="form_main1">
  <span class="form_left"> Year

  </span>


        <span style="margin-left:10px"> <?php

            list($y,$m,$d)=explode("-",$result1['year']);

            echo $d.'-'.$m.'-'.$y; ?></span>



    </div>


</div>

   
   <div class="form_mainright">

       <div class="form_main1">
  <span class="form_left"> Survey No

  </span>

           <span style="margin-left:10px">  <?php echo $result1['field_survey_no']; ?> </span>


       </div>

       <div class="form_main1">
  <span class="form_left"> Season

  </span>

   <span style="margin-left:10px">
    <?php echo $result1['season']; ?>
	 </span>
       </div>

       <div class="form_main1">
	  <span class="form_left">Sowing Date

	  </span>

           <span style="margin-left:10px">  <?php
               $newDate=explode("-",$result1['sowing_date']);
               echo $newDate[2].'-'.$newDate[1].'-'.$newDate[0]; ?> </span>

           <div class="form_main1">
  <span class="form_left"> Seed Source

  </span>

               <span style="margin-left:10px">  <?php echo $result1['seed_source']; ?> </span>


           </div>

           <div class="form_main1">
  <span class="form_left"> Seed Rate

  </span>

               <span style="margin-left:10px">  <?php echo $result1['seed_rate']; ?> </span>


           </div>
           <div class="form_main1">
  <span class="form_left"> Govt Subsidy

  </span>

               <span style="margin-left:10px">  <?php echo $result1['govtsubsidy']; ?> </span>


           </div>
           <div class="form_main1">
               <span class="form_left">Picture</span>
                  <span class="form_right">
                   <div class="far_photo" style="margin-top: 10px;" >
                       <a href="<?php if($result1['field_image']==""){echo "fphotos/Lighthouse.jpg";}else{echo "fphotos/". $farmer_district."/". $c['field_image'];}?>"  class="farmer_photo"> <img src="<?php if($result1['field_image']==""){echo "fphotos/Lighthouse.jpg";}else{echo "fphotos/".$farmer_district."/".$result1['field_image'];}?>" width="75" height="75" /></a>
                   </div>
                  </span>
            </div>

       </div>
  
  
   
  </div> </div>
   <div class="btn_ali" style="margin-left:1043px;"></div>
 <!--  <div class="deta_head"> Soil Mapings: </div>
   <div class="form_mainf" style="margin-top:10px"">
   
   <div class="form_main1" style="width:600px">
  <span class="form_left"> N</span>
   <span style="margin-left:10px"> <?php echo "" ?></span>
  </div>
  <div class="form_main1" style="width:600px">
  <span class="form_left"> P</span>
   <span style="margin-left:10px"> <?php echo "" ?></span>
  </div>
  <div class="form_main1" style="width:600px">
  <span class="form_left"> K</span>
   <span style="margin-left:10px"> <?php echo "" ?></span>
  </div>
  
   </div> -->
   <div class="deta_head"> Recommendations: </div>
 <div class="form_mainf" style="float:left; margin-top:10px;width:575px;">
   <?php
$q1=mysql_query("select * from farmers where sno='$fid'");
$r1=mysql_fetch_object($q1);
$d=$r1->district;
$t=$r1->taluk;
$c=$result1['crop_name'];

//echo $d." ".$t." ".$c;
$q=mysql_query("select * from rec where district='$d' and taluk='$t' and crop_type='$c'") or die(mysql_error());

$r=mysql_fetch_array($q);
?>

<div style="float:left;width:207px;">
<div class="form_main1">
  <span class="form_left"> Urea</span>
   <span style="margin-left:10px"> <?php echo ($result1['cultivation_area'])*($r['urea']/2.5) ?></span>
  </div>
  <div class="form_main1">
  <span class="form_left"> Dap</span>
   <span style="margin-left:10px"> <?php echo ($result1['cultivation_area'])*($r['dap']/2.5) ?></span>
  </div>
  <div class="form_main1">
  <span class="form_left"> Mop</span>
   <span style="margin-left:10px"> <?php echo ($result1['cultivation_area'])*($r['mop']/2.5) ?></span>
  </div>
  <div class="form_main1">
  <span class="form_left"> Gypsum</span>
   <span style="margin-left:10px"> <?php echo ($result1['cultivation_area'])*($r['gypsum']/2.5) ?></span>
  </div>
  <div class="form_main1">
  <span class="form_left"> Zinc Sulphat</span>
   <span style="margin-left:10px"> <?php echo ($result1['cultivation_area'])*($r['zinc_sulphate'] /2.5)?></span>
  </div>
  <div class="form_main1">
  <span class="form_left">Borax</span>
   <span style="margin-left:10px"> <?php echo ($result1['cultivation_area'])*($r['borax']/2.5) ?></span>
  </div>
  
  </div>
  <div style="float: left;margin-left:150px;width:218px;">
  <div class="form_main1">
  
	  <span class="form_left">ssp</span>
	   <span style="margin-left:10px"> <?php echo ($result1['cultivation_area'])*($r['ssp']/2.5) ?></span>
  </div>
  
  
  <div class="form_main1">
		  <span class="form_left">ssp_urea</span>
		   <span style="margin-left:10px"> <?php echo ($result1['cultivation_area'])*($r['ssp_urea']/2.5) ?></span>
  </div>
  <div class="form_main1">
		  <span class="form_left">ssp_gypsum</span>
		   <span style="margin-left:10px"> <?php echo ($result1['cultivation_area'])*($r['ssp_gypsum']/2.5) ?></span>
  </div>
  <div class="form_main1">
	  <span class="form_left">ssp_dap</span>
	   <span style="margin-left:10px"> <?php echo ($result1['cultivation_area'])*($r['ssp_dap']/2.5) ?></span>
  </div>
  
  </div>
 </table>
 </div>

<?php } ?>  
  
  </div> </div>
  
  <?php include 'footer.php'; ?>