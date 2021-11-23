<?php
        class Wabantu_Login
        {
            private $error="";
    
            function login_check($data)
            {
                    
                $password_1 = addslashes($data['wabantu_password']);
                $username = addslashes($data['wabantu_username']);
    
                 $query = "SELECT * FROM Registration WHERE Username = '$username' limit 1";
    
                 $DB = new Database();
                 $result = $DB->read($query);

                 if($result)
                 {
                        $row = $result[0];

                        if($password_1 == $row["Password_1"])
                        {
                            //Create session info
                            $_SESSION["Wabantu-user_ID"] = $row["User_ID"];
                        }
                        else
                        {
                            $this->error .= "Wrong password, Please enter correct password";
                        }
                 }
                else
                        {
                            $this->error.= "Wrong username, Please enter correct username";
                        }
                return $this->error;  
            }

            public function check_login($id)
            {
                     //check if user is logged in
                if(is_numeric($id))
                {

                    $query = "SELECT * FROM Registration WHERE User_ID = '$id' limit 1";
    
                $DB = new Database();
                $result = $DB->read($query);

                if($result)
                {
                    $user_data = $result[0];
                    return $user_data;
                }else{
                    header("Location:Login.php");
                    die;
                } 

                }else{
                    header("Location:Login.php");
                    die;
                }
             }
        }
        
?>