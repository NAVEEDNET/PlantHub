<?php
include('includes/connect.php');

session_start();

/*
if (!empty($_SESSION['cart']) && isset($_POST['checkout'])) { //cart page's checkout btn


} else {
  header('location:index.php');
}

*/

if (isset($_POST['order_pay_btn'])) {
    $order_status = $_POST['order_status'];
    $order_total_price = $_POST['order_total_price'];
    $order_id = $_POST['order_id'];
} else {
    $order_id = $_GET['order_id'];
   // $order_status=$_GET['order_status'];
}
//if($order_status==='not paid'){
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <?php

    include('layouts/header.php');
    ?>
    <style>
        .pay-btn {

            border-top: darkolivegreen;
            border-left: darkolivegreen;
            border-bottom: darkolivegreen;
            border-right: darkolivegreen;

            width: 200px;

            background-color: darkolivegreen;
            color: white;
            padding: 10px 20px;
        }

        .smll-img {
            width: 80px;
            height: 90px;
            /* margin-right: 10px;*/
        }

        body {

            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        h2,
        h3,
        h4 {
            text-align: center;
            font-weight: bold;
        }

        hr {
            margin: 15px auto;
            border: 1px solid #ccc;
            width: 25%;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        td {
            padding: 10px;
            border: 1px solid #ccc;
            vertical-align: top;
        }

        .smll-img {
            max-width: 60px;
            margin-right: 10px;
        }

        /* Style for the select element */
        select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            background-color: #f8f8f8;
            font-size: 16px;
            color: #333;
        }

        /* Style for the select arrow */
        select::-ms-expand {
            display: none;
        }

        /* Style for option elements */
        option {
            background-color: #fff;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
        }

        .input-group {
            margin-bottom: 15px;
        }

        .input-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .input-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        select,
        input[type="text"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }
    </style>


</head>

<body>




    <!--nav bar-->
    <?php
    include('layouts/navigation.php');
    ?>

    <?php
    if ($order_id) { ?>

        <div class="mt-5 mx-auto container text-center">



            <!--payment-->
            <section class="my-2 py-2">
                <div class="container text-center mt-3 pt-5">
                    <h2 class="form-weight-bold">Payment</h2>
                    <hr class="mx-auto">
                </div>

                <div class="container">
                    <h4 style="text-align: left"> Order ID : <?php echo $order_id; ?></h4>


                    <?php

                    $stmt_order = $con->prepare("SELECT * FROM orders WHERE order_id =$order_id");
                    $stmt_order->execute();
                    $orderr = $stmt_order->get_result();

                    ?><?php

                        while ($row = $orderr->fetch_assoc()) {
                        ?>
                    <div>
                        <h3>Customer Details</h3>
                        <?php
                            $stmt_cus = $con->prepare("SELECT * FROM customer WHERE customer_id = ?");
                            $stmt_cus->bind_param("s", $row['customer_id']);
                            $stmt_cus->execute();
                            $customer = $stmt_cus->get_result();

                            while ($row_cus = $customer->fetch_assoc()) {
                        ?>
                            <div class="customer-details">
                                <p><strong>Name:</strong> <?php echo $row_cus['customer_name']; ?></p>
                                <p><strong>Phone No:</strong> <?php echo $row['customer_phone']; ?></p>
                                <p><strong>Email:</strong> <?php echo $row_cus['customer_email']; ?></p>
                                <p><strong>Address:</strong> <?php echo $row['customer_address']; ?></p>
                                <p><strong>City:</strong> <?php echo $row['customer_city']; ?></p>
                            </div>
                        <?php
                            }
                            //   $stmt_cus->close();
                        ?>
                    </div>
                <?php
                        }
                ?>


                <div class="container mt-2">
                    <h3>Order Summary</h3>
                    <?php $stmt_orderItems = $con->prepare("SELECT * FROM order_items WHERE order_id =$order_id");
                    $stmt_orderItems->execute();
                    $order_items = $stmt_orderItems->get_result();

                    ?>

                    <table>
                        <?php while ($row3 = $order_items->fetch_assoc()) { ?>
                            <tr>
                                <td>
                                    <div style="display: flex; align-items: center;">
                                        <img src="admin_/plant_images/<?php echo $row3['plant_image']; ?>" class="smll-img">
                                        <div>
                                            <p style="margin: 0;"><?php echo $row3['plant_name']; ?></p>
                                            <p>Rs <?php echo $row3['plant_price']; ?></p>
                                            <p>Quantity:<strong><?php echo $row3['plant_quantity']; ?></strong></p>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>

                    </table>

                </div>






                <?php
                if (isset($_SESSION['total']) && $_SESSION['total'] != 0) { ?>





                    <div>
                        <h3>Summary</h3>






                        <div class="container">

                            <table>


                                <tr>
                                    <td>Estimated Delivery</td>
                                    <td>within 5 days after paid the amount</td>
                                </tr>
                                <tr>
                                    <td>Total</td>
                                    <td>Rs. <?php echo $_SESSION['total'] . ".00"; ?></td>
                                </tr>
                                <tr>
                                    <td>Code</td>
                                    <td><!-- Insert code here --></td>
                                </tr>
                                <tr>
                                    <td>Total Shipping</td>
                                    <td><!-- Insert total shipping amount here --></td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <div class="container">
                        <form action="paymentProcess.php" method="POST">
                            <h3>Payment Method</h3>

                            <select name="payment_mtd" class="">
                                <option value="card">Card Payment</option>

                            </select>
                    </div>

                    <div class="input-group mx-5">
                        <label for="">Card Holder's Name</label>
                        <input type="text" name="card_holder_name">
                    </div>

                    <div class="input-group mx-5">
                        <label for="">Card Number</label>
                        <input type="text" name="card_no">
                    </div>


                    <div class="input-group mx-5">
                        <label for="">Date</label>
                        <input type="date" name="card_date">
                    </div>

                    <div class="input-group mx-5">
                        <label for="">CVV</label>
                        <input type="text" name="card_cvv">
                    </div>
                    <input type="hidden" name="amount" value="<?php echo $_SESSION['total']; ?>">
                    <input type="hidden" name="order_id" value="<?php echo $order_id; ?>">
                 

                </div>




                <!--<p>Total Payment: Rs. <?php // echo $_SESSION['total'] . ".00"; 
                                            ?></p>
                        --><input class="pay-btn" type="submit" value="Pay Now" name="pay" />
                </form>


            <?php } else if (isset($_POST['order_status']) && $_POST['order_status'] == "not paid") { ?>



                <!--  <div class="mt-5 mx-auto container text-center">--->



                <div>
                    <h3>Summary</h3>






                    <div class="container">

                        <table>


                            <tr>
                                <td>Estimated Delivery</td>
                                <td>within 5 days after paid the amount</td>
                            </tr>
                            <tr>
                                <td>Total</td>
                                <td>Rs. <?php echo $_POST['order_total_price'] . ".00"; ?></td>
                            </tr>
                            <tr>
                                <td>Code</td>
                                <td><!-- Insert code here --></td>
                            </tr>
                            <tr>
                                <td>Total Shipping</td>
                                <td><!-- Insert total shipping amount here --></td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="container">
                    <form action="paymentProcess.php" method="POST">
                        <h3>Payment Method</h3>

                        <select name="payment_mtd" class="">
                            <option value="card">Card Payment</option>

                        </select>
                </div>

                <div class="input-group mx-5">
                    <label for="">Card Holder's Name</label>
                    <input type="text" name="card_holder_name">
                </div>

                <div class="input-group mx-5">
                    <label for="">Card Number</label>
                    <input type="text" name="card_no">
                </div>


                <div class="input-group mx-5">
                    <label for="">Date</label>
                    <input type="date" name="card_date">
                </div>

                <div class="input-group mx-5">
                    <label for="">CVV</label>
                    <input type="text" name="card_cvv">
                </div>
                <input type="hidden" name="amount" value="<?php echo $_POST['order_total_price']; ?>">
                <input type="hidden" name="order_id" value="<?php echo $order_id; ?>">
               <!-- <input type="hidden" name="order_status" value="<?php // echo $_POST['order_status'] ?>">
            --></div>





        <input class="pay-btn" type="submit" value="Pay Now" name="pay" />
        </form>





    <?php }
            } else { ?>
    <div class="mt-5 mx-auto container text-center">
        <section class="my-2 py-2">
            <div class="container text-center mt-3 pt-5">
                <p>You don't have an order</p>
            </div>
        </section>
    </div>
<?php }//}else{
    // echo " <script>alert('payment already done')</script>";
    // header('location:account.php');
//} ?>






</div>


<div>
    <h3></h3>
</div>
</section>























<!-- ____________Foooter section__________________  -->
<footer class="mt-5 p-5">
    <div class="row container mx-auto pt-5">
        <div class="footer-one col-lg-3 col-md-6 col-sm-12">
            <img src="images/logo.png" class="logoFooter" />

            <p class="p-3">we provide you with best kind of plants wih most affordable prices</p>
        </div>

        <div class="footer-one col-lg-3 col-md-6 col-sm-12">

            <h5 class="pb-2">Plant_HuB</h5>
            <ul class="text-uppercase">
                <li><a href="">Home</a></li>
                <li><a href="">about us</a></li>
                <li><a href="">products</a></li>
                <li><a href="">FAQs</a></li>


            </ul>

        </div>

        <div class="footer-one col-lg-3 col-md-6 col-sm-12">
            <h5 class="pb-2">Contect Us</h5>
            <div>
                <h6 class="text-uppercase">Address</h6>
                <p>141/A, Matale Road, Akurana</p>
            </div>

            <div>
                <h6 class="text-uppercase">Phone</h6>
                <p>081-2304567</p>
            </div>

            <div>
                <h6 class="text-uppercase">e-mail</h6>
                <p>plant_hub@gmail.com</p>
            </div>
        </div>

        <div class="footer-one col-lg-3 col-md-6 col-sm-12">

            <h5 class="pb-2">Instagram</h5>
            <div class="row">
                <img src="images/flowerPlants/Gerbera.jpg" class="img-fluid w-25 h-100 m-2 ">
                <img src="images/liked/rose.jpg" class="img-fluid w-25 h-100 m-2 ">
                <img src="images/flowerPlants/Peace lily.jpg" class="img-fluid w-25 h-100 m-2 ">

            </div>
        </div>


    </div>

    <div class="copywrite mt-5">
        <div class="row container mx-auto">

            <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
                <img src="images/payment2.jpg" />
            </div>


            <div class="col-lg-3 col-md-6 col-sm-12 text-nowrap">
                <br><br><br>
                <p>PLANT HUB CO. (PVT) LTD. All Rights Reserved.</p>
            </div>

            <!--    <div class="col-lg-3 col-md-6 col-sm-12 mb-4 "></div>-->


            <div class="col-lg-3 col-md-6 col-sm-12 mb-4 ">


                <a href="#"><!--fb --><i class="ri-facebook-circle-fill"></i></a>
                <a href="#"><i class="ri-instagram-line"></i></a>
                <a href="#"><!--twitter --><i class="ri-twitter-fill"></i></a>
            </div>
        </div>


    </div>
</footer>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

</body>

</html>


<?php



?>