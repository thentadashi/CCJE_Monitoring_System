<!-- Delete -->
<div class="modal fade" id="delete_<?php echo $row['id']; ?>" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h5 class="modal-title " id="ModalLabel">Delete Team Leader</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="text-center">Are you sure you want to Delete?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary  btn-sm" data-bs-dismiss="modal">Close</button>
                <a href="delete_team_leader.php?id=<?php echo $row['id']; ?>" class="btn btn-danger  btn-sm"> Yes</a>
            </div>
        </div>
    </div>
</div>


<!-- Edit -->
<div class="modal fade" id="edit_<?php echo $row['id']; ?>" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalLabel">Edit Team Leader</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="edit_team_leader.php?id=<?php echo $row['id']; ?>">
                    <div class="row clearfix">
                        <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                                <label class="mb-3">ID - Student name</label>
                                <input name="user_id" autocomplete="off" list="student_list" class="form-control" value="<?php echo $row['id']; ?>">
                                <datalist id="student_list">
                                    <?php
                                    include 'db_connect.php';
                                    $sql3 = "SELECT * from student_enroll where status !='1'";
                                    $result3 = $mysqli->query($sql3);
                                    if (!$result3) {
                                        die("Invalid query: " . $mysqli->error);
                                    }
                                    while ($row3 = $result3->fetch_assoc()) {
                                    ?>

                                        <option class="align-center" value="<?php echo $row3['id']; ?>"><?php echo $row3['id'] . " - " . $row3['last_name'] . ", " . $row3['first_name'] . " " . $row3['middle_name'] . " " . $row3['suffix_name']; ?></option>

                                    <?php
                                    }
                                    ?>
                                </datalist>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                                <label class="mb-3">Station Designated</label>
                                <input name="station_id" list="station_list"  class="form-select" value="<?php echo $row['sti_id']; ?>">
                                <datalist id="station_list">
                                    <?php
                                    include 'db_connect.php';
                                    $sql2 = "SELECT * from station_info ";
                                    $result2 = $mysqli->query($sql2);
                                    if (!$result2) {
                                        die("Invalid query: " . $mysqli->error);
                                    }
                                    while ($row2 = $result2->fetch_assoc()) {
                                    ?>

                                        <option value="<?php echo $row2['sti_id']; ?>"> <?php echo $row2['sti_station']  . " - " . $row2['sti_lname'] . ", " .  $row2['sti_fname'] . " " . $row2['sti_mname'] . " " . $row2['sti_sname']  . " - " . $row2['sti_region'] . ", " . $row2['sti_municipal'] . ", " . $row2['sti_barangay']; ?></option>
                                    <?php
                                    }
                                    ?>
                                </datalist>
                            </div>
                        </div>
                        <br>
                        <div class="col-sm-12 mb-3">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <a href="team_leader_table.php" class="btn btn-outline-secondary" title="">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>