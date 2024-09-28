<?php
	require_once('../models/dbFunctions.php');
	session_start();

	$action = $_POST['action'];

	if($action == 'back'){
		header('location:../views/register.php');
		session_destroy();
	}

	else if($action == 'reg'){
		$id = $_SESSION['newID'];
		$name = $_POST['name'];
		$email = $_POST['email'];
		$cno = $_POST['cno'];
		$pass = $_POST['pass'];
		$confirmPass = $_POST['confirmPass'];

		if(empty($name)||empty($email)||empty($cno)||empty($pass)||empty($confirmPass)){
			$_SESSION['clientRegMsg'] = "Please fill up the form properly.";
			header('location:../views/clientReg.php');
		}
		else{
			$emailCheckNumRows = clientRegEmailCheck($email);
			if($emailCheckNumRows >= 1){
				$_SESSION['clientRegMsg'] = "Sorry! This email already exists.";
				header('location:../views/clientReg.php');
			}
			else{
				if($pass == $confirmPass){
					$res = clientReg($name, $id, $email, $cno, $pass);
					if($res == 1){
						session_destroy();
						session_start();
						$_SESSION['clientRegMsg'] = "Registration successfully done!";
						$_SESSION['newID'] = generateClientID();
						header('location:../views/clientReg.php');
					}
					else{
						$_SESSION['clientRegMsg'] = "Registration Failed!";
						header('location:../views/clientReg.php');
					}
				}
				else{
					$_SESSION['clientRegMsg'] = "Your passwords don't match. Try again!";
					header('location:../views/clientReg.php');
				}
			}
		}
	}
?>