<?php
	require_once('../models/dbFunctions.php');
	require_once('../models/others.php');
	session_start();

	$action = $_POST['action'];

	if($action == 'back'){
		header('location:../views/home.php');
		session_destroy();
	}

	else if($action == 'login'){

		$id = $_POST['userID'];
		$pass = $_POST['pass'];
		$status = "";

		if(empty($id) || empty($pass)){
			$_SESSION['loginMsg'] = "Please enter your details properly.";
			header('location:../views/login.php');
		}
		else{
			if(strpos($id, 'A') === 0){
				$status = "admin";
			}		
			else if(strpos($id, 'C') === 0){
				$status = "client";
			}
			else if(strpos($id, 'L') === 0){
				$status = "lawyer";
			}
			else{
				$_SESSION['loginMsg'] = "Please enter valid info!";
				header('location:../views/login.php');
			}
			if($status == ""){
				$_SESSION['loginMsg'] = "Please enter a valid id!";
				header('location:../views/login.php');
			}
			else{
				if($status == "admin"){
					$res = adminLoginCheck($id, $pass);
					if(mysqli_num_rows($res) == 1){
						while($result = $res->fetch_assoc()){
							$_SESSION['name'] = $result['Name'];
							$_SESSION['id'] = $result['ID'];
						}			
						header('location:../views/adminHome.php');
					}

					else{
						$_SESSION['loginMsg'] = "Invalid user!";
						header('location:../views/login.php');
					}
				}

				else if($status == "client"){
					$res = clientLoginCheck($id, $pass);
					if(mysqli_num_rows($res) == 1){
						while($result = $res->fetch_assoc()){
							$_SESSION['name'] = $result['Name'];
							$_SESSION['id'] = $result['ID'];
						}
						header('location:../views/clientHome.php');
					}	

					else{
						$_SESSION['loginMsg'] = "Invalid user!";
						header('location:../views/login.php');
					}
				}

				else if($status == "lawyer"){
					$res = lawyerLoginCheck($id, $pass);
					if(mysqli_num_rows($res) == 1){
						while($result = $res->fetch_assoc()){
							$_SESSION['name'] = $result['Name'];
							$_SESSION['id'] = $result['ID'];
							$_SESSION['RATING'] = $result['Rating'];
						}
						header('location:../views/lawyerHome.php');
					}

					else{
						$_SESSION['loginMsg'] = "Invalid user!";
						header('location:../views/login.php');
					}
				}
			}
		}
		
	}
?>