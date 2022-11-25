<?php 
include 'db.php'; 
$message1="";
if (isset($_POST['send'])) {
$name=$_POST['name'];
$email=$_POST['email'];
$subject=$_POST['subject'];
$message=$_POST['message'];
date_default_timezone_set("Asia/Karachi");
$datetime=date("d/m/Y - H:i A");
$sql = "INSERT INTO comments (name,email,subject,message,date_time)
VALUES ('$name', '$email','$subject','$message','$datetime')";

if (mysqli_query($con, $sql)) {
 $message1 = "Thanks For Contactig Us. We will respond you back soon!!!";
}
else {
  echo "Error: " . $sql . "<br>" . mysqli_error($con);
} 
}
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Contact Us - Unique</title>
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
  <h1 align="center">Contact Us</h1>
<section class="p-3">

    <form class="form" method="post">
        <div class="form-group">
            <input type="text" class="form-control inputfield" name="name" placeholder="Name" required>
        </div>
        <div class="form-group">
            <input type="email" class="form-control inputfield" name="email" placeholder="Email" required>
        </div>
        <div class="form-group">
            <input type="text" class="form-control inputfield" name="subject" placeholder="Subject" required>
        </div>
       
        <div class="form-group">
           <textarea class="form-control inputfield" rows="3" name="message" placeholder="Message*" required></textarea>
        </div>
        <div id="alert" class="alert alert-success" role="alert"><?php echo $message1;?></div>
        <script src="js/jquery.min.js"></script>
         <script type="text/javascript">
             $(document).ready(function(){
              var alerttext= $("#alert");
             if (alerttext.text().length<=0) {
                alerttext.style.display='none';
                  }
             });
         </script>
          

        
            <input type="submit" class="btn submitbtn" name="send" value="Send Message">

    </form>
</section>


 </div>
</div> 
<?php include 'includes/footer.php'; ?>

</body>
</html>