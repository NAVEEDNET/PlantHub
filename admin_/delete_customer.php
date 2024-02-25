<?php
if (isset($_GET['delete_customer'])){
    $delete_customer_id=$_GET['delete_customer'];
    //echo $delete_customer_id;

    $delete_customer_detail="DELETE FROM customer WHERE customer_id=$delete_customer_id";
    $result_delete=mysqli_query($con,$delete_customer_detail);
    if($result_delete){
        echo "<script>alert('Customer detaile deleted successfully!') </script>";
        echo "<script>window.open('./index.php?list_users','_self')</script>";
  
    }
}

?>