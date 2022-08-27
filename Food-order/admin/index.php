<?php include ('partials/menu.php'); ?>


    <!--- Main Content Section Starts --->
    <div class="main-content">
        <div class="wrapper">
            <h1>Dashboard</h1>

            <br><h2>Food Dashboard</h2>
            <?php
                if(isset($_SESSION['login']))
                {
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }

            ?>
            <br>

            <div class="col-4 text-center">
                <?php
                    //SQL Query
                    $sql = "SELECT * FROM tbl_category";
                    //Execute Query
                    $res = mysqli_query($conn, $sql);
                    //Count rows
                    $count = mysqli_num_rows($res);
                ?>
                <h1><?php echo $count; ?></h1>
                </br>
                            Categories
            </div>
            <div class="col-4 text-center">
                    <?php
                        //SQL Query
                        $sql2 = "SELECT * FROM tbl_food";
                        //Execute Query
                        $res2 = mysqli_query($conn, $sql2);
                        //Count rows
                        $count2 = mysqli_num_rows($res2);
                    ?>
                    <h1><?php echo $count2; ?></h1>
                    </br>
                            Foods
            </div>
            <div class="col-4 text-center">
                    <?php
                        //SQL Query
                        $sql3 = "SELECT * FROM tbl_order";
                        //Execute Query
                        $res3 = mysqli_query($conn, $sql3);
                        //Count rows
                        $count3 = mysqli_num_rows($res3);
                    ?>
                    <h1><?php echo $count3; ?></h1>
                    </br>
                            Total Orders
            </div>
            <div class="col-4 text-center">
                    <?php
                        //SQL Query to get total revenue Generated
                        $sql4 = "SELECT SUM(total) AS Total FROM tbl_order WHERE status='Delivered' ";
                        //Execute Query
                        $res4 = mysqli_query($conn, $sql4);
                        //Get the value
                        $row4 = mysqli_fetch_assoc($res4);
                        //Get the Total Revenue
                        $total_revenue = $row4['Total'];
                    ?>
                    <h1><?php echo $total_revenue; ?>TK</h1>
                    </br>
                            Food Revenue Generated
            </div>
            <br><br><br><br><br><br><br><br><br><br>
            <h2>Store Dashboard</h2>
            <?php
                if(isset($_SESSION['login']))
                {
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }

            ?>
            <br>

            <div class="col-4 text-center">
                <?php
                    //SQL Query
                    $sql = "SELECT * FROM tbl_store_category";
                    //Execute Query
                    $res = mysqli_query($conn, $sql);
                    //Count rows
                    $count = mysqli_num_rows($res);
                ?>
                <h1><?php echo $count; ?></h1>
                </br>
                            Store Categories
            </div>
            <div class="col-4 text-center">
                    <?php
                        //SQL Query
                        $sql2 = "SELECT * FROM tbl_store_food";
                        //Execute Query
                        $res2 = mysqli_query($conn, $sql2);
                        //Count rows
                        $count2 = mysqli_num_rows($res2);
                    ?>
                    <h1><?php echo $count2; ?></h1>
                    </br>
                            Store Iteams
            </div>
            <div class="col-4 text-center">
                    <?php
                        //SQL Query
                        $sql3 = "SELECT * FROM tbl_store_order";
                        //Execute Query
                        $res3 = mysqli_query($conn, $sql3);
                        //Count rows
                        $count3 = mysqli_num_rows($res3);
                    ?>
                    <h1><?php echo $count3; ?></h1>
                    </br>
                Total Orders
            </div>
            <div class="col-4 text-center">
                    <?php
                        //SQL Query to get total revenue Generated
                        $sql4 = "SELECT SUM(total) AS Total FROM tbl_store_order WHERE status='Delivered' ";
                        //Execute Query
                        $res4 = mysqli_query($conn, $sql4);
                        //Get the value
                        $row4 = mysqli_fetch_assoc($res4);
                        //Get the Total Revenue
                        $total_revenue = $row4['Total'];
                    ?>
                    <h1><?php echo $total_revenue; ?>TK</h1>
                    </br>
                            Store Revenue Generated
            </div>

            <div class="clearflix"></div>

        </div>  

    </div>
    <!--- Main Content Section End --->

    <?php include('partials/footer.php'); ?>

    