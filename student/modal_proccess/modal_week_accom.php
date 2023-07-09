<!-- Delete -->
<div class="modal fade" id="delete_<?php echo $row['w_id']; ?>" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h5 class="modal-title " id="ModalLabel">Delete Weekly Accomplishment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="text-center">Are you sure you want to Delete?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary  btn-sm" data-bs-dismiss="modal">Close</button>
                <a href="delete_week_accom.php?id=<?php echo $row['w_id']; ?>" class="btn btn-danger  btn-sm"> Yes</a>
            </div>
        </div>
    </div>
</div>


<!-- Edit -->
<div class="modal fade" id="edit_<?php echo $row['std_id']; ?>" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalLabel">Edit Weekly Accomplishment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" enctype="multipart/form-data" action="edit_week_accom.php?id=<?php echo $row['w_id']; ?>">
                    <div class="row clearfix">
                        <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                                <label class="mb-3">ID - Student name</label>
                                <input  name="user_id" autocomplete="off" list="student_list2" class="form-control" value="<?php echo $row['id']; ?>">
                                    <datalist id="student_list2">
                                    <?php
                                    include '../../database/db_connect.php';
                                    $stt = $_SESSION["userstation"];
                                    $sql3 = "SELECT * from student_enroll join student_station on student_enroll.id=student_station.s_id Where student_enroll.status !='1' and student_station.sti_id='$stt' ";
                                    $result3 = $mysqli->query($sql3);
                                    if (!$result3) {
                                        die("Invalid query: " . $mysqli->error);
                                    }
                                    while ($row3 = $result3->fetch_assoc()) {
                                    ?>

                                        <option value='<?php echo $row3['s_id']; ?>'><?php echo $row3['s_id'] . " - " . $row3['last_name'] . ", " . $row3['first_name'] . " " . $row3['middle_name'] . " " . $row3['suffix_name']; ?></option>

                                    <?php
                                    }
                                    ?>
                                </datalist>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12 mb-3">
                                <div class="form-group">
                                    <label>Insert or take again the image .</label>
                                    <input type="file" class="form-control form-control-sm" name="image1" id="image1">
                                    <input class="btn btn-secondary btn-sm " type="button" value="Take Picture" onclick="captureImage()">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12 mb-3">
                                <div class="form-group">
                                    <label>Start of week</label>
                                    <input type="date" onfocus="(this.type='date')" onblur="(this.type='text')" class="form-control form-control-sm" name="startweek" value="<?php echo $row['start_week'];?>">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12 mb-3">
                                <div class="form-group">
                                    <label>End of week</label>
                                    <input type="date" onfocus="(this.type='date')" onblur="(this.type='text')" class="form-control form-control-sm" name="endweek" value="<?php echo $row['end_week'];?>">
                                </div>
                            </div>
                        <br>
                        <div class="col-sm-12 mb-3">
                            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                            <a href="week_accom.php" class="btn btn-outline-secondary" title="">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>