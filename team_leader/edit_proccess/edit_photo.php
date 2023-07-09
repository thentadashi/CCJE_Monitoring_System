<?php
session_start();
include '../../database/db_connect.php';
if (isset($_POST['submit'])) {
    $user = $_SESSION["user"];
    if (!empty($_FILES['image']['name'])) {
        $target_dir = "../uploads/";
        $image1_name = basename($_FILES["image"]["name"]);
        $image1_ext = pathinfo($image1_name, PATHINFO_EXTENSION);
        $target_file1 = $target_dir .  $image1_name;
        $allowTypes = array('jpg', 'png', 'jpeg', 'gif');
        if (in_array($image1_ext, $allowTypes)) {
            $insert = $mysqli->query("UPDATE user_profile SET profile='$target_file1' where std_id=$user");
            move_uploaded_file($_FILES['image']['tmp_name'], "$target_file1");
            if ($insert) {
                $_SESSION['successmessage'] = 'success';
                header("location: CCJE_Monitoring_System/team_leader/profile.php");
              } else {
                $_SESSION['errormessage'] = "File upload failed, please try again.";
                header("location: CCJE_Monitoring_System/team_leader/profile.php");
              }
        }else {
            $_SESSION['errormessage']  = 'Sorry, only JPG, JPEG, PNG, & GIF files are allowed to upload.';
            header("location: CCJE_Monitoring_System/team_leader/profile.php");
          }
    }else {
        $_SESSION['errormessage']  = 'Please select an image file to upload.';
        header("location: CCJE_Monitoring_System/team_leader/profile.php");
      }
}

?>