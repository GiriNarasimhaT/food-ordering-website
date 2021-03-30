<?php include('partials-front/menu.php'); ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="<?php echo SITEURL ?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php
                
                //getting food from database that are active
                //SQL query
                $sql2="SELECT * FROM tbl_food WHERE active='Yes'";
                //execute
                $res2=mysqli_query($conn,$sql2);
                //count rows to check food available or not
                $count2=mysqli_num_rows($res2);

                if($count2>0)
                {
                    //food is available
                    while($row2=mysqli_fetch_assoc($res2))
                    {
                        //get values like title,price,desription,imagename,id,
                        $id=$row2['id'];
                        $title=$row2['title'];
                        $price=$row2['price'];
                        $description=$row2['description'];
                        $image_name=$row2['image_name'];
                        ?>

                            <div class="food-menu-box">
                                <div class="food-menu-img">
                                    <?php
                                        //check whether image name is available
                                        if($image_name=="")
                                        {
                                            ?>
                                                <img src="<?php echo SITEURL; ?>images/noimage.jpg" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                                            <?php
                                        }
                                        else
                                        {
                                            //image available
                                            ?><img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>"  class="img-responsive img-curve">
                                            <?php
                                        }
                                    ?>
                                </div>

                                <div class="food-menu-desc">
                                    <h4><?php echo $title; ?></h4>
                                    <p class="food-price">₹ <?php echo $price ?></p>
                                    <p class="food-detail"><?php echo $description ?></p>
                                    <br>

                                    <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
                                </div>
                            </div>

                        <?php
                    }
                }
                else
                {
                    //food not available
                    echo "<div class='error'>Food unavailable</div>";
                }

            ?>
        
            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

<?php include('partials-front/footer.php'); ?>