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
	</head>
	<body>
		<!--Begin PHP -->
		<?php
			// Initialize the session
			session_start();
			// Check if the user is logged in, if not then redirect him to login page
			if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    			header("location: ../login.php");
    			exit;
			}
		?>
		<!-- Header -->
		<div class="header">
			<div class="jrpgrotto">
				<a href="../index.php">JRPGrotto</a>
			</div>
			<!-- Navigation -->
			<div class="nav">
				<a href="#">Persona</a>
				<a href="#">Atelier</a>
				<a href="#">Xeno</a>
			</div>
			<div class="staffnav">
				<a href="../login.php">Staff Login</a>
			</div>
		</div>
		<!-- Staff Area Header -->
		<div class="staffareatitle">
			<h2>Staff Area</h2>
		</div>
		<!-- Staff Area Navigation -->
		<div class="staffareanav">
			<a href="content.php">Manage Content</a><br>
			<a href="../users/users.php">Add Users</a><br>
			<a href="../logout.php">Logout</a><br>
		</div>
		<!-- Manage Content Header -->
		<div class="managecontenttitle">
			<center>
				<h2>Manage Content</h2>
			</center>
		</div>
		<!-- Manage Content Navigation -->
		<div class="contentnav">
			<center>
				<h4>Pages</h4>
				<a href="create/create_pages.php">Create</a><br>
				<a href="read/read_pages.php">Read</a><br>
				<a href="update/update_pages.php">Update Pages</a><br>
				<h4>Subjects</h4>
				<a href="create/create_subjects.php">Create</a><br>
				<a href="read/read_subjects.php">Read</a><br>
				<a href="update/update_subjects.php">Update Subjects</a><br>
			</center>
		</div>
	</body>
</html>