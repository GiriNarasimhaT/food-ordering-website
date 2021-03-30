<?php
    //include constants file
    include('../config/constants.php');

    //check id and image_name is set or not
    if(isset($_GET['id']) AND isset($_GET['image_name']))
    {
        //get the value and delete
        $id=$_GET['id'];
        $image_name=$_GET['image_name'];

        //remove the image file if available
        if($image_name !="")
        {
            //image is available so remove it
            $path = "../images/category/".$image_name;
            //remove image
            $remove=unlink($path);

            //if failed add error message and stop process
            if($remove==false)
            {
                //set session message 
                $_SESSION['remove']="<div class='error'>Failed to remove image</div>";
                //redirect to manage category page
                header('location:'.SITEURL.'admin/manage-category.php');
                //stop the process
                die();
            }
        }

        //Delete data from database
        //sql query
        $sql="DELETE FROM tbl_category WHERE id=$id";

        //execute the query
        $res=mysqli_query($conn, $sql);

        //check whether the data is deleted from database or not
        if($res==true)
        {
            //set success message and redirect
            $_SESSION['delete']="<div class='success';>Category removed successfully</div>";
            //redirect to manage category page
            header('location:'.SITEURL.'admin/manage-category.php');
        }
        else
        {
            //set fail and redirect
            $_SESSION['delete']="<div class='error';>Failed to remove Category</div>";
            //redirect to manage category page
            header('location:'.SITEURL.'admin/manage-category.php');
        }
    }
    else
    {
        //redirect to manage category page 
        header('location:'.SITEURL.'admin/manage-category.php');
    }

?>