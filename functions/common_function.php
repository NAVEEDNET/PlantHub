<?php
//include the connect file

include("./includes/connect.php");


//getting products
function getProducts()
{
  global $con;

  //condition to check isset or not
  if (!isset($_GET['category'])) {



    $select_query = "select * from plants order by  limit 0,9";
    $result_query = mysqli_query($con, $select_query);

    //  $row = mysqli_fetch_assoc($result_query);
    //  echo $row['plant_name'];
    while ($row = mysqli_fetch_assoc($result_query)) {
      $plant_id = $row['plant_id'];
      $plant_name = $row['plant_name'];
      $plant_description = $row['plant_description'];
      $plant_keywords = $row['plant_keywords'];
      $plant_image1 = $row['plant_image1'];
      $plant_price = $row['plant_price'];
      $category_id = $row['category_id'];
      echo " <div class='product text-center col-lg-4 col-md-4 col-sm-6'>
      <a href='product_details.php?plant_id=$plant_id'>
   <img class='img-fluid mb-3' src='./admin_/plant_images/$plant_image1' alt='$plant_name'></a>
   <div class='star'>
     <i class='ri-star-fill'></i>
     <i class='ri-star-fill'></i>
     <i class='ri-star-fill'></i>
     <i class='ri-star-fill'></i>
     <i class='ri-star-fill'></i>
   </div>

   <h5 class='p-name'>$plant_name</h5>
   <h5 class='p-price'>$plant_price</h5>
   
   <button class='buy-btn'>Buy Now</button>
 </div>

   ";
    }
  }
}
//getting all products
/*
function get_all_products(){
  global $con;

  //condition to check isset or not
  if (!isset($_GET['category'])) {



    $select_query = "select * from plants order by rand()";
    $result_query = mysqli_query($con, $select_query);

    //  $row = mysqli_fetch_assoc($result_query);
    //  echo $row['plant_name'];
    while ($row = mysqli_fetch_assoc($result_query)) {
      $plant_id = $row['plant_id'];
      $plant_name = $row['plant_name'];
      $plant_description = $row['plant_description'];
      $plant_keywords = $row['plant_keywords'];
      $plant_image1 = $row['plant_image1'];
      $plant_price = $row['plant_price'];
      $category_id = $row['category_id'];
      echo "<div onclick='window.location.href='single_product.php';' class='product text-center col-lg-4 col-md-4 col-sm-6'>
   <img class='img-fluid mb-3' src='./admin_/plant_images/$plant_image1' alt='$plant_name'>
   <div class='star'>
     <i class='ri-star-fill'></i>
     <i class='ri-star-fill'></i>
     <i class='ri-star-fill'></i>
     <i class='ri-star-fill'></i>
     <i class='ri-star-fill'></i>
   </div>

   <h5 class='p-name'>$plant_name</h5>
   <h5 class='p-price'>$plant_price</h5>
   <button class='buy-btn'>Buy Now</button>
 </div>

   ";
    }
  }
}*/

//getting unique categories


function get_unique_categories()
{
  global $con;

  //condition to check isset or not
  if (isset($_GET['category'])) {
    $category_id = $_GET['category'];



    $select_query = "select * from plants where category_id=$category_id";
    $result_query = mysqli_query($con, $select_query);
    $num_of_rows = mysqli_num_rows($result_query);
    if ($num_of_rows == 0) {
      echo "<h2 class='m-5 text-danger'>This category is not Available for now</h2>";
    }

    //  $row = mysqli_fetch_assoc($result_query);
    //  echo $row['plant_name'];
    while ($row = mysqli_fetch_assoc($result_query)) {
      $plant_id = $row['plant_id'];
      $plant_name = $row['plant_name'];
      $plant_description = $row['plant_description'];
      $plant_keywords = $row['plant_keywords'];
      $plant_image1 = $row['plant_image1'];
      $plant_price = $row['plant_price'];
      $category_id = $row['category_id'];
      echo "<div class='product text-center col-lg-4 col-md-4 col-sm-6'>
      <a href='product_details.php?plant_id=$plant_id'>
   <img class='img-fluid mb-3' src='./admin_/plant_images/$plant_image1' alt='$plant_name'></a>
   <div class='star'>
     <i class='ri-star-fill'></i>
     <i class='ri-star-fill'></i>
     <i class='ri-star-fill'></i>
     <i class='ri-star-fill'></i>
     <i class='ri-star-fill'></i>
   </div>

   <h5 class='p-name'>$plant_name</h5>
   <h5 class='p-price'>$plant_price</h5>
   <button class='buy-btn'>Buy Now</button>
 </div>

   ";
    }
  }
}


//getting categories//dont dlt
function getCategories()
{
  global $con;
  $select_categories = "select * from categories";
  $result_categories = mysqli_query($con, $select_categories);
  //  $row_data=mysqli_fetch_assoc($result_categories);
  //  echo $row_data['category_title'];





  echo "
  <div class='col-sm-6'>
                <div class='form-check'>
                  <input type='radio' name='category_id' value='all_cat' id='category_one' class='form-check-input ' checked/>
                  <label for='category_one' class='form-check-label'>All</label>
                </div>
              </div>
  ";

  while ($row_data = mysqli_fetch_assoc($result_categories)) {
    $category_title = $row_data['category_title'];
    $category_id = $row_data['category_id'];

    echo "
    <div class='col-sm-6'>
      <div class='form-check'>
        <input type='radio' name='category_id' value='$category_id' id='category_$category_id' class='form-check-input' ";

    if (isset($_GET['category_id']) && $_GET['category_id'] == $category_id) {
      echo "checked";
    }

    echo ">
        <label for='category_$category_id' class='form-check-label'>$category_title</label>
      </div>
    </div>
    ";
  }
}





//get searching products function
function search_data()
{
  global $con;

  //condition to check isset or not

  if (isset($_GET['search_data_product'])) {
    $search_data_value = $_GET['search_data'];


    $select_query = "select * from plants where plant_keywords like '%$search_data_value%'";
    $result_query = mysqli_query($con, $select_query);
    //count the number of results
    $num_of_rows = mysqli_num_rows($result_query);
    if ($num_of_rows == 0) {
      echo "<h2 class='mt-5 text-danger'>Nothing Found</h2>";
      echo "<p>Sorry, but nothing matched your search terms. Please try again with some different keywords.</p>";
    }

    //  $row = mysqli_fetch_assoc($result_query);
    //  echo $row['plant_name'];
    while ($row = mysqli_fetch_assoc($result_query)) {
      $plant_id = $row['plant_id'];
      $plant_name = $row['plant_name'];
      $plant_description = $row['plant_description'];
      $plant_keywords = $row['plant_keywords'];
      $plant_image1 = $row['plant_image1'];
      $plant_price = $row['plant_price'];
      $category_id = $row['category_id'];
      echo "
      <div class='product text-center col-lg-4 col-md-4 col-sm-6'>
        <a href='product_details.php?plant_id=$plant_id'>
          <img class='img-fluid mb-3' src='./admin_/plant_images/$plant_image1' alt='$plant_name'>
        </a>
          <div class='star'>
            <i class='ri-star-fill'></i>
            <i class='ri-star-fill'></i>
            <i class='ri-star-fill'></i>
            <i class='ri-star-fill'></i>
            <i class='ri-star-fill'></i>
          </div>

          <h5 class='p-name'>$plant_name</h5>
          <h5 class='p-price'>$plant_price</h5>
        <a href='product_details.php?plant_id=$plant_id'>
          <button class='buy-btn'>Buy Now</button>
        </a>
  </div>

    ";
    }
  }
}

//view details function for product_detailes page
function view_details()
{

  global $con;

  //condition to check isset or not
  if (isset($_GET['plant_id'])) {


    if (!isset($_GET['category'])) {

      $plant_id = $_GET['plant_id'];

      $select_query = "select * from plants where plant_id =$plant_id";
      $result_query = mysqli_query($con, $select_query);

      //  $row = mysqli_fetch_assoc($result_query);
      //  echo $row['plant_name'];
      while ($row = mysqli_fetch_assoc($result_query)) {
        $plant_id = $row['plant_id'];
        $plant_name = $row['plant_name'];
        $plant_description = $row['plant_description'];

        $plant_soil = $row['plant_soil'];
        $plant_sunlight = $row['plant_sunlight'];
        $plant_watering = $row['plant_watering'];
        $plant_environment = $row['environment'];

        //   $plant_keywords = $row['plant_keywords'];
        $plant_image1 = $row['plant_image1'];
        $plant_price = $row['plant_price'];
        $category_id = $row['category_id'];
        echo "
       
        
      <div class='row mt-0'>
      <div class='col-lg-5 col-md-6 col-sm-12'>
        <img class='img-fluid w-100 pb-1' src='./admin_/plant_images/$plant_image1' id='mainImg' />
        <!--//     <div class='small-img-group'>
               <div class='small-img-col'>
                    <img src='images/flowerPlants/Gerbera.jpg' width='100%' height='90%' class='small-img'/>
                </div>
                <div class='small-img-col'>
                    <img src='images/indoor/catcus.jpg' width='100%' height='90%' class='small-img'/>
                </div>
                <div class='small-img-col'>
                    <img src='images/flowerPlants/Peace lily.jpg' width='100%' height='90%' class='small-img'/>
                </div>
                <div class='small-img-col'>
                    <img src='images/liked/rose.jpg' width='100%' height='90%' class='small-img'/>
                </div>
            </div>-->
      </div>



      <div class='col-lg-6 col-md-12 col-12'>
        <h2 class='mb-5'>$plant_name</h2>
        <h3>Price :</h3>
        <h3 class='mb-3'>Rs $plant_price.00</h3>

        <form method='post' action='cart.php'>
        <input type='hidden' name='plant_id' value='$plant_id'/>
        <input type='hidden' name='plant_image' value='$plant_image1'/>
        <input type='hidden' name='plant_name' value='$plant_name'/>
        <input type='hidden' name='plant_price' value='$plant_price'/>


        <h6>Quantity</h6>
        <input type='number' class='mb-3' value='1' name='plant_quantity' min=1 /><br>

        <button class='cart-button mb-2'  type='submit' name='add_to_cart'>Add To Cart</button><br>
     <!--   <button class='cart-button' id='buy_button' type='submit' name='buy_now'>Buy Now</button>-->
        </form>
        <h4 class='mt-5 m4-5'>Plant details</h4>
        <span mb-3>
        About $plant_name <br>
          <span> $plant_description</span></span>

      </div>
      
    
      <table id='discription' class='mt-3'>
        <tr>
          <th colspan='2' class='topic text-center'>Plant Details </th>

        </tr>
        <tr>
          <th>Environment</th>
          <td class='text-center'> $plant_environment</td>
        </tr>
        <tr>
          <th>soil condition</th>
          <td class='text-center'>$plant_soil</td>
        </tr>
        <tr>
          <th>sun Light</th>
          <td class='text-center'>$plant_sunlight</td>
        </tr>
        <tr>
          <th>About Watering</th>
          <td class='text-center'>$plant_watering</td>

        </tr>


      </table>


    </div> 
  
      ";
      }
    }
  }
}
