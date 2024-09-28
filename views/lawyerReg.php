<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Lawyer Registration</title>
	<link rel="stylesheet" href="../styles/lawyerReg.css">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>
<body>
	<div class="regPage">
		<form method="post" action="../controllers/lawyerRegController.php">
			<h1>Join as a Lawyer</h1>
			<div class="input">
				<input type="text" name="name" placeholder="Full Name" maxlength="50">
			</div>
			<div class="input">
				<input type="text" name="email" placeholder="Email" maxlength="50">
			</div>
			<div class="input">
				<input type="text" name="bcNo" placeholder="Bar Council Number" maxlength="10">
			</div>
			<div class="input">
				<input type="text" name="cno" placeholder="Contact No" maxlength="11">
			</div>
			<div class="input">
				<input type="password" name="pass" placeholder="Password" maxlength="20">
			</div>
			<div class="input">
				<input type="password" name="confirmPass" placeholder="Confirm Password" maxlength="20">
			</div>
			<div class="msg">
				<p><?php
					if(isset($_SESSION['lawyerRegMsg'])){
						echo $_SESSION['lawyerRegMsg'];
						unset($_SESSION['lawyerRegMsg']);
					}
				?></p>
			</div>
			<div class="lawyerRegButtons">
				<button type="submit" name="action" value="reg" class="btnReg">Register</button>
				<button type="submit" name="action" value="back" class="btnBack">Back</button>
			</div>
		</form>	
	</div>
</body>
</html>