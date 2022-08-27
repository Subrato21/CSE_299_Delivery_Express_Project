<?php include ('partials/menu.php'); ?>


    <!--- Main Content Section Starts --->
    <div class="main-content">
    <div class="wrapper">
        <h1> Manage Food Category</h1>
        <br>

            <?php 
                if(isset($_SESSION['add']))//Cheking whether the Session is Set or Not
                {
                    echo ($_SESSION['add']);//Displaying the Session Message
                    unset($_SESSION['add']); //Remove Session Message
                }
                if(isset($_SESSION['remove']))//Cheking whether the Session is Set or Not
                {
                    echo ($_SESSION['remove']);//Displaying the Session Message
                    unset($_SESSION['remove']); //Remove Session Message
                }
                if(isset($_SESSION['delete']))
                {
                    echo $_SESSION['delete'];
                    unset($_SESSION['delete']);
                }
                if(isset($_SESSION['no-category-found']))
                {
                    echo $_SESSION['no-category-found'];
                    unset($_SESSION['no-category-found']);
                }
                if(isset($_SESSION['update']))
                {
                    echo $_SESSION['update'];
                    unset($_SESSION['update']);
                }
                if(isset($_SESSION['upload']))
                {
                    echo $_SESSION['upload'];
                    unset($_SESSION['upload']);
                }
                if(isset($_SESSION['failed-remove']))
                {
                    echo $_SESSION['failed-remove'];
                    unset($_SESSION['failed-remove']);
                }
        ?>
        
        <br> <br>
            <!-- Button to Add Admin-->
            <a href="<?php echo SITEURL;?>admin/add-category.php" class="btn-add">Add Category</a>
            <br>
            </br>
            <table class="tbl-full">
                <tr>
                    <th>Serial Number</th>
                    <th>Title</th>
                    <th>Image</th>
                    <th>Features</th>
                    <th>Active</th>
                    <th>Actions</th>
                </tr>

                <?php
                
                //Query to Get all Category from Database
                $sql = "SELECT * FROM tbl_category";

                //Execute Query
                $res = mysqli_query($conn, $sql);

                //Count Rows
                $count = mysqli_num_rows($res);

                //Create Serial Number Variable and assign values as 1
                $sn=1;

                //Check whether we have data in database or not
                if($count>0)
                {

                    //We have data in Database
                    //Get the data and display
                    while($row=mysqli_fetch_assoc($res))
                    {
                        $id = $row['id'];
                        $title = $row['title'];
                        $image_name = $row['image_name'];
                        $featured = $row ['featured'];
                        $active = $row['active'];

                        ?>

                    <tr>
                        <td><?php echo $sn++; ?></td>
                        <td><?php echo $title; ?></td>

                        <td>
                            <?php 
                            
                                //echo $image_name; 
                                //Check whether image name is available or not
                                if($image_name!="")
                                {

                                    //Display the Image
                                    ?>

                                    <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>"width="100px">

                                    <?php

                                }
                                else
                                {

                                    //Display the message
                                    echo"<div class='error'>Image not Added.</div>";
                                }

                            ?>
                        </td>

                        <td><?php echo $featured; ?></td>
                        <td><?php echo $active; ?></td>
                        <td>
                            <a href="<?php echo SITEURL; ?>admin/update-category.php?id=<?php echo $id; ?>" class="btn-secondary"> Update Category</a>
                            <a href="<?php echo SITEURL; ?>admin/delete-category.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger"> Delete Category</a>
                        </td>
                    </tr>

                        <?php
                    }

                }
                else
                {

                    //We don't have the data in Database
                    //We will display the message inside the table
                    ?>
                        <tr> 
                            <td colspan="6"><div class="error">No Category Added.</div> </td>
                        </tr>

                    <?php
                }

                ?>

                

            </table>
    </div> 
</div>

    <!--- Main Content Section End --->

    <!--- Footer Section Starts --->
<?php include('partials/footer.php'); ?>