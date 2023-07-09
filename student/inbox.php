<?php
session_start();
include('../database/db_connect.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'head.php' ?>
    <title>Inbox</title>
        <style>
        .modal-backdrop {
            opacity: 0.5; /* Adjust the opacity value as needed */
            background-color: #111; /* Adjust the background color as needed */
        }
        tr.highlighted,
        td.highlighted,
        a.highlighted {
            color:#111;
            text-decoration: none;
            font-weight: 700;
        }
        tr.light,
        td.light,
        a.light {
            color:#333;
            text-decoration: none;
            font-weight: 400;
        }

    </style>
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
                            Receive Message
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th class="cell">From</th>
                                            <th class="cell">Message Content</th>
                                            <th class="cell">Send Date/Time</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php

                                        $user = $_SESSION["user"];
                                        $sql1 = "SELECT * from message_db JOIN admin_db on message_db.user_id=admin_db.admin_id  where message_db.send_to_id=$user ORDER BY message_time_date DESC";
                                        $result1 = $mysqli->query($sql1);
                                        if (!$result1) {
                                            die("Invalid query: " . $mysqli->error);
                                        }
                                        while ($row1 = $result1->fetch_assoc()) {
                                            $rowClass = ($row1['is_read'] == 0) ? 'highlighted' : 'light';
                                            echo "<tr class='$rowClass'>
                                                <td class='$rowClass'><a href='#' class='message-row $rowClass' data-bs-toggle='modal' data-bs-target='#messageModal' data-message-content='".htmlspecialchars($row1['message_content'])."' data-message-id='".$row1['message_id']."' data-user-id='".$row1['send_to_id']. "' onclick='markMessageAsRead()'>" .$row1['admin_lname'].', '.$row1['admin_fname'].' '.$row1['admin_mname'].' '.$row1['admin_sname']."</a></td>
                                                <td class='message-content $rowClass'><a class='$rowClass'>".$row1['message_content']."<a></td>
                                                <td class='$rowClass'><a class='$rowClass'>".date("M, d, Y g:i a", strtotime($row1['message_time_date']))."</a></td>
                                            </tr>";
                                        }
                                        $sql = "SELECT * from message_db JOIN student_enroll on message_db.user_id=student_enroll.id  where message_db.send_to_id=$user ORDER BY message_time_date DESC";
                                        $result = $mysqli->query($sql);
                                        if (!$result) {
                                            die("Invalid query: " . $mysqli->error);
                                        }
                                        while ($row = $result->fetch_assoc()) {
                                            $rowClass = ($row['is_read'] == 0) ? 'highlighted' : 'light';
                                            echo "<tr class='$rowClass'>
                                                <td class='$rowClass'><a href='#' class='message-row $rowClass' data-bs-toggle='modal' data-bs-target='#messageModal' data-message-content='".htmlspecialchars($row['message_content'])."' data-message-id='".$row['message_id']."' data-user-id='".$row['send_to_id']."'>".$row['last_name'].', '.$row['first_name'].' '.$row['middle_name'].' '.$row['suffix_name']."</a></td>
                                                <td class='message-content $rowClass'><a class='$rowClass'>".$row['message_content']."</a></td>
                                                <td class='$rowClass'><a class='$rowClass'>".date("M, d, Y g:i a", strtotime($row['message_time_date']))."</a></td>
                                            </tr>";
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
    <!-- Modal -->
<!-- Modal -->
<!-- Modal -->
<div class="modal fade" id="messageModal" tabindex="-1" aria-labelledby="messageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="messageModalLabel">Message</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div>
                    <strong>From: </strong>
                    <span id="name"></span>
                </div>
                <div>
                    <strong>Message Content: </strong>
                    <span id="messageContent"></span>
                </div>
                <div>
                    <strong>Time: </strong>
                    <span id="messageTime"></span>
                </div>

                  <input type="hidden" id="userId"/>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>



    <?php include 'script.php' ?>
    

    <script>
    function showModal(event) {
        var messageContent = event.target.getAttribute('data-message-content');
        var messageId = event.target.getAttribute('data-message-id');
        var userId = event.target.getAttribute('data-user-id');

        document.getElementById("messageContent").textContent = messageContent;
        document.getElementById("userId").textContent = userId;

        $.ajax({
            url: 'get_message_details.php',
            method: 'GET',
            data: { messageId: messageId, userId: userId },
            success: function(response) {
                document.getElementById("messageContent").textContent = response.messageContent;
                document.getElementById("messageTime").textContent = response.messageTime;
                document.getElementById("name").textContent = response.name;

            },
            error: function() {

            }
        });

        var messageModal = new bootstrap.Modal(document.getElementById('messageModal'));
        messageModal.show();
    }

    document.querySelector("#datatablesSimple tbody").addEventListener("click", function(event) {
        if (event.target.classList.contains('message-row')) {
            showModal(event);
        }
    });


        var messageModal = document.getElementById('messageModal');
    messageModal.addEventListener('hidden.bs.modal', function(event) {
        var backdrop = document.querySelector('.modal-backdrop');
        if (backdrop) {
            backdrop.parentNode.removeChild(backdrop);
            location.reload();
        }
    });


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
    // Retrieve the message ID from the messageContainer data attribute
    var messageId = event.target.getAttribute('data-message-id');

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
    xhr.send('markAsRead=' + messageId); // Pass the messageId as POST data
}

    // Call the updateNotificationCount function periodically
    setInterval(updateNotificationCount, 1000);
    </script>
</body>

</html>
