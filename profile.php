<?php 
include 'db.php';
if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
$userid=$_SESSION["user_id"]; 

 if (isset($_POST['submited'])) {
                $filename = $_FILES['imageUpload']['name'] ;
                $tempname = $_FILES['imageUpload']['tmp_name'] ; 
                $filesize = $_FILES['imageUpload']['size'] ;
                $fileextension = explode('.', $filename) ;
                $fileextension = strtolower(end($fileextension));

                $newfilename = uniqid().'images'.'.'.$fileextension ;
                $path = "img/userprofile/".$newfilename ;
                // echo ($userid);
             $sql4 = mysqli_query($con,"UPDATE users SET profile='$path' WHERE id='$userid'");
            if (move_uploaded_file($tempname, $path) && $sql4)  {
             echo "<script>window.location.href='profile.php';</script>";
             } else {
              echo "Error updating record: " . $con->error;
                }
        } 

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Profile - Unique</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/topbar.css">
     <link rel="stylesheet" type="text/css" href="css/footer.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.15.0/css/all.css">
    <style type="text/css">
        th,td{
            text-align: center;
        }
    </style>
</head>
<body>
 <?php include 'includes/topbar.php'; ?>

   <!-- Start Container -->
<div style=" background-image: linear-gradient(45deg, #8000ff, #ff00c4); width:100%; padding-top: 30px;padding-bottom: 30px; position: relative;">
<div class="form1">

     <?php

     $sql = "SELECT * FROM users WHERE id='$userid'";
      $result = mysqli_query($con, $sql);
      $row = mysqli_fetch_assoc($result);
     
      ?>   
        <form method="post" enctype="multipart/form-data" id="form">
        <div class="profile-pic-div">
           <img src="<?php 
           if($row['profile']=='') {
            echo "img/user.jpg";
           } else{
            echo $row['profile'];
           }
       ?>" id="photo">
           <input type="file" id="file" name="imageUpload" onchange="document.getElementById('form').submit();">
           <label for="file" id="uploadBtn" name="uploadBtn">Choose Photo</label>
        </div>
        <input type="hidden" name="submited" value="1" />
    </form>
       
         <div id="name"><b><?php echo $row['fullname'];?></b></div><br>
        <?php if (isset($_SESSION['order_placed'])) { ?>
    <div class="alert alert-danger" role="alert">
  <b>Payment Conformation!</b><br>
  Please Contact us using WhatsApp after 30 minutes for manual approval of your payment. If you have enter TID Correctly then don't worry it can will be approved by admin.
     </div>
     <?php  }
     unset($_SESSION['order_placed']);
      ?>
  
        <div class="tables">
            <table class="table table-bordered p-2 table-responsive-lg">
                <h1 align="center">TODAY</h1>
                <thead>
                    <tr>
                       <th>Sr.</th>
                       <th>Order No</th>
                       <th>Design</th>
                       <th>Price</th>
                       <th>Payment Method</th>
                       <th>TID</th>
                       <th>Status</th>
                       <th>Date</th>
                    </tr>
                 </thead>
               <tbody>
                    <?php
                    $j=0;
                    $sql = "SELECT * FROM orders WHERE user_id='$userid' AND order_date=CURDATE() order by (id) DESC";
                     $result = mysqli_query($con, $sql);
                     if (mysqli_num_rows($result) > 0) {
                      while($row = mysqli_fetch_assoc($result)) {

                     ?>
                    <tr>
                    <td><?php echo ++$j;?></td>
                    <td>orderno#<?php echo $row['id'];?></td>
                    <td><?php
                    $pid=$row['product_id'];
                       $sql1 = "SELECT * FROM products WHERE id='$pid'";
                       $result1 = mysqli_query($con, $sql1);
                       $row1 = mysqli_fetch_assoc($result1);
                       echo $row1['product_code'];
                      ?></td>
                    <td><?php echo $row['Paid_amount'];?></td>
                    <td><?php echo $row['Method'];?></td>
                    <td><?php echo $row['TID'];?></td>
                    <td><?php 
                        if ($row['status']=='0') {
                           echo "Pending";
                        }
                        if ($row['status']=='1') {
                           echo "Completed";
                        }
                        if ($row['status']=='2') {
                           echo "Cancelled";
                        }
                      ?></td>
                    <td><?php echo $row['order_date'];?></td>
                </tr>
            <?php } } else {?>
                <th colspan="8">No order placed yet..</th>
            <?php } ?>
                </tbody>
            </table>

            <table class="table table-bordered p-2 table-responsive-lg">
                <h1 align="center">PREVIOUS</h1>
                <thead>
                    <tr>
                       <th>Sr.</th>
                       <th>Order No</th>
                       <th>Design</th>
                       <th>Price</th>
                       <th>Payment Method</th>
                       <th>TID</th>
                       <th>Status</th>
                       <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $k=0;
                    $sql2 = "SELECT * FROM orders WHERE user_id='$userid' AND order_date<CURDATE() order by (id) DESC";
                     $result2 = mysqli_query($con, $sql2);
                     if (mysqli_num_rows($result2) > 0) {
                      while($row2 = mysqli_fetch_assoc($result2)) {

                     ?>
                    <tr>
                    <td><?php echo ++$k;?></td>
                    <td>orderno#<?php echo $row2['id'];?></td>
                     <td><?php
                       $ppid=$row2['product_id'];
                       $sql3 = "SELECT * FROM products WHERE id='$ppid'";
                       $result3 = mysqli_query($con, $sql3);
                       $row3 = mysqli_fetch_assoc($result3);
                       echo $row3['product_code'];
                      ?></td>
                    <td><?php echo $row2['Paid_amount'];?></td>
                    <td><?php echo $row2['Method'];?></td>
                    <td><?php echo $row2['TID'];?></td>
                    <td><?php 
                        if ($row2['status']=='0') {
                           echo "Pending";
                        }
                        if ($row2['status']=='1') {
                           echo "Completed";
                        }
                        if ($row2['status']=='2') {
                           echo "Cancelled";
                        }
                      ?></td>
                    <td><?php echo $row2['order_date'];?></td>
                </tr>
            <?php } } else {?>
                <th colspan="8">No order placed yet..</th>
            <?php } ?>
                </tbody>
            
            </table>
            
        </div>
        </div> 
    </div>
<?php include 'includes/footer.php'; ?>
<script src="js/profile.js"></script>
</body>
</html>