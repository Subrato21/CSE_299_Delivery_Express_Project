<?php

    //Create Constatns to Store non-repeating values
    //Define('SITEURL', 'http://localhost:8080/Food-order/');
    Define('SITEURL', 'http://localhost/food-order/');

    define('LOCALHOST', 'localhost');  //Constant are written in Capital letter
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', '');
    define('DB_NAME', 'food-order');

        
    //Start Session
    session_start();

    $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());   //Database Connection
    $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error());    //Select Database

    //$conn = mysqli_connect('localhost', 'root', '') or die(mysqli_error());   //Database Connection
    //$db_select = mysqli_select_db($conn, 'food-order') or die(mysqli_error());    //Select Database

?>