<?php 
    //include constants.php for siteurl
    include('../config/constants.php');

    //Destroy the session 
    session_destroy(); //unsets session user
    
    // redirect to login page
    header('location:'.SITEURL.'admin/login.php');

?>