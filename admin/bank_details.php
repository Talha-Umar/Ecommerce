<?php include_once ("includes/header.php");
      include_once ("includes/topbar.php");
      include_once ("includes/sidebar.php");
if (isset($_POST['update'])) {
  $uid=$_POST['uid'];
  $name=$_POST['name'];
  $title=$_POST['title'];
  $account=$_POST['account'];
  $reference=$_POST['reference'];

 $sql = "UPDATE bank_detail SET b_name='$name', b_title='$title', b_account='$account', b_reference='$reference' WHERE id='$uid'";

if (mysqli_query($con, $sql)) {
  $_SESSION['status']="Update Successfully!";
  $_SESSION['btn_code']="success";
  echo "<script type='text/javascript'>location.replace('bank_details.php')</script>";
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
            <h1 class="m-0 text-dark">Bank Details</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Bank Details</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <div class="card">
              <div class="card-header">
                <h3 class="card-title">Bank Details</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <?php 

                $sql1 = "SELECT * FROM bank_detail";
               $result1 = $con->query($sql1);
               $row1 = $result1->fetch_assoc();

                ?>
                <form method="post" style="width: 50%; margin: auto;">
                  <input type="hidden" name="uid" value="<?php echo $row1['id'];?>">
                  <div class="form-group">
                    <label>Bank Name:</label>
                    <input type="text" name="name" value="<?php echo $row1['b_name']; ?>" class="form-control" required>
                  </div>
                  <div class="form-group">
                    <label>Bank Account Title:</label>
                    <input type="text" name="title" value="<?php echo $row1['b_title']; ?>" class="form-control" required>
                  </div>
                  <div class="form-group">
                    <label>Bank Account Number:</label>
                    <input type="text" name="account" value="<?php echo $row1['b_account']; ?>" class="form-control" required>
                  </div>
                  <div class="form-group">
                    <label>Reference Mobile Number:</label>
                    <input type="text" name="reference" value="<?php echo $row1['b_reference']; ?>" class="form-control" required>
                  </div>
                  <div class="form-group text-center">
                  <input class="btn btn-primary" type="submit" name="update" value="Update">
                  </div>
                </form>
              
              </div> 
   </div>
</div>



<?php include_once ("includes/footer.php");?>

