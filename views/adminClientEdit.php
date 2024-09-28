<?php
	require_once('../models/dbFunctions.php');
	session_start();

	$id = $_SESSION['editClientID'];
	$res = loadClientDetails($id);
	$r = $res->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Admin Portal</title>
	<link rel="stylesheet" href="../styles/adminClientEdit.css">
	<link rel="stylesheet" href="../styles/adminNav.css">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>
<body>
	<form method="post" action="../controllers/adminClientTableController.php">
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
				<button type="submit" name="logout">Logout</button>
			</div>
		</div>
		<div class="content">
			<div class="editInfo">
				<h1>Update Client Details</h1><br>
				<input type="text" placeholder="User-ID" name="id" value="<?php echo $r['ID'];?>" readonly><br>
				<input type="text" placeholder="Name" name="name" value="<?php echo $r['Name']?>"><br>
				<input type="text" placeholder="Email" name="email" value="<?php echo $r['Email']?>"><br>
				<input type="text" placeholder="Contact" name="contact" value="<?php echo $r['Contact']?>" maxlength="11"><br>
				<input type="text" placeholder="Password" name="pass" value="<?php echo $r['Password']?>"><br>
				<div class="contentButtons">
					<button name="update" class="btnUpdate">Update</button>
					<button name="cancel" class="btnCancel">Cancel</button>
				</div>
			</div>
		</div>
	</form>
</body>
</html>