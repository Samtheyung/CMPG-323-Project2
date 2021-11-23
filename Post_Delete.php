    <!--Post 1-->
    <div id="post">
    <div>
        <?php

            $image = "images/user_maje.jpg";
            if(file_exists($ROW_USER["Profile_Pic"]))
            {
                $image =  $image_class->get_thumb_profile_pic($ROW_USER["Profile_Pic"]);
            }
          
        ?>
        
        <img src="<?php echo $image?>" style="width:75px; padding:5px; border-radius:50%; margin-right:7px;">
        
    </div>
         
         <div style="width:100%;">
                <div style="color:rgb(59,89,152); font-weight:bold;">
                    
                    <?php
                     echo $ROW_USER["Username"];
                     if($ROW["IsProfile"])
                     {
                        echo"<span> updated their profile picture</span>"; 
                     }
                     if($ROW["IsWallpaper"])
                     {
                        echo"<span> updated their Wallpaper</span>"; 
                     }
                     ?> 

                </div>
                    <?php echo $ROW["post"]?>
                    <br><br>
                    <?php 
                    if(file_exists($ROW["Image_Path"]))
                        {
                            $post_image = $image_class->get_thumb_post($ROW["Image_Path"]);
                            echo "<img src='$post_image' style='width:50%;'>";
                        }
                    ?>
                    <br><br>       
         </div>
</div>