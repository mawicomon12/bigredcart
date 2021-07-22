<?php include('partials/menu.php'); ?>

    <div class="main-content">
        <div class="wrapper">
            <h1>Add Category</h1>
            <br><br>

            <?php 

                if(isset($_SESSION['add']))
                {
                    echo $_SESSION['add'];
                    unset($_SESSION['add']);
                }

                if(isset($_SESSION['upload']))
                {
                    echo $_SESSION['upload'];
                    unset($_SESSION['upload']);
                }
            ?>

            <!-- Add Category form starts -->

            <form action="" method="POST" enctype="multipart/form-data">
                <table class="tbl-30">
                    <tr>
                        <td>Title: </td>
                        <td>
                            <input type="text" name="title" placeholder="Category Title">
                        </td>
                    </tr>

                    <tr>
                        <td>Select Image: </td>
                        <td>
                            <input type="file" name="image">
                        </td>
                    </tr>

                    <tr>
                        <td>Featured: </td>
                        <td>
                            <input type="radio" name="featured" value="Yes"> Yes 
                            <input type="radio" name="featured" value="No"> No
                        </td>
                    </tr>

                    <tr>
                        <td>Active: </td>
                        <td>
                            <input type="radio" name="active" value="Yes">Yes
                            <input type="radio" name="active" value="No">No
                        </td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            <input type="submit" name="submit" value="Add Category" class="btn-secondary">
                        </td>
                    </tr>

                </table>
            </form>

            <!-- Add category form ends -->

            <?php 
                //check whether the submit buttom is clicked or not 
                if(isset($_POST['submit']))
                {
                    //echo "clicked";
                    //1. get the value from the category form
                    $title = $_POST['title'];

                    //form radio input, we need to ckeck whether the button is slected or not
                    if(isset($_POST['featured']))
                    {
                        // get the value from form
                        $featured = $_POST['featured'];
                    }
                    else
                    {
                        //set the default value
                        $featured = "No";
                    }

                    if(isset($_POST['active']))
                    {
                        $active = $_POST['active'];

                    }
                    else
                    {
                        $active = "No";
                    }
                        //check if the image is selected or not and set the value for image name accordingly
                        //print_r($_FILES['image']);

                        //die(); // to break the code here
                        if(isset($_FILES['image']['name']))
                        {
                            //upload the image
                            //to upload image we need name,source path and description
                            $image_name = $_FILES['image']['name'];

                            //upload image only if image is selected
                            if($image_name != "")
                            {
                                //auto rename the uploaded image 
                                //get the extension of our image (.jpg,.png,.etc)e.g. "specialfood1.jpg"
                                $ext = end(explode('.', $image_name));

                                //rename the image 
                                $image_name = "Food_category_".rand(000, 999).'.'.$ext; //demo name e.g. "Food_category_001."


                                $source_path = $_FILES['image']['tmp_name'];

                                $destination_path = "../images/category/".$image_name;

                                //finally upload the image
                                $upload = move_uploaded_file($source_path, $destination_path);

                                //check whether the iage is uploaded or not
                                //and if the image is not uploaded then we will stop the process and redirect with error message
                                if($upload==false)
                                {
                                    //set message
                                    $_SESSION['upload'] = "<div class='error'>Failed to upload image.</div>";

                                    //redirect to add category page
                                    header('location:'.SITEURL.'admin.add-category.php');

                                    //stop the process
                                    die();
                                }
                            }

                        }
                        else
                        {
                            //dont upload the image and set the image_name value as blank
                            $image_name="";
                        }

                        //2. create sql query to insert category into database
                        $sql = "INSERT INTO tbl_category SET
                        title='$title',
                        image_name='$image_name',
                        featured='$featured',
                        active='$active'";

                        //3. execute the query and save in database
                        $res = mysqli_query($conn, $sql);

                        //4. Check whether the query executed or not and data added or not
                        if($res==true)
                        {
                            //query executed and category added
                            $_SESSION['add'] = "<fiv class='success'>Category Added Successfully.</div>";
                            
                            //redirect to manage-category page
                            header('location:'.SITEURL.'admin/manage-category.php');
                        }
                        else
                        {
                            $_SESSION['add'] = "<fiv class='error'>Category Added Unsuccessfully.</div>";
                            
                            //redirect to manage-category page
                            header('location:'.SITEURL.'admin/add-category.php');
                        }
                }
            ?>

        </div>
    </div>


<?php include('partials/footer.php'); ?>