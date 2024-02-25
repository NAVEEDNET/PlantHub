<?php
include('includes/connect.php');
session_start();

// Avoid using @ to suppress errors, it's better to handle errors explicitly

// Get plant quantity and ID from the form
$u = isset($_POST['plant_quantity']) ? $_POST['plant_quantity'] : 0; // Make sure $u has a value
$pid = isset($_POST['plant_id']) ? $_POST['plant_id'] : 0; // Make sure $pid has a value

$query = mysqli_query($con, "SELECT * FROM plants WHERE plant_id='$pid'");
$result = mysqli_num_rows($query);

if ($result > 0) {
  while ($row = mysqli_fetch_array($query)) {
    $qty = $row['plant_quantity'];
  }
}

if (isset($_POST['add_to_cart'])) {
  if ($u > $qty) {
    // Handle this case appropriately (alert or redirection)
  echo '<script>alert("Not enough quantity available");';
  echo 'setTimeout(function() {';
  echo '  window.location.href = "product_details.php?plant_id=' . $pid . '";';
  echo '}, 1000);</script>'; // Redirect after 3 seconds

    exit; // Important: Terminate script after redirection
  
  } else {
    if (isset($_SESSION['cart'])) {
      $plants_array_ids = array_column($_SESSION['cart'], "plant_id");

      if (!in_array($pid, $plants_array_ids)) {
        $plant_array = array(
          'plant_id' => $pid,
          'plant_name' => $_POST['plant_name'],
          'plant_price' => $_POST['plant_price'],
          'plant_image' => $_POST['plant_image'],
          'plant_quantity' => $u // Use $u here, not $_POST['plant_quantity']
        );

        $_SESSION['cart'][$pid] = $plant_array;
      } else {
        echo "<script> alert('Product is already in the cart');</script>";
      }
    } else {
      $plant_array = array(
        'plant_id' => $pid,
        'plant_name' => $_POST['plant_name'],
        'plant_price' => $_POST['plant_price'],
        'plant_image' => $_POST['plant_image'],
        'plant_quantity' => $u
      );

      $_SESSION['cart'][$pid] = $plant_array;
    }

    calculateTotalCart();
  }
} else if (isset($_POST['remove_plant'])) {
  $plant_id = $_POST['plant_id'];
  unset($_SESSION['cart'][$plant_id]);
  calculateTotalCart();
} else if (isset($_POST['edit_quantity'])) {
  $plant_id = $_POST['plant_id'];
  $plant_quantity = $_POST['plant_quantity'];

  $plant_array = $_SESSION['cart'][$plant_id];
  $plant_array['plant_quantity'] = $plant_quantity;
  $_SESSION['cart'][$plant_id] = $plant_array;

  calculateTotalCart();
} else {
  // Handle other cases or redirections
}

function calculateTotalCart()
{
  $total_price = 0;
  $total_quantity = 0;

  foreach ($_SESSION['cart'] as $key => $value) {
    $plant = $_SESSION['cart'][$key];
    $price = $plant['plant_price'];
    $quantity = $plant['plant_quantity']; // No need to suppress errors here

    $total_price += ($price * $quantity);
    $total_quantity += $quantity;
  }

  $_SESSION['total'] = $total_price;
  $_SESSION['quantity'] = $total_quantity;
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
<?php

include('layouts/header.php');
?>
 <style>
    .cart .remove-btn {
      color: darkolivegreen;
      text-decoration: none;
      font-size: 16px;
      background-color: #fff;
      border: none;
      width: 100%;
      text-align: left;
      padding-left: 0%;


    }

    .cart .edit-btn {
      color: darkolivegreen;
      text-decoration: none;
      font-size: 16px;
      background-color: #fff;
      border: none;

      text-align: left;



    }
  </style>

  
</head>

<body>


 <!--nav bar-->
 <?php
include('layouts/navigation.php');
?>






  <!--cart ******************************** vdo 41-->
  <section class="cart container my-5 py-5">
    <div class="container mt-5">
      <h2 class="font-weigght-bold">Your Cart</h2>




    </div>
    <table class="mt-5 pt-5">
  <tr>
    <th>Product</th>
    <th>Quantity</th>
    <th>Sub total</th>
  </tr>

  <?php
  if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $key => $value) {
      ?>

      <tr>
        <td>
          <div class="product-info">
            <img src="admin_/plant_images/<?php echo @$value['plant_image']; ?>" />
            <div>
              <p><?php echo @$value['plant_name']; ?></p>
              <small><span>Rs </span><?php echo @$value['plant_price'], ".00"; ?></small>
              <br>
              <form method="post" action="cart.php">
                <input type="hidden" name="plant_id" value="<?php echo @$value['plant_id']; ?>" />
                <input type="submit" name="remove_plant" class="remove-btn" value="Remove" />
              </form>
            </div>
          </div>
        </td>

        <td>
          <form action="cart.php" method="post">
            <input type="hidden" name="plant_id" value="<?php echo @$value['plant_id']; ?>">
            
            <?php
            $available_quantity = 0;
            $plant_id = @$value['plant_id'];
            $query = mysqli_query($con, "SELECT plant_quantity FROM plants WHERE plant_id='$plant_id'");
            if ($query) {
              $row = mysqli_fetch_assoc($query);
              $available_quantity = $row['plant_quantity'];
            }
            ?>

            <input type="number" name="plant_quantity" value="<?php echo min($value['plant_quantity'], $available_quantity); ?>" max="<?php echo $available_quantity; ?>" min=1 >
            <input class="edit-btn" value="Edit" name="edit_quantity" type="submit">
          

         

          </form>
        </td>
        
        <td>
          <span>Rs </span>
          <span class="product-price"><?php echo @$value['plant_price'] * $value['plant_quantity'] . ".00"; ?></span>
        </td>
      </tr>
      
      <?php
    }
  }
  ?>
</table>



    <div class="cart-total">
      <table>
        <!--  <tr>
          <td>Subtotal</td>
          <td>$50</td>
        </tr>-->
        <tr>

          <td>Total </td>
          <td>Rs <?php if (isset($_SESSION['total'])) { echo $_SESSION['total'] . ".00";} ?></td>

        </tr>

      </table>

    </div>

    <div class="checkout-container">
      <form action="checkout.php" method="post">
        <input type="submit" class="checkout-btn mt-3 " value="CHECKOUT" name="checkout">
      </form>
      

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