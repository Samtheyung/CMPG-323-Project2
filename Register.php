<?php
//include("Wabantu-Classes/db-connect.php");
    
    class Wabantu_Register
    {
        private $error="";

        function evaluate($data)
        {

            foreach ($data as $key => $value) {
                if($value == "")
                {
                    $this->error = $this->error . $key . "is empty <br>";
                }
                if($key == "email")
                {
                    if(!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$value)){
                        
                        $this->error = $this->error . "Please enter a valid email <br>";
                    }
                }

                if($key == "first_name")
                {
                    if(is_numeric($value) || strstr($value," ")){
                        
                        $this->error = $this->error . "Please enter a valid first name <br>";
                    }
                }

                if($key == "last_name")
                {
                    if(is_numeric($value) || strstr($value," ")){
                        
                        $this->error = $this->error . "Please enter a valid last name <br>";
                    }
                }
            }
                if($this->error=="")
                {
                    $this->create_umuntu($data);
                }else{
                    return $this->error;
                }

        }


        function create_umuntu($data)
        {
                $first_name =  ucfirst($data['first_name']);
                $last_name = ucfirst($data['last_name']);
                $password_1 = $data['wabantu_password'];
                $username = ucfirst($data['wabantu_username']);
                $email = ucfirst($data['email']);
                $password_2 = $data['wabantu_password2'];
                $User_ID = rand(1,100000); // generate random User ID
                $url_address = strtolower($first_name) . "-" . $User_ID;


             $query = "INSERT INTO registration (User_ID,Name,Surname,Username,Password_1,Password_2,Email,url) VALUES ('$User_ID','$first_name', 
            '$last_name','$username','$password_1','$password_2','$email','$url_address')";

             $DB = new Database();
             $DB->save($query);
        }
    }
?>