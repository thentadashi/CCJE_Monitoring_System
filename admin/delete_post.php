<?php
session_start();
include 'db_connect.php';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE from post_db where post_id=$id";
    $result = $mysqli->query($sql);

    if (!$result) {
        $_SESSION['errormessage'] = "Invalid query " . $mysqli->error;
        header("location: /admin/post.php");
    } else {
        $_SESSION['successmessage'] = "Successful";
        header("location: /admin/post.php");
    }
}