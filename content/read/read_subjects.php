<!-- Debugging Complete -->
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="description" content="Your source for all things JRPG!">
		<meta name="keywords" content="jrpg">
		<title>JRPGrotto</title>
		<link rel="stylesheet" type="text/css" href="../../utilities/styles.css" />
		<link href="https://fonts.googleapis.com/css?family=Raleway:400,700&display=swap" rel="stylesheet">
		<!-- PHP -->
		<?php
			// Initialize the session
			session_start();
 
			// Check if the user is logged in, if not then redirect him to login page
			if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    			header("location: ../../login.php");
    			exit;
			}
			require "../../utilities/config.php";
		?>
	</head>
	<body>
		<!-- Header -->
		<div class="header">
			<div class="jrpgrotto">
				<a href="../../index.php">JRPGrotto</a>
			</div>
			<!-- Header Nav -->
			<div class="nav">
				<a href="#">Persona</a>
				<a href="#">Atelier</a>
				<a href="#">Xeno</a>
			</div>
			<div class="staffnav">
				<a href="../../login.php">Staff Login</a>
			</div>
		</div>
		<!-- Begin staff area -->
		<div class="staffareatitle">
			<h2>Staff Area</h2>
		</div>
		<!-- Staff Area Navigation -->
		<div class="staffareanav">
			<a href="../content.php">Manage Content</a><br>
			<a href="../../users/users.php">Add Users</a><br>
			<a href="../../logout.php">Logout</a><br>
		</div>
		<!-- Read Subjects -->
		<div class="managecontenttitle">
			<center>
				<h2>Read Subjects</h2>
			</center>
		</div>
		<!-- Begin tables -->
			<!-- Platform Table -->
			<h3>Platforms</h3>
				<table>
					<tr>
						<th>Platform ID</th>
						<th>Platform Name</th>
					</tr>
					<?php
						$stmt = $db_conn->query('SELECT ID, platform_name FROM platform');
						while($row = $stmt->fetch()) {
							echo 
								'<tr>
									<td>'.$row['ID'].'</td>
									<td>'.$row['platform_name'].'</td>
								</tr>';
						}
					?>
				</table>
			<!-- Franchises Table -->	
			<h3>Franchises</h3>
				<table>
					<tr>
						<th>Franchise ID</th>
						<th>Franchise Name</th>
					</tr>
					<?php
						$stmt = $db_conn->query('SELECT ID, franchise_name FROM jrpg');
						while($row = $stmt->fetch()) {
							echo 
								'<tr>
									<td>'.$row['ID'].'</td>
									<td>'.$row['franchise_name'].'</td>
								</tr>';
						}
					?>
				</table>
			<!-- Game Table -->	
			<h3>Games</h3>
				<table>
					<tr>
						<th>Game ID</th>
						<th>Franchise Name</th>
						<th>Game Name</th>
						<th>Publisher Name</th>
						<th>Release Date</th>
						<th>Subseries (if applicable)</th>
						<th>Platform</th>
						<th>User ID</th>
					</tr>
					<?php
						$stmt = $db_conn->query('SELECT ID, franchise_name, game_name, publisher_name, game_date, subseries, platform, user_id FROM game');
						while($row = $stmt->fetch()) {
							echo 
								'<tr>
									<td>'.$row['ID'].'</td>
									<td>'.$row['franchise_name'].'</td>
									<td>'.$row['game_name'].'</td>
									<td>'.$row['publisher_name'].'</td>
									<td>'.$row['game_date'].'</td>
									<td>'.$row['subseries'].'</td>
									<td>'.$row['platform'].'</td>
									<td>'.$row['user_id'].'</td>
								</tr>';
						}
					?>
				</table>
			<!-- Character Table -->
			<h3>Characters</h3>
				<table>
					<tr>
						<th>Franchise ID</th>
						<th>Game ID</th>
						<th>First Name</th>
						<th>Last Name</th>
						<th>Job Role</th>
						<th>Weapon</th>
						<th>Item</th>
						<th>Image File</th>
						<th>Posted</th>
						<th>Author ID</th>
					</tr>
					<?php
						$stmt = $db_conn->query('SELECT jrpg_id, game_id, first_name, last_name, job_role, weapon, item, image_file, posted, author FROM character_profiles');
						while($row = $stmt->fetch()) {
							echo 
								'<tr>
									<td>'.$row['jrpg_id'].'</td>
									<td>'.$row['game_id'].'</td>
									<td>'.$row['first_name'].'</td>
									<td>'.$row['last_name'].'</td>
									<td>'.$row['job_role'].'</td>
									<td>'.$row['weapon'].'</td>
									<td>'.$row['item'].'</td>
									<td>'.$row['image_file'].'</td>
									<td>'.$row['posted'].'</td>
									<td>'.$row['author'].'</td>
								</tr>';
						}
					?>
				</table>
			<!-- Users/Authors Table -->
			<h3>Users/Authors</h3>
				<table>
					<tr>
						<th>User ID</th>
						<th>Username</th>
						<th>E-mail</th>
						<th>First Name</th>
						<th>Last Name</th>
						<th>Role</th>
					</tr>
						<?php
						$stmt = $db_conn->query('SELECT ID, username, email, first_name, last_name, role FROM users');
						while($row = $stmt->fetch()) {
							echo 
								'<tr>
									<td>'.$row['ID'].'</td>
									<td>'.$row['username'].'</td>
									<td>'.$row['email'].'</td>
									<td>'.$row['first_name'].'</td>
									<td>'.$row['last_name'].'</td>
									<td>'.$row['role'].'</td>
								</tr>';
						}
					?>
				</table>
		</div>
	</body>
</html>