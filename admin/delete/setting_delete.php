<?php 
if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
if(!isset($_SESSION["admin_id"])){
     // echo "<script type='text/javascript'>location.replace('../index.php')</script>";
    
}
include "../../db.php"; 

if (isset($_POST['delete_btn'])) {
    $id= $_POST['deleteid'];
    $queryDell = "DELETE FROM social_links WHERE id = '$id'" ;
    $run_query=mysqli_query($con, $queryDell);

   if($run_query){ 
      $_SESSION['status']="Delete Successfully!";
      $_SESSION['btn_code']="success";
      echo "<script>window.location.href='../website.php';</script>"; 
      exit;
}
else{
    $_SESSION['status']="Error";
    $_SESSION['btn_code']="error";
    echo "<script>window.location.href='../website.php';</script>"; 
      exit;
}
}
?>