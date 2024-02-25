<?php




session_start();
include('includes/connect.php');

if (!isset($_SESSION['logged_in'])) {
  header('location:login.php');

  exit;
}


if (isset($_GET['success']) && $_GET['success'] === 'true') {
    echo '<script>alert("Payment successful!");</script>';
}




if (isset($_GET['logout'])) {
  if (isset($_SESSION['logged_in'])) {
    unset($_SESSION['logged_in']);
    unset($_SESSION['customer_email']);
    unset($_SESSION['customer_name']);
    header('location: login.php');
    exit;
  }
}


if (isset($_POST['change_password'])) {
  $password = $_POST['password'];
  $confirmPassword = $_POST['confirmPassword'];
  $customer_email = $_SESSION['customer_email'];



  //if passwords dont match
  if ($password !== $confirmPassword) {

    //echo ' alert("recheck the password field and confirm password field")'; 
    header('location:account.php?error=passwords do not match');
  }


  //if password less then 6 characters
  else if (strlen($password) < 6) {

    //echo ' alert("recheck the password field and confirm password field")'; 
    header('location:account.php?error=password must be atleast six characters');
  } else { //if there is no error
    $stmt = $con->prepare("UPDATE customer SET customer_password=? WHERE customer_email=?");

    $stmt->bind_param('ss', md5($password), $customer_email);
    if ($stmt->execute()) {

      header('location: account.php?message=password has been updated successfully');
    } else {
      header('location:error=somthing went wrong,could not update password');
    }
  }
}



//get orderssssss............

if (isset($_SESSION['logged_in'])) {
  $customer_id = $_SESSION['customer_id'];
  $stmt = $con->prepare("SELECT * FROM orders WHERE customer_id =?");
  $stmt->bind_param('i', $customer_id);
  $stmt->execute();
  $orders = $stmt->get_result(); //array
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

    .orders td {
      padding-top: 20px;


    }

    .orders th {

      padding-top: 10px;
      color: #fff;
      background-color: darkolivegreen;


    }
  </style>
</head>

<body>

  <!--nav bar-->
  <?php


  include('layouts/navigation.php');
  ?>






  <!--account page-->

  <section class="my-5 py-5">
    <?php if (isset($_GET['register_success']) && $_GET['register_success'] !== '') { ?>
      <p style="color:green;"><?php echo "<script>alert('" . $_GET['register_success'] . "');</script>"; ?>
      </p><?php } ?>

    <?php if (isset($_GET['login_success']) && $_GET['login_success'] !== '') { ?>
      <p style="color:green;"><?php echo "<script>alert('" . $_GET['login_success'] . "');</script>"; ?>
      </p><?php } ?>
    <div class="row container mx-auto">

      <div class="text-center mt-3 pt-5  col-lg-6 col-md-12 col-sm-12">
        <h4 class="font-weight-bold">Account Information</h4>
        <hr class="mx-auto">
        <div class="account-info">
          <p style="text-align:center;">Name : <span><?php if (isset($_SESSION['customer_name'])) {
                                                        echo $_SESSION['customer_name'];
                                                      } ?></span></p>
          <p style="text-align:center;">Email : <span><?php if (isset($_SESSION['customer_email'])) {
                                                        echo $_SESSION['customer_email'];
                                                      } ?></span></p>
          <p><a href="#orders" id="orders-btn" style="text-align:right;">Your orders</a></p>
          <p><a href="account.php?logout=1" id="logout-btn" style="text-align:right;">Logout</a></p>

        </div>

      </div>
      <div class="col-lg-6 col-md-12 col-sm-12">

        <?php if (isset($_GET['message']) && $_GET['message'] !== '') { ?>
          <p style="color:green;"><?php echo "<script>alert('" . $_GET['message'] . "');</script>"; ?>
          </p><?php } ?>

        <form action="account.php" method="post" id="account-form">
          <h4>Change Password</h4>
          <hr class="mx-auto">
          <div class="form-group">
            <label for="">Password</label>
            <input type="password" class="form-control" id="account-password" placeholder="Password" name="password" required />
          </div>

          <div class="form-group">
            <label for="">Confirm Password</label>
            <input type="password" class="form-control" id="account-password-confirm" placeholder="Password" name="confirmPassword" required />
          </div>

          <?php if (isset($_GET['error']) && $_GET['error'] !== '') { ?>
            <p style="color:red;"><?php echo $_GET['error']; ?></p><?php } ?>



          <div class="form-group">
            <input type="submit" value="Change Password" name="change_password" class="btn" id="change-pass-btn">
          </div>
        </form>
      </div>
    </div>

  </section>




  <!--Orders ********************************-->
  <section id="orders" class="orders container my-5 py-3">
    <div class="container mt-2">
      <h2 class="font-weight-bold text-center">My orders</h2>

      <hr class="mx-auto w-25">



    </div>
    <table class="mt-5 pt-5">
      <tr>
        <th>Order ID</th>
        <th>Order Cost</th>
        <th>Order Status</th>
        <th>Ordered Date</th>
        <th>Order Details</th>

      </tr>

      <?php
      while ($row = $orders->fetch_assoc()) {   ?>

        <tr>
          <td>
            <span><?php echo $row['order_id'] ?></span>
          </td>

          <td>
            <span><?php echo $row['order_cost'] ?></span>
          </td>

          <td>
            <span><?php echo $row['order_status'] ?></span>
          </td>

          <td>
            <span><?php echo $row['order_date'] ?></span>
          </td>

          <td>
            <form action="order_details.php" method="post">
    
              <input type="hidden" value="<?php echo $row['order_status']; ?>" name="order_status">
              <input type="hidden" value="<?php echo $row['order_id']; ?>" name="order_id" />
              <input type="submit" id="order-details-btn" name="order_details_btn" value="More Details">

            </form>

          </td>

        </tr>

      <?php } ?>


    </table>



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