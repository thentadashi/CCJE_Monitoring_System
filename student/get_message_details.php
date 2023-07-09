<?php
session_start();
include('../database/db_connect.php');

$messageId = $_GET['messageId'];
$userId = $_GET['userId'];

$sql = "SELECT message_db.message_id, message_db.send_to_id, message_db.message_content, message_db.message_time_date,
        admin_db.admin_lname, admin_db.admin_fname, admin_db.admin_mname, admin_db.admin_sname,
        student_enroll.last_name, student_enroll.first_name, student_enroll.middle_name, student_enroll.suffix_name
        FROM message_db
        LEFT JOIN admin_db ON message_db.user_id = admin_db.admin_id
        LEFT JOIN student_enroll ON message_db.user_id = student_enroll.id
        WHERE message_db.message_id = ? AND message_db.send_to_id = ?";

        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param('ii', $messageId, $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        $messageDetails = $result->fetch_assoc();
        $stmt->close();
        $response = array(
            'messageId' => $messageDetails['message_id'],
            'userId' => $messageDetails['send_to_id'],
            'messageContent' => $messageDetails['message_content'],
            'messageTime' => $messageDetails['message_time_date'],
            'name' => isset($messageDetails['admin_lname']) ? $messageDetails['admin_lname'] . ', ' . $messageDetails['admin_fname'] . ' ' . $messageDetails['admin_mname'] . ' ' . $messageDetails['admin_sname'] : $messageDetails['last_name'] . ', ' . $messageDetails['first_name'] . ' ' . $messageDetails['middle_name'] . ' ' . $messageDetails['suffix_name']

        );

header('Content-Type: application/json');
echo json_encode($response);
?>
