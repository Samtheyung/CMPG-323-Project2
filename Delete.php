<?php

 //print_r($_SESSION);

 include("Wabantu-Classes/Autoload.php");

 $login = new Wabantu_Login();
 $user_data = $login->check_login($_SESSION["Wabantu-user_ID"]);
 $Post = new Post();
 $error = "";
 if(isset($_GET["id"]))
 {
     
     $ROW = $Post->get_one_post($_GET["id"]);
     if(!$ROW)
     {
        $error = "No such post was found";
     }else {
            if($ROW["User_ID"] != $_SESSION["Wabantu-user_ID"])
            {
                $error = "You do not have access to delete this post";
            }
     }
 }else{
     $error = "No such post was found";

 }

 //if something was posted
 if($_SERVER["REQUEST_METHOD"] == "POST")
 {
      //print_r($_POST);
      $Post->Delete_post($_POST["post_id"]);
      header("Location:Profile.php");
      die; 
    
     
 }
 ?>
 
 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WABANTU | Delete</title>
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
    #profile-pic{
        width:150px;
        height:100px;
        border-radius:50%;
        border:dotted 2px #42b72a;
    }
    #abantu-bar{
        background-color:rgb(59,89,152);
        min-height:600px;
        padding:8px;
        color: black;
        padding:8px;
        text-align:center;


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
    #status-button{
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
            <div style="border:dotted 2px #42b72a; border-radius:5px; background-color:white;">
               <h2 style="color:black;font-weight:bold;"></h2>
               <form action="" method="post">
                    <?php

                        if($error != "")
                        {
                            echo $error;
                        }
                        if($ROW)
                        {
                            echo"Are you sure you want to delete post ?<br>";
                            $user = new UserData();
                            $ROW_USER = $user->get_user($ROW["User_ID"]);
                            include("Post_Delete.php");
                        }
                      
                    ?>
                   <br>
                <input id="post_button" type="submit" value="Delete"></input>
                <input name="post_id" type="hidden" value="<?php echo $ROW["post_id"]?>"></input>
                <br><br>
                </form>
            </div>

           

        </div>
    </div>
    
</body>
</html>