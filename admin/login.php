<?php include('../config/constants.php'); ?>

<html>
    <head>
        <title>Login - Food Order System</title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>

    <body>
        
        <div class="login">
            <h1 class="text-center">Login</h1>
            <br>

            <?php 
            
                if(isset($_SESSION['login']))
                {
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }

                if(isset($_SESSION['no-login-message']))
                {
                    echo $_SESSION['no-login-message'];
                    unset($_SESSION['no-login-message']);
                }

            ?>

            <br>

            <!--Login form starts here-->

            <form action="" method="POST" class="text-center">
            Username: 
            <input type="text" name="username" placeholder="Enter Username">
            <br><br>
            Password: 
            <input type="password" name="password" placeholder="Enter Password">
            <br><br>
            <input type="submit" name="submit" value="Login" class="btn-primary">
            <br><br>
            </form>

            <!--Login form ends here-->

        </div>

    </body>
</html>

<?php 

//check whether the submit button is clicked
if(isset($_POST['submit']))
{
    //progress for login
    //get the data from login form
    $username=$_POST['username'];
    $password=md5($_POST['password']);
    //sql to check whether user exist or not
    $sql="SELECT * FROM tbl_admin WHERE username='$username' AND password='$password' ";

    //execute query
    $res = mysqli_query($conn, $sql);

    //count rows to check whether the user exist or not
    $count=mysqli_num_rows($res);

    if($count==1)
    {
        //user available login success
        //$_SESSION['login']="<div class='success'>Login Successfull</div>";
        $_SESSION['user']=$username; //to chech whether user is loggedin or not and logout will unsets this session.

        //redirect to home page
        header('location:'.SITEURL.'admin/');
    }
    else
    {
        //user not available login faied
        $_SESSION['login']="<div class='error text-center'>Incorrect Credentials</div>";
        //redirect to home page
        header('location:'.SITEURL.'admin/login.php');
    }

}


?>