<?php
session_start();

$host = "localhost";
$dbname = "ccje_db";
$username = "root";
$password = "";

$mysqli = new mysqli($host, $username, $password, $dbname);

if ($mysqli->connect_errno) {
    die("Connection error: " . $mysqli->connect_error);

}
$user=$_SESSION["user"];

$sql = "SELECT * from student_information Where std_id=$user";
if ($result = $mysqli->query($sql))
while ($row = $result->fetch_assoc()) {
    $id=$row['std_id'];
}
$sql2 = "SELECT * from agreement Where std_id=$user";
if ($result2 = $mysqli->query($sql))
while ($row2 = $result->fetch_assoc()) {
    $id2=$row2['std_id'];
}


if($user == $id || $user == $id2 ){
    header("location: /CCJE_Monitoring_System/student/index.php");
}else{
    header("location: /CCJE_Monitoring_System/student/agreement.php");
}


?>