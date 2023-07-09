<?php
session_start();
include 'db_connect.php';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE from admin_db where admin_id=$id";
    $result = $mysqli->query($sql);

    if (!$result) {
        $_SESSION['errormessage'] = "Invalid query " . $mysqli->error;
        header("location: /admin/admin.php");
    } else {
        $_SESSION['successmessage'] = "Successful";
        header("location: /admin/admin.php");
    }
}
