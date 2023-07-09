<?php
session_start();
include 'db_connect.php';

$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $id = $_POST["s_id"];
    $lname = $_POST["s_lname"];
    $fname = $_POST["s_fname"];
    $mname = $_POST["s_mname"];
    $sname = $_POST["s_sname"];
    $birthday = $_POST["s_birthday"];
    $sex = $_POST["s_sex"];
    $religion = $_POST["s_religion"];
    $nationality = $_POST["s_nationality"];
    $age = $_POST["s_age"];
    $block = $_POST["s_block"];
    $position = $_POST["s_position"];
    $contact = $_POST["s_contact"];
    $email = $_POST["s_email"];
    $g_lname = $_POST["sg_lname"];
    $g_fname = $_POST["sg_fname"];
    $g_mname = $_POST["sg_mname"];
    $g_sname = $_POST["sg_sname"];
    $g_identity = $_POST["sg_identity"];
    $g_contact = $_POST["sg_contact"];
    $house_no = $_POST["s_house_no"];
    $street_zone = $_POST["s_street_zone"];
    $barangay = $_POST["s_barangay"];
    $municipal = $_POST["s_municipal"];
    $region = $_POST["s_region"];
    $zip_code = $_POST["s_zip_code"];
    $password = $_POST["s_password"];
    $repassword = $_POST["s_re-password"];

    do {

        if (
            empty($id) || empty($lname) || empty($fname) || empty($mname) || empty($sname) || empty($birthday) ||
            empty($sex) || empty($religion) || empty($nationality) || empty($age) || empty($block) || empty($position) ||
            empty($contact) || empty($email) || empty($g_lname) || empty($g_fname) || empty($g_mname) || empty($g_sname) ||
            empty($g_identity) || empty($g_contact) || empty($house_no) || empty($barangay) || empty($municipal) || empty($region) ||
            empty($zip_code) || empty($password) || empty($repassword)
        ) {

            $errorMessage = "All the field are required";
            break;
        } else {

            if (strlen($password) < 8 || !preg_match("/[a-z]/i", $password) || !preg_match("/[0-9]/", $password)) {

                $errorMessage = "Password must be at least 8 characters and contain at least one number";
                break;
            }

            if ($password != $repassword) {

                $errorMessage = "Password not match";
                break;
            }

            $password_hash = password_hash($password, PASSWORD_DEFAULT);


            $sql = "INSERT INTO student_db (s_id,s_lname,s_fname,s_mname,s_sname,s_birthday,s_sex,s_religion,s_nationality,s_age,s_block,s_position,s_contact, s_email, sg_lname,sg_fname,sg_mname,sg_sname,sg_identity,sg_contact,s_house_no,s_street_zone,s_barangay,s_municipal,s_region, s_zip_code, s_password)" .
                "VALUE ('$id' ,'$lname','$fname','$mname','$sname','$birthday','$sex','$religion','$nationality','$age','$block','$position','$contact','$email','$g_lname','$g_fname','$g_mname','$g_sname','$g_identity','$g_contact','$house_no','$street_zone','$barangay','$municipal','$region','$zip_code','$password_hash')";

            $result = $mysqli->query($sql);

            if (!$result) {
                $errorMessage = "Invalid query " . $mysqli->error;
                break;
            }

            $id = "";
            $lname = "";
            $fname = "";
            $mname = "";
            $sname = "";
            $birthday = "";
            $sex = "";
            $religion = "";
            $nationality = "";
            $age = "";
            $block = "";
            $position = "";
            $contact = "";
            $email = "";
            $g_lname = "";
            $g_fname = "";
            $g_mname = "";
            $g_sname = "";
            $g_identity = "";
            $g_contact = "";
            $house_no = "";
            $street_zone = "";
            $barangay = "";
            $municipal = "";
            $region = "";
            $zip_code = "";
            $password = "";
            $repassword = "";

            $successMessage = "Successful added new Student";

            header("location: /admin/student_table.php");
            exit;
        }
    } while (false);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'head.php' ?>
    <title>Add Student</title>
</head>

<body class="sb-nav-fixed">
    <?php include 'header.php' ?>
    <div id="layoutSidenav">
        <?php include 'nav.php' ?>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Add Student</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                        <li class="breadcrumb-item active">Form</li>
                    </ol>
                    <?php
                    if (!empty($successMessage)) {
                        echo "
                                     <div class='alert alert-success alert-dismissible fade show' role='alert'>
                                     <strong>$successMessage</strong>
                                    <button type'button' class='btn-close' data-bs-dismiss='alert' aria-label='close'></button>
                                    </div>
                                     ";
                    }
                    if (!empty($errorMessage)) {
                        echo "
                            <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                            <strong>$errorMessage</strong>
                            <button type'button' class='btn-close' data-bs-dismiss='alert' aria-label='close'></button>
                            </div>
                            ";
                    }
                    ?>
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Add Student Form
                        </div>
                        <div class="card-header bg-black text-white">
                            <i class="text-white"></i>
                            Student Information
                        </div>
                        <form action="add_student.php" method="post" class="card-body" novalidate>
                            <div class="row clearfix">
                                <div class="col-md-2 col-sm-12 mb-2">
                                    <div class="form-group">
                                        <label>Student ID</label>
                                        <input type="text" name="s_id" class="form-control" placeholder="ID number">
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-12 mb-2">
                                    <div class="form-group">
                                        <label>Last Name</label>
                                        <input type="text" name="s_lname" class="form-control" placeholder="Last name">
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-12 mb-2">
                                    <div class="form-group">
                                        <label>First Name</label>
                                        <input type="text" name="s_fname" class="form-control" placeholder="First name">
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-12 mb-2">
                                    <div class="form-group">
                                        <label>Middle Name</label>
                                        <input type="text" name="s_mname" class="form-control" placeholder="Middle name">
                                    </div>
                                </div>
                                <div class="col-md-1 col-sm-12 mb-2">
                                    <div class="form-group">
                                        <label>Suffix</label><br>
                                        <select name="s_sname" class="form-control">
                                            <option value=" ">N/A</option>
                                            <option value="Jr">Jr</option>
                                            <option value="Sr">Sr</option>
                                            <option value="III">III</option>
                                            <option value="IV">IV</option>
                                            <option value="V">V</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2 col-sm-12 mb-2">
                                    <div class="form-group">
                                        <label>Birthday</label>
                                        <input type="date" name="s_birthday" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-1 col-sm-12  mb-2">
                                    <div class="form-group">
                                        <label>Sex</label><br>
                                        <select name="s_sex" class="form-control">
                                            <option value="" selected disabled>Sex</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2 col-sm-12  mb-2">
                                    <div class="form-group">
                                        <label>Religion</label>
                                        <input type="text" name="s_religion" class="form-control" placeholder="Religion">
                                    </div>
                                </div>
                                <div class="col-md-2 col-sm-12  mb-2">
                                    <div class="form-group">
                                        <label>Nationality</label>
                                        <input type="text" name="s_nationality" class="form-control" placeholder="Nationality">
                                    </div>
                                </div>
                                <div class="col-md-1 col-sm-12  mb-2">
                                    <div class="form-group">
                                        <label>Age</label>
                                        <input type="text" name="s_age" class="form-control" placeholder="Age">
                                    </div>
                                </div>
                                <div class="col-md-1 col-sm-12 mb-2">
                                    <div class="form-group">
                                        <label>Block</label><br>
                                        <select name="s_block" class="form-control">
                                            <option value="" selected disabled>Block</option>
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
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2 col-sm-12 mb-2">
                                    <div class="form-group">
                                        <label>Student Position</label><br>
                                        <select name="s_position" class="form-control">
                                            <option value="Student">Student</option>
                                            <option value="Team Leader">Team Leader</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="card-header bg-black text-white mb-2">
                                    <i class="text-white"></i>
                                    Contact Information
                                </div>
                                <div class="col-md-3 col-sm-12 mb-2">
                                    <div class="form-group">
                                        <label>Contact number</label>
                                        <input type="text" name="s_contact" class="form-control" placeholder="Contract">
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-12 mb-2">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="text" name="s_email" class="form-control" placeholder="Email">
                                    </div>
                                </div>
                                <div class="card-header bg-black text-white mb-2">
                                    <i class="text-white"></i>
                                    Guardian Information
                                </div>
                                <div class="col-md-3 col-sm-12 mb-2">
                                    <div class="form-group">
                                        <label>Last Name</label>
                                        <input type="text" name="sg_lname" class="form-control" placeholder="Last name">
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-12 mb-2">
                                    <div class="form-group">
                                        <label>First Name</label>
                                        <input type="text" name="sg_fname" class="form-control" placeholder="First name">
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-12 mb-2">
                                    <div class="form-group">
                                        <label>Middle Name</label>
                                        <input type="text" name="sg_mname" class="form-control" placeholder="Middle name">
                                    </div>
                                </div>
                                <div class="col-md-1 col-sm-12 mb-2">
                                    <div class="form-group">
                                        <label>Suffix</label><br>
                                        <select name="sg_sname" class="form-control">
                                            <option value=" ">N/A</option>
                                            <option value="Jr">Jr</option>
                                            <option value="Sr">Sr</option>
                                            <option value="III">III</option>
                                            <option value="IV">IV</option>
                                            <option value="V">V</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-12 mb-2">
                                    <div class="form-group">
                                        <label>Guardian Identity</label>
                                        <input type="text" name="sg_identity" class="form-control" placeholder="Identity">
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-12 mb-2">
                                    <div class="form-group">
                                        <label>Contact number</label>
                                        <input type="text" name="sg_contact" class="form-control" placeholder="Contact">
                                    </div>
                                </div>
                                <div class="card-header bg-black text-white mb-2">
                                    <i class="text-white"></i>
                                    Address Information
                                </div>
                                <div class="col-md-3 col-sm-12 mb-2">
                                    <div class="form-group">
                                        <label>House No.</label>
                                        <input type="text" name="s_house_no" class="form-control" placeholder="House no.">
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-12 mb-2">
                                    <div class="form-group">
                                        <label>Street/Zone</label>
                                        <input type="text" name="s_street_zone" class="form-control" placeholder="Street">
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-12 mb-2">
                                    <div class="form-group">
                                        <label>Barangay</label>
                                        <input type="text" name="s_barangay" class="form-control" placeholder="Barangay">
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-12 mb-2">
                                    <div class="form-group">
                                        <label>Municipal</label>
                                        <input type="text" name="s_municipal" class="form-control" placeholder="Municipal">
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-12 mb-2">
                                    <div class="form-group">
                                        <label>Region</label>
                                        <input type="text" name="s_region" class="form-control" placeholder="Region">
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-12 mb-2">
                                    <div class="form-group">
                                        <label>Zip Code</label>
                                        <input type="text" name="s_zip_code" class="form-control" placeholder="Zip Code">
                                    </div>
                                </div>
                                <div class="card-header bg-black text-white mb-2">
                                    <i class="text-white"></i>
                                    Password
                                </div>
                                <div class="col-md-3 col-sm-12 mb-2">
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="password" id="myInput" name="s_password" class="form-control" placeholder="password">
                                        <input type="checkbox" onclick="myFunction()">Show Password
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-12 mb-2">
                                    <div class="form-group">
                                        <label>Re-Type Password</label>
                                        <input type="password" id="myInput2" name="s_re-password" class="form-control" placeholder="re-type password">
                                        <input type="checkbox" onclick="myFunction2()">Show Password
                                    </div>
                                </div>
                                <br>
                                <br>
                                <div class="col-sm-12 mb-2">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <a href="student_table.php" class="btn btn-outline-secondary" title="">Cancel</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </main>
            <?php include 'footer.php' ?>
        </div>
    </div>
    <?php include 'script.php' ?>
    <script>
        function myFunction() {
            var x = document.getElementById("myInput");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }

        }
    </script>
     <script>
        function myFunction2() {
            var x = document.getElementById("myInput2");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }

        }
    </script>
</body>

</html>