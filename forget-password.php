<?php 
session_start();
include 'db.php';
$message="";
if(isset($_POST['sendlink'])) {
$email=$_POST['email'];
$otp=rand(1000,9999);
$sql = "SELECT * FROM users WHERE email='$email'";
$result = mysqli_query($con, $sql);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
     $uid=md5($row['id']);
     $uemail=md5($row['email']);
    $link="http://ecom.thozhilmunaivor.com/reset-password.php?key=".$uid."&request=".$uemail."";
     $subject = "Password Reset Code";
     $message = 'Click on this link to reset password: '.$link.'';
     $sender = "From: unique@gmail.com";

if(mail($email, $subject, $message, $sender)){
      $message="Check Your Email and Click on the link sent to your email";
    }
    else
    {
      $message="Mail Error - >".$mail->ErrorInfo;
    }
   
} else{
    $message="Invalid Email Address";
}   


}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Forget Password - Unique</title>
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
  <h1 align="center">Forget  Password</h1>
<section class="p-3">

    <form class="form" method="post" onsubmit="return validate();">
        
       
        <div class="form-group">
            <input type="email" class="form-control inputfield" name="email" placeholder="Confirm Email" required>
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
            <input type="submit" class=" btn submitbtn" name="sendlink" value="Reset Password" style="width: 100%;">
           </div>

    </form>
</section>


 </div>
</div> 
<?php include 'includes/footer.php'; ?>

</body>
</html>