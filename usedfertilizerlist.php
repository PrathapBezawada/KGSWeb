<?php
ini_set('max_input_time', 900);
ini_set('max_execution_time', 900);

session_start();
$activetab="report";
include 'header.php';
/*$username=$_POST['username'];
$pass=$_POST['password'];
if($username=="nunc" && $pass=="nunc"){
	$_SESSION['user']='nunc';
}else{
	$_SESSION['error']='nunc';
}
if(!isset($_SESSION['user']))
{header("location:index.php");}	*/

?>

    <style> table{margin:2px 0px 0px 20px;}
        .table_th
        {
            color:yellow;
        }

    </style>

    <script type="text/javascript">
        $(document).ready(function(){

            $('#district').change(function(){

                var district=$('#district').val();
                var dataString='district=' + district;
                if(district!=""){
                    window.location="usedfertilizerlist.php?d="+district;
                }else{
                    window.location="usedfertilizerlist.php";
                }/*$.ajax({
                 data: dataString,
                 type: "POST",
                 url: 'recinvresponse.php',
                 success:function(response){

                 $('#taluk').html(response);
                 }


                 }); */
            });

            $('#taluk').change(function(){
                var district=$('#district').val();
                var taluk=$('#taluk').val();

                var dataString='taluk=' + taluk;

                /*$.ajax({
                 data: dataString,
                 type: "POST",
                 url: 'recinvresponse.php',
                 success:function(response){
                 $('#croptype').html(response);
                 }


                 }); */

                taluk=$.trim(taluk);

                if(taluk!=""){
                    window.location="usedfertilizerlist.php?d="+district+"&t="+taluk;
                }else{
                    window.location="usedfertilizerlist.php?d="+district;
                }
            });


            $('#croptype').change(function(){
                var district=$('#district').val();
                var taluk=$('#taluk').val();
                var croptype=$('#croptype').val();

                var dataString='taluk=' + taluk +'&district=' + district + '&croptype=' + croptype;

                /*$.ajax({
                 data: dataString,
                 type: "POST",
                 url: 'recinvresponse.php',
                 success:function(response){
                 $('#cropdetails').html(response);
                 }


                 }); */
                if(croptype!=""){

                    window.location="usedfertilizerlist.php?d="+district+"&t="+taluk+"&c="+croptype;
                }else{
                    window.location="usedfertilizerlist.php?d="+district+"&t="+taluk;
                }
            });




        });
    </script>
<?php
if(isset($_GET['t']))
{
    $clsname="midd_right1";
}
else
{$clsname="midd_right1";}?>
    <div class="<?php echo $clsname?>">
    <div class="main_heads">

    <div class="rec_drop">
        <div class="sels" style="float:left">
            <div class="form_main_2">


			 <span class="form_right_1"> <select name="district" id="district" class="txt_box1">
                     <option value="">--District--</option>
                     <?php if(isset($_GET['d']))
                     {
                         $d=$_GET['d'];
                     } ?>
                     <?php

                     if($_SESSION['user_id']!="admin" && $_SESSION['user_id']!="superadmin")
                     {
                         $user=$_SESSION['user_id'];
                         $query=mysql_query("select district from farms order by district");
                         while($result=mysql_fetch_array($query))
                         {

                             ?>
                             <option value="<?php echo $result['district'] ?>"
                                 <?php if($result['district']==$d){
                                 echo "selected";
                             } ?>>
                                 <?php echo strtoupper($result['district']) ?></option>

                         <?php
                         }
                     }
                     else
                     {
                         $query=mysql_query("select distinct(district) from farms where district!= '' order by district ");

                         while($result=mysql_fetch_array($query)){

                             ?>
                             <option value="<?php echo $result['district'] ?>" <?php if($result['district']==$d){
                                 echo "selected";
                             } ?>><?php echo strtoupper($result['district']) ?></option>

                         <?php
                         }
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

                   $q1=mysql_query("select * from farms where district='$district' group by taluk order by taluk");

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
   <select name="croptype" id="croptype" class="txt_box1">
       <option value="">--Crop Type--</option>
       <?php if(isset($_GET['t']))
       {

           $district=$_GET['d'];
           $t=$_GET['t'];
           $t=trim($t);


           $q2=mysql_query("select * from farms where district='$district' and taluk='$t' group by crop_name order by crop_name asc");
           if(isset($_GET['c'])){$c=$_GET['c'];}
           while($r2=mysql_fetch_array($q2)){

               ?><option value="<?php echo $r2['crop_name']?>" <?php if($r2['crop_name']==$c){ echo "selected";} ?>><?php  echo $r2['crop_name'] ?></option>";
           <?php }
       }
       ?>
   </select>

  </span>
            </div>
        </div>


    </div>

    <div id="cropdetails" style="float:left;">

    <?php
    if(isset($_GET['c']))
    {

        $d=$_GET['d'];
        $t=$_GET['t'];
        $t=trim($t);
        $c=$_GET['c'];

        $q=mysql_query("select * from farms where district='$d' and taluk='$t' and crop_name='$c'  and  del!=1");


        ?>

        <table width="100%"  class="responsive">
            <tr>


                <th>Year</th>
                <th>season</th>
                <th>crop Name</th>
                <th>Cultivation Area</th>
                <th>Urea</th>
                <th>Dap</th>
                <th>Potash</th>
                <th>Complex</th>
                <th>Zinc Sulphate</th>
                <th>Borax</th>
                <th>Gypsum</th>
            </tr>
                          <?php $i=1;
            while($r=mysql_fetch_array($q))
            {
                if($i%2==0){$td="td_even";}else{$td="td_odd";}$i++;





                echo "
		<tr class='".$td."'>
			<td>".$r['year']."</td>
				<td>".$r['season']."</td>
		<td>".$r['crop_name']."</td>
					<td align='center'>".$r['cultivation_area']."</td>
	         <td align='center'>".$r['field_urea']."</td>
				<td align='center'>".$r['field_dap']."</td>
				<td align='center'>".$r['field_potash']."</td>
				<td align='center'>".$r['field_complex']."</td>
				<td align='center'>".$r['field_zinc']."</td>
				<td align='center'>".$r['field_borax']."</td>
				<td align='center'>".$r['field_gypsum']."</td>

				</tr>";
            } ?>
        </table> <?php
    }
    elseif(isset($_GET['t']))
    {

        $d=$_GET['d'];
        $t=$_GET['t'];
        $t=trim($t);
//$q3=mysql_query("select * from rec group by district");
               ?>
        <table width="90%" style="width:95%;"  class="responsive"><tr>
        <th>Year</th>
        <th>season</th>
        <th>crop Name</th>
        <th>Cultivation Area</th>
        <th>Urea</th>
        <th>Dap</th>
        <th>Potash</th>
        <th>Complex</th>
        <th>Zinc Sulphate</th>
        <th>Borax</th>
        <th>Gypsum</th>
      </tr>
        <?php

        $q2=mysql_query("select * from farms where district='$d' and taluk='$t' and del!=1 order by crop_name asc");
        $cc=0;$i=1;
        while($r2=mysql_fetch_array($q2))
        {
            $cc++;
            if($i%2==0)
            {
                $td="td_even";
            }
            else
            {
                $td="td_odd";
            }$i++;


            echo "
  <tr class='".$td."'>
		<td>".$r2['year']."</td>
				<td>".$r2['season']."</td>
				<td>".$r2['crop_name']."</td>
							<td align='center'>".$r['cultivation_area']."</td>
	<td align='center'>".$r2['field_urea']."</td>
				<td align='center'>".$r2['field_dap']."</td>
				<td align='center'>".$r2['field_potash']."</td>
				<td align='center'>".$r2['field_complex']."</td>
				<td align='center'>".$r2['field_zinc']."</td>
				<td align='center'>".$r2['field_borax']."</td>
				<td align='center'>".$r2['field_gypsum']."</td>
		</tr>";
        }

        ?>
        </table><?php

    }
    elseif(isset($_GET['d']))
    {
        $d=$_GET['d'];

//$q3=mysql_query("select * from rec group by district");


        ?>
        <table width="90%" style="width:95%;"  class="responsive"><tr>


        <th>Year</th>
        <th>Season</th>
        <th>crop Name</th>
        <th>Cultivation Area</th>
        <th>Urea</th>
        <th>Dap</th>
        <th>Potash</th>
        <th>Complex</th>
        <th>Zinc Sulphate</th>
        <th>Borax</th>
        <th>Gypsum</th>
        </tr>
        <?php $dc=0;

        $i=1;

            $q2=mysql_query("select * from farms where district='$d' and del!=1 order by crop_name asc");
    
             $cc=0;
            while($r2=mysql_fetch_array($q2)){
                $cc++;if($i%2==0){$td="td_even";}else{$td="td_odd";}$i++;




                echo "
<tr class='".$td."'>

		<td>".$r2['year']."</td>
				<td>".$r2['season']."</td>
				<td>".$r2['crop_name']."</td>
				<td align='center'>".$r2['cultivation_area']."</td>
				<td align='center'>".$r2['field_urea']."</td>
				<td align='center'>".$r2['field_dap']."</td>
				<td align='center'>".$r2['field_potash']."</td>
				<td align='center'>".$r2['field_complex']."</td>
				<td align='center'>".$r2['field_zinc']."</td>
				<td align='center'>".$r2['field_borax']."</td>
				<td align='center'>".$r2['field_gypsum']."</td>
		</tr>";
            }


        ?>
        </table><?php

    }
    else{

        /*
        if($_SESSION['user_id']!="admin" && $_SESSION['user_id']!="superadmin"){
            $user=$_SESSION['user_id'];
            //$q=mysql_query("select district from users where sno='$user'");
        }else{
            $q=mysql_query("select district from farms group by district LIMIT 1,100");
        }

  */
        $q=mysql_query("select * from farms where del!=1");


//$q3=mysql_query("select * from rec group by district");


        ?>
        <table width="90%" style="width:95%;"  class="responsive"><tr>


        <th>Year</th>
        <th>Season</th>
        <th>Crop Name</th>
        <th>Cultivation Area</th>
        <th>Urea</th>
        <th>Dap</th>
        <th>Potash</th>
        <th>Complex</th>
        <th>Zinc Sulphate</th>
        <th>Borax</th>
        <th>Gypsum</th>
        </tr>
        <?php $dc=0;$i=1;

        while($r=mysql_fetch_array($q))
        {
             $cc++;if($i%2==0){$td="td_even";
           }else{$td="td_odd";}$i++;



            $r['year']=($r['year'])?$r['year']:'';

                    echo "
<tr class='".$td."'>
		<td>".$r['year']."</td>
				<td>".$r['season']."</td>
				<td>".$r['crop_name']."</td>
				<td align='center'>".$r['cultivation_area']."</td>
	<td align='center'>".$r['field_urea']."</td>
				<td align='center'>".$r['field_dap']."</td>
				<td align='center'>".$r['field_potash']."</td>
				<td align='center'>".$r['field_complex']."</td>
				<td align='center'>".$r['field_zinc']."</td>
				<td align='center'>".$r['field_borax']."</td>
				<td align='center'>".$r['field_gypsum']."</td>
				</tr>";
                }


        ?>
        </table><?php
    }
    ?>

    </div>


    </div> </div>
<?php include 'footer.php';?>