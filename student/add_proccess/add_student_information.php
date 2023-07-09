<?php
session_start();
include '../../database/db_connect.php';

$studentid = $_SESSION["user"];
$userpic = '../uploads/user_profile.png';
$studentbirthday = $_POST["student_birthday"];
$studentsex = $_POST["student_sex"];
$studenttelno = $_POST["student_tel_no"];
$studentmobileno = $_POST["student_mobile_no"];
$barangay = $_POST["STI_Barangay"];
$region = $_POST["STI_Region"];
$municipal = $_POST["STI_Municipal"];
$gname = $_POST["g_name"];
$grel = $_POST["g_rel"];
$gmobile = $_POST["g_mobile"];

$sql2 = "SELECT provDesc FROM refprovince where provCode = $region";
$sql3 = "SELECT citymunDesc FROM refcitymun where citymunCode = $municipal";
$sql4 = "SELECT brgyDesc FROM refbrgy where brgyCode = $barangay";
$result2 = $mysqli->query($sql2);
$result3 = $mysqli->query($sql3);
$result4 = $mysqli->query($sql4);
while ($row2 = $result2->fetch_assoc()) {
    $newregion = $row2["provDesc"];
}
while ($row3 = $result3->fetch_assoc()) {
    $newmunicipal = $row3["citymunDesc"];
}
while ($row4 = $result4->fetch_assoc()) {
    $newbarangay = $row4["brgyDesc"];
}
do {
    $sql6 = "INSERT INTO student_information (std_id,birthday,sex,tel_no,mobile_no,province,municipal,barangay,g_name,g_rel,g_mobile)" .
        "VALUE ('$studentid','$studentbirthday','$studentsex','$studenttelno','$studentmobileno','$newregion','$newmunicipal','$newbarangay','$gname','$grel','$gmobile')";
    $sql5 = "INSERT INTO user_profile (std_id,profile)" .
        "VALUE ('$studentid','$userpic')";
    $result6 = $mysqli->query($sql6);
    $result5 = $mysqli->query($sql5);
    if (!$result5 || !$result6) {
        $_SESSION['errormessage'] = "Invalid query " . $mysqli->error;
        header("location: /CCJE_Monitoring_System/student/form.php");
    }
    $_SESSION['successmessage'] = "Success";
} while (false);
header("location: /CCJE_Monitoring_System/student/index.php");
exit;
