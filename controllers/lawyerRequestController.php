<?php
	require_once('../models/dbFunctions.php');
	require_once('../models/mail.php');
	session_start();
	
	if(isset($_POST['logout'])){
		session_destroy();
		header('location:../views/home.php');
	}

	if(isset($_POST['proceed'])){
		$lawyerID = $_SESSION['id'];
		$clientID = $_POST['proceed'];
		$lawyer = loadLawyerDetails($lawyerID);
		$client = loadClientDetails($clientID);

		$l = $lawyer->fetch_assoc();
		$_SESSION['lawyerID'] = $lawyerID;
		$_SESSION['lawyerName'] = $l['Name'];
		$_SESSION['cfph'] = $l['CFPH'];

		$c = $client->fetch_assoc();
		$_SESSION['clientID'] = $clientID;
		$_SESSION['clientName'] = $c['Name'];
		$_SESSION['clientEmail'] = $c['Email'];

		header('location:../views/lawyerConsultancyDate.php');
	}

	if(isset($_POST['reject'])){
		$lawyerID = $_SESSION['id'];
		$clientID = $_POST['reject'];
		$clientDetails = loadClientDetails($clientID);
		$lawyerDetails = loadLawyerDetails($lawyerID);
		$c = $clientDetails->fetch_assoc();
		$l = $lawyerDetails->fetch_assoc();
		$lawyerName = $l['Name'];
		$clientName = $c['Name'];
		$clientEmail = $c['Email'];


		$res = rejectConsultancy($lawyerID, $clientID);
		if($res){
			$msgBody = makeDeclineMailBody($lawyerName, $clientName);
			sendDeclineMail($clientEmail, $msgBody);
			$_SESSION['lRequestTableMsg'] = "Request from ".$clientName." has been rejected.";
			header('location:../views/lawyerRequest.php');
		}
		else{
			$_SESSION['lRequestTableMsg'] = "Something went wrong. Try again!";
			header('location:../views/lawyerRequest.php');
		}
	}
?>