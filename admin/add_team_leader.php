<?php
session_start();

include 'db_connect.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $user = $_POST["user_id"];
    $station = $_POST["station_id"];
    do {

        if (empty($user) || empty($station)) {

            $_SESSION['errormessage'] = "All the field are required";
            header("location: /admin/team_leader_table.php");
        } else {
            $studentStationQuery = "SELECT * from team_leader_student WHERE sti_id  = $station";
            $studentStations = count($mysqli->query($studentStationQuery)->fetch_all(MYSQLI_ASSOC));

            if ($studentStations != 0) {
                $_SESSION['errormessage'] = "Station is already have team leader.";
                header("location: /CCJE_Monitoring_System/admin/team_leader_table.php");
                break;
            }


            $sql = "INSERT INTO team_leader_student (id,tl_id,sti_id)" .
                "VALUE ( NULL,'$user','$station')";

            $result = $mysqli->query($sql);

            if (!$result) {
                $_SESSION['errormessage'] = "Invalid query " . $mysqli->error;
                header("location: /CCJE_Monitoring_System/admin/team_leader_table.php");
            }
            // Send email
            $messagesql = "SELECT * FROM student_enroll WHERE id = $user";
            $msgresult = mysqli_query($mysqli, $messagesql);

            if (mysqli_num_rows($msgresult) > 0) {
                // Fetch the email address
                $row = mysqli_fetch_assoc($msgresult);

                $student_email = $row['email'];
                $studentpassword = $row['password'];
                $studentname = $row['last_name'] . ', ' . $row['first_name'] . ' ' . $row['middle_name'] . ' ' . $row['suffix_name'];

                // Send email to the student
                $subject = "no subject";
                $message = "You are assign as team leader in your station in https://e-crimsojtmanagement.online/<br> Your User ID : T" . $user . "<br> Password : " . $studentpassword;


                $mail = new PHPMailer(true);
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'johnlaurencerobeniol.bsit.ucu@gmail.com';
                $mail->Password = 'bcqbagmzjdogvomw';
                $mail->Port = 465;
                $mail->SMTPSecure = 'ssl';
                $mail->isHTML(true);
                $mail->setFrom('johnlaurencerobeniol.bsit.ucu@gmail.com', 'Admin');
                $mail->addAddress($student_email);
                $mail->Subject = ("Admin ($subject)");
                $mail->Body = $message;
                $mail->send();
            }
            header("location: /CCJE_Monitoring_System/admin/team_leader_table.php");
            exit;
        }
    } while (false);
}
