<?php
session_start();
$activetab="farmar";
include 'dbcon.php';
if($_REQUEST['ff'])
{

    $id=$_REQUEST['id'];
    $q=mysql_query("select * from farms where sno=$id");

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
exit;
}


include 'header.php';
?>
<!--- modal window --->
<!---<link type='text/css' href='css/basic.css' rel='stylesheet' media='screen' />-->
<link type='text/css' href='css/demo.css' rel='stylesheet' media='screen' />
<link type='text/css' href='css/basic.css' rel='stylesheet' media='screen' />
<link type='text/css' href='css/jquery-ui.css' rel='stylesheet' media='screen' />
<script type='text/javascript' src='js/jquerymodal.js'></script>
<script type='text/javascript' src='js/jquery.simplemodal.js'></script>
<script type='text/javascript' src='js/jquery.ui.core.js'></script>
<script type='text/javascript' src='js/jquery.ui.widget.js'></script>
<script type='text/javascript' src='js/jquery.ui.dialog.js'></script>
<script type='text/javascript' src='js/basic.js'></script>
<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
<!--- modal window --->
<style type="text/css">
    .simplemodal-overlay{z-index:50 !important;}
    .simplemodal-container{z-index:99 !important;}

    .ui-widget { margin: 2px 266px !important;
        position: fixed !important;

        font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
        font-size: 12px;

    }

    .ui-widget-content .ui-icon{background: url(../img/basic/x.png) no-repeat !important;
        background-position: -4px -3px !important;}


</style>
<script>
    $(document).ready(function (){
        $("[id^='del_']").click (function ()
        {
            id=this.id;
            alert(id);
            sno=id.substring(4);
            alert(sno);
            if(confirm('Are you absolutely sure you want to delete?'))
            {
                var dataString='sno='+sno;
                alert(dataString)
                $.ajax({
                    url:'delete.php?sno='+sno,
                    //data: dataString,
                    //type: 'POST',
                    beforeSend: function()
                    {
                        alert('in ajax '+url);
                    },
                    success:function(response)
                    {
                        alert(response);
                    }

                });



            }

        });


        $('#district').change(function(){

            var district=$('#district').val();
            var dataString='district=' + district;
            if(district!=""){
                window.location="farmerslist.php?d="+district;
            }else{
                window.location="farmerslist.php";
            }
        });

        $('#taluk').change(function(){
            var district=$('#district').val();
            var taluk=$('#taluk').val();

            var dataString='taluk=' + taluk;



            taluk=$.trim(taluk);

            if(taluk!=""){
                window.location="farmerslist.php?d="+district+"&t="+taluk;
            }else{
                window.location="farmerslist.php?d="+district;
            }
        });

        $('#hobli').change(function(){
            var district=$('#district').val();
            var taluk=$('#taluk').val();
            var hobli=$('#hobli').val();
            if(village!=""){
                window.location="farmerslist.php?d="+district+"&t="+taluk+"&h="+hobli;
            }else{
                window.location="farmerslist.php?d="+district+"&t="+taluk;
            }
        });

        $('#village').change(function(){
            var district=$('#district').val();
            var taluk=$('#taluk').val();
            var hobli=$('#hobli').val();
            var village=$('#village').val();
            if(village!=""){
                window.location="farmerslist.php?d="+district+"&t="+taluk+"&h="+hobli+"&v="+village;
            }else{
                window.location="farmerslist.php?d="+district+"&t="+taluk+"&h="+hobli;
            }
        });

        $("#download").on("click", function()
            {
                var  dataString="download=yes";
                $.ajax({
                    data: dataString,
                    type: "POST",
                    url: 'farmerslist.php'



                })
            }
        );





        $(".ff").dialog({
            autoOpen:false,
            height: 550,
            width: 750,
            modal: true,
            title:"Actually Used Fertilizers",
            position: {my: "center top", at:"center top", of: window },
            open: function(event, ui) { $(".ui-dialog-titlebar").show(); }
        });


        $(".cce").dialog({
            autoOpen:false,
            height: 550,
            width: 750,
            modal: true,
            title:"Crop Cutting Experiment",
            position: {my: "center top", at:"center top", of: window },
            open: function(event, ui) { $(".ui-dialog-titlebar").show(); }
        });



        $("[id^='ff_']").on("click", function()
        {
            id=this.id;
            id=id.substr(3)
            datastring="ff=true&id="+id
            $.ajax({
                url:"farmerslist.php",
                data:datastring,
                type:"post",

                success:function(responsedata)
                {

                    $(".ff").html(responsedata).dialog("open");
                }


            });

        });

        $("[id^='cc_']").on("click", function()
        {

            id=this.id;
            id=id.substr(3)
            datastring="cce=true&id="+id
            $.ajax({
                url:"farmerslist.php",
                data:datastring,
                type:"post",

                success:function(responsedata)
                {
                    $(".cce").html(responsedata).dialog("open");
                }


            });

        });



    });

</script>

<div class="midd_right1">
<div class="main_heads">
<div class="farmer_head">Farmers  List  </div>

<div class="btn_m">
    <?php

    $username='';
    if($_SESSION['user_id']!="admin" && $_SESSION['user_id']!="superadmin")
        $user=$_SESSION['user_id'];
    if(isset($_SESSION['superadmin']) || $_SESSION['user_id']=='admin')
    {

    if(isset($_GET['del']))
    {
        $sno=$_GET['sno'];
        //echo 'sno is'.$sno;
        //echo "update farmers set del=1 where sno='$sno'";
        mysql_query("update farmers set del=1 where sno='$sno'");
        mysql_query("update farms set del=1 where fid='$sno'") or die(mysql_error());
        mysql_query("update farmer_rec set del=1 where farmer_id='$sno'") or die(mysql_error());
    }



    ?>

    <button type="submit" name="submit" onclick="window.location='farmerform.php?user=<?php echo $user; ?>';" class="new">New</button>
    <br>
   <!-- <button type="button" class="new" id="download">Download</button>-->
    <a href="farmerdownload.php">Download</a>

</div>
<div class="form_main_2">
			 <span class="form_right_1">
			  <select name="district" id="district" class="txt_box1">
                  <option value="">--District--</option>
                  <?php if(isset($_GET['d']))
                  {
                      $d=$_GET['d'];
                  }
                  $query=mysql_query("select distinct(district) from farmers ");
                  while($result=mysql_fetch_array($query))
                  {
                      ?>
                      <option value="<?php echo $result['district'] ?>" <?php if($result['district']==$d){ echo "selected";} ?>><?php echo strtoupper($result['district']) ?></option>
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

               $q1=mysql_query("select * from farmers where district='$district' and del!=1 group by taluk order by taluk");

               if(isset($_GET['t'])){$t=$_GET['t'];

                   $t=trim($t);

                   echo 'taluk is'.$t;
               }

               while($r1=mysql_fetch_array($q1)){
                   ?><option value="<?php echo trim($r1['taluk'])?>" <?php if(trim($r1['taluk'])==$t){ echo "selected";} ?>><?php  echo $r1['taluk'] ?></option>";
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

                               $q2=mysql_query("select * from farmers where district='$district' and taluk='$t'and del!=1 group by hobli order by hobli");

                               if(isset($_GET['h']))
                               {$h=$_GET['h'];}
                               while($r2=mysql_fetch_array($q2)){
                                   ?><option value="<?php echo $r2['hobli']?>" <?php if($r2['hobli']==$h){ echo "selected";} ?>><?php  echo $r2['hobli'] ?></option>";
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
                if(isset($_GET['h'])){
                    $district=$_GET['d'];
                    $t=$_GET['t'];
                    $h=$_GET['h'];
                    $t=trim($t);

                    $q2=mysql_query("select * from farmers where district='$district' and taluk='$t' and hobli='$h' and del!=1 group by village order by village");
                    if(isset($_GET['v'])){$v=$_GET['v'];}
                    while($r2=mysql_fetch_array($q2)){
                        ?><option value="<?php echo $r2['village']?>" <?php if($r2['village']==$v){ echo "selected";} ?>><?php  echo $r2['village'] ?></option>";
                    <?php }
                }
                ?>
            </select>
        </span>
</div>
<div style='margin:10px 00px;'> <br></div>
<?php
}?>

<table border="0px" cellpadding="0" cellspacing="0" width="100%">
<tr>
    <?php
    if(isset($_SESSION['superadmin']))
    {
        ?>
        <th >&nbsp;  </th>
    <?
    }

    ?>
    <th >Farmer Name</th>
    <!-- <th>Last Name</th>
    <th>Father's Name</th>
    <th>Mobile</th>
    <th>Telephone</th> -->
    <th >District</th>
    <th >Taluk</th>
    <th >Hobli</th>
    <th >Village</th>

    <th >Farm</th>

    <th >Recommendation</th>
    <th >Map</th>
    <?php
    if(isset($_SESSION['superadmin']) || $_SESSION['user_id']=='admin')
    {

        $user=$_SESSION['user'];
        if($user!='award')
        {
            ?>
            <th >Delete</th>
        <?php
        }
    }
    ?>
</tr>
<?php
if(isset($_GET['page']))
{
    $page=$_GET['page'];
    $f =(($page-1)*100);

}
else
{
    $f=0;
}
if($_SESSION['user_id']!="admin" && $_SESSION['user_id']!="superadmin" )
{
    $user=$_SESSION['user_id'];
    $query = "select * from farmers where createdby='$user' and del!=1 order by fname asc";
}
else
{

    if($_GET['v'])
    {
        $d=$_GET['d'];
        $t=$_GET['t'];
        $h=$_GET['h'];
        $v=$_GET['v'];
        $query="select * from farmers where district='$d' and taluk='$t' and hobli='$h'and village='$v' and del!=1 order by fname asc ";
    }
    elseif($_GET['h'])
    {
        $d=$_GET['d'];
        $t=$_GET['t'];
        $h=$_GET['h'];
        $query="select * from farmers where district='$d' and taluk='$t' and hobli='$h' and del!=1 order by fname asc ";
    }
    elseif($_GET['t'])
    {
        $d=$_GET['d'];
        $t=$_GET['t'];
        $query="select * from farmers where district='$d' and taluk='$t' and del!=1 order by fname asc ";

    }
    elseif(isset($_GET['d']))
    {
        $d=$_GET['d'];
        $query="select * from farmers where district='$d' and del!=1 order by fname asc ";
    }



    else
    {
        $query="select * from farmers where del!=1 order by fname asc ";

    }




}
$result = mysql_query($query) or die(mysql_error());
$count = mysql_num_rows($result);


if($_SESSION['user_id']!="admin" && $_SESSION['user_id']!="superadmin" )
{
    $user=$_SESSION['user_id'];
    $q_d=mysql_query("select * from users where sno='$user' ");

    $r_d=mysql_fetch_array($q_d);
    $username=$r_d['userid'];
    $u_d=$r_d['district'];
    $u_t=$r_d['taluk'];
    $u_h=$r_d['hobli'];
    if($r_d['role']=='DISTRICT')
    {
        $q=mysql_query("select * from farmers where district='$u_d' and del!=1 order by fname asc LIMIT $f, 100");

    }
    elseif($r_d['role']=='TALUK')
    {
        $q=mysql_query("select * from farmers where taluk='$u_t' and  district='$u_d' and del!=1 order by fname asc LIMIT $f, 100");
    }
    elseif($r_d['role']=='HOBLI')
    {

        $q=mysql_query("select * from farmers where hobli='$u_h' and taluk ='$u_t' and district='$u_d' and del!=1 order by fname asc LIMIT $f, 100");
    }
    else
    {
        $q=mysql_query("select * from farmers where createdby='$user' and del!=1 order by fname asc LIMIT $f, 100");

    }
}
else
{
    if($_GET['v'])
    {
        $d=$_GET['d'];
        $t=$_GET['t'];
        $h=$_GET['h'];
        $v=$_GET['v'];
        $query="select * from farmers where district='$d' and taluk='$t' and hobli='$h'and village='$v' and del!=1 order by fname asc LIMIT $f, 100";
    }
    elseif($_GET['h'])
    {
        $d=$_GET['d'];
        $t=$_GET['t'];
        $h=$_GET['h'];
        $query="select * from farmers where district='$d' and taluk='$t' and hobli='$h' and del!=1 order by fname asc LIMIT $f, 100";
    }
    elseif($_GET['t'])
    {
        $d=$_GET['d'];
        $t=$_GET['t'];
        $query="select * from farmers where district='$d' and taluk='$t' and del!=1 order by fname asc LIMIT $f, 100";

    }
    elseif(isset($_GET['d']))
    {
        $d=$_GET['d'];
        $query="select * from farmers where district='$d' and del!=1 order by fname asc LIMIT $f, 100";
    }



    else
    {
        $query="select * from farmers where del!=1 order by fname asc LIMIT $f, 100";

    }
}
$n=1;
//echo "<br>".$query;
$q=mysql_query($query);
while($c=mysql_fetch_array($q))
{
$farmerid=$c['sno'];
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
<?php
if(isset($_SESSION['superadmin']))
{
    ?>
    <td><a href="farmeredit.php?sno=<?php echo $c['sno']?>&n=0" style='text-decoration:none; '>  Edit </a> </td>

<?php
}
?>
<td ><a href="farmerdetails.php?sno=<?php echo $c['sno']?>"  style='text-decoration:none; '><?php echo $c['fname']." ".$c['lname'] ?></a></td>
<!-- <td><?php //echo $c['lname'] ?></td>
<td><?php //echo $c['fatname'] ?></td>
<td><?php //echo $c['mobile'] ?></td>
<td><?php //echo $c['telephone'] ?></td> -->
<td><?php echo $c['district'] ?></td>
<td><?php echo $c['taluk'] ?></td>
<td><?php echo $c['hobli'] ?></td>
<td><?php

    $villagee=str_replace(","," ",$c['village']);

    echo $villagee ?></td>


<td align="left"><div class='basic-modal1'><a name='basic' style='color:blue;' onclick="modal_view('<?php echo $c['sno'] ?>')" class='basic'>View</a> </div>

    <div id="basic-modal-content1-<?php echo $c['sno']?>" class="modal1" style="display:none">
        <h3> <span style="color:#000;"><?php echo $c['fname']." ".$c['lname'] ?></span> </h3>
        <table border="0px" cellpadding="0" cellspacing="0" width="100%">
            <tr>
                <th>&nbsp;  </th>
                <th>Farm Name</th>
                <th>Total Farm Area</th>
                <th>Cultivation Area</th>
                <th>Crop Name</th>
                <th>Village</th>
                <th>Used Fertilizer</th>
                <th> Crop Cutting Experiment </th>

            </tr>
            <?php $fid=$c['sno'];
            $crop='';
            $cultivation_farm='';
            $result1['farm_name']='';
            $query1=mysql_query("select * from farms where fid='$fid' and del!=1");
            if(mysql_num_rows($query1)>0){

                while($result1=mysql_fetch_array($query1))
                {
                    $faid=$result1['sno'];
                    ?>
                    <tr>
                        <td></td><td><?php

                            $farm_name=$result1['farm_name'];
                            echo $result1['farm_name'] ?></td>
                        <td><?php echo $result1['total_farm_area'] ?></td>
                        <td><?php echo $result1['cultivation_area'] ?></td>
                        <td><?php
                            $crop=$result1['crop_name'];
                            echo $result1['crop_name'] ?></td>
                        <td><?php echo $result1['village'] ?></td>
                        <td><a  id="ff_<?php echo$faid ?>"  style='color:blue;'>view </a></td>
                        <td><a href="ccedetails.php?file=farmerlist&farmerid=<?php echo $farmerid?>&field_id=<?php echo$faid ?>" style='color:blue;'>view </a></td>
                    </tr>
                    <?php
                    $cultivation_farm[]=$result1['cultivation_area'];

                }


            } ?>
        </table>


    </div>

</td>

<td align="left" ><div class='basic-modal2'><a name='basic' style='color:blue;' onclick="modal_view1('<?php echo $c['sno'] ?>')" class='basic'>View</a> </div>

    <div id="basic-modal-content2-<?php echo $c['sno'] ?>" class="modal2" style="display:none ">

        <h3> <span style="color:#000;"><?php echo $c['fname']." ".$c['lname'] ?> </h3>

        <?php $fid=$c['sno'];
        $query2=mysql_query("select * from farmer_rec fr,farms f where fr.farmer_id='$fid' and fr.field_id=f.sno and fr.del!=1") or die(mysql_error());
        if(mysql_num_rows($query2)>0)
        {
            ?>
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


                while($result2=mysql_fetch_array($query2))
                {



                    $query_f=mysql_query("select cultivation_area from farms where fid='$fid' and sno=".$result2['field_id']." and  del!=1");

                    while($r_f=mysql_fetch_array($query_f))
                    {
                        $ca=$r_f['cultivation_area'];
                        $faid=$result2['sno'];
                        ?>
                        <tr>
                            <td></td><td><?php echo $result2['farm_name'] ?></td>
                            <td><?php echo $result2['crop_name'] ?></td>
                            <?php


                            ?>
                            <td><?php echo ($ca)*($result2['urea']/2.5) ?></td>
                            <td><?php echo ($ca)*($result2['dap']/2.5) ?></td>
                            <td><?php echo ($ca)*($result2['mop']/2.5) ?></td>
                            <td><?php echo ($ca)*($result2['gypsum']/2.5) ?></td>
                            <td><?php echo ($ca)*($result2['zinc_sulphate']/2.5) ?></td>
                            <td><?php echo ($ca)*($result2['borax']/2.5) ?></td>
                            <td><?php echo ($ca)*($result2['ssp']/2.5) ?></td>
                            <td><?php echo ($ca)*($result2['ssp_urea']/2.5) ?></td>
                            <td><?php echo ($ca)*($result2['ssp_gypsum']/2.5) ?></td>
                            <td><?php echo ($ca)*($result2['ssp_dap']/2.5) ?></td>

                            <td><?php



                                $ds=explode("-",$result2['date']);
                                $d=array_pop($ds);
                                $m=array_pop($ds);
                                $y=array_pop($ds);
                                $dt=$d."-".$m."-".$y;

                                echo $dt ?></td>
                        </tr>
                    <?php }}?></table> <?php
        }else{ echo "No Recommendations Found"; } ?>



    </div></td>

<td><a href="locationMap.php?sno=<?php echo $c['sno'] ?>"style='text-decoration:none; '>View</a></td>

<?php


if(isset($_SESSION['superadmin']) || $_SESSION['user_id']=='admin')
{

    if($user!='award')
    {
        ?>
        <!--<td><a href="" style="text-decoration:none;" id="del_<?php echo $c['sno']?>" >  Delete </a> </td>!-->

        <td><a href="farmerslist.php?sno=<?php echo $c['sno']?>&del=1" style='text-decoration:none;' onclick="return confirm('Are you absolutely sure you want to delete?')">  Delete </a> </td>


    <?php
    }

}
}
if($n<=17){
while($n<=17){
if($n%2==0){$cls="td_even";}else{
    $cls="td_odd";}$n++;
?>
    <tr class="<?php echo $cls ?>">
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>


        <td align="center"></td>
        <td align="center"></td>

    </tr>
<?php
}
}


?>
</tr>
</table>
<?php
$np=ceil($count/100);

if(isset($_GET['v']))
{
    $v=$_GET['v'];
    $h=$_GET['h'];
    $t=$_GET['t'];
    $dist=$_GET['d'];

}
elseif(isset($_GET['v']))
{
    $v=$_GET['v'];
    $h=$_GET['h'];
    $t=$_GET['t'];
    $dist=$_GET['d'];

}
elseif(isset($_GET['h']))
{

    $h=$_GET['h'];
    $t=$_GET['t'];
    $dist=$_GET['d'];

} elseif(isset($_GET['t']))
{

    $t=$_GET['t'];
    $dist=$_GET['d'];

} elseif(isset($_GET['d']))
{

    $dist=$_GET['d'];

}


if($np==0)
{
    $np=1;
}
$n1=0;
if(!isset($_GET['page']))
{
    $page=1;
}
if($page==1||$page==2||$page==3)
    $u=$page-1;
else
    $u=3;
//echo "nag".$u;
if($page!=1)
{

    if(isset($_SESSION['superadmin']) || $_SESSION['user_id']=='admin')
    {
        if($v)
        {?>
            <a href="farmerslist.php?page=<?php echo $page-1 ?>&d=<?php echo $dist;?>&t=<?php echo $t;?>&h=<?php echo $h;?>&v=<?php echo $v;?>" style="margin-left:350px">Previous</a>&nbsp;&nbsp;

        <?php
        }
        elseif($h)
        {?>
            <a href="farmerslist.php?page=<?php echo $page-1 ?>&d=<?php echo $dist;?>&t=<?php echo $t;?>&h=<?php echo $h;?>" style="margin-left:350px">Previous</a>&nbsp;&nbsp;

        <?php
        }
        elseif($t)
        {?>
            <a href="farmerslist.php?page=<?php echo $page-1 ?>&d=<?php echo $dist;?>&t=<?php echo $t;?>" style="margin-left:350px">Previous</a>&nbsp;&nbsp;

        <?php
        }
        elseif($dist)
        {?>
            <a href="farmerslist.php?page=<?php echo $page-1 ?>&d=<?php echo $dist;?>" style="margin-left:350px">Previous</a>&nbsp;&nbsp;

        <?php
        }
        else
        { ?>
            <a href="farmerslist.php?page=<?php echo $page-1 ?>" style="margin-left:350px">Previous</a>&nbsp;&nbsp;


        <?php

        }
        ?>

    <?php
    }
    else
    {?>
        <a href="farmerslist.php?page=<?php echo $page-1 ?>" style="margin-left:350px">Previous</a>&nbsp;&nbsp;

    <?php
    }
}
else
{ ?>

    <a href="farmerslist.php" style="margin-left:350px"></a>&nbsp;&nbsp;
<?
}
while($n1<7)
{
    $p=$page-$u;
    if($p<=$np)
    {
        if($u==0)
        {
            if(isset($_SESSION['superadmin']) || $_SESSION['user_id']=='admin')
            {
                if($v)
                {
                    ?>
                    <a href="farmerslist.php?page=<?php echo $p ?>&d=<?php echo $dist;?>&t=<?php echo $t;?>&h=<?php echo $h;?>&v=<?php echo $v;?>"><b><? echo $p; ?></b></a>&nbsp;
                <?php
                }
                elseif($h)
                {
                    ?>
                    <a href="farmerslist.php?page=<?php echo $p ?>&d=<?php echo $dist;?>&t=<?php echo $t;?>&h=<?php echo $h;?>"><b><? echo $p; ?></b></a>&nbsp;
                <?php
                }
                elseif($t)
                {?>
                    <a href="farmerslist.php?page=<?php echo $p ?>&d=<?php echo $dist;?>&t=<?php echo $t;?>&h=<?php echo $h;?>"><b><? echo $p; ?></b></a>&nbsp;
                <?php
                }

                elseif($dist)
                {?>
                    <a href="farmerslist.php?page=<?php echo $p ?>&d=<?php echo $dist;?>&t=<?php echo $t;?>&h=<?php echo $h;?>"><b><? echo $p; ?></b></a>&nbsp;
                <?php
                }
                else
                { ?>
                    <a href="farmerslist.php?page=<? echo $p; ?>"><b><? echo $p; ?></b></a>&nbsp;

                <?php
                }



            }
            else
            {
                ?>
                <a href="farmerslist.php?page=<? echo $p; ?>"><b><? echo $p; ?></b></a>&nbsp;
            <?php
            }

        }
        else
        {
            if(isset($_SESSION['superadmin']) || $_SESSION['user_id']=='admin')
            {
                if($v)
                {
                    ?>
                    <a href="farmerslist.php?page=<?php echo $page ?>&d=<?php echo $p;?>&t=<?php echo $t;?>&h=<?php echo $h;?>&v=<?php echo $v;?>"><? echo $p; ?></a>&nbsp;

                <?php
                }
                elseif($h)
                { ?>
                    <a href="farmerslist.php?page=<?php echo $page ?>&d=<?php echo $p;?>&t=<?php echo $t;?>&h=<?php echo $h;?>"><? echo $p; ?></a>&nbsp;
                <?php


                }
                elseif($t)
                {
                    ?>
                    <a href="farmerslist.php?page=<?php echo $p ?>&d=<?php echo $dist;?>&t=<?php echo $t;?>"><? echo $p; ?></a>&nbsp;

                <?php
                }
                elseif($dist)
                {
                    ?>
                    <a href="farmerslist.php?page=<?php echo $p ?>&d=<?php echo $dist;?>"><? echo $p; ?></a>&nbsp;

                <?php

                }
                else{
                    ?>
                    <a href="farmerslist.php?page=<? echo $p; ?>"><? echo $p; ?></a>&nbsp;

                <?php
                }
            }
            else
            {?>
                <a href="farmerslist.php?page=<? echo $p; ?>"><? echo $p; ?></a>&nbsp;

            <?php
            }

        } $u--;
    }
    ?>
    <? $n1++;}
if($page==$np)
{
    if(isset($_SESSION['superadmin']) || $_SESSION['user_id']=='admin')
    {
        if($v)
        {
            ?>
            <a href="farmerslist.php?page=<?php echo $page ?>&d=<?php echo $dist;?>&t=<?php echo $t;?>&h=<?php echo $h;?>&v=<?php echo $v;?>"></a>&nbsp;&nbsp;
        <?php

        }
        elseif($h)
        {
            ?>
            <a href="farmerslist.php?page=<?php echo $page ?>&d=<?php echo $dist;?>&t=<?php echo $t;?>&h=<?php echo $h;?>?>"></a>&nbsp;&nbsp;
        <?php

        }
        elseif($t)
        {
            ?>
            <a href="farmerslist.php?page=<?php echo $page ?>&d=<?php echo $dist;?>&t=<?php echo $t;?>"></a>&nbsp;&nbsp;
        <?php

        }
        elseif($dist)
        {
            ?>
            <a href="farmerslist.php?page=<?php echo $page ?>&d=<?php echo $dist;?>"></a>&nbsp;&nbsp;
        <?php

        }
        else{
            ?>
            <a href="farmerslist.php?page=<?php echo $page ?>"></a>&nbsp;&nbsp;
        <?php
        }

    }
    else
    {?>
        <a href="farmerslist.php?page=<?php echo $page ?>"></a>&nbsp;&nbsp;
    <?
    }
}
else
{

    if(isset($_SESSION['superadmin']) || $_SESSION['user_id']=='admin')
    {
        if($v)
        {?>
            <a href="farmerslist.php?page=<?php echo $page+1 ?>&d=<?php echo $dist;?>&t=<?php echo $t;?>&h=<?php echo $h;?>&v=<?php echo $v;?>">next</a>&nbsp;&nbsp;
        <?php
        }
        elseif($h)
        {?>
            <a href="farmerslist.php?page=<?php echo $page+1 ?>&d=<?php echo $dist;?>&t=<?php echo $t;?>&h=<?php echo $h;?>">next</a>&nbsp;&nbsp;
        <?php
        }
        elseif($t)
        {?>
            <a href="farmerslist.php?page=<?php echo $page+1 ?>&d=<?php echo $dist;?>&t=<?php echo $t;?>">next</a>&nbsp;&nbsp;

        <?php
        }
        elseif($dist)
        {
            ?>
            <a href="farmerslist.php?page=<?php echo $page+1 ?>&d=<?php echo $dist;?>">next</a>&nbsp;&nbsp;
        <?php
        }
        else
        {?>
            <a href="farmerslist.php?page=<?php echo $page+1 ?>">next</a>&nbsp;&nbsp;
        <?php
        }
    }
    else
    {
        ?>
        <a href="farmerslist.php?page=<?php echo $page+1 ?>">next</a>&nbsp;&nbsp;
    <?php
    }
}?>
</div>
</div>




<div class="ff"></div>
<div class="cce"></div>



<?php include 'footer.php';?>
