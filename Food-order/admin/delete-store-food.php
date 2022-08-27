<?php

    //Include constant.php file here
    include('../config/constants.php');

    //echo"Delete Food";
    //1. Check whether the id and image_name value is set or not
    if(isset($_GET['id']) && isset($_GET['image_name']))
    {
        //Get the Value and Delete
        //echo "Get Value and Delete";
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        //2. Remove the physical image file if avaiable
        if($image_name != "")
        {

            //Image is avaiable, So remove it
            $path = "../images/store-food/".$image_name;
            //Remove the image
            $remove = unlink($path);

            //IF failed to remove image then add and error message and stop the process
            
                if($remove==false)
                {
                    //Set the Session Message
                    $_SESSION['remove'] = "<div class='error'>Failed to Remove Food Image.</div>";
                    //Redirected to Manage Food Page
                    header('location:'.SITEURL.'admin/manage-store-food.php');
                    //Stop the process
                    die();
                }
            

        }

        //3. Delete Data from Database
        //SQL query to delete Data from Database
        $sql = "DELETE FROM tbl_store_food WHERE id=$id";

        //Execute the query
        $res=mysqli_query($conn,$sql);

        //Check whether the data is deleted from database or not
        //Redrected to Manage Category Page with Message
        if($res==true)
        {
            //Set SUccess Message and Redirect
            $_SESSION['delete']= '<div class="ok">Iteam Deleted Succefully.</div>';
            //Redirected to Manage Category Page
            header('location:'.SITEURL.'admin/manage-store-food.php');
        }
        else
        {
            //Set Fail message and redirect
            $_SESSION['delete']='<div class="error">Failed to Delete Iteam.Try Again.</div>';
            header('location:'.SITEURL.'admin/manage-store-food.php');
        }
        
    }
    else
    {   
        //Unauthorise Message
        $_SESSION['unauthrorize']='<div class="error"Unauthorized Access.</div>';
        //Redirected to Manage Category Page
        header('location:'.SITEURL.'admin/manage-store-food.php');
    }

?>