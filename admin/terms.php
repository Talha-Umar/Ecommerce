<?php include_once ("includes/header.php");
      include_once ("includes/topbar.php");
      include_once ("includes/sidebar.php");
if (isset($_POST['update'])) {
  $uid=$_POST['uid'];
  $terms=$_POST['terms'];
 $sql = "UPDATE social_links SET terms='$terms' WHERE id='$uid'";

if (mysqli_query($con, $sql)) {
  $_SESSION['status']="Update Successfully!";
  $_SESSION['btn_code']="success";
  echo "<script type='text/javascript'>location.replace('terms.php')</script>";
  exit;
}
}
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">



    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Terms & Services</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Terms & Services</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <div class="card">
              <div class="card-header">
                <h3 class="card-title">Terms & Services</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <?php 

                $sql1 = "SELECT * FROM social_links";
               $result1 = $con->query($sql1);
               $row1 = $result1->fetch_assoc();

                ?>
                <form method="post">
                  <input type="hidden" name="uid" value="<?php echo $row1['id'];?>">
                  <div class="form-group">
                  <textarea id="summernote" name="terms" class="form-control" cols="100" rows="10"><?php echo $row1['terms'];?></textarea>
                  </div>
                  <div class="form-group text-center">
                  <input class="btn btn-primary" type="submit" name="update" value="Update">
                  </div>
                </form>
              
              </div> 
   </div>
</div>



<?php include_once ("includes/footer.php");?>

