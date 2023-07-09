<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'head.php' ?>
    <title>Weekly Report Tables</title>
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
                                <h1 class="mt-4">My Weekly Reports</h1>
                                <ol class="breadcrumb mb-4">
                                    <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                                    <li class="breadcrumb-item active">Tables</li>
                                </ol>
                                <div class="col-lg-4 col-md-6">
                                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addModal">Add Weekly Report </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php include('alert_message.php'); ?>
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Weekly Report DataTable
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="datatablesSimple" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="cell">Student ID</th>
                                        <th class="cell">Student Name</th>
                                        <th class="cell">File</th>
                                        <th class="cell">Start-End of Week Date</th>
                                        <th class="cell">Submitted Date</th>
                                        <th class="cell">Approve Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    include '../database/db_connect.php';
                                    $stdid = $_SESSION["user"];
                                    $sql = "SELECT * FROM week_accom JOIN student_enroll on week_accom.std_id=student_enroll.id where student_enroll.status !='1' AND student_enroll.id ='$stdid'  ORDER BY week_accom.date_time DESC;";
                                    $result = $mysqli->query($sql);
                                    if (!$result) {
                                        die("Invalid query: " . $mysqli->error);
                                    }
                                    while ($row = $result->fetch_assoc()) {
                                    ?>
                                        <tr>
                                            <td><?php echo $row['std_id']; ?></td>
                                            <td><?php echo $row['last_name'] . ", " . $row['first_name'] . " " . $row['middle_name'] . " " . $row['suffix_name']; ?></td>
                                            <div class="text- center">
                                            <td><a href="<?php echo $row['file_path']; ?>" target="_blank"><?php echo $row['file_name']; ?></a></td>
                                            </div>
                                            <td><?php echo date( "M, d, Y" ,strtotime($row['start_week']))   . " - " .date( "M, d, Y" ,strtotime($row['end_week'])) ; ?></td>
                                            <td><?php echo date( "M, d, Y g:i a" ,strtotime($row['submit_date_time'])); ?></td>
                                            <td><?php echo date( "M, d, Y g:i a" ,strtotime($row['date_time'])); ?></td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="overlay" onclick="hideImage()">
                            <img id="zoomedImage">
                        </div>
            </main>
            <?php include 'footer.php' ?>
        </div>
    </div>
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Weekly Accomplishment</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="add_proccess/add_week_accom.php" method="post" class="card-body" enctype="multipart/form-data" novalidate>
                        <div class="row clearfix">
                            <div class="col-md-12 col-sm-12 mb-3">
                                <div class="form-group">
                                    <label>Insert a PDF file here. </label>
                                    <input type="file" class="form-control form-control-sm" name="pdfFile" accept=".pdf" required>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12 mb-3">
                                <div class="form-group">
                                    <label>Start of week</label>
                                    <input type="date" class="form-control form-control-sm" name="startweek">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12 mb-3">
                                <div class="form-group">
                                    <label>End of week</label>
                                    <input type="date" class="form-control form-control-sm" name="endweek">
                                </div>
                            </div>
                            <br>
                            <div class="col-sm-12 mb-3">
                                <button type="submit" name="submit" value="submit" class="btn btn-primary btn-sm">Submit</button>
                                <a href="week_accom.php" class="btn btn-outline-secondary btn-sm" title="">Cancel</a>
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