<?php 
include 'db.php';
if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
if(!isset($_SESSION["user_id"])){
  echo "<script>alert('You cannot place an order without login..');</script>";
     echo "<script type='text/javascript'>location.replace('login.php')</script>";
    
}
 $userid=$_SESSION["user_id"]; 

 if (isset($_POST['placeorder'])) {
   $product=$_POST['product'];
   $price=$_POST['price'];
   $method=$_POST['method'];
   $tid=$_POST['tid'];
   date_default_timezone_set("Asia/Karachi");

    $sql3 = "INSERT INTO orders (product_id,user_id,order_date,Method,TID,Paid_amount)
VALUES ('$product', '$userid',CURDATE(),'$method','$tid','$price')";

if (mysqli_query($con, $sql3)) {
 $_SESSION['order_placed']='success';
  echo "<script>window.location.href='profile.php';</script>";
}
else {
  echo "Error: " . $sql3 . "<br>" . mysqli_error($con);
} 

 }
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Place Order - Unique</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/topbar.css">
     <link rel="stylesheet" type="text/css" href="css/footer.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.15.0/css/all.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
   <script src="js/jquery.min.js"></script> 
    <script src="js/selectprice.js"></script>
</head>
<body>
	<?php include 'includes/topbar.php'; ?>
    <img class="img-fluid" src="admin/<?php echo $row10['banner'];?>" alt="Banner">
<!-- Start Container -->
  <div style=" background-image: linear-gradient(45deg, #8000ff, #ff00c4); width:100%;"> 
	<div style=" padding-top: 30px;padding-bottom: 30px;">
    <h1 align="center">Place Your Order</h1>
		<form method="post" name="form1" class="form">
   <div class="form-group">
    <?php 

    $sql2 = "SELECT * FROM orders order by (id) DESC";
      $result2 = mysqli_query($con, $sql2);
      $row2 = mysqli_fetch_assoc($result2);
      $orderno=$row2['id']+1;
    ?>
    <input style="" type="text" class="form-control inputfield" value="orderno#<?php echo $orderno;?>" readonly>
  </div>
  <div class="form-group">
    <select class="form-control select2 inputfield" name="product" id="product" data-live-search="true" required>
      <option value="">--Select Product--</option>
      <?php

      $sql = "SELECT * FROM category";
      $result = mysqli_query($con, $sql);
       while($row = mysqli_fetch_assoc($result)) {
         $cate_id=$row['id'];
       ?>
    		<optgroup data-tokens="<?php echo $row['cate_name'];?>" label="<?php echo $row['cate_name'];?>">
          <?php
              $sql1 = "SELECT * FROM products WHERE cate_id='$cate_id' AND status='1'";
              $result1 = mysqli_query($con, $sql1);
             while($row1 = mysqli_fetch_assoc($result1)) {
           ?>
               <option value="<?php echo $row1['id'];?>" data-tokens="<?php echo $row1['product_code'].','.$row['cate_name'];?>"><?php echo $row1['product_code'];?></option>
        <?php } } ?>  
        </optgroup>
    </select>
  </div>
  <div class="form-group">
    <input type="text" class="form-control inputfield" name="price" id="price" placeholder="Price" readonly>
  </div>
  <div class="form-group">
    <select class="form-control  inputfield" name="method" id="paymentmethod" required>
      <option value="">--Select Payment Method--</option>
        <option value="Jazzcash">Jazzcash</option>
        <option value="Easypaisa">Easypaisa</option>
        <option value="Stripe">Stripe</option>
    </select>
  </div>
  <?php 
$sql4 = "SELECT * FROM bank_detail";
$result4 = mysqli_query($con, $sql4);
$row4 = mysqli_fetch_assoc($result4);
   ?>
  <div class="alert alert-danger" role="alert" id="platform" style="display:none;">
  Please send <b>PKR. <span id="ep">0</span></b> to your <span id="plt"></span> Account.<br>
  <ul style="margin-left:25px;">
      <li>Bank Name: <b><?php echo $row4['b_name'];?></b></li>
      <li>Bank Account Title: <b><?php echo $row4['b_title'];?></b></li>
      <li>Bank Account Number: <b><?php echo $row4['b_account'];?></b><br>
      <li>Reference Mobile Number: <b><?php echo $row4['b_reference'];?></b></li>
  </ul>
  After payment send Successfully you will recieve confirmation SMS on your Mobile With TID, Please enter that TID bellow and place your order.<br><br>
  Warning! Please must add this (<b><?php echo $row4['b_reference'];?></b>) mobile number while sendig payment as a receiver mobile number.
     </div>
  <div class="form-group" id="entertid">
    <input type="text" name="tid" id="tid" class="form-control inputfield" placeholder="Enter TID here.." required>
  </div>
  <div class="form-check" style="text-align:left;margin-left: 20px;">
  <input class="form-check-input largerCheckbox" type="checkbox" required id="defaultCheck1">
  <label class="form-check-label" for="defaultCheck1" style="margin-left: 20px; margin-top: 5px;font-size: 20px; font-weight: bold;">
    I agree to the <a href="termservices.php">Terms of Services</a>
  </label>
</div>
  <br>
    <input type="submit" class="btn submitbtn" name="placeorder" value="Place Order">
		</form>
	</div>
  </div>
  <script src="js/jquery.min.js"></script>
  <script type="text/javascript">

  $("#paymentmethod").on("change", function() { 
      var vatExpense = $("#paymentmethod option:selected").val();
      if (vatExpense == 'Jazzcash') {
        $("#platform").show();
        $("#entertid").show();
        $("#plt").html("Jazzcash");
        $('#tid').prop('required',true);
      }
      if (vatExpense == 'Easypaisa') {
        $("#platform").show();
        $("#entertid").show();
        $("#plt").html("Easypaisa");
         $('#tid').prop('required',true);
      }
       if (vatExpense == 'Stripe') {
         $("#platform").hide();
         $("#entertid").hide();
       document.form1.action = 'Stripe-Payment/stripe_form.php';
       $('#tid').prop('required',false);
      }
      if (vatExpense == '') {
        $("#platform").hide();
      }
  });

</script>
 <!-- End Container -->
<?php include 'includes/footer.php'; ?>
<script type="text/javascript">
	$(function() {
   $('.select2').select2();
});
</script>
</body>
</html>