<?php
include('../includes/connect.php');
//when clicking the buton that have the name of insert_cat........input boxs value is added to 
//the variable
if (isset($_POST['insert_faq'])) {
    $faqQuestion = $_POST['faqQuestion'];
    $faqAnswer = $_POST['faqAnswer'];


    
        $insert_faq = "insert into faqs (faq_qsn,faq_ansr) values ('$faqQuestion','$faqAnswer')";
        $result = mysqli_query($con, $insert_faq);

        if ($result) {
            echo "<script>alert('Category has been added successfully')</script>";
        }
    }

?>

<h2>Insert FAQ</h2>
<hr class="mx-auto w-25 mb-5">
<form action="" method="post" class="mb-2">
    <div class="input-group flex-nowrap">
        <span class="input-group-text" id="addon-wrapping">#</span>
        <input type="text" class="form-control" name="faqQuestion" placeholder="Enter Question" aria-describedby="addon-wrapping" required>
    </div>
    <br>
    <div class="input-group flex-nowrap">
        <span class="input-group-text" id="addon-wrapping">#</span>
        <input type="text" class="form-control" name="faqAnswer" placeholder="Enter Answer" aria-describedby="addon-wrapping" required>
    </div>

    <div class="input-group flex-nowrap w-10 mb-2 mt-2">

        <input type="submit" class="abc mt-2" name="insert_faq" value="ADD NEW FAQ" aria-describedby="addon-wrapping">

        <!-- <button class="abc mt-2 align-left">ADD</button>-->

    </div>
</form>