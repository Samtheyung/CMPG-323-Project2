<?php

 //print_r($_SESSION);

 include("Wabantu-Classes/Autoload.php");
 

 //isset($_SESSION["Wabantu-user_ID"]);

 $login = new Wabantu_Login();
 $user_data = $login->check_login($_SESSION["Wabantu-user_ID"]);
 
 ?>
 
 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WABANTU | Timeline</title>
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
        color: #aaa;
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
        <div style="background-color:red;flex:1; min-height:400px;">

            <div id="abantu-bar">
                <img src="profile-pic.jpeg" id="profile-pic"> <br>
                <a href="Profile.php" style="color:white; text-decoration:none;"> <?php echo $user_data["Name"] . " " . $user_data["Surname"]?> </a>
            </div>
        </div>

        <div style="background-color:yellow;flex:2.5; min-height:400px; padding:15px; padding-right:0px;">
            <div style="border:dotted 2px #42b72a; border-radius:5px; background-color:white;">
                <textarea placeholder="Thoughts" id="status" cols="30" rows="10"></textarea>
                <input id="post_button" type="submit" value="Post"></input> <br><br>
            </div>

            <div id="post-bar">
                <div id="post">
                    <div><img src="user1.jpg" style="width:75px; padding:5px; border-radius:5px; margin-right:7px;"></div>
                    
                    <div>
                        <div style="color:rgb(59,89,152); font-weight:bold;">Umuntu 1</div>
                            Love is gonna get you killed but pride gon be the death of you and me
                            <br><br>
                                <a href="">Like</a> . <a href="">Comment</a> . <span><a>18 Nov 2021</a></span>
                        </div>
                    </div>
                </div>
                <div id="post">
                    <div><img src="user3.jpg" style="width:75px; padding:5px; border-radius:5px; margin-right:7px;"></div>
                    
                    <div>
                        <div style="color:rgb(59,89,152); font-weight:bold;">Umuntu 3</div>
                            It is what it is, if you don't get it... Just forget about it
                            <br><br>
                                <a href="">Like</a> . <a href="">Comment</a> . <span><a>18 Oct 2021</a></span>
                        </div>
                    </div>
                </div>

        </div>
    </div>
    
</body>
</html>