<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Terms & Services - Unique</title>
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
  <h1 align="center">Terms & Services</h1>
<section class="p-3">
 <?php 
      $sql1 = "SELECT * FROM social_links";
       $result1 = $con->query($sql1);
        $row1 = $result1->fetch_assoc();
                ?>
    <div align="center"><?php echo $row1['terms'];?></div>

</section>


 </div>
</div> 
<?php include 'includes/footer.php'; ?>

</body>
</html>