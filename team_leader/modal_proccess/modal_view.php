<!-- Approve -->
<div class="modal fade" id="view_<?php echo $row['id']; ?>" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h5 class="modal-title text-white " id="ModalLabel">Requirements of <?php echo $row['last_name'] . ", " . $row['first_name'] . " " . $row['middle_name'] . " " . $row['suffix_name']; ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row clearfix">
                    <?php $id = $row['id']; ?>
                    <div class="col-sm-4">
                        <h6 class="card-title">Personal Data Sheet</h6>
                    </div>
                    <div class="col-sm-8">
                        <?php $query = "SELECT * FROM personal_sheet_db WHERE std_id = '$id'";
                        $res = $mysqli->query($query);
                        if ($res->num_rows > 0) {
                            echo "<p class='text text-success mb-0'>Submitted</p>";
                        } else {
                            echo "<p class='text text-danger mb-0'>Not Submiited yet</p>";
                        }
                        ?>
                    </div>
                    <hr>
                    <div class="col-sm-4">
                        <h6 class="card-title">Parent Consent</h6>
                    </div>
                    <div class="col-sm-8">
                    <?php $query2 = "SELECT * FROM parent_con_db WHERE std_id = '$id'";
                        $res2 = $mysqli->query($query2);
                        if ($res2->num_rows > 0) {
                            echo "<p class='text text-success mb-0'>Submitted</p>";
                        } else {
                            echo "<p class='text text-danger mb-0'>Not Submiited yet</p>";
                        }
                        ?>
                    </div>
                    <hr>
                    <div class="col-sm-4">
                        <h6 class="card-title">PhilHealth ID</h6>
                    </div>
                    <div class="col-sm-8">
                    <?php $query3 = "SELECT * FROM philhealth_id_db WHERE std_id = '$id'";
                        $res3 = $mysqli->query($query3);
                        if ($res3->num_rows > 0) {
                            echo "<p class='text text-success mb-0'>Submitted</p>";
                        } else {
                            echo "<p class='text text-danger mb-0'>Not Submiited yet</p>";
                        }
                        ?>
                    </div>
                    <hr>
                    <div class="col-sm-4">
                        <h6 class="card-title">Vaccination ID</h6>
                    </div>
                    <div class="col-sm-8">
                    <?php $query4 = "SELECT * FROM cer_vac_db WHERE std_id = '$id'";
                        $res4 = $mysqli->query($query4);
                        if ($res4->num_rows > 0) {
                            echo "<p class='text text-success mb-0'>Submitted</p>";
                        } else {
                            echo "<p class='text text-danger mb-0'>Not Submiited yet</p>";
                        }
                        ?>
                    </div>
                    <hr>
                    <div class="col-sm-4">
                        <h6 class="card-title">Medical Certificate</h6>
                    </div>
                    <div class="col-sm-8">
                    <?php $query5 = "SELECT * FROM pregnancy_db WHERE std_id = '$id'";
                        $res5 = $mysqli->query($query5);
                        if ($res5->num_rows > 0) {
                            echo "<p class='text-success mb-0'>Submitted</p>";
                        } else {
                            echo "<p class='text-danger mb-0'>Not Submiited yet</p>";
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div class="modal-footer"></div>
        </div>
    </div>
</div>
</div>