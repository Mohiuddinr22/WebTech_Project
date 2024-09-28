<?php
	require_once('../models/dbFunctions.php');
	session_start();

	if(isset($_POST['logout'])){
		session_destroy();
		header('location:../views/home.php');
	}

	if(isset($_POST['searchBtn'])){
		$_SESSION['searchText'] = $_POST['search'];
		header('location:../views/adminRequests.php');
	}

	if(isset($_POST['refresh'])){
		header('location:../views/adminRequests.php');
	}

	if(isset($_POST['approve'])){
		$bcn = $_POST['approve'];

		$r = selectRequest($bcn);

		$res = $r->fetch_assoc();

		$name = $res['Name'];
		$id = generateLawyerID();
		$email = $res['Email'];
		$contact = $res['ContactNumber'];
		$pass = $res['Password'];
		$cfph = $res['CFPH'];
		$rating = 5.0;

		$confirm = confirmRequest($id, $name, $bcn, $email, $pass, $contact, $cfph, $rating);

		if($confirm){
			$msgBody = makeConfirmationMailBody($name, $id);
			sendConfirmationMail($email, $msgBody);
			$_SESSION['requestTableMsg'] = $name." has been approved as a lawyer!";
			header('location:../views/adminRequests.php');
		}
		else{
			$_SESSION['requestTableMsg'] = "Something went wrong!";
			header('location:../views/adminRequests.php');
		}
 	}

 	if(isset($_POST['reject'])){
 		$bcn = $_POST['reject'];

 		$r = selectRequest($bcn);

		$res = $r->fetch_assoc();
 		$name = $res['Name'];
 		$email = $res['Email'];

 		$res = rejectRequest($bcn);
 		if($res){
 			$msgBody = makeRejectionMailBody($name);
 			sendRejectionMail($email, $msgBody);
 			$_SESSION['requestTableMsg'] = $name." has been rejected!";
 			header('location:../views/adminRequests.php');
 		}
 		else{
 			$_SESSION['requestTableMsg'] = "Something went wrong!";
			header('location:../views/adminRequests.php');
 		}
 	}
?>