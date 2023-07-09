<?php
session_start();
include '../../database/db_connect.php';
if (isset($_POST['submit'])) {
  $targetDirectory = '../pending/pending_pt/';

  // Process file upload
  if (!empty($_FILES['pdfFile']['name'])) {
      $fileName = basename($_FILES['pdfFile']['name']);
      $stdid = $_SESSION["user"];
      $newfileName = $stdid . '_' . $fileName;
      $targetFilePath = $targetDirectory . $newfileName;
      $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

      // Check if the file is a PDF
      if ($fileType === 'pdf') {
          // Move the uploaded file to the target directory
          if (move_uploaded_file($_FILES['pdfFile']['tmp_name'], "../".$targetFilePath)) {
              // Store file information in the database
              $stmt = $mysqli->prepare("INSERT INTO pending_preg (std_id, file_name, file_path) VALUES (?, ?, ?)");
              $stmt->bind_param("sss", $stdid, $newfileName, $targetFilePath);
              if ($stmt->execute()) {
                  $_SESSION['successmessage'] = "The file $newfileName has been uploaded successfully. Please wait for review.";
                  header("Location: /CCJE_Monitoring_System/team_leader/requirements.php");
                  exit();
              } else {
                  $_SESSION['errormessage'] = "Error: " . $stmt->error;
                  $stmt->close();
                  header("Location: /CCJE_Monitoring_System/team_leader/requirements.php");
                  exit();
              }
          } else {
              $_SESSION['errormessage'] = "Sorry, there was an error uploading your file.";
              header("Location: /CCJE_Monitoring_System/team_leader/requirements.php");
              exit();
          }
      } else {
          $_SESSION['errormessage'] = "Only PDF files are allowed.";
          header("Location: /CCJE_Monitoring_System/team_leader/requirements.php");
          exit();
      }
  }
}
