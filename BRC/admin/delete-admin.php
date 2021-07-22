<?php 

    //include constansts.php here
    include('../config/constants.php');

    //1.get the id of admin to be deleted
    echo $id = $_GET['id'];

    //2. create sql query to delete admin
    $sql = "DELETE FROM tbl_admin WHERE id = $id";
    
    //EXECUTE THE QUERY
    $res = mysqli_query($conn, $sql);

    //check wether the query executed successfully or not
    if($res==true)
    {
        //echo "Admin deleted";
        //create session variable to display message 
        $_SESSION['delete'] = "<div class='success'>Admin Deleted Successfully.</div>";

        header('location:'.SITEURL.'admin/manage-admin.php');
    }
    else
    {
        //failed to delete admin
        //echo "Admin failed to delete";

        $_SESSION['delete'] = "<div class='error'>Failed to delete Admin. Try again later.</div>";
        header('location:'.SITEURL.'admin/manage-admin.php');
    }

    //3. redirect to manage admin page with message (success/erro)


?>