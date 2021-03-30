<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Food</h1>

        <br><br>

        <?php

            //check whether the id is set or not
            if(isset($_GET['id']))
            {
                //get the id and all other details
                $id=$_GET['id'];
                //create sql query to get all other details
                $sql2="SELECT * FROM tbl_food WHERE id=$id";

                //execute the query
                $res2=mysqli_query($conn, $sql2);

                //count the rows to check whether the id is valid or not
                $count2=mysqli_num_rows($res2);

                if($count2==1)
                {
                    //get all data
                    $row2=mysqli_fetch_assoc($res2);

                    $title=$row2['title'];
                    $description=$row2['description'];
                    $price=$row2['price'];
                    $current_image=$row2['image_name'];
                    $current_category=$row2['category_id'];
                    $featured=$row2['featured'];
                    $active=$row2['active'];
                }
                else
                {
                    //redirect to manage food with message
                    $_SESSION['no-food-found']="<div class='error'>Food not found</div>";
                    header('location:'.SITEURL.'admin/manage-food.php');
                }
            }
            else
            {
                //redirect to manage food
                header('location:'.SITEURL.'admin/manage-food.php');
            }

        ?>

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">

                <tr>
                    <td>Title: </td>
                    <td><input type="text" name="title" value="<?php echo $title; ?>"></td>
                </tr>

                <tr>
                    <td>Description: </td>
                    <td>
                        <textarea name="description"cols="40" rows="5"><?php echo $description; ?></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Price: </td>
                    <td><input type="number" name="price" value="<?php echo $price; ?>"> ₹</td>
                </tr>

                <tr>
                    <td>Current Image: </td>
                    <td>
                        <?php 
                            if($current_image!="")
                            {
                                //display the image
                                ?>
                                <img src="<?php echo SITEURL; ?>images/food/<?php echo $current_image; ?>" width=' 75px'>
                                <?php
                            }
                            else
                            {
                                //display message
                                echo "<div class='error'>Image not available</div>";
                            }
                        ?>
                    </td>
                </tr>

                <tr>
                    <td>New Image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                    
                    <tr>
                        <td>Category : </td>
                        <td>
                            <select name="category"><?php
                                //to display categories from database
                                //1.create sql to get all active categories from database
                                $sql="SELECT * FROM tbl_category WHERE active='Yes'";
                                //execute query
                                $res=mysqli_query($conn,$sql);
                                //count rows to check whether we have categories or not
                                $count=mysqli_num_rows($res);
                                //if count is greater than zero,then we have categories
                                if($count>0)
                                {
                                    //we have categories
                                    while($row=mysqli_fetch_assoc($res))
                                    {
                                        //get the details of category
                                        $category_id=$row['id'];
                                        $category_title=$row['title'];
                                        //2.Display in dropdown
                                        ?><option <?php if($current_category==$category_id){echo "selected";} ?> value="<?php echo $category_id; ?>"><?php echo $category_title; ?></option><?php
                                    }
                                }
                                else
                                {
                                    //no categories
                                    ?><option value="0">No Categories</option><?php
                                }
                            ?></select>
                        </td>
                    </tr>

                <tr>
                    <td>Featured: </td>
                    <td>
                        <input <?php if($featured=="Yes") {echo "checked";} ?> type="radio" name="featured" value="Yes"> Yes / 

                        <input <?php if($featured=="No") {echo "checked";} ?> type="radio" name="featured" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td>Active: </td>
                    <td>
                        <input <?php if($active=="Yes") {echo "checked";} ?> type="radio" name="active" value="Yes"> Yes / 

                        <input <?php if($active=="No") {echo "checked";} ?> type="radio" name="active" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update Food" class="btn-secondary">
                    </td>
                </tr>

            </table>
        </form>

        <?php
            if(isset($_POST['submit']))
            {
                //get all values from form
                $id=$_POST['id'];
                $title=$_POST['title'];
                $description=$_POST['description'];
                $price=$_POST['price'];
                $current_image=$_POST['current_image'];
                $category=$_POST['category'];
                $featured=$_POST['featured'];
                $active=$_POST['active'];

                //updating new image if selected
                //check whether new image is selected or not
                if(isset($_FILES['image']['name']))
                {
                    //get the image datails
                    $new_image=$_FILES['image']['name'];

                    //check whether the image is available or not
                    if($new_image!="")
                    {
                        //Image available

                        //A.upload the new image

                        //auto renaming the image
                        //get the extension of our image (like: jpg,png,gif....) eg:"food1.jpg"
                        $ext=end(explode('.',$new_image));

                        //rename the image 
                        $new_image="Food_Name_".rand(0000,9999).'.'.$ext; //new image eg:"Food_Name_834.jpg"

                        $source_path=$_FILES['image']['tmp_name'];

                        $destination_path="../images/food/".$new_image;

                        //upload the image
                        $upload = move_uploaded_file($source_path,$destination_path);

                        //check whether the image is uploaded or not
                        //and if the image is not uploaded ,then stop the process and redirect with error message
                        if($upload==false)
                        {
                            //set message
                            $_SESSION['upload']="<div class='error'>Failed to upload Image</div>";
                            //redirect to add-food page 
                            header('location:'.SITEURL.'admin/manage-food.php');
                            //stop the process
                            die();
                        }

                        //B.remove the current image if available
                        if($current_image!="")
                        {
                            $remove_path="../images/food/".$current_image;
                            $remove=unlink($remove_path);

                            //check whether image is removed or not
                            //if failed to remove then display the message and stop process
                            if($remove==false)
                            {
                                //failed to remove the image 
                                $_SESSION['failed-to-remove']="<div class='error'>Failed to remove current image</div>";
                                header('location:'.SITEURL.'admin/manage-food.php');
                                die();//stop the process
                            }
                        }
                        
                    }
                    else
                    {
                        $new_image=$current_image;
                    }
                }
                else
                {
                    $new_image=$current_image;
                }

                //update the database
                $sql3="UPDATE tbl_food SET 
                    title='$title',
                    description='$description',
                    price=$price,
                    image_name='$new_image',
                    category_id='$category',
                    featured='$featured',
                    active='$active' 
                    WHERE id=$id
                ";

                //execute query
                $res3=mysqli_query($conn,$sql3);

                //redirect to manage food with message
                //Check whether executed or not
                if($res3==true)
                {
                    //food updated
                    $_SESSION['update']="<div class='success'>Food updated successfully</div>";
                    header('location:'.SITEURL.'admin/manage-food.php');
                }
                else
                {
                    //failed to update food
                    $_SESSION['update']="<div class='error'>Failed to update Food</div>";
                    header('location:'.SITEURL.'admin/manage-food.php');
                }
            }
        ?>

    </div>
</div>

<?php include('partials/footer.php'); ?>