<?php

class Profile
{
    public function get_profile($id)
    {
        $id = addslashes($id); // variable escaping, used to protect against sql injection, takes everything as a string
        $DB = new Database();
        $query = "SELECT * FROM registration User_ID = '$id' limit 1";
        return $DB->read($query);

       
    }
}

?>