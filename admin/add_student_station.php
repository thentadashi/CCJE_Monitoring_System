<?php

session_start();
include 'db_connect.php';

$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $user = $stdid = $_POST["user_id"];
    $station = $_POST["station_id"];
    do {

        if (empty($user) || empty($station)) {

            $errorMessage = "All the field are required";
           header("location: /admin/student_station_assign.php");
        } else {

            $studentStationQuery = "SELECT * from student_station WHERE s_id = $user";
            $studentStations = count($mysqli->query($studentStationQuery)->fetch_all(MYSQLI_ASSOC));
            
            if ($studentStations != 0) {
                $_SESSION['errormessage'] = "Student is already in a Station.";
                header("location: /admin/student_station_assign.php");
                break;
            }

            $sql = "INSERT INTO student_station (id,s_id,sti_id)" .
                "VALUE ( NULL,'$user','$station')";

            $result = $mysqli->query($sql);

            if (!$result) {
                $_SESSION['errormessage'] = "Invalid query " . $mysqli->error;
               header("location: /admin/student_station_assign.php");
            }
            $stationQuery = "SELECT * from station_info WHERE sti_id = $station";
            $station = $mysqli->query($stationQuery)->fetch_all(MYSQLI_ASSOC)[0]['sti_station'];
            

            $content = "You have been assigned to $station Station.";
            $user = $_SESSION['user'];
            $sql = "INSERT INTO message_db ( user_id, send_to_id, message_content, is_read)" .
                "VALUE ('$user','$stdid', '$content', 0)";
            $result = $mysqli->query($sql);

            
            $user = "";
            $station  = "";
            $_SESSION['successmessage'] = "Successful!";
            header("location: /admin/student_station_assign.php");
            exit;
        }
    } while (false);
}
?>