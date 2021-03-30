<?php include('partials-front/menu.php'); ?>

    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>

            <?php
                //sql query to display categoriess from database which are active
                $sql="SELECT * FROM tbl_category WHERE active='Yes'";
                //execute
                $res=mysqli_query($conn,$sql);
                //count rows to check category available or not
                $count=mysqli_num_rows($res);

                if($count>0)
                {
                    //categories are available
                    while($row=mysqli_fetch_assoc($res))
                    {
                        //get values like title,imagename,id
                        $id=$row['id'];
                        $title=$row['title'];
                        $image_name=$row['image_name'];

                        ?><a href="<?php echo SITEURL; ?>category-foods.php?category_id=<?php echo $id;?>">
                            <div class="box-3 float-container">
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
                                        ?><img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>"  class="img-responsive img-curve">
                                        <?php
                                    }
                                ?>

                                <h3 class="float-text text-white"><?php echo $title; ?></h3>
                            </div>
                        </a><?php
                    }
                }
                else
                {
                    //categories not available
                    echo "<div class='error'>Categories unavailable</div>";
                }
            ?>

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->

<?php include('partials-front/footer.php'); ?>