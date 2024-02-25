<div class="mt-5">
  <h3 class="text-center mt-5">All Payments</h3>
  <table class="table table-bordered mt-5 my-2 text-center">

    <?php
    //include('../includes/connect.php');
    $get_payments = "SELECT * from payments";
    $result = mysqli_query($con, $get_payments);
    $row_count = mysqli_num_rows($result);
          echo "<tr>
      <th>No</th>
      <th>payment_id</th>
      <th>order_id</th>
      <th>card_holder_name</th>
      <th>card_no</th>   
      <th>card_date</th>
      <th>card_cvv</th>
      <th>payment_mtd</th>
      <th>amount</th>
      <th>date_of_payment</th>
      <th>Delete</th>
      
      
      
      </tr>";

      if($row_count==0){
        echo "<h2 class='text-danger text-center mt-5'>No payments received yet</h2>";
      }else{

        $number=0;
        while($row_data=mysqli_fetch_assoc($result)){
          $payment_id=$row_data['payment_id'];
          $order_id=$row_data['order_id'];
          $card_holder_name=$row_data['card_holder_name'];
          $card_no=$row_data['card_no'];
          $card_date=$row_data['card_date'];
          $card_cvv=$row_data['card_cvv'];

          $payment_mtd=$row_data['payment_mtd'];
          $amount=$row_data['amount'];
          $date_of_payment=$row_data['date_of_payment'];


          //$order_date=$row_data['date'];
        $number++;



       
    ?>


    <tr>
    <td><?php echo $number; ?></td>
    <td><?php echo $payment_id; ?></td>
      <td><?php echo $order_id; ?></td>
      <td><?php echo $card_holder_name; ?></td>
      <td><?php echo $card_no; ?></td>
      <td><?php echo  $card_date ?></td>
      <td><?php echo $card_cvv ?></td>
      <td><?php echo $payment_mtd ?></td>
      <td><?php echo $amount ?></td>
      <td><?php echo $date_of_payment ?></td>
    
      
      <td><a href="index.php?delete_payment=<?php echo $payment_id ?>"><i class="ri-delete-bin-6-fill"></i></a></td>
    </tr>
    <?php }} ?>