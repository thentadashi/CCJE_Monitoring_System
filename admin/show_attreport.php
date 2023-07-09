<?php
session_start();
include 'db_connect.php';
if (!empty($_GET["stationid"]) ||  !empty($_GET["status"]) || !empty($_GET['date'])) {
    $station = $_GET["stationid"];
    $status = $_GET["status"];
    $date = $_GET['date'];
    $sql2 = "SELECT * FROM attendance JOIN student_enroll ON student_enroll.id=attendance.std_id JOIN station_info on station_info.sti_id=attendance.sti_id WHERE attendance.sti_id='$station' AND attendance.att_attend='$status' AND attendance.att_date BETWEEN '$date' AND '$date';";
    $result2 = $mysqli->query($sql2);
    if (!$result2) {
        $_SESSION['errormessage'] = "Invalid query " . $mysqli->error;
        header("location: /admin/report.php");
    }
    if (mysqli_num_rows($result2) > 0) {
        while ($row2 = $result2->fetch_assoc()) {
            $_SESSION['table'] =  "
                <tr>
                <td>$row2[std_id]</td>
                <td>$row2[last_name], $row2[first_name] $row2[middle_name]  $row2[suffix_name]</td>
                <td>$row2[sti_id] - $row2[sti_station], $row2[sti_barangay], $row2[sti_municipal], $row2[sti_region]</td>
                <td>$row2[att_attend]</td>
                <td>$row2[att_date]</td>
                </tr>
                    ";
        }
        $_SESSION['successmessage'] = "Successful";
        header("location: /admin/report.php");
    } else {
        $_SESSION['table']= "No results found.";
        header("location: /admin/report.php");
    }
}
