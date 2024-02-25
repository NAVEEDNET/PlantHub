<?php
session_start();





if (!empty($_SESSION['cart'])) { //cart page's checkout btn
//let user in

} else {
  header('location:index.php');
}



?>


<!DOCTYPE html>
<html lang="en">

<head>
<?php

include('layouts/header.php');
?>
</head>

<body>



 <!--nav bar-->
 <?php
include('layouts/navigation.php');
?>




  <!--checkout-->
  <section class="my-5 py-5">

  <?php if (isset($_GET['message'])) {?>
    <a href="login.php" class="btn btn-secondary mt-2" style="width: 100px;">Login</a>
    
  <?php } ?>

    <div class="container text-center mt-3 pt-5">
      <h2 class="form-weight-bold">Checkout</h2>
      <hr class="mx-auto w-25">
    </div>
    <div class="mx-auto container">

      <form action="includes/place_order.php" id="checkout-form" method="post">

<!--getting the message from place order php-->
<p><?php if(isset($_GET['message'])){
  echo "<script>alert('" . $_GET['message'] . "');</script>"; }?>

  
</p>





        <div class="form-group checkout-small-element">
          <label>Name</label>
          <input type="text" class="form-control" id="checkout-name" name="name" pattern="^[a-zA-Z]+" placeholder="Name" required  title="please enter valid name" />
        </div>

        <div class="form-group checkout-small-element">
          <label>Email</label>
          <input type="text" class="form-control" id="checkout-email" name="email" placeholder="Email" required />
        </div>

        <div class="form-group checkout-small-element">
          <label>Phone</label>
          <input type="text" class="form-control" id="checkout-phone" name="phone"   pattern="^[0-9]+" maxlength="10"  minlength="10" laceholder="Phone" required title="Phone number should be  only 10 digit" >
        </div>

        <div class="form-group checkout-small-element">
          <label>City</label>
          <input type="text" class="form-control" id="checkout-city" name="city" placeholder="City"  pattern="^[a-zA-Z]+"  title="please enter valid city name"required />
        </div>

        <div class="form-group checkout-large-element">
          <label>Address</label>
          <input type="text" class="form-control" id="checkout-address" name="address" placeholder="Address"   required />
        </div>

        <div class="form-group checkout-btn-container">
          <p>Total Amount: Rs. <?php echo $_SESSION['total'] . ".00"; ?></p>

          <input type="submit" class="btn" id="checkout-btn" value="Place Order" name="place_order" />
        </div>

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