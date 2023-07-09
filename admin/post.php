<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'head.php' ?>
    <title>Dashboard</title>
</head>
<style>
    .overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.7);
        display: none;
        justify-content: center;
        align-items: center;
    }

    /* Styles for the pop-up image */
    .overlay img {
        max-width: 80%;
        max-height: 80%;
    }
</style>

<body class="sb-nav-fixed">
    <?php include 'header.php' ?>
    <div id="layoutSidenav">
        <?php include 'nav.php' ?>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <div class="card bg-white mb-2">
                        <div class="card-body">
                            <div class="align-self-center">
                                <h1 class="mt-4">Announcement Lists</h1>
                                <ol class="breadcrumb mb-4">
                                    <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                                    <li class="breadcrumb-item active">Tables</li>
                                </ol>
                                <div class="col-lg-4 col-md-6">
                                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addModal" data-whatever="Team Leader"> Add Announcement</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php include('alert_message.php'); ?>
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Announcement List DataTable
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="datatablesSimple" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="cell">Image</th>
                                        <th class="cell">Content</th>
                                        <th class="cell">Date</th>
                                        <th class="text-right">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    include 'db_connect.php';
                                    $sql = "SELECT * from post_db ORDER BY post_date_time DESC";
                                    $result = $mysqli->query($sql);
                                    if (!$result) {
                                        die("Invalid query: " . $mysqli->error);
                                    }
                                    while ($row = $result->fetch_assoc()) {
                                    ?>
                                        <tr>
                                            <div class="text- center">
                                                <td><img src='<?php echo $row['post_image']; ?>' onclick="showImage('<?php echo $row['post_image']; ?>')" class='rounded mx-auto d-block' style='width:100px; height:100px;' /></td>
                                            </div>
                                            <td><?php echo $row['post_content']; ?></td>
                                            <td><?php echo date("M, d, Y", strtotime($row['post_date_time'])); ?></td>
                                            <td class='text-right'>
                                                <a href='#edit_<?php echo $row['post_id']; ?>' class='btn btn-success btn-sm' data-bs-toggle='modal'><i class='bi bi-pencil-square'></i> Edit</a>
                                                <a href='#delete_<?php echo $row['post_id']; ?>' class='btn btn-danger btn-sm' data-bs-toggle='modal'><i class='bi bi-trash'></i> Delete</a>
                                            </td>
                                        </tr>
                                        <?php include('modal_post.php'); ?>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                            </div>
                        </div>
                    </div>
                    <div class="overlay" onclick="hideImage()">
                        <img id="zoomedImage">
                    </div>
                </div>
            </main>
            <?php include 'footer.php' ?>
        </div>
    </div>
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Announcement</h5>
                    <button type="button" class="btn-close btn-sm" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="add_post.php" method="post" class="card-body" enctype="multipart/form-data" novalidate>
                        <div class="row clearfix">
                            <div class="col-md-12 col-sm-12 mb-3">
                                <div class="form-group">
                                    <label>Post Content</label>
                                    <input type="text" class="form-control" name="post_content">
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12 mb-3">
                                <div class="form-group">
                                    <label>Image</label>
                                    <input type="file" class="form-control mb-3" required name="image">
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
    <?php include 'script.php' ?>
</body>

</html>