<?php include('partials/menu.php'); ?>

        <!-- Main Contain Section Starts -->
        <div class="main-content">
            <div class="wrapper">
                <h1>Manage Admin</h1>

                <br>

                <?php
                    if(isset($_SESSION['add']))
                    {
                        echo $_SESSION['add'];  //To Display Session Message
                        unset($_SESSION['add']); //Removing Session Message
                        header('Refresh: 2; URL=http://localhost/food-order/admin/manage-admin.php');
                    }

                    if(isset($_SESSION['delete']))
                    {
                        echo $_SESSION['delete'];  //To Display Session Message
                        unset($_SESSION['delete']); //Removing Session Message
                        header('Refresh: 2; URL=http://localhost/food-order/admin/manage-admin.php');
                    }

                    if(isset($_SESSION['update']))
                    {
                        echo $_SESSION['update'];  //To Display Session Message
                        unset($_SESSION['update']); //Removing Session Message
                        header('Refresh: 2; URL=http://localhost/food-order/admin/manage-admin.php');
                    }

                    if(isset($_SESSION['user-not-found']))
                    {
                        echo $_SESSION['user-not-found'];  //To Display Session Message
                        unset($_SESSION['user-not-found']); //Removing Session Message
                        header('Refresh: 2; URL=http://localhost/food-order/admin/manage-admin.php');
                    }

                    if(isset($_SESSION['pwd-not-match']))
                    {
                        echo $_SESSION['pwd-not-match'];  //To Display Session Message
                        unset($_SESSION['pwd-not-match']); //Removing Session Message
                        header('Refresh: 2; URL=http://localhost/food-order/admin/manage-admin.php');
                    }

                    if(isset($_SESSION['change-pwd']))
                    {
                        echo $_SESSION['change-pwd'];  //To Display Session Message
                        unset($_SESSION['change-pwd']); //Removing Session Message
                        header('Refresh: 2; URL=http://localhost/food-order/admin/manage-admin.php');
                    }

                ?>

                <br><br><br >

                <!-- Button to Add Admin -->
                <a href="add-admin.php" class="btn-primary">Add New Admin</a>

                <br /><br /><br />


                <table class="tbl-full">
                    <tr>
                        <th>S.No.</th>
                        <th>Full Name</th>
                        <th>Username</th>
                        <th>Actions</th>
                    </tr>

                    <?php
                        //Query to get all Admin
                        $sql = 'SELECT * FROM tbl_admin';
                        //Execute the query
                        $res = mysqli_query($conn, $sql);

                        //check wheather the query is executed or not
                        if($res==TRUE)
                        {
                            //Count Rows to check whether we have data in database or not
                            $count = mysqli_num_rows($res); //function to get all the rows in database

                            $sn=1; //create a variable and assign the value

                            //check the num of rows
                            if($count>0)
                            {
                                //we have data in database
                                while($rows=mysqli_fetch_assoc($res))
                                {
                                    //using while loop to get all the from database
                                    //and while loop will run as long as we have data in database

                                    //get individual data
                                    $id=$rows['id'];
                                    $full_name=$rows['full_name'];
                                    $username=$rows['username'];

                                    //Display the values in our table
                                    ?>

                                    <tr>
                                        <td><?php echo $sn++; ?></td>
                                        <td><?php echo $full_name; ?></td>
                                        <td><?php echo $username; ?></td>
                                        <td>
                                            <a href="<?php echo SITEURL; ?>admin/update-password.php?id=<?php echo $id; ?>" class="btn-primary">Change Password</a>
                                            <a href="<?php echo SITEURL; ?>admin/update-admin.php?id=<?php echo $id; ?>" class="btn-secondary">Update</a>
                                            <a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id; ?>" class="btn-danger">Delete</a>
                                        </td>
                                    </tr>

                                    <?php

                                }

                            }
                            else
                            {
                                //we don't have data
                            }
                        }

                    ?>
                </table>

            </div>
        </div>
        <!-- Main Contain Section Ends -->

<?php include('partials\footer.php'); ?>