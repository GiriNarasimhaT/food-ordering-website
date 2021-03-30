<?php

    //include contants.php
    include('../config/constants.php');

    //Get the id of the admin to deleted
    $id = $_GET['id'];

    //SQL query to Delete Admin
    $sql = "DELETE FROM tbl_admin  WHERE id=$id";

    //Execute the Query
    $res = mysqli_query($conn, $sql);

    //check wheather the query executed successfully or not
    if($res==true)
    {
        //Query executed successfully and Admin Deleted
        //create session variable to display message
        $_SESSION['delete'] = "<div class='success'> Admin deleted Successfully... </div>";
        //Redirect to manage admin page
        header('location:'.SITEURL.'admin/manage-admin.php');

    }
    else
    {
        //Failed to delete Admin
        $_SESSION['delete'] = "<div class='error'>Failed to delete Admin.Try  Again..</div>";
        header('location:'.SITEURL.'admin/manage-admin.php');
        
    }

    //Redirect to Manage Admin page with message (success/error)

?>