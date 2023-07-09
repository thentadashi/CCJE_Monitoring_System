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
    $status = $_POST["status"];

    $sql2="SELECT provDesc FROM refprovince where provCode = $region";
    $sql3="SELECT citymunDesc FROM refcitymun where citymunCode = $municipal";
    $sql4="SELECT brgyDesc FROM refbrgy where brgyCode = $barangay";
    $result2 = $mysqli->query($sql2);
    $result3 = $mysqli->query($sql3);
    $result4 = $mysqli->query($sql4);
    while ($row2 = $result2->fetch_assoc()) {
        $newregion=$row2["provDesc"];
    }
    while ($row3 = $result3->fetch_assoc()) {
        $newmunicipal=$row3["citymunDesc"];
    }
    while ($row4 = $result4->fetch_assoc()) {
        $newbarangay=$row4["brgyDesc"];
    }

    do {

        if (
            empty($station) || empty($lname) || empty($fname) || empty($mname) || empty($sname) || empty($email)
            || empty($contact) || empty($newbarangay) || empty($assign) || empty($newregion) || empty($newmunicipal)
        ) {

            $_SESSION['errormessage'] = "All the field are required";
            header("location: /admin/station_info.php");
            exit;
            break;
        } else {


            $sql = "INSERT INTO station_info (sti_station,sti_lname,sti_fname,sti_mname,sti_sname,sti_assign_date,sti_email,sti_contact, sti_barangay,sti_municipal,sti_region,s_status)" .
                "VALUE ('$station','$lname', '$fname', '$mname', '$sname','$assign', '$email', '$contact','$newbarangay','$newmunicipal','$newregion','$status')";

            $result = $mysqli->query($sql);

            if (!$result) {
                $_SESSION['errormessage'] = "Invalid query " . $mysqli->error;
                header("location: /admin/station_info.php");
                exit;
                break;
            }
            $station = "";
            $fname = "";
            $lname = "";
            $mname = "";
            $sname = "";
            $assign = "";
            $contact = "";
            $email = "";
            $barangay = "";
            $municipal = "";
            $region = "";
            $_SESSION['successmessage'] = "Successful added new Station Information";

            header("location: /admin/station_info.php");
            exit;
        }
    } while (false);
}
