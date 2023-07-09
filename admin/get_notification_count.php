<?php 
include 'db_connect.php';
session_start();

$user = $_SESSION["user"];
$sql = "SELECT COUNT(*) AS unread_count FROM message_db WHERE send_to_id = $user AND is_read = 0";
$result = $mysqli->query($sql);
$row = $result->fetch_assoc();
$unread_count = $row["unread_count"];
echo $unread_count;
?>