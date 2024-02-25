<?php
//session_start();
if (!isset($_SESSION['admin_logged_in'])) {
  header('location:login.php');
  exit;
}
include('../includes/connect.php');
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin_Dashboard</title>
  <!--bootsrap css link-->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <link rel="stylesheet" href="admin_style.css">


  <!--  _________________ Favicon img _____________-->
  <link rel="shortcut icon" href="images/favicon.jpg" type="image/x-icon">


  <!--  _________________ Remix Icons _____________-->
  <link href="https://cdn.jsdelivr.net/npm/remixicon@3.0.0/fonts/remixicon.css" rel="stylesheet">


</head>
<body>
<?php 
   include('ad_layouts/navbar.php');
?>


<div class="mt-5">
    <h3 class="text-center mt-5">PLANT LIST</h3>
    <table class="table table-bordered mt-5 my-2">
       <tr>
        <th>No</th>
        <th>Plant Name</th>
        <th>Plant Image</th>
        <th>Plant Price</th>
        <th>Available Plant Count</th>
        <th>Sold Plants</th>
        <th>Status</th>
        <th>Edit</th>
        <th>Delete</th>
       </tr>
<?php
$get_plants="SELECT * FROM plants";
$result=mysqli_query($con,$get_plants);
$number=0;
while($row=mysqli_fetch_assoc($result)){

    $plant_id=$row['plant_id'];
$number++;
?>


       <tr class="text-center">
        <td><?php echo $number;?></td>
        <td><?php echo $row['plant_name'];?></td>
        <td> <img class="img-fluid mb-3" style="width: 50px;" src="plant_images/<?php echo $row['plant_image1']; ?>"></td>
        <td><?php echo $row['plant_price'];?></td>
        <td><?php echo $row['plant_quantity'];?></td>
        <td><?php
       
        $get_count= mysqli_query($con,"SELECT * FROM sold_item_qty WHERE plant_id=' $plant_id'");
         while ($row2=mysqli_fetch_array($get_count)) {
             $quantity=$row2['sold'];
             echo $quantity;
            }

         ?></td>
        <td><?php echo $row['status'];?></td>
        <td><a href="index.php?edit_products=<?php echo $plant_id ?>"><i class="ri-edit-2-fill"></i></a></td>
        
        <td><a href="index.php?delete_product=<?php echo $plant_id ?>"><i class="ri-delete-bin-6-fill"></i></a></td>
       </tr>
       <?php 


    } ?>
    <?php
 
    ?>
    </table>
    </div>
</body>
</html>