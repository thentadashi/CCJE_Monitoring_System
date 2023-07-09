<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'head.php' ?>
    <title>Attendance</title>
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
                                <h1 class="mt-4">Attendance</h1>
                                <ol class="breadcrumb mb-4">
                                    <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                                    <li class="breadcrumb-item active">Tables</li>
                                </ol>
                                <div class="col-lg-5 col-md-6">
                                    <button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#export" data-whatever="Team Leader">Export Data</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-message me-1"></i>
                            Attendance table
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th class="cell">Student ID</th>
                                        <th class="cell">Fullname</th>
                                        <th class="cell">Station</th>
                                        <th class="cell">Status</th>
                                        <th class="cell">Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    include 'db_connect.php';
                                    $sql = "SELECT * FROM attendance JOIN student_enroll on attendance.std_id=student_enroll.id JOIN station_info on attendance.sti_id=station_info.sti_id where student_enroll.status !='1' ORDER BY att_date DESC;";
                                    $result = $mysqli->query($sql);
                                    if (!$result) {
                                        die("Invalid query: " . $mysqli->error);
                                    }
                                    while ($row = $result->fetch_assoc()) {
                                    ?>

                                        <tr>
                                            <td><?php echo $row['std_id']; ?></td>
                                            <td><?php echo $row['last_name'] . ", " . $row['first_name'] . " " . $row['middle_name'] . " " . $row['suffix_name']; ?></td>
                                            <td><?php echo $row['sti_station'] . " - " .$row['sti_barangay'] . ", " . $row['sti_municipal'] . ", " . $row['sti_region']; ?></td>
                                            <td><?php echo $row['att_attend']; ?></td>
                                            <td><?php echo date( "M, d, Y g:i a" ,strtotime($row['att_date'])); ?></td>
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
            </main>
        </div>
        <div class="modal fade" id="export" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Export data</h5>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="export_att.php" method="POST" class="card-body" validate>
                            <div class="row clearfix">
                                <div class="col-md-12 col-sm-6 mb-2">
                                    <div class="form-group">
                                        <label>Station Designated</label>
                                        <input name="station_id" autocomplete="off" list="station_list2" class="form-control">
                                        <datalist id="station_list2">
                                            <option class="align-center" disabled selected> Station</option>
                                            <?php
                                            include 'db_connect.php';
                                            $sql2 = "SELECT * from station_info ";
                                            $result2 = $mysqli->query($sql2);
                                            if (!$result2) {
                                                die("Invalid query: " . $mysqli->error);
                                            }
                                            while ($row2 = $result2->fetch_assoc()) {
                                                echo "
                                                            <option value='$row2[sti_id]'>$row2[sti_station]" . " - " . "$row2[sti_lname] $row2[sti_fname] $row2[sti_mname] $row2[sti_sname]
                                                            " . " - " . "$row2[sti_region] $row2[sti_municipal] $row2[sti_barangay]</option>";
                                            }
                                            ?>
                                        </datalist>
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
                                <div class="col-sm-12 mb-3">
                                    <button type="submit" name="export" class="btn btn-danger">Export</button>
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