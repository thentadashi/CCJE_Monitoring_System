<?php

session_start();
require_once "../phpqrcode/qrlib.php";
include 'db_connect.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    function generateRandomString($length) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
        $max = strlen($characters) - 1;
        
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $max)];
        }
        
        return $randomString;
    }

    $id = $_POST["studentid"];
    $lname = $_POST["lastname"];
    $fname = $_POST["firstname"];
    $mname = $_POST["middlename"];
    $sname = $_POST["suffixname"];
    $email = $_POST["email"];
    $pass = generateRandomString(8);
    $status = "0";

    do {

        if (empty($id) || empty($lname) || empty($fname) || empty($mname) || empty($sname) || empty($block) || empty($sem) || empty($password)) {


            $_SESSION['errormessage'] = $id . $lname . $fname . $mname . $sname . $block . $sem . $password . $status;
            header("location: /CCJE_Monitoring_System/admin/student_enrolled.php");
        } else {
            $qrCodePath = "../qrcodes/" . $id . ".png"; // Path to store QR code image
            QRcode::png($id, $qrCodePath, QR_ECLEVEL_Q, 10, 2); // Generate and save QR code image

            $sql = "INSERT INTO student_enroll (id,last_name,first_name, middle_name, suffix_name,email, password, status)" .
            "VALUE ( '$id','$lname','$fname','$mname','$sname','$email','$pass','$status')";
            $sql3 = "INSERT INTO student_qrcode (std_id, path) VALUES ('$id', '$qrCodePath')";
            $result = $mysqli->query($sql);
            $result3 = $mysqli->query($sql3);

            if (!$result || !$result3) {
                $_SESSION['errormessage'] = "Invalid query " . $mysqli->error;
                header("location: /CCJE_Monitoring_System/admin/student_enrolled.php");
            }
            
            $_SESSION['successmessage'] = "Successful";
            header("location: /CCJE_Monitoring_System/admin/student_enrolled.php");
            exit;
        }
    } while (false);
}
