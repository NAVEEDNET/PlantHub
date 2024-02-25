<?php
if (isset($_GET['delete_product'])){
    $delete_id=$_GET['delete_product'];
    echo $delete_id;

    $delete_product="DELETE FROM plants WHERE plant_id=$delete_id";
    $result_product=mysqli_query($con,$delete_product);
    if($result_product){
        echo "<script>alert('plant deleted successfully!') </script>";
        echo "<script>window.open('./view_products.php','_self')</script>";
  
    }
}

?>