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
            <h1 class="m-0 text-dark">Update Time</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Time</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->


<!-- Modal -->
    <?php
            if(isset($_POST['adtime'])){
                $date = $_POST['date'];
                $time = $_POST['time'];


                 $sql = mysqli_query ($con, "INSERT INTO `newupdate`(`update_date`, `update_time`) VALUES ('$date','$time') ");

                
                if($sql){
                    $_SESSION['status']="Time Successfully!";
                    $_SESSION['btn_code']="success";
                    echo "<script>window.location.href='utime.php';</script>";exit;
                 }
               else {
                     $_SESSION['status']="Error";
                     $_SESSION['btn_code']="error";
            }
                }
                ?>


<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Time</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="" enctype='multipart/form-data'> 
              <div class="form-group">
                  <label for="exampleInputPassword1">Date</label>
                  <input type="date" class="form-control" id="exampleInputPassword1" name="date" placeholder="Date" required>
              </div>
              <div class="form-group">
                  <label for="exampleInputPassword1">Time</label>
                  <input type="time" class="form-control" id="exampleInputPassword1" name="time" placeholder="Time" required>
              </div>
              <button type="submit" class="btn btn-primary" name="adtime">Submit</button>
        </form>                          
      </div>
    </div>
  </div>
</div>



<!-- ///////////////////////////// update product/////////////// -->
      <?php
                // include("../db.php");
                if(isset($_POST['updatetime'])){
                  $id =  $_POST['update_id'] ;  
                  $udate = $_POST['udate'];
                  $utime = $_POST['utime'];

                  $usql = "UPDATE `newupdate`  SET update_date='$udate',
                  update_time='$utime' WHERE id='$id'";
                   $query = mysqli_query($con,$usql);

                  if($query)
                    {
                    $_SESSION['status']="Update Successfully!";
                    $_SESSION['btn_code']="success";
                    echo "<script>window.location.href='utime.php';</script>";
                    exit;
                    }
                    else{
                      $_SESSION['status']="Error";
                      $_SESSION['btn_code']="error";
                    }
                  }
                ?>
<div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update Time</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="" enctype='multipart/form-data'> 
          <input type="hidden" name="update_id" id="update_id">
              <div class="form-group">
                  <label for="exampleInputPassword1">Update Date</label>
                  <input type="date" class="form-control" id="udate" name="udate" placeholder="Date" required>
              </div>
              <div class="form-group">
                  <label for="exampleInputPassword1">Update Time</label>
                  <input type="time" class="form-control" id="utime" name="utime" placeholder="Time" required>
              </div>
              <button type="submit" class="btn btn-primary" name="updatetime">Submit</button>
        </form>                          
      </div>
    </div>
  </div>
</div>

    <div class="card">
              <div class="card-header">
                <h3 class="card-title">Upcoming Update Time</h3>
                <!-- <a href="#" class="btn btn-success float-right" data-toggle="modal" data-target="#myModal">Add Time</a> -->
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>#</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php
                     $k=0;       
                      $sql = mysqli_query($con, "SELECT * FROM `newupdate`");
                            $result = mysqli_num_rows($sql);
                              if($result  > 0) {
                              while($row = mysqli_fetch_assoc($sql)) {
                    ?>
                  <tr>
                    <td style="display: none;"><?php echo $row['id']; ?></td>
                    <td><?php echo ++$k; ?></td>
                    <td><?php echo $row['update_date']; ?></td>
                    <td><?php echo $row['update_time']; ?></td>
                    <td>
                      <i class="fas fa-edit editbtn" style="font-size: 25px;color: green;"></i>
                      <a href="javascript:void(0)" data-id="<?php echo $row['id']; ?>" class="delete_btn">
                          <i class="fas fa-trash" style="font-size: 25px;color: red;"></i>
                      </a>
                      
                    </td>
                  </tr>
                  <?php }} ?>
            </tbody>
          </table>
    </div> 
   </div>
</div>


<script>
      $(document).ready(function(){
        $('.editbtn').on('click',function(){
          $('#editmodal').modal('show');

          $tr = $(this).closest('tr');
          var data = $tr.children("td").map(function(){
            return $(this).text();
          }).get();
          
          console.log(data);
           
          $('#update_id').val(data[0]);
          $('#udate').val(data[2]);
          $('#utime').val(data[3]);

        })
        

      })
    </script>
<script>
   $(document).ready(function(){
     $('.delete_btn').click(function(e){
           e.preventDefault();
           var did=$(this).data('id');
           swal({
              title: "Are you sure?",
              text: "Once deleted, you will not be able to recover this Record!",
              icon: "warning",
              buttons: true,
              dangerMode: true,
            })
           .then((willDelete) => {
                  if (willDelete) {
                   $.ajax({
                    type:"POST",
                    url:"delete/time_delete.php",
                    data:{
                      "deleteid":did,
                      "delete_btn":1,
                    },
                    dataType:"html",
                    success:function(response){
                    location.reload();
                    }
                   });
                  } 
                });
     });
   });
 </script>



<?php include_once ("includes/footer.php");?>

