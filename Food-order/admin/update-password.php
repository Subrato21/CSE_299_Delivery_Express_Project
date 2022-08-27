<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Change Password</h1>
        <br>

        <?php

            if(isset($_GET['id']))
            {
                $id=$_GET['id'];
            }

        ?>
        <form action="" method="POST">
        <table class="tbl-30">
                <tr>
                    <td>Current Password:</td>
                    <td><input type="password" name="current_password" placeholder="Enter your Current Passowrd"> 
                    </td>
                </tr>

                <tr>
                    <td>New Password:</td>
                    <td><input type="password" name="new_password" placeholder="Enter your New Passowrd"> 
                    </td>
                </tr>

                <tr>
                    <td>Confirm Password:</td>
                    <td><input type="password" name="confirm_password" placeholder="Confirm your New Passowrd"> 
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <input type="submit" name="submit" value="Change Password" class="btn-secondary"></td>
                    </td>
                </tr>

        </table>

    </form>

    </div>

</div>

<?php
        //Check whether the submit Button is clicked or not
        if(isset($_POST['submit']))
        {
            //echo"Button Clicked";

            //1.GET the data from from to Update
            $id=$_POST['id'];
            $current_password = md5($_POST['current_password']);
            $new_password = md5($_POST['new_password']);
            $confirm_password = md5($_POST['confirm_password']);

            //2.Check wether the user with current id or password exists or not
            $sql="SELECT *FROM tbl_admin WHERE id=$id AND password= '$current_password' ";
            
            //Execute the Query

            $res = mysqli_query($conn, $sql);

            if($res==true)

        {
                //CHECK WHETHER DATA IS AVAILABLE OR NOT
                $count=mysqli_num_rows($res);

                if($count==1)
                {

                    //User Exists and Password Can be Changed
                    //echo "User found";
                    if($new_password==$confirm_password)
                    {
                        //update the password
                        $sql2="UPDATE tbl_admin SET
                        password='$new_password'
                        WHERE id=$id
                        ";
                        //Execute the Query
                        $res2 = mysqli_query($conn, $sql2);
                        //Check whether the query is executed or not
                        if($res2==true)
                        {
                            //Display Success Message
                            //Redirected to Mange Admin Page with Sucess Massaage
                            $_SESSION['change-pwd']="<div class='ok'>Password Changed Successfully.</div>";
                            //Redirected to Manage Admin Page
                            header('location:'.SITEURL.'admin/manage-admin.php');
                            
                        }
                        else
                        {
                            //Redirected to Mange Admin Page with error Massaage
                            $_SESSION['change-pwd']="<div class='error'>Failed to Change Password.</div>";
                            //Redirected to Manage Admin Page
                            header('location:'.SITEURL.'admin/manage-admin.php');
                        }
                    }
                    else
                    {
                        //Redirected to Mange Admin Page with error Massaage
                        $_SESSION['pwd-not-match']="<div class='error'>Password did not Match.</div>";
                        //Redirected to Manage Admin Page
                        header('location:'.SITEURL.'admin/manage-admin.php');
                    }
	            }
                else{
                    //User does not exists Set Message and Redirect

                    $_SESSION['user-not-found']="<div class='error'>User Not Found.</div>";
                    //Redirected to Manage Admin Page
                    header('location:'.SITEURL.'admin/manage-admin.php');
                }
         }
            
        
            

            //3. Check whether the New Password and Confirm Password Match or Not

            //4.Change Password if all avobe is true

        }

?>


<?php include('partials/footer.php'); ?>

