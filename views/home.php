<?php
	
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>E-LawyerBD</title>
	<link rel="stylesheet" href="../styles/home.css">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>

<body>
	<form method="post" action="../controllers/homeController.php">
		<div class="navHome">
			<div class="logoHome">
				<h2>E-LawyerBD</h2>
			</div>
			<div class="navMenu">
				<ul>
					<li><a href="../views/home.php">Home</a></li>
					<li><a href="../views/about.php">About</a></li>
					<li><a href="../views/contact.php">Contacts</a></li>
					<li><a href="../views/help.php">Help</a></li>
				</ul>
			</div>
			<div class="loginRegBtn">
				<button type="submit" name="action" value="login" class="btnLogin">Login</button>
				<button type="submit" name="action" value="signup" class="btnSignup">Signup</button>
			</div>
		</div>
		<div class="content">
			<h1>Connecting You with the Right Legal Expertise<br>
				When You Need It Most</h1>
		</div>
	</form>
</body>
</html>