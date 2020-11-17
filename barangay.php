<?php
    require_once(__DIR__."/app/__helpers/Pages.php");
    require_once(__DIR__."/app/__helpers/Session.php");
    $currentPage = new Pages("Barangay");
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
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">List of barangay</h3>
                <i class="nav-icon fas fa-plus-circle modal-icon" data-toggle="modal" data-target="#modal-lg"></i>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="dataTable" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Code Number</th>
                    <th>Barangay</th>
                    <th class="center">No. of Cases</th>
                    <th class="center">Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php 
                    require_once(__DIR__."/app/model/barangay.php");
                    $barangay = (new Barangay())->getBarangay();
                    foreach($barangay as $barangay) {
                      ?>
                        <tr>
                          <td><?php echo 'B-000'.$barangay->id ?></td>
                          <td><?php echo $barangay->name ?></td>
                          <td class="center"><?php echo $barangay->numberOfCases ?></td>
                          <td class="center">
                            <i class="nav-icon text-warning fas fa-pencil-alt pointer mr-3" onclick="editBarangay('<?php echo $barangay->id ?>', '<?php echo $barangay->name ?>')"></i>
                            <i class="nav-icon text-danger fas fa-trash-alt pointer" onclick="deleteBarangay('<?php echo $barangay->id ?>', '<?php echo $barangay->name ?>')"></i>
                          </td>
                        </tr>
                      <?php
                    }
                  ?>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php 
    include(__DIR__."/app/views/barangay/create.php");
    include(__DIR__."/app/views/barangay/edit.php");
    include(__DIR__."/app/views/barangay/delete.php");
  ?>
</div>
<!-- ./wrapper -->
<?php include(__DIR__."/app/views/includes/_js.php"); ?>
<?php include(__DIR__."/app/views/layouts/footer.php"); ?>
<!-- page script -->
<script>
  $(function () {
    $("#dataTable").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
  });
</script>
<script type="text/javascript">
$(document).ready(function () {
  bsCustomFileInput.init();
});
</script>
<script>
  function editBarangay(id, name) {
    $("#bId").val(id);
    $("#bName").val(name);
    $("#modal-edit").modal();
  }

  function deleteBarangay(id, name) {
    $("#deleteBarangayId").val(id);
    $("#deleteBarangayName").val(name);
    $("#modal-delete").modal();
  }
</script>
<?php include(__DIR__."/app/__helpers/ToastMessage.php"); ?>
</body>
</html>
