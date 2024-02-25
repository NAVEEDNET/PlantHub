<?php
session_start();

include("connect.php");
//include('includes/connect.php');

if (!isset($_SESSION['logged_in'])) {
   //if user is not logged in
    header('location:../checkout.php?message=Please Login /Register to Place Order');
    exit;

} else {

if (isset($_POST['place_order'])) {
    // Get user information from the form
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $city = $_POST['city'];
    $address = $_POST['address'];
    $order_cost = $_SESSION['total'];
    $order_status = "not paid";
    $customer_id = $_SESSION['customer_id'];
    $order_date = date('Y-m-d H:i:s'); // Fixed date format ('Y' for full year)
     
       $mobile_no= $phone/10000000;
         if ($mobile_no >= 79 || $mobile_no < 70) {
           echo '<script>alert("You have entered an invalid phone number");</script>';
           echo '<script>setTimeout(function() {';
           echo '  window.location.href = "../checkout.php";';
           echo '}, 3000);</script>'; // Redirect after 3 seconds
     }


    // Validate the email address format
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo '<script>alert("You have entered an invalid email address");</script>';
        echo '<script>setTimeout(function() {';
        echo '  window.location.href = "../checkout.php";';
        echo '}, 3000);</script>';
    }

        

          else{


        $stmt = $con->prepare(
            "INSERT INTO orders (order_cost,order_status,customer_id,customer_phone,customer_city,customer_address,order_date)
    VALUES(?,?,?,?,?,?,?);"    );

        $stmt->bind_param('isiisss', $order_cost, $order_status, $customer_id, $phone, $city, $address, $order_date);
         

        $stmt_status = $stmt->execute();
         
    


        if (!$stmt_status) {
            header('location:index.php');
            exit;
        }

        //2. issue new order and store order information in  db //issue new order and store order information in  db
        $order_id = $stmt->insert_id;
        // echo $order_id;



        //3. get products from cart(from session)
        foreach ($_SESSION['cart'] as $key => $value) {
            $plant = $_SESSION['cart'][$key]; //will return an array
            $plant_id = $plant['plant_id'];
            $plant_name = $plant['plant_name'];
            $plant_image = $plant['plant_image'];
            $plant_price = $plant['plant_price'];
            $plant_quantity = $plant['plant_quantity'];


            //4. store eacxh single item in order_items table in db
            $stmt1 = $con->prepare("INSERT INTO order_items(order_id,plant_id,plant_name,plant_image,plant_price,plant_quantity,customer_id,order_date) VALUES(?,?,?,?,?,?,?,?);");

            $stmt1->bind_param('iissiiis', $order_id, $plant_id, $plant_name, $plant_image, $plant_price, $plant_quantity, $customer_id, $order_date);
            $stmt1->execute();

            $available_quantity = 0;
            $plant_id = @$value['plant_id'];
            $query = mysqli_query($con, "SELECT plant_quantity FROM plants WHERE plant_id='$plant_id'");
            if ($query) {
              $row = mysqli_fetch_assoc($query);
              $available_quantity = $row['plant_quantity'];
              
              
            }

            $query2=mysqli_query($con,"SELECT sold FROM sold_item_qty WHERE plant_id='$plant_id'");
            if ($query2) {
              $res = mysqli_fetch_assoc($query2);
              $sold = $res['sold'];
            }

            $qty=$available_quantity-$plant_quantity;
            
            $sold_item=intval($sold)+$plant_quantity;

            $smt2="UPDATE plants set plant_quantity=$qty WHERE plant_id='$plant_id'";
            $smt3="UPDATE sold_item_qty set sold=$sold_item WHERE plant_id='$plant_id'";

            


              



            if(mysqli_query($con,$smt2)){
           //echo '<script>alert("Record Updated")</script>';
           }


            if(mysqli_query($con,$smt3)){
           //echo '<script>alert("Record Updated")</script>';
            }
           if($qty<1){
                 $update_query="UPDATE plants set status='false' WHERE plant_id='$plant_id'";

             if(mysqli_query($con,$update_query)){
           //echo '<script>alert("Record Updated")</script>';
            }
 
           }




        }
       


        //5. remove everything  from cart---delay until payment is done



        //6. inform user whether everything is fine or there is  prblm  
        header('location: ../payment.php?order_status='.$order_status .' & order_id='.$order_id);
    }

}
}
