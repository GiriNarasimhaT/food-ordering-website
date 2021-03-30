<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>

        <br><br>

        <?php
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];  //To Display Session Message
                unset($_SESSION['add']); //Removing Session Message
            }
        ?>

        <form action="" method="POST">

            <table class="tbl-30">
                <tr>
                    <td>Full Name : </td>
                    <td><input type="text" name="full_name" placeholder=" Enter name"></td>
                </tr>

                <tr>
                    <td>Username : </td>
                    <td><input type="text" name="username" placeholder=" Enter username"></td>
                </tr>

                <tr>
                    <td>Password : </td>
                    <td><input type="password" name="password" placeholder=" Enter your password"></td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                    </td>
                </tr>

            </table>

        </form>
    </div>
</div>

<?php include('partials\footer.php'); ?>

<?php
    //Process the values from form  and save it in database

    //Checks whether the submit button is clicked or not
    
    if(isset($_POST['submit']))
    {
        //Button clicked

        //Get the data from the form
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];
        $password = md5($_POST['password']); //md5 - Password Encryption

        //SQL query to Save the data into database
        $sql ="INSERT INTO tbl_admin SET
        full_name='$full_name',
        username='$username',
        password='$password'
        ";

        //Execute Query and save data in Database
        $res = mysqli_query($conn, $sql) or die(mysqli_error());

        //check whether the (query is executed) data is inserted or not and display appropriate message
        if($res==TRUE)
        {
            //Data inserted
            //create a session variable to display message
            $_SESSION['add'] = "<div class='success'>Admin Added Successfully<?div>";
            //Redirect page Manage Admin
            header("location:".SITEURL.'admin/manage-admin.php');
        }
        else
        {
            //Data not inserted(Failed to add Admin to Database)
            //create a session variable to display message
            $_SESSION['add'] = "<div class='error'>Failed to Add Admin<?div>";
            //Redirect page Add Admin
            header("location:".SITEURL.'admin/add-admin.php');
        }
    }

?>