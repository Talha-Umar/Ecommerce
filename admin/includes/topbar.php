 <?php 
    include'../db.php';
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
if(!isset($_SESSION["admin_id"])){
     echo "<script type='text/javascript'>location.replace('index.php')</script>";
   }
   $adminid=$_SESSION["admin_id"];
  ?>
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      
    </ul>

    
  </nav>
  <!-- /.navbar -->