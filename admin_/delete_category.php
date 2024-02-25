<?php

if (isset($_GET['delete_category'])){
    $delete_id=$_GET['delete_category'];
   // echo $delete_id;

    $delete_category="DELETE FROM `categories` WHERE category_id=$delete_id";
    $result_cat=mysqli_query($con,$delete_category);
    if($result_cat){
        echo "<script>alert('category deleted successfully!') </script>";
        echo "<script>window.open('./index.php?view_categories','_self')</script>";
  
    }
}

?>