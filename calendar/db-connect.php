<?php
$host = "localhost";
$dbname = "ccje_db";
$username = "root";
$password = "";
$conn = new mysqli($host, $username, $password, $dbname);
if(!$conn){
    die("Cannot connect to the database.". $conn->error);
}