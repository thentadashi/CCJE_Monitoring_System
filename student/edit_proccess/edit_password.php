<?php
session_start();
include '../../database/db_connect.php';
if (isset($_POST['submit'])) {
    $oldpass=$_POST["oldpass"];
    $newpass=$_POST["newpass"];
    $repass=$_POST["retypepass"];
    $user = $_SESSION["user"];
    $sql = "SELECT * from student_enroll where id=$user";
    $result = $mysqli->query($sql);
    while ($row = $result->fetch_assoc()) {

        if($oldpass == $row["password"] ){

            if($newpass==$repass){
                $insert = $mysqli->query("UPDATE student_enroll SET password='$newpass' where id=$user");
                if ($insert) {
                    $_SESSION['successmessage'] = 'success';
                    header("location: /CCJE_Monitoring_System/student/profile.php");
                  } else {
                    $_SESSION['errormessage'] = "Upload failed, please try again.";
                    header("location: /CCJE_Monitoring_System/student/profile.php");
                  }
            }else{
                $_SESSION['errormessage'] = "The Password not match";
            header("location: /CCJE_Monitoring_System/student/profile.php"); 
            }

        }else{
            $_SESSION['errormessage'] = "Wrong Password";
            header("location: /CCJE_Monitoring_System/student/profile.php");
        }

    }
}
