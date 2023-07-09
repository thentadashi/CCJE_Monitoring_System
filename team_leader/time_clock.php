<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Time Clock</title>
    <?php include 'head.php' ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/css/bootstrap.min.css">
</head>

<body class="sb-nav-fixed">
    <div class="container-fluid">
        <?php include 'header.php' ?>
        <div id="layoutSidenav">
            <?php include 'nav.php' ?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <div class="card bg-white mb-2">
                            <div class="card-body">
                                <div class="align-self-center">
                                    <h1 class="mt-4">Time Clock</h1>
                                    <ol class="breadcrumb mb-4">
                                        <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                                        <li class="breadcrumb-item active">Tables</li>
                                    </ol>
                                    <div class="col-lg-5 col-md-6 mb-3">
                                        <button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#export" data-whatever="Team Leader">Export Data</button>
                                    </div>
                                </div>
                                <div class="alert-message">
                                    <!-- Include your alert message code here -->
                                </div>
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-table me-1"></i>
                                        Time Clock
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-12 px-2 py-2">
                                                <div class="card bg-primary">
                                                    <div class="card-body">
                                                        <h2 class="text-center text-white"><?php echo date("D, d M Y H:i:s a"); ?></h2>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div id="scan">
                                                    <video id="video" width="100%" height="auto"></video>
                                                    <div id="scan-result"></div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="table-responsive">
                                                    <table id="datatablesSimple" class="table table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th class="cell">ID</th>
                                                                <th class="cell">Name</th>
                                                                <th class="cell">Time In</th>
                                                                <th class="cell">Time Out</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            include '../database/db_connect.php';
                                                            $stt = $_SESSION["userstation"];
                                                            $sql = "SELECT * FROM attendance_qrcode JOIN student_enroll on student_enroll.id=attendance_qrcode.std_id WHERE attendance_qrcode.sti_id= '$stt' ORDER BY date_time DESC ;";
                                                            $result = $mysqli->query($sql);
                                                            if (!$result) {
                                                                die("Invalid query: " . $mysqli->error);
                                                            }
                                                            while ($row = $result->fetch_assoc()) {
                                                            ?>
                                                                <tr>
                                                                    <td class=""><?php echo $row['std_id'] ?></td>
                                                                    <td class=""><?php echo $row['last_name'] . ", " .  $row['first_name'] . " " .  $row['middle_name'] . " " .  $row['suffix_name'] ?></td>
                                                                    <td><?php echo date("H:i a", strtotime($row['time_in'])) ?></td>
                                                                    <td><?php echo date("H:i a", strtotime($row['time_out'])) ?></td>
                                                                </tr>
                                                            <?php } ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
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
                                <form action="export_proccess/export_dtr_student.php" method="POST" class="card-body" validate>
                                    <div class="row clearfix">
                                        <div class="col-md-12 col-sm-6 mb-2">
                                            <div class="form-group">
                                                <label>Student name</label>
                                                <select type="text" name="id" class="form-control" required>
                                                    <option></option>
                                                    <?php
                                                    include '../database/db_connect.php';
                                                    $stt = $_SESSION["userstation"];
                                                    $sql = "SELECT * from student_station JOIN student_enroll ON student_station.s_id=student_enroll.id where student_enroll.status !='1' and student_station.sti_id=$stt;";
                                                    $result = $mysqli->query($sql);
                                                    if ($result->num_rows > 0) {
                                                        // output data of each row
                                                        while ($row = $result->fetch_assoc()) {
                                                    ?>
                                                            <option value='<?php echo $row['id'] ?>'><?php echo  $row['id'] . " - " . $row['last_name'] . "  " . $row['first_name'] . "  " . $row['middle_name'] . "  " . $row['suffix_name'] ?></option>
                                                    <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label class="mb-3">Start date</label>
                                                <input type="date" name="sdate" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label class="mb-3">End date</label>
                                                <input type="date" name="edate" class="form-control">
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

            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/js/bootstrap.bundle.min.js"></script>
            <script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>

            <script>
                // Access the camera and scan QR codes
                let scanner = new Instascan.Scanner({
                    video: document.getElementById('video')
                });

                // Handle scanned QR codes
                scanner.addListener('scan', function(content) {
                    // Display the scanned data
                    document.getElementById('scan-result').innerHTML = "Scanned Data: " + content;

                    // Perform necessary actions based on the scanned data (e.g., query the database)
                    // Make an AJAX request to the server to process the scanned data
                    $.ajax({
                        type: "POST",
                        url: "process_qrcode.php",
                        data: {
                            scannedData: content
                        },
                        success: function(response) {
                            console.log(response);
                            // Handle the response from the server
                            // You can update the page or perform other actions as needed
                            alert(response.message);
                            // Refresh the page after a successful scan
                            window.location.href = window.location.href;
                        },
                        error: function(xhr, status, error) {
                            console.error("AJAX request failed. Error: " + error);
                        }
                    });
                });

                // Start the camera and scanning process
                Instascan.Camera.getCameras().then(function(cameras) {
                    if (cameras.length > 0) {
                        scanner.start(cameras[0]);
                    } else {
                        console.error("No cameras found.");
                    }
                }).catch(function(error) {
                    console.error("Error accessing camera: ", error);
                });
            </script>
            <?php include 'script.php' ?>
</body>

</html>