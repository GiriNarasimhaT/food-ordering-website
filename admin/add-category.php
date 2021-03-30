<?php include('partials/menu.php'); ?>


<div class="main-content">
    <div class="wrapper">
        <h1>Add Category</h1>

        <br>

        <?php
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];  //To Display Session Message
                unset($_SESSION['add']); //Removing Session Message
                header('Refresh: 2; URL=http://localhost/food-order/admin/add-category.php');
            }

            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];  //To Display Session Message
                unset($_SESSION['upload']); //Removing Session Message
                header('Refresh: 2; URL=http://localhost/food-order/admin/add-category.php');
            }
        ?>

        <br>

        <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td><input type="text" name="title" placeholder=" Enter Category title"></td>
                </tr>

                <tr>
                    <td>Image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Featured: </td>
                    <td>
                        <input type="radio" name="featured" value="Yes"> Yes / 
                        <input type="radio" name="featured" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name="active" value="Yes"> Yes / 
                        <input type="radio" name="active" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Category" class="btn-secondary">
                    </td>
                </tr>

            </table>

        </form>


        <?php

            //check whether submit button is clicked or not
            if(isset($_POST['submit']))
            {
                //get the values from the category form
                $title=$_POST['title'];

                //for radio to check whether th button is selected or not
                if(isset($_POST['featured']))
                {
                    //get the value from form
                    $featured=$_POST['featured'];
                }
                else
                {
                    //set the default value
                    $featured="No";
                }

                if(isset($_POST['active']))
                {
                    //get the value from form
                    $active=$_POST['active'];
                }
                else
                {
                    //set the default value
                    $active="No";
                }

                //check whether the image is selected or not and set the image name accordingly
                //print_r($_FILES['image']);

                //die(); //break the code here

                if(isset($_FILES['image']['name']))
                {
                    //to upload image we need image name, source path and destination path
                    $image_name=$_FILES['image']['name'];

                    //upload image only if image is selected
                    if($image_name!= "")
                    {

                        //auto renaming the image
                        //get the extension of our image (like: jpg,png,gif....) eg:"food1.jpg"
                        $ext=end(explode('.',$image_name));

                        //rename the image 
                        $image_name="Food_Category_".rand(000,999).'.'.$ext; //new image eg:"Food_Category_834.jpg"

                        $source_path=$_FILES['image']['tmp_name'];

                        $destination_path="../images/category/".$image_name;

                        //upload the image
                        $upload = move_uploaded_file($source_path,$destination_path);

                        //check whether the image is uploaded or not
                        //and if the image is not uploaded ,then stop the process and redirect with error message
                        if($upload==false)
                        {
                            //set message
                            $_SESSION['upload']="<div class='error'>Failed to upload Image</div>";
                            //redirect to add-category page 
                            header('location:'.SITEURL.'admin/add-category.php');
                            //stop the process
                            die();
                        }
                    }
                }
                else
                {
                    //don't upload image and set the image_name value as blank
                    $image_name="";
                }

                //create sql query to insert category into database
                $sql = "INSERT INTO tbl_category SET
                    title='$title',
                    image_name='$image_name',
                    featured='$featured',
                    active='$active'
                ";

                //execute the query and save in database
                $res=mysqli_query($conn, $sql);

                //check whether the query is executed or not and data added or not
                if($res==true)
                {
                    //query executed and category added
                    $_SESSION['add']="<div class='success'>Category added successfully</div>";

                    //redirect to manage category page
                    header('location:'.SITEURL.'admin/manage-category.php');
                }
                else
                {
                    //failed to add category
                    $_SESSION['add']="<div class='error'>Failed to add Category</div>";
                    //redirect to manage category page
                    header('location:'.SITEURL.'admin/add-category.php');
                }
            }

        ?>

    </div>
</div>

<?php include('partials/footer.php'); ?>