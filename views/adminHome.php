<?php
	session_start();

	$name = "";
	$id = "";
	if(isset($_SESSION['name']) && isset($_SESSION['id'])){
		$name = $_SESSION['name'];
		$id = $_SESSION['id'];
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Admin Portal</title>
	<link rel="stylesheet" href="../styles/adminHome.css">
	<link rel="stylesheet" href="../styles/adminNav.css">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>
<body>
	<form method="post" action="../controllers/adminHomeController.php">
		<div class="nav">
			<div class="logo">
				<h2>E-LawyerBD</h2>
			</div>
			<div class="navList">
				<ul>
					<li><a href="../views/adminHome.php">Home</a></li>
					<li><a href="../views/adminClient.php">Clients</a></li>
					<li><a href="../views/adminLawyer.php">Lawyers</a></li>
					<li><a href="../views/adminRequests.php">Requests</a></li>
					<li><a href="../views/adminConsultancies.php">Consultancies</a></li>
				</ul>
			</div>
			<div class="logout">
				<button name="logout">Logout</button>
			</div>
		</div>
		<div class="welcomeText">
			<h1>Welcome to Admin Portal, <?php
											if(isset($_SESSION['name']))
												echo $_SESSION['name'].'.';
											?><br>
				Your user-ID : <?php
									if(isset($_SESSION['id']))
										echo $_SESSION['id'];
						 		?></h1>
		</div>
	</form>
</body>
</html>