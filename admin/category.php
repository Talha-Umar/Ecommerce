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
            <h1 class="m-0 text-dark">Categories</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Categories</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <?php
            if(isset($_POST['adcategory'])){
                $name = $_POST['name'];


                 $sql = mysqli_query ($con, "INSERT INTO `category`(`cate_name`) VALUES ('$name') ");

                
                if($sql){
                    $_SESSION['status']="Add Category Successfully!";
                    $_SESSION['btn_code']="success";
                    echo "<script>window.location.href='category.php';</script>";exit;
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
        <h5 class="modal-title" id="exampleModalLabel">Add Category</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="" enctype='multipart/form-data'> 
              <div class="form-group">
                  <label for="exampleInputPassword1">Category Name</label>
                  <input type="text" class="form-control" id="exampleInputPassword1" name="name" placeholder="Category Name" required>
              </div>
              <button type="submit" class="btn btn-primary" name="adcategory">Submit</button>
        </form>                          
      </div>
    </div>
  </div>
</div>



<!-- ///////////////////////////// update product/////////////// -->
      <?php
                // include("../db.php");
                if(isset($_POST['updatecategory'])){
                  $id =  $_POST['update_id'] ;  
                  $uname = $_POST['uname'];

                   $usql = "UPDATE `category`  SET cate_name='$uname ' WHERE id='$id'";
                   $query = mysqli_query($con,$usql);

                  if($query)
                    {
                    $_SESSION['status']="Update Category Successfully!";
                    $_SESSION['btn_code']="success";
                    echo "<script>window.location.href='category.php';</script>";
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
        <h5 class="modal-title" id="exampleModalLabel">Update Category</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="" enctype='multipart/form-data'> 
           <input type="hidden" name="update_id" id="update_id">
              <div class="form-group">
                  <label for="exampleInputPassword1">Category Name</label>
                  <input type="text" class="form-control" id="uname" name="uname" placeholder="Category Name" required>
              </div>
              <button type="submit" class="btn btn-primary" name="updatecategory">Submit</button>
        </form>                          
      </div>
    </div>
  </div>
</div>

    <div class="card">
              <div class="card-header">
                <h3 class="card-title">Category</h3>
                <a href="#" class="btn btn-success float-right" data-toggle="modal" data-target="#myModal">Add Category</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>#</th>
                    <th>Category Name</th>
                    <th>Action</th>
                  </tr>
                  </thead>

                  <tbody>
                  <?php
                     $k=0;       
                      $sql = mysqli_query($con, "SELECT * FROM `category`");
                            $result = mysqli_num_rows($sql);
                              if($result  > 0) {
                              while($row = mysqli_fetch_assoc($sql)) {
                        ?>
                  <tr>
                     <td style="display: none;"><?php echo $row['id']; ?></td>
                     <td><?php echo ++$k; ?></td>
                    <td><?php echo $row['cate_name']; ?></td>
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
          $('#uname').val(data[2]);

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
                    url:"delete/cate_delete.php",
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

