<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="Wrapper">
        <h1>Update Admin</h1>

        <br>

        <?php

            //1.Get the ID of Selected Admin
            $id=$_GET['id'];

            //2.Create SQL Query to Get the Details
            $sql="SELECT * FROM tbl_admin WHERE id=$id";

            //3.Execute the Query
            $res=mysqli_query($conn, $sql);

            //Check whether the query is executed or not
            if($res==true)
            {
                //check whether the data is available or not
                $count = mysqli_num_rows($res);
                //Check whether we have admin data or not
                if($count==1)
                {
                    //Get the deatils
                    //echo "Admin Avaiable";
                    $row=mysqli_fetch_assoc($res);

                    $full_name=$row['full_name'];
                    $username=$row['username'];
                }
                else
                {
                    //Redirect to Manage Admin Page
                    header('location:'.SITEURL.'admin/manage-admin.php');
                }
            }

        ?>

        <form action="" method="Post">

        <table class="tbl-30">
                <tr>
                    <td>Full Name: </td>
                    <td><input type="text" name="full_name" value="<?php echo $full_name; ?>"> </td>
                </tr>
                <tr>
                    <td>Username: </td>
                    <td><input type="text" name="username" value="<?php echo $username; ?>"></td>
                </tr>
                <tr>
                    <td colspan="2">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <input type="submit" name="submit" value="Update Admin" class="btn-secondary"></td>
                    </td>
                </tr>
            </table>

        </form>


    <div>
</div>

<?php
        //Check whether the submit Button is clicked or not
        if(isset($_POST['submit']))
        {
            //echo"Button Clicked";
            //GET all the values from from to Update
             $id = $_POST['id'];
             $full_name = $_POST['full_name'];
             $username = $_POST['username'];

             //Create SQL query to Update Admin
             $sql = "UPDATE tbl_admin SET
             full_name= '$full_name',
             username= '$username'
             WHERE id='$id'
             ";

            // EXecute the Query
            $res= mysqli_query($conn,$sql);

            //Check whether the quey executed successfully or not
            if($res==true)
            {

                //Query Executed and Admin Updated
                $_SESSION['update']='<div class="ok"> Admin Updated Sucessfully.</div>';
                //Redirected to Manage Admin Page
                header('location:'.SITEURL.'admin/manage-admin.php');

            }
            else
            {
                //Failed to Update Admin
                $_SESSION['update']='<div class="error"> Failed to Update Admin.</div>';
                //Redirected to Manage Admin Page
                header('location:'.SITEURL.'admin/manage-admin.php');

            }
        }

?>


<?php include('partials/footer.php'); ?>