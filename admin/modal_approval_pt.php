<!-- Approve -->
<div class="modal fade" id="approve_<?php echo $row['p_id']; ?>" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h5 class="modal-title " id="ModalLabel">Approving <?php echo $row['last_name'] . ", " . $row['first_name'] . " " . $row['middle_name'] . " " . $row['suffix_name']; ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="text-center">Are you sure you want to Approve?</p>
            </div>
            <div class="modal-footer">
                <form action="proccess_pt.php" method="get" enctype="multipart/form-data">
                    <input type='hidden' name='id' value='<?php echo $row['p_id']; ?>' />
                    <input type='hidden' name='sid' value='<?php echo $row['std_id']; ?>' />
                    <input type='hidden' name='path' value='<?php echo $row['file_path']; ?>' />
                    <input type='hidden' name='name' value='<?php echo $row['file_name']; ?>' />
                    <input type='hidden' name='date' value='<?php echo $row['date_time']; ?>' />
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                    <button type='submit' name='action' value='accept'> Yes</button>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Reject -->
<div class="modal fade" id="reject_<?php echo $row['p_id']; ?>" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h5 class="modal-title " id="ModalLabel">Rejecting <?php echo $row['last_name'] . ", " . $row['first_name'] . " " . $row['middle_name'] . " " . $row['suffix_name']; ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="text-center">Are you sure you want to Reject?</p>
                <form action="proccess_pt.php" method="get" enctype="multipart/form-data">
                    <div class="form-outline w-100 px-3">
                     <label class="form-label"  for="textAreaExample">Reason :</label>
                <textarea class="form-control" name="reason" id="textAreaExample" rows="4"
                  style="background: #fff;" placeholder="Type here..." required></textarea>
                
              </div>
            </div>
            <div class="modal-footer">
            
                    <input type='hidden' name='id' value='<?php echo $row['p_id']; ?>' />
                    <input type='hidden' name='sid' value='<?php echo $row['std_id']; ?>' />
                    <input type='hidden' name='path' value='<?php echo $row['file_path']; ?>' />
                    <input type='hidden' name='name' value='<?php echo $row['file_name']; ?>' />
                    <input type='hidden' name='date' value='<?php echo $row['date_time']; ?>' />
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                    <button type='submit' name='action' value='reject'> Yes</button>
                </form>
            </div>
        </div>
    </div>
</div>