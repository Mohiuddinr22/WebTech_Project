<?php
	require_once('../models/dbFunctions.php');
	session_start();

	$action = $_POST['action'];

	if($action == 'back'){
		header('location:../views/lawyerReg.php');
	}

	else if($action == 'confirm'){
		$name = $_SESSION['lawyerRegName'];
		$email = $_SESSION['lawyerRegEmail'];
		$bcNo = $_SESSION['lawyerRegBcNo'];
		$cNo = $_SESSION['lawyerRegCNo'];
		$pass = $_SESSION['lawyerRegPass'];
		$cfph = $_POST['consultancyFee'];

		if($cfph == ""){
			$_SESSION['selectFeeMsg'] = "Please select your consultancy fee first!";
			header('location:../views/lawyerRegFee.php');
		}
		else{
			$res = lawyerReg($name, $email, $bcNo, $cNo, $pass, $cfph);
			if($res == 1){
				header('location:../views/lawyerRegDone.php');
			}
			else{
				$_SESSION['selectFeeMsg'] = "Something went wrong!";
				header('location:../views/lawyerRegDone.php');
			}
		}
	}
?>