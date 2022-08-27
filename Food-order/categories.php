<?php include('partials-front/menu.php'); ?>



    <!-- Categories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>

            <?php 
            
            //Create SQL Query to DIsplay Categories from Database
            $sql = "SELECT * FROM tbl_category WHERE active='Yes' ";
            //Execute the query
            $res = mysqli_query($conn,$sql);
            //Count rows to check whether the category is available or not
            $count = mysqli_num_rows($res);

            if($count>0)
            {

                //Category is available
                while($row=mysqli_fetch_assoc($res))
                {
                    //Get the Values like id,title,image_name
                    $id = $row['id'];
                    $title = $row['title'];
                    $image_name = $row['image_name'];
                    ?>

                    <a href="<?php echo SITEURL; ?>category-foods.php?category_id=<?php echo $id; ?>">
                    <div class="box-3 float-container">
                        <?php
                            //Check whether image is available or not
                            if($image_name=="")
                            {
                                //Display Message
                                echo "<div class='error'>Image is not available.</div>";
                            }
                            else
                            {
                                //Image is Available
                                ?>

                                <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="Pizza" class="img-responsive img-curve">

                                <?php
                            }
                        ?>

                        <h3 class="float-text text-white"><?php echo $title; ?></h3>
                    </div>
                    </a>

                    <?php
                }

            }
            else
            {
                //Category not avaialble
                echo"<div class='error'>Category Is Not Found.</div>";
            }
            
            
            ?>



            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->


<?php include('partials-front/footer.php'); ?>