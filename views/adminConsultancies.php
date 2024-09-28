<?php
	require_once('../models/dbFunctions.php');
	session_start();

	$res = loadConsultancyList();
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Admin Portal</title>
	<link rel="stylesheet" href="../styles/adminConsultancies.css">
	<link rel="stylesheet" href="../styles/adminNav.css">
	<link rel="stylesheet" href="../styles/table.css">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>
<body>
	<form method="post" action="../controllers/adminConsultancyController.php">
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
			<div class="table">
				<section class="tableHeader">
					<div class="tableName">
						<h1>Consultancies Across the Users</h1>
					</div>
				</section>
				<div class="msg">
					<p><?php
						if(isset($_SESSION['consultancyTableMsg'])){
							echo $_SESSION['consultancyTableMsg'];
							unset($_SESSION['consultancyTableMsg']);
						}?></p>
				</div>
				<section class="tableBody">
					<table>
						<thead>
							<tr>
								<th>Consultancy-ID</th>
								<th>Client-ID</th>
								<th>Lawyer-ID</th>
								<th>Consultancy-Date</th>
								<th>Consultancy-Fee</th>
								<th>Rating</th>
								<th>Operation</th>
							</tr>
						</thead>
						<tbody>
							<?php while($r = $res->fetch_assoc()){?>
							<tr>
								<td><?php echo $r['Consultancy_ID'];?></td>
								<td><?php echo $r['Client_ID'];?></td>
								<td><?php echo $r['Lawyer_ID'];?></td>
								<td><?php echo $r['Consultancy_Date'];?></td>
								<td><?php echo $r['CFPH'];?></td>
								<td><?php echo $r['Rating'];?></td>
								<td><button name="remove" class="remove" value="<?php echo $r['Consultancy_ID'];?>">Remove</button></td>
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