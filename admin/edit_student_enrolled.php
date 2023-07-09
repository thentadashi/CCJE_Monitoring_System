<?php

session_start();
include 'db_connect.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $stdid = $_POST["studentid"];
    $lname = $_POST["lastname"];
    $fname = $_POST["firstname"];
    $mname = $_POST["middlename"];
    $sname = $_POST["suffixname"];
    $email = $_POST["email"];
    $status = $_POST["status"];
    $password = $_POST["password"];
    $id = $_GET['id'];

    do {

        if (empty($stdid) || empty($lname) || empty($fname) || empty($mname) || empty($password)) {

            $_SESSION['errormessage'] = "All the field are required";
            header("location: /CCJE_Monitoring_System/admin/student_enrolled.php");
        } else {
            $sql = "UPDATE student_enroll SET id='$stdid', last_name='$lname', first_name='$fname', middle_name='$mname', suffix_name='$sname', password='$password', email='$email', status='$status'  WHERE id = '$stdid';" ;
            $result = $mysqli->query($sql);

            if (!$result) {
                $_SESSION['errormessage'] = "Invalid query " . $mysqli->error;
               header("location: /CCJE_Monitoring_System/admin/student_enrolled.php");
            }
            $_SESSION['successmessage'] = "Successful";
            header("location: /CCJE_Monitoring_System/admin/student_enrolled.php");
            exit;
        }
    } while (false);
}
