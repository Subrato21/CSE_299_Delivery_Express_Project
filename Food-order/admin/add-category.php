<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Category<h1>
        <br>

        <?php 
                if(isset($_SESSION['add']))//Cheking whether the Session is Set or Not
                {
                    echo ($_SESSION['add']);//Displaying the Session Message
                    unset($_SESSION['add']); //Remove Session Message
                }

                if(isset($_SESSION['upload']))//Cheking whether the Session is Set or Not
                {
                    echo ($_SESSION['upload']);//Displaying the Session Message
                    unset($_SESSION['upload']); //Remove Session Message
                }
        ?>

        <!-- Add Category Form Starts -->
        <form action="" method="Post" enctype="multipart/form-data">

        <table class="tbl-30"> 
            <tr>
                <td>Title: </td>
                <td>
                    <input type="text" name="title" placeholder="Category Title">
                </td>
            </tr>

            <tr>
                <td>Select Image: </td>
                <td>
                    <input type="file" name="image">
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
                    <input type="submit" name="submit" value="Add Category" class="btn-secondary"></td>
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
                //1.Get the value from Category form
                $title=$_POST['title'];

                //For Radio input, we need to check whether the button is selected or not
                if(isset($_POST['featured']))
                {
                    //Get the value from form
                    $featured = $_POST['featured'];

                }

                else
                {
                    //Set the defaulted Value
                    $featured = "No";
                }

                if(isset($_POST['active']))
                {
                    //Get the value from form
                    $active = $_POST['active'];

                }

                else
                {
                    //Set the defaulted Value
                    $active = "No";
                }

                //Check whether image is selected or not and set the value for image name accordingly
                //print_r($_FILES['image']);//It's to show array value
                //die();//Break the Code Here

                if(isset($_FILES['image']['name']))
                {
                    //Upload the Image
                    //To upload image name, source path and destination path
                    $image_name = $_FILES['image']['name'];

                    //Upload the image only if image is selected
                    if($image_name != "")
                    {

                        //Auto Rename our image
                        //Get the Extension of our image(jpn,png,gif, etc) Ex: "specialfood1.jpg" // e.g Food_Category_834.jpg
                        $ext = end(explode ('.', $image_name));

                        //Rename the Image
                        $image_name = "Food_Category_".rand(000, 999).'.'.$ext;

                        $source_path = $_FILES['image']['tmp_name'];
                        $destination_path = "../images/category/".$image_name;

                        //Finally Upload the Image
                        $upload = move_uploaded_file($source_path, $destination_path);

                        //Check whether the image is uploaded or not
                        //If the image is not uploaded then we will stop the process and redirect with error message
                        if($upload==false)
                        {

                            //Set message
                            $_SESSION['upload'] = '<div class="error">Failed to Upload Image</div>';
                            //Redirect Page to Add Category Page
                            header("location: ".SITEURL.'admin/add-category.php');
                            //Stop the process
                            die();

                        }

                    }

                }
                else
                {
                    //Don't Upload the I mage and set the I mage name value blank
                    $image_name="";
                }


                //2. Create SQL Query to Insert Category into Database

                $sql = "INSERT INTO tbl_category SET
                title='$title',
                image_name='$image_name',
                featured='$featured',
                active='$active'
                ";

                //3. Executed the Query and Save in Database
                $res = mysqli_query($conn, $sql);

                //4.Check whether the query is executed or not and data added or not
                if($res==true)
                {

                    //Query Execute and Category Added
                    //Create a Session Variable to Display Message
                    $_SESSION['add']= '<div class="ok">Category Added Successfully</div>';
            
                    //Redirect Page to Manage Category
                    header("location: ".SITEURL.'admin/manage-category.php');

                }
                else
                {

                    //Failed to Add Catgeory
                    //Create a Session Variable to Display Message
                    $_SESSION['add']= '<div class="error">Failed to Add Category</div>';
            
                    //Redirect Page to manage category
                    header("location: ".SITEURL.'admin/add-category.php');

                }
            

        }


        ?>

            
    </div>
</div>


<?php include('partials/footer.php'); ?>


