<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'head.php' ?>
    <title>Student Requirements</title>
</head>

<body class="sb-nav-fixed">
    <?php include 'header.php' ?>
    <div id="layoutSidenav">
        <?php include 'nav.php' ?>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Students Requirements</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                        <li class="breadcrumb-item active">Tables</li>
                    </ol>
                    <?php include 'alert_message.php' ?>
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-message me-1"></i>
                            Student list
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th class="cell">ID</th>
                                        <th class="cell">Student Name</th>
                                        <th class="text-right">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    include '../database/db_connect.php';
                                    $stt = $_SESSION["userstation"];
                                    $sql = "SELECT * from student_station JOIN student_enroll ON student_station.s_id=student_enroll.id where student_enroll.status !='1' and student_station.sti_id=$stt";
                                    $result = $mysqli->query($sql);
                                    if (!$result) {
                                        die("Invalid query: " . $mysqli->error);
                                    }
                                    while ($row = $result->fetch_assoc()) {
                                    ?>
                                        <tr>
                                            <td><?php echo $row['id'] ?></td>
                                            <td><?php echo $row['last_name'] . ", " .  $row['first_name'] . " " .  $row['middle_name'] . " " .  $row['suffix_name'] ?></td>
                                            <td>
                                            <a href='#view_<?php echo $row['id']; ?>' class='btn btn-success btn-sm' data-bs-toggle='modal'><i class="bi bi-view-list"></i> View</a>
                                            </td>
                                        </tr>
                                        <?php include('modal_proccess/modal_view.php'); ?>
                                    <?php } ?>
                                </tbody>
                            </table>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <?php include 'script.php' ?>
</body>

</html>