<?php

error_reporting(E_ALL);

ob_start();
$activetab="farmar";
include 'header.php';


if(isset($_REQUEST['field_id']))
{




        $farm_id=$_REQUEST['field_id'];
    $w=mysql_query("select * from cce where cce_farm_id='$farm_id'") or die(mysql_error());
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
        var lat="<?php echo $c['cce_lat']?>";
        var lng="<?php echo $c['cce_long']?>";

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
                title:'<?php

                 $q=mysql_query("select * from farms where sno='$farm_id'");
                            $r=mysql_fetch_array($q);

                echo $r['village'] ?>'
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


$file=$_REQUEST['file'];
$farmerid=$_REQUEST['farmerid'];
if($file)
{
  $location="farmerresult.php";
}
else{
    $location="farmerlist.php";
}
$location="farmerdetails.php?sno=".$farmerid."&m=0";

?>
<div class="midd_right1">
    <div class="main_heads">
        <div class="farmer_head">Crop Cutting Experience Details View </div>
        <div class="btn_m">
          <button type="submit" name="submit" onclick="window.location='<?php echo $location ?>'" class="new">Back</button>
            <input type="hidden" name="sno" id="sno" value="<?php echo $c['sno'] ?>" />

        </div>



        <div class="gr_border">
        </div>

        <div class="deta_head">Crop Cutting Experience Details:
        </div>
        <div class="form_mainf">
            <div class="form_mainleft">
                <div class="form_main1">
                    <span class="form_left"> Harvest Date</span>
                    <span class="form_right"> <?php
                       $date=explode("-",$c['cce_harvest_date']);
                        echo $date[2].'-'.$date[1].'-'.$date[0]?>  </span>
                </div>
                <div class="form_main1">
                    <span class="form_left"> Harvest Area</span>
                    <span class="form_right"> <?php echo $c['cce_harvest_area']?>  </span>
                </div>

                <div class="form_main1">
                    <span class="form_left"> Fw pod fp</span>
                    <span class="form_right"> <?php echo $c['cce_harvest_area'] ;?> </span>
                </div>
                <div class="form_main1">
                    <span class="form_left"> Fodder fp  </span>
                    <span class="form_right"> <?php echo $c['cce_fodder_fp']; ?> </span>
                </div>
                <div class="form_main1">
                    <span class="form_left"> Pod_ip</span>
                    <span class="form_right"> <?php echo $c['cce_pod_ip']; ?></span>
                </div>
                <div class="form_main1">
                    <span class="form_left"> Fw pod fp</span>
                    <span class="form_right"> <?php echo $c['cce_fw_fodder_ip']; ?> </span>
                </div>

            </div>
            <div class="form_mainright">
                <div class="form_main1">
                    <span class="form_left"> Fodder fp</span>
                    <span class="form_right"> <?php echo $c['cce_ssfw_pod_fp']; ?>  </span>
                </div>
                <div class="form_main1">
                    <span class="form_left"> Pod ip  </span>
                    <span class="form_right"> <?php echo $c['cce_ssfw_fodder_fp']; ?>  </span>
                </div>

                <div class="form_main1">
                    <span class="form_left"> Ssfw fodder fp  </span>
                    <span class="form_right"> <?php echo $c['cce_ssfw_pod_ip']; ?>  </span>
                </div>
                <div class="form_main1">
                    <span class="form_left">  Ssfw pod ip  </span>
                    <span class="form_right"> <?php echo $c['cce_ssfw_fodder_ip']; ?>  </span>
                </div>

                <div class="form_main1">
                    <span  class="form_left">Picture </span>
                                        <span class="form_right">
					<div class="far_photo">
                        <a href="<?php if($c['cce_image']=="")
                        {
                            echo "fphotos/Lighthouse.jpg";
                        }
                        else
                        {
                            $username=$c['tr_username'];
                            $q=mysql_query("select * from farms where sno='$farm_id'");
                            $r=mysql_fetch_array($q);


                            echo "fphotos/". $r['district']."/". $c['tr_image'];
                        }?>"  class="farmer_photo">
                            <img src="<?php if($c['cce_image']==""){echo "fphotos/Lighthouse.jpg";}else{echo "fphotos/".$r['district']."/".$c['cce_image'];}?>" width="100" height="100" /></a>
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





















