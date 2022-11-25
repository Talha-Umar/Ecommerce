<!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="dashboard.php" class="brand-link">
      <img src="assets/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Admin Panel</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview">
            <a href="dashboard.php" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="category.php" class="nav-link">
              <i class="nav-icon fab fa-product-hunt"></i>
              <p>
                Category
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="product.php" class="nav-link">
              <i class="nav-icon fab fa-product-hunt"></i>
              <p>
                Products
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="utime.php" class="nav-link">
              <i class="nav-icon far fa-clock"></i>
              <p>
                Update Time
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="order.php" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Today Orders
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="allorder.php" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                All Orders
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="description.php" class="nav-link">
              <i class="nav-icon  fas fa-info-circle"></i>
              <p>
                Description
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="terms.php" class="nav-link">
              <i class="nav-icon fab fa-servicestack"></i>
              <p>
                Terms & Services
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="user.php" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Users
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="profile.php" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Admin Profile
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="bank_details.php" class="nav-link">
              <i class="nav-icon fas fa-money-check"></i>
              <p>
                Bank Details
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="comment.php" class="nav-link">
              <i class="nav-icon far fa-envelope"></i>
              <p>
                User Comments
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="website.php" class="nav-link">
              <i class="nav-icon fas fa-cog"></i>
              <p>
                Website Settings
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="logout.php" class="nav-link">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>
                Logout
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">
          jQuery(function($) {
     var path = window.location.href;
     $('ul a').each(function() {
      if (this.href === path) {
       $(this).addClass('active');
      }
     });
    });
        </script>