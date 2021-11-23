<?php 

    $image = "images/user_male.jpg";
    if(file_exists($Abantu_ROW["Profile_Pic"]))
            {
                $image =  $image_class->get_thumb_profile_pic($Abantu_ROW["Profile_Pic"]);
            }

?>

               
                <div id="abantu">
                    <a href="Profile.php?<?php echo $Abantu_ROW["User_ID"];?>" style="text-decoration:none;">
                        <img src="<?php echo $image?>" id="abantu-image">
                        <br>
                        <?php echo $Abantu_ROW["Username"] ?>
                    </a>
                </div>
               
            