<?php
//connect file
include('includes/connect.php');
include('functions/common_function.php');


if (isset($_POST['search'])) {


  //1.determine page no
  if (isset($_GET['page_no']) && $_GET['page_no'] != "") {
    //if user ha already alreadey entered then the page no is the one that he selected. 
    $page_no = $_GET['page_no'];
  } else {
    //if user just entered the page then defalt page is 1.
    $page_no = 1;
  }


  $category_id = $_POST['category_id'];
  $price = $_POST['price'];



  //2. return numbr of plants
  $stmt1 = $con->prepare("SELECT COUNT(*) AS total_records FROM plants WHERE category_id=? AND plant_price<=? ");
  $stmt1->bind_param('ii', $category_id, $price);

  $stmt1->execute();
  $stmt1->bind_result($total_records);
  $stmt1->store_result();
  $stmt1->fetch();



  //3.products per page
  $total_records_per_page = 16;

  $offset = ($page_no - 1) * $total_records_per_page;
  $previous_page = $page_no - 1;
  $next_page = $page_no + 1;

  $adjacents = "2";
  $total_no_of_pages = ceil($total_records / $total_records_per_page);






  //4.get all products
  /*  $stmt4 = $con->prepare("SELECT * FROM plants WHERE category_id=? AND plant_price<=? LIMIT $offset,$total_records_per_page");
  $stmt4->bind_param('ii', $category_id, $price);
  $stmt4->execute();
  $plants = $stmt4->get_result(); //[]*/






  if ($category_id == 'all_cat') { //showing all categories and particuler price

    $stmt2 = $con->prepare("SELECT * FROM plants where plant_price<=? LIMIT $offset,$total_records_per_page");
    $stmt2->bind_param('i', $price);

    $stmt2->execute();
    $plants = $stmt2->get_result(); //array



  } else { //shwing particular cat and particuler price
    /* $stmt = $con->prepare("SELECT * FROM plants where category_id=? AND plant_price<=?");
    $stmt->bind_param('ii', $category_id, $price);

    $stmt->execute();
    $plants = $stmt->get_result(); //array*/
    $stmt2 = $con->prepare("SELECT * FROM plants WHERE category_id=? AND plant_price<=? LIMIT $offset,$total_records_per_page");
    $stmt2->bind_param('ii', $category_id, $price);
    $stmt2->execute();
    $plants = $stmt2->get_result(); //[]


  }
} else if (isset($_GET['search_data_product'])) {
  ///////////////////////









} else {

  //working on pagination

  //1.determine page no
  if (isset($_GET['page_no']) && $_GET['page_no'] != "") {
    //if user ha already alreadey entered then the page no is the one that he selected. 
    $page_no = $_GET['page_no'];
  } else {
    //if user just entered the page then defalt page is 1.
    $page_no = 1;
  }

  //2. return numbr of plants
  $stmt1 = $con->prepare("SELECT COUNT(*) AS total_records FROM plants");

  $stmt1->execute();
  $stmt1->bind_result($total_records);
  $stmt1->store_result();
  $stmt1->fetch();


  //3.products per page
  $total_records_per_page = 16;

  $offset = ($page_no - 1) * $total_records_per_page;
  $previous_page = $page_no - 1;
  $next_page = $page_no + 1;

  $adjacents = "2";
  $total_no_of_pages = ceil($total_records / $total_records_per_page);

  //4.get all products
  $stmt2 = $con->prepare("SELECT * FROM plants LIMIT $offset,$total_records_per_page");
  $stmt2->execute();
  $plants = $stmt2->get_result();
}

















?>

<!--vdo33-->
<!DOCTYPE html>
<html lang="en">

<head>
  <?php

  include('layouts/header.php');
  ?>
  <style>
    .product a img {
      width: 100%;
      height: 60%;
      box-sizing: border-box;
      object-fit: cover;
    }

    .pagination a {
      color: darkolivegreen;
    }

    .pagination a:hover {
      color: #fff;
      background-color: darkolivegreen;
    }



    /*category part*/
    #meaw {
      background-color: darkolivegreen;

    }

    .navbar-nav .categories {
      font-size: 20px;
      color: #fff;

    }

    #category_one {
      accent-color: red;
    }
  </style>


</head>

<body>



  <!--nav bar-->
  <?php
  include('layouts/navigation.php');
  ?>






  </section> <!--********************************     search bar     *****************************************-->
  <section class="searchbar">
    <div class="search-container m-5 p-5 pb-0 fixed=top ">
      <form action="search_product.php" method="get" class="search text-nowrap mt-2">
        <input type="text" placeholder="Search.." name="search_data">
        <!--   <button type="submit" name="search_data_product" value="search"><i class="ri-search-line"></i></button>
        -->
        <input type="submit" value="Search" class="btn " id="searchMe" name="search_data_product">

      </form>
    </div>


  </section>







  <!--//filter plant -->
  <section id="search" class="my-3 py-3 ms-0" style="background-color:#B2BEB5;">


    <form action="Products.php" class="container" method="post">
      <div class="row">

        <div class="col-lg-4 col-md-4 col-sm-12">
          <div class="container text-center mt-3 py-1">
            <h1>Our Plants</h1>
            <hr class="mx-auto w-25">

          </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12">
          <div class="container ">
            <p style="font-size: 20px;"><strong>Filter Plants</strong></p>

          </div>
          <div class="form-group">
            <label for="category" class="mb-1"><strong>Category</strong></label>
            <div class="row">
              <?php
              getCategories();
              ?>

            </div>
          </div>
        </div>

        <div class="col-lg-4 col-md-4 col-sm-12 pt-0">
          <div class="form-group">
            <label for="price">Price</label>
            <input type="range" class="form-range" value="<?php if (isset($price)) {
                                                            echo $price;
                                                          } else {
                                                            echo "2000";
                                                          } ?>" min="1" max="2000" name="price">
            <div class="d-flex justify-content-between">
              <span>1</span>
              <span>2000</span>
            </div>
            <p style="text-align: right;"> <?php echo isset($price) ? "Selected Amount :" . $price : ''; ?></p>
          </div>
          <!--filter search-->
          <div class="form-group">
            <label class="invisible">Search Button Placeholder</label>
            <input type="submit" name="search" value="Search" class="btn filter_btn">
          </div>
        </div>




      </div>
    </form>
  </section>


  <!--new section               products  vdo22 -->

  <section id="products" class="my-3 py-3">

    <div class="container text-center mt-3 py-1">
      <h1>Our Plants</h1>
      <hr class="mx-auto w-25">

    </div>

    <div class="row">


        </ul>

      </div>

      <div class="row col-lg-10 col-md-10">


        <div class="row mx-auto container">


          <!--fatching plants-->
          <?php


          search_data();
        //  get_unique_categories();



          ?>



          <!--pagination bar-->
          <nav aria-label="page navigation">
            <ul class="pagination mt-5">
              <li class="page-item"><a class="page-link" href="#">Previous</a></li>
              <li class="page-item"><a class="page-link" href="#">1</a></li>
              <li class="page-item"><a class="page-link" href="#">2</a></li>
              <li class="page-item"><a class="page-link" href="#">3</a></li>
              <li class="page-item"><a class="page-link" href="#">Next</a></li>
            </ul>
          </nav>

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

        <div class="col-lg-3 col-md-6 col-sm-12 mb-1 text-nowrap mb-1">
          <br><br><br>
          <p>PLANT HUB CO. (PVT) LTD. All Rights Reserved.</p>
        </div>

        <!-- <div class="col-lg-3 col-md-6 col-sm-12 mb-4 "></div>-->


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