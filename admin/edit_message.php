<?php
session_start();
include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $user = $_POST["message_user"];
    $content = $_POST["content"];
    $sent = $_POST["sent_to"];
    $id = $_GET['id'];
    do {
        if (empty($content) || empty($sent) || empty($user)) {
            $_SESSION['errormessage'] = "All the field are required";
            header("location: /admin/message.php");
        } else {
            
            $sql = "UPDATE message_db SET user_id = '$user', send_to_id = '$sent', message_content = '$content' WHERE message_id = '$id'";
            $result = $mysqli->query($sql);
            if (!$result) {
                $_SESSION['errormessage'] = "Invalid query " . $mysqli->error;
                header("location: /admin/message.php");
            }
            $user = "";
            $content = "";
            $sent = "";
            $_SESSION['successmessage'] = "Successful";
            header("location: /admin/message.php");
            exit;
        }
    } while (false);
}
?>
