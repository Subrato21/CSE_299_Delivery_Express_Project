<?php include('partials-front/store-menu.php'); ?>

    <!-- Food SEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">

            <?php

                //Get the search keyword
                $search = $_POST['search'];

            ?>
            <h2> <div class="error">Your Searched Iteam</div> <a href="#" class="text-white">"<?php echo $search; ?>"</a></h2>

        </div>
    </section>
    <!-- Food SEARCH Section Ends Here -->



    <!-- Food Menu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Store Menu</h2>

            <?php

            //SQL query to Get foods based on Search Keyword
            $sql = "SELECT * FROM tbl_store_food WHERE title LIKE '%$search%' OR description LIKE '%$search%' ";

            //Execute the query
            $res = mysqli_query($conn,$sql);

            //Count rows
            $count = mysqli_num_rows($res);
            if($count>0)
            {
                //Food Available
                while($row=mysqli_fetch_assoc($res))
                {
                    //Get the deatils
                    $id = $row['id'];
                    $title = $row['title'];
                    $price = $row['price'];
                    $description = $row['description'];
                    $image_name = $row['image_name'];
                    ?>

                    <div class="food-menu-box">
                    <div class="food-menu-img">

                        <?php
                            //Check whether image is available or not
                            if($image_name=="")
                            {
                                //Display Message
                                echo "<div class='error'>Image Is Not Available.</div>";
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
                                <h4><?php echo $title; ?></h4>
                                <p class="food-price"><?php echo $price; ?>TK</p>
                                <p class="food-detail">
                                    <?php echo $description; ?>
                                </p>
                                <br>

                                <a href="<?php echo SITEURL; ?>store-order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
                            </div>
                        </div>


                    <?php
                }
            }
            else
            {
                //Food not available
                echo "<div class='error'>Iteams Not Found.</div>";
            }

            ?>


            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php include('partials-front/store-footer.php'); ?>