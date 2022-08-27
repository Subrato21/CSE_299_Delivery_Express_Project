<?php include('partials/menu.php'); ?>


<div class="main-content">
    <div class="Wrapper">
        <h1>Update Store Category</h1>

        <br>

        <?php

            //Check whether the id is set or not
            if(isset($_GET['id']))
            {
                //Get the ID and all other deatils
                //echo "Getting the Data";
                $id = $_GET['id'];
                //Create SQL query to get all other details
                $sql = "SELECT * FROM tbl_store_category WHERE id=$id";

                //Execute the query
                $res = mysqli_query($conn,$sql);

                //Count the rows to check whether the id is valid or not
                $count = mysqli_num_rows($res);
                if($count==1)
                {
                    //Get all the data
                    $row = mysqli_fetch_assoc($res);
                    $title = $row['title'];
                    $current_image = $row['image_name'];
                    $featured = $row['featured'];
                    $active = $row['active'];
                }
                else
                {
                    //Redirect to manage category with message
                    $_SESSION['no-category-found'] = "<div class='error'>Category is not Found.</div>";
                    //Redirected to manage category
                    header('location:'.SITEURL.'admin/manage-store-category.php');
                }

            }
            else
            {
                //Redirected to manage category
                header('location:'.SITEURL.'admin/manage-store-category.php');
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
                <td>Current Image: </td>
                <td>
                    <?php

                        if($current_image != "")
                        {
                            //Display the Image
                            ?>

                            <img src="<?php echo SITEURL; ?>images/store-category/<?php echo $current_image; ?>"width="250px">

                            <?php
                        }
                        else
                        {
                            //Display error message
                            echo "<div class='error'>Image is not Added.</div>";
                        }

                    ?>
                </td>
            </tr>

            <tr> 
                <td>New Image: </td>
                <td>
                    <input type="file" name="image">
                </td>
            </tr>

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
                    <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <input type="submit" name="submit" value="Update Category" class="btn-secondary"></td>   
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
                $current_image = $_POST['current_image'];
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
                        $image_name = "Store_Category_".rand(000, 999).'.'.$ext;

                        $source_path = $_FILES['image']['tmp_name'];
                        $destination_path = "../images/store-category/".$image_name;

                        //Finally Upload the Image
                        $upload = move_uploaded_file($source_path, $destination_path);

                        //Check whether the image is uploaded or not
                        //If the image is not uploaded then we will stop the process and redirect with error message
                        if($upload==false)
                        {

                            //Set message
                            $_SESSION['upload'] = '<div class="error">Failed to Upload Image</div>';
                            //Redirect Page to Manage Category Page
                            header("location: ".SITEURL.'admin/manage-store-category.php');
                            //Stop the process
                            die();

                        }

                        //B. Remove the current image if available
                        if($current_image !="")
                        {

                            $remove_path = "../images/store-category/".$current_image;
                            
                            $remove = unlink($remove_path);

                            //Check whether the image is removed or not
                            if($remove==false)
                            {
                                //Failed to remove image
                                $_SESSION['failed-remove'] = '<div class="error">Failed to remove current Image</div>';
                                //Redirect Page to Manage Category Page
                                header('location: '.SITEURL.'admin/manage-store-category.php');
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

                //3. Update the database
                $sql2 = "UPDATE tbl_store_category SET
                title = '$title',
                image_name = '$image_name',
                featured = '$featured',
                active = '$active'
                WHERE id=$id
                ";

                //Execute the query
                $res2 = mysqli_query($conn,$sql2);

                //4. Redirect to manage category with message
                //Check whether the Query is executed or not
                if($res2==true)
                {
                    //Category Updated
                    $_SESSION['update']='<div class="ok"> Category Updated Sucessfully.</div>';
                    //Redirected to Manage Category Page
                    header('location:'.SITEURL.'admin/manage-store-category.php');
    
                }
                else
                {
                    //Failed to Update Category.
                    $_SESSION['update']='<div class="error"> Failed to Update Category.</div>';
                    //Redirected to Manage Category. Page
                    header('location:'.SITEURL.'admin/manage-store-category.php');
    
                }

            }            
                        
    ?>

    </div>
</div>

<?php include('partials/footer.php'); ?>