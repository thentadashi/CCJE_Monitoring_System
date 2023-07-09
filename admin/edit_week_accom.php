<?php
session_start();
include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Check if both image files are present
    if (!empty($_FILES['image1']['name'])) {
        // Set the target directory where the images will be saved
        $target_dir = "../uploads/";

        // Get the filename and extension of each image file
        $image1_name = basename($_FILES["image1"]["name"]);
        $image1_ext = pathinfo($image1_name, PATHINFO_EXTENSION);

        // Generate a unique name for each image to prevent overwriting
        $image1_newname = uniqid('wa_', true) . "." . $image1_ext;

        // Set the target paths for each image file
        $target_file1 = $target_dir . $image1_newname;
        $allowTypes = array('jpg', 'png', 'jpeg', 'gif');
        if (in_array($image1_ext, $allowTypes)) {
            $image = $_FILES['image1']['tmp_name'];
            $stdid = $_POST["user_id"];
            $start_w = $_POST["startweek"];
            $end_w = $_POST["endweek"];
            $id=$_GET["id"];


            // Insert image content into database 
            $sql = "UPDATE week_accom SET std_id='$stdid',image1='$target_file1',start_week='$start_w',end_week='$end_w' WHERE w_id=$id";

            $result = $mysqli->query($sql);

            move_uploaded_file($_FILES['image1']['tmp_name'], "$target_file1");

            if ($result) {
                $_SESSION['successmessage'] = 'edit image submitted.';
                header("location: /admin/week_accom.php");
            } else {
                echo "Invalid query " . $mysqli->error;
                $_SESSION['errormessage'] = "File upload failed, please try again.";
                header("location: /admin/week_accom.php");
            }
        } else {
            $_SESSION['errormessage'] = 'Sorry, only JPG, JPEG, PNG, & GIF files are allowed to upload.';
            header("location: /admin/week_accom.php");
        }
    } else {
        $_SESSION['errormessage']  = 'Please select an image file to upload.';
        header("location: /admin/week_accom.php");
    }
}

