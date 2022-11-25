<?php 
include 'db.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Shope - Unique</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/topbar.css">
     <link rel="stylesheet" type="text/css" href="css/footer.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.15.0/css/all.css">
</head>
<body>
    <?php include 'includes/topbar.php'; ?>
    <img class="img-fluid" src="admin/<?php echo $row10['banner'];?>" alt="Banner">
<div style=" background-image: linear-gradient(45deg, #8000ff, #ff00c4); width:100%;">  
 <div class="container p-3"> 
 <section class="p-3">
    <h1 align="center">All Design List</h1>
            <div class="row">
          <?php           
             $perpage = 8;
             if(isset($_GET["page"])){
             $page = intval($_GET["page"]);
             }
             else {
             $page = 1;
             }
             $calc = $perpage * $page;
             $start = $calc - $perpage;

          $sql = "SELECT * FROM products WHERE status='1' Limit $start, $perpage";
          $result = mysqli_query($con, $sql);
           while($row = mysqli_fetch_assoc($result)) {
          ?>
                <div class="col-md-3 p-2">
                   <div class="thumbnail">
                  <img src="admin/<?php echo $row['product_img']?>" class="img-thumbnail img-fluid rounded slideimg" alt="Lights" style="width:100%">
                    <div class="caption">
                     <p><?php echo $row['product_code'];?></p>
                     </div>
                   </div>
                </div>
                <?php } ?>   
           </div> 
           <div class="p-3">
            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center pagination-lg">
            <?php
if(isset($page))

{
$result = mysqli_query($con,"select Count(id) As Total from products");
$rows = mysqli_num_rows($result);
if($rows)
{
$rs = mysqli_fetch_assoc($result);
$total = $rs["Total"];
}
$totalPages = ceil($total / $perpage);
if($page <=1 ){
    echo '<li class="page-item disabled">
                       <span class="page-link" tabindex="-1">Prev</span>
                     </li>';
}
else

{

$j = $page - 1;
echo "<li class='page-item'>
                       <a class='page-link' href='store.php?page=$j' tabindex='-1'>Prev</a>
                     </li>";
}
for($i=1; $i <= $totalPages; $i++)

{

if($i<>$page)

{

echo "<li class='page-item'><a class='page-link' href='store.php?page=$i'>$i</a></li>";

}
else
{
echo "<li class='page-item active'><span class='page-link'>$i</span></li>";
}
}
if($page == $totalPages )

{
echo '<li class="page-item disabled"><span class="page-link" tabindex="-1">Next</span></li>';
}

else

{
$j = $page + 1;
echo "<li class='page-item'><a class='page-link' href='store.php?page=$j'>Next</a></li>";
}

}
?>
               
        
                   </ul>
                </nav>
           </div>
    </section>

  </div>
</div>
    <?php include 'includes/footer.php'; ?>
</body>
</html>