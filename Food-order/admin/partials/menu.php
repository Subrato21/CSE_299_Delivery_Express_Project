<?php 
    
    include('../config/constants.php'); 
    include('login-check.php');

?>


<html> 
<head>
    <title> Food Order Website- Home Page </title>
    <link rel="stylesheet" href="../css/admin.css">
</head>
<body>
    <!--- Menu Section Starts --->
    <div class="menu text-center">
        <div class="wrapper">
            <ul>
                    <li><a href='index.php'>Home</a></li>
                    <li><a href='manage-admin.php'>Admin</a></li>
                    <li><a href='manage-store-category.php'>Store Category</a></li>
                    <li><a href='manage-category.php'>Food Category</a></li>
                    <li><a href='manage-store-food.php'>Store Iteam</a></li>
                    <li><a href='manage-food.php'>Food</a></li>
                    <li><a href='manage-store-order.php'>Store Order</a></li>
                    <li><a href='manage-order.php'>Food Order</a></li>
                    <li><a href='logout.php'>Logout</a></li>
            </ul>
        </div>
    </div>
    <!-- Menu Section End --->

</html>