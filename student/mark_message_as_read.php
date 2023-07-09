<?php 
include '../database/db_connect.php';
session_start();

$user = $_SESSION["user"];
if (isset($_POST['markAsRead'])) {
    // Retrieve the message ID from the AJAX request
    $messageId = $_POST['markAsRead'];

    // Update the is_read column in the database for the specified message
    $sql = "UPDATE message_db SET is_read = '1' WHERE message_id = $messageId";
    $result = $mysqli->query($sql);

    // Return a response indicating the success of the update operation
    if ($result) {
        echo "Message marked as read";
    } else {
        echo "Failed to mark message as read";
    }
    
} else {
    // Retrieve the notification count
    $sql = "SELECT COUNT(*) AS unread_count FROM message_db WHERE send_to_id = $user AND is_read = '0'";
    $result = $mysqli->query($sql);
    $row = $result->fetch_assoc();
    $unread_count = $row["unread_count"];

    // Return the notification count as the response
    echo $unread_count;
}
?>