<?php
	function getConnection(){
		$hostName = "localhost";
		$userName = "root";
		$password = "";
		$dbName = "e-lawyerbd";
		$conn = new mysqli($hostName, $userName, $password, $dbName);
		return $conn;
	}
?>