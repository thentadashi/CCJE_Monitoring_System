<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'head.php' ?>
    <title>Dashboard</title>
</head>

<body class="sb-nav-fixed">
    <?php include 'header.php' ?>
    <div id="layoutSidenav">
        <?php include 'nav.php' ?>
        <div id="layoutSidenav_content">
            <div id="layoutAuthentication">
                <div id="layoutAuthentication_content">
                    <main>
                        <?php include 'alert_message.php' ?>
                        <div class="d-flex justify-content-center container-fluid px-4">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class=" col-md-6">
                                        <div class="card text-white mb-4" style="background-color: #ae0000;">
                                            <div class="card-body">
                                                <div class="align-self-center">
                                                    <div>
                                                        <h4>Bulliten Board</h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                        include '../database/db_connect.php';
                                        if ($mysqli->connect_errno) {
                                            die("Connection error: " . $mysqli->connect_error);
                                        }
                                        $result = $mysqli->query("SELECT * FROM post_db ORDER BY post_id DESC");
                                        if (!$result) {
                                            die("Invalid query: " . $mysqli->error);
                                        }
                                        while ($row = $result->fetch_assoc()) {
                                            $img = $row['post_image'];
                                            $last_updated = $row["post_date_time"];
                                            $date = date("F d Y H:i:s.", strtotime($last_updated));
                                        ?>
                                            <div class="card mb-3">

                                                <div class="card-body">
                                                    <h5 class="card-title">Announcement</h5>
                                                    <p class="card-text"><?php echo $row['post_content']; ?></p>
                                                    <p class="card-text"><small class="text-muted"><?php echo $date; ?></small></p>
                                                </div>
                                                <img src="../admin/<?php echo $img ?>" class="card-img-top" alt="...">
                                            </div>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                    <div class=" col-md-6">
                                        <div class="card text-white mb-4" style="background-color: #ae0000;">
                                            <div class="card-body">
                                                <div class="align-self-center">
                                                    <div>
                                                        <h4>Assign Station</h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                        include '../database/db_connect.php';
                                        $user = $_SESSION["user"];
                                        $result2 = $mysqli->query("SELECT * FROM student_station Join station_info on station_info.sti_id=student_station.sti_id where student_station.s_id =$user");
                                        if (!$result2) {
                                            die("Invalid query: " . $mysqli->error);
                                        }
                                        while ($row2 = $result2->fetch_assoc()) {
                                            if (!empty($row2)) {
                                        ?>
                                                <div class="card mb-3">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-sm-4">
                                                                <h6 class="card-title">Student Type</h6>
                                                            </div>
                                                            <div class="col-sm-8">
                                                                <p class="text-muted mb-0">Team Leader</p>
                                                            </div>
                                                            <hr>
                                                            <div class="col-sm-4">
                                                                <h6 class="card-title">Station Type</h6>
                                                            </div>
                                                            <div class="col-sm-8">
                                                                <p class="text-muted mb-0"><?php echo $row2["sti_station"] ?></p>
                                                            </div>
                                                            <hr>
                                                            <div class="col-sm-4">
                                                                <h6 class="card-title">Supervisor</h6>
                                                            </div>
                                                            <div class="col-sm-8">
                                                                <p class="text-muted mb-0"><?php echo $row2["sti_lname"] . ", " . $row2["sti_fname"] . " " . $row2["sti_mname"] . " " . $row2["sti_sname"] ?></p>
                                                            </div>
                                                            <hr>
                                                            <div class="col-sm-4">
                                                                <h6 class="card-title">Address</h6>
                                                            </div>
                                                            <div class="col-sm-8">
                                                                <p class="text-muted mb-0"><?php echo $row2["sti_barangay"] . ", " . $row2["sti_municipal"] . ", " . $row2["sti_region"] ?></p>
                                                            </div>
                                                            <hr>
                                                            <div class="col-sm-4">
                                                                <h6 class="card-title">Assign Date</h6>
                                                            </div>
                                                            <div class="col-sm-8">
                                                                <p class="text-muted mb-0"><?php echo date("F d Y", strtotime($row2["s_assign_date"])) ?></p>
                                                            </div>
                                                            <hr>
                                                            <div class="col-sm-4">
                                                                <h6 class="card-title">Time Duration</h6>
                                                            </div>
                                                            <div class="col-sm-8">
                                                                <p class="text-muted mb-0">270 Hours</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php
                                            }
                                            if (empty($row2)) {
                                            ?>
                                                <div class="card mb-3">
                                                    <div class="card-body">
                                                        <h6 class="card-title">Not Deployed</h6>
                                                        <p class="text-muted mb-0">You are not deployed yet; please inform your OJT coordinator to be deployed.</p>
                                                    </div>
                                                </div>
                                        <?php
                                            }
                                        }
                                        ?>
                                        <div class="col-xl-12">
                                            <div class="card mb-4 ">
                                                <div class="card-header">
                                                    <i class="fas fa-calendar me-1"></i>
                                                    Calendar
                                                </div>
                                                <div class="card-body" style="height:520px; width:100%;">
                                                    <iframe src="../calendar/calendar-view.php" style="height: 100%;width:100%;" title="Iframe Example"></iframe>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </main>
                </div>
            </div>
        </div>
    </div>
    <?php include 'script.php' ?>
</body>

</html>