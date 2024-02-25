<?php
include('includes/connect.php');
if (isset($_POST['pay'])) {
    $card_holder_name = $_POST['card_holder_name'];
    $card_no = $_POST['card_no'];
    $card_date = $_POST['card_date'];
    $card_cvv = $_POST['card_cvv'];
    $payment_mtd = $_POST['payment_mtd'];
    $amount = $_POST['amount'];
    $order_id = $_POST['order_id'];

            $currentDate = new DateTime(); // Creates a DateTime object with the current date and time.
            $endDate = new DateTime($card_date  ); // Your desired end date.
            $interval = $currentDate->diff($endDate); // Calculates the date interval between current date and end date.
            $diffrent = $interval->format('%R%a ');



    // Validation code here (as shown in the previous examples)


    $errors = array(); // Initialize an array to store validation errors

    // Validate card holder name
    if (empty($card_holder_name)) {
        $errors['card_holder_name'] = "Card holder name is required.";
    }elseif (is_numeric($card_holder_name)) {
        $errors['card_holder_name'] = "dont use numbers in Card holder name.";
    }

    // Validate card number
    if (empty($card_no)) {
        $errors['card_no'] = "Card number is required.";
    } elseif (!is_numeric($card_no)) {
        $errors['card_no'] = "Card number must be numeric.";
    }elseif( strlen($card_no)!=16){
        $errors['card_no'] = "Card number must be 16 digit number.";
    }

    // Validate card expiry date
    if (empty($card_date)) {
        $errors['card_date'] = "Card expiry date is required.";
    }
    elseif ($diffrent<=0) {
       $errors['card_date'] = "your card is out of date.";
    }

    // Validate card CVV
    if (empty($card_cvv)) {
        $errors['card_cvv'] = "Card CVV is required.";
    } elseif (!is_numeric($card_cvv)) {
        $errors['card_cvv'] = "Card CVV must be numeric.";
    }elseif( strlen($card_cvv)!=3){
        $errors['card_cvv'] = "Card CVV must be 3 digit number.";
    }

    // Validate payment method
    if (empty($payment_mtd)) {
        $errors['payment_mtd'] = "Payment method is required.";
    }

    // Validate amount
    if (empty($amount)) {
        $errors['amount'] = "Amount is required.";
    } elseif (!is_numeric($amount)) {
        $errors['amount'] = "Amount must be numeric.";
    }




    if (empty($errors)) {


$sql = "INSERT INTO payments (order_id, card_holder_name, card_no, card_date, card_cvv, payment_mtd, amount,date_of_payment)
        VALUES ('$order_id', '$card_holder_name', '$card_no', '$card_date', '$card_cvv', '$payment_mtd', '$amount',NOW())";


        if ($con->query($sql) === TRUE)
         {
             $updateOrderSql = "UPDATE orders SET order_status = 'paid' WHERE order_id = '$order_id'";
              if ($con->query($updateOrderSql) === TRUE) {
              // Redirect to account.php with a success message as a query parameter
                  header('location: account.php?success=true');
           } 
          else {
                 echo "Error updating order status: " . $con->error;
             }
       } 


         else {
              echo "Error: " . $con->error;
          }


        $con->close();
    } 

     {
        // There are validation errors, display them to the user
        
       
        foreach ($errors as $error) {
           echo '<script>alert("' . $error. '");</script>';

        }
        echo '<script> window.location.href = "payment.php?order_status=' . $order_status . '&order_id=' . $order_id . '";</script>';
    }
}




?>