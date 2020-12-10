<div class="modal fade" id="modal-edit">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">User Details</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form role="form" id="updateForm" action="app/controller/user.php" method="POST">
                    <input type="text" id="editId" name="editId" hidden>
                    <div class="form-group">
                        <label for="editName">Name</label>
                        <input type="text" class="form-control" id="editName" name="name" required>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-6">
                            <label for="editUserName">Username</label>
                            <input type="text" class="form-control" id="editUserName" name="username" readonly>
                        </div>
                        <div class="col-md-6">
                            <label for="ePassword">Password</label>
                            <input type="text" class="form-control" id="ePassword" name="password" required>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <input type="submit" class="btn btn-primary" name="update" form="updateForm" value="Save changes">
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>