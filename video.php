<?php
ini_set('post_max_size', '64M');
ini_set('upload_max_filesize', '64M');
session_start();

if(isset($_REQUEST['video_ajax']))
{
    include 'dbcon.php';
    $id=$_REQUEST['id'];

    $q=mysql_query("select * from video where id=$id");
    $r=mysql_fetch_array($q);
    $url=$r['url'];
    $type=$r['type'];
    $video_path=$r['video_path'];

    ?>


    <div id="vedio_<?php echo $id ?>" >
        <?php
         if($type=='Image')
        {
            $img_url="http://www.krishigyansagar.com/fphotos/test/".$video_path;
            ?>
            <img src ="<?php echo $img_url;?>"  class="video_class"
                 width="400" height="300" border="0"
                />

          <?php
        }
        else{
        ?>
                <iframe width="560" height="315" class="iframe_video" src="<?php echo $url;?>" frameborder="0" allowfullscreen></iframe>

        <?php
        }
        ?>

                </div>

<?php
    exit;
}





include 'header.php';
//phpinfo();
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
    <style type="text/css">

        .ui-widget { margin: 2px 266px !important;
            position: fixed !important;

            font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
            font-size: 12px;

        }

        .ui-widget-content .ui-icon{background: url(../img/basic/x.png) no-repeat !important;
            background-position: -4px -3px !important;}

        .ui-widget-overlay
        {
            position: fixed !important;
            background-color:rgba(15, 10, 10, 0.53);;
        }

    </style>
<script>
    $(document).ready(function()
    {
            $("#newvideo_div").dialog({
                autoOpen:false,

                height: 350,
                width: 350,
                modal: true,
                title:"add new video",
                /*
                 close: function(ev, ui)
                 {

                 $(this).close();
                 },
                 */
                open: function(event, ui) { $(".ui-dialog-titlebar").show(); }
            });
            $('#newvideo').on("click",function()
            {

                $("#newvideo_div").dialog("open");
            });



       $(".vedio_iframe").dialog({
            autoOpen:false,
            height: 500,
            width: 500,
            modal: true,
            title:"video",
           position: {my: "center top", at:"center top", of: window },
             open: function(event, ui) { $(".ui-dialog-titlebar").show(); }
        });

        $(".video_class").on("click",function()
        {
            id=this.id;
             id=id.substr(4);

            datastring="video_ajax=true&id="+id
            $.ajax(
                {
                    url:"video.php",
                    data:datastring,
                    type:"post",
                    success:function(responsedata)
                    {

                        $(".vedio_iframe").html(responsedata).dialog("open");
                    }
                  })
        });


        $(".ui-dialog-titlebar-close").live('click',function()
        {
            $(".iframe_video").attr("src","");
        })


    });


</script>

<?php




?>

<div class="midd_right1">
    <div class="main_heads">
        <div class="farmer_head">Videos List  </div>
            <div class="btn_m">
                <button type="submit" name="newvideo"  id="newvideo" class="new">New</button> </div>
            <div id='newvideo_div' style="display:none">
                <form action=""  enctype="multipart/form-data" method="post">
                    <p>
                     Title:<br>
                        <input type="text" name="title" size="30">
                    </p>
                    <p>
                        Please specify a file:<br>
                        <input type="file" name="video" accept="video/.mp4,.mp3,.wma,.mov,.flv,.avi,.qt,.wmv,.rm">
                    </p>
                    <div>

                       <input name="upload" type="submit" value="upload" />

                    </div>
                </form>



             </div>


                <?php
                if(isset($_POST['upload']))
                {
                    $title=$_POST['title'];
                    if ($_FILES["file"]["error"] > 0)
                     {
                      //  echo "Error: " . $_FILES["video"]["error"] . "<br>";
                    }
                    else
                    {
                        $title=$_POST['title'];
                        /*
                        echo "Upload: " . $_FILES["video"]["name"] . "<br>";
                        echo "Type: " . $_FILES["video"]["type"] . "<br>";
                        echo "Size: " . ($_FILES["video"]["size"] / 1024) . " kB<br>";
                        echo "Stored in: " . $_FILES["video"]["tmp_name"];

*/

                        $size=($_FILES["video"]["size"] / 1024);
                        $ext = array('mpg', 'wma', 'mov', 'flv', 'mp4', 'mp3', 'avi', 'qt', 'wmv', 'rm');
                        $extfile = substr($_FILES["video"]["name"],-4);
                        $extfile = explode('.',$extfile);
                        $good = array();
                        $extfile = $extfile[1];
                        if (in_array($extfile, $ext))
                        {
                            $good['safe'] = true;
                            $good['ext'] = $extfile;
                        }
                        else
                        {
                            $good['safe'] = false;
                        }
                                   // set the upload directory
                       // $uploaddir = "upload_video/";
                        $uploaddir="/home/krishigy/public_html/video/";
                        //$live_dir is for videos after converted to flv
                        $live_dir = '/home/krishigy/public_html/video/live/';

                        //$live_img is for the first frame thumbs.
                        $live_img = '/home/krishigy/public_html/video/images/';

                        $seed = @mktime();
                        $upload = $seed.'_'.basename($_FILES['video']['name']);
                        $uploadfile = $uploaddir .$upload;
                        // validate file type
                        //$safe_file = checkfile($_FILES['video']);
                        //echo 'file to be moved is '.$uploaddir.'<br>';
                           // do upload

                        if (in_array($extfile, $ext))
                        {
                            if (move_uploaded_file($_FILES['video']['tmp_name'], $uploadfile))
                            {
                                $base = basename($_FILES['video']['name']);
                                $new_file = $base.'flv';
                                $new_image = $base.'jpg';
                                $new_image_path = $live_img.$new_image;
                                $new_flv = $live_dir.$new_file;
                                //ececute ffmpeg generate flv
                               exec('/usr/local/bin/ffmpeg -i '.$uploadfile.' -ar 22050 -ab 32 -f flv -s 320×240 '.$new_flv.''); // sam2
                                //execute ffmpeg and create thumb
                                $command = "/usr/local/bin/ffmpeg -i " . $uploadfile . " -vcodec mjpeg -vframes 1 -an -f rawvideo -s 75x75".$new_image_path;
                               exec("$command");
                                //create query to store video
                                sleep(1);
                                $name = $_FILES["file"]["name"];
                                $uploads_dir="www.krishigyansagar.com/video/";
                               // echo $new_image_path;

                               // move_uploaded_file($tmp_name, "$uploads_dir.$name");

                                //getThumbImage($uploadfile);

                           $url='http://'.$uploads_dir.$upload;
                                   $thumbnail="images/video_thumb.JPG";

                                   $video_length=$size;
                                   mysql_query("INSERT INTO `video`(`title`, `url`, `thumbnail`, `video_length`) VALUES ('$title','$url','','$video_length')");
                                //echo "<br>INSERT INTO `video`(`title`, `url`, `thumbnail`, `video_length`) VALUES ($title,'$url','','$video_length')";
                            }

                    }
                    else
                    {
                        echo '<br><div><strong>Please upload specific files only</strong></div>';


                    }
                        }

                }
                //else{
 ?>
                    <br>
            <div style="float: left; margin-left: 10px">
        <?php
                        $query=mysql_query("select * from video");
                        while($r=mysql_fetch_array($query))
                        {
                            $thumbnail=$r['thumbnail'];
                            $title=$r['title'];
                            $url=$r['url'];
                            $video_length=$r['video_length'];
                            $id=$r['id'];
                             $type=$r['type'];
                            if($type=='Image')
                            {
                                $type='Image';
                            }
                            else
                            {
                                $type='Video';
                            }

                          ?>
                 <div  class="img_div" style="height:150px;width:200px;float: left;">
                <img src ="images/video_thumb.JPG" id="img_<?php echo $id ?>" class="video_class"
                     width="151" height="100" border="0"
                      />
                     <br>
                    <span style="margin-left:20;"><?php echo $title.'('.$type.')' ?></span>
                 </div>

                  <?php


                        } ?>

                    </div>
                    <?php

              //  }









                function getThumbImage($videoPath)
                {
                    $movie = new ffmpeg_movie($videoPath,false);
                    $this->videoDuration = $movie->getDuration();
                    $this->frameCount = $movie->getFrameCount();
                    $this->frameRate = $movie->getFrameRate();
                    $this->videoTitle = $movie->getTitle();
                    $this->author = $movie->getAuthor() ;
                    $this->copyright = $movie->getCopyright();
                    $this->frameHeight = $movie->getFrameHeight();
                    $this->frameWidth = $movie->getFrameWidth();

                    $capPos = ceil($this->frameCount/4);

                    if($this->frameWidth>120)
                    {
                        $cropWidth = ceil(($this->frameWidth-120)/2);
                    }
                    else
                    {
                        $cropWidth =0;
                    }
                    if($this->frameHeight>90)
                    {
                        $cropHeight = ceil(($this->frameHeight-90)/2);
                    }
                    else
                    {
                        $cropHeight = 0;
                    }
                    if($cropWidth%2!=0)
                    {
                        $cropWidth = $cropWidth-1;
                    }
                    if($cropHeight%2!=0)
                    {
                        $cropHeight = $cropHeight-1;
                    }

                    $frameObject = $movie->getFrame($capPos);


                    if($frameObject)
                    {
                        $imageName = "test1.jpg";
                        $tmbPath = "/home/home_Dir/public_html/uploads/thumb/".$imageName;
                        $frameObject->resize(120,90,0,0,0,0);
                        imagejpeg($frameObject->toGDImage(),$tmbPath);
                    }
                    else
                    {
                         $imageName="";
                    }
                    return $imageName;

                }


                ?>





            </div>
        </div>


<div class="vedio_iframe""> </div>
<?php include 'footer.php';?>
<div>

