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
            <main>
                <div class="container-fluid px-4">
                    <div class="card bg-white mb-2">
                        <div class="card-body">
                            <div class="align-self-center">
                                <h1 class="mt-1 ">Dashboard</h1>
                                <ol class="breadcrumb mb-2">
                                    <li class="breadcrumb-item active">Dashboard</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 col-md-2">
                            <div class="card bg-primary text-white mb-2 border border-secondary">
                                <div class="card-body rounded">
                                    <div class="align-self-center">
                                        <i class="fa fa-user text-white fa-2x me-4"></i>
                                    </div>
                                    <div>
                                        <h6>STUDENT ENROLLED</h6>
                                        <?php
                                        include 'db_connect.php';
                                        $sql = "SELECT * from student_enroll where status !='1'";
                                        $result = $mysqli->query($sql);
                                        $count = mysqli_num_rows($result);
                                        if (!$result) {
                                            die("Invalid query: " . $mysqli->error);
                                        }
                                        echo "<h4 class='mb-0'>$count</h4>";
                                        ?>
                                    </div>
                                </div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-black stretched-link" href="student_table.php">View Details</a>
                                    <div class="small text-black"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-md-2">
                            <div class="card bg-warning text-black mb-2 border border-secondary">
                                <div class="card-body rounded">
                                    <div class="align-self-center">
                                        <i class="fa fa-users text-black fa-2x me-4"></i>
                                    </div>
                                    <div>
                                        <h6> TEAM LEADERS</h6>
                                        <?php
                                        include 'db_connect.php';
                                        $sql = "SELECT * from team_leader_student";
                                        $result = $mysqli->query($sql);
                                        $count = mysqli_num_rows($result);
                                        if (!$result) {
                                            die("Invalid query: " . $mysqli->error);
                                        }
                                        echo "<h4 class='mb-0'>$count</h4>";
                                        ?>
                                    </div>
                                </div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-black stretched-link" href="team_leader_table.php">View Details</a>
                                    <div class="small text-black"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-md-2">
                            <div class="card bg-danger text-white mb-2 border border-secondary">
                                <div class="card-body rounded">
                                    <div class="align-self-center">
                                        <i class="fa fa-building text-white fa-2x me-4"></i>
                                    </div>
                                    <div>
                                        <h6>STATION</h6>
                                        <?php
                                        include 'db_connect.php';
                                        $sql = "SELECT * from station_info";
                                        $result = $mysqli->query($sql);
                                        $count = mysqli_num_rows($result);
                                        if (!$result) {
                                            die("Invalid query: " . $mysqli->error);
                                        }
                                        echo "<h4 class='mb-0'>$count</h4>";
                                        ?>
                                    </div>
                                </div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-black stretched-link" href="station_info.php">View Details</a>
                                    <div class="small text-black"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card mb-4 border border-dark">
                                <div class="card-header">
                                    <i class="fas fa-chart-bar me-1"></i>
                                    Pie Chart Report
                                </div>
                                <?php
                                include 'db_connect.php';
                                if ($mysqli->connect_errno) {
                                    die("Connection error: " . $mysqli->connect_error);
                                }
                                $res = $mysqli->query("SELECT * FROM student_enroll where status !='1' ");
                                $num = mysqli_num_rows($res);
                                $res1 = $mysqli->query("SELECT * FROM team_leader_student");
                                $num1 = mysqli_num_rows($res1);
                                $attendance = array(
                                    "Student" => $num,
                                    "Team leader" => $num1,
                                );
                                ?>
                                <div class="card-body"><canvas id="myChart1" width="100%" height="40%"></canvas></canvas></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card mb-4 border border-dark">
                                <div class="card-header">
                                    <i class="fas fa-chart-bar me-1"></i>
                                    Bar Chart Report
                                </div>
                                <?php
                                include 'db_connect.php';
                                if ($mysqli->connect_errno) {
                                    die("Connection error: " . $mysqli->connect_error);
                                }
                                $result = $mysqli->query("SELECT * FROM personal_sheet_db");
                                $rows = mysqli_num_rows($result);
                                $result1 = $mysqli->query("SELECT * FROM parent_con_db ");
                                $rows1 = mysqli_num_rows($result1);
                                $result2 = $mysqli->query("SELECT * FROM philhealth_id_db ");
                                $rows2 = mysqli_num_rows($result2);
                                $result3 = $mysqli->query("SELECT * FROM cer_vac_db ");
                                $rows3 = mysqli_num_rows($result3);
                                $result4 = $mysqli->query("SELECT * FROM pregnancy_db");
                                $rows4 = mysqli_num_rows($result4);

                                $data = array($rows, $rows1, $rows2, $rows3, $rows4);
                                ?>
                                <div class="card-body"><canvas id="myChart" width="100%" height="36%"></canvas></canvas></div>
                            </div>
                        </div>
                        <div class="col-md-6">
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
                            include 'db_connect.php';
                            if ($mysqli->connect_errno) {
                                die("Connection error: " . $mysqli->connect_error);
                            }
                            $result = $mysqli->query("SELECT * FROM post_db ORDER BY post_date_time DESC");
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
                        <div class="col-md-6">
                            <div class="card mb-4 ">
                                <div class="card-header">
                                    <i class="fas fa-calendar me-1"></i>
                                    Calendar
                                </div>
                                <div class="card-body" style="height:1020px;width:100%;">
                                    <iframe src="../calendar/index.php" style="height:100%;width:100%;" title="Iframe Example"></iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
            <?php include 'footer.php' ?>
        </div>
    </div>
    <?php include 'script.php' ?>
    <script>
        var data = <?php echo json_encode($data); ?>;

        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ["Data Sheet", "Parent Consent", "PhilHealth ID", "Vaccine Card", "Medical Cert"],
                datasets: [{
                    label: 'Submitted Requirements',
                    data: data,
                    backgroundColor: [
                        '#0000b9',
                        '#0000b9',
                        '#0000b9',
                        '#0000b9',
                        '#0000b9'
                    ],
                    borderColor: [
                        '#000000',
                        '#000000',
                        '#000000',
                        '#000000',
                        '#000000'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            fontColor: "#000", // Dark gray
                            fontWeight: "bold", // Bold font
                            fontSize: 10 // Font size in pixels
                        }
                    }]
                },
                plugins: {
                    legend: {
                        labels: {
                            font: {
                                family: "Arial", // Font family
                                size: 16, // Font size in pixels
                                style: "bold", // Font style
                                color: "#000" // Font color
                            }
                        }
                    }
                }
            }
        });
    </script>
    <script>
        var attendanceData = <?php echo json_encode($attendance); ?>;

        var ctx = document.getElementById('myChart1').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: Object.keys(attendanceData),
                datasets: [{
                    label: 'Student',
                    data: Object.values(attendanceData),
                    backgroundColor: [
                        '#0000b9',
                        '#ff0000',

                    ],
                    borderColor: [
                        '#000000',
                        '#000000',
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Attendance Data'
                },
                animation: {
                    animateScale: true,
                    animateRotate: true
                }
            }
        });
    </script>
</body>

</html>