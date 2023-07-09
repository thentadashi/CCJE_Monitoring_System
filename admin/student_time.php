<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'head.php' ?>
    <title>Time Sheet</title>
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
                                <h1 class="mt-4">Attendance Time Sheet</h1>
                                <ol class="breadcrumb mb-4">
                                    <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                                    <li class="breadcrumb-item active">Tables</li>
                                </ol>
                                <div class="col-lg-12 col-md-6">
                                    <form method="Post" action="student_time.php">
                                        <div class="row clearfix">
                                            <div class="col-md-2 col-sm-12">
                                                <div class="form-group">
                                                    <label class="mb-3">Block</label>
                                                    <input name="block" autocomplete="off" list="block_list" class="form-control">
                                                    <datalist id="block_list">
                                                        <option value="" disabled selected></option>
                                                        <option value="all">All</option>
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                        <option value="6">6</option>
                                                        <option value="7">7</option>
                                                        <option value="8">8</option>
                                                        <option value="9">9</option>
                                                        <option value="10">10</option>
                                                        <option value="11">11</option>
                                                        <option value="12">12</option>
                                                        <option value="13">13</option>
                                                        <option value="14">14</option>
                                                        <option value="15">15</option>
                                                    </datalist>
                                                </div>
                                            </div>
                                            <div class="col-md-2 col-sm-12">
                                                <div class="form-group">
                                                    <label class="mb-3">Date</label>
                                                    <input type="date" name="date" class="form-control">
                                                 </div>
                                            </div>
                                            <div class="col-sm-12 py-1">
                                                <button type="submit" class="btn btn-primary btn-sm">Go</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-lg-4 col-md-6 py-3">
                                    
                                    <button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#export" data-whatever="Team Leader">Export Data</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php include 'alert_message.php' ?>
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Time Remaining
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="datatablesSimple" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="cell">ID</th>
                                            <th class="cell">Name</th>
                                            <th class="cell">Block</th>
                                            <th class="cell">Spend hours</th>
                                            <!--<th class="">Action</th>-->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        include 'db_connect.php';
                                        if (isset($_POST['block'])) {
                                        ?>
                                            <?php
                                            $block = $_POST['block'];
                                            $date=$_POST["date"];
                                            if ($block === "all") {
                                            ?>

                                                <?php
                                                $sql = "SELECT * FROM student_enroll WHERE student_enroll.status !='1' ORDER BY student_enroll.last_name ASC";
                                                $result = $mysqli->query($sql);

                                                if (!$result) {
                                                    die("Invalid query: " . $mysqli->error);
                                                }

                                                while ($row = $result->fetch_assoc()) {
                                                    $std = $row['id'];
                                                ?>
                                                    <tr>
                                                        <td><?php echo $std; ?></td>
                                                        <td><?php echo $row['last_name'] . ", " . $row['first_name'] . " " . $row['middle_name'] . " " . $row['suffix_name']; ?></td>
                                                        <td><?php echo $row['block']; ?></td>
                                                        <?php
                                                        $sqltime = "SELECT * FROM attendance_qrcode WHERE std_id= '$std' and date_time BETWEEN '$date 00:00:00' AND '$date 23:59:59' ;";
                                                        $resulttime = $mysqli->query($sqltime);
                                                        if ($resulttime->num_rows > 0) {
                                                            $timeValue = 0;
                                                            while ($time = $resulttime->fetch_assoc()) {
                                                                $timeValue += strtotime($time['spend']);
                                                            }
                                                            $hours = ($timeValue / 3600);
                                                            $minutes = ($timeValue / 60 % 60);
                                                            $seconds = ($timeValue % 60);
                                                            $days = ($hours / 24);
                                                            $hours = ($hours % 24);
                                                        ?>
                                                            <td><?php echo sprintf("%02d", $hours) . ":" . sprintf("%02d", $minutes) . ":" . sprintf("%02d", $seconds); ?> hours </td>
                                                        <?php
                                                        } else {
                                                        ?>
                                                            <td>0 hours </td>
                                                        <?php
                                                        }
                                                        ?>
                                                        <!--<td class='text-right'>-->
                                                        <!--    <a href='#edit_<?php echo $row['std_id']; ?>' class='btn btn-success btn-sm' data-bs-toggle='modal'><i class='bi bi-pencil-square'></i> Add Time Spend</a>-->
                                                        <!--</td>-->
                                                    </tr>
                                                    <?php include('modal_time.php'); ?>
                                                <?php
                                                }
                                                ?>
                                            <?php
                                            } else {
                                            ?>
                                                <?php
                                                $sql = "SELECT * FROM student_enroll  WHERE  student_enroll.status !='1' and  student_enroll.block = $block  ORDER BY student_enroll.last_name ASC";
                                                $result = $mysqli->query($sql);

                                                if (!$result) {
                                                    die("Invalid query: " . $mysqli->error);
                                                }

                                                while ($row = $result->fetch_assoc()) {
                                                    $std = $row['id'];
                                                ?>
                                                    <tr>
                                                        <td><?php echo $std; ?></td>
                                                        <td><?php echo $row['last_name'] . ", " . $row['first_name'] . " " . $row['middle_name'] . " " . $row['suffix_name']; ?></td>
                                                        <td><?php echo $row['block']; ?></td>
                                                        <?php
                                                        $sqltime = "SELECT * FROM attendance_qrcode WHERE attendance_qrcode.std_id= '$std' and date_time BETWEEN '$date 00:00:00' AND '$date 23:59:59' ;";
                                                        $resulttime = $mysqli->query($sqltime);
                                                        if ($resulttime->num_rows > 0) {
                                                            $timeValue = 0;
                                                            while ($time = $resulttime->fetch_assoc()) {
                                                                $timeValue += strtotime($time['spend']);
                                                            }
                                                            $hours = ($timeValue / 3600);
                                                            $minutes = ($timeValue / 60 % 60);
                                                            $seconds = ($timeValue % 60);
                                                            $days = ($hours / 24);
                                                            $hours = ($hours % 24);

                                                        ?>
                                                            <td><?php echo sprintf("%02d", $hours) . ":" . sprintf("%02d", $minutes) . ":" . sprintf("%02d", $seconds); ?> hours </td>
                                                        <?php
                                                        } else {
                                                        ?>
                                                            <td>0 hours </td>
                                                        <?php
                                                        }
                                                        ?>

                                                        <!--<td class='text-right'>-->
                                                        <!--    <a href='#edit_<?php echo $row['std_id']; ?>' class='btn btn-success btn-sm' data-bs-toggle='modal'><i class='bi bi-pencil-square'></i> Add Time Spend</a>-->
                                                        <!--</td>-->
                                                    </tr>
                                                    <?php include('modal_time.php'); ?>
                                                <?php
                                                }
                                                ?>
                                            <?php
                                            }
                                            ?>
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
                        <form action="export_st_time.php" method="POST" class="card-body" validate>
                            <div class="row clearfix">
                                <div class="col-md-12 col-sm-6 mb-2">
                                    <div class="form-group">
                                        <label>Block</label>
                                        <input name="block" autocomplete="off" list="block_list4" class="form-control">
                                        <datalist id="block_list4">
                                            <option value="" disabled selected></option>
                                            <option value="all">All</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                            <option value="11">11</option>
                                            <option value="12">12</option>
                                            <option value="13">13</option>
                                            <option value="14">14</option>
                                            <option value="15">15</option>
                                        </datalist>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12">
                                                <div class="form-group">
                                                    <label class="mb-3">Date</label>
                                                    <input type="date" name="date" class="form-control">
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