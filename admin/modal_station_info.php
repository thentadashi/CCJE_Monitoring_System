<!-- Delete -->
<div class="modal fade" id="delete_<?php echo $row['sti_id']; ?>" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h5 class="modal-title " id="ModalLabel">Delete Station Information</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="text-center">Are you sure you want to Delete?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary  btn-sm" data-bs-dismiss="modal">Close</button>
                <a href="delete_station_info.php?id=<?php echo $row['sti_id']; ?>" class="btn btn-danger  btn-sm"> Yes</a>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="archive_<?php echo $row['sti_id']; ?>" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h5 class="modal-title " id="ModalLabel">Archive Station Info</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="text-center">Are you sure you want to Archive?</p>
            </div>
            <div class="modal-footer">
                <form action="remove_station.php" method="post">
                    <input type='hidden' name='id' value='<?php echo $row['sti_id']; ?>' />
                    <input type="hidden" name="status" value="1">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                    <button type='submit'> Yes</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Delete -->
<div class="modal fade" id="unarchive_<?php echo $row['sti_id']; ?>" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <h5 class="modal-title " id="ModalLabel">Unarchive Station Info</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="text-center">Are you sure you want to Unarchive?</p>
            </div>
            <div class="modal-footer">
                <form action="remove_station.php" method="post">
                    <input type='hidden' name='id' value='<?php echo $row['sti_id']; ?>' />
                    <input type="hidden" name="status" value="0">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                    <button type='submit'> Yes</button>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Edit -->
<div class="modal fade" id="edit_<?php echo $row['sti_id']; ?>" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalLabel">Edit Station Information</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="edit_station_info.php?id=<?php echo $row['sti_id']; ?>">
                    <div class="row clearfix">
                        <div class="col-md-12 col-sm-12">
                            <input type="text" id="val" name="STI_Station" class="form-control mb-2" placeholder="STATION TYPE (ex, PNP, BFP, BJMP at etc.)" value="<?php echo $row['sti_station']; ?>">
                        </div>
                        <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                                <input type="text" name="STI_Lname" class="form-control" placeholder="last name" value="<?php echo $row['sti_lname']; ?>">
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                                <input type="text" name="STI_Fname" class="form-control" placeholder="first name" value="<?php echo $row['sti_fname']; ?>">
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                                <input type="text" name="STI_Mname" class="form-control" placeholder="middle name" value="<?php echo $row['sti_mname']; ?>">
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                                <select name="STI_Sname" class="form-control">
                                    <option value="<?php echo $row['sti_sname']; ?>"><?php echo $row['sti_sname']; ?></option>
                                    <option value=" ">N/A</option>
                                    <option value="Jr">Jr</option>
                                    <option value="Sr">Sr</option>
                                    <option value="III">III</option>
                                    <option value="IV">IV</option>
                                    <option value="V">V</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                                <input type="date" name="STI_Assign" class="form-control" placeholder="yyyy-mm-dd" value="<?php echo $row['sti_assign_date']; ?>">
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                                <input type="text" name="STI_Contact" class="form-control" placeholder="contract" value="<?php echo $row['sti_contact']; ?>">
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                                <input type="text" name="STI_Email" class="form-control" placeholder="email" value="<?php echo $row['sti_email']; ?>">
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                                <input type="text" name="STI_Barangay" class="form-control" placeholder="barangay" value="<?php echo $row['sti_barangay']; ?>">
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                                <input type="text" name="STI_Municipal" class="form-control" placeholder="municipal" value="<?php echo $row['sti_municipal']; ?>">
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                                <input type="text" name="STI_Region" class="form-control" placeholder="region" value="<?php echo $row['sti_region']; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 pt-2">
                        <button type="submit" class="btn btn-primary btn-sm">Save</button>
                        <a href="station_info.php" class="btn btn-outline-secondary btn-sm" title="">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>