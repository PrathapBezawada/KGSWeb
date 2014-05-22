<?php
session_start();


if(!isset($_SESSION['user']))
{
    header("location:index.php");
}
//$activetab="farmar";



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
        $(document).ready(function()
        {
            $(".modal7").dialog({
                autoOpen:false,

                height: 550,
                width: 750,
                modal: true,
                title: "Actually Used Fertilizers",
                open: function(event, ui) { $(".ui-dialog-titlebar").show(); }
            });

            $('.basic7').click(function()
                {
                    id=this.id;
                    id=id.substr(6);
                    target=$(".modal10").attr("id");
                    //  alert("target id is"+target);
                    $("#basic-modal-content7-"+id).dialog("open");
                    //$(".modal7").dialog("open");

                }
            );


            $(".modal10").dialog({
                autoOpen:false,

                height: 550,
                width: 750,
                modal: true,
                title:"Crop Cutting Experiment",
                /*
                 close: function(ev, ui)
                 {

                 $(this).close();
                 },
                 */
                open: function(event, ui) { $(".ui-dialog-titlebar").show(); }
            });

            $('a.basic10').on("click",function()
            {

                id=this.id;
                id=id.substr(6);

                var lat = "";
                var lng = "";
                var village='';
                // $("#basic-modal-content10-"+id).dialog("open");
                target=$(".modal10").attr("id");
                var dataString='type=cce&fid='+ id;
                $.ajax({
                    data: dataString,
                    type: "POST",
                    url: 'getcce_ajax.php',
                    success:function(response){

                        var str = response;
                        var res = str.split("-");
                        lat = res[0];
                        lng = res[1];
                        village= res[2];

                    }

                } );
                initialize(lat,lng,id,village);
                $("#basic-modal-content10-"+id).dialog("open");
            });


            //window.onload = initialize();


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

            $("[id^='cc_']").on("click", function()
            {

                id=this.id;
                id=id.substr(3)

                datastring="cce=true&id="+id
                $.ajax({
                    url:"farmerresult.php",
                    data:datastring,
                    type:"post",

                    success:function(responsedata)
                    {
                        $(".cce").html(responsedata).dialog("open");
                    }


                });

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


        });

        function initialize(lat,lng,id,village) {
            //alert(lat);
            //alert(lng);
            var myLatlng = new google.maps.LatLng(lat,lng);

            var myOptions = {
                zoom: 15,
                center: myLatlng,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            }
            var map = new google.maps.Map(document.getElementById("map_canvas_"+id), myOptions);
           // alert("map is"+map);

            var marker = new google.maps.Marker({
                position: myLatlng,

                map: map,
                title: village
            });

        }


    </script>

<?php







$limit_count=100;
if(isset($_POST['submit']))
{
    $fname=$_POST['fname'];
    $lname=$_POST['lname'];
    $village=$_POST['village'];
    $user_district=$_POST['user_district'];
    $ssno=array();
    $a=0;
    $q=" where";
    if($fname!="")
    {
        $a++;
        if($a>1) $q.=" and";
        $fname=str_replace("*","%",$fname);
        $q.=" (fname like '%$fname%' OR  lname like '%$fname%' OR  concat(fname, ' ',lname) like '%$fname%')";

    }

    if($village!="")
    {
        $a++;
        if($a>1) $q.=" and";
        $village=str_replace("*","%",$village);
        $q.=" village like '%$village%'";
    }
    if($_SESSION['user_id']!="admin" && $_SESSION['user_id']!="superadmin")
    {
        $users=$_SESSION['user_id'];

    }

    if($a>=1)
    {

        if($users)
        {
            echo 'not an admin';
            $q_d=mysql_query("select * from users where sno='$user' ");
            $r_d=mysql_fetch_array($q_d);
            $u_d=$r_d['district'];
            $u_t=$r_d['taluk'];
            $u_h=$r_d['hobli'];

            if($r_d['role']=='DISTRICT')
            {
                $query=mysql_query("select * from farmers".$q ." and district='$u_d' order by sno LIMIT 0,$limit_count");
                //echo "select * from farmers".$q ." and district='$u_d' order by sno LIMIT 0,$limit_count";
            }
            elseif($r_d['role']=='TALUK')
            {
                $query=mysql_query("select * from farmers".$q ." and taluk='$u_t' and district='$u_d' order by sno LIMIT 0,$limit_count");

            }
            elseif($r_d['role']=='HOBLI')
            {
                $query=mysql_query("select * from farmers".$q ." and hobli='$u_h' and taluk='$u_t' order by sno LIMIT 0,$limit_count");

            }

        }
        else
        {
            
            $query=mysql_query("select * from farmers".$q." and del !=1 order by sno LIMIT 0,400");


        }


    }
    else
    {
        if($_SESSION['user_id']!="admin" && $_SESSION['user_id']!="superadmin")
        {

            $user=$_SESSION['user_id'];
            $q_d=mysql_query("select * from users where sno='$user' ");
            $r_d=mysql_fetch_array($q_d);
            $u_d=$r_d['district'];
            $u_t=$r_d['taluk'];
            $u_h=$r_d['hobli'];

            if($r_d['role']=='DISTRICT')
            {
                $query=mysql_query("select * from farmers where district='$u_d' and del!=1  order by sno LIMIT 0,$limit_count");
            }
            elseif($r_d['role']=='TALUK')
            {
                $query=mysql_query("select * from farmers where taluk='$u_t' and district='$u_d' and del!=1 order by sno desc LIMIT 0, $limit_count");
            }
            elseif($r_d['role']=='HOBLI')
            {
                $query=mysql_query("select * from farmers where hobli='$u_h' and taluk ='$u_t' and del!=1 order by sno desc LIMIT 0, $limit_count");
            }

            else
            {
                $query=mysql_query("select * from farmers where createdby='$user' and del!=1 order by sno LIMIT 0,$limit_count");
            }
        }
        else
        {
            $query=mysql_query("select * from farmers where del!=1 order by sno LIMIT 0,$limit_count");

        }

    }
    if($a>=1)
    {
        if($users)
        {
            $q_d=mysql_query("select * from users where sno='$user' ");
            $r_d=mysql_fetch_array($q_d);
            $u_d=$r_d['district'];
            $u_t=$r_d['taluk'];
            $u_h=$r_d['hobli'];

            if($r_d['role']=='DISTRICT')
            {
                $query11=mysql_query("select * from farmers".$q ." and district='$u_d' order by sno ");
                //echo "<br>select * from farmers".$q ." and district='$u_d' order by sno ";
            }
            elseif($r_d['role']=='TALUK')
            {
                $query11=mysql_query("select * from farmers".$q ." and taluk='$u_t' and district='$u_d' order by sno ");

            }
            elseif($r_d['role']=='HOBLI')
            {
                $query11=mysql_query("select * from farmers".$q ." and hobli='$u_h' and taluk='$u_t' order by sno ");

            }

        }
        else
        {
            $query11=mysql_query("select * from farmers".$q." and del!=1 order by sno ");

        }
    }
    else
    {
        if($_SESSION['user_id']!="admin" && $_SESSION['user_id']!="superadmin")
        {

            $user=$_SESSION['user_id'];
            $q_d=mysql_query("select * from users where sno='$user' ");
            $r_d=mysql_fetch_array($q_d);
            $u_d=$r_d['district'];
            $u_t=$r_d['taluk'];
            $u_h=$r_d['hobli'];

            if($r_d['role']=='DISTRICT')
            {

                $query11=mysql_query("select * from farmers where district='$u_d' and del!=1  order by sno ");
            }
            elseif($r_d['role']=='TALUK')
            {
                $query11=mysql_query("select * from farmers where taluk='$u_t' and district='$u_d' and del!=1 order by sno desc ");
            }
            elseif($r_d['role']=='HOBLI')
            {
                $query11=mysql_query("select * from farmers where hobli='$u_h' and taluk='$u_t' and del!=1 order by sno desc ");
            }
            else
            {
                $query11=mysql_query("select * from farmers where createdby='$user' and del!=1 order by sno ");
            }
        }
        else
        {
            $query11=mysql_query("select * from farmers where del!=1 order by sno ");


        }

    }


if(mysql_num_rows($query)>0)
{
    unset($_SESSION['farmer_result']);
    while($result11=mysql_fetch_array($query11))
    {
        array_push($ssno,$result11['sno']);
    }
    $count=count($ssno);
    //echo "count is".$count;

    if($count>=17)
    {
        $clsname="midd_right1";
    }
    else
    {
        $clsname="midd_right2";
    }
    ?>

    <div class="<?php echo $clsname ?>">
    <div class="main_heads">

    <div class="farmer_head">Search Results for Farmers  </div>

    <div class="btn_m">
    </div>
    <table border="0px" cellpadding="0" cellspacing="0" width="$limit_count0%">
    <tr>
        <?php
        if(isset($_SESSION['superadmin']))
        {
            ?>
            <th>&nbsp;  </th>
        <?php
        }
        ?>
        <th>Farmer Name</th>
        <!-- <th>Last Name</th>
        <th>Father's Name</th>
        <th>Mobile</th>
        <th>Telephone</th> -->
        <th>District</th>

        <th>Taluk</th>
        <th>Hobli</th>
        <th>Village</th>

        <th>Field</th>
        <th>Recommendation</th>
        <th>Map</th>
        <?php
        if(isset($_SESSION['superadmin']) || $_SESSION['user_id']=='admin')
        {
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


    while($result=mysql_fetch_array($query))
    {
    if($n%2==0)
    {
        $cls="td_even";
    }
    else
    {
        $cls="td_odd";
    }
    $n++;//array_push($ssno,$result['sno']);
    $fid=$result['sno'];



    ?>
    <tr class="<?php echo $cls ?>">
    <?php
    if(isset($_SESSION['superadmin']))
    {
        ?>
        <td><a href="farmeredit.php?sno=<?php echo $result['sno']?>&m=0" style='text-decoration:none; '>  Edit </a> </td>
    <?php
    }
    ?>
    <td><a href="farmerdetails.php?sno=<?php echo $result['sno']?>&m=0" style='text-decoration:none; '><?php echo $result['fname']." ".$result['lname']; ?></a></td>
    <td><?php echo $result['district'] ?></td>
    <td><?php echo $result['taluk'] ?></td>
    <td><?php echo $result['hobli'] ?></td>
    <td><?php echo $result['village'] ?></td>

    <td align="left"><div class='basic-modal4'><a name='basic' style='color:blue;' onclick="modal_view4('<?php echo $result['sno'] ?>')" class='basic'>View</a> </div>

    <div id="basic-modal-content4-<?php echo $result['sno']?>" class="modal4" style="display:none">
        <h3> <span style="color:#000;"><?php echo $result['fname']." ".$result['lname'] ?></span> </h3>
        <table border="0px" cellpadding="0" cellspacing="0" width="$limit_count0%">
            <tr>
                <th>Farm Name</th>
                <th>Total Farm Area</th>
                <th>Cultivation Area</th>
                <th>Crop Name</th>
                <th>Village</th>
                <th>Used Fertilizer</th>
                <th>Crop Cutting Experiment</th>
            </tr>
            <?php //$fid=$c['sno'];
            $crop='';
            $cultivation_farm='';
            $arr=array();
            $query1=mysql_query("select * from farms where fid='$fid' and del!=1");

            if(mysql_num_rows($query1)>0)
            {
                //echo mysql_num_rows($query1);

                while($result1=mysql_fetch_array($query1))
                {


                    $faid=$result1['sno'];
                    array_push($arr,$faid);

                    ?>
                    <tr>
                        <td><?php echo $result1['farm_name'] ?></td>
                        <td><?php echo $result1['total_farm_area'] ?></td>
                        <td><?php echo $result1['cultivation_area'] ?></td>
                        <td><?php
                            $crop=$result1['crop_name'];
                            echo $result1['crop_name'] ?></td>
                        <td><?php echo $result1['village'] ?></td>
                        <td><a  id="ff_<?php echo$faid ?>"  style='color:blue;'>view </a></td>
                        <td><a href="ccedetails.php?file=farmresult&farmerid=<?php echo $fid?>&field_id=<?php echo$faid ?>" style='color:blue;'>view </a></td>
                        </tr>

                    <?php
                    $cultivation_farm=$result1['cultivation_area'];
                }
            } ?>

        </table>
    </div>


    <!--<td>View</td>-->

    <td align="left" ><div class='basic-modal5'><a name='basic' style='color:blue;' onclick="modal_view5('<?php echo $result['sno'] ?>')" class='basic'>View</a> </div>
        <div id="basic-modal-content5-<?php echo $result['sno'] ?>" class="modal5" style="display:none ">
            <h3> <span style="color:#000;"><?php echo $result['fname']." ".$result['lname'] ?> </h3>

            <?php //$fid=$c['sno'];
            $query2=mysql_query("select * from farmer_rec fr,farms f where fr.farmer_id='$fid' and fr.field_id=f.sno and fr.del!=1") or die(mysql_error());
            if(mysql_num_rows($query2)>0)
            {
                ?>
                <table border="0px" cellpadding="0" cellspacing="0" width="$limit_count0%">
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
                    $query_f=mysql_query("select cultivation_area from farms where fid='$fid' and del!=1");

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
                        <?php
                        }
                    } ?></table> <?php
            }
            else
            {
                echo "No Recommendations Found";
            } ?>


        </div></td>

    <td><a href="locationMap.php?sno=<?php echo $result['sno'] ?>"style='text-decoration:none; '>View</a></td>
    <?php


    if(isset($_SESSION['superadmin']) || $_SESSION['user_id']=='admin')
    {
        if($user!='award')
        {
            ?>
            <!--<td><a href="" style="text-decoration:none;" id="del_<?php echo $c['sno']?>" >  Delete </a> </td>!-->

            <td><a href="farmerresult.php?sno=<?php echo $result['sno']?>&del=1" style='text-decoration:none;' onclick="return confirm('Are you absolutely sure you want to delete?')">  Delete </a> </td>


        <?php
        }
    }
    }?>
    </tr>
    <?php

    }
    $_SESSION['farmer_result']=$ssno;
    ?>


    </table>
    <?php
    $np=ceil($count/$limit_count);
    //echo "num pages".$np;

    if($count<=$limit_count)
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
        ?>
        <a href="farmerresult.php?page=<?php echo $page-1 ?>" style="margin-left:350px">Previous</a>&nbsp;&nbsp;
    <?
    }
    else
    {
        ?>
        <a href="farmerresult.php?page=<?php echo $page ?>" style="margin-left:350px"></a>&nbsp;&nbsp;
    <?
    }

    while($n1<7)
    {
        $p=$page-$u;
        if($p<=$np)
        {
            if($u==0)
            {
                if($count<=$limit_count)
                {
                }
                else
                {

                    if($p==$page || $page=='')
                    {
                        ?>
                        <span><? echo $p; ?></span>&nbsp;
                    <?
                    }
                    else
                    {
                        ?>
                        <a href="farmerresult.php?page=<? echo $p; ?>"><? echo $p; ?></a>&nbsp;
                    <?
                    }}

            }
            else
            {
                ?>
                <a href="farmerresult.php?page=<? echo $p; ?>"><? echo $p; ?></a>&nbsp;
            <?
            } $u--;
        }
        ?>
        <? $n1++;
    }
    if($page==$np )
    {
        ?>
        <a href="farmerresult.php?page=<?php echo $page ?>"></a>&nbsp;&nbsp;

    <?
    }

    else
    {
        ?>
        <a href="farmerresult.php?page=<?php echo $page+1 ?>">next</a>&nbsp;&nbsp;
    <?
    } ?>
    <?php
    }
    else
    {
        echo "<span class='no_res_txt'>No results found </span>";
    }

    }
    else
    {
    //ini_set('max_execution_time', 500);
    if(isset($_GET['page']))
    {
        $page=$_GET['page'];
        $f =(($page-1)*$limit_count);
    }
    else
    {
        $f=0;
    }
    $frs=array();
    if(isset($_SESSION['farmer_result']))
    {
        $frs=$_SESSION['farmer_result'];
        $count=count($frs);
    }
    if($count>=17)
    {
        $clsname="midd_right1";
    }
    else
    {
        $clsname="midd_right2";
    }
    ?>
    <div class="<?php echo $clsname ?>">
    <div class="main_heads">
    <div class="farmer_head">Search Results for Farmers  </div>
    <div class="btn_m">
    </div>
    <table border="0px" cellpadding="0" cellspacing="0" width="$limit_count0%">
    <tr>
        <th>&nbsp;  </th>
        <th>Farmer Name</th>
        <!-- <th>Last Name</th>
        <th>Father's Name</th>
        <th>Mobile</th>
        <th>Telephone</th> -->
        <th>District</th>

        <th>Taluk</th>
        <th>Hobli</th>
        <th>Village</th>

        <th>Field</th>
        <th>Recommendation</th>
        <th>Map</th>
    </tr>
    <?php $num=0;$m1=0;$i=1;
    foreach($_SESSION['farmer_result'] as $sno)
    {



        if($num>=$f && $m1<=$limit_count)
        {


            $m1=$m1+1;

            $query=mysql_query("select * from farmers where sno='$sno'");
            $next_rec=mysql_num_rows($query);
            $result=mysql_fetch_array($query);



            if($i%2==0)
            {
                $cls="td_even";
            }
            else
            { $cls="td_odd";}$i++;
            $fid=$result['sno'];
            ?>
            <tr class="<?php echo $cls ?>">
                <?php
                if(isset($_SESSION['superadmin']))
                {
                    ?>
                    <td><a href="farmeredit.php?sno=<?php echo $result['sno']?>&m=0">  Edit </a> </td>
                <?php
                }
                ?>
                <td><a href="farmerdetails.php?sno=<?php echo $result['sno']?>&m=0"><?php echo $result['fname']." ".$result['lname']; ?></a></td>
                <!-- <td><?php //echo $result['lname'] ?></td>
				<td><?php //echo $result['fatname'] ?></td>
				<td><?php //echo $result['mobile'] ?></td>
				<td><?php //echo $result['telephone'] ?></td> -->
                <td><?php echo $result['district'] ?></td>
                <td><?php echo $result['taluk'] ?></td>
                <td><?php echo $result['hobli'] ?></td>
                <td><?php echo $result['village'] ?></td>
                <!--<td>View</td>-->
                <td align="left"><div class='basic-modal4'><a name='basic' style='color:blue;' onclick="modal_view4('<?php echo $result['sno'] ?>')" class='basic'>View</a> </div>
                    <div id="basic-modal-content4-<?php echo $result['sno']?>" class="modal4" style="display:none">
                        <h3> <span style="color:#000;"><?php echo $result['fname']." ".$result['lname'] ?></span> </h3>
                        <table border="0px" cellpadding="0" cellspacing="0" width="$limit_count0%">
                            <tr>
                                <th>&nbsp;  </th>
                                <th>Farm Name</th>
                                <th>Total Farm Area</th>
                                <th>Cultivation Area</th>
                                <th>Crop Name</th>
                                <th>Village</th>
                            </tr>
                            <?php //$fid=$c['sno'];
                            $cultivation_farm='';
                            $crop='';
                            $query1=mysql_query("select * from farms where fid='$fid' and del!=1");
                            if(mysql_num_rows($query1)>0)
                            {
                                while($result1=mysql_fetch_array($query1))
                                {
                                    $faid=$result1['sno'];
                                    ?>
                                    <tr>
                                        <td></td><td><?php echo $result1['farm_name'] ?></td>
                                        <td><?php echo $result1['total_farm_area'] ?></td>
                                        <td><?php echo $result1['cultivation_area'] ?></td>
                                        <td><?php $crop=$result1['crop_name'];
                                            echo $result1['crop_name'] ?></td>
                                        <td><?php echo $result1['village'] ?></td>

                                    </tr>

                                    <?php
                                    $cultivation_farm=$result1['cultivation_area'];
                                }
                            } ?>
                        </table>


                    </div>

                </td>






                <!--<td>View</td>-->



                <td align="left" ><div class='basic-modal5'><a name='basic' style='color:blue;' onclick="modal_view5('<?php echo $result['sno'] ?>')" class='basic'>View</a> </div>

                    <div id="basic-modal-content5-<?php echo $result['sno'] ?>" class="modal5" style="display:none ">

                        <h3> <span style="color:#000;"><?php echo $result['fname']." ".$result['lname'] ?> </h3>

                        <?php //$fid=$c['sno'];
                        $query2=mysql_query("select * from farmer_rec fr,farms f where fr.farmer_id='$fid' and fr.field_id=f.sno and fr.del!=1") or die(mysql_error());
                        if(mysql_num_rows($query2)>0)
                        {
                            ?>
                            <table border="0px" cellpadding="0" cellspacing="0" width="$limit_count0%">
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
                                $query_f=mysql_query("select cultivation_area from farms where fid='$fid' and del!=1");

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
                                    <?php
                                    }
                                } ?></table> <?php
                        }
                        else
                        {
                            echo "No Recommendations Found";
                        } ?>
                    </div></td>
                <td><a href="locationMap.php?sno=<?php echo $result['sno'] ?>"style='text-decoration:none; '>View</a></td>
                <?php


                if(isset($_SESSION['superadmin']) || $_SESSION['user_id']=='admin')
                {
                    ?>
                    <!--<td><a href="" style="text-decoration:none;" id="del_<?php echo $c['sno']?>" >  Delete </a> </td>!-->

                    <td><a href="farmerresult.php?sno=<?php echo $result['sno']?>&del=1" style='text-decoration:none;' onclick="return confirm('Are you absolutely sure you want to delete?')">  Delete </a> </td>


                <?php
                }

                ?>
            </tr>
            <?php
            //exit;
        }

        $num++;

    }

    ?></table>
    <?php
    $np=ceil($count/$limit_count);
    //echo "num pages".$np;
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
    { ?>
        <a href="farmerresult.php?page=<?php echo $page-1 ?>" style="margin-left:350px">Previous</a>&nbsp;&nbsp;
    <?
    }
    else
    { ?>
        <a href="farmerresult.php?page=<?php echo $page ?>" style="margin-left:350px"></a>&nbsp;&nbsp;
    <?
    }

    while($n1<7)
    { $p=$page-$u;

        if($p<=$np)
        {
            if($u==0)
            {
                if($p==$page || $page=='')
                {
                    ?>
                    <span><? echo $p; ?></span>&nbsp;
                <?
                }
                else
                {

                    ?>
                    <a href="farmerresult.php?page=<? echo $p; ?>"><? echo $p; ?></a>&nbsp;
                <?
                }
            }
            else
            {

                if($p==$page)
                {
                    ?>
                    <span><? echo $p; ?></span>&nbsp;
                <?
                }
                else
                {
                    ?>

                    <a href="farmerresult.php?page=<? echo $p; ?>"><? echo $p; ?></a>&nbsp;
                <?
                }
            } $u--;
        }
        ?>
        <? $n1++;
    }


    if($page==$np)
    {
        ?>
    <?
    }

    else
    {
        ?>
        <a href="farmerresult.php?page=<?php echo $page+1 ?>">next</a>&nbsp;&nbsp;
    <?
    } ?>


    <?php
    }
    ?>



    </div>
    </div>
    <div class="ff"></div>
    <div class="cce"></div>
<?php include 'footer.php';?>