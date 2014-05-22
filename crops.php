<?php
class Index 
{
   function Index()
   {
   
   }
   
   function Run()
   {
     $app_type = $this->DecodeUrlStr('app_type');
     
     if($app_type == 'CROPS')
       $this->GetCrops();
     elseif($app_type == 'GETPDF')
       $this->GetPdf();
     else
       $this->GetDistricts();
   }
   
   function GetDistricts($dist='')
   {
     $district_array = array('Bijapur','Chikmagalore','Raichur','Tumkur');
     
     $script = "<script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js'></script>
                <script>
                $(document).ready(function()
                {
										 $('#go').click(function()
										 {
												var dist = $('#dist option:selected').val();
													$.ajax({
														url: '?app_type=CROPS&dist='+dist,
														context: document.body,
														success:function ( response ) {
                               $('#crops_div').replaceWith(response);
                             }
													}) 

										 });
                });
                </script>
                ";

     $content = "<div><form name='myform' id='myform'  action='?app_type=CROPS' method='POST'>
                 Select a district <select name ='dist' id='dist'>";
                 
     foreach($district_array as $district)
     {
       $selected = $district == $dist?'selected' : '';
       $content.= "<option value='{$district}' $selected>$district</option>";
     }
     $content.= "</select>
                 <input type='button' id='go' value='Go'>
                 <div id='crops_div'></div>
                 </div>";
                 
     
     echo $script.$content;
   }
   
   function GetCrops()
   {
     $dist = $this->DecodeUrlStr('dist');
     $ajax = $this->DecodeUrlStr('ajax');

     if($ajax)
      $this->GetDistricts($dist);  // this is called for showing dropdown with selected value for back button
     
     $directory = 'Crops';
     if ( ! is_dir($directory)) {
		     exit('Invalid diretory path');
		 }
		 
		 $crops = "<div><ul id='crops' name='crops'>";
		 foreach (scandir($directory) as $file)
		 { 
		   if ('.' === $file) continue;
       if ('..' === $file) continue;
       $file_name = basename($file, ".pdf");
       $crops.= "<li><a href='?app_type=GETPDF&crop={$file}'>{$file_name}</a></li>";
     }
     $crops.= "</ul></div>";
     echo $crops; 
     exit;
   }
   
   function GetPdf()
   {
      $crop = $this->DecodeUrlStr('crop');

      $head = '<a href="?app_type=CROPS&ajax=1">Back to crops</a><br><br>'; 
      echo $head;
			$src = "Crops/".$crop;
			$content = '<iframe frameborder="0" height="700" width="1000" src="'.$src.'"></iframe>';
			echo $content;
  }
   
  function DecodeUrlStr($key, $val="")
  {
    global $HTTP_GET_VARS;
    global $HTTP_POST_VARS;
    if(@$_GET["$key"])
      $val= $_GET["$key"];
    else
    {
      if(@$_POST["$key"])
        $val= $_POST["$key"];
    }
      
    return $val;
  }
}
$app = new Index();
$app->Run();

?> 