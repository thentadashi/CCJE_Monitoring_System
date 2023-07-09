<div class="modal fade" id="edit_<?php echo $row['std_id']; ?>" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalLabel">Add Student time</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="edit_time.php?id=<?php echo $row['std_id']; ?>">
                    <div class="row clearfix">
                        <div class="col-md-12 col-sm-12 mb-2">
                            <div class="form-group">
                                <p><?php echo $row['last_name'] . ", " . $row['first_name'] . " " . $row['middle_name'] . " " . $row['suffix_name']; ?></p>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12 mb-2">
                            <div class="form-group">
                                <p>Current time Spend : <?php echo $row['time_spend']; ?> Hours</p>
                                <input type="hidden" name="pastnum" value="<?php echo $row['time_spend']; ?>">
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12 mb-2">
                            <div class="form-group">
                                <label> add time :</label>
                                <input type="time" name="num">
                            </div>
                        </div>
                        <br>
                        <div class="col-sm-12 mb-3 pt-2">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <a href="student_time.php" class="btn btn-outline-secondary" title="">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>