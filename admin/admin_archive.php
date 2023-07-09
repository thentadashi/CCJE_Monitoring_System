<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'head.php' ?>
    <title>Admin Archive List</title>
</head>

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
                                <h1 class="mt-4">Admin Archive List</h1>
                                <ol class="breadcrumb mb-4">
                                    <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                                    <li class="breadcrumb-item active">Tables</li>
                                </ol>
                                <div class="col-lg-4 col-md-6">
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php include('alert_message.php'); ?>
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Admin List DataTable
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="datatablesSimple" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="cell">Admin ID</th>
                                        <th class="cell">Admin Name</th>
                                        <th class="cell">Email</th>
                                        <th class="cell">Position</th>
                                        <th class="text-right">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    include 'db_connect.php';
                                    $sql = "SELECT * from admin_db WHERE status ='1' ORDER BY time_date DESC";
                                    $result = $mysqli->query($sql);
                                    if (!$result) {
                                        die("Invalid query: " . $mysqli->error);
                                    }
                                    while ($row = $result->fetch_assoc()) {
                                    ?>
                                        <tr>
                                            <td><?php echo $row['admin_id']; ?></td>
                                            <td><?php echo $row['admin_fname'] . " " . $row['admin_mname'] . " " . $row['admin_lname'] . " " . $row['admin_sname']; ?></td>
                                            <td><?php echo $row['admin_email']; ?></td>
                                            <td><?php echo $row['admin_position']; ?></td>
                                            <td class='text-right'>
                                                <a href='#edit_<?php echo $row['admin_id']; ?>' class='btn btn-success btn-sm' data-bs-toggle='modal'><i class='bi bi-pencil-square'></i> Edit</a>
                                                <a href='#unarchive_<?php echo $row['admin_id']; ?>' class='btn btn-warning btn-sm' data-bs-toggle='modal'><i class='bi bi-file-earmark-zip'></i> Unarchive</a>
                                            </td>
                                        </tr>
                                        <?php include('modal_admin.php'); ?>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
            <?php include 'footer.php' ?>
        </div>
        <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Admin</h5>
                        <button type="button" class="btn-close btn-sm" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="add_admin.php" method="post" class="card-body" novalidate>
                            <div class="row clearfix">
                            <input type="hidden" name="status" value="0">
                                <div class="col-md-12 col-sm-12 mb-3">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="Admin_Id" placeholder="ID OR USERNAME">
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12 mb-3">
                                    <div class="form-group">
                                        <input type="text" name="Admin_Lname" class="form-control" placeholder="SURNAME">
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12 mb-3">
                                    <div class="form-group">
                                        <input type="text" name="Admin_Fname" class="form-control" placeholder="FIRST NAME">
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12 mb-3">
                                    <div class="form-group">
                                        <input type="text" name="Admin_Mname" class="form-control" placeholder="MIDDLE NAME">
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12 mb-3">
                                    <div class="form-group">
                                        <select name="Admin_Sname" class="custom-select form-control">
                                            <option novalue disabled>SUFFIX NAME</option>
                                            <option value=" ">N/A</option>
                                            <option value="Jr">Jr</option>
                                            <option value="Sr">Sr</option>
                                            <option value="III">III</option>
                                            <option value="IV">IV</option>
                                            <option value="V">V</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12 mb-3">
                                    <div class="form-group">
                                        <input type="text" name="Admin_Position" class="form-control" placeholder="POSITION">
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12 mb-3">
                                    <div class="form-group">
                                        <input type="text" name="Admin_Email" class="form-control" placeholder="EMAIL">
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12 mb-3">
                                    <div class="form-group">
                                        <input type="password" name="Admin_Password" class="form-control" placeholder="PASSWORD">
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12 mb-3">
                                    <div class="form-group">
                                        <input type="password" name="Admin_Re-Password" class="form-control" placeholder="RE-TYPE PASSWORD">
                                    </div>
                                </div>
                                <div class="col-sm-12 mb-3">
                                    <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                                    <a href="admin.php" class="btn btn-outline-secondary btn-sm" title="">Cancel</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include 'script.php' ?>
</body>

</html>