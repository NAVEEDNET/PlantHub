<?php
if(isset($_GET['edit_category'])){
    $edit_category=$_GET['edit_category'];
    $get_category="SELECT * FROM categories WHERE category_id=$edit_category";
    $result=mysqli_query($con,$get_category);
    $row=mysqli_fetch_assoc($result);
    $category_title=$row['category_title'];
}
?>




<h3 class="text-center">Update Category</h3>
<hr class="mx-auto w-25 mb-5">
<form action="" method="post" class="mb-2">
<label for="" style="font-weight:500;">Enter new Category Title below</label>
    <div class="input-group flex-nowrap">
        
        <span class="input-group-text" id="addon-wrapping">#</span>
        <input type="text" class="form-control" value="<?php echo $category_title; ?>" name="edit_cat_title" placeholder="Enter New name of the Category" aria-describedby="addon-wrapping" required>
    </div>

    <div class="input-group flex-nowrap w-10 mb-2 mt-2">

        <input type="submit" class="abc mt-2" name="edit_cat" value="Update Category" aria-describedby="addon-wrapping">

        <!-- <button class="abc mt-2 align-left">ADD</button>-->

    </div>



</form>
<?php
if(isset($_POST['edit_cat'])){
    $new_category_title=$_POST['edit_cat_title'];

    $update_query="UPDATE categories SET category_title='$new_category_title' WHERE category_id=$edit_category";
    $result_cat=mysqli_query($con,$update_query);
    if($result_cat){
        echo "<script>alert('The category is been updated successfully') </script>";
        echo "<script>window.open('./index.php?view_categories','_self')</script>";
    }

    
}
?>