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
            <h1 class="m-0 text-dark">Website Settings</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Website Settings</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <?php
            if(isset($_POST['adsetting'])){
                $filename = $_FILES['file']['name'] ;
                $tempname = $_FILES['file']['tmp_name'] ; 
                $filesize = $_FILES['file']['size'] ;
                $fileextension = explode('.', $filename) ;
                $fileextension = strtolower(end($fileextension));

                $newfilename = uniqid().'images'.'.'.$fileextension ;
                $path = "images/banner/".$newfilename ;

                $fb = $_POST['fb'];
                $insta = $_POST['insta'];
                $youtube = $_POST['youtube'];
                $whatsapp = $_POST['whatsapp'];
                // $email = $_POST['email'];
                $twitter = $_POST['twitter'];
                $youtube = $_POST['youtube'];


                $sql = mysqli_query ($con, "INSERT INTO `social_links`(`youtube`, `facebook`, `instagram`, `banner`, `twitter`,`whatsapp`) VALUES ('$youtube','$fb','$insta','$path','$twitter','$whatsapp') ");

                
                if(move_uploaded_file($tempname, $path) && $sql){
                    $_SESSION['status']="Add Settings Successfully!";
                    $_SESSION['btn_code']="success";
                    echo "<script>window.location.href='website.php';</script>";exit;
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
        <h5 class="modal-title" id="exampleModalLabel">Add Settings</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="" enctype='multipart/form-data'>
              <div class="form-group">
                  <label for="exampleInputPassword1">Facebook</label>
                  <input type="text" class="form-control" id="exampleInputPassword1" name="fb" placeholder="Facebook Link" required>
              </div>
              <div class="form-group">
                  <label for="exampleInputPassword1">Twitter</label>
                  <input type="text" class="form-control" id="exampleInputPassword1" name="twitter" placeholder="Twitter Link" required>
              </div>
              <div class="form-group">
                  <label for="exampleInputPassword1">Instagram</label>
                  <input type="text" class="form-control" id="exampleInputPassword1" name="insta" placeholder="Instagram Link" required>
              </div>
              <div class="form-group">
                  <label for="exampleInputPassword1">YouTube</label>
                  <input type="text" class="form-control" id="exampleInputPassword1" name="youtube" placeholder="YouTube Link" required>
              </div>
             <!--  <div class="form-group">
                  <label for="exampleInputPassword1">Email Address</label>
                  <input type="email" class="form-control" id="exampleInputPassword1" name="email" placeholder="Email Address" required>
              </div> -->
              <div class="form-group">
                  <label for="exampleInputPassword1">WhatsApp</label>
                  <input type="text" class="form-control" id="exampleInputPassword1" name="whatsapp" placeholder="WhatsApp Link" required>
              </div>
              <div class="form-group">
                  <label for="exampleInputPassword1">Website Banner</label>
                  <input type="file" class="form-control" id="exampleInputPassword1" name="file" required>
              </div>
              <button type="submit" class="btn btn-primary" name="adsetting">Submit</button>
        </form>                          
      </div>
    </div>
  </div>
</div>



<!-- ///////////////////////////// update product/////////////// -->
      <?php
                // include("../db.php");
                if(isset($_POST['updatesetting'])){
                  $id =  $_POST['update_id'] ;
                  $filename1 = $_FILES['file']['name'] ;
                  $tempname1 = $_FILES['file']['tmp_name'] ; 
                  $filesize1 = $_FILES['file']['size'] ;
                  $fileextension1 = explode('.', $filename1) ;
                  $fileextension1 = strtolower(end($fileextension1));

                  $newfilename1 = uniqid().'images'.'.'.$fileextension1 ;
                  $path1 = "images/banner/".$newfilename1 ;
                  $fb = $_POST['fb'];
                  $insta = $_POST['insta'];
                  $youtube = $_POST['youtube'];
                  $whatsapp = $_POST['whatsapp'];
                  // $email = $_POST['email'];
                  $twitter = $_POST['twitter'];
                  $youtube = $_POST['youtube'];

                   $usql = "UPDATE `social_links`  SET  youtube='$youtube', facebook='$fb',instagram='$insta', twitter='$twitter',whatsapp='$whatsapp' ,banner='$path1' WHERE id='$id'";
                   $query = mysqli_query($con,$usql);
                   
                  if (move_uploaded_file($tempname1, $path1) && $query)
                    {
                    $_SESSION['status']="Update Successfully!";
                    $_SESSION['btn_code']="success";
                    echo "<script>window.location.href='website.php';</script>";
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
        <h5 class="modal-title" id="exampleModalLabel">Update Settings</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="" enctype='multipart/form-data'> 
           <input type="hidden" name="update_id" id="update_id">
              <div class="form-group">
                  <label for="exampleInputPassword1">Facebook</label>
                  <input type="text" class="form-control" id="fb" name="fb" placeholder="Facebook Link" required>
              </div>
              <div class="form-group">
                  <label for="exampleInputPassword1">Twitter</label>
                  <input type="text" class="form-control" id="twitter" name="twitter" placeholder="Twitter Link" required>
              </div>
              <div class="form-group">
                  <label for="exampleInputPassword1">Instagram</label>
                  <input type="text" class="form-control" id="instagram" name="insta" placeholder="Instagram Link" required>
              </div>
              <div class="form-group">
                  <label for="exampleInputPassword1">YouTube</label>
                  <input type="text" class="form-control" id="youtube" name="youtube" placeholder="YouTube Link" required>
              </div>
             <!--  <div class="form-group">
                  <label for="exampleInputPassword1">Email Address</label>
                  <input type="email" class="form-control" id="email" name="email" placeholder="Email Address" required>
              </div> -->
              <div class="form-group">
                  <label for="exampleInputPassword1">WhatsApp</label>
                  <input type="text" class="form-control" id="whatsapp" name="whatsapp" placeholder="WhatsApp Link" required>
              </div>
              <div class="form-group">
                  <label for="exampleInputPassword1">Website Banner</label>
                  <input type="file" class="form-control" id="banner" name="file" required>
              </div>
              <button type="submit" class="btn btn-primary" name="updatesetting">Submit</button>
        </form>                          
      </div>
    </div>
  </div>
</div>

    <div class="card">
              <div class="card-header">
                <h3 class="card-title">Website Settings</h3>
                <a href="#" class="btn btn-success float-right" data-toggle="modal" data-target="#myModal">Add Settings</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body"  style="overflow-x: auto;">
                <table id="example2" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>#</th>
                    <th>Facebook</th>
                    <th>Twitter</th>
                    <th>Instagram</th>
                    <!-- <th>G Mail</th> -->
                    <th>YouTube</th>
                    <th>WhatsApp</th>
                    <th>Banner</th>
                    <th>Action</th>
                  </tr>
                  </thead>

                  <tbody>
                  <?php
                     $k=0;       
                      $sql = mysqli_query($con, "SELECT * FROM `social_links`");
                            $result = mysqli_num_rows($sql);
                              if($result  > 0) {
                              while($row = mysqli_fetch_assoc($sql)) {
                        ?>
                  <tr>
                    <td style="display: none;"><?php echo $row['id']; ?></td>
                    <td><?php echo ++$k; ?></td>
                    <td><?php echo $row['facebook']; ?></td>  
                    <td><?php echo $row['twitter']; ?></td>
                    <td><?php echo $row['instagram']; ?></td>
                  <!--   <td><?php echo $row['email']; ?></td> -->
                    <td><?php echo $row['youtube']; ?></td>
                    <td><?php echo $row['whatsapp']; ?></td>
                    <td><img src="<?php echo $row['banner']; ?>" alt="Banner Img" width="50px" height="50px"></td>
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
          $('#fb').val(data[2]);
          $('#twitter').val(data[3]);
          $('#instagram').val(data[4]);
          $('#youtube').val(data[5]);
          $('#whatsapp').val(data[6]);
          $('#banner').val(data[7]);

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
                    url:"delete/setting_delete.php",
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

