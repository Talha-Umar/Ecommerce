<?php 
session_start();
include 'db.php';
$message="";
if (!isset($_REQUEST['key'])) {
     echo '<script>window.location.href="forget-password.php";</script>'; 
}
if(isset($_POST['reset'])) {
$password=$_POST['password'];
$key=$_REQUEST['key'];
$request=$_REQUEST['request'];
$sql4 = "UPDATE users SET password='$password' WHERE md5(id)='$key' AND md5(email)='$request'";
if (mysqli_query($con, $sql4)) {
    echo "<script>alert('Your Password is reset. Now you can login with your new password!');</script>";
echo "<script>window.location.href='login.php';</script>";
} else {
   echo "Error updating record: " . mysqli_error($con);
     }  


}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reset Password - Unique</title>
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
    <div style="padding-top: 30px;padding-bottom: 30px;">
  <h1 align="center">Reset Password</h1>
<section class="p-3">

    <form class="form" method="post" onsubmit="return validate();">
        
       
       <div class="form-group icon-div">
            <input type="password" class="form-control inputfield" name="password" placeholder="New Password" id="passwordinput1" required>
            <i class="far fa-eye-slash passicon" id="togglePassword1"></i>
        </div>
          <div class="form-group icon-div">
            <input type="password" class="form-control inputfield passwordinput" placeholder="Conform Password" id="passwordinput2" required>
            <i class="far fa-eye-slash passicon" id="togglePassword2"></i>
        </div>
          
        <div id="alert" class="alert alert-danger" role="alert"><?php echo $message;?></div>
        <div class="form-group">
            <input type="submit" class=" btn submitbtn" name="reset" value="Reset Password" style="width: 100%;">
           </div>

    </form>
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
         
</section>


 </div>
</div> 
<?php include 'includes/footer.php'; ?>

</body>
</html>