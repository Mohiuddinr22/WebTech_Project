<?php
	require_once('../models/dbFunctions.php');
	require_once('../models/others.php');
	session_start();

	$action = $_POST['action'];

	if($action == 'back'){
		header('location:../views/home.php');
		session_destroy();
	}

	else if($action == 'client'){
		$_SESSION['newID'] = generateClientID();
		header('location:../views/clientReg.php');
	}

	else if($action == 'lawyer'){
		header('location:../views/lawyerReg.php');
	}
?>