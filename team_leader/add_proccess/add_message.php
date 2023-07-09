<?php
session_start();
include '../../database/db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $user = $_POST["message_user"];
    $content = $_POST["content"];
    $sent = $_POST["sent_to"];
    do {
        if (empty($content) || empty($sent) || empty($user)) {
            $_SESSION['errormessage'] = "All the field are required";
            header("location: CCJE_Monitoring_System/team_leader/message.php");
        } else {
            $sql = "INSERT INTO message_db ( user_id, send_to_id, message_content, is_read)" .
                "VALUE ('$user','$sent', '$content', 0)";
            $result = $mysqli->query($sql);
            if (!$result) {
                $_SESSION['errormessage'] = "Invalid query " . $mysqli->error;
                header("location: /CCJE_Monitoring_System/team_leader/message.php");
            }
            $user = "";
            $content = "";
            $sent = "";
            $_SESSION['successmessage'] = "Successful";
            header("location: /CCJE_Monitoring_System/team_leader/message.php");
            exit;
        }
    } while (false);
}
?>
