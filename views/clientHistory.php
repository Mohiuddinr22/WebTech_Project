<?php
	require_once('../models/dbFunctions.php');
	session_start();

	$id = $_SESSION['id'];
	$res = loadHistory($id);
	$result = loadHistory($id);
	$details = $result->fetch_assoc();
	if(!is_null($details))
		$_SESSION['lawyerIDForRate'] = $details['Lawyer_ID'];
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Client Portal</title>
	<link rel="stylesheet" href="../styles/clientHistory.css">
	<link rel="stylesheet" href="../styles/clientNav.css">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>
<body>
	<form method="post" action="../controllers/clientHistoryController.php">
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
			<div class="historyTable">
				<section class="historyTableHeader">
					<div class="tableName">
						<h1>Your Consultancy History</h1>	
					</div>
				</section>
				<div class="msg">
					<p><?php
						if(isset($_SESSION['historyTableMsg'])){
							echo $_SESSION['historyTableMsg'];
							unset($_SESSION['historyTableMsg']);
						}?></p>
				</div>
				<section class="historyTableBody">
					<table>
						<thead>
							<tr>
								<th class="serial">Consultancy-ID</th>
								<th class="date">Date</th>
								<th class="lawyerName">Lawyer-Name</th>
								<th class="lawyerID">Lawyer-ID</th>
								<th class="email">Email</th>
								<th class="contact">Contact</th>
								<th class="cfph">CFPH</th>
								<th class="rating">Rating</th>
							</tr>
						</thead>
						<tbody>
						<?php while($r = $res->fetch_assoc()){
								$details = loadLawyerDetails($r['Lawyer_ID']);
								$l = $details->fetch_assoc();
							?>
							<tr>
								<td><?php echo $r['Consultancy_ID'];?></td>
								<td><?php echo $r['Consultancy_Date'];?></td>
								<td><?php echo $r['Lawyer_Name'];?></td>
								<td><?php echo $r['Lawyer_ID'];?></td>
								<td><?php echo $l['Email'];?></td>
								<td><?php echo $l['Contact'];?></td>
								<td><?php echo $r['CFPH'];?></td>
								<td><?php  
									$rate = $r['Rating'];
									if($rate == 0 || is_null($rate)){?>
										<select name="rateSelect" class="rateSelect">
											<option value=""></option>
											<option value="1.0">1</option>
											<option value="2.0">2</option>
											<option value="3.0">3</option>
											<option value="4.0">4</option>
											<option value="5.0">5</option>
										</select>
										<button name="rate" class="btnRate" value="<?php echo $r['Consultancy_ID'];?>">Rate</button>
									<?php } 
									else {echo $rate;}?>
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