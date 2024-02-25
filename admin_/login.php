<?php 
session_start();
include('../includes/connect.php');


if(isset($_SESSION['admin_logged_in'])){
  header('Location: index.php');
  exit; 
}

if (isset($_POST['login_btn'])) {
  $email = $_POST['email'];
  $password = md5($_POST['password']);

  $stmt = $con->prepare("SELECT admin_id,admin_name,admin_email,admin_password FROM admins WHERE admin_email=? AND admin_password=? LIMIT 1");

  $stmt->bind_param('ss', $email, $password);

  if ($stmt->execute()) {

    $stmt->bind_result($admin_id, $admin_name, $admin_email, $admin_password);
$stmt->store_result();

if ($stmt->num_rows() == 1) {
  $stmt->fetch();

  $_SESSION['admin_id'] = $admin_id;
  $_SESSION['admin_name'] = $admin_name;
  $_SESSION['admin_email'] = $admin_email;
  $_SESSION['admin_logged_in'] = true;

  header("Location: index.php?login_success=$admin_name logged in successfully"); 
} else {
  header('Location: login.php?error=Invalid email ID or password'); 
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
  


  <!--  _________________ Favicon img _____________-->
  <link rel="shortcut icon" href="images/favicon.jpg" type="image/x-icon">


  <!--  _________________ Remix Icons _____________-->
  <link href="https://cdn.jsdelivr.net/npm/remixicon@3.0.0/fonts/remixicon.css" rel="stylesheet">

  <title>Admin Login</title>
  <style>
    



    body {
      font-family: Arial, sans-serif;
     
    }

    .container {
      max-width: 400px;
      margin: 0 auto;
      padding: 20px;
      border: 1px solid #ccc;
      margin-top: 150px;
    }

   

    .form-group {
      margin-bottom: 20px;
      text-align: left;
    }

    .form-group label {
      display: block;
      font-weight: bold;
      margin-bottom: 5px;
      text-align: left;
    }

    .form-group input[type="text"],
    .form-group input[type="password"] {
      width: 100%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 4px;
      box-sizing: border-box;
    }

    .form-group .error-message {
      color: red;
      margin-top: 5px;
      text-align: left;
    }

    .form-group input[type="submit"] {
      background-color: #4CAF50;
      color: white;
      border: none;
      padding: 10px 20px;
      cursor: pointer;
      border-radius: 4px;
      width: auto;
      margin: 0 auto;
    }
  </style>
</head>

<body>

<?php

 if (isset($_GET['error']) && $_GET['error'] !== '') { ?>
 <?php echo "<script>alert('" . $_GET['error'] . "');</script>"; ?>
  <?php } ?>



  <div class="container">
    <div style="  display: flex;
    align-items: center; ">
    <img src="../images/logo.png" alt="" style="width: 100px;float: right;">
    <h2 style="text-align: left; color:#546461">Admin Login </h2>
    </div>
    <br>
  <div>
    <form id="loginForm" method="POST" action="login.php" class="logo">
      <div class="form-group">
        <label for="username">Email ID:</label>
        <input type="text" id="username" name="email" required>
        <span class="error-message" id="usernameError"></span>
      </div>
      <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <span class="error-message" id="passwordError"></span>
      </div>
      <div class="form-group">
        <input type="submit" value="Login" name="login_btn">
      </div>
    </form>
    </div>
  </div>

  <script>
    document.getElementById('loginForm').addEventListener('submit', function(event) {
      var usernameInput = document.getElementById('username');
      var passwordInput = document.getElementById('password');
      var usernameError = document.getElementById('usernameError');
      var passwordError = document.getElementById('passwordError');

      // Reset error messages
      usernameError.textContent = '';
      passwordError.textContent = '';

      // Validate username
      if (usernameInput.value.trim() === '') {
        usernameError.textContent = 'Username is required.';
        event.preventDefault();
      
      }

      // Validate password
      if (passwordInput.value.trim() === '') {
        passwordError.textContent = 'Password is required.';
        event.preventDefault();
      
      }
    });
  </script>
</body>

</html>
