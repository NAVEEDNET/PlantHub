<?php
if(isset($_POST['send'])){
 $userName=$_POST["userName"];
 $email=$_POST["email"];
 $subject=$_POST["subject"];
 $message=$_POST["message"];

 
 $to = "planthub.plants@gmail.com";
 $subject = $subject;
 
 $message = $message;
 
 // Always set content-type when sending HTML email
 $headers = "MIME-Version: 1.0" . "\r\n";
 $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
 
 // More headers
 $headers .= 'From: planthub.plants@gmail.com';

 
 $mail = mail($to,$subject,$message,$headers);

 if($mail){
  echo "<script>alert('Mail send')</script>";

 }else{
  echo "<script>alert('Mail not send')</script>";

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



  <!--********************************     search bar     *****************************************-->
  <!--<section class="searchbar">
    <div class="search-container m-5 p-5 pb-2 fixed=top ">
      <form action="search_product.php" method="get" class="search text-nowrap mt-2">
        <input type="text" placeholder="Search.." name="search_data">
 
        <input type="submit" value="Search" class="btn " id="searchMe" name="search_data_product">

      </form>
    </div>


  </section>-->



  <!--contact-->
  <section id="contact" class="container my-5 py-5">
    <div class="container text-center mt-5">
      <h3>Contact Us</h3>
      <hr class="mx-auto w-25">
      <div class="row">
        <div class="col-lg-6 m-auto">
          <div class="card">
            <div class="card-body">
              <h2 class="card-title text-center py-2">Get in Touch</h2>

<?php
    
  
///////////////////////////////////////////////////////////////////


          ?>

              <form action="" method="post" class="text-start">
                <div class="mb-3">
                  <label for="name" class="form-label">Name</label>
                  <input type="text" name="userName" id="name" placeholder="Your Name" class="form-control">
                </div>
                <div class="mb-3">
                  <label for="email" class="form-label">Email Address</label>
                  <input type="email" name="email" id="email" placeholder="Your Email Address" class="form-control">
                </div>
                <div class="mb-3">
                  <label for="subject" class="form-label">Subject</label>
                  <input type="text" name="subject" id="subject" placeholder="Subject" class="form-control">
                </div>
                <div class="mb-3">
                  <label for="message" class="form-label">Message</label>
                  <textarea name="message" id="message" placeholder="Enter your message here" class="form-control" rows="4"></textarea>
                </div>
                <div class="text-center">
                  <input type="submit"  name="send" class="btn  text-white" style="background-color:darkolivegreen; color: white;"value="Send Message">
                </div>
              </form>
            </div>
          </div>
        </div>
        <div class="col-lg-6 m-auto">
          <div class="card">
            <div class="card-body">
              <div class="contact-details">
                <p class="contact-info-item">
                  <i class="ri-phone-line"></i>
                  Phone Number: <span>081-2304567</span>
                </p>
                <p class="contact-info-item">
                  <i class="ri-mail-line"></i>
                  E-Mail Address: <span>planthub.plants@gmail.com</span>
                </p>
                <p class="contact-info-item">
                  <i class="ri-clock-line"></i>
                  We work 24/7 to answer your questions
                </p>
              </div>
            </div>
          </div>
        </div>

      </div>
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
          <li><a href="index.html">Home</a></li>
          <li><a href="">about us</a></li>
          <li><a href="Products.html">products</a></li>
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
  <!--_________________scroll up __________________   -->



  <!-- ________________scroll revel__________________   -->
  <script src="">
  </script>

  <!-- ________________MAIN JS________________________   -->
  <script src="js/main.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

</body>

</html>