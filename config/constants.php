<?php

    //start session
    session_start();



    //create  constants to store non repeating values
    define('SITEURL', 'http://localhost/food-order/');
    define('LOCALHOST','localhost');
    define('DB_USERNAME','root');
    define('DB_PASSWORD','');
    define('DB_NAME','food-order');

    //Execute Query and save data in Database
    $conn =mysqli_connect(LOCALHOST, 'root', '') or die(mysqli_error());  //Database connection
    $db_select = mysqli_select_db($conn, 'food-order') or die(mysqli_error());    //Selecting Database

    

?>