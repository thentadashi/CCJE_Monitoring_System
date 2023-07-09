<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'head.php' ?>
    <title>Vaccination ID Approval</title>
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
                                <h1 class="mt-4">Vaccination ID Approval</h1>
                                </h1>
                                <ol class="breadcrumb mb-4">
                                    <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                                    <li class="breadcrumb-item active">Tables</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <?php include('alert_message.php'); ?>
                    <div class="card">
                        <div class="card-header">
                            Submitted FIles
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="datatablesSimple" class="table">
                                    <thead>
                                        <tr>
                                            <th class="cell">ID</th>
                                            <th class="cell">Name</th>
                                            <th class="cell">File</th>
                                            <th class="cell">Submitted date</th>
                                            <th class="cell">Process</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        include 'db_connect.php';
                                        $sql = "SELECT * from pending_vac join student_enroll on pending_vac.std_id=student_enroll.id ORDER BY pending_vac.date_time DESC";
                                        $result = $mysqli->query($sql);
                                        if (!$result) {
                                            die("Invalid query: " . $mysqli->error);
                                        }
                                        while ($row = $result->fetch_assoc()) {
                                        ?>
                                            <tr>
                                                <td><?php echo $row['std_id']; ?></td>
                                                <td><?php echo $row['last_name'] . ", " . $row['first_name'] . " " . $row['middle_name'] . " " . $row['suffix_name']; ?></td>
                                                <td><a href="<?php echo $row['file_path']; ?>" target="_blank"><?php echo $row['file_name']; ?></td>
                                                <td><?php echo date("M, d, Y g:i a", strtotime($row['date_time'])); ?></td>
                                                <td>
                                                    <a href='#approve_<?php echo $row['p_id']; ?>' class='btn btn-success btn-sm' data-bs-toggle='modal'><i class="bi bi-check-circle"></i> Approve</a>
                                                    <a href='#reject_<?php echo $row['p_id']; ?>' class='btn btn-danger btn-sm' data-bs-toggle='modal'><i class="bi bi-x-circle"></i> Reject</a>
                                                </td>
                                            </tr>
                                            <?php include('modal_approval_vi.php'); ?>
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
            </main>
        </div>
    </div>
    <?php include 'script.php' ?>
</body>

</html>