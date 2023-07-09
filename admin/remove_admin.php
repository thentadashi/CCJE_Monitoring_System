<?php
session_start();
include 'db_connect.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	 $id=$_POST['id'];
	 $status=$_POST['status'];


	   		$sql1 = "UPDATE admin_db SET status='$status' WHERE admin_id='$id'";

			if ($mysqli->query($sql1) === TRUE) {
			  
			} else {
			  echo "Error updating record: " . $mysqli->error;
			  $error='1';
			}
			
	  if ($error=="1") {
                $_SESSION['errormessage'] = "Invalid query " . $mysqli->error;
                header("location: /admin/admin.php");
                
            }else{
            	$_SESSION['successmessage'] = "Successful";
            	header("location: /admin/admin.php");
            	
            }
	

}

?>