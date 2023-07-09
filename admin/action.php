<?php
// Include the database connection file
include 'db_connect.php';
 
if (isset($_POST['countryId']) && !empty($_POST['countryId'])) {
 
 // Fetch state name base on country id
 $query = "SELECT * FROM refcitymun WHERE provCode = ".$_POST['countryId'];
 $result = $mysqli->query($query);
 
 if ($result->num_rows > 0) {
 echo '<option value="">Select Municipal</option>';
 while ($row = $result->fetch_assoc()) {
 echo '<option value="'.$row['citymunCode'].'" id="'.$row['citymunCode'].'">'.$row['citymunDesc'].'</option>';
 }
 } else {
 echo '<option value="">Municipal not available</option>';
 }
} elseif(isset($_POST['stateId']) && !empty($_POST['stateId'])) {
 
 // Fetch city name base on state id
 $query = "SELECT * FROM refbrgy WHERE citymunCode = ".$_POST['stateId'];
 $result = $mysqli->query($query);
 
 if ($result->num_rows > 0) {
 echo '<option value="">Select Barangay</option>';
 while ($row = $result->fetch_assoc()) {
 echo '<option value="'.$row['brgyCode'].'" id="'.$row['citymunCode'].'">'.$row['brgyDesc'].'</option>';
 }
 } else {
 echo '<option value="">Barangay not available</option>';
 }
}
?>