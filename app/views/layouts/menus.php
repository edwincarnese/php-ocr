<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="dashboard" class="brand-link">
      <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">OCR</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?php echo $_SESSION["userFullname"]; ?></a>
          <small style="color: #c2c7d0;"><?php echo $_SESSION["userEstablishment"]; ?></small>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <!-- class=> menu-open -->
          <li class="nav-item has-treeview">
            <a href="./dashboard" class="nav-link <?php echo $currentPage->setCurrentMenuPage(["dashboard"]); ?>">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview <?php echo $currentPage->setCurrentOpenMenuPage(["people", "barangay", "establishment", "users"]); ?>">
            <a href="#" class="nav-link <?php echo $currentPage->setCurrentMenuPage(["people", "barangay" ,"establishment", "users"]); ?>">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Management
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="./people" class="nav-link <?php echo $currentPage->setCurrentMenuPage(["people"]); ?>">
                  <i class="fas fa-user-friends nav-icon"></i>
                  <p>People</p>
                </a>
              </li>
            </ul>
            <?php
              if($_SESSION['userType'] == "Admin") {
                ?>
                  <ul class="nav nav-treeview">
                    <li class="nav-item">
                      <a href="./barangay" class="nav-link <?php echo $currentPage->setCurrentMenuPage(["barangay"]); ?>">
                        <i class="fas fa-house-user nav-icon"></i>
                        <p>Barangay</p>
                      </a>
                    </li>
                  </ul>
                  <ul class="nav nav-treeview">
                    <li class="nav-item">
                      <a href="./establishment" class="nav-link <?php echo $currentPage->setCurrentMenuPage(["establishment"]); ?>">
                        <i class="fas fa-building nav-icon"></i>
                        <p>Establishment</p>
                      </a>
                    </li>
                  </ul>
                  <ul class="nav nav-treeview">
                    <li class="nav-item">
                      <a href="./users" class="nav-link <?php echo $currentPage->setCurrentMenuPage(["users"]); ?>">
                        <i class="fas fa-users nav-icon"></i>
                        <p>Users</p>
                      </a>
                    </li>
                  </ul>
                <?php
              }
            ?>
          </li>
          <li class="nav-header">AUTHENTICATION</li>
          <li class="nav-item has-treeview">
            <a href="app/controller/logout.php" class="nav-link">
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