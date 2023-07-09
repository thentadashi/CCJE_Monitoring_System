<?php
session_start();
?>
<?php
include 'db_connect.php';
require_once "../phpqrcode/qrlib.php";
if (isset($_POST["upload"])) {
    $filename = $_FILES["excel"]["name"];
    $fileExt = explode('.', $filename);
    $fileExt = strtolower(end($fileExt));

    $newfilename = date("Y.m.d") . "-" . date("h.i.sa") . "." . $fileExt;
    $targetdirect = "../uploads/" . $newfilename;

    move_uploaded_file($_FILES["excel"]["tmp_name"], $targetdirect);
    error_reporting(0);
    ini_set('display_errors', 0);

    include '../asset/excel_reader2.php';
    include '../asset/SpreadsheetReader.php';

    $reader = new SpreadsheetReader($targetdirect);

    function generateRandomString($length) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
        $max = strlen($characters) - 1;
        
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $max)];
        }
        
        return $randomString;
    }

    foreach ($reader as $key => $row) {
        $id = $row[0];
        $lname = $row[1];
        $fname = $row[2];
        $mname = $row[3];
        $sname = $row[4];
        $email = $row[5];
        $pass = generateRandomString(8);
        $status = "0";
        

        $qrCodePath = "../qrcodes/" . $id . ".png"; // Path to store QR code image
        QRcode::png($id, $qrCodePath, QR_ECLEVEL_Q, 10, 2); // Generate and save QR code image


        $sql = "INSERT INTO student_enroll (id,last_name,first_name, middle_name, suffix_name,email, password, status)" .
            "VALUE ( '$id','$lname','$fname','$mname','$sname','$email','$pass','$status')";
        $sql3 = "INSERT INTO student_qrcode (std_id, path) VALUES ('$id', '$qrCodePath')";

        $result = $mysqli->query($sql);

        $result3 = $mysqli->query($sql3);

        if (!$result  || !$result3) {
            $_SESSION['errormessage'] = "Invalid query " . $mysqli->error;
            header("location: /admin/student_enrolled.php");
        }
    }
    echo "
    <script>
    alert('Successfully Imported');
    document.location.href = '';
    </script>
    ";
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'head.php' ?>
    <title>Student Enrolled List</title>
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
                                        <h1 class="mt-4">Student Enrolled List</h1>
                                        <ol class="breadcrumb mb-4">
                                            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                                            <li class="breadcrumb-item active">Tables</li>
                                        </ol>
                                        <div class="col-lg-5 col-md-6">
                                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addModal" data-whatever="Team Leader">Add Student</button>
                                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addBatch" data-whatever="Team Leader">Add By Batch</button>
                                            <!-- <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#removestudent" data-whatever="Team Leader">Archive Student</button> -->
                                            <!-- <button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#export" data-whatever="Team Leader">Export Data</button> -->
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
                                                    <th class="cell">Email</th>
                                                    <th class="cell">Password</th>
                                                    <th class="text-right">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                include 'db_connect.php';
                                                    ?>
                                                        <?php
                                                        $sql = "SELECT * FROM student_enroll WHERE status !='1' ORDER BY last_name ASC";
                                                        $result = $mysqli->query($sql);
                                                        if (!$result) {
                                                            die("Invalid query: " . $mysqli->error);
                                                        }
                                                        function maskString($string, $numVisibleChars = 1, $maskChar = '*') {
                                                            $visibleChars = substr($string, 0, $numVisibleChars);
                                                            $maskedChars = str_repeat($maskChar, strlen($string) - $numVisibleChars);
                                                            return $visibleChars . $maskedChars;
                                                        }
                                                        while ($row = $result->fetch_assoc()) {
                                                            $encryptedString = maskString($row['password'], 1, '*');
                                                        ?>
                                                            <tr>
                                                                <td><?php echo $row['id']; ?></td>
                                                                <td><?php echo $row['last_name'] . ", " . $row['first_name'] . " " . $row['middle_name'] . " " . $row['suffix_name']; ?></td>
                                                                <td><?php echo $row['email']; ?></td>
                                                                <td><?php echo $encryptedString; ?></td>
                                                                <td class='text-right'>
                                                                    <a href='#edit_<?php echo $row['id']; ?>' class='btn btn-success btn-sm' data-bs-toggle='modal'><i class='bi bi-pencil-square'></i> Edit</a>
                                                                    <a href='#archive_<?php echo $row['id']; ?>' class='btn btn-danger btn-sm' data-bs-toggle='modal'><i class='bi bi-trash'></i> Archive</a>
                                                                </td>
                                                            </tr>
                                                            <?php include('modal_student_enrolled.php'); ?>
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
                        <h5 class="modal-title" id="exampleModalLabel">Add Student Enrolled</h5>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="add_student_enroll.php" method="POST" class="card-body" validate>
                            <input type="hidden" name="status" value="0">
                            <div class="row clearfix">
                                <div class="col-md-12 col-sm-12 mb-2">
                                    <div class="form-group">
                                        <input type="text" name="studentid" class="form-control" placeholder="STUDENT ID">
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12 mb-2">
                                    <div class="form-group">
                                        <input type="text" name="lastname" class="form-control" placeholder="LAST NAME">
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12 mb-2">
                                    <div class="form-group">
                                        <input type="text" name="firstname" class="form-control" placeholder="FIRST NAME">
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12 mb-2">
                                    <div class="form-group">
                                        <input type="text" name="middlename" class="form-control" placeholder="MIDDLE NAME">
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-12 mb-2">
                                    <div class="form-group">
                                        <select name="suffixname" class="form-control custom-select">
                                            <option value="" disabled selected>SUFFIX NAME</option>
                                            <option value=" ">N/A</option>
                                            <option value="Jr">Jr</option>
                                            <option value="Sr">Sr</option>
                                            <option value="III">III</option>
                                            <option value="IV">IV</option>
                                            <option value="V">V</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12 mb-2">
                                    <div class="form-group">
                                        <input type="text" name="email" class="form-control" placeholder="EMAIL">
                                    </div>
                                </div>
                                <br>
                                <div class="col-sm-12 mb-3">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <a href="student_enrolled.php" class="btn btn-outline-secondary" title="">Cancel</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="addBatch" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Batch Student</h5>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="student_enrolled.php" method="POST" enctype="multipart/form-data" class="card-body" validate>
                            <div class="row clearfix">
                                <div class="col-md-12 col-sm-12 mb-2">
                                    <div class="form-group">
                                        <input type="file" name="excel" class="form-control" placeholder="file here..">
                                    </div>
                                </div>
                                <br>
                                <div class="col-sm-12 mb-3">
                                    <button type="submit" name="upload" class="btn btn-primary">Upload</button>
                                    <a href="student_enrolled.php" class="btn btn-outline-secondary" title="">Cancel</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="removestudent" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                            $sql = "SELECT DISTINCT YEAR(time_date) AS year FROM student_enroll;";
                                            $result = $mysqli->query($sql);
                                            if ($result->num_rows > 0) {
                                                // output data of each row
                                                while ($row = $result->fetch_assoc()) {
                                                    $year = $row['year'];
                                                    $cyearnew = $year - 1;
                                                    echo "<option value='$row[year]' > " . $cyearnew . " - " . $row['year'] . "</option>";
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-12 mb-3">
                                    <button type="submit" class="btn btn-danger">Archive</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
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
                        <form action="export_student.php" method="POST" class="card-body" validate>
                            <div class="row clearfix">
                                <div class="col-md-12 col-sm-6 mb-2">
                                    <div class="form-group">
                                        <label>Block</label>
                                        <input name="block" autocomplete="off" list="block_list2" class="form-control">
                                        <datalist id="block_list2">
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
                                <div class="col-md-12 col-sm-6 mb-2">
                                    <div class="form-group">
                                        <label>Semester</label>
                                        <select type="text" name="semester" class="form-control" required>
                                            <option></option>
                                            <option value="1st">1st</option>
                                            <option value="2nd">2nd</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-6 mb-2">
                                    <div class="form-group">
                                        <label>School Year</label>
                                        <select type="text" name="year" class="form-control" required>
                                            <option></option>
                                            <?php
                                            $sql = "SELECT DISTINCT YEAR(time_date) AS year FROM student_enroll;";
                                            $result = $mysqli->query($sql);
                                            if ($result->num_rows > 0) {
                                                // output data of each row
                                                while ($row = $result->fetch_assoc()) {
                                                    $year = $row['year'];
                                                    $cyearnew = $year - 1;
                                                    echo "<option value='$row[year]' > " . $cyearnew . " - " . $row['year'] . "</option>";
                                                }
                                            }
                                            ?>
                                        </select>
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