<?php
	require_once('../models/dbFunctions.php');
	session_start();

	$name = "";
	$id = "";
	if(isset($_SESSION['name']) && isset($_SESSION['id'])){
		$name = $_SESSION['name'];
		$id = $_SESSION['id'];
	}

	$res = loadRequestTable();
	if(isset($_SESSION['searchText'])){
		$res = searchLawyerRequest($_SESSION['searchText']);
		unset($_SESSION['searchText']);
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Admin Portal</title>
	<link rel="stylesheet" href="../styles/adminRequests.css">
	<link rel="stylesheet" href="../styles/adminNav.css">
	<link rel="stylesheet" href="../styles/table2.css">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>
<body>
	<form method="post" action="../controllers/adminRequestTableController.php">
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
					<div class="tableName"><h1>Lawyer Applications</h1></div>
					<div class="searchInput">
						<input type="text" name="search" placeholder="Search">
						<button name="searchBtn" value="<?php if(isset($_POST['search'])) echo $_POST['search'];?>">Search</button>
						<button name="refresh">Refresh</button>
					</div>
				</section>
				<div class="msg">
					<p><?php
						if(isset($_SESSION['requestTableMsg'])){
							echo $_SESSION['requestTableMsg'];
							unset($_SESSION['requestTableMsg']);
						}?></p>
				</div>
				<section class="tableBody">
					<table>
						<thead>
							<tr>
								<th>Name</th>
								<th>Email</th>
								<th>BCN</th>
								<th>Contact</th>
								<th>CFPH</th>
								<th>Password</th>
								<th>Operation</th>
							</tr>
						</thead>
						<tbody>
							<?php while($r = $res->fetch_assoc()){?>
							<tr>
								<td><?php echo $r['Name'];?></td>
								<td><?php echo $r['Email'];?></td>
								<td><?php echo $r['BCN'];?></td>
								<td><?php echo $r['ContactNumber'];?></td>
								<td><?php echo $r['CFPH'];?></td>
								<td><?php echo $r['Password'];?></td>
								<td><button class="btnApprove" name="approve" value="<?php echo $r['BCN'];?>">Approve</button>
									<button class="btnReject" name="reject" value="<?php echo $r['BCN'];?>">Reject</button></td>
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