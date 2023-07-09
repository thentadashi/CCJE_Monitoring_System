<?php
session_start();
include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $lname = $_POST["Admin_Lname"];
    $mname = $_POST["Admin_Mname"];
    $fname = $_POST["Admin_Fname"];
    $sname = $_POST["Admin_Sname"];
    $email = $_POST["Admin_Email"];
    $password = $_POST["Admin_Password"];
    $repassword = $_POST["Admin_Re-Password"];
    $position = $_POST["Admin_Position"];
    $id = $_POST["Admin_Id"];
    $status = $_POST["status"];
    do {
        if (empty($lname) || empty($fname) || empty($mname)  || empty($id) || empty($email) || empty($password) || empty($repassword) || empty($position)) {
            $_SESSION['errormessage'] = "All the field are required";
            header("location: /admin/admin.php");
        }
        if (strlen($password) < 8 || !preg_match("/[a-z]/i", $password) || !preg_match("/[0-9]/", $password)) {
            $_SESSION['errormessage'] = "Password must be at least 8 characters and contain at least one number";
            header("location: /admin/admin.php");
        }
        if ($password != $repassword) {
            $_SESSION['errormessage'] = "Password not match";
           header("location: /admin/admin.php");
        }
        $password_hash = password_hash($password, PASSWORD_DEFAULT);
        $sql = "UPDATE admin_db
                SET admin_position ='$position', admin_lname ='$lname', admin_fname ='$fname', admin_mname ='$mname', admin_sname ='$sname',
                    admin_id ='$id', admin_email ='$email', admin_password='$password_hash', status ='$status' WHERE admin_id='$id'";
        $result = $mysqli->query($sql);
        if (!$result) {
            $_SESSION['errormessage'] = "Invalid query " . $mysqli->error;
            header("location: /admin/admin.php");
        }
        $_SESSION['successmessage'] = "Successful";
        header("location: /admin/admin.php");
        exit;
    } while (false);
}
    
?>