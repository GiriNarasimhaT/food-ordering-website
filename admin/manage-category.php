<?php include('partials/menu.php'); ?>

        <!-- Main Contain Section Starts -->
        <div class="main-content">
            <div class="wrapper">
                <h1>Manage Category</h1>

                <br><br>

                <?php
                    if(isset($_SESSION['add']))
                    {
                        echo $_SESSION['add'];  //To Display Session Message
                        unset($_SESSION['add']); //Removing Session Message
                        header('Refresh: 2; URL=http://localhost/food-order/admin/manage-category.php');
                    }
                    if(isset($_SESSION['remove']))
                    {
                        echo $_SESSION['remove'];  //To Display Session Message
                        unset($_SESSION['remove']); //Removing Session Message
                        header('Refresh: 2; URL=http://localhost/food-order/admin/manage-category.php');
                    }
                    if(isset($_SESSION['delete']))
                    {
                        echo $_SESSION['delete'];  //To Display Session Message
                        unset($_SESSION['delete']); //Removing Session Message
                        header('Refresh: 2; URL=http://localhost/food-order/admin/manage-category.php');
                    }
                    if(isset($_SESSION['no-category-found']))
                    {
                        echo $_SESSION['no-category-found'];  //To Display Session Message
                        unset($_SESSION['no-category-found']); //Removing Session Message
                        header('Refresh: 2; URL=http://localhost/food-order/admin/manage-category.php');
                    }
                    if(isset($_SESSION['update']))
                    {
                        echo $_SESSION['update'];  //To Display Session Message
                        unset($_SESSION['update']); //Removing Session Message
                        header('Refresh: 2; URL=http://localhost/food-order/admin/manage-category.php');
                    }
                    if(isset($_SESSION['upload']))
                    {
                        echo $_SESSION['upload'];  //To Display Session Message
                        unset($_SESSION['upload']); //Removing Session Message
                        header('Refresh: 2; URL=http://localhost/food-order/admin/manage-category.php');
                    }
                    if(isset($_SESSION['failed-to-remove']))
                    {
                        echo $_SESSION['failed-to-remove'];  //To Display Session Message
                        unset($_SESSION['failed-to-remove']); //Removing Session Message
                        header('Refresh: 2; URL=http://localhost/food-order/admin/manage-category.php');
                    }
                ?>

                <br><br>


                <!-- Button to Add category -->
                <a href="<?php echo SITEURL; ?>admin/add-category.php" class="btn-primary">Add New category</a>

                <br /><br /><br />


                <table class="tbl-full">
                    <tr>
                        <th>S.No.</th>
                        <th>Title</th>
                        <th>Image</th>
                        <th>Featured</th>
                        <th>Active</th>
                        <th>Actions</th>
                    </tr>

                    <?php

                        //sql query to get all categories from Database
                        $sql="SELECT * FROM tbl_category";

                        //Execut the query
                        $res=mysqli_query($conn, $sql);

                        //count rows
                        $count=mysqli_num_rows($res);

                        //create serial number variable and assign its value
                        $sn=1;

                        //check whether we have data in database or not
                        if($count>0)
                        {
                            //we have data
                            //get data and display
                            while($row=mysqli_fetch_assoc($res))
                            {
                                $id=$row['id'];
                                $title=$row['title'];
                                $image_name=$row['image_name'];
                                $featured=$row['featured'];
                                $active=$row['active'];
                                ?>

                                    <tr>
                                        <td><?php echo $sn++; ?></td>
                                        <td><?php echo $title; ?></td>
                                        <td>
                                            <?php
                                                //check whether image name is available or not
                                                if($image_name!="")
                                                {
                                                    //Display the image
                                                    ?>
                                                        <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" width="75px">
                                                    <?php
                                                }
                                                else
                                                {
                                                    //display message
                                                    echo "<div class='error'>Image not added</div>";
                                                }
                                            ?>
                                        </td>

                                        <td><?php echo $featured; ?></td>
                                        <td><?php echo $active; ?></td>
                                        <td>
                                            <a href="<?php echo SITEURL; ?>admin/update-category.php?id=<?php echo $id; ?>" class="btn-secondary">Update</a>
                                            <a href="<?php echo SITEURL; ?>admin/delete-category.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Delete</a>
                                        </td>
                                    </tr>

                                <?php

                            }
                        }
                        else
                        {
                            //we don't have data
                            //we will display the message inside the table
                            ?>

                            <tr>
                                <td colspan="6" ><div class="error">No Category added</div></td>
                            </tr>
                            
                            <?php
                        }

                    ?>

                </table>

            </div>
        </div>
        <!-- Main Contain Section Ends -->

<?php include('partials\footer.php'); ?>