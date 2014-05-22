<?php session_start(); ?> 
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
<title>Krishi Gyan Sagar</title>
<link href="css/styles.css" type="text/css" rel="stylesheet">
</head>
<body class="login_bg">




<div class="main">


<div class="leftside">

 <img src="images/kgs_logo.png" border="0" alt="" class="login_lo"> 

 

<form action="soilmaps.php" method="post">
<div class="login_form">
<span class="sig_in"> Sign In </span>
<?php if(isset($_SESSION['error'])){ 

echo "<span style='color:red;'>Invalid Username/Password</span>"; unset($_SESSION['error']);}?>
<div class="log_1">
<span class="login_left"> ID </span>
 <input type="text" name="username" class="login_right">  </div>
 <div class="log_1">
 <span class="login_left"> Password </span>
 <input type="password" name="password" class="login_right">  </div>
 
<input type="submit" class="sign_btn"  name="submit1" value="Sign in" > <!--<div class="sign_btn"> <a href="farmerslist.html">  Sign in </a> </div>-->
 
</div>


 </form>
 
 <div class="login_foot"> </div>
  

</div>

<div class="map_img">   </div>
<!--<div class="pnuncsys">Powered by: NUNC Systems</div>-->

</div>
</div>
 </div>
</div>
</div>
</body>
</html>
