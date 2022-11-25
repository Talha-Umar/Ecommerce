<?php include_once ("includes/header.php");
      include_once ("includes/topbar.php");
      include_once ("includes/sidebar.php");

       if (isset($_POST['status'])) {
        $status=$_POST['status'];
        $orderid=$_POST['orderid'];
         $sql4 = mysqli_query($con,"UPDATE orders SET status='$status' WHERE id='$orderid'");
            if ($sql4)  {
               $_SESSION['status']="Status Updated Successfully!";
               $_SESSION['btn_code']="success";
             echo "<script>window.location.href='order.php';</script>";
             exit;
             } else {
              $_SESSION['status']="Error";
              $_SESSION['btn_code']="error";
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
            <h1 class="m-0 text-dark">Today Order</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Today Order</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->


    <div class="card">
              <div class="card-body">
                <table id="example2" class="table table-bordered table-striped">
                  <thead>
                 <tr>
                       <th>#</th>
                       <th>User</th>
                       <th>Design</th>
                       <th>Price</th>
                       <th>Payment Method</th>
                       <th>TID</th>
                       <th>Status</th>
                       <th>Date</th>
                  </tr>
                  </thead>

                  <tbody>
                     <?php
                    $k=0;
                    $sql2 = "SELECT * FROM orders WHERE order_date=CURDATE()";
                     $result2 = mysqli_query($con, $sql2);
                     if (mysqli_num_rows($result2) > 0) {
                      while($row2 = mysqli_fetch_assoc($result2)) {

                     ?>
                   <tr>
                    <td><?php echo $row2['id'];?></td>
                    <td><?php 
                    $uuid=$row2['user_id'];
                    $sql5 = "SELECT * FROM users WHERE id='$uuid'";
                       $result5 = mysqli_query($con, $sql5);
                       $row5 = mysqli_fetch_assoc($result5);
                       echo $row5['fullname'];
                  ?></td>
                     <td><?php
                       $ppid=$row2['product_id'];
                       $sql3 = "SELECT * FROM products WHERE id='$ppid'";
                       $result3 = mysqli_query($con, $sql3);
                       $row3 = mysqli_fetch_assoc($result3);
                       echo $row3['product_code'];
                      ?></td>
                    <td><?php echo $row2['Paid_amount'];?></td>
                    <td><?php echo $row2['Method'];?></td>
                    <td><?php echo $row2['TID'];?></td>
                    <td><?php 
                        if ($row2['status']=='0') {
                      ?>
                      <form method="post" id="form">
                        <input type="hidden" name="orderid" value="<?php echo $row2['id'];?>">
                        <select class="form-control" name="status" onchange="document.getElementById('form').submit();">
                          <option value="0">Pending</option>
                          <option value="1">Complete</option>
                        </select>
                      </form>
                    <?php } else
                        if ($row2['status']=='1') {
                           echo '<span class="badge badge-pill badge-success">Completed</span>';
                        }

                     ?>
                    </td>
                    <td><?php echo $row2['order_date'];?></td>
                      
                  </tr>
                  <?php } } else {?>
                <th colspan="8">No order placed yet..</th>
            <?php } ?>
            </tbody>
          </table>
    </div> 
   </div>
</div>


<?php include_once ("includes/footer.php");?>

