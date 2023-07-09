<?php
session_start();
include 'db_connect.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';
if (isset($_POST["block"])) {
    $stdid = $_POST["student"];
    $block = $_POST["blk"];

    $studentStationQuery = "SELECT * from blk_sy WHERE std_id = $stdid";
    $studentStations = count($mysqli->query($studentStationQuery)->fetch_all(MYSQLI_ASSOC));

    if ($studentStations != 0) {
        $_SESSION['errormessage'] = "Student is already in a Block.";
    }
    $sql = "SELECT * FROM `sem_year`";
    $result = $mysqli->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $sem = $row['semester'];
            $year = $row['school_year'];
        }
    }
    $insertsql = $mysqli->query("INSERT into blk_sy (std_id, blk, sem, sch_yr) VALUES ('$stdid','$block','$sem','$year')");
    if ($insertsql) {
        $_SESSION['successmessage'] = 'success';
    } else {
        $_SESSION['errormessage'] = " Failed to set block";
    }

    // Send email
    $messagesql = "SELECT * FROM student_enroll WHERE id = $stdid";
    $msgresult = mysqli_query($mysqli, $messagesql);

    if (mysqli_num_rows($msgresult) > 0) {
        // Fetch the email address
        $row = mysqli_fetch_assoc($msgresult);

        $student_email = $row['email'];
        $studentpassword = $row['password'];
        $studentname = $row['last_name'] . ', ' . $row['first_name'] . ' ' . $row['middle_name'] . ' ' . $row['suffix_name'];

        // Send email to the student
        $subject = "no subject";
        $message = "This is your account in https://e-crimsojtmanagement.online/<br> Your User ID : " . $stdid . "<br> Password : " . $studentpassword;


        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'johnlaurencerobeniol.bsit.ucu@gmail.com';
        $mail->Password = 'bcqbagmzjdogvomw';
        $mail->Port = 465;
        $mail->SMTPSecure = 'ssl';
        $mail->isHTML(true);
        $mail->setFrom('johnlaurencerobeniol.bsit.ucu@gmail.com', 'Admin');
        $mail->addAddress($student_email);
        $mail->Subject = ("Admin ($subject)");
        $mail->Body = $message;
        $mail->send();
    }
}
if (isset($_POST["update"])) {
    $sem = $_POST['sem'];
    $year =$_POST['year'];

    $update = $mysqli->query(" UPDATE sem_year SET semester='$sem', school_year	='$year' WHERE sy_id = '1';");
    if ($update) {
        $_SESSION['successmessage'] = 'Successful save';
    } else {
        $_SESSION['errormessage'] = "Failed to save";
    }
}
if (isset($_POST["edit"])) {
    $sem = $_POST['sem'];
    $blk = $_POST['blk'];
    $year =$_POST['year'];
    $id = $_POST['id'];

    $update = $mysqli->query(" UPDATE blk_sy SET blk='$blk', sem='$sem',sch_yr='$year' WHERE std_id = '$id';");
    if ($update) {
        $_SESSION['successmessage'] = 'Successful Update';
    } else {
        $_SESSION['errormessage'] = "Failed to Update";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'head.php' ?>
    <title>Set Student Block</title>
    <style>
        #student_list option {
            display: none;
        }
    </style>
</head>

<body class="sb-nav-fixed">
    <?php include 'header.php' ?>
    <div id="layoutSidenav">
        <?php include 'nav.php' ?>
        <div id="layoutSidenav_content">
            <div id="layoutAuthentication">
                <div id="layoutAuthentication_content">
                    <main>
                        <div class="container-fluid px-4">
                            <div class="card bg-white mb-2">
                                <div class="card-body">
                                    <div class="align-self-center">
                                        <h1 class="mt-4">Set Student Block</h1>
                                        <ol class="breadcrumb mb-4">
                                            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                                            <li class="breadcrumb-item active">Tables</li>
                                        </ol>
                                        <div class="col-lg-5 col-md-6">
                                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#assign" data-whatever="Team Leader"><i class="bi bi-pin-map"></i> Assign Student</button>
                                            <button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#addModal" data-whatever="Team Leader"><i class="bi bi-gear"></i> Setting</button>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php include 'alert_message.php'; ?>
                            <div class="card mb-4">
                                <div class="card-header">
                                    <i class="fas fa-table me-1"></i>
                                    Student Enrolled List DataTable
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="datatablesSimple" class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th class="cell">ID</th>
                                                    <th class="cell">Name</th>
                                                    <th class="cell">Block</th>
                                                    <th class="cell">Semester</th>
                                                    <th class="text-right">School Year</th>
                                                    <th class="text-right">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                include 'db_connect.php';
                                                ?>
                                                <?php
                                                $sql = "SELECT * FROM blk_sy join student_enroll on blk_sy.std_id=student_enroll.id WHERE student_enroll.status !='1' ORDER BY blk_sy.blk_date_time Desc";
                                                $result = $mysqli->query($sql);
                                                if (!$result) {
                                                    die("Invalid query: " . $mysqli->error);
                                                }

                                                while ($row = $result->fetch_assoc()) {
                                                ?>
                                                    <tr>
                                                        <td><?php echo $row['id']; ?></td>
                                                        <td><?php echo $row['last_name'] . ", " . $row['first_name'] . " " . $row['middle_name'] . " " . $row['suffix_name']; ?></td>
                                                        <td><?php echo $row['blk']; ?></td>
                                                        <td><?php echo $row['sem'] ?></td>
                                                        <td><?php echo $row['sch_yr'] ?></td>
                                                        <td> <a href='#update_<?php echo $row['id']; ?>' class='btn btn-warning btn-sm' data-bs-toggle='modal'><i class='bi bi-pencil-square'></i> Update</a></td>
                                                    </tr>
                                                    <?php include('modal_blk.php'); ?>
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
            </div>
            <?php include 'footer.php' ?>
        </div>
        <!-- Add New -->
        <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Setting</h5>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="set_blk.php" method="POST" class="card-body" validate>
                            <div class="row clearfix">
                                <div class="col-md-12 col-sm-12 mb-2">
                                    <label>Semester</label>
                                    <select type="text" name="sem" class="form-control" required>
                                        <?php
                                        $sql = "SELECT *  FROM sem_year";
                                        $result = $mysqli->query($sql);
                                        if ($result->num_rows > 0) {
                                            // output data of each row
                                            while ($row = $result->fetch_assoc()) {
                                                echo "<option value='$row[semester]'> " . $row['semester'] . "</option>";
                                            }
                                        }
                                        ?>
                                        <option value="1st">1st</option>
                                        <option value="2nd">2nd</option>

                                    </select>
                                </div>
                                <div class="col-md-12 col-sm-12 mb-2">
                                    <label>School Year</label>
                                    <select type="text" name="year" class="form-control" required>
                                        <?php
                                        $sql = "SELECT *  FROM sem_year";
                                        $result = $mysqli->query($sql);
                                        if ($result->num_rows > 0) {
                                            // output data of each row
                                            while ($row = $result->fetch_assoc()) {
                                                echo "<option value='$row[school_year]'> " . $row['school_year'] . "</option>";
                                            }
                                        }
                                        ?>
                                        <option value="2018-2019">2018-2019</option>
                                        <option value="2019-2020">2019-2020</option>
                                        <option value="2020-2021">2020-2021</option>
                                        <option value="2021-2022">2021-2022</option>
                                        <option value="2022-2023">2022-2023</option>
                                        <option value="2023-2024">2023-2024</option>
                                        <option value="2024-2025">2024-2025</option>
                                        <option value="2025-2026">2025-2026</option>

                                    </select>
                                </div>
                                <br>
                                <div class="col-sm-12 mb-3">
                                    <button type="submit" name="update" class="btn btn-primary">Save</button>
                                    <a href="set_blk.php" class="btn btn-outline-secondary" title="">Cancel</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="updatestudent" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Remove Student Enrolled</h5>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="remove_student_enroll.php" method="POST" class="card-body" validate>
                            <input type="hidden" name="status" value="1">
                            <div class="row clearfix">
                                <div class="col-md-6 col-sm-6 mb-2">
                                    <div class="form-group">
                                        <label>Semester</label>
                                        <select type="text" name="semester" class="form-control" required>
                                            <option></option>
                                            <option value="1st">1st</option>
                                            <option value="2nd">2nd</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 mb-2">
                                    <div class="form-group">
                                        <label>School Year</label>
                                        <select type="text" name="year" class="form-control" required>
                                            <option></option>
                                            <?php
                                            $sql = "SELECT DISTINCT sch_yr FROM blk_sy;";
                                            $result = $mysqli->query($sql);
                                            if ($result->num_rows > 0) {
                                                // output data of each row
                                                while ($row = $result->fetch_assoc()) {
                                                    echo "<option value='$row[sch_yr]' > " . $row['sch_yr'] . "</option>";
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-12 mb-3">
                                    <button type="submit" class="btn btn-danger">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="assign" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Assign Student Block</h5>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="set_blk.php" method="POST" class="card-body" validate>
                            <div class="row clearfix">
                                <div class="col-md-12 col-sm-12 mb-2">
                                    <label class="mb-3">ID - Student Name</label>
                                    <input name="student" autocomplete="off" list="student_list" class="form-control" required>
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

                                            <option value='<?php echo $row3['id']; ?>'><?php echo $row3['last_name'] . ", " . $row3['first_name'] . " " . $row3['middle_name'] . " " . $row3['suffix_name']; ?></option>

                                        <?php
                                        }
                                        ?>
                                    </datalist>
                                </div>
                                <div class="col-md-12 col-sm-12 mb-2">
                                    <label class="mb-3">Block</label>
                                    <input name="blk" autocomplete="off" list="block_list" class="form-control" required>
                                    <datalist id="block_list">
                                        <option value="" disabled selected></option>
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                        <option>5</option>
                                        <option>6</option>
                                        <option>7</option>
                                        <option>8</option>
                                        <option>9</option>
                                        <option>10</option>
                                        <option>11</option>
                                        <option>12</option>
                                        <option>13</option>
                                        <option>14</option>
                                        <option>15</option>
                                        <option>16</option>
                                        <option>17</option>
                                        <option>18</option>
                                        <option>19</option>
                                    </datalist>
                                </div>

                                <br>
                                <div class="col-sm-12 mb-3">
                                    <button type="submit" name="block" class="btn btn-primary">Submit</button>
                                    <a href="set_blk.php" class="btn btn-outline-secondary" title="">Cancel</a>
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