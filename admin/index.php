
<?php include('partials/menu.php'); ?>

        <!-- Main Contain Section Starts -->
        <div class="main-content">
            <div class="wrapper">
                <h1>DASH BOARD</h1>

                <br><br><br>

                <div class="col-4 text-center">
                    <?php
                        $sql="SELECT * FROM tbl_category";
                        $res=mysqli_query($conn,$sql);
                        $count=mysqli_num_rows($res);
                    ?>
                    <h1><?php echo $count; ?></h1>
                    <br>
                    Categories
                </div>

                <div class="col-4 text-center">
                    <?php
                        $sql2="SELECT * FROM tbl_food";
                        $res2=mysqli_query($conn,$sql2);
                        $count2=mysqli_num_rows($res2);
                    ?>
                    <h1><?php echo $count2; ?></h1>
                    <br>
                    Food Items
                </div>

                <div class="col-4 text-center">
                    <?php
                        $sql3="SELECT * FROM tbl_order WHERE status = 'Ordered' OR status = 'On Delivery'";
                        $res3=mysqli_query($conn,$sql3);
                        $count3=mysqli_num_rows($res3);
                    ?>
                    <h1><?php echo $count3; ?></h1>
                    <br>
                    Pending Orders
                </div>

                <div class="col-4 text-center">
                    <?php
                        $sql6="SELECT * FROM tbl_order WHERE status = 'Cancelled'";
                        $res6=mysqli_query($conn,$sql6);
                        $count6=mysqli_num_rows($res6);
                    ?>
                    <h1><?php echo $count6; ?></h1>
                    <br>
                    Cancelled Orders
                </div>

                <div class="col-4 text-center">
                    <?php
                        $sql4="SELECT * FROM tbl_order";
                        $res4=mysqli_query($conn,$sql4);
                        $count4=mysqli_num_rows($res4);
                    ?>
                    <h1><?php echo $count4; ?></h1>
                    <br>
                    Total Orders
                </div>
                
                <div class="col-4 text-center">
                    <?php
                        $sql5="SELECT SUM(total) AS Total FROM tbl_order WHERE status='Delivered' ";
                        $res5=mysqli_query($conn,$sql5);

                        $row5=mysqli_fetch_assoc($res5);
                        $Total_Revenue=$row5['Total'];
                    ?>
                    <h1>₹ <?php echo $Total_Revenue; ?></h1>
                    <br>
                    Revenue Generated
                </div>

                <br><br><br><br>

                <div class="clearfix"></div>

            </div>
        </div>
        <!-- Main Contain Section Ends -->

<?php include('partials\footer.php'); ?>