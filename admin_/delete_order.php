<?php
if (isset($_GET['delete_order'])){
    $delete_order=$_GET['delete_order'];
    echo $delete_order;

    $delete_order_detail="DELETE FROM orders WHERE order_id=$delete_order";
    $result_delete=mysqli_query($con,$delete_order_detail);
    if($result_delete){
        echo "<script>alert('Order detail deleted successfully!') </script>";
        echo "<script>window.open('./index.php?list_orders','_self')</script>";
  
    }
}

?>