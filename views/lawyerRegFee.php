<?php
	session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Lawyer Registration</title>
	<link rel="stylesheet" href="../styles/lawyerRegFee.css">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>
<body>
	<div class="regPage">
		<form method="post" action="../controllers/lawyerRegFeeController.php">
			<h2>Choose your consultancy fee</h2>
			<div class="consultancyFee">
				<select name="consultancyFee" class="cfphSelect">
					<option value="">--Please choose an option--</option>
					<option value="1000">1000</option>
					<option value="2000">2000</option>
					<option value="3000">3000</option>
					<option value="4000">4000</option>
					<option value="5000">5000</option>
				</select>
			</div>
			<div class="msg">
				<p><?php
					if(isset($_SESSION['selectFeeMsg'])){
						echo $_SESSION['selectFeeMsg'];
						unset($_SESSION['selectFeeMsg']);
					}
				?></p>
			</div>
			<div class="regButtons">
				<button type="submit" name="action" value="confirm" class="btnConfirm">Confirm Fee</button>
				<button type="submit" name="action" value="back" class="btnBack">Back</button>
			</div>
		</form>
	</div>
</body>
</html>