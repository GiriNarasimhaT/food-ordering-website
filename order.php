<?php include('partials-front/menu.php'); ?>

    <?php
        //check whether food id is set or not
        if(isset($_GET['food_id']))
        {
            //get the details of that food_id
            $food_id=$_GET['food_id'];

            $sql="SELECT * FROM tbl_food WHERE id=$food_id";
            //execute
            $res=mysqli_query($conn,$sql);
            //count rows
            $count=mysqli_num_rows($res);
            //check data is available
            if($count==1)
            {
                //we have data
                $row=mysqli_fetch_assoc($res);

                $title=$row['title'];
                $price=$row['price'];
                $image_name=$row['image_name'];
            }
            else
            {
                //redirect to home page
                header('location:'.SITEURL);
            }
        }
        else
        {
            //Redirect to homepage
            header('location:'.SITEURL);
        }
    ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-order">
        <div class="container">
            
            <h2 class="text-center text-white">Fill this form to confirm your order</h2>

            <form action="" method="POST" class="order">
                <fieldset>
                    <legend class="text-white">Selected Food</legend>

                    <div class="food-menu-img">
                        <?php
                            //check for image
                            if($image_name=="")
                            {
                                ?>
                                    <img src="<?php echo SITEURL; ?>images/noimage.jpg" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                                <?php
                            }
                            else
                            {
                                ?>
                                    <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                                <?php
                            }
                        ?>
                    </div>
    
                    <div class="food-menu-desc text-white">
                        <h3><?php echo $title; ?></h3>
                        <input type="hidden" name="food" value=<?php echo $title; ?>>

                        <p class="food-price">₹ <?php echo $price; ?></p>
                        <input type="hidden" name="price" value=<?php echo $price; ?>>

                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>
                    </div>

                </fieldset>
                
                <fieldset>
                    <legend class="text-white">Delivery Details</legend>
                    <div class="order-label text-white">Full Name</div>
                    <input type="text" name="full-name" placeholder="Enter your name" class="input-responsive" required>

                    <div class="order-label text-white">Phone Number</div>
                    <input type="tel" name="contact" placeholder="Enter your phone number" class="input-responsive" required>

                    <div class="order-label text-white">Email</div>
                    <input type="email" name="email" placeholder="Enter your email" class="input-responsive" required>

                    <div class="order-label text-white">Address</div>
                    <textarea name="address" rows="10" placeholder="Enter your address" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>

            </form>

            <?php
            
                //check button clicked
                if(isset($_POST['submit']))
                {
                    //get details from form
                    $food=$_POST['food'];
                    $price=$_POST['price'];
                    $qty=$_POST['qty'];

                    $total=$price * $qty;

                    $order_date=date("Y-m-d h:i:sa");
                    $status= "Ordered";
                    $customer_name=$_POST['full-name'];
                    $customer_contact=$_POST['contact'];
                    $customer_email=$_POST['email'];
                    $customer_address=$_POST['address'];


                    //save the order in database

                    $sql2="INSERT INTO tbl_order(food,price,qty,total,order_date,status,customer_id)
                        VALUES('$food',$price,$qty,$total,'$order_date','$status',(SELECT customer_id FROM tbl_customer WHERE customer_email='$customer_email'))";


                    $sql3="INSERT INTO tbl_customer SET
                        customer_name='$customer_name',
                        customer_contact='$customer_contact',
                        customer_email='$customer_email',
                        customer_address='$customer_address'
                    ";


                    //execute
                    $res3=mysqli_query($conn,$sql3);

                    $res2=mysqli_query($conn,$sql2);

                    

                    if(($res2 AND $res3)==true)
                    {
                            //order saved
                            $_SESSION['order']="<div class='success text-center'>Order placed Successfully</div>";
                            header('location:'.SITEURL);
                    }
                    else
                    {
                        $_SESSION['order']="<div class='error text-center'>Failed to place Order</div>";
                        header('location:'.SITEURL);
                    }

                }
            
            ?>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

<?php include('partials-front/footer.php'); ?>