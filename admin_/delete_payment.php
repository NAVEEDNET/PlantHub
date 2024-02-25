<?php
if (isset($_GET['delete_payment'])){
    $delete_payment=$_GET['delete_payment'];
   // echo $delete_order;

    $delete_payment_detail="DELETE FROM payments WHERE payment_id=$delete_payment";
    $result_delete=mysqli_query($con,$delete_payment_detail);
    if($result_delete){
        echo "<script>alert('Payment detail deleted successfully!') </script>";
        echo "<script>window.open('./index.php?list_payment','_self')</script>";
  
    }
}

?>