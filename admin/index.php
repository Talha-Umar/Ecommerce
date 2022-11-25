<?php
session_start();
$message="";
if(isset($_POST['login'])) {
 include '../db.php';
$email= $_POST['email'];
$password = $_POST['password'];
$sql ="SELECT * FROM admin WHERE BINARY email='$email' and BINARY password ='$password'";
$result = mysqli_query($con, $sql);
$row  = mysqli_fetch_array($result);
if(is_array($row)) {
$_SESSION["admin_id"]=$row['id'];
} else {
$message = "Invalid Email or Password!";
}
}

if(isset($_SESSION["admin_id"])){
     header("Location:dashboard.php");
    
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Admin Login</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
    <link rel="stylesheet" type="text/css" href="css/loginform.css">
</head>
<body>
<div class="wrapper">
    <div class="logo"> <img src="images/adminprofile/avatar5.png" alt=""> </div>
    <div class="text-center mt-4 name">Admin Login</div>
    <form class="p-3 mt-3" method="post">
        <div class="form-field d-flex align-items-center"> <span class="far fa-user"></span> <input type="email" name="email"  placeholder="Email"> </div>
        <div class="form-field d-flex align-items-center"> <span class="fas fa-key"></span> <input type="password" name="password" id="passwordinput" placeholder="Password">
            <i class="far fa-eye-slash passicon" id="togglePassword"></i>
         </div> 
         <script src="js/jquery.min.js"></script>
         <script type="text/javascript">
             $(document).on('click', '#togglePassword', function() {

    $(this).toggleClass("fa-eye fa-eye-slash");
    
    var input = $("#passwordinput");
    input.attr('type') === 'password' ? input.attr('type','text') : input.attr('type','password')
});
         </script>
       <span style="color: red;"><?php echo $message; ?></span>
        <button type="submit" name="login" class="btn mt-3">Login</button>
    </form>
</div>

<script type="text/javascript" src="js/bootstrap.bundle.min.js"></script>
</body>
</html>