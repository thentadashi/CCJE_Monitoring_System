<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'head.php' ?>
    <title>Student Station Assign</title>
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
                                <h1 class="mt-4">Student Station Tables</h1>
                                <ol class="breadcrumb mb-4">
                                    <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                                    <li class="breadcrumb-item active">Tables</li>
                                </ol>
                                <div class="col-lg-4 col-md-6">
                                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addModal" data-whatever="Team Leader">Add Sudent Station</button>
                                    <button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#export" data-whatever="Team Leader">Export Data</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php include('alert_message.php'); ?>
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Station DataTable
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="datatablesSimple" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="cell">Student ID</th>
                                            <th class="cell">Student Name</th>
                                            <th class="cell">Supervisor Name</th>
                                            <th class="cell">Assign Date</th>
                                            <th class="cell">Station - Area</th>
                                            <th class="cell">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        include 'db_connect.php';
                                        $sql = "SELECT * FROM student_station JOIN student_enroll on student_station.s_id=student_enroll.id JOIN station_info ON student_station.sti_id=station_info.sti_id where student_enroll.status !='1' and station_info.s_status !='1' ORDER BY s_assign_date DESC;";
                                        $result = $mysqli->query($sql);
                                        if (!$result) {
                                            die("Invalid query: " . $mysqli->error);
                                        }
                                        while ($row = $result->fetch_assoc()) {
                                        ?>
                                            <tr>
                                                <td><?php echo $row['id']; ?></td>
                                                <td><?php echo $row['last_name'] . ", " . $row['first_name'] . " " . $row['middle_name'] . " " . $row['suffix_name']; ?></td>
                                                <td><?php echo $row['sti_lname'] . ", " . $row['sti_fname'] . " " . $row['sti_mname'] . " " . $row['sti_sname']; ?></td>
                                                <td><?php echo date("M, d, Y", strtotime($row['s_assign_date'])); ?></td>
                                                <td><?php echo $row['sti_region'] . ", " . $row['sti_municipal'] . ", " . $row['sti_barangay']; ?></td>
                                                <td class='text-right'>
                                                    <a href='#edit_<?php echo $row['s_id']; ?>' class='btn btn-success btn-sm' data-bs-toggle='modal'><i class='bi bi-pencil-square'></i> Edit</a>
                                                    <a href='#delete_<?php echo $row['s_id']; ?>' class='btn btn-danger btn-sm' data-bs-toggle='modal'><i class='bi bi-trash'></i> Delete</a>
                                                </td>
                                            </tr>
                                            <?php include('modal_station_assign.php'); ?>
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
    </div>
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Student Station</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="add_student_station.php" method="post" class="card-body" novalidate>
                        <div class="row clearfix">
                            <div class="col-md-12 col-sm-12 mb-3">
                                <div class="form-group">
                                    <label>ID - Student name</label>
                                    <input name="user_id" autocomplete="off" list="student_list" class="form-control">
                                    <datalist id="student_list">
                                        <option class="align-center" disabled selected> ID - Student name</option>
                                        <?php
                                        include 'db_connect.php';
                                        $sql = "SELECT * from student_enroll join student_information on student_information.std.id = student_enroll.id where student_enroll.status !='1' ";
                                        $result = $mysqli->query($sql);
                                        if (!$result) {
                                            die("Invalid query: " . $mysqli->error);
                                        }
                                        while ($row = $result->fetch_assoc()) {
                                        ?>
                                            
                                            <option value='<?php echo $row['id']?>'>
                                            <?php echo $row['last_name'] ?>
                                        </option>
                                           
                                        <?php
                                        }
                                        ?>
                                    </datalist>
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12 mb-3">
                                <div class="form-group">
                                    <label>Station Designated</label>
                                    <input name="station_id" autocomplete="off" list="station_list" class="form-control">
                                    <datalist id="station_list">
                                        <option class="align-center" disabled selected> Station</option>
                                        <?php
                                        include 'db_connect.php';
                                        $sql2 = "SELECT * from station_info where s_status !='1'";
                                        $result2 = $mysqli->query($sql2);
                                        if (!$result2) {
                                            die("Invalid query: " . $mysqli->error);
                                        }
                                        while ($row2 = $result2->fetch_assoc()) {
                                            $count = $row2['sti_id'];
                                            $pdsQuery = "SELECT * from student_station where sti_id= $count";
                                            $pds = count($mysqli->query($pdsQuery)->fetch_all(MYSQLI_ASSOC));
                                            echo "
                                                            <option value='$row2[sti_id]'> $pds - $row2[sti_station]" . " - " . "$row2[sti_lname] $row2[sti_fname] $row2[sti_mname] $row2[sti_sname]
                                                            " . " - " . "$row2[sti_region] $row2[sti_municipal] $row2[sti_barangay]</option>";
                                        }
                                        ?>
                                    </datalist>
                                </div>
                            </div>
                            <br>
                            <div class="col-sm-12 mb-3">
                                <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                                <a href="student_station_assign.php" class="btn btn-outline-secondary btn-sm" title="">Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
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
                    <form action="export_st_station.php" method="POST" class="card-body" validate>
                        <div class="row clearfix">
                            <div class="col-md-12 col-sm-6 mb-2">
                                <div class="form-group">
                                    <label>Station Designated</label>
                                    <input name="station_id" autocomplete="off" list="station_list2" class="form-control">
                                    <datalist id="station_list2">
                                        <option class="align-center" disabled selected> Station</option>
                                        <?php
                                        include 'db_connect.php';
                                        $sql2 = "SELECT * from station_info where s_status !='1'";
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
                            <div class="col-sm-12 mb-3">
                                <button type="submit" name="export" class="btn btn-danger">Export</button>
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