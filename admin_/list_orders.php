<div class="mt-5">
  <h3 class="text-center mt-5">All Orders</h3>
  <table class="table table-bordered mt-5 my-2 text-center">

    <?php
    //include('../includes/connect.php');
    $get_orders = "SELECT * from orders";
    $result = mysqli_query($con, $get_orders);
    $row_count = mysqli_num_rows($result);
          echo "<tr>
      <th>Order ID</th>
      <th>Order Status</th>
      <th>Amount</th>
      <th>Customer ID</th>
      <th>Order Date</th>
      <th>Customer Phone</th>
      <th>Customer Address</th>
      <th>Edit</th>
      <th>Delete</th>
      
      
      
      </tr>";

      if($row_count==0){
        echo "<h2 class='text-danger text-center mt-5'>No orders at the moment</h2>";
      }else{

        $number=0;
        while($row_data=mysqli_fetch_assoc($result)){
          $order_id=$row_data['order_id'];
          $order_cost=$row_data['order_cost'];
        
          $customer_id=$row_data['customer_id'];
          $order_date=$row_data['order_date'];
          $customer_phone=$row_data['customer_phone'];
          $customer_address=$row_data['customer_address'];
          $order_status=$row_data['order_status'];



       
    ?>


    <tr>
      <td><?php echo $order_id; ?></td>
      <td><?php echo $order_status; ?></td>
      <td><?php echo $order_cost; ?></td>
      <td><?php echo $customer_id; ?></td>
      <td><?php echo $order_date ?></td>
      <td><?php echo  $customer_phone ?></td>
      <td><?php echo $customer_address; ?></td>
      <td><a href="index.php?edit_order=<?php echo $order_id ?>"><i class="ri-edit-2-fill"></i></a></td>
      <td><a href="index.php?delete_order=<?php echo $order_id ?>"><i class="ri-delete-bin-6-fill"></i></a></td>
    </tr>
    <?php }} ?>