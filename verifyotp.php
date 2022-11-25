<?php 
session_start();
include 'db.php';
$message="";
if(isset($_POST['verifyotp'])) {
   $email=$_SESSION['emailverify']; 
$otp=$_POST['otp'];
$sql = "SELECT * FROM users WHERE email='$email'";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);

if ($row['OTP']==$otp) {
      
     $sql1 = "UPDATE users SET status='1' WHERE email='$email'";

    if (mysqli_query($con, $sql1)) {
        echo "<script>alert('Thanks for verification. Now you can Login!');</script>";
         echo "<script>window.location.href='login.php';</script>";
    } else {
      $error= "Error: " . $sql . "<br>" . $con->error;
       echo "<script>alert($error);</script>";
      }
   
} else{
    $message="Invalid OTP";
}   


}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Verify OTP - Unique</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/topbar.css">
     <link rel="stylesheet" type="text/css" href="css/footer.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.15.0/css/all.css">
</head>
<body>
<?php include 'includes/topbar.php'; ?>
<img class="img-fluid" src="admin/<?php echo $row10['banner'];?>" alt="Banner">
   <!-- Start Container -->
  <div style=" background-image: linear-gradient(45deg, #8000ff, #ff00c4); width:100%;"> 
    <div style=" padding-top: 30px;padding-bottom: 30px;">
  <h1 align="center">Verify OTP</h1>
<section class="p-3">

    <form class="form" method="post" onsubmit="return validate();">
        
       
        <div class="form-group">
            <input type="text" class="form-control inputfield" name="otp" placeholder="Enter received OTP" required>
        </div>
        
       
          
        <div id="alert" class="alert alert-danger" role="alert"><?php echo $message;?></div>
        
         <script src="js/jquery.min.js"></script>
         <script type="text/javascript">
            $(document).ready(function(){
              var alerttext= $("#alert");
             if (alerttext.text().length<=0) {
                alerttext.style.display='none';
             }
            });
         </script>
         <div class="form-group">
            <input type="submit" class=" btn submitbtn" name="verifyotp" value="Verify OTP" style="width: 100%;">
           </div>

    </form>
</section>


 </div>
</div> 
<?php include 'includes/footer.php'; ?>

</body>
</html>