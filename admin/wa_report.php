<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'head.php' ?>
    <title>Weekly Report</title>
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
                                <h1 class="mt-4">Weekly Report</h1>
                                </h1>
                                <ol class="breadcrumb mb-4">
                                    <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                                    <li class="breadcrumb-item active">Tables</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            Weekly Narrative Report
                        </div>
                        <div class="card-body">
                            <form method="get" action="wa_report.php">
                                <div class="row clearfix">
                                    <div class="col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label class="mb-3">ID - Student Name</label>
                                            <input  name="student" autocomplete="off" list="student_list" class="form-control">
                                            <datalist id="student_list">
                                                <option value="" disabled selected></option>
                                                <?php
                                                include 'db_connect.php';
                                                $sql3 = "SELECT * from student_enroll where status !='1'";
                                                $result3 = $mysqli->query($sql3);
                                                if (!$result3) {
                                                    die("Invalid query: " . $mysqli->error);
                                                }
                                                while ($row3 = $result3->fetch_assoc()) {
                                                ?>

                                                    <option value='<?php echo $row3['id']; ?>'><?php echo $row3['id'] . " - " . $row3['last_name'] . ", " . $row3['first_name'] . " " . $row3['middle_name'] . " " . $row3['suffix_name']; ?></option>

                                                <?php
                                                }
                                                ?>
                                            </select>
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
                        if (!empty($_GET["student"])) {
                            $student = $_GET["student"];
                        ?>
                            <?php
                            $_SESSION['successmessage'] = "Successful";
                            include('alert_message.php');
                            ?>
                            <div class="container">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-table me-1"></i>
                                        Personal Data Sheet
                                    </div>
                                    <?php
                                    $sql2 = "SELECT * FROM week_accom JOIN student_enroll ON student_enroll.id=week_accom.std_id  WHERE week_accom.std_id='$student' ;";
                                    $result2 = $mysqli->query($sql2);
                                    if (!$result2) {
                                        $_SESSION['errormessage'] = "Invalid query " . $mysqli->error;
                                    }
                                    ?>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                <table id="datatablesSimple" class="table">
                                            <thead>
                                                <tr>
                                                    <th class="cell">Student ID</th>
                                                    <th class="cell">Student Name</th>
                                                    <th class="cell">File</th>
                                                    <th class="cell">Start-End of Week Date</th>
                                                    <th class="cell">Submitted Date</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                while ($row2 = $result2->fetch_assoc()) {
                                                ?>
                                                    <tr>
                                                        <td><?php echo $row2['std_id']; ?></td>
                                                        <td><?php echo $row2['last_name'] . ", " . $row2['first_name'] . " " . $row2['middle_name'] . " " . $row2['suffix_name']; ?></td>
                                                            <td><a href="<?php echo $row2['file_path']; ?>" target="_blank"><?php echo $row2['file_name']; ?></td>
                                                        <td><?php echo date("M, d, Y", strtotime($row2['start_week']))   . " - " . date("M, d, Y", strtotime($row2['end_week'])); ?></td>
                                                        <td><?php echo date("M, d, Y g:i a", strtotime($row2['date_time'])); ?></td>
                                                    </tr>
                                                <?php
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="overlay" onclick="hideImage()">
                                    <img id="zoomedImage">
                                </div>
                            </div>
                        <?php
                        }
                        ?>

                    </div>
                </div>
            </main>
        </div>
    </div>
    <?php include 'script.php' ?>
</body>

</html>