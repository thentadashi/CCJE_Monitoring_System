<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'head.php' ?>
    <title>Inbox</title>
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
                                <h1 class="mt-4">Inbox</h1>
                                <ol class="breadcrumb mb-4">
                                    <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                                    <li class="breadcrumb-item active">Inbox</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-message me-1"></i>
                            Inbox Message
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th class="cell">Message Content</th>
                                        <th class="cell">From</th>
                                        <th class="cell">Send Date/Time</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th class="cell">Message Content</th>
                                        <th class="cell">From</th>
                                        <th class="cell">Send Date/Time</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php
                                    include 'db_connect.php';
                                    $user = $_SESSION["user"];
                                    $sql1 = "SELECT * from message_db JOIN admin_db on message_db.user_id=admin_db.admin_id  where message_db.send_to_id=$user ORDER BY message_time_date DESC";
                                    $result1 = $mysqli->query($sql1);
                                    if (!$result1) {
                                        die("Invalid query: " . $mysqli->error);
                                    }
                                    while ($row1 = $result1->fetch_assoc()) {
                                        echo "
                                        <tr>
                                        <td>$row1[message_content]</td>
                                        <td>$row1[admin_lname], $row1[admin_fname] $row1[admin_mname] $row1[admin_sname]</td>
                                        <td>".date( "M, d, Y g:i a" ,strtotime($row1['message_time_date']))."</td>
                                        </tr>
                                        
                                        ";
                                    }
                                    $sql = "SELECT * from message_db JOIN student_enroll on message_db.user_id=student_enroll.id  where message_db.send_to_id=$user ORDER BY message_time_date DESC";
                                    $result = $mysqli->query($sql);
                                    if (!$result) {
                                        die("Invalid query: " . $mysqli->error);
                                    }
                                    while ($row = $result->fetch_assoc()) {
                                        echo "
                                        <tr>
                                        <td>$row[message_content]</td>
                                        <td>$row[last_name], $row[first_name] $row[middle_name] $row[suffix_name]</td>
                                        <td>".date( "M, d, Y g:i a" ,strtotime($row['message_time_date']))."</td>
                                        </tr>
                                        
                                        ";
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
    <?php include 'script.php' ?>
</body>

</html>