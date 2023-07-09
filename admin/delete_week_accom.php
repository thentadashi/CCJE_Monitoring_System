<?php
session_start();
include 'db_connect.php';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE from week_accom where w_id=$id";
    $result = $mysqli->query($sql);

    if (!$result) {
        $_SESSION['errormessage'] = "Invalid query " . $mysqli->error;
        header("location: /admin/week_accom.php");
    } else {
        $_SESSION['successmessage'] = "Successful";
        header("location: /admin/week_accom.php");
    }
}