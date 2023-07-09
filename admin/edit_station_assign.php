<?php
session_start();
include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $user = $_POST["user_id"];
    $station = $_POST["station_id"];
    $id = $_GET['id'];
    do {
        if (empty($user) || empty($station) ) {
            $_SESSION['errormessage'] = "All the field are required";
           header("location: /admin/student_station_assign.php");
        } else {
            
            $sql = "UPDATE student_station SET s_id = '$user', sti_id = '$station' WHERE s_id = '$user'";
            $result = $mysqli->query($sql);
            if (!$result) {
                $_SESSION['errormessage'] = "Invalid query " . $mysqli->error;
                header("location: /admin/student_station_assign.php");
            }
            $user = "";
            $content = "";
            $sent = "";
            $_SESSION['successmessage'] = "Successful";
            header("location: /admin/student_station_assign.php");
            exit;
        }
    } while (false);
}
?>