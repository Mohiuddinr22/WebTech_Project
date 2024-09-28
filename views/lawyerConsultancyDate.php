<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Lawyer Portal</title>
	<link rel="stylesheet" type="text/css" href="../styles/lawyerConsultancyDate.css">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>
<body>
	<div class="content">
		<form method="post" action="../controllers/lawyerConsultancyDateController.php">
			<h2>Select a consultancy date</h2>
			<div class="consultancyDate">
				<input type="date" name="consultancyDate">
			</div>
			<div class="msg">
				<p><?php
					if(isset($_SESSION['consultancyDateMsg'])){
						echo $_SESSION['consultancyDateMsg'];
						unset($_SESSION['consultancyDateMsg']);
					}
				?></p>
			</div>
			<div class="buttons">
				<button name="confirm"class="btnConfirm">Confirm</button>
				<button name="back" class="btnBack">Back</button>
			</div>
		</form>
	</div>
</body>
</html>