<!-- Debugging Complete -->
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="description" content="Your source for all things JRPG!">
		<meta name="keywords" content="jrpg">
		<title>JRPGrotto</title>
		<link rel="stylesheet" type="text/css" href="utilities/styles.css" />
		<link href="https://fonts.googleapis.com/css?family=Raleway:400,700&display=swap" rel="stylesheet">
	</head>
	<body>
		<!--Begin PHP -->
		<?php
			// Initialize the session
			session_start();
			// Check if the user is logged in, if not then redirect him to login page
			if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    			header("location: login.php");
    			exit;
			}
		?>
		<!-- Header -->
		<div class="header">
			<div class="jrpgrotto">
				<a href="index.php">JRPGrotto</a>
			</div>
			<!-- Header Navigation -->
			<div class="nav">
				<a href="#">Persona</a>
				<a href="#">Atelier</a>
				<a href="#">Xeno</a>
			</div>
			<div class="staffnav">
				<a href="login.php">Staff Login</a>
			</div>
		</div>
		<!-- Begin Staff Area -->
		<div class="staffareatitle">
			<h2>Staff Area</h2>
		</div>
		<!-- Staff Area Navigation -->
		<div class="staffareanav">
			<a href="content/content.php">Manage Content</a><br>
			<a href="users/users.php">Add Users</a><br>
			<a href="logout.php">Logout</a><br>
		</div>
	</body>
</html>