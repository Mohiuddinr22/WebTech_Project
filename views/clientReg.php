<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Client Registration</title>
	<link rel="stylesheet" href="../styles/clientReg.css">
</head>
<body>
	<div class="regPage">
		<form method="post" action="../controllers/clientRegController.php">
			<h1>Join as a Client</h1>
			<div class="input">
				<input type="text" name="clientID" value="<?php echo "User-ID : ".$_SESSION['newID'];?>" readonly>
			</div>
			<div class="input">
				<input type="text" name="name" placeholder="Full Name">
			</div>
			<div class="input">
				<input type="text" name="email" placeholder="Email">
			</div>
			<div class="input">
				<input type="text" name="cno" placeholder="Contact No" minlength="11" maxlength="11">
			</div>
			<div class="input">
				<input type="password" name="pass" placeholder="Password">
			</div>
			<div class="input">
				<input type="password" name="confirmPass" placeholder="Confirm Password">
			</div>
			<div class="msg">
				<p><?php
					if(isset($_SESSION['clientRegMsg'])){
						echo $_SESSION['clientRegMsg'];
						unset($_SESSION['clientRegMsg']);
					}
				?></p>
			</div>
			<div class="clientRegButtons">
				<button type="submit" name="action" value="reg" class="btnReg">Register</button>
				<button type="submit" name="action" value="back" class="btnBack">Back</button>
			</div>
		</form>
	</div>
</body>
</html>