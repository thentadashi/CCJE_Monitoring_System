<div class="modal fade" id="delete_<?php echo $row['id']; ?>" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h5 class="modal-title " id="ModalLabel">Delete Student information</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="text-center">Are you sure you want to Delete?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary  btn-sm" data-bs-dismiss="modal">Close</button>
                <a href="delete_student.php?id=<?php echo $row['id']; ?>" class="btn btn-danger  btn-sm"> Yes</a>
            </div>
        </div>
    </div>
</div>

<!-- view -->
<div class="modal fade" id="view_<?php echo $row['id']; ?>" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #0000B9;">
                <h5 class="modal-title text-white" id="ModalLabel">Student Information</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                
                    
                    <div class="row">
                        <div class="col-sm-4">
                            <p class="mb-0">Student ID</p>
                        </div>
                        <div class="col-sm-8">
                            <p class="text-muted mb-0"><?php echo $row['id']; ?></p>
                        </div>
                        <hr>
                        <div class="col-sm-4">
                            <p class="mb-0">Fullname</p>
                        </div>
                        <div class="col-sm-8">
                            <p class="text-muted mb-0"><?php echo $row["last_name"] . ", " . $row["first_name"] . " " . $row["middle_name"] . " " . $row["suffix_name"]; ?></p>
                        </div>
                        <hr>
                        <div class="col-sm-4">
                            <p class="mb-0">Birthday</p>
                        </div>
                        <div class="col-sm-8">
                            <p class="text-muted mb-0"><?php echo date("F d Y ", strtotime($row["birthday"])); ?></p>
                        </div>
                        <hr>
                        <div class="col-sm-4">
                            <p class="mb-0">Sex</p>
                        </div>
                        <div class="col-sm-8">
                            <p class="text-muted mb-0"><?php echo $row["sex"]; ?></p>
                        </div>
                        <hr>
                        <div class="col-sm-4">
                            <p class="mb-0">Telephone No.</p>
                        </div>
                        <div class="col-sm-8">
                            <p class="text-muted mb-0"><?php echo $row["tel_no"]; ?></p>
                        </div>
                        <hr>
                        <div class="col-sm-4">
                            <p class="mb-0">Mobile No.</p>
                        </div>
                        <div class="col-sm-8">
                            <p class="text-muted mb-0"><?php echo $row["mobile_no"]; ?></p>
                        </div>
                        <hr>
                        <div class="col-sm-4">
                            <p class="mb-0">Email</p>
                        </div>
                        <div class="col-sm-8">
                            <p class="text-muted mb-0"><?php echo $row["email"]; ?></p>
                        </div>
                        <hr>
                        <div class="col-sm-4">
                            <p class="mb-0">Guardian</p>
                        </div>
                        <div class="col-sm-8">
                            <p class="text-muted mb-0"><?php echo $row["g_name"]; ?>(<?php echo $row["g_rel"]; ?>)</p>
                        </div>
                        <hr>
                        <div class="col-sm-4">
                            <p class="mb-0">Guardian Mobile No.</p>
                        </div>
                        <div class="col-sm-8">
                            <p class="text-muted mb-0"><?php echo $row["g_mobile"]; ?></p>
                        </div>

                    </div>
                    <hr>
            </div>
        </div>
    </div>
</div>