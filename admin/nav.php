<?php
include 'db_connect.php';

$totalPending = $pds = $pc = $pi = $vi = $pt = $message = $inbox = 0;
$pdsQuery = "SELECT * from pending_sheet join student_enroll on pending_sheet.std_id=student_enroll.id ORDER BY pending_sheet.date_time DESC";
$pds = count($mysqli->query($pdsQuery)->fetch_all(MYSQLI_ASSOC));

$pcQuery = "SELECT * from pending_consent join student_enroll on pending_consent.std_id=student_enroll.id ORDER BY pending_consent.date_time DESC";
$pc = count($mysqli->query($pcQuery)->fetch_all(MYSQLI_ASSOC));

$piQuery = "SELECT * from pending_phil join student_enroll on pending_phil.std_id=student_enroll.id ORDER BY pending_phil.date_time DESC";
$pi = count($mysqli->query($piQuery)->fetch_all(MYSQLI_ASSOC));

$viQuery = "SELECT * from pending_vac join student_enroll on pending_vac.std_id=student_enroll.id ORDER BY pending_vac.date_time DESC";
$vi = count($mysqli->query($viQuery)->fetch_all(MYSQLI_ASSOC));

$ptQuery = "SELECT * from pending_preg join student_enroll on pending_preg.std_id=student_enroll.id ORDER BY pending_preg.date_time DESC";
$pt = count($mysqli->query($ptQuery)->fetch_all(MYSQLI_ASSOC));

$totalPending = $pds + $pc + $pi + $vi + $pt;

$totalPendingBadge = $totalPending > 0 ? "<span class='custom-badge custom-badge-warning'>$totalPending</span>" : '';
$pdsBadge = $pds > 0 ? "<span class='custom-badge custom-badge-warning'>$pds</span>" : '';
$pcBadge = $pc > 0 ? "<span class='custom-badge custom-badge-warning'>$pc</span>" : '';
$piBadge = $pi > 0 ? "<span class='custom-badge custom-badge-warning'>$pi</span>" : '';
$viBadge = $vi > 0 ? "<span class='custom-badge custom-badge-warning'>$vi</span>" : '';
$ptBadge = $pt > 0 ? "<span class='custom-badge custom-badge-warning'>$pt</span>" : '';

$user = $_SESSION["user"];

$inboxQuery = "SELECT * from message_db where send_to_id=$user and is_read = 0";
$inbox =  count($mysqli->query($inboxQuery)->fetch_all(MYSQLI_ASSOC));
$inboxBadge = $inbox > 0 ? "<span class='custom-badge custom-badge-warning'>$inbox</span>" : '';

$messageQuery = "SELECT * from message_db where user_id=$user";
$message =  count($mysqli->query($messageQuery)->fetch_all(MYSQLI_ASSOC));
$messageBadge = $message > 0 ? "<span class='custom-badge custom-badge-warning'>$message</span>" : '';

$totalMessage =  $inbox + $message;
$totalMessageBadge = $totalMessage > 0 ? "<span class='custom-badge custom-badge-warning'>$totalMessage</span>" : '';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'head.php' ?>
</head>
<style>
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

<body>
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    <div class="sb-sidenav-menu-heading">MENU</div>
                    <a class="nav-link" href="index.php">
                        <div class="sb-nav-link-icon "><i class="fas fa-tachometer-alt"></i></div>
                        Dashboard
                    </a>
                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts9" aria-expanded="false" aria-controls="collapseLayouts">
                        <div class="sb-nav-link-icon "><i class="bi bi-people-fill"></i></div>
                        Manage Student
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseLayouts9" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="student_enrolled.php">
                                <div class="sb-nav-link-icon btn-sm"><i class="fas fa-user"></i></div>
                                Student Enrolled
                            </a>
                            <a class="nav-link" href="set_blk.php">
                                <div class="sb-nav-link-icon btn-sm"><i class="fas fa-user"></i></div>
                                Set Student
                            </a>
                            <a class="nav-link" href="student_table.php">
                                <div class="sb-nav-link-icon btn-sm"><i class="fas fa-user"></i></div>
                                Student Information
                            </a>
                            <a class="nav-link" href="team_leader_table.php">
                                <div class="sb-nav-link-icon btn-sm"><i class="fas fa-user"></i></div>
                                Team Leader
                            </a>
                            <a class="nav-link" href="student_archive.php">
                                <div class="sb-nav-link-icon btn-sm"><i class="fas fa-user"></i></div>
                                Archive Student
                            </a>
                        </nav>
                    </div>
                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts1" aria-expanded="false" aria-controls="collapseLayouts">
                        <div class="sb-nav-link-icon "><i class="bi bi-people-fill"></i></div>
                        Manage Admin
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseLayouts1" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="admin.php">
                                <div class="sb-nav-link-icon btn-sm"><i class="fas fa-user"></i></div>
                                Admin
                            </a>
                            <a class="nav-link" href="admin_archive.php">
                                <div class="sb-nav-link-icon btn-sm"><i class="fas fa-user"></i></div>
                                Archive Admin
                            </a>
                        </nav>
                    </div>
                    <a class="nav-link collapsed " href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts5" aria-expanded="false" aria-controls="collapseLayouts">
                        <div class="sb-nav-link-icon btn-sm"><i class="bi bi-card-checklist"></i> </div>
                        Pending Approval <?= $totalPendingBadge ?>
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseLayouts5" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="approval_pds.php">
                                <div class="sb-nav-link-icon btn-sm"><i class="bi bi-inboxes"></i></div>
                                Personal Data Sheet <?= $pdsBadge ?>
                            </a>
                            <a class="nav-link" href="approval_pc.php">
                                <div class="sb-nav-link-icon btn-sm"><i class="bi bi-inboxes"></i></div>
                                Parent Consent Approval <?= $pcBadge ?>
                            </a>
                            <a class="nav-link" href="approval_pi.php">
                                <div class="sb-nav-link-icon btn-sm"><i class="bi bi-inboxes"></i></div>
                                PhilHealth ID Approval <?= $piBadge ?>
                            </a>
                            <a class="nav-link" href="approval_vi.php">
                                <div class="sb-nav-link-icon btn-sm"><i class="bi bi-inboxes"></i></div>
                                Vaccination ID Approval <?= $viBadge ?>
                            </a>
                            <a class="nav-link" href="approval_pt.php">
                                <div class="sb-nav-link-icon btn-sm"><i class="bi bi-inboxes"></i></i></div>
                                Medical Cert Approval <?= $ptBadge ?>
                            </a>
                            <a class="nav-link" href="come_soon.php">
                                <div class="sb-nav-link-icon btn-sm"><i class="bi bi-inboxes"></i></i></div>
                                other
                            </a>
                        </nav>
                    </div>
                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts4" aria-expanded="false" aria-controls="collapseLayouts">
                        <div class="sb-nav-link-icon btn-sm"><i class="bi bi-archive"></i></div>
                        Reports
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseLayouts4" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="report.php">
                                <div class="sb-nav-link-icon btn-sm"><i class="bi bi-card-checklist"></i></i></div>
                                Attendance Report
                            </a>
                            <a class="nav-link" href="sub_report.php">
                                <div class="sb-nav-link-icon btn-sm"><i class="bi bi-card-list"></i></div>
                                Submission Report
                            </a>
                            <a class="nav-link" href="station_report.php">
                                <div class="sb-nav-link-icon btn-sm"><i class="bi bi-card-list"></i></div>
                                Student Station Report
                            </a>
                            <a class="nav-link" href="wa_report.php">
                                <div class="sb-nav-link-icon btn-sm"><i class="bi bi-card-list"></i></div>
                                Weekly Report
                            </a>
                        </nav>
                    </div>

                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts2" aria-expanded="false" aria-controls="collapseLayouts">
                        <div class="sb-nav-link-icon btn-sm"><i class="bi bi-building"></i></div>
                        Station Information
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseLayouts2" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="station_info.php">
                                <div class="sb-nav-link-icon btn-sm"><i class="bi bi-building-dash"></i></div>
                                Station Info
                            </a>
                            <a class="nav-link" href="student_station_assign.php">
                                <div class="sb-nav-link-icon btn-sm"><i class="bi bi-building-add"></i></div>
                                Student Station Assign
                            </a>
                            <a class="nav-link" href="archive_station.php">
                                <div class="sb-nav-link-icon btn-sm"><i class="bi bi-building-dash"></i></div>
                                Archive Station Info
                            </a>
                        </nav>
                    </div>
                    <a class="nav-link" href="week_accom.php">
                        <div class="sb-nav-link-icon btn-sm"><i class="fas fa-book"></i></div>
                        Weekly Report Table
                    </a>
                    <a class="nav-link" href="student_time.php">
                        <div class="sb-nav-link-icon btn-sm"><i class="bi bi-hourglass-bottom"></i></i></div>
                        Attendance Time Sheet
                    </a>
                    <!--<a class="nav-link" href="att_report.php">-->
                    <!--    <div class="sb-nav-link-icon btn-sm"><i class="fas fa-book"></i></div>-->
                    <!--    Attendance-->
                    <!--</a>-->
                    <a class="nav-link" href="sub_requirement.php">
                        <div class="sb-nav-link-icon btn-sm"><i class="fas fa-book"></i></div>
                        Submitted Requirements
                    </a>
                    <a class="nav-link" href="post.php">
                        <div class="sb-nav-link-icon btn-sm"><i class="fas fa-pen-to-square"></i></div>
                        Announcement News
                    </a>
                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts3" aria-expanded="false" aria-controls="collapseLayouts">
                        <div class="sb-nav-link-icon btn-sm"><i class="fas fa-message"></i></div>
                        <?php
                        include 'db_connect.php';
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
                <div class="small">Made By: Team IT-ech</div>
            </div>
        </nav>
    </div>
    <?php include 'script.php' ?>
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