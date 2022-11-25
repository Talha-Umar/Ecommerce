<?php 
if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
    date_default_timezone_set("Asia/Karachi");
 ?>
 <?php
      $sql10 = "SELECT * FROM social_links";
      $result10 = mysqli_query($con, $sql10);
      $row10= mysqli_fetch_assoc($result10);
   ?>
<nav id="nav" class="navbar navbar-expand-lg navbar-light sticky-top">
  <a class="navbar-brand" href="index.php">UNIQUE</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        
        <a class="nav-link menucirle" href="index.php"> 
          <div class="menuicon"> 
            <i class="fas fa-home "></i>
          </div> 
          <span class="menutext">Home</span>
        </a>
        
      </li>

      <li class="nav-item">
        
        <a class="nav-link menucirle" href="store.php"> 
          <div class="menuicon"> 
           <i class="fas fa-store"></i>
          </div> 
          <span class="menutext">Shop</span>
        </a>
        
      </li>
      <li class="nav-item">
        
        <a class="nav-link menucirle" href="order.php"> 
          <div class="menuicon"> 
            <i class="fas fa-shopping-cart"></i>
          </div> 
          <span class="menutext">Buy</span>
        </a>
        
      </li>
<?php if(isset($_SESSION["user_id"])){ ?>
       <li class="nav-item">
        <a class="nav-link menucirle" href="profile.php"> 
          <div class="menuicon"> 
            <i class="fas fa-user"></i>
          </div> 
          <span class="menutext">Profile</span>
        </a> 
      </li>

      <li class="nav-item">
        <a class="nav-link menucirle" href="logout.php"> 
          <div class="menuicon"> 
           <i class="fas fa-sign-out-alt"></i>
          </div> 
          <span class="menutext">Logout</span>
        </a> 
      </li>
<?php } else { ?>
      <li class="nav-item">
        <a class="nav-link menucirle" href="login.php"> 
          <div class="menuicon"> 
           <i class="fas fa-sign-in-alt"></i>
          </div> 
          <span class="menutext">Login</span>
        </a> 
      </li>

      <li class="nav-item">
        <a class="nav-link menucirle" href="signup.php"> 
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