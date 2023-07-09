<?php

session_start();
include 'db_connect.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $id = $_GET['id'];
    $oldnum = $_POST['pastnum'];
    $num = $_POST['num'];
    $newnum = $oldnum + $num;

    if ($newnum >= "270") {

        $sql = "UPDATE student_time SET time_spend='$newnum' WHERE std_id = '$id';";
        $result = $mysqli->query($sql);

        $content = 'Congratulations for successfully completing your 270 hours of training! Your hard work and dedication have paid off. Well done!';
        $user = $_SESSION['user'];
        $sql = "INSERT INTO message_db ( user_id, send_to_id, message_content, is_read)" .
            "VALUE ('$user','$id', '$content', 0)";
        $result = $mysqli->query($sql);
        if (!$result) {
            $_SESSION['errormessage'] = "Invalid query " . $mysqli->error;
            header("location: /admin/student_time.php");
        }

        $_SESSION['successmessage'] = "Successful";
        header("location: /admin/student_time.php");
        exit;
    }
    $sql = "UPDATE student_time SET time_spend='$newnum' WHERE std_id = '$id';";
    $result = $mysqli->query($sql);

    if (!$result) {
        $_SESSION['errormessage'] = "Invalid query " . $mysqli->error;
        header("location: /admin/student_time.php");
    }

    $_SESSION['successmessage'] = "Successful";
    header("location: /admin/student_time.php");
    exit;
}
