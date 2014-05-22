<?php

error_reporting(E_ALL);

ob_start();
$activetab="farmar";
include 'header.php';


$w=mysql_query("select * from farmers order by sno desc") or die(mysql_error());
$c=mysql_fetch_array($w);

if(isset($_REQUEST['sno']))
{
	if(isset($_GET['sno']))
	$sno=$_GET['sno'];
	if(isset($_POST['sno']))
	$sno=$_POST['sno'];
$w=mysql_query("select * from fieldvisit where fv_id='$sno'") or die(mysql_error());
$c=mysql_fetch_array($w);
?>
 <script src="SpryAssets/SpryTabbedPanels.js" type="text/javascript"></script>
<link href="SpryAssets/SpryTabbedPanels.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="colorbox.css" />

<script src="js/jquery.colorbox.js"></script>
		<script>
			$(document).ready(function(){
				//Examples of how to assign the Colorbox event to elements
				$(".farmer_photo").colorbox({rel:'group1'});

			});
			
			
			
			
			
</script>
	 <script>
	  var lat="";
	   var lng="";
		 var lat="<?php echo $c['fv_lat']?>";
	   var lng="<?php echo $c['fv_lng']?>";
	   
	   function initialize() {
	    
	    var myLatlng = new google.maps.LatLng( lat,lng);
	       var myOptions = {
	         zoom: 8,
	         center: myLatlng,
	         mapTypeId: google.maps.MapTypeId.ROADMAP
	       }
	       var map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
	       
	       var marker = new google.maps.Marker({
				       position: myLatlng,
				       map: map,
				       title:'<?php echo $c['fv_village'] ?>'
	                 });
	       
	     }
	 
	     function loadScript() {
	       var script = document.createElement("script");
	       script.type = "text/javascript";
	       script.src = "http://maps.google.com/maps/api/js?sensor=false&callback=initialize";
	       document.body.appendChild(script);
	     }
	 
	     window.onload = loadScript;
	 
	 
   </script>
   <?php
}




if($c['fv_title']=="field visit")
{

    $type="fieldvisit";

}
else
{

    $type="othervisit";
}

?>
<div class="midd_right1">
 <div class="main_heads">
  <div class="farmer_head">Field Visit Details View </div>
			<div class="btn_m">
				<button type="submit" name="submit" onclick="window.location='fieldvisitlist.php?type=<?php echo $type ?>&fv_id=<?php echo $c['fv_id'] ?>';" class="new">Back</button>
				<input type="hidden" name="sno" id="sno" value="<?php echo $c['fv_id'] ?>" />

			</div>



			<div class="gr_border">
			</div>
	  
			<div class="deta_head"> Field Visit Details: 
			</div>
			<div class="form_mainf">
				<div class="form_mainleft">
					<div class="form_main1">
						<span class="form_left"> Name</span>
						<span class="form_right"> <?php echo $c['fv_user']?>  </span>
					</div>
                    <div class="form_main1">
                        <span class="form_left"> Type</span>
                        <span class="form_right"> <?php echo $c['fv_title']?>  </span>
                    </div>
                    <?php

                    if($c['fv_title']=="fieldvisit")
                    {?>

                        <div class="form_main1">
                            <span class="form_left"> Farmer Name</span>
                            <span class="form_right"> <?php
                                $farmer_id=$c['fv_farmer_id'];
                                $q=mysql_query("select fname,lname from farmers where sno='$farmer_id'");
                                $r=mysql_fetch_array($q);


                                echo $r['fname'].' '.$r['lname']?>  </span>
                        </div>
                        <div class="form_main1">
                            <span class="form_left"> Farm Name</span>
                            <span class="form_right"> <?php
                                $farm_id=$c['fv_farm_id'];
                                $q=mysql_query("select farm_name from farms where sno='$farm_id'");
                                $r=mysql_fetch_array($q);
                                echo $r['farm_name']?>  </span>
                        </div>


                    <?php

                    }
                    ?>
					<div class="form_main1">
						<span class="form_left"> State</span>
						<span class="form_right"> <?php echo $c['fv_state'] ;?> </span>
					</div>
					<div class="form_main1">
						<span class="form_left"> District  </span>
						<span class="form_right"> <?php echo $c['fv_district']; ?> </span>
					</div>
					<div class="form_main1">
						<span class="form_left"> taluk</span>
						<span class="form_right"> <?php echo $c['fv_taluk']; ?></span>
					</div>
					<div class="form_main1">
					<span class="form_left"> village</span>
					<span class="form_right"> <?php echo $c['fv_village']; ?> </span>
					</div>

                </div>
                <div class="form_mainright">
                    <div class="form_main1">
                        <span class="form_left"> Purpose</span>
                        <span class="form_right"> <?php echo $c['fv_purpose']; ?>  </span>
                    </div>
                    <div class="form_main1">
                        <span class="form_left"> Observation  </span>
                        <span class="form_right"> <?php echo $c['fv_observation']; ?>  </span>
                    </div>

                    <div class="form_main1">
                        <span class="form_left"> Recommandetion  </span>
                        <span class="form_right"> <?php echo $c['fv_rec']; ?>  </span>
                    </div>
                    <div class="form_main1">
                        <span class="form_left"> Visited Date  </span>
                        <span class="form_right"> <?php echo $c['fv_Date']; ?>  </span>
                    </div>


                    <div class="form_main1">
                        <span  class="form_left">Picture </span>
                                        <span class="form_right">
					<div class="far_photo">
							<a href="<?php if($c['fv_picture']=="")
                            {
                                echo "fphotos/Lighthouse.jpg";
                            }
                            else
                            {
                                $username=$c['fv_user'];
                                $q=mysql_query("select * from users where userid='$username'");
                                $r=mysql_fetch_array($q);

                                echo "fphotos/". $r['district']."/". $c['fv_picture'];
                            }?>"  class="farmer_photo">
                                <img src="<?php if($c['fv_picture']==""){echo "fphotos/Lighthouse.jpg";}else{echo "fphotos/".$r['district']."/".$c['fv_picture'];}?>" width="100" height="100" /></a>
					    </div>
                                             </span>
                    </div>
                    </div>
                    <div class="form_main1" style="margin-top:10px">
                        <span  class="form_left">MAP </span>
                                        <span class="form_right">
                                        <div id="map_canvas" style="position-absolute ; top:10px;bottom:10px;border-style:solid;border-width:5px; border-color:#748f02;height:300px; width:500px ">
                                        </div>
                                            </span>
                    </div>
				</div>
		    </div>
		</div>
	</div>
  

<?php include 'footer.php';?>





















