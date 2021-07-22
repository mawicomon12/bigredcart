<?php 

    include('../config/constants.php');

    if(isset($_GET['id']) AND isset($_GET['image_name']))
    {
        //process to delete
        
        //1.get id and image name
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];


        //2.remove the image if available
        //check whether the image is available or not and delete only if available
        if($image_name != "")
        {
            //it has image and need to remove from folder
            //get the image path
            $path = "../images/food/".$image_name;

            //remove image file from folder
            $remove = unlink($path);

            //checjk whether the image is removed or not
            if($remove==false)
            {
                //failed to remove image
                $_SESSION['upload'] = "<div class='error'>Failed to Remove Image File.</div>";
                header('location:'.SITEURL.'admin/manage-food.php');
                die();
            }
        }

        //3.delete food from database
        $sql = "DELETE FROM tbl_food WHERE id=$id";

        $res = mysqli_query($conn, $sql);

        //check whether the query executed or not and set the session message 
        if($res==true)
        {
            $_SESSION['delete'] = "<div class='success'>Food Deleted Successfully.</div>";
            header('location:'.SITEURL.'admin/manage-food.php');
        }
        else
        {
            $_SESSION['delete'] = "<div class='error'>Food Deleted Unsuccessfully.</div>";
            header('location:'.SITEURL.'admin/manage-food.php');
        }

        //4.redirect o manage food with session message
    }
    else
    {
        //redirect to manage food page
        $_SESSION['unauthorize'] = "<div class='error'>Unauthorized Access.</div>";
        header('location: '.SITEURL.'admion/manage-food.php');
    }
    
?>