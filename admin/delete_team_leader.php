<?php
session_start();
include 'db_connect.php';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE from team_leader_student where tl_id=$id";
    $result = $mysqli->query($sql);

    if (!$result) {
        $_SESSION['errormessage'] = "Invalid query " . $mysqli->error;
        header("location: /admin/team_leader_table.php");
    } else {
        $_SESSION['successmessage'] = "Successful";
        header("location: /admin/team_leader_table.php");
    }
}