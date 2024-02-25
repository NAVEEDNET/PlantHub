<h3 class="text-center">FAQs List</h3>
<table class="table table-bordered mt-5 my-2 text-center">
       <tr>
        <th>No</th>
        <th>Question</th>
        <th>Answer</th>
       
        <th>Delete</th>
</tr>
<tr>
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
    <td><?php echo $number; ?></td>
    <td><?php echo $faq_qsn; ?></td>
    <td><?php echo $faq_ansr; ?></td>
   
        
        <td><a href="index.php?delete_faq=<?php echo $faq_id ?>" ><i class="ri-delete-bin-6-fill"></i></a></td>
       </tr>
</tr>
<?php }?>
    </table>