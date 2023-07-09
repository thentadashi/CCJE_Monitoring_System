<!-- Delete -->
<div class="modal fade" id="archive_<?php echo $row['id']; ?>" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
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
                <form action="single_remove.php" method="post">
                    <input type='hidden' name='id' value='<?php echo $row['id']; ?>' />
                    <input type="hidden" name="status" value="1">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                    <button type='submit'> Yes</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Delete -->
<div class="modal fade" id="unarchive_<?php echo $row['id']; ?>" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
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
                <form action="single_remove.php" method="post">
                    <input type='hidden' name='id' value='<?php echo $row['id']; ?>' />
                    <input type="hidden" name="status" value="0">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                    <button type='submit'> Yes</button>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Edit -->
<div class="modal fade" id="edit_<?php echo $row['id']; ?>" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalLabel">Edit Student Enrolled</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="edit_student_enrolled.php?id=<?php echo $row['id']; ?>">
                    <input type="hidden" name="status" value="0">
                    <div class="row clearfix">
                        <div class="col-md-12 col-sm-12 mb-2">
                            <div class="form-group">
                                <input type="text" name="studentid" class="form-control" placeholder="STUDENT ID" value="<?php echo $row['id']; ?>">
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12 mb-2">
                            <div class="form-group">
                                <input type="text" name="lastname" class="form-control" placeholder="LAST NAME" value="<?php echo $row['last_name']; ?>">
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12 mb-2">
                            <div class="form-group">
                                <input type="text" name="firstname" class="form-control" placeholder="FIRST NAME" value="<?php echo $row['first_name']; ?>">
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12 mb-2">
                            <div class="form-group">
                                <input type="text" name="middlename" class="form-control" placeholder="MIDDLE NAME" value="<?php echo $row['middle_name']; ?>">
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12 mb-2">
                            <div class="form-group">
                                <select name="suffixname" class="form-control custom-select">
                                    <option value="<?php echo $row['suffix_name']; ?>"><?php echo $row['suffix_name']; ?></option>
                                    <option value=" ">N/A</option>
                                    <option value="Jr">Jr</option>
                                    <option value="Sr">Sr</option>
                                    <option value="III">III</option>
                                    <option value="IV">IV</option>
                                    <option value="V">V</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12 mb-2">
                                    <div class="form-group">
                                        <input type="text" name="email" class="form-control" placeholder="EMAIL" value="<?php echo $row['email']; ?>">
                                    </div>
                                </div>
                        <div class="col-md-12 col-sm-12 mb-2">
                            <div class="form-group">
                                <input type="password" name="password" class="form-control" placeholder="PASSWORD" value="<?php echo $row['password']; ?>">
                            </div>
                        </div>
                        <br>
                        <div class="col-sm-12 mb-3">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <a href="student_enrolled.php" class="btn btn-outline-secondary" title="">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>