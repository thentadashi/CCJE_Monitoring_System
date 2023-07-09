<?php
session_start();

include 'db_connect.php';
if (isset($_POST["submit"])) {
    
    if (!empty($_FILES["image"]["name"])) {
        $target_dir = "../uploads/";
        $id = $_GET['id'];
        // Get file info 
        $content = $_POST["post_content"];
        $fileName = basename($_FILES["image"]["name"]);
        $fileType = pathinfo($fileName, PATHINFO_EXTENSION);
        $target_file1 = $target_dir .  $fileType;
        // Allow certain file formats 
        $allowTypes = array('jpg', 'png', 'jpeg', 'gif');
        if (in_array($fileType, $allowTypes)) {
            $image = $_FILES['image']['tmp_name'];
            // Insert image content into database 
            $insert = $mysqli->query(" UPDATE post_db SET post_content='$content', post_image='$target_file1' WHERE post_id = '$id';");
            move_uploaded_file($_FILES['image']['tmp_name'], "$target_file1");

            if ($insert) {
                $_SESSION['successmessage'] = 'success';
                header("location: /admin/post.php");
            } else {
                $_SESSION['errormessage'] = "File upload failed, please try again.";
                header("location: /admin/post.php");
            }
        } else {
            $_SESSION['errormessage'] = 'Sorry, only JPG, JPEG, PNG, & GIF files are allowed to upload.';
            header("location: /admin/post.php");
        }
    } else {
        $_SESSION['errormessage'] = 'Please select an image file to upload.';
        header("location: /admin/post.php");
    }
}
