<?php
include('../includes/connect.php');
if (isset($_POST['insert_plant'])) {
  $plant_title = $_POST['plant_title'];
  // $description = $_POST['description'];
  $description = $_POST['description'];
  $plant_keywords = $_POST['plant_keywords'];
  $plant_category = $_POST['plant_category'];

  $plant_soil = $_POST['plant_soil'];
  $plant_sunlight = $_POST['plant_sunlight'];
  $plant_environment = $_POST['plant_environment'];
  $plant_water = $_POST['plant_water'];

  $plant_price = $_POST['plant_price'];
  $plant_count = $_POST['plant_count'];
  if ($plant_count>=1){
    $plant_status = 'true';
  }else{
    $plant_status = 'false';
  }

  //accessing images
  $plant_image1 = $_FILES['plant_image1']['name'];


  //accessing image temp names
  $temp_image1 = $_FILES['plant_image1']['tmp_name'];

  //checking empty values
  if (
    $plant_title == '' or $description == '' or $plant_keywords == '' or
    $plant_category == '' or $plant_price == '' or $plant_count == '' or
    $plant_image1 == '' or  $plant_soil == '' or $plant_sunlight == '' or
    $plant_environment == '' or $plant_water == ''
  ) {
    echo "<script>alert('please fill all the available fields')</script>";
   // exit();
  } else if($plant_count<=0){
    echo "<script>alert('Enter a valid amount of plant quantity')</script>";
  }else if($plant_price<=0){
    echo "<script>alert('enter valid amount of the plant price')</script>";
  }
  else {
    //getting uploaded images to one folder
    move_uploaded_file($temp_image1, "./plant_images/$plant_image1");


    //insert query
    $insert_plants = "INSERT INTO plants(plant_name,plant_description,plant_keywords,category_id,plant_soil,plant_sunlight,environment,plant_watering,plant_image1,plant_price,plant_quantity,date,status) 
    VALUES('$plant_title','$description','$plant_keywords','$plant_category','$plant_soil','$plant_sunlight','$plant_environment','$plant_water','$plant_image1','$plant_price','$plant_count',NOW(),'$plant_status')";

   if(mysqli_query($con,$insert_plants)===true){
        echo '<script>alert("record inserted")</script>';

    }


   $Query="INSERT INTO sold_item_qty(plant_name,sold)VALUES ('$plant_title',0)";
      $result= mysqli_query($con, $Query);
     if ($result) {
     // echo "<script>alert('successfully inserted the Plant details') </script>";
    }

  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!--bootsrap css link-->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <link rel="stylesheet" href="admin_style.css">


  <!--  _________________ Favicon img _____________-->
  <link rel="shortcut icon" href="images/favicon.jpg" type="image/x-icon">


  <!--  _________________ Remix Icons _____________-->
  <link href="https://cdn.jsdelivr.net/npm/remixicon@3.0.0/fonts/remixicon.css" rel="stylesheet">

  <style>
    #button-submit {
      color: #d8d8d8;
      background-color: darkolivegreen;
      border: none;
      border-radius: 4%;


    }

    #button-submit:hover {
      color: darkolivegreen;
      background-color: #d8d8d8;

    }
  </style>
  <title>Insert Plants-Admin Page</title>
</head>

<body>
  <div class="container mt-3">
    <h1 class="text-center">INSERT NEW PLANTS</h1>
    <!--form-->
    <form action="insert_product.php" method="POST" enctype="multipart/form-data">
      <!--title-->
      <div class="form-outline mb-4 w-50 m-auto mt-3">
        <label for="plant_title" class="form-lable">Name of The Plant</label>
        <input type="text" name="plant_title" id="plant_title" class="form-control" autocomplete="off" required="required">
      </div>
      <!--description-->
      <div class="form-outline mb-4 w-50 m-auto mt-3">
        <label for="description" class="form-lable">Description</label>
        <!-- <input type="text" name="description" id="description" placeholder="Enter Details About The Plant" class="form-control" autocomplete="off" required="required">
  -->
        <textarea rows="10" cols="60" name="description" required></textarea>
      </div>

      <!--keywords-->
      <div class="form-outline mb-4 w-50 m-auto mt-3">
        <label for="plant_keywords" class="form-lable">keywords</label>
        <input type="text" name="plant_keywords" id="plant_keywords" placeholder="Enter Plant Keywords" class="form-control" autocomplete="off" required="required">

      </div>

      <!--categories-->
      <div class="form-outline mb-4 w-50 m-auto mt-3">
        <label for="plant_category" class="form-lable">Category</label>
        <select name="plant_category" class="form-select">


          <option value="">select a category</option>
          <?php
          $select_query = "select * from categories";
          $result_query = mysqli_query($con, $select_query);
          while ($row = mysqli_fetch_assoc($result_query)) {
            $category_title = $row['category_title'];
            $category_id = $row['category_id'];
            echo "<option value='$category_id'>$category_title</option>";
          }


          ?>


        </select>
      </div>

      <!--soil condition-->
      <div class="form-outline mb-4 w-50 m-auto mt-3">
        <label for="plant_soil" class="form-lable">Soil Condition</label>
        <input type="text" name="plant_soil" id="plant_soil" placeholder="Enter soil conditions" class="form-control" autocomplete="off" required="required">

      </div>

      <!--sunlight-->
      <div class="form-outline mb-4 w-50 m-auto mt-3">
        <label for="plant_sunlight" class="form-lable">Sunlight</label>
        <input type="text" name="plant_sunlight" id="plant_sunlight" placeholder="Enter about sunlight" class="form-control" autocomplete="off" required="required">

      </div>

      <!--Environment-->
      <div class="form-outline mb-4 w-50 m-auto mt-3">
        <label for="plant_environment" class="form-lable">Environment</label>
        <input type="text" name="plant_environment" id="plant_environment" placeholder="Enter whether indoor or outdoor plant" class="form-control" autocomplete="off" required="required">

      </div>

      <!--Watering-->
      <div class="form-outline mb-4 w-50 m-auto mt-3">
        <label for="plant_water" class="form-lable">Water Requirement</label>
        <input type="text" name="plant_water" id="plant_water" placeholder="Enter whether indoor or outdoor plant" class="form-control" autocomplete="off" required="required">

      </div>

      <!--img 1-->
      <div class="form-outline mb-4 w-50 m-auto mt-3">
        <label for="plant_image1" class="form-lable">Image 1</label>
        <input type="file" name="plant_image1" id="plant_image1" class="form-control" required="required">

      </div>


      <!--price-->
      <div class="form-outline mb-4 w-50 m-auto mt-3">
        <label for="plant_price" class="form-lable">plant Price</label>
        <input type="text" name="plant_price" id="plant_price" placeholder="Enter price of the plant" class="form-control" autocomplete="off" required="required">

      </div>

      <!--quantiy-->
      <div class="form-outline mb-4 w-50 m-auto mt-3">
        <label for="plant_count" class="form-lable">Plant Quantity</label>
        <input type="number" name="plant_count" id="plant_count" class="form-control" min="1" required="required">

      </div>


      <!--submit-->
      <div class="form-outline mb-4 w-50 m-auto mt-3">

        <input type="submit" name="insert_plant" class=" m-3 p-2" id="button-submit" value="Insert Plants">

      </div>
    </form>

  </div>


















</body>

</html>