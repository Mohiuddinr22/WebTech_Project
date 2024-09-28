<?php
	require_once('../models/dbFunctions.php');
	session_start();

	$res = loadLawyerDetails($_SESSION['lawyerID']);
	$r = $res->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Client Portal</title>
	<link rel="stylesheet" href="../styles/clientRequestSent.css">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>
<body>
	<form method="post" action="../controllers/clientSearchController.php">
		<div class="requestSent">
			<h1>Your request for a consultancy is sent to<br>
				<?php echo $r['Name'];?>, User-ID : <?php echo $r['ID']?>.<br>
				Kindly wait for his confirmation.<br>
				Thank you!</h1>
			<div class="buttons">
				<button name="home">Home</button>
			</div>	
		</div>
	</form>
</body>
</html>