<?php 

    // $servername = "localhost";
    // $DB_username = "root";
    // $password = "";
    // $db = "project_2";

    // $connection = new mysqli($servername, $DB_username, $password, $db);
    //   //check connection
    // if (!$connection) {
    //     die("Connection failed".mysqli_connect_error());
    // }

    // $connection->close();
//Other way of connecting using oob
    class Database
    {
        private $servername = "sql112.epizy.com";
        private $DB_username = "epiz_30428545";
        private $password = "GFshwsyCoG";
        private $db = "epiz_30428545_Project2";  
               

             function connect()
            {
                $connection = mysqli_connect($this->servername, $this->DB_username, $this->password, $this->db);
                return $connection;
            }

            function read($query)
            {
                $conn = $this->connect();
                $result=mysqli_query($conn,$query);
                if(!$result)
                {
                    return false;
                }
                else{
                    $data = false;
                    while($row = mysqli_fetch_assoc($result))
                        {
                            $data[] = $row;
            
                        }
                        return $data;
                }
            }

            function save($query)
            {
                $conn = $this->connect();
                $result=mysqli_query($conn,$query);
                if(!$result)
                {
                    return false;
                }
                else{
                    return true;
                }
            }
    }

    
?>