<?php
	require_once('../models/dbFunctions.php');
	session_start();

	$action = $_POST['action'];

	if($action == 'back'){
		header('location:../views/register.php');
		session_destroy();
	}

	else if($action == 'reg'){
		$name = $_POST['name'];
		$email = $_POST['email'];
		$bcNo = $_POST['bcNo'];
		$cNo = $_POST['cno'];
		$pass = $_POST['pass'];
		$confirmPass = $_POST['confirmPass'];

		if(empty($name)||empty($email)||empty($bcNo)||empty($cNo)||empty($pass)||empty($confirmPass)){
			session_destroy();
			session_start();
			$_SESSION['lawyerRegMsg'] = "Please fill up the form properly!";
			header('location:../views/lawyerReg.php');
		}

		else{
			$emailBcnCheck = lawyerRegEmailCheck($email, $bcNo);
			$requestEmailBcnCheck = lawyerRequestEmailCheck($email, $bcNo);
			if($emailBcnCheck >= 1 || $requestEmailBcnCheck >= 1){
				session_destroy();
				session_start();
				$_SESSION['lawyerRegMsg'] = "Your email or bar council number has already been registered!";
				header('location:../views/lawyerReg.php');
			}
			else{
				if($pass == $confirmPass){
					$_SESSION['lawyerRegName'] = $name;
					$_SESSION['lawyerRegEmail'] = $email;
					$_SESSION['lawyerRegBcNo'] = $bcNo;
					$_SESSION['lawyerRegCNo'] = $cNo;
					$_SESSION['lawyerRegPass'] =$pass;
					header('location:../views/lawyerRegFee.php');
				}
				else{
					$_SESSION['lawyerRegMsg'] = "Your passwords don't match. Try again!";
					header('location:../views/lawyerReg.php');
				}
			}
		}
	}
?>