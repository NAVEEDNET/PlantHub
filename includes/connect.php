<?php
//$con=mysqli_connect('localhost','root','password','database name')

$con=mysqli_connect('localhost','root','','plant_hub');
if(!$con){
    die(mysqli_error($con));
    
}
