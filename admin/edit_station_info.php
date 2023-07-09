<?php
session_start();
include 'db_connect.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $station = $_POST["STI_Station"];
    $lname = $_POST["STI_Lname"];
    $mname = $_POST["STI_Mname"];
    $fname = $_POST["STI_Fname"];
    $sname = $_POST["STI_Sname"];
    $assign = $_POST["STI_Assign"];
    $email = $_POST["STI_Email"];
    $contact = $_POST["STI_Contact"];
    $barangay = $_POST["STI_Barangay"];
    $region = $_POST["STI_Region"];
    $municipal = $_POST["STI_Municipal"];
    $id = $_GET['id'];

    do {

        if (
            empty($station) || empty($lname) || empty($fname) || empty($mname) || empty($email)
            || empty($contact) || empty($barangay) || empty($assign) || empty($region) || empty($municipal)
        ) {

            $_SESSION['errormessage']  = "All the field are required";
            header("location: /admin/station_info.php");
        }

        $sql = "UPDATE station_info
                SET sti_station ='$station', sti_lname ='$lname', sti_fname ='$fname', sti_mname ='$mname', sti_sname ='$sname',
                    sti_assign_date ='$assign', sti_email ='$email', sti_contact ='$contact', sti_barangay ='$barangay', sti_municipal ='$municipal',
                    sti_region ='$region'
            WHERE sti_id='$id'";

        $result = $mysqli->query($sql);

        if (!$result) {
            $_SESSION['errormessage'] = "Invalid query " . $mysqli->error;
           header("location: /admin/station_info.php");
        }

        $_SESSION['successmessage'] = "Successful";

        header("location: /admin/station_info.php");
        exit;
    } while (false);
}
