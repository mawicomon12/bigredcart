<?php 
    //include constants file
    include('../config/constants.php');

    //checl whether the id and image_name value is set or not
    if(isset($_GET['id']) AND isset($_GET['image_name']))
    {
        //get the value and delete
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        //remove the physical image file is available
        if($image_name != "")
        {
            //image is available
            $path = "../images/category/".$image_name;
            //remove image
            $remove = unlink($path);

            //if fail to remove image
            if($remove==false)
            {
                //set the session message
                $_SESSION['remove'] = "<div class='error'>Failed to remove category image. </div>";

                //then redirect to category page
                header('location:'.SITEURL.'admin/manage-category.php');

                //stop the process
                die();
            }
        }
        //delete data from database
        //sql query to delete data from database
        $sql = "DELETE FROM tbl_category WHERE id=$id";

        //execute the query
        $res = mysqli_query($conn, $sql);

        //check whether the data is delete from the database or not
        if($res==true)
        {
            //set success message and redirect
            $_SESSION['delete'] = "<div class='success'>Category Deleted Successfully. </div>";

            //redirect to manage category
            header('location:'.SITEURL.'admin/manage-category.php');
        }
        else
        {
            //set fail message and redirect to manage-category page
            $_SESSION['delete'] = "<div class='error'>Failed to delete category. </div>";
            //redirect to manage category
            header('location:'.SITEURL.'admin/manage-category.php');
        }

        //redirect to manage category page with message

    }
    else
    {
        //redirect to manage category page
        header('location:'.SITEURL.'admin/manage-category.php');
    }
?>