<?php 
include 'db.php';
date_default_timezone_set("Asia/Karachi");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home - Unique</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/topbar.css">
     <link rel="stylesheet" type="text/css" href="css/footer.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.15.0/css/all.css">
    <link href="css/bootstrap4-toggle.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/carousel.css">
</head>
<body>
<?php include 'includes/topbar.php'; ?>
<img class="img-fluid" src="admin/<?php echo $row10['banner'];?>"  alt="Banner">
 <div style=" background-image: linear-gradient(45deg, #8000ff, #ff00c4); width:100%;">    
<!-- Start Container -->
  <div class="container p-3"> 
    <section class="p-3">
    <h1 align="center">To Day Design List</h1>
         
         <div class="container-fluid" style="margin-top: 20px;">
                <div id="carousel-example" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner slider row w-100 mx-auto" role="listbox">
                    <?php 
                    $k=0;
                     $sql1 = "SELECT * FROM products WHERE add_date=CURDATE() AND status='1'";
                      $result1 = mysqli_query($con, $sql1);
                      if (mysqli_num_rows($result1) > 0) {
                      $sql = "SELECT * FROM products WHERE add_date=CURDATE() AND status='1'";
                      } else {
                      $sql = "SELECT * FROM products WHERE add_date<CURDATE() AND status='1'";
                      }
                      $result = mysqli_query($con, $sql);
                       while($row = mysqli_fetch_assoc($result)) {
                    ?>
                <div class="carousel-item col-12 col-sm-6 col-md-4 col-lg-3">
                    <div class="thumbnail">
                        <img src="admin/<?php echo $row['product_img']?>" class="img-thumbnail img-fluid rounded slideimg" alt="Lights">
                      <div class="caption">
                         <p><?php echo $row['product_code'];?></p>
                       </div>
                   </div>
                </div>
                      <?php }  ?>
                       
                        
                        
                        
                        
                    </div>
                    <a class="carousel-control-prev" href="#carousel-example" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carousel-example" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>  
       

    </section>
         
<section class="p-3">
<h1 align="center">NEXT COMING UPDATE!</h1>
<div class="countdown countdown-container container">
    <div class="clock row">
        <div class="clock-item clock-days countdown-time-value col-sm-6 col-md-3">
            <div class="wrap">
                <div class="inner">
                    <div id="canvas-days" class="clock-canvas"><div class="kineticjs-content" role="presentation"><canvas width="255" height="255" style="padding: 0px; margin: 0px; border: 0px; background: transparent; position: absolute; top: 0px; left: 0px; width: 255px; height: 255px;"></canvas></div></div>

                    <div class="text">
                        <p class="val">0</p>
                        <p class="type-days type-time">DAYS</p>
                    </div><!-- /.text -->
                </div><!-- /.inner -->
            </div><!-- /.wrap -->
        </div><!-- /.clock-item -->

        <div class="clock-item clock-hours countdown-time-value col-sm-6 col-md-3">
            <div class="wrap">
                <div class="inner">
                    <div id="canvas-hours" class="clock-canvas"><div class="kineticjs-content" role="presentation"><canvas width="255" height="255" style="padding: 0px; margin: 0px; border: 0px; background: transparent; position: absolute; top: 0px; left: 0px; width: 255px; height: 255px;"></canvas></div></div>

                    <div class="text">
                        <p class="val">0</p>
                        <p class="type-hours type-time">HOURS</p>
                    </div><!-- /.text -->
                </div><!-- /.inner -->
            </div><!-- /.wrap -->
        </div><!-- /.clock-item -->

        <div class="clock-item clock-minutes countdown-time-value col-sm-6 col-md-3">
            <div class="wrap">
                <div class="inner">
                    <div id="canvas-minutes" class="clock-canvas"><div class="kineticjs-content" role="presentation"><canvas width="255" height="255" style="padding: 0px; margin: 0px; border: 0px; background: transparent; position: absolute; top: 0px; left: 0px; width: 255px; height: 255px;"></canvas></div></div>

                    <div class="text">
                        <p class="val">0</p>
                        <p class="type-minutes type-time">MINUTES</p>
                    </div><!-- /.text -->
                </div><!-- /.inner -->
            </div><!-- /.wrap -->
        </div><!-- /.clock-item -->

        <div class="clock-item clock-seconds countdown-time-value col-sm-6 col-md-3">
            <div class="wrap">
                <div class="inner">
                    <div id="canvas-seconds" class="clock-canvas"><div class="kineticjs-content" role="presentation"><canvas width="255" height="255" style="padding: 0px; margin: 0px; border: 0px; background: transparent; position: absolute; top: 0px; left: 0px; width: 255px; height: 255px;"></canvas></div></div>

                    <div class="text">
                        <p class="val">0</p>
                        <p class="type-seconds type-time">SECONDS</p>
                    </div><!-- /.text -->
                </div><!-- /.inner -->
            </div><!-- /.wrap -->
        </div><!-- /.clock-item -->
    </div><!-- /.clock -->
</div>
</section>
<section class="p-3">
  <h1 align="center">Read Me!</h1>
  <!-- Material checked -->
<div class="switch text-center p-2">
  <input type="checkbox" style="font-weight:bold;" checked data-toggle="toggle" data-on="اردو" data-off="English" data-onstyle="success" data-offstyle="danger">
</div>
    <div class="row">
        <?php
        $sql2 = "SELECT * FROM description";
         $result2 = $con->query($sql2);
         $row2 = $result2->fetch_assoc();
         ?>
        <div class="col-md-12 readme text-right urdu" style="display:none;font-size:30px;">
            <?php echo $row2['desc_urdu'];?>
        </div>
        
        <div class="col-md-12 readme english" style="font-size:30px;">
            <?php echo $row2['desc_englisj'];?>
              
        </div>               
    </div>

    <script src="js/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
           $(".switch").click(function(){
                if($('.urdu').css('display') == 'none'){
                       $(".urdu").css("display", "block");
                       $(".english").css("display", "none");
                    }
                 else if($('.english').css('display') == 'none')
                   {
                       $(".urdu").css("display", "none");
                       $(".english").css("display", "block");
                    }
            });

       });
    </script>
</section>

</div>
<!-- close container -->
</div>
<?php 
$sql3 = "SELECT * FROM newupdate order by (id) DESC";
$result3 = mysqli_query($con, $sql3);
$row3 = mysqli_fetch_assoc($result3);

?>
<div style="display:none;" id="datetime"><?php echo $row3['update_date']; ?> <?php echo $row3['update_time']; ?></div>




<?php include 'includes/footer.php'; ?> 
<script type="text/javascript">  
    $('document').ready(function() {
        'use strict';
        var datetime=$("#datetime").html();
        const edt = new Date(datetime);
        const end= Date.parse(edt)/1000;
        //alert(datetime);
        
        const sdt = new Date("2022-01-01");
        const start= Date.parse(sdt)/1000;

        const ndt = new Date();
        const now= Date.parse(ndt)/1000;

        $('.countdown').final_countdown({
            'start': start,
            'end': end,
            'now': now       
        });

    });
</script>
<script>
   $(document).ready(function(){
   $('.carousel-inner .carousel-item:first').addClass('active');
});
</script>
<script src="js/jquery.backstretch.min.js"></script>
<script src="js/wow.min.js"></script>
<script src="js/scripts.js"></script>
</body>
</html>