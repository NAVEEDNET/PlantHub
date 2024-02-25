<?php
/*
session_start();
include('includes/connect.php');

if(isset($_SESSION['logged_in'])){
  header('Location: account.php');
  exit; 




}

if (isset($_POST['login_btn'])) {

  $email = $_POST['email'];
  $password = md5($_POST['password']);

  $stmt = $con->prepare("SELECT customer_id,customer_name,customer_email,customer_password FROM customer WHERE customer_email=? AND customer_password=? LIMIT 1");

  $stmt->bind_param('ss',$email,$password);

  if ($stmt->execute()) {

    $stmt->bind_result($customer_name,$customer_email,$customer_password);
    $stmt->store_result();

    if($stmt->num_rows()==1){
      $stmt->fetch();

      $_SESSION['customer_id'] = $customer_id;
      $_SESSION['customer_name'] = $customer_name;
      $_SESSION['customer_email'] = $customer_email;
      $_SESSION['logged_in']=true;

      header('Location: account.php?message=logged in successfully'); 


    }else{
      header('Location: login.php?error=could not verify your account'); 
    }

  } else {
    //errors
    header('location:login.php?error=Something went wrong');
       


  }
  

}



*/





session_start();
include('includes/connect.php');

if(isset($_SESSION['logged_in'])){
  header('Location: account.php');
  exit; 
}

if (isset($_POST['login_btn'])) {
  $email = $_POST['email'];
  $password = md5($_POST['password']);

  $stmt = $con->prepare("SELECT customer_id,customer_name,customer_email,customer_password FROM customer WHERE customer_email=? AND customer_password=? LIMIT 1");

  $stmt->bind_param('ss',$email,$password);

  if ($stmt->execute()) {

    $stmt->bind_result($customer_id, $customer_name, $customer_email, $customer_password);
    $stmt->store_result();

    if($stmt->num_rows() == 1){
      $stmt->fetch();

      $_SESSION['customer_id'] = $customer_id;
      $_SESSION['customer_name'] = $customer_name;
      $_SESSION['customer_email'] = $customer_email;
      $_SESSION['logged_in'] = true;

      header('Location: account.php?login_success=logged in successfully'); 
    } else {
      header('Location: login.php?error=invalid email ID or password'); 
    }

  } else {
    header('Location: login.php?error=Something went wrong');
  }
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






  <!--Login page-->

  <section class="my-5 py-5">
    <div class="container text-center mt-3 pt-5">
      <h2 class="form-weight-bold">Login</h2>
      <hr class="mx-auto w-25">
    </div>
    <div class="mx-auto container">

      <form action="login.php" method="post" id="login-form">

<!--      <p><?php // if(isset($_GET['login_alert'])){
 // echo "<script>alert('" . $_GET['login_alert'] . "');</script>"; }?>

  
</p>-->

        <div class="form-group ">
          <label>Email</label>
          <input type="text" class="form-control" id="login-email" name="email" placeholder="Email" required />
        </div>

        <div class="form-group">
          <label>Password</label>
          <input type="password" class="form-control" id="login-password" name="password" placeholder="Password" required />
        </div>
        <?php if (isset($_GET['error']) && $_GET['error'] !== '') { ?>
          <p style="color:red;" class="text-center"><?php echo $_GET['error']; ?></p><?php } ?>
        <div class="form-group">

        <div class="form-group">

          <input type="submit" class="btn" id="login-btn" name="login_btn" value="Login" />
        </div>

        <div class="form-group">
          <a href="register.php" id="register-url" class="btn">Don't have an Account? <span> Register</span></a>
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