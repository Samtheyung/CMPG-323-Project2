<?php

// echo "<pre>";
// print_r($_GET);
// echo"</pre>";

    include("Wabantu-Classes/Autoload.php");

    //isset($_SESSION["Wabantu-user_ID"]);

    $login = new Wabantu_Login();
    $user_data = $login->check_login($_SESSION["Wabantu-user_ID"]);

   if(isset($_GET["id"]) && is_numeric($_GET["id"]))// is numeric for protecting against white and black listing
   {
        $profile = new Profile();
        $profile_data = $profile->get_profile($_GET["id"]);

        if(is_array($profile_data))
        {
            $user_data = $profile_data[0];
        }
   }
    

    
    //print_r($user);

    //code for posting is here
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // var_dump($_FILES);
        // die;
        $id = $_SESSION["Wabantu-user_ID"];
        $post = new Post();
        $result = $post->create_post($id, $_POST,$_FILES); 

        if($result == "")
        {
            header("Location: Profile.php");
            die;
        }else
        {
            echo"<div style='text-align:center;color:black;background-color:antiquewhite;font-size:10px;'";
            echo"<br> The following errors occured:<br>";
            echo $result;
            echo"</div>";
        }
    }

    // getting posts
    $post = new Post();
    $id = $user_data["User_ID"];
    $posts = $post->get_posts($id);

    //Collect friends
 
    $abantu = new UserData();
    $Abantu = $abantu->get_abantu($id);

    $image_class = new Image();


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WABANTU | Profile</title>
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
    #background{
        /* background-image:url(); */
        background-color:#42b72a;
        width:800px;
        margin:auto;
        min-height:400px;
        margin-top:14px;
    } 
    #profile-pic{
        width:150px;
        margin-top:-200px;
        height:100px;
        border-radius:50%;
        border:dotted 2px #42b72a;
    }
    #abantu-bar{
        background-color:rgb(59,89,152);
        min-height:100%;
        padding:8px;
        color: #aaa;
        padding:8px;


    }
    #abantu-image{
         width:100px;
         height: 100px;
         float: left;
         margin: 8px;
    }
    #abantu{
        clear:both;
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
    <div id="background">
        <div style="background-color:white; text-align:center; background-color:#42b72a;">
        <?php 
                $image = "mountain.jpg";
                if(file_exists($user_data["Cover_Image"]))
                {
                    $image = $image_class->get_thumb_wallpaper($user_data["Cover_Image"]);
                }
            ?>
            <img src="<?php echo $image?>" style="width:100%;">
            <span style="font-size:12px;">
            <?php 
                $image = "images/user_male.jpg";
                if(file_exists($user_data["Profile_Pic"]))
                {
                    $image =  $image_class->get_thumb_profile_pic($user_data["Profile_Pic"]);
                }
            ?>
                <img src="<?php echo $image?>" id="profile-pic"> <br>
                <a href="change_profile_pic.php?change=profile" style="text-decoration:none;">Change Profile Picture</a> | 
                <a href="change_profile_pic.php?change=wallpaper " style="text-decoration:none;">Change Wallpaper</a>
            </span><br>
            <div style="font-size 25px; color:#405d9b; font-weight:bold;"><?php echo $user_data["Username"]?></div>
            <div>
            <a href="index.php" style="text-decoration:none;"><span style="font-size:15px;color:red;">Gallery</span> </a> &nbsp &nbsp
            <span style="font-size:15px;color:yellow;">Abantu</span> &nbsp &nbsp
            <span style="font-size:15px;color:White;">Settings</span> &nbsp &nbsp
            <span style="font-size:15px;color:Black;">About</span>  
            </div>
               
        </div>

    </div>
    <div id="content" style="display:flex; ">
        <div style="background-color:red;flex:1; min-height:400px;">

            <div id="abantu-bar"> 

                Abantu

                <?php 

                    if($Abantu)
                    {
                        foreach ($Abantu as  $Abantu_ROW) { // caps Row and Row user becaue they hold important info
                            
                            include("User.php");
                        }
                    }
                 ?>
            </div>
        </div>

        <div style="background-color:yellow;flex:2.5; min-height:400px; padding:15px; padding-right:0px;">
            <div style="border:dotted 2px #42b72a; border-radius:5px; background-color:white;">
                <form action="" method="post" enctype="multipart/form-data">
                    <textarea name="post" placeholder="Thoughts" id="status" cols="30" rows="12"></textarea>
                    <input type="file" name="file" value="Choose Image">
                    <input id="post_button" type="submit" value="Post"></input> <br><br>
                </form>
            </div>


            <!--Posting area-->
            <div id="post-bar">
            
            <?php 

                if($posts)
                {
                    foreach ($posts as  $ROW) { // caps Row and Row user becaue they hold important info
                        $user = new UserData();
                        $ROW_USER = $user->get_user($ROW["User_ID"]);
                        include("Post.php");
                    }
                }

               
            ?>
                    
            </div>

        </div>
    </div>
    
</body>
</html>