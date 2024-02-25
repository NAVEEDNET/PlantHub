<?php
session_start();

/*
not paid
shipped
delivered

*/
include('includes/connect.php');

if (isset($_POST['order_details_btn']) && isset($_POST['order_id'])) {

    $order_id = $_POST['order_id'];
    $order_status = $_POST['order_status'];
    $stmt = $con->prepare("SELECT * FROM order_items WHERE order_id=?");
    $stmt->bind_param('i', $order_id);
    $stmt->execute();
    //   $tot_cost=$_POST['order_cost'];

    $order_details = $stmt->get_result();

    $order_total_price = calculateTotalOrderPrice($order_details);
} else {
    header('location:account.php');
}









//to calculate the total
function calculateTotalOrderPrice($order_details)
{
    $total = 0;

    foreach ($row = $order_details as $row) {

        $plant_price = $row['plant_price'];
        $plant_quantity = $row['plant_quantity'];

        $total = $total + ($plant_price * $plant_quantity);
    }


    return $total;
}




?>


<!DOCTYPE html>
<html lang="en">

<head>
    <?php

    include('layouts/header.php');
    ?>


    <style>
        #order-details-btn {
            background: white;
            font-weight: 700;
            box-shadow: 0px 0px 0px transparent;
            border: 0px solid transparent;


        }


        #order-details-btn:hover {
            color: red;
        }

        .orders table {
            width: 100%;
            border-collapse: collapse;

        }

        .orders td {
            padding-top: 20px;
            padding-right: 20px;


        }

        .orders th {

            padding-top: 5px;
            padding-bottom: 5px;
            color: #fff;
            background-color: darkolivegreen;
            padding-right: 20px;


        }

        .orders img {
            width: 80px;
            height: 90px;
            margin-right: 10px;
        }

        .orders .product-info {
            display: flex;
            flex-wrap: wrap;
        }
    </style>


</head>

<body>


    <!--nav bar-->
    <?php
    include('layouts/navigation.php');
    ?>


    <!--Order details ********************************-->
    <section id="orders" class="orders container my-5 py-3">
        <div class="container mt-5">
            <h2 class="font-weight-bold text-center">Order Details</h2>

            <hr class="mx-auto w-25">



        </div>
        <table class="mt-5 pt-5 mx-auto">
            <tr>
                <th>Product</th>
                <th> Price</th>
                <th>Quantity</th>

            </tr>

            <?php
            foreach ($order_details as $row) {   ?>

                <tr>
                    <td>
                        <div class="product-info">
                            <img src="admin_/plant_images/<?php echo $row['plant_image']; ?>" alt="" /><br>

                            <div>

                                <p class="mt-3"><?php echo $row['plant_name']; ?></p>
                            </div>
                        </div>

                    </td>

                    <td>
                        <span>Rs <?php echo $row['plant_price']; ?></span>
                    </td>

                    <td>
                        <span><?php echo $row['plant_quantity']; ?></span>
                    </td>

                    <!--   <td>
                        <form action="">
                            <input type="submit" id="order-details-btn" value="More Details">

                        </form>

                    </td>
            -->
                </tr>

            <?php } ?>

        </table>

        <?php
        if ($order_status == "not paid") { ?>

            <form action="payment.php" method="post" style="float: right;">
                <input type="hidden" value="<?php echo $order_total_price;  ?>" name="order_total_price">
                <input type="hidden" value="<?php echo $order_status; ?>" name="order_status">
                <input type="hidden" value="<?php echo $order_id; ?>" name="order_id">

                <input type="submit" value="Pay Now" name="order_pay_btn" class="btn " style="background-color:dimgray; color: #fff;">
            </form>
        <?php } ?>





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