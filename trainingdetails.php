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
    $w=mysql_query("select * from training where tr_id='$sno'") or die(mysql_error());
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
        var lat="<?php echo $c['tr_lat']?>";
        var lng="<?php echo $c['tr_lng']?>";

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
                title:'<?php echo $c['tr_village'] ?>'
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





?>
<div class="midd_right1">
    <div class="main_heads">
        <div class="farmer_head">Training Details View </div>
        <div class="btn_m">
            <button type="submit" name="submit" onclick="window.location='traininglist.php'" class="new">Back</button>
            <input type="hidden" name="sno" id="sno" value="<?php echo $c['tr_id'] ?>" />

        </div>



        <div class="gr_border">
        </div>

        <div class="deta_head"> Training Details:
        </div>
        <div class="form_mainf">
            <div class="form_mainleft">
                <div class="form_main1">
                    <span class="form_left"> User Name</span>
                    <span class="form_right"> <?php echo $c['tr_username']?>  </span>
                </div>
                <div class="form_main1">
                    <span class="form_left"> Trainig Level</span>
                    <span class="form_right"> <?php echo $c['tr_level']?>  </span>
                </div>

                <div class="form_main1">
                    <span class="form_left"> State</span>
                    <span class="form_right"> <?php echo $c['tr_state'] ;?> </span>
                </div>
                <div class="form_main1">
                    <span class="form_left"> District  </span>
                    <span class="form_right"> <?php echo $c['tr_district']; ?> </span>
                </div>
                <div class="form_main1">
                    <span class="form_left"> taluk</span>
                    <span class="form_right"> <?php echo $c['tr_taluk']; ?></span>
                </div>
                <div class="form_main1">
                    <span class="form_left"> village</span>
                    <span class="form_right"> <?php echo $c['tr_village']; ?> </span>
                </div>

            </div>
            <div class="form_mainright">
                <div class="form_main1">
                    <span class="form_left"> Male</span>
                    <span class="form_right"> <?php echo $c['tr_male']; ?>  </span>
                </div>
                <div class="form_main1">
                    <span class="form_left"> Female  </span>
                    <span class="form_right"> <?php echo $c['tr_female']; ?>  </span>
                </div>

                <div class="form_main1">
                    <span class="form_left"> TrainingTopic  </span>
                    <span class="form_right"> <?php echo $c['tr_topic']; ?>  </span>
                </div>
                <div class="form_main1">
                    <span class="form_left">  Date  </span>
                    <span class="form_right"> <?php echo $c['tr_date']; ?>  </span>
                </div>

                <div class="form_main1">
                    <span class="form_left">  TrainingFeedback  </span>
                    <span class="form_right"> <?php echo $c['tr_feedback']; ?>  </span>
                </div>
                <div class="form_main1">
                    <span  class="form_left">Picture </span>
                                        <span class="form_right">
					<div class="far_photo">
                        <a href="<?php if($c['tr_image']=="")
                        {
                            echo "fphotos/Lighthouse.jpg";
                        }
                        else
                        {
                            $username=$c['tr_username'];
                            $q=mysql_query("select * from users where userid='$username'");
                            $r=mysql_fetch_array($q);


                            echo "fphotos/". $r['district']."/". $c['tr_image'];
                        }?>"  class="farmer_photo">
                            <img src="<?php if($c['tr_image']==""){echo "fphotos/Lighthouse.jpg";}else{echo "fphotos/".$r['district']."/".$c['tr_image'];}?>" width="100" height="100" /></a>
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





















