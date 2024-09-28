<?php
	require_once('../models/dbFunctions.php');
	session_start();

	$name = "";
	$id = "";
	if(isset($_SESSION['name']) && isset($_SESSION['id'])){
		$name = $_SESSION['name'];
		$id = $_SESSION['id'];
	}

	$res = clientSearchLawyer();

	if(isset($_SESSION['searchText'])){
		$res = searchLawyer($_SESSION['searchText']);
		unset($_SESSION['searchText']);
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Client Portal</title>
	<link rel="stylesheet" href="../styles/clientSearch.css">
	<link rel="stylesheet" href="../styles/clientNav.css">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>
<body>
	<form method="post" action="../controllers/clientSearchController.php">
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
			<div class="searchTable">
				<section class="searchTableHeader">
					<div class="tableName"><h1>Choose the best lawyer for you</h1></div>
					<div class="searchInput">
						<input type="text" name="search" placeholder="Search">
						<button name="searchBtn" value="<?php if(isset($_POST['search'])) echo $_POST['search'];?>">Search</button>
						<button name="refresh">Refresh</button>
					</div>
				</section>
				<div class="msg">
					<p><?php
						if(isset($_SESSION['searchTableMsg'])){
							echo $_SESSION['searchTableMsg'];
							unset($_SESSION['searchTableMsg']);
						}?></p>
				</div>
				<section class="searchTableBody">
					<table>
						<thead>
							<tr>
								<th class="userID">User-ID</th>
								<th class="name">Name</th>
								<th class="email">Email</th>
								<th class="contact">Contact</th>
								<th class="cfph">CFPH</th>
								<th class="rating">Rating</th>
								<th>Operation</th>
							</tr>
						</thead>
						<tbody>
							<?php while($r = $res->fetch_assoc()){?>
							<tr>
								<td><?php echo $r['ID'];?></td>
								<td><?php echo $r['Name'];?></td>
								<td><?php echo $r['Email'];?></td>
								<td><?php echo $r['Contact'];?></td>
								<td><?php echo $r['CFPH'];?></td>
								<td><?php echo $r['Rating'];?></td>
								<td><button class="btnRequest" name="request" value="<?php echo $r['ID'];?>">Request</button></td>
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