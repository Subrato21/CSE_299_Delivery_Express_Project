<?php include('partials/menu.php'); ?>


        <div class="main-content">
            <div class="Wrapper">
                <h1>Update Food</h1>

                <br>

                <?php

            //Check whether the id is set or not
            if(isset($_GET['id']))
            {
                //Get the ID and all other deatils
                //echo "Getting the Data";
                $id = $_GET['id'];
                //Create SQL query to get all other details
                $sql2 = "SELECT * FROM tbl_food WHERE id=$id";

                //Execute the query
                $res2 = mysqli_query($conn,$sql2);

                //Count the rows to check whether the id is valid or not
                $count = mysqli_num_rows($res2);

                    //Get all the data
                    $row2 = mysqli_fetch_assoc($res2);

                    //Get Individual value
                    $title = $row2['title'];
                    $description = $row2['description'];
                    $price = $row2['price'];
                    $current_image = $row2['image_name'];
                    $current_category = $row2['category_id'];
                    $featured = $row2['featured'];
                    $active = $row2['active'];

            }
            else
            {
                //Redirected to manage food
                header('location:'.SITEURL.'admin/manage-food.php');
            }

        ?>

            <form action="" method="POST" enctype="multipart/form-data">
                <table class="tbl-30">

                    <tr> 
                        <td>Title: </td>
                        <td>
                        <input type="text" name="title" value="<?php echo $title; ?>">
                        </td>
                    </tr>

                    <tr>
                        <td>Description: </td>
                        <td>
                            <textarea name="description"  cols="30" rows="5" ><?php echo $description; ?> </textarea>
                        </td>
                    </tr>

                    <tr>
                        <td>Price: </td>
                        <td>
                            <input type="number" name="price" value="<?php echo $price; ?>">
                        </td>
                    </tr>

                    <tr> 
                        <td>Current Image: </td>
                            <td>
                                <?php

                                    if($current_image != "")
                                    {
                                        //Display the Image
                                        
                                        ?>

                                        <img src="<?php echo SITEURL; ?>images/food/<?php echo $current_image; ?>"width="250px">

                                        <?php
                                    }
                                    else
                                    {
                                        //Display error message with Image is not available
                                        echo "<div class='error'>Image is not Added.</div>";
                                    }

                                ?>
                        </td>
                    </tr>

                    <tr>
                        <td>Select New Image: </td>
                        <td>
                            <input type="file" name="image">
                        </td>
                    </tr>

                <tr>
                    <td>Category: </td>
                    <td>
                        <select name="category">

                        <?php 
                        
                            //Create PHP code to display category from database
                            //1.Create SQL to Get all Active Category from Database
                            $sql = "SELECT * FROM tbl_category WHERE active='Yes'";

                            //Executing Query
                            $res = mysqli_query($conn,$sql);

                            //count rows to check whether we have categories or not
                            $count = mysqli_num_rows($res);

                            //If count is greater then 0 then we have categories else we don't
                            if($count>0)
                            {
                                //We have categories
                                while($row=mysqli_fetch_assoc($res))
                                {
                                    //Get the details of Categories
                                    $category_id = $row['id'];
                                    $category_title = $row['title'];

                                    ?>
                                    <!--Display on Dropdown -->
                                    <option <?php if($current_category==$category_id){echo "selected";} ?> value="<?php echo $category_id; ?>"><?php echo $category_title; ?></option>

                                    <?php
                                }
                            }
                            else
                            {
                                //we don't have any category

                                ?>

                                <option value="0">No Category Found</option>

                                <?php

                            }
                            
                        ?>

                        </select>
                    </td>


                            <tr> 
                                <td>Featured: </td>
                                <td>
                                    <input <?php if($featured=="Yes"){ echo"checked"; }?> type="radio" name="featured" value="Yes">Yes
                                    
                                    <input <?php if($featured=="No"){ echo"checked"; }?> type="radio" name="featured" value="No">No
                                </td>
                            </tr>

                            <tr> 
                                <td>Active: </td>
                                <td>
                                    <input <?php if($active=="Yes"){ echo"checked"; }?> type="radio" name="active" value="Yes">Yes
                                    
                                    <input <?php if($active=="No"){ echo"checked"; }?> type="radio" name="active" value="No">No
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <input type="hidden" name="current_image" value="<?php echo $current_image;?>">
                                    <input type="hidden" name="id" value="<?php echo $id;?>">

                                    <input type="submit" name="submit" value="Update Food" class="btn-secondary"></td>   
                                </td> 
                            </tr>

        </table>
    </form>

    <?php
    

            if(isset($_POST['submit']))
            {
                //echo "clicked";
                //1.Get all the values from our form
                
                $id = $_POST['id'];
                $title = $_POST['title'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $current_image = $_POST['current_image'];
                $category = $_POST['category'];

                $featured = $_POST['featured'];
                $active = $_POST['active'];

                //2.Updating New Image if selected
                //Check whether the image is selected or not
                if(isset($_FILES['image']['name']))
                {
                    //Get the Image Details
                    $image_name = $_FILES['image']['name'];

                    //Check whether the image is available or not
                    if($image_name != "")
                    {
                        //Image Available
                        //A. Upload the new image

                        //Auto Rename our image
                        //Get the Extension of our image(jpn,png,gif, etc) Ex: "specialfood1.jpg" // e.g Food_Category_834.jpg
                        $ext = end(explode ('.', $image_name));

                        //Rename the Image
                        $image_name = "Food_Name_".rand(000, 999).'.'.$ext;

                        $source_path = $_FILES['image']['tmp_name'];
                        $destination_path = "../images/food/".$image_name;

                        //Finally Upload the Image
                        $upload = move_uploaded_file($source_path, $destination_path);

                        //Check whether the image is uploaded or not
                        //If the image is not uploaded then we will stop the process and redirect with error message
                        if($upload==false)
                        {

                            //Set message
                            $_SESSION['upload'] = '<div class="error">Failed to Upload New Image</div>';
                            //Redirect Page to Manage Category Page
                            header("location: ".SITEURL.'admin/manage-food.php');
                            //Stop the process
                            die();

                        }

                        //B. Remove the current image if available
                        if($current_image !="")
                        {

                            $remove_path = "../images/food/".$current_image;
                            
                            $remove = unlink($remove_path);

                            //Check whether the image is removed or not
                            if($remove==false)
                            {
                                //Failed to remove image
                                $_SESSION['remove-failed'] = '<div class="error">Failed to remove current Image</div>';
                                //Redirect Page to Manage Category Page
                                header('location: '.SITEURL.'admin/manage-food.php');
                                //Stop the process
                                die();
                            }

                        }
                        
                        
                    }
                    else
                    {

                        $image_name = $current_image;//image name will not change it will remain same

                    }
                }
                else
                {
                    $image_name = $current_image;
                }

                //4. Update the database
                $sql3 = "UPDATE tbl_food SET
                title = '$title',
                description = '$description',
                price = $price,
                image_name = '$image_name',
                category_id = '$category',
                featured = '$featured',
                active = '$active'
                WHERE id=$id
                ";

                //Execute the query
                $res3 = mysqli_query($conn,$sql3);

                //4. Redirect to manage category with message
                //Check whether the Query is executed or not
                if($res3==true)
                {
                    //Category Updated
                    $_SESSION['update'] = '<div class="ok">Food Updated Sucessfully.</div>';
                    //Redirected to Manage Category Page
                    //header('location:'.SITEURL.'admin/manage-food.php');
                    echo "<script> window.location.href='manage-food.php';</script>";
                    
    
                }
                else
                {
                    //Failed to Update Category.
                    $_SESSION['update'] = '<div class="error"> Failed to Update Food.</div>';
                    //Redirected to Manage Category. Page
                    header('location:'.SITEURL.'admin/manage-food.php');
    
                }

            }            
                        
    ?>

    </div>
</div>

<?php include('partials/footer.php'); ?>