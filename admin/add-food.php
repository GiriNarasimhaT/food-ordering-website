<?php include('partials/menu.php');?>
    <div class="main-content">
        <div class="wrapper">
            <h1>Add Food</h1>
            <br><br>
            <?php
                if(isset($_SESSION['upload']))
                {
                    echo $_SESSION['upload'];  //To Display Session Message
                    unset($_SESSION['upload']); //Removing Session Message
                    header('Refresh: 2; URL=http://localhost/food-order/admin/add-food.php');
                }
            ?>
            <br><br>
            <form action="" method="POST" enctype="multipart/form-data">
                <table class="tbl-30">
                    <tr>
                        <td>Title : </td>
                        <td>
                            <input type="text" name="title" placeholder=" Enter Food title">
                        </td>
                    </tr>

                    <tr>
                        <td>Description : </td>
                        <td>
                            <textarea name="description"cols="40" rows="5" placeholder=" Description of the food" ></textarea>
                        </td>
                    </tr>

                    <tr>
                        <td>Price : </td>
                        <td><input type="number" name="price" > ₹</td>
                    </tr>

                    <tr>
                        <td>Add Image : </td>
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
                                        $id=$row['id'];
                                        $title=$row['title'];
                                        //2.Display in dropdown
                                        ?><option value="<?php echo $id; ?>"><?php echo $title; ?></option><?php
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
                        <td>Featured : </td>
                        <td>
                            <input type="radio" name="featured" value="Yes"> Yes / 
                            <input type="radio" name="featured" value="No"> No
                        </td>
                    </tr>

                    <tr>
                        <td>Active : </td>
                        <td>
                            <input type="radio" name="active" value="Yes"> Yes / 
                            <input type="radio" name="active" value="No"> No
                        </td>
                    </tr>
                    
                    <tr>
                        <td colspan="2">
                            <input type="submit" name="submit" value="Add Food" class="btn-secondary">
                        </td>
                    </tr>
                </table>
            </form>

            <?php
                //check whether button is clicked
                if(isset($_POST['submit']))
                {
                    //Add food to database
                    //1.create the data from form
                    $title=$_POST['title'];
                    $description=$_POST['description'];
                    $price=$_POST['price'];
                    $category=$_POST['category'];

                    //check featured and active are set or not
                    if(isset($_POST['featured']))
                    {
                        $featured=$_POST['featured'];
                    }
                    else
                    {
                        $featured="No";
                    }

                    if(isset($_POST['active']))
                    {
                        $active=$_POST['active'];
                    }
                    else
                    {
                        $active="No";
                    }

                    //2.upload image if selected
                    //check whether the select image is clicked and upload only when selected
                    if(isset($_FILES['image']['name']))
                    {
                        //get details
                        $image_name=$_FILES['image']['name'];

                        //check whether image is selected
                        if($image_name!="")
                        {
                            //image selected
                            //A.rename image
                            //get extension (ex:jpeg,png...)
                            $ext = end(explode('.', $image_name));

                            //create new name for image
                            $image_name="Food-Name-".rand(0000,9999).".".$ext; //Ex: Food-Name-657.jpg

                            //B.upload the image
                            //get the source and destination paths

                            //source path is current location of the image
                            $src=$_FILES['image']['tmp_name'];

                            //destination path
                            $dst="../images/food/".$image_name;

                            //upload image 
                            $upload=move_uploaded_file($src, $dst);

                            //check whether image updated
                            if($upload==false)
                            {
                                //Failed to upload image
                                //redirect to add food page with message
                                $_SESSION['upload']="<div class='error'>Failed to upload image</div>";
                                header('location:'.SITEURL.'admin/add-food.php');
                                //stop the process
                                die();
                            }
                        }
                    }
                    else
                    {
                        $image_name="";
                    }
                    

                    //3.insert into database
                    //sql query
                    //note:for price no single quotes because it is numerical value
                    $sql2="INSERT INTO tbl_food SET
                        title='$title',
                        description='$description',
                        price=$price,
                        image_name='$image_name',
                        category_id='$category',
                        featured='$featured',
                        active='$active'
                    ";

                    //execute
                    $res2=mysqli_query($conn, $sql2);

                    //check whether data is inserted
                    //4.redirect with message to manage food page
                    if($res2==true)
                    {
                        //data inserted
                        $_SESSION['add']="<div class='success'>Food added successfully</div>";
                        header('location:'.SITEURL.'admin/manage-food.php');
                    }
                    else
                    {
                        //failed to insert data
                        $_SESSION['add']="<div class='error'>Failed to add Food</div>";
                        header('location:'.SITEURL.'admin/manage-food.php');
                    }

                }
            ?>
        </div>
    </div>
<?php include('partials\footer.php');?>