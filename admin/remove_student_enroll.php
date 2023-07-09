<?php
session_start();
include 'db_connect.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	 $semester=$_POST['semester'];
	 $year=$_POST['year'];
	 $status=$_POST['status'];

	$sql = "SELECT * FROM student_enroll WHERE semester='$semester' AND YEAR(time_date)='$year'; ";
	$result = $mysqli->query($sql);
	$error='0';

	if ($result->num_rows > 0) {
	  // output data of each row
	  while($row = $result->fetch_assoc()) {
	  		$id=$row['id'];
	   		$sql1 = "UPDATE student_enroll SET status='$status' WHERE id='$id'";

			if ($mysqli->query($sql1) === TRUE) {
			  
			} else {
			  echo "Error updating record: " . $mysqli->error;
			  $error='1';
			}
			
	  }

	  if ($error=="1") {
                $_SESSION['errormessage'] = "Invalid query " . $mysqli->error;
                header("location: /admin/student_enrolled.php");
                
            }else{
            	$_SESSION['successmessage'] = "Successful";
            	header("location: /admin/student_enrolled.php");
            	
            }
	} else {
	  echo "0 results";
	}

}

?>