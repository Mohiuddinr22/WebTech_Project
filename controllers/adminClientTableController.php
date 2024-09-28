<?php
	require_once('../models/dbFunctions.php');
	session_start();

	if(isset($_POST['logout'])){
		session_destroy();
		header('location:../views/home.php');
	}

	if(isset($_POST['remove'])){
		$id = $_POST['remove'];
		$res = removeClient($id);
		if($res){
			$_SESSION['clientTableMsg'] = "Client ".$id." has been removed!";
			header('location:../views/adminClient.php');
		}
	}

	if(isset($_POST['edit'])){
		$_SESSION['editClientID'] = $_POST['edit'];
		header('location:../views/adminClientEdit.php');
	}

	if(isset($_POST['update'])){
		$id = $_POST['id'];
		$name = $_POST['name'];
		$email = $_POST['email'];
		$contact = $_POST['contact'];
		$pass = $_POST['pass'];

		$res = updateClientDetails($id, $name, $email, $contact, $pass);
		if($res){
			$_SESSION['clientTableMsg'] = "User ".$id." details have been updated!";
			header('location:../views/adminClient.php');
		}
		else{
			$_SESSION['updateDetailsMsg'] = "Couldn't update details.";
			header('location:../views/adminClientEdit.php');
		}
	}

	if(isset($_POST['cancel'])){
		header('location:../views/adminClient.php');
	}

	if(isset($_POST['searchBtn'])){
		$_SESSION['searchText'] = $_POST['search'];
		header('location:../views/adminClient.php');
	}

	if(isset($_POST['refresh'])){
		header('location:../views/adminClient.php');
	}

?>