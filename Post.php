<?php
    
    class Post
    {
        private $error = "";
        public function create_post($user_ID, $data, $file)
        {
            if(!empty($data["post"]) || !empty($file["file"]["name"]) || isset($data["IsProfile"]) || isset($data["IsWallpaper"]))
            {
                $my_image = "";
                $has_image = 0;
                $IsProfile = 0;
                $IsWallpaper = 0;

                if(isset($data["IsProfile"]) || isset($data["IsWallpaper"]))
                {
                    $my_image = $file;
                    $has_image = 1;

                    if(isset($data["IsProfile"]))
                    {
                        $IsProfile = 1;
                    }
                    if(isset($data["IsWallpaper"]))
                    {
                        
                        $IsWallpaper = 1;
                    }
                   
                }
                else {
                    if(!empty($file["file"]["name"]))
                {
                    $folder = "Uploads/" . $user_ID . "/";

                    //create folder
                    if(!file_exists($folder))
                        {
                             mkdir($folder,0777,true);
                        }

                    $image_class = new Image();
                    $my_image = $image_class->generate_filename(8). ".jpg";

                    $my_image = $folder . $image_class->generate_filename(8) . ".jpg";
                    move_uploaded_file($_FILES["file"]["tmp_ "], $my_image);

                    $image_class->resize_image($my_image,$my_image,1500,1500);
                        $has_image = 1;
                }
                }

                $post = "";
                if(isset($data["post"]))
                {
                    $post = addslashes($data["post"]); // to escape any funny character in text
                }
                $post_id = $this->create_post_id();
                $query = "INSERT INTO posts (User_ID, Post_ID, post, Image_Path, Has_Image, IsProfile,IsWallpaper) values ('$user_ID','$post_id','$post','$my_image','$has_image', '$IsProfile','$IsWallpaper')";
                $DB = new Database();
                $DB->save($query);
            }
            else
            {
                $this->error .= "Please type something to post<br>";
            }
            return $this->error;
        }

        public function get_one_post($post_id)
        {
            if(!is_numeric($post_id))
            {
                return false;
            }
            $query = "SELECT * FROM posts WHERE Post_ID = '$post_id' limit 1";
            $DB = new Database();
            $result = $DB->read($query);
    
            if($result)
            {
                return $result[0];
            }else{
                return false;
            }
        }

        
        public function Delete_post($post_id)
        {
            if(!is_numeric($post_id))
            {
                return false;
            }
            $query = "DELETE FROM posts WHERE Post_ID = '$post_id' limit 1";
            $DB = new Database();
            $DB->read($query);
        }


        public function get_posts($id)
        {
            $query = "SELECT * FROM posts WHERE User_ID = '$id' ORDER BY id DESC limit 10";
            $DB = new Database();
            $result = $DB->read($query);

            if($result)
            {
                return $result;
            }else{
                return false;
            }
        }

        
        public function create_post_id()
        {
            $length = rand(1,9);
            $number = "";
            for($i=0; $i<$length; $i++)
            {
                $new_rand = rand(0,9);
                $number = $number . $new_rand;
            }
            
            return $number;
        }
    }
    ?>