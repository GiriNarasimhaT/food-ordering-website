<?php include('partials-front/menu.php'); ?>

    <?php
        //when this page is refreshed using url
        function error_found()
        {
            //redirect to home page
            header("Location: http://localhost/food-order/");
        }
        set_error_handler('error_found');
    ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">

                <?php 
                    //get the search keyword
                    $search=$_POST['search'];
                ?>

            <h2>Showing search results for <a href="#" class="text-white">"<?php echo $search; ?>"</a></h2>
            <form action="<?php echo SITEURL ?>food-search.php" method="POST">
                <input type="search" name="search" value="<?php echo $search; ?>" required>
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
                //sql query to get food based on search
                $sql="SELECT * FROM tbl_food WHERE title LIKE '%$search%' OR description LIKE '%$search%' ";
                //execute
                $res=mysqli_query($conn,$sql);
                //count rows
                $count=mysqli_num_rows($res);

                //check whether food available
                if($count>0)
                {
                    //food available
                    while($row=mysqli_fetch_assoc($res))
                    {
                        //get details
                        $id=$row['id'];
                        $title=$row['title'];
                        $description=$row['description'];
                        $price=$row['price'];
                        $image_name=$row['image_name'];
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

                                    <a href="order.php" class="btn btn-primary">Order Now</a>
                                </div>
                            </div>
                        <?php
                    }
                }
                else
                {
                    //food unavailable
                    ?><div class='error' class='text-center'>No results found</div><?php
                }

            ?>

            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

<?php include('partials-front/footer.php'); ?>