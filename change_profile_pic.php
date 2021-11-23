<?php
 session_start();
 //print_r($_SESSION);

 include("Wabantu-Classes/Autoload.php");

 //isset($_SESSION["Wabantu-user_ID"]);

 $login = new Wabantu_Login();
 $user_data = $login->check_login($_SESSION["Wabantu-user_ID"]);

 if($_SERVER["REQUEST_METHOD"] == "POST")
 {
    
   
    if(isset($_FILES["file"]["name"]) && $_FILES["file"]["name"] != "")
    {
        if($_FILES["file"]["type"] == "image/jpeg")// filter which image types
        {
            $image_size = (1024 * 1024) * 10;
            if($_FILES["file"]["size"] < $image_size)
            {
                $folder = "Uploads/" . $user_data["User_ID"] . "/";

                    //create folder
                    if(!file_exists($folder))
                        {
                             mkdir($folder,0777,true);
                        }

                $image = new Image();
                 $filename = $image->generate_filename(8). ".jpg";

                $filename = $folder . $_FILES["file"]["name"];
                move_uploaded_file($_FILES["file"]["tmp_name"], $filename);

                $change = "Profile";
                    if(isset($_GET["change"]))
                    {
                        $change = $_GET["change"];
                    }

                if($change == "cover")
                        {
                            if(file_exists($user_data["Cover_Image"]))
                            {
                                unlink($user_data["Cover_Image"]);
                            }
                            $image->resize_image($filename,$filename,1500,1500);
                        }else{
                            if(file_exists($user_data["Profile_Pic"]))
                            {
                                unlink($user_data["Profile_Pic"]);
                            }
                            $image->resize_image($filename,$filename,1500,1500);
                        }
                
                
        
                if(file_exists($filename))
                {
                    $userid = $user_data["User_ID"];
                    
                        if($change == "wallpaper")
                        {
                            $query = "UPDATE registration set Cover_Image = '$filename' WHERE User_ID = '$userid' limit 1";
                            $_POST["IsWallpaper"] = 1;
                        }
                        else
                        {
                            $query = "UPDATE registration set Profile_Pic = '$filename' WHERE User_ID = '$userid' limit 1";
                            $_POST["IsProfile"] = 1;
                        }
                   
                    $DB = new Database();
                    $DB->save($query);

                    // create new post
                   
                    $post = new Post();
                    $post->create_post($userid, $_POST,$filename); 


                    header(("Location: Profile.php"));
                    die;
                }
            }else{
            echo"<div style='text-align:center;color:black;background-color:antiquewhite;font-size:10px;'";
            echo"<br> The following errors occured:<br>";
            echo "Enter correct image type, only jpg and png allowed ";
            echo"</div>";
        }

        }else{
            echo"<div style='text-align:center;color:black;background-color:antiquewhite;font-size:10px;'";
            echo"<br> The following errors occured:<br>";
            echo "Please add a valid image";
            echo"</div>";
        }
    }
        
        else{
        echo"<div style='text-align:center;color:black;background-color:antiquewhite;font-size:10px;'";
        echo"<br> The following errors occured:<br>";
        echo "something went wrong";
        echo"</div>";
     }
    } 
 ?>
 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Profile Picture | Timeline</title>
</head>

<style>
    #blue-bar{
        height:50px;
        background-color: #405d9b;
        color:#d9dfeb;
    }
    #search_box{
        height: 20px;
        width:400px;
        border-radius:10px;
        border:solid 2px #42b72a;
        background-image:url(search.png);
        background-repeat: no-repeat;
        background-position: right;
    }   
   
    
    #status{
        width:100%;
        font-family:cursive;
        font-size:14px;
        border:none;
    }
    #post_button{
        float:right;
        height:30px;
        width:70px;
        border-radius:10px;
        border:dotted 2px #42b72a;
        font-weight:bolder;
        background-color:#42b72a;
        color:rgb(59,89,152);
        padding:5px;
    }
    #post-bar{
        background-color: antiquewhite;
        margin-top:5px;
    }
    #post{
        display:flex;
        padding:5px;
        font-size: 14px;
        color:#42b72a;
        margin-bottom:20px;
    }
</style>
<body style="font-family:cursive; background-color:#42b72a;">
<?php include("header.php")?>
    <div id="content" style="display:flex; margin-top:30px; ">
            <div style="background-color:yellow;flex:2.5; min-height:400px; padding:15px; padding-right:0px;">
        <form method="post" enctype="multipart/form-data">

                <div style="border:dotted 2px #42b72a; border-radius:5px; background-color:white;">
                    <input type="file" name="file">
                    <input style= "width:180px;"id="post_button" type="submit" value="Change Profile Picture"></input> <br><br>
                    <div style="text-align:center;">
                    <?php 
                               
                                if(isset($_GET["change"]) && $_GET["change"] == "wallpaper")
                                {
                                    $change = "wallpaper";
                                    echo "<img src='$user_data[Cover_Image]' style='max-width:500px;'>";
                                }
                                else{
                                    echo "<img src='$user_data[Profile_Pic]' style='max-width:500px;'>";
                                }
                            
                            ?> 
                    
                        </div>
                </div>
        </form>
            
    </div>
    
</body>
</html>


 