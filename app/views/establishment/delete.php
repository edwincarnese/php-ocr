<div class="modal fade" id="modal-delete">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Establishment Details</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form role="form" id="deleteForm" action="app/controller/establishment.php" method="POST">
                    <input type="text" id="deleteEstablishmentId" name="establishmentId" hidden>
                    <div class="form-group">
                        <label for="deleteEstablishmentName">Name</label>
                        <input type="text" class="form-control" id="deleteEstablishmentName" name="establishmentName" readonly>
                    </div>
                    <div class="form-group">
                        <label for="deleteEstablishmentAddress">Name</label>
                        <input type="text" class="form-control" id="deleteEstablishmentAddress" name="establishmentAddress" readonly>
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