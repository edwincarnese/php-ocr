<div class="modal fade" id="modal-lg">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Establishment Details</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form role="form" id="createForm" action="app/controller/establishment.php" method="POST">
                    <div class="form-group">
                        <label for="establishmentName">Name</label>
                        <input type="text" class="form-control" id="establishmentName" name="establishment" required>
                    </div>
                    <div class="form-group">
                        <label for="establishmentAddress">Address</label>
                        <input type="text" class="form-control" id="establishmentAddress" name="address" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <input type="submit" class="btn btn-primary" name="create" form="createForm" value="Save changes">
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>