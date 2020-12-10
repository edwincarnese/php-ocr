<div class="modal fade" id="modal-delete">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">User Details</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form role="form" id="deleteForm" action="app/controller/user.php" method="POST">
                    <input type="text" id="deleteId" name="userId" hidden>
                    <div class="form-group">
                        <label for="deleteName">Name</label>
                        <input type="text" class="form-control" id="deleteName" name="name" readonly>
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <input type="submit" class="btn btn-danger" name="delete" form="deleteForm" value="Delete">
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>