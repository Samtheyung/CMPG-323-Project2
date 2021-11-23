<?php
    $corner_image = "images/male_user.jpg";
    if(isset($user_data))
    {
        $image_class = new Image();
        $corner_image =  $image_class->get_thumb_profile_pic($user_data["Profile_Pic"]);
    }
?>



<div id="blue-bar">
        <div style="font-size:25px; font-family:cursive; width:800px; margin:auto;">
            <div>
            <span style="font-size:10px;color:red;">W</span>
            <span style="font-size:10px;color:purple;">A</span>
            <span style="font-size:10px;color:yellow;">B</span>
            <span style="font-size:10px;color:orange;">A</span>
            <span style="font-size:10px;color:white;">N</span>
            <span style="font-size:10px;color:black;">T</span>
            <span style="font-size:10px;color:purple;">U</span> &nbsp
            <input type="text" id="search_box" placeholder="Search for ABANTU">
            <div style="font-weight:bold; float:right; margin:8px;">
            <a href="Logout.php" style="text-decoration:none;">
            <span style="color:red; font-size:20px;">L</span>
            <span style="color:orange; font-size:20px; ">O</span>
            <span style="color:yellow; font-size:20px; ">G</span>
            <span style="color:black; font-size:20px; ">O</span>
            <span style="color:indigo; font-size:20px; ">U</span>
            <span style="color:white; font-size:20px; ">T</span>
            </a>
            </div>
            
            <a href="Profile.php" style="text-decoration:none"> "<img src="<?php echo $corner_image?>" style="float:right;width:50px; height:50px;"></a>
        </div>   
    </div>