<!-- Delete -->
<div class="modal fade" id="delete_<?php echo $row['message_id']; ?>" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h5 class="modal-title " id="ModalLabel">Delete Message</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="text-center">Are you sure you want to Delete?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary  btn-sm" data-bs-dismiss="modal">Close</button>
                <a href="delete_message.php?id=<?php echo $row['message_id']; ?>" class="btn btn-danger  btn-sm"> Yes</a>
            </div>
        </div>
    </div>
</div>


<!-- Edit -->
<div class="modal fade" id="edit_<?php echo $row['message_id']; ?>" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalLabel">Edit Message</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="edit_message.php?id=<?php echo $row['message_id']; ?>">
                    <div class="row clearfix">
                        <input type="hidden" class="form-control" name="message_user" value="<?php echo $_SESSION["user"] ?>">
                        <div class="col-md-12 col-sm-12 mb-3">
                            <div class="form-group">
                                <label>Message</label>
                                <input type="text" class="form-control" name="content" value="<?php echo $row['message_content']; ?>">
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12 mb-3">
                            <div class="form-group">
                                <label>Send to</label>
                                <input name="sent_to" autocomplete="off" list="list" class="form-control" placeholder="<---------- Send to ---------->" value="<?php echo $row['send_to_id']; ?>">
                                    <datalist id="list">
                                    <?php
                                    include 'db_connect.php';
                                    $sql1 = "SELECT * from student_enroll ";
                                    $result1 = $mysqli->query($sql1);
                                    if (!$result1) {
                                        die("Invalid query: " . $mysqli->error);
                                    }
                                    echo "<option class='align-center text-bold'>< STUDENT ></option>";
                                    while ($row1 = $result1->fetch_assoc()) {
                                        echo "
                                                            <option value='$row1[id]'>$row1[id]" . " - " . "$row1[first_name] $row1[middle_name] $row1[last_name] $row1[suffix_name]</option>
                                                            ";
                                    }
                                    $sql3 = "SELECT * from admin_db ";
                                    $result3 = $mysqli->query($sql3);
                                    if (!$result3) {
                                        die("Invalid query: " . $mysqli->error);
                                    }
                                    echo "<option class='align-center' >< ADMIN ></option>";
                                    while ($row3 = $result3->fetch_assoc()) {
                                        echo "
                                                            <option value='$row3[admin_id]'>$row3[admin_id]" . " - " . "$row3[admin_fname] $row3[admin_mname] $row3[admin_lname] $row3[admin_sname]</option>
                                                            ";
                                    }
                                    ?>

                                </datalist>
                            </div>
                        </div>
                        <br>
                        <div class="col-sm-12 mb-3">
                            <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                            <a href="message.php" class="btn btn-outline-secondary btn-sm" title="">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



