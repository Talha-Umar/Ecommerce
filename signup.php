<?php 
include 'db.php';
$message="";
if(isset($_POST['signup'])) {
$username=$_POST['username'];
$fullname=$_POST['fullname'];
$email=$_POST['email'];
$mobile=$_POST['mobile'];
$password=$_POST['password'];
date_default_timezone_set("Asia/Karachi");
$date=date("d-m-Y");
$sql = "SELECT * FROM users WHERE username='$username' OR email='$email' OR phone='$mobile'";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);
if ($row['username']!=$username) {
if ($row['email']!=$email) {
if ($row['phone']!=$mobile) {
if ($row['phone']!=$mobile && $row['email']!=$email) {
if ($row['phone']!=$mobile && $row['username']!=$username) {
if ($row['email']!=$email && $row['username']!=$username) {
if ($row['phone']!=$mobile && $row['username']!=$username && $row['email']!=$email) {
      
      $sql = "INSERT INTO users (username, fullname, email, phone, password,register_date)
      VALUES ('$username', '$fullname', '$email','$mobile','$password','$date')";

    if ($con->query($sql) === TRUE) {
         echo "<script>window.location.href='verifyemail.php';</script>";
    } else {
      $error= "Error: " . $sql . "<br>" . $con->error;
       echo "<script>alert($error);</script>";
      }
   
} else{
    $message="username, email and phone is already taken";
}   
} else{
    $message="email and username is already taken";
} 
   
} else{
    $message="phone and username is already taken";
} 

} else{
    $message="phone and email is already taken";
} 
   
} else{
    $message="phone is already taken";
}  
} else{
    $message="Email is already taken";
}   
} else{
    $message="username is already taken";
}

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Signup - Unique</title>
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
  <h1 align="center">Signup Here</h1>
<section class="p-3">

    <form class="form" method="post" onsubmit="return validate();">
        <div class="form-group">
            <input type="text" class="form-control inputfield" name="username" placeholder="Enter Username" required>
        </div>
        <div class="form-group">
            <input type="text" class="form-control inputfield" name="fullname" placeholder="EnterFull Name" required>
        </div>
        <div class="form-group">
            <input type="email" class="form-control inputfield" name="email" placeholder="Enter Email" required>
        </div>
        <div class="form-group">
            <input type="text" class="form-control inputfield" name="mobile" placeholder="Enter Mobile Phone Number" required>
        </div>
        <div class="form-group icon-div">
            <input type="password" class="form-control inputfield" name="password" placeholder="Enter Password" id="passwordinput1" required>
            <i class="far fa-eye-slash passicon" id="togglePassword1"></i>
        </div>
          <div class="form-group icon-div">
            <input type="password" class="form-control inputfield passwordinput" placeholder="Conform Password" id="passwordinput2" required>
            <i class="far fa-eye-slash passicon" id="togglePassword2"></i>
        </div>
        <div id="alert" class="alert alert-danger" role="alert"><?php echo $message;?></div>
        <script type="text/javascript">
            function validate() {
                    var password = document.getElementById("passwordinput1").value;
                    var confirmPassword = document.getElementById("passwordinput2").value;
                if (password != confirmPassword) {
                  document.getElementById("alert").innerHTML='Passwords not match.';
                    return false;
                } else{
                    return true;
                }
            }
        </script>
         <script src="js/jquery.min.js"></script>
         <script type="text/javascript">
            $(document).ready(function(){
              var alerttext= $("#alert");
             if (alerttext.text().length<=0) {
                alerttext.style.display='none';
             }
            });
  $(document).on('click', '#togglePassword1', function() {
    $(this).toggleClass("fa-eye fa-eye-slash");
    var input = $("#passwordinput1");
    input.attr('type') === 'password' ? input.attr('type','text') : input.attr('type','password')
});
  $(document).on('click', '#togglePassword2', function() {
    $(this).toggleClass("fa-eye fa-eye-slash");
    var input = $("#passwordinput2");
    input.attr('type') === 'password' ? input.attr('type','text') : input.attr('type','password')
});
         </script>
         <div class="form-group">
            <input type="submit" class=" btn submitbtn" name="signup" value="Signup" style="width: 100%;">
           </div>
            <div class="alert  text-center" role="alert" style="font-weight:bold;">
            Have an account? <a href="login.php">Login here..</a>
          </div>

    </form>
</section>


 </div>
</div> 
<?php include 'includes/footer.php'; ?>

</body>
</html>