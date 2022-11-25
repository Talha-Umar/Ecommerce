<?php
session_start();
include 'db.php';
$message="";
if(isset($_POST['userlogin'])) {
$username= $_POST['username'];
$password = $_POST['password'];

$sql ="SELECT * FROM users WHERE (BINARY username='$username' or phone='$username') and BINARY password ='$password'";
$result = mysqli_query($con, $sql);
$row  = mysqli_fetch_array($result);
if(is_array($row)) {
    if ($row['status']=='1') {
       $_SESSION["user_id"]=$row['id'];
     } else{
        echo "<script>alert('Your Account is not verify.Please verify it before login..');</script>";
         echo "<script>window.location.href='verifyemail.php';</script>";
     }
} else {
$message = "Invalid Username/Mobile or Password!";
}
}

if(isset($_SESSION["user_id"])){
     header("Location:profile.php");   
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login - Unique</title>
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
  <div style="background-image: linear-gradient(45deg, #8000ff, #ff00c4); width:100%;"> 
    <div style="padding-top: 30px;padding-bottom: 30px;">
  <h1 align="center">Login Here</h1>
<section class="p-3">

    <form method="post" class="form">
        <div class="form-group">
            <input type="text" class="form-control inputfield" name="username" placeholder="Username or Phone Number" required>
        </div>
       
        <div class="form-group icon-div">
            <input type="password" class="form-control inputfield" name="password" placeholder="Password" id="passwordinput" required>
             <i class="far fa-eye-slash passicon" id="togglePassword"></i>
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
  $(document).on('click', '#togglePassword', function() {

    $(this).toggleClass("fa-eye fa-eye-slash");
    
    var input = $("#passwordinput");
    input.attr('type') === 'password' ? input.attr('type','text') : input.attr('type','password')
});

         </script>
        <div class="form-group">
            <input type="submit" class="btn submitbtn" name="userlogin" value="Login">
         </div>

          <div class="alert  text-center" role="alert" style="font-weight:bold; ">
            Don't have an account? <a href="signup.php">Signup here..</a><br>
               Forget Password? <a href="forget-password.php">Reset here..</a>
          </div>
    </form>

</section>


 </div>
</div> 
<?php include 'includes/footer.php'; ?>

</body>
</html>