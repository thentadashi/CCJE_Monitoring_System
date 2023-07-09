<div class="modal fade" id="update_<?php echo $row['id']; ?>" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalLabel">Update Student <?php echo $row['last_name'] . ", " . $row['first_name'] . " " . $row['middle_name'] . " " . $row['suffix_name']; ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="set_blk.php">
                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                    <div class="row clearfix">
                    <div class="col-md-12 col-sm-12 mb-2">
                                    <label class="mb-3">Block</label>
                                    <input name="blk" autocomplete="off" list="block_list" class="form-control" value="<?php echo $row['blk']; ?>" required>
                                    <datalist id="block_list">
                                        <option value="" disabled selected></option>
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                        <option>5</option>
                                        <option>6</option>
                                        <option>7</option>
                                        <option>8</option>
                                        <option>9</option>
                                        <option>10</option>
                                        <option>11</option>
                                        <option>12</option>
                                        <option>13</option>
                                        <option>14</option>
                                        <option>15</option>
                                        <option>16</option>
                                        <option>17</option>
                                        <option>18</option>
                                        <option>19</option>
                                    </datalist>
                                </div>
                                <div class="row clearfix">
                                <div class="col-md-12 col-sm-12 mb-2">
                                    <label>Semester</label>
                                    <input name="sem" autocomplete="off" list="sem_list" class="form-control" value="<?php echo $row['sem'] ?>" required>
                                    <datalist id="sem_list">
                                        <option>1st</option>
                                        <option>2nd</option>
                                    </datalist>
                                </div>
                                <div class="col-md-12 col-sm-12 mb-2">
                                    <label>School Year</label>
                                    <input name="year" autocomplete="off" list="year_list" class="form-control" value="<?php echo $row['sch_yr'] ?>" required>
                                    <datalist id="year_list">
                                        <option>2018-2019</option>
                                        <option>2019-2020</option>
                                        <option>2020-2021</option>
                                        <option>2021-2022</option>
                                        <option>2022-2023</option>
                                        <option>2023-2024</option>
                                        <option>2024-2025</option>
                                        <option>2025-2026</option>
                                    </datalist>
                                </div>
                        <br>
                        <div class="col-sm-12 mb-3">
                            <button type="submit" name="edit" class="btn btn-primary">Update</button>
                            <a href="student_enrolled.php" class="btn btn-outline-secondary" title="">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>