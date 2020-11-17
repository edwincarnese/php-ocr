<?php
    require_once(__DIR__."/app/__helpers/Pages.php");
    require_once(__DIR__."/app/__helpers/Session.php");
    $currentPage = new Pages("Dashboard");
?>
<!DOCTYPE html>
<html>
<head>
  <?php include(__DIR__."/app/views/includes/header.php"); ?>
  <?php include(__DIR__."/app/views/includes/_css.php"); ?>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
  <?php 
    include(__DIR__."/app/views/layouts/header.php");  
    include(__DIR__."/app/views/layouts/menus.php");  
  ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <?php 
        include(__DIR__."/app/views/layouts/breadcrumb.php");
    ?>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-6 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>
                  <?php 
                    require_once(__DIR__."/app/model/barangay.php");
                    echo (new Barangay())->getNumberOfBarangay()->noOfBrgy;
                  ?>
                </h3>
                <p>Barangay</p>
              </div>
              <div class="icon">
                <i class="fas fa-house-user"></i>
              </div>
              <a href="barangay" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-6 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>
                  <?php 
                    require_once(__DIR__."/app/model/people.php");
                    echo (new People())->getNumberOfPeople()->noOfPeople;
                  ?>
                </h3>
                <p>People</p>
              </div>
              <div class="icon">
                <i class="fas fa-user-friends"></i>
              </div>
              <a href="people" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php include(__DIR__."/app/views/layouts/footer.php"); ?>
</div>
<!-- ./wrapper -->
<?php include(__DIR__."/app/views/includes/_js.php"); ?>
<?php include(__DIR__."/app/__helpers/ToastMessage.php"); ?>
</body>
</html>
