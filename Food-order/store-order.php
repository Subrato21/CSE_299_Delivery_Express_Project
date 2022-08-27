<?php include('partials-front/store-menu.php'); ?>

        <?php

        //Check whether food id is set or not
        if(isset($_GET['food_id']))
        {
            //Get the Food and details of the selected food
            $food_id = $_GET['food_id'];

            //Get the details of the selected food
            $sql = "SELECT * FROM tbl_store_food WHERE id=$food_id";
            //Execute the query
            $res = mysqli_query($conn,$sql);

            //Count the rows
            $count = mysqli_num_rows($res);
            //check whether the data is available or not
            if($count==1)
            {
                //We have data
                //Get the data from database
                $row = mysqli_fetch_assoc($res);

                $title = $row['title'];
                $price = $row['price'];
                $image_name = $row['image_name'];
            }
            else
            {
                //food is not available
                //Redirect to home page
                header('location:'.SITEURL);
            }
        }
        else
        {
            //Redirected to homepage
            header('location:'.SITEURL);
        }


        ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search">
        <div class="container">
            
            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

            <form action="" method ="POST" class="order">
                <fieldset>
                    <legend>Selected Iteam</legend>

                    <div class="food-menu-img">
                        <?php

                        //Check whether image is available or not
                        if($image_name=="")
                        {
                            //Display Message
                            echo "<div class='error'>Image is not Available.</div>";
                        }
                        else
                        {
                            //Image is Available
                            ?>

                            <img src="<?php echo SITEURL; ?>images/store-food/<?php echo $image_name; ?>" class="img-responsive img-curve">

                            <?php
                        }

                        ?>

                    </div>
    
                    <div class="food-menu-desc">
                        <h3><?php echo $title; ?></h3>
                        <input type="hidden" name="food" value="<?php echo $title; ?>">

                        <p class="food-price"><?php echo $price; ?>TK</p>
                        <input type="hidden" name="price" value="<?php echo $price; ?>">

                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>
                        
                    </div>

                </fieldset>
                
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="E.g. Subrato" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="E.g. 01xxxxxxxxx" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="E.g. @gmail.com" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>

            </form>

            <?php

                        //Check whether submit button is clicked or not
                        if(isset($_POST['submit']))
                        {
                            //Get all the details from the form 

                            $food = $_POST['food'];
                            $price = $_POST['price'];
                            $qty = $_POST['qty'];

                            $total = $price * $qty; //total=price*qty
                            $order_date = date("Y-m-d h:i:sa"); //Order date

                            $status = "Ordered"; //Ordered,on deliver,delivered,canceled

                            $customer_name = $_POST['full-name'];
                            $customer_contact = $_POST['contact'];
                            $customer_email = $_POST['email'];
                            $customer_address = $_POST['address'];

                            //Save the order in Database
                            //Create SQL to save the data
                            $sql2 ="INSERT INTO tbl_store_order SET
                            food = '$food',
                            price = $price,
                            qty = $qty,
                            total =$total,
                            order_date = '$order_date',
                            status = '$status',
                            customer_name = '$customer_name',
                            customer_contact = '$customer_contact',
                            customer_email = '$customer_email',
                            customer_address = '$customer_address'             
                            
                            ";

                            //Execute the query
                            $res2 =mysqli_query($conn,$sql2);

                            //Check whether query executed or not
                            if($res2==true)
                            {
                                //Query executed and Order Saved
                                $_SESSION['order'] = "<div class='success text-center'>Iteams Ordered Successfully.</div>";
                                //header('location:'.SITEURL);
                                header('location:'.SITEURL.'store-index.php');
                            }
                            else
                            {
                                //Failed to Save order
                                $_SESSION['order'] = "<div class='error text-center'>Iteams Ordered Failed.</div>";
                                //header('location:'.SITEURL);
                                header('location:'.SITEURL.'store-index.php');
                            }


                        }

            ?>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    <?php include('partials-front/store-footer.php'); ?>