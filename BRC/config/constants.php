<?php 
    //start session
    ob_start();
    
    session_start();

    //Create constants to store non repeating values
    define('SITEURL','http://localhost:8080/BRC/');
    define('LOCALHOST', 'localhost');
    define('DB_USERNAME','root');
    define('DB_PASSWORD','');
    define('DB_NAME', 'food-order');

    $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error($link)); //datbabase connection
    $db_select = mysqli_select_db($conn, 'food-order') or die(mysqli_error($link)); //selecting a database

?>