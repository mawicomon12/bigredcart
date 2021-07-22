<?php include('partials/menu.php'); ?>

    <div class="main-content">
        <div class="wrapper">
            <h1>Add admin</h1>

            <br />

            <?php 
            
                if(isset($_SESSION['add']))
                {
                    echo $_SESSION['add'];
                    unset($_SESSION['add']);
                }
            ?>

            <form action="" method="POST">
                <table class="tbl-30">
                    <tr>
                        <td>Full Name: </td>
                        <td><input type="text" name="full_name" placeholder="Enter your name..."></td>
                    </tr>

                    <tr>
                        <td>Username: </td>
                        <td>
                            <input type="text" name="username" placeholder="Enter username...">
                        </td>
                    </tr>

                    <tr>
                        <td>Password: </td>
                        <td>
                            <input type="password" name="password" placeholder="Enter password...">
                        </td>
                    </tr>
                    
                    <tr>
                        <td>
                            <input type="submit" name="submit" value="Add admin" class="btn-secondary">
                        </td>
                    </tr>
            
                </table>
            </form>
            
        </div>
    </div>

<?php include('partials/footer.php'); ?>

<?php 
    //Process the value from form and save it database
    //check wether the submit button is clicked or not 

    if(isset($_POST['submit']))
    {   
        //Buttom clicked 

        //1. Get data from user
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];
        $password = md5($_POST['password']); //Password ecnryption with md5

        //2. SQL Query to save the data inbto database
        $sql = "INSERT INTO tbl_admin SET 
            full_name='$full_name',
            username='$username',
            password='$password'
    ";
    //3. Executing query and saving data into database
    $res = mysqli_query($conn, $sql) or die(mysqli_error($link));

    //4. Checl whether the (query is executed) data is inserted or not and display appropriate message
    if($res==TRUE)
    {
        //DATA INSERTED
        //echo "Data inserted";
        //create a session variable to display message 
        $_SESSION['add'] = "<div class='success'>Admin Added Successfuly.</div>";
        //redirected page to manage admin
        header("location:".SITEURL."admin/manage-admin.php");

    }else{
        //failed to insert data
        //echo "failed to insert data";
        $_SESSION['add'] = "<div class='error'>Admin Added Unsuccessfuly.</div>";
        //redirected page to manage admin
        header("location:".SITEURL."admin/manage-admin.php");

    }
}
?>