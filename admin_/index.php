<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
  header('location:login.php');
  exit;
}
include('../includes/connect.php');
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin_Dashboard</title>
  <!--bootsrap css link-->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <link rel="stylesheet" href="admin_style.css">


  <!--  _________________ Favicon img _____________-->
  <link rel="shortcut icon" href="images/favicon.jpg" type="image/x-icon">


  <!--  _________________ Remix Icons _____________-->
  <link href="https://cdn.jsdelivr.net/npm/remixicon@3.0.0/fonts/remixicon.css" rel="stylesheet">


  <style>
    h2 {
      text-transform: uppercase;
      text-align: center;

    }

    hr {
      /*width: 30px;*/
      height: 3px;
      opacity: 1 !important;
      background-color: darkolivegreen;


    }

    .abc {
      background-color: darkolivegreen;
      color: white;
      font-weight: 900;
      width: 200px;
      padding: 5px;
      border-color: darkolivegreen;
      margin-left: 200px;







    }

    .abc:hover {
      background-color: white;
      color: darkolivegreen;

      border-color: darkolivegreen;
    }

    #buttons .ad_btn {
      font-size: 1rem;
      font-weight: 900;
      outline: none;
      border: none;
      display: block;
      border-radius: 0%;
      text-transform: uppercase;
      color: wheat;
      background-color: rgb(159, 160, 158);
      text-align: center;
      text-decoration: none;
      font-size: 16px;
      cursor: pointer;
      width: 200px;

      cursor: pointer;
      transition: 0.5s ease;

    }

    #buttons .ad_btn:hover {
      background-color: darkolivegreen;
    }
  </style>
</head>

<body>
  <?php
  if (isset($_GET['login_success']) && $_GET['login_success'] !== '') { ?>
    <?php echo "<script>alert('" . $_GET['login_success'] . "');</script>"; ?>
  <?php } ?>

  <!--nav bar-->
  <div>

    <?php
    include('ad_layouts/navbar.php');
    ?>


    <!--2nd part-->
    <br><br><br><br>

    <div class="container text-center mt-3 py-1">
      <h2 class="admin_h2">Welcome Admin</h2>

    </div>

    <!--3rd partttt-->
    <div class="row">
      <div class="col-lg-2 col-md-2 col-sm-2 text-nowrap " id="buttons">
        <?php
        include('ad_layouts/sidemenu.php'); ?>
      </div>
      <!-- 4th  partttt-->
      <div class="container col-lg-8 col-md-8 col-sm-6 mt-3">
        <?php

        if (isset($_GET['insert_category'])) {
          include('insert_categories.php');
        }


        if (isset($_GET['view_products'])) {
          include('view_products.php');
        }

        if (isset($_GET['edit_products'])) {
          include('edit_products.php');
        }
        if (isset($_GET['delete_product'])) {
          include('delete_product.php');
        }

        if (isset($_GET['view_categories'])) {
          include('view_category.php');
        }
        if (isset($_GET['edit_category'])) {
          include('edit_category.php');
        }
        if (isset($_GET['delete_category'])) {
          include('delete_category.php');
        }
        if (isset($_GET['list_orders'])) {
          include('list_orders.php');
        }
        if (isset($_GET['edit_order'])) {
          include('edit_order.php');
        }
        if (isset($_GET['delete_order'])) {
          include('delete_order.php');
        }
        if (isset($_GET['list_payments'])) {
          include('list_payments.php');
        }
        if (isset($_GET['delete_payment'])) {
          include('delete_payment.php');
        }
        if (isset($_GET['list_users'])) {
          include('list_users.php');
        }
        if (isset($_GET['delete_customer'])) {
          include('delete_customer.php');
        }

        if (isset($_GET['insert_faq'])) {
          include('insert_faq.php');
        }

        if (isset($_GET['view_faq'])) {
          include('view_faqs.php');
        }

        if (isset($_GET['delete_faq'])) {
          include('delete_faq.php');
        }
       
        ?>
      </div>


    </div>




  </div>































  <?php
  include('ad_layouts/footer.php');
  ?>




  <!--bootstrap js link-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>