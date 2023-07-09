<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'head.php' ?>
    <title>Student information</title>
</head>

<body class="sb-nav-fixed">
    <?php include 'header.php' ?>
    <div id="layoutSidenav">
        <?php include 'nav.php' ?>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <div class="container-fluid bg-white px-4 mb-2">
                        <div class="card bg-white mb-2">
                            <div class="card-body">
                                <div class="align-self-center">
                                    <h1 class="mt-1 ">Student List</h1>
                                    <ol class="breadcrumb mb-4">
                                        <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                                        <li class="breadcrumb-item active">Tables</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                        <?php include('alert_message.php'); ?>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Student DataTable
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="datatablesSimple" class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th class="cell">Student ID</th>
                                                <th class="cell">QR Code</th>
                                                <th class="cell">Full Name</th>
                                                <th class="cell">Email</th>
                                                <th class="">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            include 'db_connect.php';
                                            ?>

                                            <?php
                                            $sql = "SELECT * FROM student_enroll JOIN student_information ON student_enroll.id=student_information.std_id JOIN student_qrcode on student_enroll.id=student_qrcode.std_id WHERE student_enroll.status !='1' ORDER BY student_enroll.last_name ASC";
                                            $result = $mysqli->query($sql);

                                            if (!$result) {
                                                die("Invalid query: " . $mysqli->error);
                                            }

                                            while ($row = $result->fetch_assoc()) {
                                            ?>
                                                <tr>
                                                    <td><?php echo $row["id"]; ?></td>
                                                    <td><img src="<?php echo $row["path"]; ?>" width="50px" height="50px"></td>
                                                    <td><?php echo $row["last_name"] . ", " . $row["first_name"] . " " . $row["middle_name"] . " " . $row["suffix_name"]; ?></td>
                                                    <td><?php echo $row["email"]; ?></td>
                                                    <td>
                                                        <a href='#view_<?php echo $row['id']; ?>' class='btn btn-primary btn-sm' data-bs-toggle='modal'><i class="bi bi-view-list"></i> View</a>
                                                        <a href='#delete_<?php echo $row['id']; ?>' class='btn btn-danger btn-sm' data-bs-toggle='modal'><i class='bi bi-trash'></i> Delete</a>
                                                    </td>
                                                </tr>
                                                <?php include('modal_student.php'); ?>
                                            <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </main>
            <?php include 'footer.php' ?>
        </div>
    </div>
    <?php include 'script.php' ?>
</body>

</html>