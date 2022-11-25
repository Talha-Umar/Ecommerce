<?php 

include "../db.php";

$cid = $_POST['cid'];   // department id

$sql = "SELECT * FROM products WHERE id='$cid'";

$result = mysqli_query($con,$sql);
$row = mysqli_fetch_array($result);
    $price = $row['product_price'];

// encoding array to json format
echo $price;