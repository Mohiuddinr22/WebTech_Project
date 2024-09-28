<?php
	require_once('../models/dbFunctions.php');
	session_start();

	if(isset($_POST['logout'])){
		session_destroy();
		header('location:../views/home.php');
	}

	if(isset($_POST['searchBtn'])){
		$_SESSION['searchText'] = $_POST['search'];
		header('location:../views/clientSearch.php');
	}

	if(isset($_POST['refresh'])){
		header('location:../views/clientSearch.php');
	}

	if(isset($_POST['request'])){
		$lawyerID = $_POST['request'];
		$clientID = $_SESSION['id'];

		$_SESSION['lawyerID'] = $lawyerID;
		$numRow = pendingRequestCheck($clientID, $lawyerID);
		if($numRow >= 1){
			$_SESSION['searchTableMsg'] = "Request already sent, can't send again.";
			header('location:../views/clientSearch.php');
		}
		else{
			$res = sendRequest($clientID, $lawyerID);

			if($res) 
				header('location:../views/clientRequestSent.php');
			else {
				$_SESSION['searchTableMsg'] = "Can't send request due to some problem. Please try again.";
				header('location:../views/clientSearch.php');
			}
		}
	}

	if(isset($_POST['home'])){
		header('location:../views/clientHome.php');
	}
?>