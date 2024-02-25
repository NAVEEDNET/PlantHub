<?php
//connect file
include('includes/connect.php');


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <?php

  include('layouts/header.php');
  ?>
</head>
<?php


include('layouts/navigation.php');
?>

<body>

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

  <!--********************************     home      *****************************************-->

  <section id="home">
    <div class="container">

      <h4 id="heading5" >NEW ARAIVALS</h4>
      <h1>Plants That You Will Love </h1>
      <p><strong>we offer the best plants for the<span> most affordable prices</strong></span></p>
      <button>Shop Now</button>
    </div>
  </section>
  <br><br>


  <br>

  <!--new section                   catogories  vdo20-->
<!--  <section id="new" class="w-100">
    <h1 class="container text-center mt-3 py-1">Categories</h1>
    <div class="row p-0 m-0">-->


      <!--one -->
    <!--  <div class="one col-lg-4 col-md-6 col-sm-6 p-0">
        <img class="img-fluid" src="images/categoryfruit.jpg">
        <div class="details">
          <h5>Fruit Plants</h5>
          <button class="text-uppercase" id="new__button">Shop Now</button>
        </div>


      </div>-->
      <!--two-->
 <!--     <div class="one col-lg-4 col-md-6 col-sm-6 p-0">
        <img class="img-fluid" src="images/categoryIndoor.jpg">
        <div class="details">
          <h5>Indoor Plants</h5>
          <button class="text-uppercase" id="new__button">Shop Now</button>
        </div>
      </div>-->


      <!--three-->
    <!--  <div class="one col-lg-4 col-md-6 col-sm-6 p-0">
        <img class="img-fluid" src="images/categoryRose.jpg">
        <div class="details">
          <h5>Flower Plants</h5>
          <button class="text-uppercase" id="new__button">Shop Now</button>
        </div>
      </div>-->

      <!--four-->
<!--      <div class="one col-lg-4 col-md-6 col-sm-6 p-0">
        <img class="img-fluid" src="images/categoryHerbs.jpg">
        <div class="details">
          <h5>Herbs</h5>
          <button class="text-uppercase" id="new__button">Shop Now</button>
        </div>
      </div>-->


      <!--five-->
<!--      <div class="one col-lg-4 col-md-6 col-sm-6 p-0">
        <img class="img-fluid" src="images/categoryCactus.jpg">
        <div class="details">
          <h5>Cactus and Succulents</h5>
          <button class="text-uppercase" id="new__button">Shop Now</button>
        </div>
      </div>

    </div>
  </section>-->



  <!--<hr><hr>-->
  <!--new section               featured  vdo22 -->

  <section id="featured" class="my-5 pb-3">
    <div class="container text-center mt-3 py-1">
      <h1>Most Liked Plants</h1>
      <hr>
      <p>Here you can check out customer preferred plants</p>
    </div>

    <div class="row mx-auto container-fluid">

      <?php
      $stmt = $con->prepare("SELECT * FROM plants order by rand() LIMIT 4");
      $stmt->execute();
      $most_liked_products = $stmt->get_result(); //array
      ?>
        

        <?php
      while ($row = $most_liked_products->fetch_assoc()) { ?>

        <?php
           $available=true;

           $sql = "SELECT status FROM plants WHERE plant_id=?";
           $stmt = $con->prepare($sql);
           $stmt->bind_param("i", $row['plant_id']);
           $stmt->execute();
           $result = $stmt->get_result();
    
    // Fetch the status_row if there's a result
           if ($result->num_rows > 0) 
           {
             $status_row = $result->fetch_assoc();
             $status = $status_row['status'];

             if($status==="false"){

              $available=false;
             }
           
            } 

          

        ?> 

        <div class="product text-center col-lg-3 col-md-4 col-sm-12">
          <a href=<?php echo "product_details.php?plant_id=" . $row['plant_id']; ?>>
            <img class="img-fluid mb-3" src="admin_/plant_images/<?php echo $row['plant_image1']; ?>"></a>

          <div class="star">470101
            <i class="ri-star-fill"></i>
            <i class="ri-star-fill"></i>
            <i class="ri-star-fill"></i>
            <i class="ri-star-fill"></i>
            <i class="ri-star-fill"></i>
          </div>
         
          <h5 class="p-name"><?php echo $row['plant_name']; ?></h5>
          <h5 class="p-price">Rs <?php echo $row['plant_price'], '.00'; ?></h5>
          <a href=<?php echo "product_details.php?plant_id=" . $row['plant_id']; ?>>
            
            <button  class="buy-btn" <?php if (!$available) echo 'window.location.href=index.php style="background-color:#993131;"  onmouseenter="showAlert();"'; ?> >Buy Now</button>

                 <script>
                     function showAlert() {
                      
                    alert('sorry this product is not availbe for now');
                     

                    }
            </script>
          </a>
        </div>
      <?php } ?>


    </div>
  </section>


  <!--banner  vdo 24-->
  <section id="banner" class="my-5 py-5">
    <div class="container">
      <h4>CHECK NOW!!</h4>
      <h1>Pet Friendly Plants</h1>
      <button class="text-uppercase">Shop Now</button>


    </div>
  </section>

  <!-- new section indoor plants               vdo25-->
  <section id="indoor" class="my-5">
    <?php
    $stmt_cat1 = $con->prepare("SELECT * FROM categories WHERE category_id =1 ");
    $stmt_cat1->execute();
    $cat1_name = $stmt_cat1->get_result();
    ?>
    <div class="container text-center mt-3 py-1">
      <?php
      while ($row = $cat1_name->fetch_assoc()) { ?>
        <h1 style=" text-transform: capitalize;"><?php echo $row['category_title']; ?></h1>
      <?php } ?>
      <hr>
      <p>Here you can check out indoor plants<br>"indoor plants can improve focus, decrease depressive moods and lessen symptoms of anxiety,” says Garvey. “When your mind and body are relaxed, it can improve your blood pressure, heart rate and cortisol levels.” Support cognitive health.</p>
    </div>

    <div class="row mx-auto container-fluid">

      <?php


      $stmt = $con->prepare("SELECT * FROM plants WHERE category_id ='1' LIMIT 4");
      $stmt->execute();
      $indoor_plants = $stmt->get_result(); //array
      ?>
      <?php
      while ($row = $indoor_plants->fetch_assoc()) { ?>

           <?php
           $available=true;

           $sql = "SELECT status FROM plants WHERE plant_id=?";
           $stmt = $con->prepare($sql);
           $stmt->bind_param("i", $row['plant_id']);
           $stmt->execute();
           $result = $stmt->get_result();
    
    // Fetch the status_row if there's a result
           if ($result->num_rows > 0) 
           {
             $status_row = $result->fetch_assoc();
             $status = $status_row['status'];

             if($status==="false"){

              $available=false;
             }
           
            } 

          

        ?> 


        <div class="product text-center col-lg-3 col-md-4 col-sm-6">
          <a href=<?php echo "product_details.php?plant_id=" . $row['plant_id']; ?>>
            <img class="img-fluid mb-3" src="admin_/plant_images/<?php echo $row['plant_image1']; ?>"></a>
          <div class="star">
            <i class="ri-star-fill"></i>
            <i class="ri-star-fill"></i>
            <i class="ri-star-fill"></i>
            <i class="ri-star-fill"></i>
            <i class="ri-star-fill"></i>
          </div>

          <h5 class="p-name"><?php echo $row['plant_name']; ?></h5>
          <h5 class="p-price">Rs <?php echo $row['plant_price'], '.00'; ?></h5>
          <a href=<?php echo "product_details.php?plant_id=" . $row['plant_id']; ?>>
                       <button  class="buy-btn" <?php if (!$available) echo 'window.location.href=index.php style="background-color:#993131;"  onmouseenter="showAlert();"'; ?> >Buy Now</button>

                 <script>
                     function showAlert() {
                      
                    alert('sorry this product is not availbe for now');
                     

                    }
            </script>
          </a>

        </div>
      <?php } ?>


    </div>
  </section>


  <!--flowering plants        vdo26 -->
  <section id="flower" class="my-5">
    <div class="container text-center mt-3 py-1">
      <?php
      $stmt_cat2 = $con->prepare("SELECT * FROM categories WHERE category_id =2 ");
      $stmt_cat2->execute();
      $cat2_name = $stmt_cat2->get_result();
      ?>
      <?php


      while ($row = $cat2_name->fetch_assoc()) { ?>
        <h1 style=" text-transform: capitalize;"><?php echo $row['category_title']; ?></h1>
      <?php } ?>
      <hr>
      <p>Here you can check out flower plants</p>
    </div>
    <div class="row mx-auto container-fluid">

      <?php
      $stmt2 = $con->prepare("SELECT * FROM plants WHERE category_id ='2' LIMIT 4");
      $stmt2->execute();
      $cat2_plants = $stmt2->get_result(); //array
      ?>
      <?php
      while ($row = $cat2_plants->fetch_assoc()) { ?>
           

            <?php
           $available=true;

           $sql = "SELECT status FROM plants WHERE plant_id=?";
           $stmt = $con->prepare($sql);
           $stmt->bind_param("i", $row['plant_id']);
           $stmt->execute();
           $result = $stmt->get_result();
    
    // Fetch the status_row if there's a result
           if ($result->num_rows > 0) 
           {
             $status_row = $result->fetch_assoc();
             $status = $status_row['status'];

             if($status==="false"){

              $available=false;
             }
           
            } 

          

        ?> 

        <div class="product text-center col-lg-3 col-md-4 col-sm-12">
          <a href=<?php echo "product_details.php?plant_id=" . $row['plant_id']; ?>>
            <img class="img-fluid mb-3" src="admin_/plant_images/<?php echo $row['plant_image1']; ?>"></a>
          <div class="star">
            <i class="ri-star-fill"></i>
            <i class="ri-star-fill"></i>
            <i class="ri-star-fill"></i>
            <i class="ri-star-fill"></i>
            <i class="ri-star-fill"></i>
          </div>

          <h5 class="p-name"> <?php echo $row['plant_name']; ?></h5>
          <h5 class="p-price">Rs <?php echo $row['plant_price'], '.00'; ?></h5>
          <a href=<?php echo "product_details.php?plant_id=" . $row['plant_id']; ?>>
          

                      <button  class="buy-btn" <?php if (!$available) echo 'window.location.href=index.php style="background-color:#993131;"  onmouseenter="showAlert();"'; ?> >Buy Now</button>

                 <script>
                     function showAlert() {
                      
                     alert('sorry this product is not availbe for now');
                     

                    }
            </script>

          
</a>

        </div>

      <?php } ?>






    </div>
  </section>


  <?php


  include('layouts/footer.php');
  ?>




