<?php 
if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
if(!isset($_SESSION["user_id"])){
     echo "<script type='text/javascript'>location.replace('../login.php')</script>";
    
}
$userid=$_SESSION["user_id"]; 
 ?>
<?php 
    include "../db.php";
date_default_timezone_set("Asia/Karachi");
	/*print "<pre>";
	print_r($_POST);
	var_dump($_POST);
	die;*/
	// get Current Date and Time
    function getCurrentDate(){  
        $date = date("Y-m-d");
        return $date;
    }
    function getCurrentTime(){
        $time = date("H:i:s");
        return $time;
    }

	$payment_id = $statusMsg = ''; 
	$ordStatus = 'error';
	$id = '';

	// Check whether stripe token is not empty

	if(!empty($_POST['stripeToken'])){

		// Get Token, Card and User Info from Form
		$token = $_POST['stripeToken'];
		$name = $_POST['holdername'];
		$email = $_POST['email'];
		$card_no = $_POST['card_number'];
		$card_cvc = $_POST['card_cvc'];
		$card_exp_month = $_POST['card_exp_month'];
		$card_exp_year = $_POST['card_exp_year'];
		$dt = getCurrentDate();
        $tm = getCurrentTime();

		// Get Product ID From - Form
		$productId = $_POST['productId'];

		// Get Product Details By Using Product-Id
		$SQL_getPr = "SELECT * FROM `products` WHERE `id`='$productId'";
	    $res_getPr = mysqli_query($con,$SQL_getPr) or die("MySql Query Error".mysqli_error($con));
	    $row_getPr = mysqli_fetch_assoc($res_getPr);
	    $price = $row_getPr['product_price']*100;
	    $pr_desc = $row_getPr['product_code'];

		// Include STRIPE PHP Library
		require_once('stripe-php/init.php');

		// set API Key
		$stripe = array(
		"SecretKey"=>"sk_test_51KAUTxBZyq1XOWbvfo6RRE0BMfkdGr3JODgbOm54tqHPw5dHfxZwUEOmVXN2vPbpdH9Wj88eyrXIUqlw4DEe74AT00Dro6Dwm7",
		"PublishableKey"=>"pk_test_51KAUTxBZyq1XOWbv8r31Xx3ufV3dvsNGS0VSATxcAbSKTUmF0Fec5A1kO5fcZ5kN8bZmybzD508TU7ARbIy5TzcD00Q1uki7lw"
		);

		// Set your secret key: remember to change this to your live secret key in production
		// See your keys here: https://dashboard.stripe.com/account/apikeys
		\Stripe\Stripe::setApiKey($stripe['SecretKey']);

		// Add customer to stripe 
	    $customer = \Stripe\Customer::create(array( 
	        'email' => $email, 
	        'source'  => $token,
	        'name' => $name,
	        'description'=>$pr_desc
	    ));

	    // Generate Unique order ID 
	    $orderID = strtoupper(str_replace('.','',uniqid('', true)));
	     
	    // Convert price to cents 
	    $itemPrice = ($price);
	    $currency = "PKR";
	    $itemName = $row_getPr['product_code'];

	    // Charge a credit or a debit card 
	    $charge = \Stripe\Charge::create(array( 
	        'customer' => $customer->id, 
	        'amount'   => $itemPrice, 
	        'currency' => $currency, 
	        'description' => $itemName, 
	        'metadata' => array( 
	            'order_id' => $orderID 
	        ) 
	    ));

	    // Retrieve charge details 
    	$chargeJson = $charge->jsonSerialize();

    	// Check whether the charge is successful 
    	if($chargeJson['amount_refunded'] == 0 && empty($chargeJson['failure_code']) && $chargeJson['paid'] == 1 && $chargeJson['captured'] == 1){ 

	        // Order details 
	        $transactionID = $chargeJson['balance_transaction']; 
	        $paidAmount = $chargeJson['amount']/100; 
	        $paidCurrency = $chargeJson['currency']; 
	        $payment_status = $chargeJson['status'];
	        $payment_date = date("Y-m-d");
	        $dt_tm = date('Y-m-d H:i:s');

	        // Insert tansaction data into the database

	        $sql = "INSERT INTO `payments`(`user_id`, `product_id`, `method`, `card_number`, `card_exp_month`, `card_exp_year`, `currency`, `amount`, `txn_id`, `status`, `date`, `time`) VALUES ('$userid','$productId','Stripe','$card_no','$card_exp_month','$card_exp_year','$paidCurrency','$paidAmount','$transactionID','$payment_status','$dt','$tm')";
	        mysqli_query($con,$sql) or die("Mysql Error".mysqli_error($con));
 

 

    		//Get Last Id
    		$sql_g = "SELECT * FROM `payments`";
    		$res_g = mysqli_query($con,$sql_g) or die("Mysql Error Stripe-Charge(SQL2)".mysqli_error($con));
    		$row_g=mysqli_fetch_assoc($res_g);
    			$id = $row_g['id'];
    			$sql10="INSERT INTO `orders`(`pid`,`product_id`, `user_id`,  `order_date`, `Method`, `TID`, `Paid_amount`) VALUES('$id','$productId','$userid','$payment_date','Stripe','$transactionID','$paidAmount')";
          if (mysqli_query($con, $sql10)) {
  
} else {
  echo "Error: " . $sql10 . "<br>" . mysqli_error($con);
}
    		

	        // If the order is successful 
	        if($payment_status == 'succeeded'){ 
	            $ordStatus = 'success'; 
	            $statusMsg = 'Your Payment has been Successful!'; 
	    	} else{ 
	            $statusMsg = "Your Payment has Failed!"; 
	        } 
	    } else{ 
	        //print '<pre>';print_r($chargeJson); 
	        $statusMsg = "Transaction has been failed!"; 
	    } 
	} else{ 
	    $statusMsg = "Error on form submission."; 
	} 
	
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>HTML CSS Responsive Website</title>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="stylesheet" type="text/css" href="../css/topbar.css">
     <link rel="stylesheet" type="text/css" href="../css/footer.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.15.0/css/all.css">
</head>
<body>

     <nav id="nav" class="navbar navbar-expand-lg navbar-light sticky-top">
  <a class="navbar-brand" href="../index.php">UNIQUE</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        
        <a class="nav-link menucirle" href="../index.php"> 
          <div class="menuicon"> 
            <i class="fas fa-home "></i>
          </div> 
          <span class="menutext">Home</span>
        </a>
        
      </li>

      <li class="nav-item">
        
        <a class="nav-link menucirle" href="../store.php"> 
          <div class="menuicon"> 
           <i class="fas fa-store"></i>
          </div> 
          <span class="menutext">Shop</span>
        </a>
        
      </li>
      <li class="nav-item">
        
        <a class="nav-link menucirle" href="../order.php"> 
          <div class="menuicon"> 
            <i class="fas fa-shopping-cart"></i>
          </div> 
          <span class="menutext">Buy</span>
        </a>
        
      </li>
<?php if(isset($_SESSION["user_id"])){ ?>
       <li class="nav-item">
        <a class="nav-link menucirle" href="../profile.php"> 
          <div class="menuicon"> 
            <i class="fas fa-user"></i>
          </div> 
          <span class="menutext">Profile</span>
        </a> 
      </li>

      <li class="nav-item">
        <a class="nav-link menucirle" href="../logout.php"> 
          <div class="menuicon"> 
           <i class="fas fa-sign-out-alt"></i>
          </div> 
          <span class="menutext">Logout</span>
        </a> 
      </li>
<?php } else { ?>
      <li class="nav-item">
        <a class="nav-link menucirle" href="../login.php"> 
          <div class="menuicon"> 
           <i class="fas fa-sign-in-alt"></i>
          </div> 
          <span class="menutext">Login</span>
        </a> 
      </li>

      <li class="nav-item">
        <a class="nav-link menucirle" href="../signup.php"> 
          <div class="menuicon"> 
           <i class="fas fa-user-plus"></i>
          </div> 
          <span class="menutext">Signup</span>
        </a> 
      </li>
    <?php } ?>
      
     
      
    </ul>
  </div>
</nav>

	<div style=" background-image: linear-gradient(45deg, #8000ff, #ff00c4); width:100%;  padding-top: 30px;padding-bottom: 30px;"> 

	    	<div class="container">
	    		<div class="row">
	    			<div class="col-md-12">
	    				<div class="card"style="width: 50%;margin: auto;">
						  <div class="card-body">
						   <div class="status">
							<h1 class="<?php echo $ordStatus; ?> text-center" style="color: green"><?php echo $statusMsg; ?></h1>
						     <br>
							<h4 class="heading">Payment Information</h4>
							<p><b>Reference ID:</b> <strong><?php echo $id; ?></strong></p>
							<p><b>Transaction ID:</b> <?php echo $transactionID; ?></p>
							<p><b>Paid Amount:</b> <?php echo $paidAmount.' '.$paidCurrency; ?></p>
							<p><b>Payment Status:</b> <?php echo $payment_status; ?></p>
							<br>
							<h4 class="heading">Product Information</h4>
							
							<p><b>Name:</b> <?php echo $itemName; ?></p>
							<p><b>Price:</b> <?php echo $paidAmount.' '.$currency; ?></p>
						</div>

            <div class="text-center">
              <a href="../profile.php" class="btn btn-primary mt-5">Back to Profile</a>
            </div>
						  </div>
						</div>
	    			</div>
	    		</div>
	    	</div>
</div>
		 


<?php include '../includes/footer.php'; ?>
</body>
</html>