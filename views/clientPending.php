<?php
	require_once('../models/dbFunctions.php');
	session_start();
	$i = 1;
	$id = $_SESSION['id'];
	$r = loadPendingTable($id);
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Client Portal</title>
	<link rel="stylesheet" href="../styles/clientPending.css">
	<link rel="stylesheet" href="../styles/clientNav.css">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>
<body>
	<form method="post" action="../controllers/clientPendingController.php">
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
		<div class="content">
			<div class="pendingTable">
				<section class="pendingTableHeader">
					<div class="tableName"><h1>Your pending consultancy requests</h1></div>
				</section>
				<section class="pendingTableBody">
						<table>
							<thead>
							<tr>
								<th class="serial">Serial</th>
								<th class="lawyerID">Lawyer-ID</th>
								<th class="name">Name</th>
								<th class="cfph">CFPH</th>
								<th class="rating">Rating</th>
							</tr>
						</thead>
						<tbody>
						<?php while($res = $r->fetch_assoc()){?>
							<tr>
								<td><?php echo $i; $i = $i+1;?></td>
								<td><?php $l = loadPendingLawyer($res['Lawyer_ID']);
										$lawyer = $l->fetch_assoc();
										echo $lawyer['ID'];?></td>
								<td><?php echo $lawyer['Name'];?></td>
								<td><?php echo $lawyer['CFPH'];?></td>
								<td><?php echo $lawyer['Rating'];?></td>
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