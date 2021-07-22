<?php include('../config/constants.php'); ?>

<html>
    <head>
        <title>Login -BigRedCart</title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>

    <body>
        <div class="login">
            
            <h1 class="text-center">Login</h1>
            <br><br>

            <?php 
                if(isset($_SESSION['login']))
                {
                    echo $_SESSION['login'];
                    unset($_SESSION['logn']);
                }

                if(isset($_SESSION['no-login-message']))
                {
                    echo $_SESSION['no-login-message'];
                    unset($_SESSION['no-login-message']);
                }
            ?>
            <br><br>

            <!-- Login form starts -->
            <form action="" method="POST" class="text-center">
                Username:<br>
                <input type="text" name="username" placeholder="Enter username"><br><br>
                Password:<br>
                <input type="password" name="password" placeholder="Enter password"><br><br>

                <input type="submit" name="submit" value="Login" class="btn-primary">
            </form>
            <br>
            <!-- Login form ends -->

            <p class="text-center">By <a href="index.php" >BigRedCart.</p>
            </div>
        </div>
    </body>
</html>

<?php 
    //check whether the submit button is clicked or not
    if(isset($_POST['submit']))
    {
        //process for login 
        //1. get the data from login form
        $username = $_POST['username']; 
        $password = md5($_POST['password']);
        
        //2.to check whether the username and password exist or not 
        $sql = "SELECT * FROM tbl_admin WHERE username= '$username' AND password= '$password'";

        //3. execute the query
        $res = mysqli_query($conn, $sql);

        //4. count rows  to check whether the user exists or not
        $count = mysqli_num_rows($res);

        if($count==1)
        {
            //user avialable and log in successfully
            $_SESSION['login'] = "<div class='success'>Login Successfully. </div>";
            $_SESSION['user'] = $username; //to check whether the user is logged in or not and logout will unset it

            //redirect to homepage
            header('location:'.SITEURL.'admin/');
        }
        else
        {
            //user not available 
            $_SESSION['login'] = "<div class='error text-center'>username or password not matched. </div>";

            //redirect to homepage
            header('location:'.SITEURL.'admin/login.php');
        }
    }
?>