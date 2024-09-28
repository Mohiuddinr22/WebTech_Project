<?php
	require_once('../models/dbFunctions.php');
	session_start();

	$id = $_SESSION['id'];
	$res = loadConsultancyRequests($id);
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Lawyer Portal</title>
	<link rel="stylesheet" href="../styles/lawyerRequest.css">
	<link rel="stylesheet" href="../styles/lawyerNav.css">
	<link rel="stylesheet" href="../styles/table.css">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>
<body>
	<form method="post" action="../controllers/lawyerRequestController.php">
		<div class="nav">
			<div class="logo">
				<h2>E-LawyerBD</h2>
			</div>
			<div class="navList">
				<ul>
					<li><a href="../views/lawyerHome.php">Home</a></li>
					<li><a href="../views/lawyerClient.php">Clients</a></li>
					<li><a href="../views/lawyerRequest.php">Requests</a></li>
					<li><a href="../views/lawyerHistory.php">History</a></li>
				</ul>
			</div>
			<div class="logout">
				<button name="logout">Logout</button>
			</div>
		</div>
		<div class="content">
			<div class="table">
				<section class="tableHeader">
					<div class="tableName">
						<h1>Consultancy Requests</h1>
					</div>
				</section>
				<div class="msg">
					<p><?php
						if(isset($_SESSION['lRequestTableMsg'])){
							echo $_SESSION['lRequestTableMsg'];
							unset($_SESSION['lRequestTableMsg']);
						}?></p>
				</div>
				<section class="tableBody">
					<table>
						<thead>
							<tr>
								<th>Name</th>
								<th>Email</th>
								<th>Contact</th>
								<th>Operation</th>
							</tr>
						</thead>
						<tbody>
							<?php while($r = $res->fetch_assoc()){
									$clientID = $r['Client_ID'];
									$cDetails = loadClientDetails($clientID);
									$c = $cDetails->fetch_assoc();
								?>
							<tr>
								<td><?php echo $c['Name'];?></td>
								<td><?php echo $c['Email'];?></td>
								<td><?php echo $c['Contact'];?></td>
								<td>
									<button class="btnApprove" name="proceed" value="<?php echo $c['ID'];?>">Proceed</button>
									<button class="btnReject" name="reject" value="<?php echo $c['ID'];?>">Reject</button>
								</td>
							</tr>
							<?php }?>
						</tbody>
					</table>	
				</section>
			</div>
		</div>
	</form>
</body>
</html>