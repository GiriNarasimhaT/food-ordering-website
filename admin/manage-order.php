<?php include('partials/menu.php'); ?>

        <!-- Main Contain Section Starts -->
        <div class="main-content">
            <div class="wrapper">
                <h1>Manage Order</h1>

                <br><br>

                    <?php
                        if(isset($_SESSION['update']))
                        {
                            echo $_SESSION['update'];  //To Display Session Message
                            unset($_SESSION['update']); //Removing Session Message
                            header('Refresh: 2; URL=http://localhost/food-order/admin/manage-order.php');
                        }
                    ?>

                <br><br>

                <table class="tbl-full">
                    <tr>
                        <th>S.No.</th>
                        <th>Food</th>
                        <th>Price</th>
                        <th>Qty</th>
                        <th>Total</th>
                        <th>Order Date</th>
                        <th>Status</th>
                        <th>Customer Name</th>
                        <th>Customer Contact</th>
                        <th>Customer Email</th>
                        <th>Customer Address</th>
                        <th>Actions</th>
                    </tr>

                    <?php

                        //sql query to get all orders from Database
                        $sql="SELECT tbl_order.*,tbl_customer.* FROM tbl_order,tbl_customer WHERE tbl_order.customer_id=tbl_customer.customer_id ORDER BY id DESC";

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
                                $food=$row['food'];
                                $price=$row['price'];
                                $qty=$row['qty'];
                                $total=$row['total'];
                                $order_date=$row['order_date'];
                                $status=$row['status'];
                                $customer_name=$row['customer_name'];
                                $customer_contact=$row['customer_contact'];
                                $customer_email=$row['customer_email'];
                                $customer_address=$row['customer_address'];
                                ?>

                                    <tr>
                                        <td><?php echo $sn++; ?></td>
                                        <td><?php echo $food; ?></td>
                                        <td>₹ <?php echo $price; ?></td>
                                        <td><?php echo $qty; ?></td>
                                        <td>₹ <?php echo $total; ?></td>
                                        <td><?php echo $order_date; ?></td>

                                        <td>
                                            <?php
                                                if($status=="Ordered")
                                                {
                                                    echo "<label style='color: grey;'>$status</label>";
                                                }
                                                elseif($status=="On Delivery")
                                                {
                                                    echo "<label style='color: orange;'>$status</label>";
                                                }
                                                elseif($status=="Delivered")
                                                {
                                                    echo "<label style='color: green;'>$status</label>";
                                                }
                                                elseif($status=="Cancelled")
                                                {
                                                    echo "<label style='color: red;'>$status</label>";
                                                }
                                            ?>
                                        </td>

                                        <td><?php echo $customer_name; ?></td>
                                        <td><?php echo $customer_contact; ?></td>
                                        <td><?php echo $customer_email; ?></td>
                                        <td><?php echo $customer_address; ?></td>
                                        <td>
                                            <a href="<?php echo SITEURL; ?>admin/update-order.php?id=<?php echo $id; ?>" class="btn-secondary">Update</a>
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
                                <td colspan="12" ><div class="error">No Orders Available</div></td>
                            </tr>
                            
                            <?php
                        }

                    ?>

                </table>



            </div>
        </div>
        <!-- Main Contain Section Ends -->

<?php include('partials\footer.php'); ?>