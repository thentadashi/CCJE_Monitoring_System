<?php
session_start();

include '../../database/db_connect.php';

    $studentid = $_SESSION["user"];
    $userpic = '../uploads/user_profile.png';
    $studentbirthday = $_POST["student_birthday"];
    $studentsex = $_POST["student_sex"];
    $studenttelno = $_POST["student_tel_no"];
    $studentmobileno = $_POST["student_mobile_no"];
    $studentemail = $_POST["student_email"];
    $gname =$_POST["g_name"];
    $grel =$_POST["g_rel"];
    $gmobile =$_POST["g_mobile"];
    do {
        $sql4 = "INSERT INTO student_information (std_id,birthday,sex,tel_no,mobile_no,email,g_name,g_rel,g_mobile)" .
            "VALUE ('$studentid','$studentbirthday','$studentsex','$studenttelno','$studentmobileno','$studentemail','$gname','$grel','$gmobile')";
        $sql5 = "INSERT INTO user_profile (std_id,profile)" .
            "VALUE ('$studentid','$userpic')";
            $result4 = $mysqli->query($sql4);
        $result5 = $mysqli->query($sql5);
        if (!$result5 || !$result4) {
            $_SESSION['errormessage'] = "Invalid query " . $mysqli->error;
            header("location: /CCJE_Monitoring_System/student/index.php");
        }
        $_SESSION['successmessage'] = "Success";
    } while (false);
    header("location: /CCJE_Monitoring_System/student/index.php");
    exit;

