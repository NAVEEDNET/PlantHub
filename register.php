<?php
include('includes/connect.php');
session_start();

if(isset($_SESSION['logged_in'])){//if user has already registered,then take user to account page
  header('location: account.php');
 //exit;
}

if (isset($_POST["register"])) {
  $name = $_POST["name"];
  $email = $_POST["email"];
  $password = $_POST["password"];
  $confirmPassword = $_POST["confirmPassword"];
 


  //if passwords dont match
  if ($password !== $confirmPassword) {
    header('location:register.php?error=passwords do not match');
  }


  //if password less then 6 characters
  else if (strlen($password) < 6) {
    header('location:register.php?error=password must be atleast six characters');

    //if there is no error
  } else {

    //check whether there is a user with this email or not
    $stmt1 = $con->prepare("SELECT COUNT(*) FROM customer WHERE customer_email=?");
    $stmt1->bind_param('s', $email);
    $stmt1->execute();
    $stmt1->bind_result($num_rows);
    $stmt1->store_result();
    $stmt1->fetch();

    if ($num_rows != 0) {
      header('location:register.php?error=User with this email is already exist');
    } else {
      //create a new user
      $stmt = $con->prepare("INSERT INTO customer (customer_name,customer_email,customer_password) VALUES (?,?,?);");
      $stmt->bind_param('sss',$name,$email,md5($password));

      if($stmt->execute()){
        //if account was created successfully
        $customer_id=$stmt->insert_id;

        $_SESSION['customer_id']=$customer_id;
        $_SESSION['customer_email']=$email;
        $_SESSION['customer_name']=$name;
        $_SESSION['logged_in']=true;
       
        
        header('location: account.php?register_success=You are Registered successfully');

      }else{//account could not been created successfully
        header('location: register.php?error=could not create an account at the moment');

      }
    }


   
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




  <!--Register page-->

  <section class="my-5 py-5">
    <div class="container text-center mt-3 pt-5">
      <h2 class="form-weight-bold">Register</h2>
      <hr class="mx-auto w-25">
    </div>
    <div class="mx-auto container">


      <form action="register.php" id="Register-form" method="post">


        <div class="form-group ">
          <label>Name</label>
          <input type="text" class="form-control" id="Register-name" name="name" placeholder="Name" pattern="[A-Za-z\s]+" required />
        </div>

        <div class="form-group ">
          <label>Email</label>
          <input type="email" class="form-control" id="Register-email" name="email" placeholder="Email" required />
        </div>

        <!-- <div class="form-group ">
          <label>Phone No</label>
          <input type="tel" class="form-control" id="Register-phone" name="phone" placeholder="Phone Number" required />
        </div>-->

        <div class="form-group">
          <label>Password</label>
          <input type="password" class="form-control" id="Register-password" name="password" placeholder="Password" required />
        </div>

        <div class="form-group">
          <label>Confirm Password</label>
          <input type="password" class="form-control" id="Register-confirm-password" name="confirmPassword" placeholder="Confirm Password" required />
        </div>
        <?php if (isset($_GET['error']) && $_GET['error'] !== '') { ?>
          <p style="color:red;"><?php echo $_GET['error']; ?></p><?php } ?>
        <div class="form-group">

          <input type="submit" class="btn" id="register-btn" value="Register" name="register" />
        </div>

        <div class="form-group">
          <a href="login.php" id="login-url" class="btn">Do You have an Account? <span>Login</span></a>
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