<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login</title>
	<link rel="stylesheet" href="../styles/login.css">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>
<body>
	<div class="loginPage">
		<form method="post" action="../controllers/loginController.php">
			<h1>Login</h1>
			<div class="input">
				<input type="text" name="userID" placeholder="User ID" maxlength="5">
			</div>
			<div class="input">
				<input type="password" name="pass" placeholder="Password">
			</div>
			<div class="errMsg">
				<p><?php
					if(isset($_SESSION['loginMsg'])){
						echo $_SESSION['loginMsg'];
						unset($_SESSION['loginMsg']);
					}
				?></p>
			</div>
			<div class="forgotPass">
				<a href="#">forgot password</a>
			</div>
			<div class="buttons">
				<button type="submit" name="action" value="login" class="btnLogin">Login</button>
				<button type="submit" name="action" value="back" class="btnBack">Back</button>
			</div>
			<div class="reg">
				<p>Don't have an account?<a href="../views/register.php">Register</a></p>
			</div>
		</form>
	</div>
</body>
</html>