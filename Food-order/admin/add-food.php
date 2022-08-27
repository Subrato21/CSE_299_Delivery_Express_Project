<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Food<h1>
        <br>

        <?php 

                if(isset($_SESSION['upload']))//Cheking whether the Session is Set or Not
                {
                    echo ($_SESSION['upload']);//Displaying the Session Message
                    unset($_SESSION['upload']); //Remove Session Message
                }
        ?>

        <br> <br>

        <!-- Add Category Form Starts -->
        <form action="" method="Post" enctype="multipart/form-data">

        <table class="tbl-30"> 
            <tr>
                <td>Title: </td>
                <td>
                    <input type="text" name="title" placeholder="Food Title">
                </td>
            </tr>

            <tr>
                <td>Description: </td>
                <td>
                    <textarea name="description"  cols="30" rows="5" placeholder="Add description of the food"></textarea>
                </td>
            </tr>

            <tr>
                <td>Price: </td>
                <td>
                    <input type="number" name="price">
                </td>
            </tr>

            <tr>
                <td>Select Image: </td>
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
                                    $id = $row['id'];
                                    $title = $row['title'];

                                    ?>
                                    <!--Display on Dropdown -->
                                    <option value="<?php echo $id; ?>"><?php echo $title; ?></option>

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
            </tr>

                    <tr>
                        <td>Featured: </td>
                        <td>
                            <input type="radio" name="featured" value="Yes">Yes
                            <input type="radio" name="featured" value="No">No
                        </td>
                    </tr>

                    <tr>
                        <td>Active: </td>
                        <td>
                            <input type="radio" name="active" value="Yes">Yes
                            <input type="radio" name="active" value="No">No
                        </td>
                    </tr>

                    <tr>
                            <td colspan="2">
                            <input type="submit" name="submit" value="Add Food" class="btn-secondary"></td>
                            </td>
                    </tr>

            </table>

        </form>
        <!-- Add Category form ends -->

        <?php

        //Check whether the submit Button is clicked or not
        if(isset($_POST['submit']))

        {
                //echo "Clicked";
                //1.Get the value from form
                $title = $_POST['title'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $category = $_POST['category'];

                //Check whether Radio input button, we need to check whether the button is selected or not
                if(isset($_POST['featured']))
                {
                    //Get the value from form
                    $featured = $_POST['featured'];

                }

                else
                {
                    //Setting the defaulted Value
                    $featured = "No";
                }

                if(isset($_POST['active']))
                {
                    //Get the value from form
                    $active = $_POST['active'];

                }

                else
                {
                    //Setting the defaulted Value
                    $active = "No";
                }

                //2. Upload the Image if selected
                 //Check whether image is selected or not and upload the image only if the image is selected
                 if(isset($_FILES['image']['name']))
                 {
                     //Upload the Image
                     //To upload image name, source path and destination path
                     $image_name = $_FILES['image']['name'];
 
                     //Check whether image is selected or not and upload image only if the image is selected
                     if($image_name != "")
                     {
 
                         //A. Rename the image
                         //Get the Extension of our image(jpn,png,gif, etc) Ex: "specialfood1.jpg" // e.g Food_Category_834.jpg
                         $ext = end(explode ('.', $image_name));
 
                         //Auto Rename the Image
                         $image_name = "Food_Name_".rand(000, 999).'.'.$ext; //Create new image name
 
                         $src = $_FILES['image']['tmp_name'];
                         $dst = "../images/food/".$image_name;
 
                         //B. Upload the Image
                         $upload = move_uploaded_file($src, $dst);
 
                         //Check whether the image is uploaded or not
                         //If the image is not uploaded then we will stop the process and redirect with error message
                         if($upload==false)
                         {
 
                             //Set message
                             $_SESSION['upload'] = '<div class="error">Failed to Upload Image</div>';
                             //Redirect Page to Add Food Page
                             header("location: ".SITEURL.'admin/add-food.php');
                             //Stop the process
                             die();
 
                         }
 
                     }
 
                 }
                 else
                 {
                     //Don't Upload the Image and set the Image name value blank
                     $image_name="";
                 }

                //3.Insert into Database

                //Create a SQL Query to Save Add Food
                $sql2 = "INSERT INTO tbl_food SET
                title = '$title',
                description = '$description',
                price = $price,
                image_name='$image_name',
                category_id = $category,
                featured='$featured',
                active='$active'
                ";

                //4. Executed the Query and Save in Database
                $res2 = mysqli_query($conn,$sql2);

                //Check whether the query is executed or not and data added or not
                if($res2==true)
                {

                    //Query Execute and Food Added
                    //Create a Session Variable to Display Message
                    $_SESSION['add']= '<div class="ok">Food Added Successfully</div>';
            
                    //Redirect Page to Manage food
                    echo "<script> window.location.href='manage-food.php';</script>";

                }
                else
                {

                    //Failed to Add Catgeory
                    //Create a Session Variable to Display Message
                    $_SESSION['add']= '<div class="error">Failed to Add Food</div>';
            
                    //Redirect Page to manage category
                    header("location: ".SITEURL.'admin/manage-food.php');

                }
               
            

        }


        ?>

            
    </div>
</div>


<?php include('partials/footer.php'); ?>


