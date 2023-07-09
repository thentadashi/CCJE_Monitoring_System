<!-- Delete -->
<div class="modal fade" id="delete_<?php echo $row['post_id']; ?>" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h5 class="modal-title " id="ModalLabel">Delete Announcement</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="text-center">Are you sure you want to Delete?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary  btn-sm" data-bs-dismiss="modal">Close</button>
                <a href="delete_post.php?id=<?php echo $row['post_id']; ?>" class="btn btn-danger  btn-sm"> Yes</a>
            </div>
        </div>
    </div>
</div>


<!-- Edit -->
<div class="modal fade" id="edit_<?php echo $row['post_id']; ?>" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalLabel">Edit Announcement</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" enctype="multipart/form-data" action="edit_post.php?id=<?php echo $row['post_id']; ?>">
                    <div class="row clearfix">
                        <div class="col-md-12 col-sm-12 mb-3">
                            <div class="form-group">
                                <label>Post Content</label>
                                <input type="text" class="form-control" name="post_content" value="<?php echo $row['post_content']; ?>">
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12 mb-3">
                            <div class="form-group">
                                <label>Image</label>
                                <input type="file" class="form-control" name="image" >
                            </div>
                        </div>
                        <br>
                        <br>
                        <div class="col-sm-12 mb-3">
                            <button type="submit" name="submit" class="btn btn-primary btn-sm">Post</button>
                            <a href="post.php" class="btn btn-outline-secondary btn-sm" title="">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>