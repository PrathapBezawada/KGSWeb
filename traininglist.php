<?php
session_start();
//$activetab="farmar";

if($_POST['truser'])
{
    include 'dbcon.php';


$id=$_REQUEST['tr_id'];

?>
    <div class="main_heads">
        <div class="farmer_head">Training Report List.  </div>
        <div class="btn_m">
            <button type="submit" name="submit" onclick="window.location='traininglist.php'" class="new">Back</button>


        </div>
    </div>
    <?php
    $query="select * from training where tr_id='$id'  order by tr_id desc";
     $q=mysql_query($query);
    $r=mysql_fetch_array($q);

    $user=$r['tr_username'];

    ?>

    <table border="0px" cellpadding="0" cellspacing="0" width="100%"  >
        <tr>

            <th>Training level</th>
            <th>State</th>
            <th>District</th>
            <th>Taluk</th>
            <th>Hobli</th>
            <th>Village</th>
            <th>Details</th>
        </tr>
        <?php

        $query="select * from training where tr_username='$user'  order by tr_id desc";
        $q=mysql_query($query); $n=1;

        while($r=mysql_fetch_array($q))
        {

            if($n%2==0)
            {
                $cls="td_even";
            }
            else
            {
                $cls="td_odd";
            }$n++;

            ?>
            <tr class="<?php echo $cls ?>">

                <td><?php echo  $r['tr_level'] ?></td>
                <td><?php echo  $r['tr_state'] ?> </td>
                <td><?php echo  $r['tr_district'] ?> </td>
                <td><?php echo  $r['tr_taluk'] ?> </td>
                <td><?php echo  $r['tr_hobli'] ?> </td>
                <td><?php echo  $r['tr_village'] ?> </td>
                <td><a href='trainingdetails.php?sno=<?php echo $r['tr_id']?>'  name='basic' style='color:blue;' >Details</a> </td>

            </tr>
        <?php

        }

        ?>

    </table>

    </div>


<?php
    exit;
}
include 'header.php';

?>
<!--- modal window --->
<link type='text/css' href='css/demo.css' rel='stylesheet' media='screen' />
<link type='text/css' href='css/basic.css' rel='stylesheet' media='screen' />
<link type='text/css' href='css/jquery-ui.css' rel='stylesheet' media='screen' />

<script type='text/javascript' src='js/jquerymodal.js'></script>
<script type='text/javascript' src='js/jquery.simplemodal.js'></script>
<script type='text/javascript' src='js/jquery.ui.core.js'></script>
<script type='text/javascript' src='js/jquery.ui.widget.js'></script>
<script type='text/javascript' src='js/jquery.ui.dialog.js'></script>
<script type='text/javascript' src='js/basic.js'> </script>


<style type="text/css">
    .simplemodal-overlay{z-index:50 !important;}
    .simplemodal-container{z-index:99 !important;}
    .ui-widget { margin: 15px 296px !important;
        position: fixed !important;

        font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
        font-size: 12px;

    }

    .ui-widget-content .ui-icon{background: url(../img/basic/x.png) no-repeat !important;

        background-position: -4px -3px !important;}


    ui-widget-overlay{width: 13px !important; height: 6px !important; z-index: 999 !important; }


</style>

<script>
    $(document).ready(function()
    {
        $('body').css('overflow','hidden');
        $(".modal9").dialog({
        autoOpen:false,
        resize:false,
        position: { my: "center", at: "center", of: window },
        height: 600,
        width: 700,
        modal: true,
        title:"field visit details",
        open: function(event, ui) { $(".ui-dialog-titlebar").show(); }
    });

        $('.basic9').click(function()
            {
                var id=this.id;
                var id=id.substr(6)
                //alert("basic-modal-content9-"+id);

                // $(".modal9_other").dialog("open");
                $("#basic-modal-content9-"+id).dialog("open");
            }
        );



        $('#district').change(function(){

            var district=$('#district').val();
            var dataString='district=' + district;
            if(district!=""){
                window.location="traininglist.php?d="+district;
            }else{
                window.location="traininglist.php";
            }
        });

        $('#taluk').change(function(){
            var district=$('#district').val();
            var taluk=$('#taluk').val();

            var dataString='taluk=' + taluk;



            taluk=$.trim(taluk);

            if(taluk!=""){
                window.location="traininglist.php?d="+district+"&t="+taluk;
            }else{
                window.location="traininglist.php?d="+district;
            }
        });

        $('#hobli').change(function(){
            var district=$('#district').val();
            var taluk=$('#taluk').val();
            var hobli=$('#hobli').val();
            if(village!=""){
                window.location="traininglist.php?d="+district+"&t="+taluk+"&h="+hobli;
            }else{
                window.location="traininglist.php?d="+district+"&t="+taluk;
            }
        });

        $('#village').change(function(){
            var district=$('#district').val();
            var taluk=$('#taluk').val();
            var village=$('#village').val();
            var hobli=$('#hobli').val();
            if(village!=""){
                window.location="traininglist.php?d="+district+"&t="+taluk+"&h="+hobli+"&v="+village;
            }else{
                window.location="traininglist.php?d="+district+"&t="+taluk+"&h="+hobli;
            }
        });

        $('.truser').on('click',function(){

            id=this.id;
            id=id.substring(7);
            var datastring="truser=true&tr_id="+id;

            $.ajax({

                data:datastring,
                url:"traininglist.php",
                type:"post",

                success:function(responsedata)
                {
                    $("#traininglist").replaceWith(responsedata);
                }

            });

        });


    });
</script>

<?php
?>


    <div class="midd_right1" style="min-height: 350px;">
<div id="traininglist">
    <div class="main_heads">
        <div class="farmer_head">Training

            Report List.  </div>

        <div class="form_main_2">
			 <span class="form_right_1">
			  <select name="district" id="district" class="txt_box1">
                  <option value="">--District--</option>
                  <?php if(isset($_GET['d']))
                  {
                      $d=$_GET['d'];
                  }
                  $query=mysql_query("select distinct(tr_district) from training ");
                  while($result=mysql_fetch_array($query))
                  {
                      ?>
                      <option value="<?php echo $result['tr_district'] ?>" <?php if($result['tr_district']==$d){ echo "selected";} ?>><?php echo strtoupper($result['tr_district']) ?></option>
                  <?php
                  }
                  ?>
              </select>
		    </span>
        </div>



        <div class="form_main_2">


   <span class="form_right_1">  <select name="taluk" id="taluk" class="txt_box1">
           <option value="">--Taluk--</option>
           <?php
           if(isset($_GET['d']))
           {
               $district=$_GET['d'];
               $district=trim($district);
               echo '<br>'.$district;

               $q1=mysql_query("select * from training where tr_district='$district' group by tr_taluk order by tr_taluk");

               if(isset($_GET['t'])){$t=$_GET['t'];

                   $t=trim($t);

                   echo 'taluk is'.$t;
               }

               while($r1=mysql_fetch_array($q1)){
                   ?><option value="<?php echo trim($r1['tr_taluk'])?>" <?php if(trim($r1['tr_taluk'])==$t){ echo "selected";} ?>><?php  echo $r1['tr_taluk'] ?></option>";
               <?php }
           }
           ?>
       </select></span>


        </div>

        <div class="form_main_2">
               <span class="form_right_1">
                       <select name="hobli" id="hobli" class="txt_box1">
                           <option value="">--Hobli--</option>
                           <?php
                           if(isset($_GET['t'])){
                               $district=$_GET['d'];
                               $t=$_GET['t'];
                               $t=trim($t);

                               $q2=mysql_query("select * from training where tr_district='$district' and tr_taluk='$t' group by tr_hobli order by tr_hobli");
                               //echo "select * from fieldvisit where fv_district='$district' and fv_taluk='$t' group by fv_hobli order by fv_hobli";
                               if(isset($_GET['h']))
                               {$h=$_GET['h'];}
                               while($r2=mysql_fetch_array($q2)){
                                   ?><option value="<?php echo $r2['tr_hobli']?>" <?php if($r2['tr_hobli']==$h){ echo "selected";} ?>><?php  echo $r2['tr_hobli'] ?></option>";
                               <?php }
                           }
                           ?>
                       </select>

                 </span>
        </div>

        <div class="form_main_2">


   <span class="form_right_1">
   <select name="village" id="village" class="txt_box1">
       <option value="">--Village--</option>
       <?php
       if(isset($_GET['t'])){
           $district=$_GET['d'];
           $t=$_GET['t'];
           $t=trim($t);
           $h=$_GET['h'];
           $q2=mysql_query("select * from training where tr_district='$district' and tr_taluk='$t' and tr_hobli='$h' group by tr_village order by tr_village");
           if(isset($_GET['v'])){$v=$_GET['v'];}
           while($r2=mysql_fetch_array($q2)){
               ?><option value="<?php echo $r2['tr_village']?>" <?php if($r2['tr_village']==$v){ echo "selected";} ?>><?php  echo $r2['tr_village'] ?></option>";
           <?php }
       }
       ?>
   </select>

  </span>
        </div>

    </div>

    <br>

<table border="0px" cellpadding="0" cellspacing="0" width="100%">
    <tr>
        <th>Name</th>
        <th>Training level</th>
        <th>State</th>
        <th>District</th>
        <th>Taluk</th>
        <th>Hobli</th>
        <th>Village</th>
        <th>Count</th


    </tr>
    <?php


    if(isset($_GET['v']))
    {
        $d=$_GET['d'];
        $t=$_GET['t'];
        $t=trim($t);
        $h=$_GET['h'];
        $v=$_GET['v'];


        $q="select * from training where tr_district='$d' and tr_taluk='$t' and tr_hobli='$h' and tr_village='$v'  ";


    }
    else if(isset($_GET['h']))
    {
        $d=$_GET['d'];
        $t=$_GET['t'];
        $t=trim($t);
        $h=$_GET['h'];



        $q="select * from training where tr_district='$d' and tr_taluk='$t' and tr_hobli='$h' and tr_hobli='$h' GROUP BY(tr_username)  order by tr_id desc";


    }
    else if(isset($_GET['t']))
    {
        $d=$_GET['d'];
        $t=$_GET['t'];


        $q="select * from training where tr_district='$d' and tr_taluk='$t' GROUP BY(tr_username)  order by tr_id desc";

    }
    else if(isset($_GET['d']))
    {
        $d=$_GET['d'];

        $q="select * from training where tr_district='$d' GROUP BY(tr_username) order by tr_id desc";
     }

    else
    {

        $q=" SELECT * FROM training GROUP BY(tr_username)  order by tr_id desc ";

    }
    //echo $q;

    $q1=mysql_query($q);

    $arr=array();


    $n=1;
    if(mysql_num_rows($q1)>0)
    {
        while($c=mysql_fetch_array($q1))
        {
            $fv_id=$c['fv_id'];
            $fv_farm_id=$c['fv_farm_id'];
            $fv_farmer_id=$c['fv_farmer_id'];
            array_push($arr,$fv_id);

            if($n%2==0)
            {
                $cls="td_even";
            }
            else
            {
                $cls="td_odd";
            }$n++;

            ?>
        <tr class="<?php echo $cls ?>">


            <td align="left" >
                <a id="truser_<?php echo $c['tr_id']?>" style='color:blue;' class="truser"><?php echo $c['tr_username'] ?></a>

            </td>



            <td><?php echo $c['tr_level'] ?></td>
            <td><?php echo $c['tr_state'] ?></td>
            <td><?php echo $c['tr_district'] ?></td>
            <td><?php echo $c['tr_taluk'] ?></td>
            <td><?php echo $c['tr_hobli'] ?></td>
            <td><?php echo $c['tr_village'] ?></td>
            <td><?php
                $user=$c['tr_username'];

                $q=mysql_query("select * from training where tr_username='$user'");


              $count=mysql_num_rows($q);
                echo $count;


                ?></td>


            </tr>


        <?php

        }

    }?>


    </table>
    </div>
   </div>
<?php include 'footer.php';?>
</div>







