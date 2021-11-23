<?php

    class UserData
    {
        public function retrieve_user_data($id)
        {
            $query = "SELECT * FROM Registration WHERE User_ID = '$id' limit 1";
            $DB = new Database();
            $result = $DB->read($query);

            if($result)
            {
                $row = $result[0];
                return $row;
            }
            else
            {
                return false;
            }
        }

        public function get_user($id)
        {
            $query = "SELECT * FROM registration WHERE User_ID = '$id' limit 1";
            $DB = new Database();
            $result = $DB->read($query);

            if($result)
            {
                return $result[0];
            }else{
                return false;
            }
        }

        public function get_abantu($id)
        {
            $query = "SELECT * FROM registration WHERE User_ID != '$id'";
            $DB = new Database();
            $result = $DB->read($query);

            if($result)
            {
                return $result;
            }else{
                return false;
            }
        }
    }
?>