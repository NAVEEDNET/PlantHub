 <?php
 //session_start();
 ?>
 
 <!--nav bar-->
 <nav class="navbar navbar-expand-lg navbar-light text-nowrap bg-white py-3 fixed=top">
    <div class="container">
      <a href="index.html" class="nav__logo">
        <img class="logo" src="images/logo.png">Plant HuB</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse nav-buttons" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">

          <li class="nav-item">
            <a class="nav-link" href="index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">About Us</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="Products.php">Products</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="faq.php">FAQs</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="contact.php">Contect Us</a>
          </li>

          <li class="nav-item">
            <a href="cart.php" class="i-link"><i class="ri-shopping-cart-2-fill" id="fas">
            <?php if(isset($_SESSION['quantity']) && $_SESSION['quantity']!=0){ ?>
              <sup class="cart_quantity" style="background-color: green;color: #fff;padding: 2px 5px;border-radius: 50%;margin: -3px;font: size 1rem;">
              <?php echo $_SESSION['quantity']; ?></sup>
              <?php } ?>
            </i></a>
            <a href="account.php" class="i-link"><i class="ri-user-line" id="fas"></i></a>
          </li>




        </ul>
        <!-- <form class="d-flex">
              <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
              <button class="btn btn-outline-success" type="submit">Search</button>
            </form>-->



      </div>
    </div>
  </nav>