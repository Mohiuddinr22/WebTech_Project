<?php
	require_once('../models/dbFunctions.php');
	session_start();

	if(isset($_POST['logout'])){
		session_destroy();
		header('location:../views/home.php');
	}

	if(isset($_POST['remove'])){
		$id = $_POST['remove'];
		$res = removeLawyer($id);
		if($res){
			$_SESSION['lawyerTableMsg'] = "Lawyer ".$id." has been removed!";
			header('location:../views/adminLawyer.php');
		}
	}

	if(isset($_POST['edit'])){
		$_SESSION['editLawyerID'] = $_POST['edit'];
		header('location:../views/adminLawyerEdit.php');
	}

	if(isset($_POST['update'])){
		$id = $_POST['id'];
		$name = $_POST['name'];
		$email = $_POST['email'];
		$contact = $_POST['contact'];
		$cfph = $_POST['cfph'];
		$pass = $_POST['pass'];

		$res = updateLawyerDetails($id, $name, $email, $contact, $cfph, $pass);
		if($res){
			$_SESSION['lawyerTableMsg'] = $id." details have been updated!";
			header('location:../views/adminLawyer.php');
		}
		else{
			$_SESSION['updateDetailsMsg'] = "Couldn't update details.";
			header('location:../views/adminLawyerEdit.php');
		}
	}

	if(isset($_POST['cancel'])){
		header('location:../views/adminLawyer.php');
	}

	if(isset($_POST['searchBtn'])){
		$_SESSION['searchText'] = $_POST['search'];
		header('location:../views/adminLawyer.php');
	}

	if(isset($_POST['refresh'])){
		header('location:../views/adminLawyer.php');
	}
?>