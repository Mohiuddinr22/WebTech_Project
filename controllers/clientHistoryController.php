<?php
	require_once('../models/dbFunctions.php');
	session_start();

	if(isset($_POST['logout'])){
		session_destroy();
		header('location:../views/home.php');
	}

	if(isset($_POST['rate'])){
		$consultancyID = $_POST['rate'];
		$rating = $_POST['rateSelect'];

		if($rating == 0 || is_null($rating)){
			$_SESSION['historyTableMsg'] = "Please choose a number to rate.";
			header('location:../views/clientHistory.php');
		}
		else{
			$res = rate($consultancyID, $rating);
			if($res){
				$lawyerID = $_SESSION['lawyerIDForRate'];
				$rating = generateRating(collectRating($lawyerID));
				pushRating($lawyerID, $rating);
				header('location:../views/clientHistory.php');
			}
			else{
				$_SESSION['historyTableMsg'] = "Something went wrong. Try again :)";
				header('location:../views/clientHistory.php');
			}
		}
	}
?>