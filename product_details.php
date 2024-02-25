<?php
//connect file
include('includes/connect.php');

include('functions/common_function.php');
session_start();


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <?php

  include('layouts/header.php');
  ?>
  <style>
    .topic {
      background-color: darkolivegreen;
      color: #fff;
      margin-right: 200px;
      text-align: center;
      padding: 10px;
    }

    #discription {
      width: 80% auto;

      margin: auto;
      border-collapse: collapse;
      text-align: center;


    }

    table th {

      text-align: center;

      padding: 5px 10px;
    }

    #buy_button {
      width: 180px;
      background-color: #233012;
      transition: 0.4s all;
    }

    #buy-button:hover {
      background-color: #635464;
    }


    /* .sbt_review{
  background-color: darkolivegreen;
  color: white;

}
.sbt_review:hover{
  background-color:black;
  color: #fff;
}*/

    .review-form {
      margin-bottom: 20px;
    }

    .review-form label,
    .review-form textarea {
      display: block;
      margin-bottom: 10px;
    }

    .review-form textarea {
      width: 100%;
      height: 100px;
    }

    .review-form button {
      background-color: #4caf50;
      color: #fff;
      border: none;
      padding: 10px 20px;
      border-radius: 5px;
      cursor: pointer;
    }

    .review {
      margin-bottom: 10px;
      padding: 10px;
      background-color: #f7f7f7;
      border-radius: 5px;
    }

    .review h3 {
      margin: 0;
    }

    .review p {
      margin: 5px 0;
    }

    .reviews-container {
      height: 200px;
      /* Set the desired height */
      overflow: auto;
    }

    .h2 {
      color: darkolivegreen;
    }
  </style>

  <title>Plant Hub</title>
</head>

<body>



  <!--nav bar-->
  <?php
  include('layouts/navigation.php');
  ?>



  <!--********************************     search bar     *****************************************-->
  <section class="searchbar">
    <div class="search-container m-5 p-5 pb-2 fixed=top ">
      <form action="search_product.php" method="get" class="search text-nowrap mt-2">
        <input type="text" placeholder="Search.." name="search_data">
        <!--   <button type="submit" name="search_data_product" value="search"><i class="ri-search-line"></i></button>
            -->
        <input type="submit" value="Search" class="btn " id="searchMe" name="search_data_product">

      </form>
    </div>


  </section>

  <!--single product-->
  <section class="container single-product my-5 pt-3">



    <?php
    //in includes file
    view_details();
    ?>


    <!-- Add review section -->

    <?php    // Check if the form is submitted

    if (isset($_POST['add_review'])) {
      if (!isset($_SESSION['customer_id'])) {
        echo "<script>alert('Please log in to add a review.') </script>";
        echo "<script>window.open('./login.php','_self')</script>";
      } else {
        $cus_id = $_SESSION['customer_id'];
        // Retrieve form data
        $name = $_POST['name'];
        $rating = $_POST['rating'];
        $comment = $_POST['comment'];
        $plant_id = $_GET['plant_id'];

        // Insert the review into the database
        $query = "INSERT INTO reviews (plant_id, customer_id, rating, comment, date)
              VALUES ($plant_id, $cus_id, $rating, '$comment', NOW())";
        $result = mysqli_query($con, $query);

        // Check if the review is inserted successfully
        if ($result) {
          echo "Review submitted successfully.";
        } else {
          echo "Error: " . mysqli_error($con);
        }
      }
    }

    ?>

    <div class="review-section">
      <h4 class="mt-5 mb-4">Customer Reviews</h4>
      <!-- Display existing reviews -->

      <!-- Add Review Form -->
      <div class="review-form">
        <h2 class="h2">Add Your Review</h2>
        <form action="" method="post">
          <label for="name">Name:</label>
          <input type="text" id="name" name="name" value="<?php if (isset($_SESSION['customer_name']) && $_SESSION['customer_name'] != "") {
                                                            echo $_SESSION['customer_name'];
                                                          } ?>" required>
          <label for="rating">Rating:</label>
          <select id="rating" name="rating" required>
            <option value="5">5 stars</option>
            <option value="4">4 stars</option>
            <option value="3">3 stars</option>
            <option value="2">2 stars</option>
            <option value="1">1 star</option>
          </select>
          <label for="comment">Comment:</label>
          <textarea id="comment" name="comment" required></textarea>
          <button type="submit" name="add_review">Submit Review</button>
        </form>
      </div>

      <!-- Display Others' Reviews -->
      <div class="reviews-container">
        <h2 class="h2">Customer Reviews</h2>
        <?php



        if (isset($_GET['plant_id'])) {


          $plant_id = $_GET['plant_id'];
          $query = "SELECT
      reviews.*, customer.customer_name FROM reviews INNER JOIN customer ON reviews.customer_id = customer.customer_id
      WHERE reviews.plant_id = $plant_id";


          $result = mysqli_query($con, $query);


          // Display existing reviews
          //  if(!$row = mysqli_fetch_assoc($result)>0){
          //  }
          // else{
          while ($row = mysqli_fetch_assoc($result)) {
            $customer_name = $row['customer_name'];
            $rating = $row['rating'];
            $comment = $row['comment'];


        ?>

            <div class="review">
              <h5>Customer Name: <?php echo $customer_name; ?></h5>
              <p>Rating: <?php echo $rating; ?></p>
              <p>Commment : <?php echo $comment; ?></p>
            </div>
        <?php }
        } ?>
        <!-- Add more reviews here -->
      </div>
    </div>
    </div>


  </section>
  <hr>














  <!--new section               related product  vdo38 -->
  <section id="related-products" class="my-5 pb-3">
    <div class="container mt-3 py-1">
      <h1>Related Products</h1>
      <br>

    </div>


    <?php
    $plant_id = $_GET['plant_id'];
    //finding category id
    $find_cat = "SELECT * FROM plants WHERE plant_id=$plant_id";
    $result_find = mysqli_query($con, $find_cat);
    $row = mysqli_fetch_assoc($result_find);
    $category_id = $row['category_id'];

    $stmt = $con->prepare("SELECT * FROM plants WHERE category_id =$category_id LIMIT 4");
    $stmt->execute();
    $related_plants = $stmt->get_result(); //array

    ?>

      <div class="row mx-auto container-fluid ">
<?php while ($row = $related_plants->fetch_assoc()) { ?>

        <div class="product text-center col-lg-3 col-md-4 col-sm-12">
          <img class="img-fluid mb-3" src="admin_/plant_images/<?php echo $row['plant_image1']; ?>">
          <div class="star">
            <i class="ri-star-fill"></i>
            <i class="ri-star-fill"></i>
            <i class="ri-star-fill"></i>
            <i class="ri-star-fill"></i>
            <i class="ri-star-fill"></i>
          </div>

          <h5 class="p-name"><?php echo $row['plant_name']; ?></h5>
          <h5 class="p-price">Rs <?php echo $row['plant_price'], '.00'; ?></h5>
          <button class="buy-btn">Buy Now</button>
        </div>
      <?php } ?>


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

  <script>
    var mainImg = document.getElementById("mainImg");
    var smallImg = document.getElementsByClassName("small-img");
    var x;

    for (let i = 0; i <= 4; i++) {

      smallImg[i].onclick = function() {
        x = mainImg.src;
        mainImg.src = smallImg[i].src;
        smallImg[i].src = x;


      }

    }
  </script>

</body>

</html>