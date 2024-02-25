<h3 class="text-center">Category List</h3>
<table class="table table-bordered mt-5 my-2 text-center">
       <tr>
        <th>No</th>
        <th>Category Name</th>
        <th>Edit</th>
        <th>Delete</th>
</tr>
<tr>
    <?php
    $select_category="SELECT * FROM categories";
    $result=mysqli_query($con,$select_category);
    $number=0;
    while($row=mysqli_fetch_assoc($result)){
        $category_id=$row['category_id'];
        $category_title=$row['category_title'];

        $number++;
    ?>
    <td><?php echo $number; ?></td>
    <td><?php echo $category_title; ?></td>
    <td><a href="index.php?edit_category=<?php echo $category_id ?>"><i class="ri-edit-2-fill"></i></a></td>
        
        <td><a href="index.php?delete_category=<?php echo $category_id ?>" ><i class="ri-delete-bin-6-fill"></i></a></td>
       </tr>
</tr>
<?php }?>
    </table>



<!-- Modal --><!--
type="button" class="btn" data-toggle="modal" data-target="#exampleModalCenter"
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
 
      <div class="modal-body">
      <h4 style="font-weight: 100;">are you sure you want to delete this?</h4>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><a href="index.php?view_category" style="text-decoration: none;color:#fff;">No</a></button>
        <button type="button" class="btn btn-primary"> <a href="index.php?delete_category=<?php echo $category_id ?>" style="text-decoration: none;color:#fff;"  >Yes</a></button>
      </div>
    </div>
  </div>
</div>-->




