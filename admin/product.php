<?php include_once ("includes/header.php");
      include_once ("includes/topbar.php");
      include_once ("includes/sidebar.php");
      date_default_timezone_set("Asia/Karachi");
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">



    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Products</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Products</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <?php
            if(isset($_POST['adproduct'])){
                $filename = $_FILES['file']['name'] ;
                $tempname = $_FILES['file']['tmp_name'] ; 
                $filesize = $_FILES['file']['size'] ;
                $fileextension = explode('.', $filename) ;
                $fileextension = strtolower(end($fileextension));

                $newfilename = uniqid().'images'.'.'.$fileextension ;
                $path = "images/products/".$newfilename ;
                $name = $_POST['name'];
                $code = $_POST['code'];
                $price = $_POST['price'];


                 $sql = mysqli_query ($con, "INSERT INTO `products`(`cate_id`, `product_code`, `product_price`, `product_img`, `add_date`) VALUES ('$name','$code','$price','$path',CURDATE()) ");

                
                if(move_uploaded_file($tempname, $path) && $sql){
                    $_SESSION['status']="Register Successfully!";
                    $_SESSION['btn_code']="success";
                    echo "<script>window.location.href='product.php';</script>";exit;
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
        <h5 class="modal-title" id="exampleModalLabel">Add Products</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="" enctype='multipart/form-data'>
               <div class="form-group"> 
                <label for="exampleInputPassword1">Category Select</label>
                <select name="name" class="form-control" required>
                  <option value="">Select Category</option>
                    <?php       
                      $sql1 = mysqli_query($con, "SELECT * FROM `category`");
                            $result1 = mysqli_num_rows($sql1);
                              if($result1  > 0) {
                              while($row1 = mysqli_fetch_assoc($sql1)) {
                    ?>
                  <option value="<?php echo $row1['id']; ?>"><?php echo $row1['cate_name']; ?></option>
                <?php } } ?>
                </select>
               </div>
              <div class="form-group">
                  <label for="exampleInputPassword1">Product Code</label>
                  <input type="text" class="form-control" id="exampleInputPassword1" name="code" placeholder="Product Code" required>
              </div>
              <div class="form-group">
                  <label for="exampleInputPassword1">Product Price</label>
                  <input type="text" class="form-control" id="exampleInputPassword1" name="price" placeholder="Product Price" required>
              </div>
              <div class="form-group">
                  <label for="exampleInputPassword1">Product Image</label>
                  <input type="file" class="form-control" id="exampleInputPassword1" name="file" required>
              </div>
              <button type="submit" class="btn btn-primary" name="adproduct">Submit</button>
        </form>                          
      </div>
    </div>
  </div>
</div>



<!-- ///////////////////////////// update product/////////////// -->
      <?php
                // include("../db.php");
                if(isset($_POST['updateproduct'])){
                  $id =  $_POST['update_id'] ;
                  $filename1 = $_FILES['file']['name'] ;
                  $tempname1 = $_FILES['file']['tmp_name'] ; 
                  $filesize1 = $_FILES['file']['size'] ;
                  $fileextension1 = explode('.', $filename1) ;
                  $fileextension1 = strtolower(end($fileextension1));

                  $newfilename1 = uniqid().'images'.'.'.$fileextension1 ;
                  $path1 = "images/products/".$newfilename1 ; 

                  $uname = $_POST['uname'];
                  $ucode = $_POST['ucode'];
                  $uprice = $_POST['uprice'];

                   $usql = "UPDATE `products`  SET cate_id='$uname ', product_code='$ucode',product_price='$uprice' ,product_img='$path1' WHERE id='$id'";
                   $query = mysqli_query($con,$usql);
                   
                  if (move_uploaded_file($tempname1, $path1) && $query)
                    {
                    $_SESSION['status']="Update Successfully!";
                    $_SESSION['btn_code']="success";
                    echo "<script>window.location.href='product.php';</script>";
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
        <h5 class="modal-title" id="exampleModalLabel">Update Products</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="" enctype='multipart/form-data'> 
           <input type="hidden" name="update_id" id="update_id">
           <div class="form-group"> 
                <label for="exampleInputPassword1">Category Select</label>
                <select name="uname" class="form-control" required>
                  <option value="" id="catename">Select Category</option>
                    <?php       
                      $sql1 = mysqli_query($con, "SELECT * FROM `category`");
                            $result1 = mysqli_num_rows($sql1);
                              if($result1  > 0) {
                              while($row1 = mysqli_fetch_assoc($sql1)) {
                    ?>
                  <option value="<?php echo $row1['id']; ?>"><?php echo $row1['cate_name']; ?></option>
                <?php } } ?>
                </select>
               </div>
              <div class="form-group">
                  <label for="exampleInputPassword1">Product Code</label>
                  <input type="text" class="form-control" id="ucode" name="ucode" placeholder="Product Code" required>
              </div>
              <div class="form-group">
                  <label for="exampleInputPassword1">Product Price</label>
                  <input type="text" class="form-control" id="uprice" name="uprice" placeholder="Product Price" required>
              </div>
              <div class="form-group">
                  <label for="exampleInputPassword1">Product Image</label>
                  <input type="file" class="form-control" id="exampleInputPassword1" name="file" required>
              </div>
              <button type="submit" class="btn btn-primary" name="updateproduct">Submit</button>
        </form>                          
      </div>
    </div>
  </div>
</div>

    <div class="card">
              <div class="card-header">
                <h3 class="card-title">Products</h3>
                <a href="#" class="btn btn-success float-right" data-toggle="modal" data-target="#myModal">Add Products</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>#</th>
                    <th>Category Name</th>
                    <th>Product Code</th>
                    <th>Product Price</th>
                    <th>Product Image</th>
                    <th>Status</th>
                    <th>Add Date</th>
                    <th>Action</th>
                  </tr>
                  </thead>

                  <tbody>
                  <?php
                     $k=0;       
                      $sql = mysqli_query($con, "SELECT * FROM `products`");
                            $result = mysqli_num_rows($sql);
                              if($result  > 0) {
                              while($row = mysqli_fetch_assoc($sql)) {
                        ?>
                  <tr>
                     <td style="display: none;"><?php echo $row['id']; ?></td>
                     <td><?php echo ++$k; ?></td>
                    <td style="display: none;"><?php echo $row['cate_id'] ;  ?></td>
                    <td>
                      <?php 
                        $cate_id=$row['cate_id']; 
                        $sql2 = "SELECT * FROM category WHERE id='$cate_id'";
                        $result2 = mysqli_query($con, $sql2);
                        $row2 = mysqli_fetch_assoc($result2);
                         echo $row2['cate_name'];
                      ?>
                    </td>
                    <td><?php echo $row['product_code']; ?></td>
                    <td><?php echo $row['product_price']; ?></td>
                    <td><img src="<?php echo $row['product_img']; ?>" alt="product Img" width="50px" height="50px"></td>
                    <td><?php 
                        
                        if($row['status']==1)
                        { echo "<a class='btn btn-info' style='border-color:2px solid #01cd74; background-color:#01cd74;' href='product_status.php?id=".$row['id']."&status=".'0'."' title='Click To Deactive'>Active</a>" ;} 
                        if($row['status']==0) { echo "<a class='btn btn-danger' href='product_status.php?id=".$row['id']."&status=".'1'."' title='Click To Active'>Deactive</a>" ;}
                         ?></td>
                      <td><?php echo $row['add_date'];?></td>
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

          $('#catename').val(data[2]);
          $('#catename').text(data[3]);
          $('#ucode').val(data[4]);
          $('#uprice').val(data[5]);

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
                    url:"delete/product_delete.php",
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

