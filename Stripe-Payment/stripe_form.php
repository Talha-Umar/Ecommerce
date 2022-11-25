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
    if(isset($_POST['placeorder'])){
        $productId = $_POST['product'];
    } else {
        $productId = '';
    }
    $SQL_getPr = "SELECT * FROM `products` WHERE `id`='$productId'";
    $res_getPr = mysqli_query($con,$SQL_getPr) or die("MySql Query Error".mysqli_error($con));
    $row_getPr = mysqli_fetch_assoc($res_getPr);
    $price = $row_getPr['product_price'];
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
                        <div class="card" style="width: 50%;margin: auto;">
                            <h2 style="text-align: center; color: blue;">Payment Details</h2>
                          <div class="card-body">
                           <span>&nbsp;&nbsp;<b>Product Name:</b> <?php echo $row_getPr['product_code'];?></span><br>
                          <span>&nbsp;&nbsp;<b>Product Price:</b> <?php echo $row_getPr['product_price'];?>PKR</span> 
<hr>
                                <!-- Payment form -->
                                <form role="form" action="stripe_payment.php" method="POST" name="cardpayment" id="payment-form"  style="width: 100%!important;">

                                    <input type="hidden" name="productId" value="<?php echo $productId;?>"/>
                                   
                                <?php
                        $sql = "SELECT * FROM users WHERE id='$userid'";
                        $result = mysqli_query($con, $sql);
                        $row = mysqli_fetch_assoc($result);

                                 ?>
                                            <div class="form-group">
                                                <label for="couponCode">USER NAME</label>
                                                <input type="text" class="form-control" value="<?php echo $row['fullname']; ?>" name="holdername" id="name" style="margin-top:0 !important; text-align: left !important;" />
                                            </div>
                                            <div class="form-group">
                                                <label for="couponCode">EMAIL</label>
                                                <input type="email" class="form-control" name="email" value="<?php echo $row['email']; ?>" id="email" />
                                            </div>
                                            <div class="form-group">
                                                <label for="cardNumber">CARD NUMBER</label>
                                                <div class="input-group">

                                                    <input type="text" class="form-control" name="card_number" placeholder="Valid Card Number" autocomplete="cc-number" id="card_number" maxlength="16" data-stripe="number" required />
                                                </div>
                                            </div>
                                    <div class="row">

                                        <div class="col-xs-4 col-md-4">
                                            <div class="form-group">
                                                <label for="cardExpiry"><span class="visible-xs-inline">MON</span></label>
                                                <select name="card_exp_month" id="card_exp_month" class="form-control" data-stripe="exp_month" required>
                                                    <option>MON</option>
                                                    <option value="01">01 ( JAN )</option>
                                                    <option value="02">02 ( FEB )</option>
                                                    <option value="03">03 ( MAR )</option>
                                                    <option value="04">04 ( APR )</option>
                                                    <option value="05">05 ( MAY )</option>
                                                    <option value="06">06 ( JUN )</option>
                                                    <option value="07">07 ( JUL )</option>
                                                    <option value="08">08 ( AUG )</option>
                                                    <option value="09">09 ( SEP )</option>
                                                    <option value="10">10 ( OCT )</option>
                                                    <option value="11">11 ( NOV )</option>
                                                    <option value="12">12 ( DEC )</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-xs-4 col-md-4">
                                            <div class="form-group">
                                                <label for="cardExpiry"><span class="visible-xs-inline">YEAR</span></label>
                                                <select name="card_exp_year" id="card_exp_year" class="form-control" data-stripe="exp_year">
                                                    <option>Year</option>
                                    
                                                    <option value="21">2021</option>
                                                    <option value="22">2022</option>
                                                    <option value="23">2023</option>
                                                    <option value="24">2024</option>
                                                    <option value="25">2025</option>
                                                    <option value="26">2026</option>
                                                    <option value="27">2027</option>
                                                    <option value="28">2028</option>
                                                    <option value="29">2029</option>
                                                    <option value="30">2030</option>
                                                    <option value="31">2031</option>
                                                    <option value="32">2032</option>
                                                    <option value="33">2033</option>
                                                    <option value="34">2034</option>
                                                    <option value="35">2035</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-xs-4 col-md-4 pull-right">
                                            <div class="form-group">
                                                <label for="cardCVC">CV CODE</label>
                                                <input type="password" class="form-control" name="card_cvc" placeholder="CVC" autocomplete="cc-csc" id="card_cvc" required />
                                            </div>
                                        </div>
                                    </div>
                                            <button class="subscribe btn btn-success btn-lg btn-block submit" type="submit" id="payBtn">PAY NOW ( PKR: <?php echo $price;?> rs )</button>
                                </form>
                            </div>
                        </div>      
                          </div>
                        </div>


                              
                       
                
                    </div>

            </div>
   
<!-- Stripe JavaScript library -->
    <script src="https://js.stripe.com/v2/"></script>
    <script src="js/jquery.min.js"></script>
    <script>
        // Set your publishable key
        Stripe.setPublishableKey('pk_test_51KAUTxBZyq1XOWbv8r31Xx3ufV3dvsNGS0VSATxcAbSKTUmF0Fec5A1kO5fcZ5kN8bZmybzD508TU7ARbIy5TzcD00Q1uki7lw');

        /*$(function() {
            var $form = $('#payment-form');
            $form.submit(function(event) {
                // Disable the submit button to prevent repeated clicks:
                $form.find('.submit').prop('disabled', true);
                // Request a token from Stripe:
                Stripe.card.createToken($form, stripeResponseHandler);
                // Prevent the form from being submitted:
                return false;
            });
        });

        function stripeResponseHandler(status, response) {
            // Grab the form:
            var $form = $('#payment-form');

            if (response.error) { // Problem!
                // Show the errors on the form:
                $form.find('.payment-status').text(response.error.message);
                $form.find('.submit').prop('disabled', false); // Re-enable submission
            } else { // Token was created!
                // Get the token ID:
                var token = response.id;
                // Insert the token ID into the form so it gets submitted to the server:
                $form.append($('<input type="hidden" name="stripeToken">').val(token));
                // Submit the form:
                $form.get(0).submit();
            }
        };*/

        // Callback to handle the response from stripe
        function stripeResponseHandler(status, response) {
            if (response.error) {
                // Enable the submit button
                $('#payBtn').removeAttr("disabled");
                // Display the errors on the form
                $(".payment-status").html('<p>'+response.error.message+'</p>');
            } else {
                var form$ = $("#payment-form");
                // Get token id
                var token = response.id;
                // Insert the token into the form
                form$.append("<input type='hidden' name='stripeToken' value='" + token + "' />");
                // Submit form to the server
                form$.get(0).submit();
            }
        }

        $(document).ready(function() {
            // On form submit
            $("#payment-form").submit(function() {
                // Disable the submit button to prevent repeated clicks
                $('#payBtn').attr("disabled", "disabled");
                
                // Create single-use token to charge the user
                Stripe.createToken({
                    number: $('#card_number').val(),
                    exp_month: $('#card_exp_month').val(),
                    exp_year: $('#card_exp_year').val(),
                    cvc: $('#card_cvc').val()
                }, stripeResponseHandler);
                
                // Submit from callback
                return false;
            });
        });
</script>


 <?php include '../includes/footer.php'; ?>
</body>
</html>