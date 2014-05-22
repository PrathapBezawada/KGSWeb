<?php

include 'header.php';
$sno=$_REQUEST['sno'];
$query=mysql_query("select Loc_Lat,Loc_Long,village from farmers where sno='$sno'");

$result=mysql_fetch_array($query);

?>

	
   
		 <script>
		 var lat="<?php echo $result['Loc_Lat']?>";
	   var lng="<?php echo $result['Loc_Long']?>";
	   
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
				       title:'<?php echo $result['village'] ?>'
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


<script type="text/javascript">

</script>
<div class="midd_right1">
 <div class="main_heads">
  <div class="farmer_head">MAP </div>

  <div class="btn_m">
  <button type="submit" name="submit" onclick="window.location='farmerslist.php';" class="new">Back</button>
  </div>
  
  <div class="gr_border">
  
  
  </div>
<div class="deta_head"> Farmer Location: </div>
<div class="form_mainf">
<div id="map_canvas" style="position-absolute ;left:150px; top:10px;bottom:10px;border-style:solid;border-width:5px; border-color:#748f02;height:500px; width:500px "></div>
</div>
  
</div>
</div>
<?php include 'footer.php';?>
<script type="text/javascript">
<!--
var TabbedPanels1 = new Spry.Widget.TabbedPanels("TabbedPanels1");
//-->
</script>
