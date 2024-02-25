<!DOCTYPE html>
<html lang="en">

<head>
<?php
include('includes/connect.php');
include('layouts/header.php');
?>

    <style>
        /*FAQ section, where the accordion is kept, including section specific css*/
        #faq {
            display: flex;

            align-items: center;
            justify-content: center;

            width: 100%;
            min-height: 100vh;
        }

        #faq .add {
            /*Add is the name for the plus icon*/
            display: block;
        }

        #faq .remove {
            /*Remove is the name for the less icon*/
            display: none;
        }

        #faq i {
            font-size: 10px;
        }

        /*Accordion container and each item*/
        .accordion {
            max-width: 800px;

            margin: 0 auto;
            padding: 0 1.5rem;
        }

        .accordion-item {
            background-color: transparent;
            border-bottom: 3px solid darkolivegreen;

            margin-bottom: 10px;
            padding: 10px;
        }

        /*Styles for the question*/

        .accordion-title {
            display: flex;

            align-items: center;
            justify-content: space-around;

            color: black;
            font-size: 5px;
            /*   font-family: Open Sans;*/
            font-weight: 400;

            width: 100%;
            padding: 1rem 0;
            cursor: pointer;
            transition-duration: 0.5s;
        }

        .accordion-title:hover {
            color: darkolivegreen;
        }

        .accordion-title h2 {
            width: 60%;
            font-size: 20px;
        }

        /*Styles for the answer*/

        .accordion-content {
            max-height: 0;
            overflow: hidden;
            position: relative;
            background-color: rgb(228, 228, 228);
            transition: max-height 0.6s;
            /* font-family: Open Sans;*/
            font-weight: 400;
        }

        .accordion-content p {
            padding: 20px;
            color: darkolivegreen;
            font-size: 15px;
        }
    </style>
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




    <!--faq-->
    <section id="faq my-5 py-5">
        <br><br>

        <div class="accordion mt-3 pt-5">
            <div>
                <h2 class="form-weight-bold text-center">FAQs</h2>
                <hr class="mx-auto w-25">

            </div>
            <?php
    $select_faqs="SELECT * FROM faqs";
    $result=mysqli_query($con,$select_faqs);
    $number=0;
    while($row=mysqli_fetch_assoc($result)){
        $faq_qsn=$row['faq_qsn'];
        $faq_ansr=$row['faq_ansr'];
        $faq_id=$row['faq_id'];
        $number++;
    ?>

            <div class="accordion-item">
                <div class="accordion-title">
                    <h2><?php echo $faq_qsn; ?></h2>
                    <i class="material-icons add"></i>
                    <i class="material-icons remove"></i>
                </div>
                <div class="accordion-content">
                    <p><?php echo $faq_ansr; ?></p>
                </div>
            </div>
            <?php }?>
            
            
            
        </div>

        <script src="script.js"></script>
    </section>






















    <script>
        const questions = document.getElementsByClassName('accordion-title') //Gets all the questions (plus icon)

        for (const question of questions) {
            const answer = question.parentElement.querySelector('.accordion-content')
            const remove = question.parentElement.querySelector(".remove")
            const add = question.parentElement.querySelector(".add")
            let open = false //Variable to check if the answer is visible or not

            function openAnswer() {
                if (open == true) { //If you click the question while the answer is visible it will stop being visible and open will change it's value to false
                    add.style.display = "block";
                    remove.style.display = "none";
                    answer.style.overflow = "hidden";
                    answer.style.maxHeight = '0';
                    open = false;
                } else { //If you click the question while the answer is not visible it will start being visible and open will change it's value to true
                    add.style.display = "none";
                    remove.style.display = "block";
                    answer.style.maxHeight = "300px";
                    answer.style.overflow = "visible";
                    open = true;
                }
            }

            question.addEventListener('click', openAnswer)
        }
    </script>













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

</body>

</html>