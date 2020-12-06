<div class="modal fade" id="modal-edit">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Establishment Details</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form role="form" id="updateForm" action="app/controller/establishment.php" method="POST">
                    <input type="text" id="eId" name="eId" hidden>
                    <div class="form-group">
                        <label for="eName">Name</label>
                        <input type="text" class="form-control" id="eName" name="eName" required>
                    </div>
                    <div class="form-group">
                        <label for="eAddress">Address</label>
                        <input type="text" class="form-control" id="eAddress" name="eAddress" required>
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