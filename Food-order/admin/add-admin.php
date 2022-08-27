<?php include ('partials/menu.php'); ?>


<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin<h1>

            <br>

            <?php 
                if(isset($_SESSION['add']))//Cheking whether the Session is Set or Not
                {
                    echo ($_SESSION['add']);//Displaying the Session Message
                    unset($_SESSION['add']); //Remove Session Message
                }
            ?>

        <form action="" method="POST">

            <table class="tbl-30">
                <tr>
                    <td>Full Name: </td>
                    <td><input type="text" name="full_name" placeholder="Enter your name"></td>
                </tr>
                <tr>
                    <td>Username: </td>
                    <td><input type="text" name="username" placeholder="Enter your username"></td>
                </tr>
                <tr>
                    <td>Password: </td>
                    <td><input type="password" name="password" placeholder="Enter your password"></td>
                </tr>
                <tr>
                    <td colspan="2">
                    <input type="submit" name="submit" value="Add Admin" class="btn-secondary"></td>
                    </td>
                </tr>
            </table>
            </form>
    </div>
</div>

<?php include ('partials/footer.php'); ?>


<?php
    //Process the value from From and save it in Database
    //Check whether the button is clicked or not
    if(isset($_POST['submit']))
    {
        //Button Clicked
        //echo"Buttton Clicked";

        //1.Get the Data from From
        $full_name=$_POST['full_name'];
        $username=$_POST['username'];
        $password=md5($_POST['password']); //Password Encryption with md5

        //2.SQL query to save the Dta into Database
        $sql="INSERT INTO tbl_admin SET
        full_name='$full_name',
        username='$username',
        password='$password'
        ";
        
        //3.Executing Query and Saving Data into Database
        $res= mysqli_query($conn,$sql) or die(mysqli_error());

        //4.Check whether the (Query is executed) data is inserted or not and display apporipate massage
        if($res==TRUE)
        {
            //Data Inserted
            //echo "Data Inserted";
            //Create a Session Variable to Display Message
            $_SESSION['add']= '<div class="ok">Admin Added Successfully</div>';
            
            //Redirect Page to Manage Admin
            header("location: ".SITEURL.'admin/manage-admin.php');
        }
        else
        {
            //Data is not Inserted
            //echo "Data is not Inserted";
            //Create a Session Variable to Display Message
            $_SESSION['add']= '<div class="error">Failed to Add Admin</div>';
            
            //Redirect Page to Manage Admin
            header("location: ".SITEURL.'admin/add-admin.php');
        }


    }
    

?>