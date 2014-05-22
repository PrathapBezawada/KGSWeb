<?php
session_start();
//$activetab="farmar";


include 'dbcon.php';
if($_POST['delete'])
{

    $fv_id=$_REQUEST['fvid'];
$q=mysql_query("update fieldvisit set del=1 where fv_id=$fv_id");
    echo '*************';


/*
    if($_REQUEST["type"]=="other")
    {

    ?>

    <div class="midd_right1" style="min-height: 350px;">
        <div class="main_heads">
            <div class="farmer_head">Field Visit List  </div>
            <div class="btn_m">
                <button type="submit" name="submit" onclick="window.location='fieldvisitlist.php'" class="new">Back</button>


            </div>
        </div>
        <?php
        $query="select * from fieldvisit where fv_id='$fv_id'  order by fv_id desc";

        $q=mysql_query($query);
        $r=mysql_fetch_array($q);
        $user=$r['fv_user'];




        ?>
        <table border="0px" cellpadding="0" cellspacing="0" width="100%"  >
            <tr>
                <th>District</th>
                <th>Taluk</th>
                <th>Village</th>
                <th>Date</th>
                <th>Delete</th>
            </tr>
            <?php

            $query="select * from fieldvisit where fv_user='$user' and del!=1  order by fv_id desc";
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

                    <td><?php echo  $r['fv_district'] ?></td>
                    <td><?php echo  $r['fv_taluk'] ?> </td>

                    <td><a href="fieldvisitdetails.php?sno=<?php echo $r['fv_id'] ?>"style='color:blue;' class='fv_details' id='fvdetails_<?php echo $r['fv_id'] ?>' ><?php  echo $r['fv_village'];?></a>  </td>

                    <td><?php echo  $r['fv_Date'] ?></td>
                    <td><a class="delete_other" id="fvdelete_ <?php echo  $r['fv_id'] ?>" style="color:blue">Delete</a>  </td>
                </tr>
            <?php

            }

            ?>

        </table>

    </div>

}
                        else
                        {?>

                            <div class="midd_right1" style="min-height: 350px;">
                                <div class="main_heads">
                                    <div class="farmer_head">Field Visit List  </div>
                                    <div class="btn_m">
                                        <button type="submit" name="submit" onclick="window.location='fieldvisitlist.php'" class="new">Back</button>


                                    </div>
                                </div>
                                <?php
                                $query="select * from fieldvisit where fv_id='$fv_id' and del!=1  order by fv_id desc";
                                $q=mysql_query($query);
                                $r=mysql_fetch_array($q);
                                $user=$r['fv_user'];
                                ?>
                                <table border="0px" cellpadding="0" cellspacing="0" width="100%"  >
                                    <tr>


                                        <th>Farm Name</th>
                                        <th>Farmer Name</th>
                                        <th>Date</th>

                                        <?php


                                        ?>

                                    </tr>

                                    <?php

                                    $query="select * from fieldvisit where fv_user='$user' and del!=1  order by fv_id desc";
                                    //echo $query.'<br>';
                                    $q=mysql_query($query);

                                    $count=mysql_num_rows($q);
                                    $n=1;

                                    while($r=mysql_fetch_array($q))
                                    {

                                        $farm_id=$r['fv_farm_id'];
                                        $farmer_id=$r['fv_farmer_id'];

                                        $query1="select farm_name from farms where sno=$farm_id";
                                        // echo $query1;
                                        $q1=mysql_query($query1);
                                        $r1=mysql_fetch_array($q1);



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

                                            <td><a href="fieldvisitdetails.php?sno=<?php echo $r['fv_id'] ?>"style='color:blue;' id='fvdetails_<?php echo $r['fv_id'] ?>' ><?php  echo $r1['farm_name'];?></a>  </td>
                                            <td >
                                                <?php


                                                $query1="select fname,lname from farmers where sno=$farmer_id";

                                                $q1=mysql_query($query1);
                                                $r1=mysql_fetch_array($q1);
                                                echo $r1['fname']." ".$r1['lname'];

                                                ?>
                                            </td>
                                            <td><?php echo  $r['fv_Date'] ?></td>
                                            <td><a class="delete_fv" id="fvdelete_ <?php echo  $r1['fv_id'] ?>" style="color:blue">Delete</a>  </td>

                                        </tr>



                                    <?php
                                    }

                                    ?>

                                </table>

                            </div>

                        <?php

                        }
*/

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
                window.location="fieldvisitlist.php?d="+district;
            }else{
                window.location="fieldvisitlist.php";
            }
        });

        $('#taluk').change(function(){
            var district=$('#district').val();
            var taluk=$('#taluk').val();

            var dataString='taluk=' + taluk;



            taluk=$.trim(taluk);

            if(taluk!=""){
                window.location="fieldvisitlist.php?d="+district+"&t="+taluk;
            }else{
                window.location="fieldvisitlist.php?d="+district;
            }
        });

        $('#hobli').change(function(){
            var district=$('#district').val();
            var taluk=$('#taluk').val();
            var hobli=$('#hobli').val();
            if(village!=""){
                window.location="fieldvisitlist.php?d="+district+"&t="+taluk+"&h="+hobli;
            }else{
                window.location="fieldvisitlist.php?d="+district+"&t="+taluk;
            }
        });

        $('#village').change(function(){
            var district=$('#district').val();
            var taluk=$('#taluk').val();
            var village=$('#village').val();
            var hobli=$('#hobli').val();
            if(village!=""){
                window.location="fieldvisitlist.php?d="+district+"&t="+taluk+"&h="+hobli+"&v="+village;
            }else{
                window.location="fieldvisitlist.php?d="+district+"&t="+taluk+"&h="+hobli;
            }
        });



        $('.delete_other').on('click',function(){

              id=this.id;
              id=id.substring(10);

              var datastring="type=othervisit&delete=true&fv_id="+id;
            confirm('Are you sure , do you want to Delete this fieldvisit?');

            $.ajax({

                data:datastring,
                url:"fieldvisitlist.php",
                 success:function(responsedata)
                {
                    $("#tr_other_"+id).remove();
                   // $(".midd_right1").replaceWith(responsedata);
                }

            });

        });



        $('.delete_fv').on('click',function(){

            id=this.id;
            id=id.substring(10);
            var datastring="type=fieldvisit&fv_id="+id;
            confirm('Are you sure , do you want to Delete this fieldvisit?');
            $.ajax({

                data:datastring,
                url:"fieldvisitlist.php",


                success:function(responsedata)
                {
                    $("#tr_fv_"+id).remove();
                   // $(".midd_right1").replaceWith(responsedata);
                }

            });

        })
    });
</script>

<?php



if(isset($_REQUEST["type"]))
{
include 'dbcon.php';
    $fv_id=$_REQUEST["fv_id"];




if($_REQUEST["type"]=="othervisit")
{


    if($_GET['delete'])
    {

        $fv_id=$_REQUEST['fv_id'];
        $q=mysql_query("update fieldvisit set del=1 where fv_id=$fv_id");

        exit;
    }
?>

    <div class="midd_right1" style="min-height: 350px;">
        <div class="main_heads">
            <div class="farmer_head">Field Visit List  </div>
            <div class="btn_m">
                <button type="submit" name="submit" onclick="window.location='fieldvisitlist.php'" class="new">Back</button>


            </div>
        </div>
        <?php
        $query="select * from fieldvisit where fv_id='$fv_id'  order by fv_id desc";

        $q=mysql_query($query);
        $r=mysql_fetch_array($q);
        $user=$r['fv_user'];




        ?>
        <table border="0px" cellpadding="0" cellspacing="0" width="100%" id="fieldvisittable" >
            <tr>
                <th>District</th>
                <th>Taluk</th>
                <th>Village</th>
                <th>Date</th>
                <th>Delete</th>
            </tr>
            <?php

            $query="select * from fieldvisit where fv_user='$user' and del!=1  order by fv_id desc";
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
                <tr class="<?php echo $cls ?>" id="tr_other_<?php echo  $r['fv_id'] ?>">

                    <td><?php echo  $r['fv_district'] ?></td>
                    <td><?php echo  $r['fv_taluk'] ?> </td>

                    <td><a href="fieldvisitdetails.php?sno=<?php echo $r['fv_id'] ?>"style='color:blue;' class='fv_details' id='fvdetails_<?php echo $r['fv_id'] ?>' ><?php  echo $r['fv_village'];?></a>  </td>

                    <td><?php echo  $r['fv_Date'] ?></td>
                    <td><a class="delete_other" id="fvdelete_ <?php echo  $r['fv_id'] ?>" style="color:blue">Delete</a>  </td>
                </tr>
            <?php

            }

            ?>

        </table>

    </div>

<?php

}
            else
            {

                if($_GET['delete'])
                {

                    $fv_id=$_REQUEST['fv_id'];
                    $q=mysql_query("update fieldvisit set del=1 where fv_id=$fv_id");
                    exit;
                }

                ?>

                    <div class="midd_right1" style="min-height: 350px;">
                        <div class="main_heads">
                            <div class="farmer_head">Field Visit List  </div>
                            <div class="btn_m">
                                <button type="submit" name="submit" onclick="window.location='fieldvisitlist.php'" class="new">Back</button>


                            </div>
                        </div>
                        <?php
                        $query="select * from fieldvisit where fv_id='$fv_id' and del!=1  order by fv_id desc";
                        $q=mysql_query($query);
                        $r=mysql_fetch_array($q);
                        $user=$r['fv_user'];
                        ?>
                        <table border="0px" cellpadding="0" cellspacing="0" width="100%"  >
                            <tr>


                                <th>Farm Name</th>
                                <th>Farmer Name</th>
                                <th>Date</th>
                                <th>Delete</th>
                                <?php


                                ?>

                            </tr>

                            <?php

                            $query="select * from fieldvisit where fv_user='$user' and del!=1  order by fv_id desc";
                            //echo $query.'<br>';
                            $q=mysql_query($query);

                            $count=mysql_num_rows($q);
                            $n=1;

                            while($r=mysql_fetch_array($q))
                            {

                                $farm_id=$r['fv_farm_id'];
                                $farmer_id=$r['fv_farmer_id'];
                              
                                $query1="select farm_name from farms where sno=$farm_id";
                               // echo $query1;
                                $q1=mysql_query($query1);
                                $r1=mysql_fetch_array($q1);



                                if($n%2==0)
                                {
                                    $cls="td_even";
                                }
                                else
                                {
                                    $cls="td_odd";
                                }$n++;
                                ?>

                                <tr class="<?php echo $cls ?>" id="tr_fv_<?php echo  $r['fv_id'] ?>>

                                    <td><a href="fieldvisitdetails.php?sno=<?php echo $r['fv_id'] ?>"style='color:blue;' id='fvdetails_<?php echo $r['fv_id'] ?>' ><?php  echo $r1['farm_name'];?></a>  </td>
                                       <td >
                                        <?php


                                        $query1="select fname,lname from farmers where sno=$farmer_id";

                                        $q1=mysql_query($query1);
                                        $r1=mysql_fetch_array($q1);
                                        echo $r1['fname']." ".$r1['lname'];

                                        ?>
                                    </td>
                                    <td><?php echo  $r['fv_Date'] ?></td>
                                    <td><a class="delete_fv" id="fvdelete_ <?php echo  $r1['fv_id'] ?>" style="color:blue">Delete</a>  </td>

                                </tr>



                            <?php
                            }

                            ?>

                        </table>

                    </div>

                <?php

            }
}

else{
?>


<div class="midd_right1" style="min-height: 350px;">

 <div class="main_heads">
  <div class="farmer_head">Field Visit List  </div>

     <div class="form_main_2">
			 <span class="form_right_1">
			  <select name="district" id="district" class="txt_box1">
                  <option value="">--District--</option>
                  <?php if(isset($_GET['d']))
                  {
                      $d=$_GET['d'];
                  }
                  $query=mysql_query("select distinct(fv_district) from fieldvisit ");
                  while($result=mysql_fetch_array($query))
                  {
                      ?>
                      <option value="<?php echo $result['fv_district'] ?>" <?php if($result['fv_district']==$d){ echo "selected";} ?>><?php echo strtoupper($result['fv_district']) ?></option>
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

               $q1=mysql_query("select * from fieldvisit where fv_district='$district'and del!=1  group by fv_taluk order by fv_taluk");

               if(isset($_GET['t'])){$t=$_GET['t'];

                   $t=trim($t);

                   echo 'taluk is'.$t;
               }

               while($r1=mysql_fetch_array($q1)){
                   ?><option value="<?php echo trim($r1['fv_taluk'])?>" <?php if(trim($r1['fv_taluk'])==$t){ echo "selected";} ?>><?php  echo $r1['fv_taluk'] ?></option>";
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

                               $q2=mysql_query("select * from fieldvisit where fv_district='$district' and fv_taluk='$t' and del!=1 group by fv_hobli order by fv_hobli");
                                    //echo "select * from fieldvisit where fv_district='$district' and fv_taluk='$t' group by fv_hobli order by fv_hobli";
                               if(isset($_GET['h']))
                               {$h=$_GET['h'];}
                               while($r2=mysql_fetch_array($q2)){
                                   ?><option value="<?php echo $r2['fv_hobli']?>" <?php if($r2['fv_hobli']==$h){ echo "selected";} ?>><?php  echo $r2['fv_hobli'] ?></option>";
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
           $q2=mysql_query("select * from fieldvisit where fv_district='$district' and fv_taluk='$t' and fv_hobli='$h' and del!=1 group by fv_village order by fv_village");
           if(isset($_GET['v'])){$v=$_GET['v'];}
           while($r2=mysql_fetch_array($q2)){
               ?><option value="<?php echo $r2['fv_village']?>" <?php if($r2['fv_village']==$v){ echo "selected";} ?>><?php  echo $r2['fv_village'] ?></option>";
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
		<th>Purpose</th>
		<th>State</th>
		<th>District</th>
		<th>taluk</th>
        <th>hobli</th>
		<th>village</th>
        <th>Count</th>
 
	</tr>
  <?php


        if(isset($_GET['v']))
        {
            $d=$_GET['d'];
            $t=$_GET['t'];
            $t=trim($t);
            $h=$_GET['h'];
            $v=$_GET['v'];


            $q="select * from fieldvisit where fv_district='$d' and fv_taluk='$t' and fv_hobli='$h' and fv_village='$v' and del!=1   GROUP BY(fv_user)";


        }
        else if(isset($_GET['h']))
        {
            $d=$_GET['d'];
            $t=$_GET['t'];
            $t=trim($t);
            $h=$_GET['h'];



            $q="select * from fieldvisit where fv_district='$d' and fv_taluk='$t' and fv_hobli='$h' and fv_hobli='$h' and del!=1  GROUP BY(fv_user) order by fv_id desc";


        }
        else if(isset($_GET['t']))
        {
            $d=$_GET['d'];
            $t=$_GET['t'];


            $q="select * from fieldvisit where fv_district='$d' and fv_taluk='$t' and del!=1  GROUP BY(fv_user) order by fv_id desc";

        }
        else if(isset($_GET['d']))
        {
            $d=$_GET['d'];

            $q="select * from fieldvisit where fv_district='$d' and del!=1 GROUP BY(fv_user) order by fv_id desc";

        }

        else
        {
        $q=" SELECT * FROM fieldvisit where del!=1  GROUP BY(fv_user)  order by fv_id desc ";
        //$q= "SELECT *  FROM fieldvisit t1  JOIN ( SELECT MIN(fv_id) AS minid FROM fieldvisit GROUP BY fv_user ) AS alias_name ON alias_name.minid = t1.fv_id  order by t1.fv_user desc";
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
                         <?php
                         $type=$c['fv_title'];
              if($type == "fieldvisit")
                {
                         ?>
                    <a   href='fieldvisitlist.php?type=fieldvisit&fv_id=<?php echo $c['fv_id']?>'  name='basic' style='color:blue;' id="fieldvisit_<?php echo $c['fv_id']?>"><?php echo $c['fv_user'] ?></a> </div>

                <?php
                }
               else
                {?>
                    <a href='fieldvisitlist.php?type=othervisit&fv_id=<?php echo $c['fv_id']?>'name='basic' style='color:blue;' id="othervisit_<?php echo $c['fv_id']?>"><?php echo $c['fv_user'] ?></a> </div>


                <?php
                }
                ?>

                     </td>



    <td><?php echo $c['fv_purpose'] ?></td>
	<td><?php echo $c['fv_state'] ?></td>
	<td><?php echo $c['fv_district'] ?></td>
	<td><?php echo $c['fv_taluk'] ?></td>
    <td><?php echo $c['fv_hobli'] ?></td>
	<td><?php echo $c['fv_village'] ?></td>
     <td><?php
         $user=$c['fv_user'];

         $q=mysql_query("select * from fieldvisit where fv_user='$user' and del!=1 ");
         $count=mysql_num_rows($q);
         echo $count;
        ?></td>


 </tr>


<?php

   }

}?>


 </table>
  </div>
<?php
}
?>

<?php include 'footer.php';?>
</div>







