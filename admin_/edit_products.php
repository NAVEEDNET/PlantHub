<?php
//session_start();
if (!isset($_SESSION['admin_logged_in'])) {
  header('location:login.php');
  exit;
}
include('../includes/connect.php');
?>



<?php
if (isset($_GET['edit_products'])) {
  # code...
  $edit_plant_id = $_GET['edit_products'];
 
  $get_data = "SELECT * FROM plants WHERE plant_id=$edit_plant_id";
  $result = mysqli_query($con, $get_data);
  $row = mysqli_fetch_assoc($result);

  



  $plant_name = $row['plant_name'];
  $plant_description = $row['plant_description'];
  $plant_keywords = $row['plant_keywords'];
  $category_id = $row['category_id'];
  $plant_soil = $row['plant_soil'];
  $plant_sunlight = $row['plant_sunlight'];
  $environment = $row['environment'];
  $plant_watering = $row['plant_watering'];
  $plant_image1 = $row['plant_image1'];
  $plant_price = $row['plant_price'];
  $plant_quantity = $row['plant_quantity'];
  
//fatching category name 
$select_category="SELECT * FROM categories WHERE category_id=$category_id";
$result_category=mysqli_query($con,$select_category);
$row_category=mysqli_fetch_assoc($result_category);
$select_category_title=$row_category['category_title'];
$select_category_id=$row_category['category_id'];


}



?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport"  content="width=device-width, initial-scale=1.0">
  <title>Admin_Dashboard</title>
  <!--bootsrap css link-->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <link rel="stylesheet" href="admin_style.css">


  <!--  _________________ Favicon img _____________-->
  <link rel="shortcut icon" href="images/favicon.jpg" type="image/x-icon">


  <!--  _________________ Remix Icons _____________-->
  <link href="https://cdn.jsdelivr.net/npm/remixicon@3.0.0/fonts/remixicon.css" rel="stylesheet">
<style>
  .product_img{
    width: 60px;
  }
</style>

</head>
<body>
<?php 
   include('ad_layouts/navbar.php');
?>
<br><br><br>
<h3 class="text-center"> Edit Products</h3>
<form action="" method="post" enctype="multipart/form-data">
<?php // echo $plant_name ?>

     <!--title-->
     <div class="form-outline mb-4 w-50 m-auto mt-3">
        <label for="plant_title" class="form-lable">Name of The Plant</label>
        <input type="text" name="plant_title" id="plant_title" class="form-control" value="<?php echo $plant_name; ?>" autocomplete="off" required="required">
      </div>
      <!--description-->
      <div class="form-outline mb-4 w-50 m-auto mt-3">
        <label for="description" class="form-lable">Description</label>
        <!-- <input type="text" name="description" id="description" placeholder="Enter Details About The Plant" class="form-control" autocomplete="off" required="required">
  -->
        <textarea rows="10" cols="60" name="description"  required><?php echo $plant_description; ?></textarea>
      </div>

      <!--keywords-->
      <div class="form-outline mb-4 w-50 m-auto mt-3">
        <label for="plant_keywords" class="form-lable">keywords</label>
        <input type="text" name="plant_keywords" id="plant_keywords" value="<?php echo $plant_keywords; ?>" placeholder="Enter Plant Keywords" class="form-control" autocomplete="off" required="required">

      </div>

      <!--categories-->
      <div class="form-outline mb-4 w-50 m-auto mt-3">
        <label for="plant_category" class="form-lable">Category</label>
        <select name="plant_category"  class="form-select">


          <option value="<?php echo $category_id; ?>"><?php echo $select_category_title; ?></option>
          <?php
          $select_query = "select * from categories";
          $result_query = mysqli_query($con, $select_query);
          while ($row = mysqli_fetch_assoc($result_query)) {
            $category_title = $row['category_title'];
            $category_id = $row['category_id'];
            echo "<option value='$select_category_id'>$category_title</option>";
          }


          ?>


        </select>
      </div>

      <!--soil condition-->
      <div class="form-outline mb-4 w-50 m-auto mt-3">
        <label for="plant_soil" class="form-lable">Soil Condition</label>
        <input type="text" name="plant_soil" id="plant_soil"  value="<?php echo $plant_soil; ?>" placeholder="Enter soil conditions" class="form-control" autocomplete="off" required="required">

      </div>

      <!--sunlight-->
      <div class="form-outline mb-4 w-50 m-auto mt-3">
        <label for="plant_sunlight" class="form-lable">Sunlight</label>
        <input type="text" name="plant_sunlight" id="plant_sunlight"  value="<?php echo $plant_sunlight; ?>" placeholder="Enter about sunlight" class="form-control" autocomplete="off" required="required">

      </div>

      <!--Environment-->
      <div class="form-outline mb-4 w-50 m-auto mt-3">
        <label for="plant_environment" class="form-lable">Environment</label>
        <input type="text" name="plant_environment"  value="<?php echo $environment; ?>" id="plant_environment" placeholder="Enter whether indoor or outdoor plant" class="form-control" autocomplete="off" required="required">

      </div>

      <!--Watering-->
      <div class="form-outline mb-4 w-50 m-auto mt-3">
        <label for="plant_water" class="form-lable">Water Requirement</label>
        <input type="text" name="plant_water"  value="<?php echo $plant_watering; ?>" id="plant_water" placeholder="Enter whether indoor or outdoor plant" class="form-control" autocomplete="off" required="required">

      </div>

      <!--img 1-->
      <div class="form-outline mb-4 w-50 m-auto mt-3 ">
        <label for="plant_image1" class="form-lable">Image</label>
        <img src="plant_images/<?php echo $plant_image1; ?>" alt="" class="product_img " style="float: right;">
        <input type="file" name="plant_image1"  id="plant_image1" class="form-control " required="required">
      
      </div>


      <!--price-->
      <div class="form-outline mb-4 w-50 m-auto mt-3">
        <label for="plant_price" class="form-lable">plant Price</label>
        <input type="text" name="plant_price" id="plant_price" value="<?php echo $plant_price; ?>" placeholder="Enter price of the plant" class="form-control" autocomplete="off" required="required">

      </div>

      <!--quantiy-->
      <div class="form-outline mb-4 w-50 m-auto mt-3">
        <label for="plant_count" class="form-lable">Plant Quantity</label>
        <input type="number" name="plant_count" id="plant_count" value="<?php echo $plant_quantity; ?>" class="form-control" min="0" required="required">

      </div>


      <!--submit-->
      <div class=" text-center mr-5-auto">

        <input type="submit" name="edit_plant" class="btn m-3 p-2 " id="button-submit" value="Update" style="color:bisque; background-color:darkolivegreen;">

      </div>

</form>

<?php
if(isset($_POST['edit_plant'])){
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


 if (
  $plant_title == '' or $description == '' or $plant_keywords == '' or
  $plant_category == '' or $plant_price == '' or $plant_count == '' or
  $plant_image1 == '' or  $plant_soil == '' or $plant_sunlight == '' or
  $plant_environment == '' or $plant_water == ''
) {
  echo "<script>alert('please fill all the available fields')</script>";

}else if($plant_count<0){
  echo "<script>alert('Enter a valid amount of plant quantity')</script>";
}else if($plant_price<=0){
  echo "<script>alert('enter valid amount of the plant price')</script>";
}
else{
  //getting uploaded images to one folder
  move_uploaded_file($temp_image1, "./plant_images/$plant_image1");


  $update_plant = "UPDATE `plants` SET category_id='$plant_category', plant_name='$plant_title', plant_description='$description', plant_keywords='$plant_keywords',
  plant_soil='$plant_soil', plant_sunlight='$plant_sunlight', environment='$plant_environment',
  plant_watering='$plant_water', plant_image1='$plant_image1', plant_price='$plant_price',
  plant_quantity='$plant_count', date=NOW(), status='$plant_status' WHERE plant_id=$edit_plant_id";
  

    $result_update = mysqli_query($con, $update_plant);
    if ($result_update) {
      echo "<script>alert('successfully updated the Plant details') </script>";
      echo "<script>window.open('./index.php?view_products','_self')</script>";
    } else{
      echo "<script>alert('Error :".mysqli_error($con)."')</script>";
    }

   if($plant_count<1){
    $up_status="UPDATE plants SET status='false' WHERE plant_id='$edit_plant_id'";
    
    $update_result= mysqli_query($con, $up_status);

   }else{

     $up_status2="UPDATE plants SET status='true' WHERE plant_id='$edit_plant_id'";
    
    $update_result2= mysqli_query($con, $up_status2);

   }

}


}


?>

</body></html>