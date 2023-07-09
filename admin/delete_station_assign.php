<?php
session_start();
include 'db_connect.php';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE from student_station where s_id=$id";
    $result = $mysqli->query($sql);

    if (!$result) {
        $_SESSION['errormessage'] = "Invalid query " . $mysqli->error;
        header("location: /admin/student_station_assign.php");
    } else {
        $_SESSION['successmessage'] = "Successful";
        header("location: /admin/student_station_assign.php");
    }
}