<?php
    require_once(__DIR__."/app/__helpers/Session.php");
    require_once(__DIR__."/app/__helpers/Guard.php");
    require_once(__DIR__."/app/__helpers/Pages.php");
    $currentPage = new Pages("Establishment");
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
                <h3 class="card-title">List of establishment</h3>
                <i class="nav-icon fas fa-plus-circle modal-icon" data-toggle="modal" data-target="#modal-lg"></i>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="dataTable" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Code Number</th>
                    <th>Establishment</th>
                    <th>Address</th>
                    <th class="center">No. of people entered</th>
                    <th class="center">Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php 
                    require_once(__DIR__."/app/model/establishment.php");
                    $establishment = (new Establishment())->getAll();
                    foreach($establishment as $establishment) {
                      ?>
                        <tr>
                          <td><?php echo 'E-000'.$establishment->id; ?></td>
                          <td><?php echo $establishment->name; ?></td>
                          <td><?php echo $establishment->address; ?></td>
                          <td class="center">
                            <a href="people?establishment-id=<?php echo $establishment->id; ?>" target="_blank">
                              <span class="badge bg-success">
                                <?php echo $establishment->numberOfPeople; ?>
                              </span>
                            </a>
                          </td>
                          <td class="center">
                            <i class="nav-icon text-warning fas fa-pencil-alt pointer mr-3" 
                                onclick="editEstablishment('<?php echo $establishment->id ?>', '<?php echo $establishment->name ?>', '<?php echo $establishment->address ?>')"></i>
                            <i class="nav-icon text-danger fas fa-trash-alt pointer" 
                                onclick="deleteEstablishment('<?php echo $establishment->id ?>', '<?php echo $establishment->name ?>', '<?php echo $establishment->address ?>')"></i>
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
    include(__DIR__."/app/views/establishment/create.php");
    include(__DIR__."/app/views/establishment/edit.php");
    include(__DIR__."/app/views/establishment/delete.php");
  ?>
</div>
<!-- ./wrapper -->
<?php include(__DIR__."/app/views/includes/_js.php"); ?>
<?php include(__DIR__."/app/views/layouts/footer.php"); ?>
<!-- page script -->
<script>
  $(function () {
    $("#dataTable").DataTable({
      "responsive": true, "lengthChange": true, "autoWidth": false,
      "buttons": ["excel", "pdf", "print"]
    }).buttons().container().appendTo('#dataTable_wrapper .col-md-6:eq(0)');
  });
</script>
<script type="text/javascript">
$(document).ready(function () {
  bsCustomFileInput.init();
});
</script>
<script>
  function editEstablishment(id, name, address) {
    $("#eId").val(id);
    $("#eName").val(name);
    $("#eAddress").val(name);
    $("#modal-edit").modal();
  }

  function deleteEstablishment(id, name, address) {
    $("#deleteEstablishmentId").val(id);
    $("#deleteEstablishmentName").val(name);
    $("#deleteEstablishmentAddress").val(name);
    $("#modal-delete").modal();
  }
</script>
<?php include(__DIR__."/app/__helpers/ToastMessage.php"); ?>
</body>
</html>
