<?php
session_start();

if(!isset($_SESSION['user']))
{
	header("location:index.php");
}
	//$activetab="farmar";
	 include 'header.php'; ?>
	<div class="midd_right1">
	 <div class="main_heads">
		<div class="farmer_head">Search Results for Users  </div>

		<div class="btn_m">
		</div>
<?php
if(isset($_POST['submit']))
{
	$fname=$_POST['fname'];
	$lname=$_POST['lname'];
	$userid=$_POST['userid'];
	if($userid!="")
	{

		$query=mysql_query("select * from users where userid='$userid'");
	}
	else
	{
		$a=0;
		$q=" where";
		if($fname!="")
		{

			$a++;

			if($a>1) $q.=" and";

			$q.=" fname like '$fname%'";

		}
		if($lname!="")
		{

			$a++;
			if($a>1) $q.=" and";

			$q.=" lname like '$lname%' ";

		}

		$q.=" and del!=1";
		if($a>=1)
		{
			$query=mysql_query("select * from users".$q);

		}
		else
		{
			$query=mysql_query("select * from users where del!=1");
		}
	}
	if(mysql_num_rows($query)>0)
	{
		?>
 		<table border="0px" cellpadding="0" cellspacing="0" width="100%">
   <tr>
   <th>&nbsp;  </th>
 		<th> First Name  </th>
		<th> Last Name</th>
		<th> User ID</th>
		<th> Mobile Number</th>
		<th> Designation</th>
		<th> District</th>
		<th> Taluk</th>
		<th> Hobli</th>
		<th> Village</th>
		<th> Green SIM</th>
		</tr>
		<?php
		 unset($_SESSION['user_result']);
		 $n=1;
		 $suid=array();
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
			$n++;
			array_push($suid,$result['userid']);
			?>
				 <tr class="<?php echo $cls ?>">
				 <td><a href="useredit.php?uid=<?php echo $result['userid']?>&m=0" style='text-decoration:none; '>  Edit </a> </td>
				 <td  ><a href="userdetails.php?uid=<?php echo $result['userid']?>&m=0" style='text-decoration:none; '><?php echo $result['fname']?> </a> </td>
					<td> <?php echo $result['lname']?></td>
					 <td><?php echo $result['userid']?>  </td>
						<td> <?php echo $result['mobile']?> </td>
						<td  > <?php echo $result['designation']?> </td>
						 <td> <?php echo $result['district']?> </td>
						 <td><?php echo $result['taluk']?> </td>
						 <td><?php echo $result['hobli']?> </td>
					<td> <?php echo $result['village']?></td>
					 <td> <?php

			 if($result['green_simcard']==1)
			 {
				?><input type="checkbox" checked disabled="disabled" /> <?php
			 }
			 else
			 {
				?>
				<input type="checkbox" disabled="disabled" /><?php
			 }
					 ?>
					 </td>
  					</tr>
					<?php
		 }
			 		$_SESSION['user_result']=$suid;
					?>
				</table>


				<?php
		}

	 else
		{
			echo "<span class='no_res_txt'>No results found</span>";
		}

}

else
{
?>
	<table border="0px" cellpadding="0" cellspacing="0" width="100%">
	<tr>
	<th>&nbsp;  </th>
	<th> First Name  </th>
	<th> Last Name</th>
	<th> User ID</th>
	<th> Mobile Number</th>
	<th> Designation</th>
	<th> District</th>
	<th> Taluk</th>
	<th> Hobli</th>
	<th> Village</th>
	<th> Green SIM</th>

	</tr>
  <?php
	foreach($_SESSION['user_result'] as $uid)
	{
		$query=mysql_query("select * from users where userid='$uid'");
		$result=mysql_fetch_array($query);
		if($n%2==0)
		{
			$cls="td_even";
		}
		else
		{
			$cls="td_odd";
		}
		$n++;
		?>
		<tr class="<?php echo $cls ?>">
		<td><a href="useredit.php?uid=<?php echo $result['userid']?>&m=0">  Edit </a> </td>
		<td><a href="userdetails.php?uid=<?php echo $result['userid']?>&m=0"><?php echo $result['fname']?> </a> </td>
		<td> <?php echo $result['lname']?></td>
		<td><?php echo $result['userid']?>  </td>
		<td> <?php echo $result['mobile']?> </td>
		<td> <?php echo $result['designation']?> </td>
		 <td> <?php echo $result['district']?> </td>
		<td><?php echo $result['taluk']?> </td>
		 <td><?php echo $result['hobli']?> </td>
		<td> <?php echo $result['village']?></td>
		<td> <?php
		if($result['green_simcard']==1)
		{
			?>
			<input type="checkbox" checked disabled="disabled" />
			<?php
		}
		else
		{
			?>
			<input type="checkbox" disabled="disabled" />
			<?php
		}
			?></td>
 		</tr>
 		<?php
 }?>
	</table>

	<?php
}
?>



</div>
</div>
<?php include 'footer.php';?>