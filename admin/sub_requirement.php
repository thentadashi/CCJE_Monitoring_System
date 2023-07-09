<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'head.php' ?>
    <title>Requirements</title>
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
                                <h1 class="mt-4">Submitted Requirements</h1>
                                <ol class="breadcrumb mb-4">
                                    <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                                    <li class="breadcrumb-item active">Tables</li>
                                </ol>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <form method="post" action="sub_requirement.php">
                                <button type="submit" class="btn btn-white border border-dark" name="sheet_table"><i class="bi bi-folder"></i> Personal Data Sheet</button>
                                <button type="submit" class="btn btn-white border border-dark" name="consent_table"><i class="bi bi-folder"></i> Parent Consent</button>
                                <button type="submit" class="btn btn-white border border-dark" name="phil_table"><i class="bi bi-folder"></i> PhilHealth ID</button>
                                <button type="submit" class="btn btn-white border border-dark" name="vac_table"><i class="bi bi-folder"></i> Certification of Vaccination</button>
                                <button type="submit" class="btn btn-white border border-dark" name="preg_table"><i class="bi bi-folder"></i> Medical Certificate</button>
                            </form>
                        </div>
                    </div>

                    <?php
                    include 'db_connect.php';
                    if (isset($_POST['consent_table'])) {
                    ?>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="datatablesSimple" class="table">
                                <thead>
                                    <tr>
                                        <th class="cell">ID</th>
                                        <th class="cell">Name</th>
                                        <th class="cell">File</th>
                                        <th class="cell">Submitted Date</th>
                                        <th class="cell">Approval Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = "SELECT * FROM parent_con_db JOIN student_enroll ON student_enroll.id=parent_con_db.std_id where student_enroll.status !='1';";
                                    $result = $mysqli->query($sql);
                                    if (!$result) {
                                        $_SESSION['errormessage'] = "Invalid query " . $mysqli->error;
                                    }
                                    if (mysqli_num_rows($result) > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                    ?>
                                            <tr>
                                                <td><?php echo $row['std_id']; ?></td>
                                                <td><?php echo $row['last_name'] . ", " . $row['first_name'] . " " . $row['middle_name'] . " " . $row['suffix_name']; ?></td>
                                                <div class="text- center">
                                                    <td><a href="<?php echo $row['file_path']; ?>" target="_blank"><?php echo $row['file_name']; ?></td>
                                                </div>
                                                <td><?php echo date("M, d, Y g:i a", strtotime($row['submit_date_time'])); ?></td>
                                                <td><?php echo date("M, d, Y g:i a", strtotime($row['date_time'])); ?></td>
                                            </tr>
                                    <?php
                                        }
                                    } else {
                                        echo "No results found.";
                                    }
                                    ?>
                                </tbody>
                            </table>
                            </div>
                            <div class="overlay" onclick="hideImage()">
                                <img id="zoomedImage">
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                    <?php
                    if (isset($_POST['sheet_table'])) {
                    ?>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="datatablesSimple" class="table">
                                <thead>
                                    <tr>
                                        <th class="cell">ID</th>
                                        <th class="cell">Name</th>
                                        <th class="cell">File</th>
                                        <th class="cell">Submitted Date</th>
                                        <th class="cell">Approval Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = "SELECT * FROM personal_sheet_db JOIN student_enroll ON student_enroll.id=personal_sheet_db.std_id where student_enroll.status !='1';";
                                    $result = $mysqli->query($sql);
                                    if (!$result) {
                                        $_SESSION['errormessage'] = "Invalid query " . $mysqli->error;
                                    }
                                    if (mysqli_num_rows($result) > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            ?>
                                            <tr>
                                                <td><?php echo $row['std_id']; ?></td>
                                                <td><?php echo $row['last_name'] . ", " . $row['first_name'] . " " . $row['middle_name'] . " " . $row['suffix_name']; ?></td>
                                                <div class="text- center">
                                                    <td><a href="<?php echo $row['file_path']; ?>" target="_blank"><?php echo $row['file_name']; ?></td>
                                                </div>
                                                <td><?php echo date("M, d, Y g:i a", strtotime($row['submit_date_time'])); ?></td>
                                                <td><?php echo date("M, d, Y g:i a", strtotime($row['date_time'])); ?></td>
                                            </tr>
                                    <?php
                                        }
                                    } else {
                                        echo "No results found.";
                                    }

                                    ?>
                                </tbody>
                            </table>
                            </div>
                            <div class="overlay" onclick="hideImage()">
                                <img id="zoomedImage">
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                    <?php
                    if (isset($_POST['phil_table'])) {
                    ?>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="datatablesSimple" class="table">
                                <thead>
                                    <tr>
                                        <th class="cell">ID</th>
                                        <th class="cell">Name</th>
                                        <th class="cell">File</th>
                                        <th class="cell">Submitted Date</th>
                                        <th class="cell">Approval Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = "SELECT * FROM philhealth_id_db JOIN student_enroll ON student_enroll.id=philhealth_id_db.std_id where student_enroll.status !='1';";
                                    $result = $mysqli->query($sql);
                                    if (!$result) {
                                        $_SESSION['errormessage'] = "Invalid query " . $mysqli->error;
                                    }
                                    if (mysqli_num_rows($result) > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            ?>
                                            <tr>
                                                <td><?php echo $row['std_id']; ?></td>
                                                <td><?php echo $row['last_name'] . ", " . $row['first_name'] . " " . $row['middle_name'] . " " . $row['suffix_name']; ?></td>
                                                <td><a href="<?php echo $row['file_path']; ?>" target="_blank"><?php echo $row['file_name']; ?></td>
                                                <td><?php echo date("M, d, Y g:i a", strtotime($row['submit_date_time'])); ?></td>
                                                <td><?php echo date("M, d, Y g:i a", strtotime($row['date_time'])); ?></td>
                                            </tr>
                                    <?php
                                        }
                                    } else {
                                        echo "No results found.";
                                    }

                                    ?>
                                </tbody>
                            </table>
                            </div>
                            <div class="overlay" onclick="hideImage()">
                                <img id="zoomedImage">
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                    <?php
                    if (isset($_POST['vac_table'])) {
                    ?>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="datatablesSimple" class="table">
                                <thead>
                                    <tr>
                                        <th class="cell">ID</th>
                                        <th class="cell">Name</th>
                                        <th class="cell">File</th>
                                        <th class="cell">Submitted Date</th>
                                        <th class="cell">Approval Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = "SELECT * FROM cer_vac_db JOIN student_enroll ON student_enroll.id=cer_vac_db.std_id where student_enroll.status !='1';";
                                    $result = $mysqli->query($sql);
                                    if (!$result) {
                                        $_SESSION['errormessage'] = "Invalid query " . $mysqli->error;
                                    }
                                    if (mysqli_num_rows($result) > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            ?>
                                            <tr>
                                                <td><?php echo $row['std_id']; ?></td>
                                                <td><?php echo $row['last_name'] . ", " . $row['first_name'] . " " . $row['middle_name'] . " " . $row['suffix_name']; ?></td>
                                                <div class="text- center">
                                                    <td><a href="<?php echo $row['file_path']; ?>" target="_blank"><?php echo $row['file_name']; ?></td>
                                                </div>
                                                <td><?php echo date("M, d, Y g:i a", strtotime($row['submit_date_time'])); ?></td>
                                                <td><?php echo date("M, d, Y g:i a", strtotime($row['date_time'])); ?></td>
                                            </tr>
                                    <?php
                                        }
                                    } else {
                                        echo "No results found.";
                                    }
                                    ?>
                                </tbody>
                            </table>
                            </div>
                            <div class="overlay" onclick="hideImage()">
                                <img id="zoomedImage">
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                    <?php
                    if (isset($_POST['preg_table'])) {
                    ?>
                        <div class="card-body">
                            <div class="table-responsive">
                                 <table id="datatablesSimple" class="table">
                                <thead>
                                    <tr>
                                        <th class="cell">ID</th>
                                        <th class="cell">Name</th>
                                        <th class="cell">File</th>
                                        <th class="cell">Submitted Date</th>
                                        <th class="cell">Approval Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = "SELECT * FROM pregnancy_db JOIN student_enroll ON student_enroll.id=pregnancy_db.std_id where student_enroll.status !='1';";
                                    $result = $mysqli->query($sql);
                                    if (!$result) {
                                        $_SESSION['errormessage'] = "Invalid query " . $mysqli->error;
                                    }
                                    if (mysqli_num_rows($result) > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            ?>
                                            <tr>
                                                <td><?php echo $row['std_id']; ?></td>
                                                <td><?php echo $row['last_name'] . ", " . $row['first_name'] . " " . $row['middle_name'] . " " . $row['suffix_name']; ?></td>
                                                <div class="text- center">
                                                    <td><a href="<?php echo $row['file_path']; ?>" target="_blank"><?php echo $row['file_name']; ?></td>
                                                </div>
                                                <td><?php echo date("M, d, Y g:i a", strtotime($row['submit_date_time'])); ?></td>
                                                <td><?php echo date("M, d, Y g:i a", strtotime($row['date_time'])); ?></td>
                                            </tr>
                                    <?php
                                        }
                                    } else {
                                        echo "No results found.";
                                    }
                                    ?>
                                </tbody>
                            </table>
                            </div>
                            <div class="overlay" onclick="hideImage()">
                                <img id="zoomedImage">
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </main>
        </div>

    </div>
    <div class="modal-footer">
        <?php include 'script.php' ?>
</body>

</html>