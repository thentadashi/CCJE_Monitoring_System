<div class="modal fade" id="archive_<?php echo $row['admin_id']; ?>" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h5 class="modal-title " id="ModalLabel">Archive Student Enrolled</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="text-center">Are you sure you want to Archive?</p>
            </div>
            <div class="modal-footer">
                <form action="remove_admin.php" method="post">
                    <input type='hidden' name='id' value='<?php echo $row['admin_id']; ?>' />
                    <input type="hidden" name="status" value="1">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                    <button type='submit'> Yes</button>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="unarchive_<?php echo $row['admin_id']; ?>" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <h5 class="modal-title " id="ModalLabel">Unarchive Student Enrolled</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="text-center">Are you sure you want to Unarchive?</p>
            </div>
            <div class="modal-footer">
                <form action="remove_admin.php" method="post">
                    <input type='hidden' name='id' value='<?php echo $row['admin_id']; ?>' />
                    <input type="hidden" name="status" value="0">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                    <button type='submit'> Yes</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Edit -->
<div class="modal fade" id="edit_<?php echo $row['admin_id']; ?>" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalLabel">Edit Admin</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="edit_admin.php?id=<?php echo $row['admin_id']; ?>">
                    <div class="row clearfix">
                    <input type="hidden" name="status" value="0">
                        <div class="col-md-12 col-sm-12 mb-3">
                            <div class="form-group">
                                <input type="text" class="form-control" name="Admin_Id" placeholder="ID OR USERNAME" value="<?php echo $row['admin_id']; ?>">
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12 mb-3">
                            <div class="form-group">
                                <input type="text" name="Admin_Lname" class="form-control" placeholder="SURNAME" value="<?php echo $row['admin_lname']; ?>">
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12 mb-3">
                            <div class="form-group">
                                <input type="text" name="Admin_Fname" class="form-control" placeholder="FIRST NAME" value="<?php echo $row['admin_fname']; ?>">
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12 mb-3">
                            <div class="form-group">
                                <input type="text" name="Admin_Mname" class="form-control" placeholder="MIDDLE NAME" value="<?php echo $row['admin_mname']; ?>">
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12 mb-3">
                            <div class="form-group">
                                <select name="Admin_Sname" class="custom-select form-control">
                                <option value="<?php echo $row['admin_sname']; ?>"><?php echo $row['admin_sname']; ?></option>
                                    <option value=" ">N/A</option>
                                    <option value="Jr">Jr</option>
                                    <option value="Sr">Sr</option>
                                    <option value="III">III</option>
                                    <option value="IV">IV</option>
                                    <option value="V">V</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12 mb-3">
                            <div class="form-group">
                                <input type="text" name="Admin_Position" class="form-control" placeholder="POSITION" value="<?php echo $row['admin_position']; ?>">
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12 mb-3">
                            <div class="form-group">
                                <input type="text" name="Admin_Email" class="form-control" placeholder="EMAIL" value="<?php echo $row['admin_email']; ?>">
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12 mb-3">
                            <div class="form-group">
                                <input type="password" name="Admin_Password" class="form-control" placeholder="PASSWORD" value="<?php echo $row['admin_password']; ?>">
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12 mb-3">
                            <div class="form-group">
                                <input type="password" name="Admin_Re-Password" class="form-control" placeholder="RE-TYPE PASSWORD" value="<?php echo $row['admin_password']; ?>">
                            </div>
                        </div>
                        <div class="col-sm-12 mb-3">
                            <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                            <a href="admin.php" class="btn btn-outline-secondary btn-sm" title="">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>