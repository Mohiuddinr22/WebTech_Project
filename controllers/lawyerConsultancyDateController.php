<?php
	require_once('../models/dbFunctions.php');
	require_once('../models/mail.php');
	session_start();

	if(isset($_POST['back'])){
		header('location:../views/lawyerRequest.php');
	}

	if(isset($_POST['confirm'])){
		$consultancyID = generateConsultancyID();
		$clientName = $_SESSION['clientName'];
		$clientID = $_SESSION['clientID'];
		$lawyerID = $_SESSION['lawyerID'];
		$lawyerName = $_SESSION['lawyerName'];
		$date = $_POST['consultancyDate'];
		$cfph = $_SESSION['cfph'];
		$rating = 0;
		$email = $_SESSION['clientEmail'];

		$res = acceptConsultancy($consultancyID, $clientName, $clientID, $lawyerName, $lawyerID, $date, $cfph, $rating);
		if($res){
			$msgBody = makeApprovalMailBody($lawyerName, $clientName);
			sendAcceptanceMail($email, $msgBody);
			removeConsultancy($lawyerID, $clientID);
			$_SESSION['lRequestTableMsg'] = $clientName." is now your client.";
			header('location:../views/lawyerRequest.php');
		}
		else{
			$_SESSION['consultancyTableMsg'] = "Something went wrong. Try again!";
			header('location:../views/lawyerConsultancyDate.php');
		}
	}
?>