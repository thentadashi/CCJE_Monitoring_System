<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'head.php' ?>
    <title>Submission Report</title>
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
                                <h1 class="mt-4">Submission Report</h1>
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
                            Submission Report
                        </div>
                        <div class="card-body">
                            <form method="get" action="sub_report.php">
                                <div class="row clearfix">
                                    <div class="col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label class="mb-3">ID - Student Name</label>
                                            <input name="student" autocomplete="off" list="student_list" class="form-control">
                                            <datalist id="student_list">
                                                <option value="" disabled selected></option>
                                                <?php
                                                include 'db_connect.php';
                                                $sql3 = "SELECT * from student_enroll where status !='1' ";
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
                                            </datalist>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label class="mb-3">Submitted</label>
                                            <input name="file" autocomplete="off" list="req_list" class="form-control">
                                            <datalist id="req_list">
                                                <option value="" disabled selected></option>
                                                <option value="all">All</option>
                                                <option value="personal_sheet_db">Personal Data Sheet</option>
                                                <option value="parent_con_db">Parent Consent</option>
                                                <option value="philhealth_id_db">PhilHealth ID</option>
                                                <option value="cer_vac_db">Certification of Vaccination</option>
                                                <option value="pregnancy_db">Medical Certificate</option>
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
                        if (!empty($_GET["student"]) ||  !empty($_GET["file"])) {
                            $student = $_GET["student"];
                            $file = $_GET["file"];
                        ?>
                            <?php
                            if ($file == "all") {
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
                                        $sql2 = "SELECT * FROM personal_sheet_db JOIN student_enroll ON student_enroll.id=personal_sheet_db.std_id  WHERE student_enroll.status !='1' AND personal_sheet_db.std_id='$student' ;";
                                        $result2 = $mysqli->query($sql2);
                                        if (!$result2) {
                                            $_SESSION['errormessage'] = "Invalid query " . $mysqli->error;
                                        }
                                        ?>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th class="cell">ID</th>
                                                            <th class="cell">Name</th>
                                                            <th class="cell">File/Image</th>
                                                            <th class="cell">Submitted Date</th>
                                                            <th class="cell">Approval Date</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        if (mysqli_num_rows($result2) > 0) {
                                                            while ($row2 = $result2->fetch_assoc()) {
                                                        ?>
                                                                <tr>
                                                                    <td><?php echo $row2['std_id']; ?></td>
                                                                    <td><?php echo $row2['last_name'] . ", " . $row2['first_name'] . " " . $row2['middle_name'] . " " . $row2['suffix_name']; ?></td>
                                                                    <div class="text- center">
                                                                        <td><img src='<?php echo $row2['image1']; ?>' onclick="showImage('<?php echo $row2['image1']; ?>')" class='rounded mx-auto d-block' style='width:100px; height:100px;' /></td>
                                                                    </div>
                                                                    <td><?php echo date("M, d, Y g:i a", strtotime($row2['submit_date_time'])); ?></td>
                                                                    <td><?php echo date("M, d, Y g:i a", strtotime($row2['date_time'])); ?></td>
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
                                        </div>
                                    </div>
                                </div>
                                <div class="container">
                                    <div class="card mb-4">
                                        <div class="card-header">
                                            <i class="fas fa-table me-1"></i>
                                            Parent Consent
                                        </div>
                                        <?php
                                        $sql3 = "SELECT * FROM parent_con_db JOIN student_enroll ON student_enroll.id=parent_con_db.std_id  WHERE student_enroll.status !='1' AND parent_con_db.std_id='$student' ;";
                                        $result3 = $mysqli->query($sql3);
                                        if (!$result3) {
                                            $_SESSION['errormessage'] = "Invalid query " . $mysqli->error;
                                        }
                                        ?>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th class="cell">ID</th>
                                                            <th class="cell">Name</th>
                                                            <th class="cell">File/Image</th>
                                                            <th class="cell">Submitted Date</th>
                                                            <th class="cell">Approval Date</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        if (mysqli_num_rows($result3) > 0) {
                                                            while ($row3 = $result3->fetch_assoc()) {
                                                        ?>
                                                                <tr>
                                                                    <td><?php echo $row3['std_id']; ?></td>
                                                                    <td><?php echo $row3['last_name'] . ", " . $row3['first_name'] . " " . $row3['middle_name'] . " " . $row3['suffix_name']; ?></td>
                                                                    <div class="text- center">
                                                                        <td><img src='<?php echo $row3['image1']; ?>' onclick="showImage('<?php echo $row3['image1']; ?>')" class='rounded mx-auto d-block' style='width:100px; height:100px;' /></td>
                                                                    </div>
                                                                    <td><?php echo date("M, d, Y g:i a", strtotime($row3['submit_date_time'])); ?></td>
                                                                    <td><?php echo date("M, d, Y g:i a", strtotime($row3['date_time'])); ?></td>
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

                                        </div>
                                    </div>
                                </div>
                                <div class="container">
                                    <div class="card mb-4">
                                        <div class="card-header">
                                            <i class="fas fa-table me-1"></i>
                                            Philhealth ID
                                        </div>
                                        <?php
                                        $sql4 = "SELECT * FROM philhealth_id_db JOIN student_enroll ON student_enroll.id=philhealth_id_db.std_id  WHERE student_enroll.status !='1' AND philhealth_id_db.std_id='$student' ;";
                                        $result4 = $mysqli->query($sql4);
                                        if (!$result4) {
                                            $_SESSION['errormessage'] = "Invalid query " . $mysqli->error;
                                        }
                                        ?>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th class="cell">ID</th>
                                                            <th class="cell">Name</th>
                                                            <th class="cell">File/Image 1</th>
                                                            <th class="cell">File/Image 2</th>
                                                            <th class="cell">Submitted Date</th>
                                                            <th class="cell">Approval Date</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        if (mysqli_num_rows($result4) > 0) {
                                                            while ($row4 = $result4->fetch_assoc()) {
                                                        ?>
                                                                <tr>
                                                                    <td><?php echo $row4['std_id']; ?></td>
                                                                    <td><?php echo $row4['last_name'] . ", " . $row4['first_name'] . " " . $row4['middle_name'] . " " . $row4['suffix_name']; ?></td>
                                                                    <div class="text- center">
                                                                        <td><img src='<?php echo $row4['image1']; ?>' onclick="showImage('<?php echo $row4['image1']; ?>')" class='rounded mx-auto d-block' style='width:100px; height:100px;' /></td>
                                                                    </div>
                                                                    <div class="text- center">
                                                                        <td><img src='<?php echo $row4['image2']; ?>' onclick="showImage('<?php echo $row4['image2']; ?>')" class='rounded mx-auto d-block' style='width:100px; height:100px;' /></td>
                                                                    </div>
                                                                    <td><?php echo date("M, d, Y g:i a", strtotime($row4['submit_date_time'])); ?></td>
                                                                    <td><?php echo date("M, d, Y g:i a", strtotime($row4['date_time'])); ?></td>
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
                                        </div>
                                    </div>
                                </div>
                                <div class="container">
                                    <div class="card mb-4">
                                        <div class="card-header">
                                            <i class="fas fa-table me-1"></i>
                                            Certification of Vaccination
                                        </div>
                                        <?php
                                        $sql5 = "SELECT * FROM cer_vac_db JOIN student_enroll ON student_enroll.id=cer_vac_db.std_id  WHERE student_enroll.status !='1' AND cer_vac_db.std_id='$student' ;";
                                        $result5 = $mysqli->query($sql5);
                                        if (!$result5) {
                                            $_SESSION['errormessage'] = "Invalid query " . $mysqli->error;
                                        }
                                        ?>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th class="cell">ID</th>
                                                            <th class="cell">Name</th>
                                                            <th class="cell">File/Image</th>
                                                            <th class="cell">Submitted Date</th>
                                                            <th class="cell">Approval Date</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        if (mysqli_num_rows($result5) > 0) {
                                                            while ($row5 = $result5->fetch_assoc()) {
                                                        ?>
                                                                <tr>
                                                                    <td><?php echo $row5['std_id']; ?></td>
                                                                    <td><?php echo $row5['last_name'] . ", " . $row5['first_name'] . " " . $row5['middle_name'] . " " . $row5['suffix_name']; ?></td>
                                                                    <div class="text- center">
                                                                        <td><img src='<?php echo $row5['image1']; ?>' onclick="showImage('<?php echo $row5['image1']; ?>')" class='rounded mx-auto d-block' style='width:100px; height:100px;' /></td>
                                                                    </div>
                                                                    <td><?php echo date("M, d, Y g:i a", strtotime($row5['submit_date_time'])); ?></td>
                                                                    <td><?php echo date("M, d, Y g:i a", strtotime($row5['date_time'])); ?></td>
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
                                        </div>
                                    </div>
                                </div>
                                <div class="container">
                                    <div class="card mb-4">
                                        <div class="card-header">
                                            <i class="fas fa-table me-1"></i>
                                            Medical Certificate
                                        </div>
                                        <?php
                                        $sql6 = "SELECT * FROM pregnancy_db JOIN student_enroll ON student_enroll.id=pregnancy_db.std_id  WHERE student_enroll.status !='1' AND pregnancy_db.std_id='$student' ;";
                                        $result6 = $mysqli->query($sql6);
                                        if (!$result6) {
                                            $_SESSION['errormessage'] = "Invalid query " . $mysqli->error;
                                        }
                                        ?>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th class="cell">ID</th>
                                                            <th class="cell">Name</th>
                                                            <th class="cell">File/Image</th>
                                                            <th class="cell">Submitted Date</th>
                                                            <th class="cell">Approval Date</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        if (mysqli_num_rows($result6) > 0) {
                                                            while ($row6 = $result6->fetch_assoc()) {
                                                        ?>
                                                                <tr>
                                                                    <td><?php echo $row6['std_id']; ?></td>
                                                                    <td><?php echo $row6['last_name'] . ", " . $row6['first_name'] . " " . $row6['middle_name'] . " " . $row6['suffix_name']; ?></td>
                                                                    <div class="text- center">
                                                                        <td><img src='<?php echo $row6['image1']; ?>' onclick="showImage('<?php echo $row6['image1']; ?>')" class='rounded mx-auto d-block' style='width:100px; height:100px;' /></td>
                                                                    </div>
                                                                    <td><?php echo date("M, d, Y g:i a", strtotime($row6['submit_date_time'])); ?></td>
                                                                    <td><?php echo date("M, d, Y g:i a", strtotime($row6['date_time'])); ?></td>
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
                                        </div>
                                    </div>
                                </div>
                                <div class="overlay" onclick="hideImage()">
                                    <img id="zoomedImage">
                                </div>
                            <?php
                            }
                            ?>
                            <?php
                            if ($file == "cer_vac_db" or $file == "pregnancy_db" or $file == "parent_con_db" or $file == "personal_sheet_db") {
                            ?>
                                <div class="container">
                                    <div class="card mb-4">
                                        <div class="card-header">
                                            <i class="fas fa-table me-1"></i>
                                            List Submitted
                                        </div>
                                        <?php
                                        $sql2 = "SELECT * FROM $file JOIN student_enroll ON student_enroll.id=$file.std_id  WHERE student_enroll.status !='1' AND $file.std_id='$student' ;";
                                        $result2 = $mysqli->query($sql2);
                                        if (!$result2) {
                                            $_SESSION['errormessage'] = "Invalid query " . $mysqli->error;
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
                                                            <th class="cell">File/Image</th>
                                                            <th class="cell">Submitted Date</th>
                                                            <th class="cell">Approval Date</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        if (mysqli_num_rows($result2) > 0) {
                                                            while ($row2 = $result2->fetch_assoc()) {
                                                        ?>
                                                                <tr>
                                                                    <td><?php echo $row2['std_id']; ?></td>
                                                                    <td><?php echo $row2['last_name'] . ", " . $row2['first_name'] . " " . $row2['middle_name'] . " " . $row2['suffix_name']; ?></td>
                                                                    <div class="text- center">
                                                                        <td><img src='<?php echo $row2['image1']; ?>' onclick="showImage('<?php echo $row2['image1']; ?>')" class='rounded mx-auto d-block' style='width:100px; height:100px;' /></td>
                                                                    </div>
                                                                    <td><?php echo date("M, d, Y g:i a", strtotime($row2['submit_date_time'])); ?></td>
                                                                    <td><?php echo date("M, d, Y g:i a", strtotime($row2['date_time'])); ?></td>
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
                                        </div>
                                    </div>
                                    <div class="overlay" onclick="hideImage()">
                                        <img id="zoomedImage">
                                    </div>
                                </div>
                            <?php
                            }
                            ?>

                            <?php
                            if ($file == "philhealth_id_db") {
                            ?>
                                <?php
                                $_SESSION['successmessage'] = "Successful";
                                include('alert_message.php');
                                ?><div class="container">
                                    <div class="card mb-4">
                                        <div class="card-header">
                                            <i class="fas fa-table me-1"></i>
                                            List Submitted
                                        </div>
                                        <?php
                                        $sql2 = "SELECT * FROM $file JOIN student_enroll ON student_enroll.id=$file.std_id  WHERE student_enroll.status !='1' AND $file.std_id='$student' ;";
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
                                                            <th class="cell">ID</th>
                                                            <th class="cell">Name</th>
                                                            <th class="cell">File/Image 1</th>
                                                            <th class="cell">File/Image 2</th>
                                                            <th class="cell">Submitted Date</th>
                                                            <th class="cell">Approval Date</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        if (mysqli_num_rows($result2) > 0) {
                                                            while ($row2 = $result2->fetch_assoc()) {
                                                        ?>
                                                                <tr>
                                                                    <td><?php echo $row2['std_id']; ?></td>
                                                                    <td><?php echo $row2['last_name'] . ", " . $row2['first_name'] . " " . $row2['middle_name'] . " " . $row2['suffix_name']; ?></td>
                                                                    <div class="text- center">
                                                                        <td><img src='<?php echo $row2['image1']; ?>' onclick="showImage('<?php echo $row2['image1']; ?>')" class='rounded mx-auto d-block' style='width:100px; height:100px;' /></td>
                                                                    </div>
                                                                    <div class="text- center">
                                                                        <td><img src='<?php echo $row2['image2']; ?>' onclick="showImage('<?php echo $row2['image2']; ?>')" class='rounded mx-auto d-block' style='width:100px; height:100px;' /></td>
                                                                    </div>
                                                                    <td><?php echo date("M, d, Y g:i a", strtotime($row2['submit_date_time'])); ?></td>
                                                                    <td><?php echo date("M, d, Y g:i a", strtotime($row2['date_time'])); ?></td>
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
                                        </div>
                                    </div>
                                    <div class="overlay" onclick="hideImage()">
                                        <img id="zoomedImage">
                                    </div>
                                </div>
                            <?php
                            }
                            ?>

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