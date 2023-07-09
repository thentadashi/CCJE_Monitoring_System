<?php
session_start();
include '../../database/db_connect.php';

if (isset($_GET["id"])) {
    $stdid = $_GET["id"];
    $stid = $_GET["sid"];
    $path = $_GET["path"];
    $name = $_GET["name"];
    $sweek = $_GET["s_week"];
    $eweek = $_GET["e_week"];
    $sub = $_GET["date"];
    $action = $_GET["action"];
    $reason = $_GET["reason"];
    
    if ($action === 'accept') {
        $accepted_directory = '../uploads/weekly_report/';
        $file_name=basename($name);
        rename('../'.$path, "../".$accepted_directory . $file_name);
        $file_destination = "../uploads/weekly_report/" . $file_name;
        
        $user = $_SESSION['user'];
        if($user > 0){
            $sql = "DELETE FROM pending_wr WHERE p_id = $stdid";
        $sql2 = "INSERT into week_accom (std_id,file_path,file_name,start_week,	end_week,submit_date_time) VALUES ('$stid','$file_destination','$file_name','$sweek','$eweek','$sub')";
        $result = $mysqli->query($sql);
        $result2 = $mysqli->query($sql2);
        if (!$result || !$result2) {
            $_SESSION['errormessage'] = "Error: " . $sql . "<br>" . $mysqli->error;
            header("location: /CCJE_Monitoring_System/team_leader/pending_wr.php");
        }
        $content = 'Your Weekly report file '.$file_name.' name has been Approved';
        $sql3 = "INSERT INTO message_db ( user_id, send_to_id, message_content, is_read)" .
            "VALUE ('$user','$stid', '$content', '1')";
        $result3 = $mysqli->query($sql3);

        $_SESSION['successmessage'] = "File Approved successfully.";
        header("location: /CCJE_Monitoring_System/team_leader/pending_wr.php");
        }
        header("location: /CCJE_Monitoring_System/team_leader/pending_wr.php");

    }elseif ($action === 'reject') {
        $user = $_SESSION['user'];
        if($user > 0){
           unlink($path);
        $sql = "DELETE FROM pending_wr WHERE p_id = $stdid";
        $result = $mysqli->query($sql);
        $_SESSION['successmessage'] = "File reject successfully.";
        $content = 'Your Weekly report file '.$file_name.' has been Rejected. '. $reason;
        $sql2 = "INSERT INTO message_db ( user_id, send_to_id, message_content, is_read)" .
            "VALUE ('$user','$stid', '$content', '1')";
        $result2 = $mysqli->query($sql2);

        
        header("location: /CCJE_Monitoring_System/team_leader/pending_wr.php");
        if (!$result) {
            $_SESSION['errormessage'] = "Error: " . $sql . "<br>" . $mysqli->error;
            header("location: /CCJE_Monitoring_System/team_leader/pending_wr.php");
        } 
        header("location: /CCJE_Monitoring_System/team_leader/pending_wr.php");
        }
        
    }
}
