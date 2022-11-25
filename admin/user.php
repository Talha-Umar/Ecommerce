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
            <h1 class="m-0 text-dark">Users</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Users</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->



            

     

      <div class="card">
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>#</th>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Phone No</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php
                     $k=0;       
                      $sql = mysqli_query($con, "SELECT * FROM `users`");
                            $result = mysqli_num_rows($sql);
                              if($result  > 0) {
                              while($row = mysqli_fetch_assoc($sql)) {
                    ?>
                  <tr>
                    <td><?php echo ++$k;?></td>
                    <td><?php echo $row['fullname']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['phone']; ?></td>
                    <td><?php 
                    if ($row['status']=='1') {
                     echo "<span style='color:green;'> Verified </span>";
                    }
                    if ($row['status']=='0') {
                     echo "<span style='color:red;'> Unverified </span>";
                    }
                     ?></td>
                    <td> ...
                     <!--  <a href="javascript:void(0)" data-id="<?php echo $row['id']; ?>" class="delete_btn">
                          <i class="fas fa-trash" style="font-size: 25px;color: red;"></i>
                      </a> -->
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
                    url:"delete/user_delete.php",
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

