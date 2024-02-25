<?php
include('../includes/connect.php');
//when clicking the buton that have the name of insert_cat........input boxs value is added to 
//the variable
if (isset($_POST['insert_cat'])) {
    $category_title = $_POST['cat_title'];

    //to avoid repeating same data
    $select_query = "Select * from `categories` where category_title='$category_title'";
    $result_select = mysqli_query($con, $select_query);
    @$number = mysqli_num_rows($result_select);
    if (@$number > 0) {
        echo "<script>alert('Category already added to the database')</script>";
    } else {
        //now we are addding the detail to db
        $insert_query = "insert into `categories` (category_title) values ('$category_title')";
        $result = mysqli_query($con, $insert_query);

        if ($result) {
            echo "<script>alert('Category has been added successfully')</script>";
        }
    }
}
?>
<h2>Insert new Categories</h2>
<hr class="mx-auto w-25 mb-5">
<form action="" method="post" class="mb-2">
    <div class="input-group flex-nowrap">
        <span class="input-group-text" id="addon-wrapping">#</span>
        <input type="text" class="form-control" name="cat_title" placeholder="Enter New Categories" aria-describedby="addon-wrapping" required>
    </div>

    <div class="input-group flex-nowrap w-10 mb-2 mt-2">

        <input type="submit" class="abc mt-2" name="insert_cat" value="ADD" aria-describedby="addon-wrapping">

        <!-- <button class="abc mt-2 align-left">ADD</button>-->

    </div>
</form>