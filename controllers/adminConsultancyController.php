<?php
	require_once('../models/dbFunctions.php');
	session_start();

	if(isset($_POST['logout'])){
		session_destroy();
		header('location:../views/home.php');
	}

	if(isset($_POST['remove'])){
		$id = $_POST['remove'];
		$res = deleteConsultancy($id);
		if($res){
			$_SESSION['consultancyTableMsg'] = $id." has been removed from history!";
			header('location:../views/adminConsultancies.php');
		}
		else{
			$_SESSION['consultancyTableMsg'] = "Something went wrong. Try again!";
			header('location:../views/adminConsultancies.php');
		}
	}
?>