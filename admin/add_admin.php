<?php
session_start();

include 'db_connect.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

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

        if ( empty($lname) || empty($fname) || empty($mname) || empty($sname) || empty($id) || empty($email) || empty($password) || empty($repassword) || empty($position)) {

            $_SESSION['errormessage'] = "All the field are required";
            break;
        } else {

            if (strlen($password) < 8 || !preg_match("/[a-z]/i", $password) || !preg_match("/[0-9]/", $password)) {

                $_SESSION['errormessage']= "Password must be at least 8 characters and contain at least one number";
                break;
            }

            if ($password != $repassword) {

                $_SESSION['errormessage'] = "Password not match";
                break;
            }

            $password_hash = password_hash($password, PASSWORD_DEFAULT);

            $sql = "INSERT INTO admin_db (admin_id, admin_fname ,admin_lname, admin_mname, admin_sname, admin_position, admin_email, admin_password, status)" .
                "VALUE ('$id', '$fname', '$lname', '$mname', '$sname',' $position','$email', '$password_hash','$status')";

            $result = $mysqli->query($sql);

            if (!$result) {
                $_SESSION['errormessage'] = "Invalid query " . $mysqli->error;
                break;
            }
            $id = "";
            $fname = "";
            $lname = "";
            $mname = "";
            $sname = "";
            $position = "";
            $email == "";
            $password = "";


            $_SESSION['successmessage']= "Successful added new Admin";

            header("location: /admin/admin.php");
            exit;
        }
    } while (false);
}
?>