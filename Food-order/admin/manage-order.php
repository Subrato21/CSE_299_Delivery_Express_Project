<?php include ('partials/menu.php'); ?>


    <!--- Main Content Section Starts --->
    <div class="main-content">
        <div class="wrapper">
            <h1> Manage Food Order<h1>
            <br>
            <?php

                if(isset($_SESSION['update']))
                {
                    echo $_SESSION['update'];
                    unset($_SESSION['update']);

                }

            ?>
            <br>

            <table class="tbl-full">
                <tr>
                    <th>Serial Number</th>
                    <th>Food</th>
                    <th>Price</th>
                    <th>Qty</th>
                    <th>Total</th>
                    <th>Order Date</th>
                    <th>Status</th>
                    <th>Customer Name</th>
                    <th>Contact</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Actions</th>
                </tr>
                <?php

                    //Get all the orders from database
                    $sql = "SELECT * FROM tbl_order ORDER BY id DESC";
                    //Execute the Query
                $res = mysqli_query($conn,$sql);

                //Count Rows to check whether we have food or not
                $count = mysqli_num_rows($res);

                //Create Serial Number Variable and Set Default Value as 1
                $sn=1;

                if($count>0)
                {
                    //We have food in Database
                    //Get the Foods from Database and Display
                    while($row=mysqli_fetch_assoc($res))
                    {
                        //get the order values from individual colums
                        $id = $row['id'];
                        $food = $row['food'];
                        $price = $row['price'];
                        $qty = $row['qty'];
                        $total = $row['total'];
                        $order_date = $row['order_date'];
                        $status = $row['status'];
                        $customer_name = $row['customer_name'];
                        $customer_contact = $row['customer_contact'];
                        $customer_address = $row['customer_address'];
                        $customer_email = $row['customer_email'];
                        
                        ?>
                        <tr>
                            <td><?php echo $sn++; ?></td>
                            <td><?php echo $food; ?></td>
                            <td><?php echo $price; ?>TK</td>
                            <td><?php echo $qty; ?></td>
                            <td><?php echo $total; ?></td>
                            <td><?php echo $order_date; ?></td>

                            <td>
                                <?php 

                                    //Ordered On Delivery, delivered,cancelled
                                    if($status=="Ordered")
                                    {
                                        echo"<lable><b>$status</b></label>";
                                    } 
                                    else if($status=="On Delivery")
                                    {
                                        echo"<lable style='color: orange;'><b>$status</b></label>";
                                    }
                                    else if($status=="Delivered")
                                    {
                                        echo"<lable style='color: green;'><b>$status</b></label>";
                                    }
                                    else if($status=="Cancelled")
                                    {
                                        echo"<lable style='color: red;'><b>$status</b></label>";
                                    }  
                                
                                ?>
                            </td>

                            <td><?php echo $customer_name; ?></td>
                            <td><?php echo $customer_contact; ?></td>
                            <td><?php echo $customer_email; ?></td>
                            <td><?php echo $customer_address; ?></td>
                            <td>
                            <a href="<?php echo SITEURL;?>admin/update-order.php?id=<?php echo $id; ?>" class="btn-secondary"> Update Order</a>
                            </td>
    
                        </tr>


                        <?php
                    }
                }
                else
                {
                    //Food not Added in Database
                    echo" <tr><td colspan='12' class='error'>Order Not Added Yet.</td></tr>";
                }



                ?>
                

            </table>

        </div>  

    </div>
    <!--- Main Content Section End --->

    <!--- Footer Section Starts --->

    <?php include('partials/footer.php'); ?>