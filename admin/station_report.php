<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'head.php' ?>
    <title>Student Station Report</title>
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
                                <h1 class="mt-4">Student Station Report</h1>
                                </h1>
                                <ol class="breadcrumb mb-4">
                                    <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                                    <li class="breadcrumb-item active">Tables</li>
                                </ol>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                    <button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#export" data-whatever="Team Leader">Export Data</button>
                                </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            Student Station Report
                        </div>
                        <div class="card-body">
                            <form method="get" action="station_report.php">
                                <div class="row clearfix">
                                    <div class="col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label class="mb-3">Station</label>
                                            <input  name="station" autocomplete="off" list="block_list2" class="form-control">
                                            <datalist id="block_list2">
                                                <option value="" disabled selected></option>
                                                <?php
                                                include 'db_connect.php';
                                                $sql3 = "SELECT * from station_info where s_status !='1'";
                                                $result3 = $mysqli->query($sql3);
                                                if (!$result3) {
                                                    die("Invalid query: " . $mysqli->error);
                                                }
                                                while ($row3 = $result3->fetch_assoc()) {
                                                ?>
                                                    <option value='<?php echo $row3['sti_id']; ?>'><?php echo $row3['sti_station'] . " - " . $row3['sti_lname'] . ", " . $row3['sti_fname'] . " " . $row3['sti_mname'] . " " . $row3['sti_sname'] . " - " . $row3['sti_barangay'] . ", " . $row3['sti_municipal'] . ", " . $row3['sti_region']; ?></option>
                                                <?php
                                                }
                                                ?>
                                            </datalist>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="col-sm-12 mb-3">
                                        <button type="submit" class="btn btn-primary btn-sm">Go</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <?php
                        include 'db_connect.php';
                        if (!empty($_GET["station"]) ) {
                            $station = $_GET["station"];
                            $sql2 = "SELECT * FROM student_station JOIN student_enroll ON student_enroll.id=student_station.s_id JOIN station_info on station_info.sti_id=student_station.sti_id WHERE student_enroll.status !='1' AND student_station.sti_id='$station' ;";
                            $result2 = $mysqli->query($sql2);
                            if (!$result2) {
                                $_SESSION['errormessage'] = "Invalid query " . $mysqli->error;
                                header("location: /CCJE_Monitoring_System/admin/station_report.php");
                            }
                        ?>
                            <?php
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
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    if (mysqli_num_rows($result2) > 0) {
                                        while ($row2 = $result2->fetch_assoc()) {
                                            echo   "
                                                                            <tr>
                                                                            <td>$row2[s_id]</td>
                                                                            <td>$row2[last_name], $row2[first_name] $row2[middle_name]  $row2[suffix_name]</td>
                                                                            
                                                                            <td>$row2[sti_id] - $row2[sti_station], $row2[sti_barangay], $row2[sti_municipal], $row2[sti_region]</td>
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
            </main>
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