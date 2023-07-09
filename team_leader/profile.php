<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'head.php' ?>
    <title>Profile</title>
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
                                <h1 class="mt-1 ">Student Information</h1>
                                <ol class="breadcrumb mb-4">
                                    <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                                    <li class="breadcrumb-item active">Tables</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <?php include 'alert_message.php' ?>
                    <?php
                    include '../database/db_connect.php';
                    $user = $_SESSION["user"];
                    $sql = "SELECT * from student_enroll join blk_sy on blk_sy.std_id=student_enroll.id join user_profile on user_profile.std_id=student_enroll.id join student_information on student_enroll.id=student_information.std_id JOIN student_qrcode on student_enroll.id=student_qrcode.std_id Where student_enroll.id=$user";
                    if ($result = $mysqli->query($sql))
                        while ($row = $result->fetch_assoc()) {
                    ?>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="card mb-4">
                                    <div class="card-body text-center">
                                        <img src="<?php echo $row["profile"] ?>" alt="avatar" class="rounded mx-auto d-block" style="width: 150px; height: 160px;">
                                        <h5 class="my-3"><?php echo $row["last_name"] . " " . $row["first_name"] ?></h5>
                                        <p class="text-muted mb-4"><?php echo $row["std_id"] ?></p>
                                        <div class="d-flex justify-content-center mb-2">
                                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addModal1"><i class="bi bi-image"></i> Edit Profile</button>
                                        </div>
                                        <img src="<?php echo $row["path"] ?>" alt="avatar" class="rounded mx-auto d-block" style="width: 150px; height: 160px;">
                                        <p class="text-muted mb-4">For Attendance Barcode</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <div class="card mb-4">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <p class="mb-0">Email</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <p class="text-muted mb-0"><?php echo $row["email"]  ?></p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <p class="mb-0">ID Number</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <p class="text-muted mb-0"><?php echo $row["std_id"] ?></p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <p class="mb-0">Block - Semester</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <p class="text-muted mb-0"><?php echo $row["blk"] ?> - <?php echo $row["sem"] ?></p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <p class="mb-0">Sex</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <p class="text-muted mb-0"><?php echo $row["sex"] ?></p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <p class="mb-0">Birthday</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <p class="text-muted mb-0"><?php echo date("F, d, Y", strtotime($row["birthday"])) ?></p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <p class="mb-0">Mobile no.</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <p class="text-muted mb-0"><?php echo $row["mobile_no"] ?></p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <p class="mb-0">Address</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <p class="text-muted mb-0"><?php echo ucwords($row['barangay']) . ", " . ucwords(strtolower($row['municipal'])) . ", " . ucwords(strtolower($row['province'])) ?></p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#addModal"><i class="bi bi-pass"></i> Change Password</button>
                                            </div>
                                        </div>
                                    </div>
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
    <!-- Add change password-->
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Change Password</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="edit_proccess/edit_password.php" method="post" class="card-body" novalidate>
                        <div class="row clearfix">
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label>Old Password</label>
                                    <input type="password" class="form-control mb-3" placeholder="OLD PASSWORD" required name="oldpass">
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label>New Password</label>
                                    <input type="password" class="form-control mb-3" placeholder="NEW PASSWORD" required name="newpass">
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label>Re-Type New Password</label>
                                    <input type="password" class="form-control mb-3" placeholder="RE_TYPE NEW PASSWORD" required name="retypepass">
                                </div>
                            </div>
                            <br>
                            <div class="col-sm-12 mb-3">
                                <button type="submit" name="submit" class="btn btn-primary btn-sm">Submit</button>
                                <a href="profile.php" class="btn btn-outline-secondary btn-sm" title="">Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Add change profile-->
    <div class="modal fade" id="addModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Change Profile</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="edit_proccess/edit_photo.php" method="post" class="card-body" enctype="multipart/form-data" validate>
                        <div class="row clearfix">
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label>Profile Image</label>
                                        <input type="file" class="form-control mb-3" required name="image">
                                </div>
                            </div>
                            <br>
                            <div class="col-sm-12 mb-3">
                                <button type="submit" name="submit" class="btn btn-primary btn-sm"><i class="bi bi-pencil-square"></i> Submit</button>
                                <a href="profile.php" class="btn btn-outline-secondary btn-sm" title=""><i class="bi bi-x-circle"></i> Cancel</a>
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