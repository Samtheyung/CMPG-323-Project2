<?php
session_start();
if(isset($_SESSION["Wabantu-user_ID"]))
{
    $_SESSION["Wabantu-user_ID"] = NULL;
    unset($_SESSION["Wabantu-user_ID"]);
    header("Location:Login.php");
    die;
}
    
    
?>