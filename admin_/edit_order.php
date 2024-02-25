
<?php
include('../includes/connect.php');
if(isset($_GET['edit_order'])){
    $edit_id=$_GET['edit_order'];
    $stmt=$con->prepare("SELECT * FROM orders WHERE order_id=?");
    $stmt->bind_param('i',$edit_id);
    $stmt->execute();

    $order=$stmt->get_result();

}if(isset($_POST['edit_order_status'])){
    $order_status=$_POST['order_status'];
    $order_id=$_POST['order_id'];


   

    $update_order="UPDATE orders SET order_status='$order_status' WHERE order_id=$order_id";

    $result=mysqli_query($con,$update_order);

    print_r($result);
   
    if($result){
        echo "<script>alert('Order has been updated successfully') </script>";
        echo "<script>window.open('index.php?list_orders','_self')</script>";
    }else{
        echo "<script>alert('Order failed to update,try again') </script>";

    }

}//else{
   // echo "<script>window.open('index.php','_self')</script>";
//}


?>




<h3>Edit Order</h3>
<div class="table-responsive">

<div class="mx-auto container">
    <form action="" method="post" >
<?php
while($row=mysqli_fetch_assoc($order)){ 
?>

       <p style="color: red;"><?php if(isset($_GET['error'])){ echo $_GET['error']; } ?></p>
        <div class="form-group my-3">
            <label>Order ID</label>
            <p class="my-4"><?php echo $row['order_id'] ?></p>
        </div>

        <div class="form-group my-3">
            <label>Order Price</label>
            <p class="my-4">Rs. <?php echo $row['order_cost'] ?></p>
        </div>

        <div class="form-group my-3">
            <label>Order status</label>
         <select name="order_status" id="" class="form-select" required>
            
            <option value="not paid"<?php if($row['order_status']=='not paid') {echo "selected";}?> >Not Paid</option>
            <option value="paid" <?php if($row['order_status']=='paid') {echo "selected";}?>>Paid</option>
            <option value="shipped" <?php if($row['order_status']=='shipped') {echo "selected";}?>>Shipped</option>
            <option value="delivered" <?php if($row['order_status']=='delivered') {echo "selected";}?>>Delivered</option>
         </select>
        </div>

        <div class="form-group my-3">
            <label>Order Date</label>
            <p class="my-4"><?php echo $row['order_date'] ?></p>
        </div>
<input type="hidden"  name="order_id" value="<?php echo $row['order_id'];?>">
        <div class="form-group my-3">
            <input type="submit" class="btn btn-secondary" name="edit_order_status" value="Edit">
            
        </div>

    <?php }?>
    </form>
</div>
</div>