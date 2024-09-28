<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Client Portal</title>
	<link rel="stylesheet" href="../styles/clientHome.css">
	<link rel="stylesheet" href="../styles/clientNav.css">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>
<body>
	<form method="post" action="../controllers/clientHomeController.php">
		<div class="nav">
			<div class="logo">
				<h2>E-LawyerBD</h2>
			</div>
			<div class="navList">
				<ul>
					<li><a href="../views/clientHome.php">Home</a></li>
					<li><a href="../views/clientSearch.php">Search</a></li>
					<li><a href="../views/clientPending.php">Pending</a></li>
					<li><a href="../views/clientHistory.php">History</a></li>
				</ul>
			</div>
			<div class="logout">
				<button name="logout">Logout</button>
			</div>
		</div>
	</form>
	<div class="welcomeText">
			<h1>Welcome to Client Portal, 
				<?php
					echo $_SESSION['name'].'.';
				?><br>
				Your user-ID : <?php
							echo $_SESSION['id'];
						 ?></h1>
	</div>
</body>
</html>