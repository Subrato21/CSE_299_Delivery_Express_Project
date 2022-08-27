<?php include('partials-front/store-menu.php'); ?>


<?php

    //Check whether id is paased or not
    if(isset($_GET['category_id']))
    {
        //Category id is set and get the id
        $category_id = $_GET['category_id'];
        //Get Category titile based on category id
        $sql = "SELECT title FROM tbl_store_category WHERE id=$category_id";

        //Execute the query
        $res = mysqli_query($conn,$sql);

        //Get the value from database
        $row = mysqli_fetch_assoc($res);

        //Get the Title
        $category_title = $row['title'];
    }
    else
    {
        //Category not paassed
        //Redirected to main page
        header('location:'.SITEURL);
    }

?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <h2>Iteams on <a href="#" class="text-white">"<?php echo $category_title; ?>"</a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Store Menu</h2>
            <?php 
            //Create SQL query to get foods based on Selected category
            $sql2 = "SELECT * FROM tbl_store_food WHERE category_id=$category_id";

            //Execute the query 
            $res2 = mysqli_query($conn,$sql2);

            //Count the rows
            $count2 = mysqli_num_rows($res2);
            //Check whether food is available or not
            if($count2>0)
            {
                //Food is available
                while($row2=mysqli_fetch_assoc($res2))
                {
                    $id = $row2['id'];
                    $title = $row2['title'];
                    $price = $row2['price'];
                    $description = $row2['description'];
                    $image_name = $row2['image_name'];
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
                //Food is not available
                echo"div class='error'>Iteam Is Not Available.</div>";

            }
            
            ?>

    
            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php include('partials-front/store-footer.php'); ?>