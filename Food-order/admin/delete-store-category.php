<?php

    //Include constant.php file here
    include('../config/constants.php');

    //echo"Delete Page";
    //Check whether the id and image_name value is set or not
    if(isset($_GET['id']) AND isset($_GET['image_name']))
    {
        //Get the Value and Delete
        //echo "Get Value and Delete";
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        //Remove the physical image file if avaiable
        if($image_name != "")
        {

            //Image is avaiable, So remove it
            $path = "../images/store-category/".$image_name;
            //Remove the image
            $remove = unlink($path);

            //IF failed to remove image then add and error message and stop the process
            
                if($remove==false)
                {
                    //Set the Session Message
                    $_SESSION['remove'] = "<div class='error'>Failed to Remove Category Image.</div>";
                    //Redirected to Manage Category Page
                    header('location:'.SITEURL.'admin/manage-store-category.php');
                    //Stop the process
                    die();
                }
            

        }

        //Delete Data from Database
        //SQL query to delete Data from Database
        $sql = "DELETE FROM tbl_store_category WHERE id=$id";

        //Execute the query
        $res=mysqli_query($conn,$sql);

        //Check whether the data is deleted from database or not
        //Redrected to Manage Category Page with Message
        if($res==true)
        {
            //Set SUccess Message and Redirect
            $_SESSION['delete']= '<div class="ok">Category Deleted Succefully.</div>';
            //Redirected to Manage Category Page
            header('location:'.SITEURL.'admin/manage-store-category.php');
        }
        else
        {
            //Set Fail message and redirect
            $_SESSION['delete']='<div class="error"Failed to Delete Category.Try Again Later.</div>';
            header('location:'.SITEURL.'admin/manage-store-category.php');
        }
        
    }
    else
    {
        //Redirected to Manage Category Page
        header('location:'.SITEURL.'admin/manage-store-category.php');
    }

?>