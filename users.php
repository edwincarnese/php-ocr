<?php
    require_once(__DIR__."/app/__helpers/Session.php");
    require_once(__DIR__."/app/__helpers/Guard.php");
    require_once(__DIR__."/app/__helpers/Pages.php");
    $currentPage = new Pages("Users");
    
    require_once(__DIR__."/app/model/establishment.php");
    $establishment = (new Establishment())->getAll();
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
                <h3 class="card-title">List of users</h3>
                <i class="nav-icon fas fa-plus-circle modal-icon" data-toggle="modal" data-target="#modal-lg"></i>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="dataTable" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Code Number</th>
                    <th>Name</th>
                    <th class="center">Username</th>
                    <th class="center">Establishment</th>
                    <th class="center">User Type</th>
                    <th class="center">Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php 
                    require_once(__DIR__."/app/model/user.php");
                    $users = (new User())->getAll();
                    foreach($users as $user) {
                      ?>
                        <tr>
                          <td><?php echo 'U-000'.$user->id ?></td>
                          <td><?php echo $user->name; ?></td>
                          <td class="center"><?php echo $user->username; ?></td>
                          <td class="center"><?php echo $user->establishment_name; ?></td>
                          <td class="center"><?php echo $user->user_type; ?></td>
                          <td class="center">
                            <i class="nav-icon text-warning fas fa-pencil-alt pointer mr-3" 
                              onclick="editUser('<?php echo $user->id ?>', '<?php echo $user->name ?>', '<?php echo $user->username ?>')"></i>
                            <i class="nav-icon text-danger fas fa-trash-alt pointer" onclick="deleteUser('<?php echo $user->id ?>', '<?php echo $user->name ?>')"></i>
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
    include(__DIR__."/app/views/user/create.php");
    include(__DIR__."/app/views/user/edit.php");
    include(__DIR__."/app/views/user/delete.php");
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
  function editUser(id, name, username) {
    $("#editId").val(id);
    $("#editName").val(name);
    $("#editUserName").val(username);
    $("#modal-edit").modal();
  }

  function deleteUser(id, name) {
    $("#deleteId").val(id);
    $("#deleteName").val(name);
    $("#modal-delete").modal();
  }
</script>
<?php include(__DIR__."/app/__helpers/ToastMessage.php"); ?>
</body>
</html>
