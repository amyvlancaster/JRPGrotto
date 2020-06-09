<!-- Debugging Complete -->
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="description" content="Your source for all things JRPG!">
		<meta name="keywords" content="jrpg">
		<title>JRPGrotto</title>
		<link rel="stylesheet" type="text/css" href="../utilities/styles.css" />
		<link href="https://fonts.googleapis.com/css?family=Raleway:400,700&display=swap" rel="stylesheet">

		<!-- PHP -->
		<?php
			// Initialize the session
			session_start();
 
			// Check if the user is logged in, if not then redirect him to login page
			if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    			header("location: ../login.php");
    			exit;
			}
			require "../utilities/config.php";
		?>
	</head>
	<body>
		<!-- Header -->
		<div class="header">
			<div class="jrpgrotto">
				<a href="index.php">JRPGrotto</a>
			</div>
			<!-- Header Nav -->
			<div class="nav">
				<a href="#">Persona</a>
				<a href="#">Atelier</a>
				<a href="#">Xeno</a>
			</div>
			<div class="staffnav">
				<a href="login.php">Staff Login</a>
			</div>
		</div>
		<!-- Begin staff area -->
		<div class="staffareatitle">
			<h2>Staff Area</h2>
		</div>
		<!-- Staff Area Navigation -->
		<div class="staffareanav">
			<a href="../content/content.php">Manage Content</a><br>
			<a href="users.php">Add Users</a><br>
			<a href="../logout.php">Logout</a><br>
		</div>
		<!-- Update a User -->
		<div class="managecontenttitle">
			<center>
				<h2>Update a User</h2>
			</center>
		</div>
			<!-- Users Table -->
			<h3>Users</h3>
				<table>
					<tr>
						<th>User ID</th>
						<th>Username</th>
						<th>Created On</th>
						<th>Update</th>
					</tr>
					<?php
						$stmt = $db_conn->query('SELECT ID, username, created_at FROM users');
						while($row = $stmt->fetch()) {
							echo 
								'<tr>
									<td>'.$row['ID'].'</td>
									<td>'.$row['username'].'</td>
									<td>'.$row['created_at'].'</td>
									<td><a href="update_entry_users.php?ID='.$row['ID'].'">Edit</a><br>
									<a href="delete_entry_users.php?ID='.$row['ID'].'">Delete</a><br>
								</tr>';
						}
					?>
				</table>
	</body>
</html>