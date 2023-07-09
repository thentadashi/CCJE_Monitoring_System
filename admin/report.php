<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'head.php' ?>
    <title>Attendance Report</title>
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
                                <h1 class="mt-4">Attendance Report</h1>
                                </h1>
                                <ol class="breadcrumb mb-4">
                                    <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                                    <li class="breadcrumb-item active">Tables</li>
                                </ol>
                            </div>
                            <div class="col-lg-5 col-md-6">
                                <button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#export" data-whatever="Team Leader">Export Data</button>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            Attendance Report
                        </div>
                        <div class="card-body">
                            <form method="get" action="report.php">
                                <div class="row clearfix">
                                    <div class="col-md-3 col-sm-12">
                                        <div class="form-group">
                                            <label class="mb-3">Station</label>
                                            <input name="stationid" autocomplete="off" list="sta_list" class="form-control">
                                            <datalist id="sta_list">
                                                <option value="" disabled selected></option>
                                                <?php
                                                include 'db_connect.php';
                                                $sql = "SELECT * FROM `station_info`";
                                                $result = $mysqli->query($sql);
                                                if (!$result) {
                                                    die("Invalid query: " . $mysqli->error);
                                                }
                                                while ($row = $result->fetch_assoc()) {
                                                ?>
                                                    <option value='<?php echo $row['sti_id']; ?>'><?php echo $row['sti_id'] . " - " . $row['sti_station'] . " - " . $row['sti_barangay'] . ", " . $row['sti_municipal'] . ", " . $row['sti_region']; ?></option>
                                                <?php

                                                }
                                                mysqli_close($mysqli);
                                                ?>
                                            </datalist>
                                        </div>
                                    </div>
                                    <!--<div class="col-md-1 col-sm-12">-->
                                    <!--    <div class="form-group">-->
                                    <!--        <label class="mb-3">Status</label>-->
                                    <!--        <input name="status" autocomplete="off" list="status_list" class="form-control">-->
                                    <!--        <datalist id="status_list">-->
                                    <!--            <option value="" disabled selected></option>-->
                                    <!--            <option value="all">All</option>-->
                                    <!--            </option>-->
                                    <!--            <option value="present">Present</option>-->
                                    <!--            <option value="absent">Absent</option>-->
                                    <!--            <option value="excuse">Excuse</option>-->
                                    <!--        </datalist>-->
                                    <!--    </div>-->
                                    <!--</div>-->
                                    <div class="col-md-3 col-sm-12">
                                        <div class="form-group">
                                            <label class="mb-3">Start Date</label>
                                            <input type="date" name="sdate" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-12">
                                        <div class="form-group">
                                            <label class="mb-3">End Date</label>
                                            <input type="date" name="edate" class="form-control">
                                        </div>
                                    </div>
                                    <br>
                                    <div class="col-sm-12 mb-3">
                                        <button type="submit" name="submit" class="btn btn-primary btn-sm">Go</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <?php
                        include 'db_connect.php';
                        if (!empty($_GET["stationid"])  || !empty($_GET['sdate'])) {
                            $station = $_GET["stationid"];
                            $sdate = $_GET['sdate'];
                            $edate = $_GET['edate'];
                            $sql2 = "SELECT *, date(attendance_qrcode.date_time) as att_date  FROM attendance_qrcode JOIN student_enroll ON student_enroll.id=attendance_qrcode.std_id JOIN station_info on station_info.sti_id=attendance_qrcode.sti_id WHERE student_enroll.status !='1' and  attendance_qrcode.sti_id='$station' AND attendance_qrcode.date_time BETWEEN '$sdate 00:00:00' AND '$edate 23:59:59'";
                            $result2 = $mysqli->query($sql2);
                            if (!$result2) {
                                $_SESSION['errormessage'] = "Invalid query " . $mysqli->error;
                                header("location: /CCJE_Monitoring_System/admin/report.php");
                            }

                            $_SESSION['successmessage'] = "Successful";
                            include('alert_message.php');
                        ?>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="datatablesSimple" class="table">
                                        <thead>
                                            <tr>
                                                <th class="cell">ID</th>
                                                <th class="cell">Name</th>
                                                <th class="cell">Station - Area</th>
                                                <th class="cell">Time In</th>
                                                <th class="cell">Time Out</th>
                                                <th class="cell">Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        if (mysqli_num_rows($result2) > 0) {
                                            while ($row2 = $result2->fetch_assoc()) {
                                                echo   "
                                                                            <tr>
                                                                            <td>$row2[std_id]</td>
                                                                            <td>$row2[last_name], $row2[first_name] $row2[middle_name]  $row2[suffix_name]</td>
                                                                            <td>$row2[sti_id] - $row2[sti_station], $row2[sti_barangay], $row2[sti_municipal], $row2[sti_region]</td>
                                                                            <td>".date('H:i:s a',strtotime($row2['time_in']))."</td>
                                                                            <td>".date('H:i:s a',strtotime($row2['time_in']))."</td>
                                                                            <td>" . date("M, d, Y", strtotime($row2['att_date']));
                                                "</td>
                                                                            </tr>
                                                ";
                                            }
                                        } else {
                                            echo "No results found.";
                                        }
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
                                        <label>Start of day</label>
                                        <input type="date" class="form-control form-control-sm" name="startweek">
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12 mb-3">
                                    <div class="form-group">
                                        <label>End of day</label>
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