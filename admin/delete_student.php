<?php
session_start();
if (isset($_GET['id'])) {
include 'db_connect.php';
$id = $_GET['id'];

$sql4 = "DELETE from student_information where std_id=$id";
$result4=$mysqli->query($sql4);
if ( !$result4 ) {
    $_SESSION['errormessage'] = "Invalid query " . $mysqli->error;
    header("location: /admin/student_table.php");
} else {
    $_SESSION['successmessage'] = "Successful";
    header("location: /admin/student_table.php");
}

}
?>