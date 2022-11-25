<?php include_once ("includes/header.php");
      include_once ("includes/topbar.php");
      include_once ("includes/sidebar.php");
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">



    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Admin Profile</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Admin Profile</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <?php
      $sql = "SELECT * FROM admin WHERE id ='$adminid'";
      $result = $con->query($sql);
      $row = $result->fetch_assoc();
     ?>

    <div class="card">
      <div class="card-body">
        <div class="container">
          <div class="row">
            <div class="col-md-6">
              <strong>Admin Name:</strong>
              <span style="margin-left: 20px;"><?php echo $row['name']; ?></span><br><br>
              <strong>Email:</strong>
              <span style="margin-left: 70px;"><?php echo $row['email']; ?></span><br><br>
              <strong>Phone No:</strong>
              <span style="margin-left: 40px;"><?php echo $row['phone']; ?></span><br><br>
             <div class="text-center">
               <img class="circular--square" src="<?php echo $row['profile']; ?>" width="200px" height="200px" style="border-radius: 50%;">
             </div>
            </div>



    <?php 
       if(isset($_POST['profile'])){
            $name = $_POST['name'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $password = $_POST['password'];

            $filename = $_FILES['file']['name'] ;
            $tempname = $_FILES['file']['tmp_name'] ; 
            $filesize = $_FILES['file']['size'] ;
            $fileextension = explode('.', $filename) ;
            $fileextension = strtolower(end($fileextension));

            $newfilename = uniqid().'adminprofile'.'.'.$fileextension ;
            $path = "images/adminprofile/".$newfilename ;

            
            $query = mysqli_query($con," UPDATE admin SET name = '$name', email = '$email', phone = '$phone', password = '$password', profile = '$path' WHERE id ='$adminid'");


             if (move_uploaded_file($tempname, $path) && $query)  {
                    $_SESSION['status']="Update Profile Successfully!";
                    $_SESSION['btn_code']="success";
                    echo "<script>window.location.href='profile.php';</script>";
                    exit;
                    }
              else{
                  $_SESSION['status']="Error";
                  $_SESSION['btn_code']="error";
               }
           }  

      ?>


            <div class="col-md-6">
                <?php
                  $fetch = mysqli_query($con, "SELECT * FROM admin WHERE id ='$adminid'") ;
                  $res = mysqli_fetch_array($fetch) ;
                  $uname = $res['name'];
                  $uemail = $res['email'];
                  $uphone = $res['phone'];
                  $upass = $res['password'];
                  $image = $res['profile'];                    
                ?>
              <form method="post" action="" enctype='multipart/form-data'> 
                <div class="form-group">
                    <label for="exampleInputPassword1">Admin Name</label>
                    <input type="text" class="form-control" id="exampleInputPassword1" name="name" value="<?php echo $uname ?>" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Admin Email</label>
                    <input type="email" class="form-control" id="exampleInputPassword1" name="email" value="<?php echo $uemail ?>" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Phone No</label>
                    <input type="text" class="form-control" id="exampleInputPassword1" name="phone" value="<?php echo $uphone ?>" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" name="password" value="<?php echo $upass ?>" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Profile Image</label>
                    <input type="file" class="form-control" id="exampleInputPassword1" name="file" value="<?php echo $image ?>" required>
                </div>
            <button type="submit" class="btn btn-primary" name="profile">Submit</button>
        </form>
            </div>
          </div>
        </div>
      </div> 
    </div>


  </div>


<?php include_once ("includes/footer.php");?>

