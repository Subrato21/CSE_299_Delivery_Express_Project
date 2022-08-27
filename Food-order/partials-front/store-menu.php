<?php include('config/constants.php'); ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- Important to make website responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Store Website</title>

    <!--Link Our CSS Files-->
    <link rel="stylesheet" href="css/store.css">

</head>
<body>
    <!--Navbar Section Starts Here-->
    
    <section class="navbar">
        <div class="container">
            <div class="logo">
                <img src="images/slogo.jpg" alt="Store Logo" class="img-responsive">
            </div>

            <div class="menu text-right">
                <ul>
                    <li>
                        <a href="homepage.html">Home</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL; ?>store-index.php">Store</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL; ?>store-categories.php">Categories</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL; ?>store-foods.php">Iteams</a>
                    </li>
                    <li>
                        <a href="#">Contact</a>
                    </li>
                </ul>
            </div>

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Navbar Section Ends Here -->

    </body>
</html>