<div class="mt-5">
  <h3 class="text-center mt-5">Registered Customers</h3>
  <table class="table table-bordered mt-5 my-2 text-center">

    <?php
    //include('../includes/connect.php');
    $get_orders = "SELECT * from customer";
    $result = mysqli_query($con, $get_orders);
    $row_count = mysqli_num_rows($result);
          echo "<tr>
      <th>No</th>
      <th>Customer Name</th>
      <th>Email ID</th>
      <th>Customer ID</th>
      <th>Delete</th>
      
      
      
      </tr>";

      if($row_count==0){
        echo "<h2 class='text-danger text-center mt-5'>No orders at the moment</h2>";
      }else{

        $number=0;
        while($row_data=mysqli_fetch_assoc($result)){
          $customer_name=$row_data['customer_name'];
          $customer_email=$row_data['customer_email'];
          $customer_id=$row_data['customer_id'];
          
          $number++;
   


       
    ?>


    <tr>
      <td><?php echo $number; ?></td>
      <td><?php echo $customer_name; ?></td>
      <td><?php echo $customer_email; ?></td>
      <td><?php echo $customer_id; ?></td>
    
     <td><a href="index.php?delete_customer=<?php echo $customer_id?>"><i class="ri-delete-bin-6-fill"></i></a></td>
    </tr>
    <?php }} ?>