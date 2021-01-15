<?php
    require_once(__DIR__."/app/__helpers/Pages.php");
    require_once(__DIR__."/app/__helpers/Session.php");
    $currentPage = new Pages("People");
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
                <h3 class="card-title">List of people</h3>
                <i class="nav-icon fas fa-plus-circle modal-icon" data-toggle="modal" data-target="#modal-save"></i>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="dataTable" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Code Number</th>
                    <th>Full Name</th>
                    <th>Address</th>
                    <th class="center">Front Image</th>
                    <th class="center">Back Image</th>
                    <th class="center">Establishment</th>
                    <th class="center">Status</th>
                    <th class="center">Date Time</th>
                    <th class="center">Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php 
                    require_once(__DIR__."/app/model/people.php");

                    $establishment_id = null;
                    $barangay_id = null;

                    if($_SESSION['userType'] != 'Admin') {
                      $establishment_id = $_SESSION['userEstablishmentId'];
                    }

                    if(isset($_GET['establishment-id'])) {
                      $establishment_id = $_GET['establishment-id'];
                    }

                    if(isset($_GET['barangay-id'])) {
                      $barangay_id = $_GET['barangay-id'];
                    }
                    
                    $people = (new People())->getAll($establishment_id, $barangay_id);
                    foreach($people as $people) {
                      ?>
                        <tr>
                          <td><?php echo 'P-000'.$people->id; ?></td>
                          <td><?php echo $people->fullname; ?></td>
                          <td><?php echo $people->address; ?></td>
                          <td class="center">
                            <a href="<?php echo $people->front_id; ?>" target="_blank">
                              <img src="<?php echo $people->front_id; ?>" style="width: 100px;">
                            </a>
                          </td>
                          <td class="center">
                            <a href="<?php echo $people->back_id; ?>" target="_blank">
                              <img src="<?php echo $people->back_id; ?>" style="width: 100px;">
                            </a>
                          </td>
                          <td class="center"><?php echo $people->establishmentName; ?></td>
                          <td class="center">
                            <?php 
                              if($people->status == 1) {
                                ?>
                                <span class="badge bg-success">
                                    SUCCESS
                                  </span>
                                <?php 
                              } else {
                                ?>
                                  <span class="badge bg-danger">
                                    FAILED
                                  </span>
                                <?php 
                              }
                            ?>
                          </td>
                          <td class="center">
                              <?php echo $people->created_at; ?>
                          </td>
                          <td class="center">
                            <i class="nav-icon text-warning fas fa-pencil-alt pointer mr-3" onclick="editPerson(<?php echo $people->id ?>)"></i>
                            <i class="nav-icon text-danger fas fa-trash-alt pointer" onclick="deletePerson(<?php echo $people->id ?>)"></i>
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
    include(__DIR__."/app/views/people/create.php");
    include(__DIR__."/app/views/people/edit.php");
    include(__DIR__."/app/views/people/delete.php");
    include(__DIR__."/app/views/layouts/footer.php");
  ?>
</div>
<!-- ./wrapper -->
<?php include(__DIR__."/app/views/includes/_js.php"); ?>
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
  function editPerson(personId) {
    $.ajax({
        type: "POST",
        url: "app/controller/people.php",   
        data: {
            "personId": personId
        },       
        success: function(response) {         
          let data = JSON.parse(response);
          $("#personId").val(data['id']);
          $("#fullName").val(data['fullname']);
          $("#address").val(data['address']);
          $("#modal-edit").modal();
        }
    });
  }
</script>
<script>
  function deletePerson(personId) {
    $.ajax({
        type: "POST",
        url: "app/controller/people.php",   
        data: {
            "personId": personId
        },       
        success: function(response) {         
          let data = JSON.parse(response);
          $("#deletePersonId").val(data['id']);
          $("#deleteFullName").val(data['fullname']);
          $("#deleteAddress").val(data['address']);
          $("#modal-delete").modal();
        }
    });
  }
</script>
<?php include(__DIR__."/app/__helpers/ToastMessage.php"); ?>
</body>
</html>
