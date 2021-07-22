<?php 
    include('../config/constants.php');
    include('login-check.php');

?>

<html>
    <head>
        <meta charset="UTF-8">
        <!-- Important to make website responsive -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://kit.fontawesome.com/8f329317c6.js" crossorigin="anonymous"></script>
        <!-- Link our CSS file -->
        <link rel="stylesheet" href="../css/admin.css">
        <title>BigRedCart Food Order - Home Page</title>
    </head>

    <body>
        <!--Menu Section Start-->
        <div class="menu text-center">
            <div class="wrapper">
                <div class="logo">
                    <a href="<?php echo SITEURL; ?>admin/add-category.php" id="navbar__logo"><i class="fas fa-utensils">BigRedCart</i></a>
                </a>
            </div>
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="manage-admin.php">Admin</a></li>
                    <li><a href="manage-category.php">Category</a></li>
                    <li><a href="manage-food.php">Food</a></li>
                    <li><a href="manage-order.php">Order</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </div>
        </div>
        
        <!--Menu Section End-->