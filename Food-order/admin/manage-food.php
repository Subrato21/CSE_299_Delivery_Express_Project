<?php include ('partials/menu.php'); ?>


    <!--- Main Content Section Starts --->
    <div class="main-content">
        <div class="wrapper">
            <h1>Manage Food</h1>
            <br>
            </br>
            <!-- Button to Add Admin-->
            <a href="<?php echo SITEURL; ?>admin/add-food.php" class="btn-add">Add Food</a>
            
            <br></br> <br>

            <?php 
                if(isset($_SESSION['add']))//Cheking whether the Session is Set or Not
                {
                    echo ($_SESSION['add']);//Displaying the Session Message
                    unset($_SESSION['add']); //Remove Session Message
                }

                if(isset($_SESSION['delete']))//Cheking whether the Session is Set or Not
                {
                    echo ($_SESSION['delete']);//Displaying the Session Message
                    unset($_SESSION['delete']); //Remove Session Message
                }

                if(isset($_SESSION['upload']))//Cheking whether the Session is Set or Not
                {
                    echo ($_SESSION['upload']);//Displaying the Session Message
                    unset($_SESSION['upload']); //Remove Session Message
                }

                if(isset($_SESSION['unauthrorize']))//Cheking whether the Session is Set or Not
                {
                    echo ($_SESSION['unauthrorize']);//Displaying the Session Message
                    unset($_SESSION['unauthrorize']); //Remove Session Message
                }

                if(isset($_SESSION['update']))//Cheking whether the Session is Set or Not
                {
                    echo ($_SESSION['update']);//Displaying the Session Message
                    unset($_SESSION['update']); //Remove Session Message
                }

            ?>
        <br>

            <table class="tbl-full">
                <tr>
                    <th>Serial Number</th>
                    <th>Title</th>
                    <th>Price</th>
                    <th>Image</th>
                    <th>Featured</th>
                    <th>Active</th>
                    <th>Actions</th>
                </tr>

                <?php

                //Create a SQL Query to Get all the Food
                $sql = "SELECT * FROM tbl_food";

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
                        //get the values from individual colums
                        $id = $row['id'];
                        $title = $row['title'];
                        $price = $row['price'];
                        $image_name = $row['image_name'];
                        $featured = $row['featured'];
                        $active = $row['active'];

                        ?>
                        <tr>
                            <td><?php echo $sn++; ?></td>
                            <td><?php echo $title; ?></td>
                            <td><?php echo $price; ?>TK</td>
                            <td>
                                <?php 
                                
                                //Check whether we have image or not
                                if($image_name=="")
                                {
                                    //we don't have image,display error message
                                    echo "<div class='error'>Image not Added.</div>";
                                }
                                else
                                {
                                    //We have image
                                    ?>

                                    <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>"width="100px">


                                    <?php
                                }
                                
                                
                                ?>
                            </td>
                            <td><?php echo $featured; ?></td>
                            <td><?php echo $active; ?></td>
                            <td>
                            <a href="<?php echo SITEURL; ?>admin/update-food.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-secondary"> Update Food</a>
                            <a href="<?php echo SITEURL; ?>admin/delete-food.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger"> Delete Food</a>
                            </td>
                        </tr>


                        <?php
                    }
                }
                else
                {
                    //Food not Added in Database
                    echo" <tr><td colspan='7' class='error'>Food not Added Yet.</td></tr>";
                }



                ?>

            </table>
        

        </div>  

    </div>
    <!--- Main Content Section End --->

    <!--- Footer Section Starts --->

    <?php include('partials/footer.php'); ?>