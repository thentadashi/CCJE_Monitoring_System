<?php
include '../database/db_connect.php';
$user = $_SESSION["user"];

$inboxQuery = "SELECT * from message_db where send_to_id=$user and is_read = 0";
$inbox =  count($mysqli->query($inboxQuery)->fetch_all(MYSQLI_ASSOC));
$inboxBadge = $inbox > 0 ? "<span class='custom-badge custom-badge-warning'>$inbox</span>" : '';


$totalRequirements = $pds = $pc = $pi = $vi = $pt = 0;
$user = $_SESSION["user"];
$stid = $_SESSION["userstation"];

$pdssql = "SELECT * from personal_sheet_db where std_id=$user";
$pds =  count($mysqli->query($pdssql)->fetch_all(MYSQLI_ASSOC));

$pcsql = "SELECT * from parent_con_db where std_id=$user";
$pc =  count($mysqli->query($pcsql)->fetch_all(MYSQLI_ASSOC));

$pisql = "SELECT * from philhealth_id_db where std_id=$user";
$pi =  count($mysqli->query($pisql)->fetch_all(MYSQLI_ASSOC));

$visql = "SELECT * from cer_vac_db where std_id=$user";
$vi =  count($mysqli->query($visql)->fetch_all(MYSQLI_ASSOC));

$wrQuery = "SELECT * from pending_wr JOIN student_station on student_station.s_id=pending_wr.std_id join student_enroll on pending_wr.std_id=student_enroll.id where student_station.sti_id=$stid ORDER BY pending_wr.date_time DESC";
$wr = count($mysqli->query($wrQuery)->fetch_all(MYSQLI_ASSOC));

$wrBadge = $wr > 0 ? "<span class='custom-badge custom-badge-warning'>$wr</span>" : '';

$isFemaleQuery = "SELECT * from student_information where std_id=$user";
$isFemaleResult = $mysqli->query($isFemaleQuery)->fetch_all(MYSQLI_ASSOC);
$isFemale = $isFemaleResult[0]['sex'] == 'Female';

$ptsql = "SELECT * from pregnancy_db where std_id=$user";
    $pt = count($mysqli->query($ptsql)->fetch_all(MYSQLI_ASSOC));

$totalRequirements = $pds + $pc + $pi + $vi + $pt;
$overAllRequirementCount = 5;
$pendingReq = $overAllRequirementCount - $totalRequirements;

$totalRequirementsBadge = $pendingReq > 0 ? "<span class='custom-badge custom-badge-danger'>$pendingReq</span>" : '';

$messageQuery = "SELECT * from message_db where user_id=$user";
$message =  count($mysqli->query($messageQuery)->fetch_all(MYSQLI_ASSOC));
$messageBadge = $message > 0 ? "<span class='custom-badge custom-badge-warning'>$message</span>" : '';

$totalMessage =  $inbox + $message;
$totalMessageBadge = $totalMessage > 0 ? "<span class='custom-badge custom-badge-warning'>$totalMessage</span>" : '';


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        .custom-badge-danger {
            color: #fff;
            background-color: #dc3545;
        }

        .custom-badge-warning {
            color: #212529;
            background-color: #ffc107;
        }

        .custom-badge {
            /* display: inline-block; */
            padding: 0.25em 0.4em;
            font-size: 75%;
            font-weight: 700;
            line-height: 1;
            text-align: center;
            white-space: nowrap;
            vertical-align: baseline;
            border-radius: 0.25rem;
            margin-left: 2px
        }
    </style>


</head>

<body>
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    <?php
                    include '../database/db_connect.php';
                    $user = $_SESSION["user"];
                    $sql20 = "SELECT * from user_profile join student_enroll on user_profile.std_id=student_enroll.id Where user_profile.std_id=$user";
                    if ($result20 = $mysqli->query($sql20))
                        while ($row20 = $result20->fetch_assoc()) {
                    ?>
                        <a class="nav-link" href="profile.php">
                            <div class="container-sm">
                                <img src="<?php echo $row20['profile'] ?>" class="card-rounded mx-auto d-block" style="width: 150px; height: 160px;" alt="...">
                                <div class="card-body text-center">
                                    <h6 class="my-3"><?php echo $row20['last_name'] . " " . $row20['first_name'] ?></h6>
                                    <p class="card-text"><?php echo $row20['id'] ?></p>
                                </div>
                            </div>
                        </a>
                    <?php
                        }
                    ?>
                    <div class="sb-sidenav-menu-heading">MENU</div>
                    <a class="nav-link" href="index.php">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Dashboard
                    </a>
                    <a class="nav-link" href="requirements.php">
                        <div class="sb-nav-link-icon"><i class="bi bi-list-task"></i></div>
                        Requirements <?= $totalRequirementsBadge ?>
                    </a>
                    <a class="nav-link" href="week_accom.php">
                        <div class="sb-nav-link-icon"><i class="bi bi-journal-album"></i></div>
                        My Weekly Reports 
                    </a>
                    <a class="nav-link" href="time_clock.php">
                        <div class="sb-nav-link-icon"><i class="bi bi-clock"></i></i></i></div>
                        Attendance
                    </a>
                    <a class="nav-link" href="pending_wr.php">
                        <div class="sb-nav-link-icon"><i class="bi bi-list-task"></i></div>
                        Pending Weekly Reports <?= $wrBadge ?>
                    </a>
                    <a class="nav-link" href="req.php">
                        <div class="sb-nav-link-icon"><i class="bi bi-list-task"></i></div>
                        Student Requirements 
                    </a>
                    <a class="nav-link" href="Team_weekly.php">
                        <div class="sb-nav-link-icon"><i class="bi bi-journal-album"></i></div>
                        Team Weekly Reports 
                    </a>
                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts3" aria-expanded="false" aria-controls="collapseLayouts">
                        <div class="sb-nav-link-icon btn-sm"><i class="fas fa-message"></i></div>
                        <?php
                        include '../database/db_connect.php';
                        $user = $_SESSION["user"];
                        $sql = "SELECT *, COUNT(*) AS unread_count FROM message_db WHERE send_to_id = $user AND is_read = 0";
                        $result = $mysqli->query($sql);
                        $row = $result->fetch_assoc();
                        $unread_count = $row["unread_count"];
                        $message_id = $row["message_id"];
                        ?>
                        <div class="messageContainer" data-message-id="$unread_count" onclick="markMessageAsRead($message_id)">
                            <span class="badge" id="notificationCount"></span>
                            Message
                        </div>

                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseLayouts3" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="inbox.php">
                                <div class="sb-nav-link-icon btn-sm"><i class="bi bi-chat-dots-fill"></i></div>
                                Inbox <?= $inboxBadge ?>
                            </a>
                            <a class="nav-link" href="message.php">
                                <div class="sb-nav-link-icon btn-sm"><i class="bi bi-chat-dots"></i></div>
                                Sent <?= $messageBadge ?>
                            </a>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="sb-sidenav-footer">
                <div class="small">Made By:</div>
                Team IT-ech
            </div>
        </nav>
    </div>
</body>
<script>
    function updateNotificationCount(messageId) {
        // Send an AJAX request to fetch the notification count
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'mark_message_as_read.php', true);

        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                // Update the notification count in the UI
                document.getElementById('notificationCount').textContent = xhr.responseText;
            }
        };

        xhr.send();
    }

    // Function to mark a message as read
    function markMessageAsRead() {
        // Send an AJAX request to mark the message as read
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'mark_message_as_read.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                // Update the UI or perform any additional actions as needed
                console.log('Message marked as read');
            }
        };
        xhr.send();
    }

    // Call the updateNotificationCount function periodically
    setInterval(updateNotificationCount, 1000);
</script>

</html>