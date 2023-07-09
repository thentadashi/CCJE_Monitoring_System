<?php
session_start();
include '../../database/db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $targetDirectory = '../pending/pending_wr/';

    // Process file upload
    if (!empty($_FILES['pdfFile']['name'])) {
        $fileName = basename($_FILES['pdfFile']['name']);
        $stdid = $_SESSION["user"];
        $start_w = $_POST["startweek"];
        $end_w = $_POST["endweek"];
        $newfileName = $stdid . '_' .$start_w.'-'.$end_w. '_' . $fileName;
        $targetFilePath = $targetDirectory . $newfileName;
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

        // Check if the file is a PDF
        if ($fileType === 'pdf') {
            // Move the uploaded file to the target directory
            if (move_uploaded_file($_FILES['pdfFile']['tmp_name'], "../" . $targetFilePath)) {
                // Store file information in the database
                $stmt = $mysqli->prepare("INSERT INTO pending_wr (std_id, file_name, file_path,start_week,end_week) VALUES (?, ?, ?,?,?)");
                $stmt->bind_param("sssss", $stdid, $newfileName, $targetFilePath, $start_w, $end_w);
                if ($stmt->execute()) {
                    $_SESSION['successmessage'] = "The file $fileName has been uploaded successfully. Please wait for review.";
                    header("Location: /CCJE_Monitoring_System/team_leader/week_accom.php");
                    exit();
                } else {
                    $_SESSION['errormessage'] = "Error: " . $stmt->error;
                    $stmt->close();
                    header("Location: /CCJE_Monitoring_System/team_leader/week_accom.php");
                    exit();
                }
            } else {
                $_SESSION['errormessage'] = "Sorry, there was an error uploading your file.";
                header("Location: /CCJE_Monitoring_System/team_leader/week_accom.php");
                exit();
            }
        } else {
            $_SESSION['errormessage'] = "Only PDF files are allowed.";
            header("Location: /CCJE_Monitoring_System/team_leader/week_accom.php");
            exit();
        }
    }
    
}
