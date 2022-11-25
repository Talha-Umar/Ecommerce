<?php 
include('../db.php');
if(isset($_GET['id']))
{

$id = $_GET['id'];
$status = $_GET['status'];

if(mysqli_query($con, "UPDATE products SET `status` = '$status' WHERE `id` ='$id'"))
{
  $_SESSION['status']="Status Changed!";
  $_SESSION['btn_code']="success";
  echo "<script>window.location.href='product.php';</script>";
  exit;
}
else {
   $_SESSION['status']="Failed!!";
   $_SESSION['btn_code']="error";
}
}
?>