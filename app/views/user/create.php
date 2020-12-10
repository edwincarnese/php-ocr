<div class="modal fade" id="modal-lg">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">User Details</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form role="form" id="createForm" action="app/controller/user.php" method="POST">
                    <div class="form-group">
                        <label for="name">Full Name</label>
                        <input type="text" class="form-control" name="name" required>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-6">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" name="username" required>
                        </div>
                        <div class="col-md-6">
                            <label for="password">Password</label>
                            <input type="text" class="form-control" name="password" required>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Select User Type</label>
                                <select class="form-control" name="user_type" required>
                                    <option value="Admin">Admin</option>
                                    <option value="Guard">Guard</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Select Establishment</label>
                                <select class="form-control" name="establishment" required>
                                    <?php 
                                        foreach($establishment as $establishment) {
                                            ?>
                                                <option value="<?php echo $establishment->id; ?>">
                                                    <?php echo $establishment->name; ?>
                                                </option>
                                            <?php
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
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