<?php
session_start();

date_default_timezone_set("Asia/Manila");
$script_tz = date_default_timezone_get();

if (strcmp($script_tz, ini_get('date.timezone'))){
    echo $script_tz;
    echo 'Script timezone differs from ini-set timezone.';
} else {
    echo 'Script timezone and ini-set timezone match.';
}

include 'database/db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $userid = $_POST["userID"];
    $pass = $_POST["userpass"];

    $firstLetter = substr($userid, 0, 1);
    $removedFirstLetter = substr($userid, 1);

    if (($firstLetter === "A") || ($firstLetter === "a")) {

        $sql = "SELECT * from admin_db Where admin_id=$removedFirstLetter";
        if ($result = $mysqli->query($sql)) {
            while ($row = $result->fetch_assoc()) {
                if (password_verify($pass, $row['admin_password'])) {
                    $_SESSION["user"] = $row['admin_id'];
                    $_SESSION["username"] = $row['admin_lname'];
                    header("location: /CCJE_Monitoring_System/admin/index.php");
                } else {
                    $_SESSION['errormessage'] = "Error: Invalid username or password. Contact support if the issue persists.";
                }
            }
        } else {
            $_SESSION['errormessage'] = "Contact support if the issue persists.";
        }
    } elseif (($firstLetter === "T") || ($firstLetter === "T")) {

        $sql = "SELECT * from team_leader_student where tl_id=$removedFirstLetter";
        if ($result = $mysqli->query($sql)) {
            while ($row = $result->fetch_assoc()) {
                $sql2 = "SELECT * from student_enroll where status !='1' and id=$removedFirstLetter";
                if ($result2 = $mysqli->query($sql2)) {
                    while ($row2 = $result2->fetch_assoc()) {
                        if ($row2['password'] == $pass) {
                            $_SESSION["user"] = $row2['id'];
                            $_SESSION["userstation"] = $row['sti_id'];
                            $_SESSION["username"] = $row2['last_name'];
                            header("location: /CCJE_Monitoring_System/check_student2.php");
                        } else {
                            $_SESSION['errormessage'] = "Error: Invalid username or password. Contact support if the issue persists.";
                        }
                    }
                }
            }
        } else {
            $_SESSION['errormessage'] = "Contact support if the issue persists.";
        }
        error_reporting(E_ALL);
ini_set('display_errors', 1);
    } else {

        $sql = "SELECT * from student_enroll Where status !='1' and id=$userid";
        if ($result = $mysqli->query($sql)) {
            while ($row = $result->fetch_assoc()) {
                if ($pass == $row['password']) {
                    $_SESSION["user"] = $row['id'];
                    header("location: /CCJE_Monitoring_System/check_student.php");
                } else {
                    $_SESSION['errormessage'] = "Error: Invalid username or password. Contact support if the issue persists.";
                }
            }
        } else {
            $_SESSION['errormessage'] = "Contact support if the issue persists.";
        }
    }
    
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Login</title>
    <link rel="icon" href="logoccje.jpg" type="image/icon type">
    <link href="css/styles.css" rel="stylesheet" />
    <link href="css/bootstrap.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="bg-image" style="background-image:url('bg.jpg');">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="d-flex align-content-center flex-wrap">
                        <div class="d-flex align-item-center py-5">
                            <div class="row">
                                <div class="px-5 py-5 px-md-5 text-center text-lg-start rounded" style="background-color: #0000B9;">
                                    <div class="container rounded">
                                        <div class="row px-am-5 align-items-center">
                                            <div class="col-sm-6 mb-5 mb-lg-0">
                                                <h1 class="my-1 display-3 fw-bold ls-tight" style="color: white;">
                                                    COLLEGE OF CRIMINAL <br />
                                                    <span style="color:#FFF04D;">JUSTICE EDUCATION</span>
                                                </h1>
                                                <p style="color: white;">
                                                    Honing high-caliber criminologists and principled law enforcers, while inculcating the spirit of nationalism, accountability, and justice.
                                                </p>
                                            </div>
                                            <div class="col-lg-6 mb-5 mb-lg-0">
                                                <div class="card rounded">
                                                    <div class="card-body">
                                                        <div class="d-flex justify-content-center">
                                                            <img class="img-fluid rounded mb-2" src="logoccje.jpg" width="75" height="75">
                                                        </div>
                                                        <h5 class="d-flex justify-content-center">URDANETA CITY UNIVERSITY</h5>
                                                        <p class="h6 fw-light d-flex justify-content-center">COLLEGE OF CRIMINAL JUSTICE EDUCATION</p>
                                                    </div>
                                                    <?php
                                                    if (isset($_SESSION['successmessage'])) {
                                                    ?>
                                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                            <strong>Successful</strong>
                                                            <button type="button" class="btn-close btn-sm" data-dismiss="alert" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                    <?php
                                                        unset($_SESSION['successmessage']);
                                                    }
                                                    ?>
                                                    <?php
                                                    if (isset($_SESSION['errormessage'])) {
                                                    ?>
                                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                            <strong></strong> <?php echo $_SESSION['errormessage']; ?>
                                                            <button type="button" class="btn-close btn-sm" data-dismiss="alert" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                    <?php
                                                        unset($_SESSION['errormessage']);
                                                    }
                                                    ?>
                                                    <div class="card-body py-1 px-md-5 rounded">
                                                        <form action="index.php" method="post">
                                                            <div class="form-floating mb-2">
                                                                <div class="form-floating mb-2">
                                                                    <input class="form-control" id="inputEmail" type="text" name="userID" placeholder="Student ID" />
                                                                    <label for="inputID">ID</label>
                                                                </div>
                                                                <div class="form-floating mb-2">
                                                                    <input class="form-control" id="inputPassword" type="password" name="userpass" placeholder="Password" />
                                                                    <label for="inputPassword">Password</label>

                                                                </div>
                                                                <div class="d-flex justify-content-md-center mb-4">
                                                                    <button type="submit" class="btn btn-primary btn-lg btn-block">Log In</button>
                                                                </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
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
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js"></script>
    <script src="js/chart-pie.js"></script>
    <script src="js/chart-bar.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest"></script>
    <script src="js/datatables-simple-demo.js"></script>
    <script src="js/lib.vendor.bundle.js"></script>
    <script src="js/dropify.min.js"></script>
    <script src="js/core.js"></script>
    <script src="js/dropify.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="js/datatables-simple-demo.js"></script>
</body>

</html>