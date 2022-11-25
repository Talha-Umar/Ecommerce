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
            <h1 class="m-0 text-dark">Description</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Description</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
         <?php
            if(isset($_POST['engupdate'])){
                $english = $_POST['engdesc'];
                $euid=$_POST['euid'];
                 $sql = mysqli_query ($con, "UPDATE `description` SET`desc_englisj`='$english' WHERE id='$euid'");

                
                if($sql){
                    $_SESSION['status']="Updated Successfully!";
                    $_SESSION['btn_code']="success";
                    echo "<script>window.location.href='description.php';</script>";exit;
                 }
               else {
                     $_SESSION['status']="Error";
                     $_SESSION['btn_code']="error";
                  }
                }

                if(isset($_POST['urupdate'])){
                $urdu = $_POST['urdesc'];
                $uuid=$_POST['uuid'];
                 $sql = mysqli_query ($con, "UPDATE `description` SET`desc_urdu`='$urdu' WHERE id='$uuid'");

                
                if($sql){
                    $_SESSION['status']="Updated Successfully!";
                    $_SESSION['btn_code']="success";
                    echo "<script>window.location.href='description.php';</script>";exit;
                 }
               else {
                     $_SESSION['status']="Error";
                     $_SESSION['btn_code']="error";
                  }
                }
          ?>

<div class="card">
              <div class="card-header">
                <h3 class="card-title">English Description</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <?php 

                $sql1 = "SELECT * FROM description";
               $result1 = $con->query($sql1);
               $row1 = $result1->fetch_assoc();

                ?>
                <form method="post">
                  <input type="hidden" name="euid" value="<?php echo $row1['id'];?>">
                  <div class="form-group">
                  <textarea id="summernote" name="engdesc" class="form-control" cols="100" rows="10"><?php echo $row1['desc_englisj'];?></textarea>
                  </div>
                  <div class="form-group text-center">
                  <input class="btn btn-primary" type="submit" name="engupdate" value="Update">
                  </div>
                </form>
              
              </div> 
   </div>

<div class="card" style="text-align:right; direction: rtl;">
              <div class="card-header">
                <h3 class="card-title">Urdu Description</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <?php 

                $sql2 = "SELECT * FROM description";
               $result2 = $con->query($sql2);
               $row2 = $result2->fetch_assoc();

                ?>
                <form method="post">
                  <input type="hidden" name="uuid" value="<?php echo $row2['id'];?>">
                  <div class="form-group">
                  <textarea id="summernote2" name="urdesc" class="form-control" cols="100" rows="10"><?php echo $row2['desc_urdu'];?></textarea>
                  </div>
                  <div class="form-group text-center">
                  <input class="btn btn-primary" type="submit" name="urupdate" value="Update">
                  </div>
                </form>
              
              </div> 
   </div>

   
</div>



<?php include_once ("includes/footer.php");?>

