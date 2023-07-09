<?php
session_start();
// Check if the scanned data is received
if (isset($_POST['scannedData']) && !empty($_POST['scannedData'])) {
    $scannedData = $_POST['scannedData'];

    // Perform necessary actions based on the scanned data
    // For example, query the database using the scanned data

    // Database connection details
    include '../database/db_connect.php';

    $stt = $_SESSION["userstation"];
    // Query the database using the scanned data
    $sql = "SELECT * FROM attendance_qrcode JOIN student_enroll on attendance_qrcode.std_id=student_enroll.id WHERE attendance_qrcode.sti_id= '$stt' and attendance_qrcode.std_id = '$scannedData' ORDER BY date_time DESC LIMIT 1; ";
    $result = $mysqli->query($sql);

    // Check if any rows are returned
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $name= $row['last_name'] . ", " . $row['first_name'] . " " . $row['middle_name'] . " " . $row['suffix_name'];
            $timeIn = $row['time_in'];
            $timeOut = $row['time_out'];
            $id=$row['c_id'];
            
                if ($timeOut !== null) {
                    // User is "out", insert a new record with time in
                    $query = "INSERT INTO attendance_qrcode (std_id, sti_id, time_in) VALUES ('$scannedData', '$stt', now())";
                    $mysqli->query($query);
                    $message = $name." Time In recorded successfully.";
                } else {
                    // User is "in", update the record with time out
                    $query = "UPDATE attendance_qrcode SET time_out = now() WHERE std_id = '$scannedData' AND sti_id = '$stt' AND c_id= $id";
                    $mysqli->query($query);
                    $message = $name. " Time Out recorded successfully.";
                }
            
        }
    } else {
        // No data found in the database for the scanned QR code
        // Insert a new record with time in
        $query = "INSERT INTO attendance_qrcode (std_id, sti_id, time_in) VALUES ('$scannedData', '$stt', NOW())";
        $mysqli->query($query);
        $message = $name." Time In recorded successfully.";
    }

    // Close the database connection
    $mysqli->close();
} else {
    // Scanned data not received
    $message = "Scanned data not received.";
}
$response = array('message' => $message);

// Send the response as JSON
header('Content-Type: application/json');
echo json_encode($response);
exit();