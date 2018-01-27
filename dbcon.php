<?php 
	
	$servername = "localhost";
	$user = "root";
	$pass = "";
	$db = "db_sample";

	$conn = new mysqli($servername, $user, $pass, $db);

	if($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}

 ?>