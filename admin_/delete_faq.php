<?php

if (isset($_GET['delete_faq'])){
    $delete_faq_id=$_GET['delete_faq'];
    echo $delete_faq_id;

    $delete_faq="DELETE  FROM `faqs` WHERE faq_id=$delete_faq_id";
    $result_faq=mysqli_query($con,$delete_faq);
    if($result_faq){
        echo "<script>alert('FAQ deleted successfully!') </script>";
        echo "<script>window.open('./index.php?view_faq','_self')</script>";
  
    }
}

?>