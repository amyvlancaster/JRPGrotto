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
	</head>
	<body>
		<!-- Begin PHP -->
		<?php 
			// Initialize the session
			session_start();
			// Check if the user is logged in, if not then redirect him to login page
			if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    			header("location: ../../login.php");
    			exit;
			}
		?>
		<!-- Header -->
		<div class="header">
			<div class="jrpgrotto">
				<a href="../../index.php">JRPGrotto</a>
			</div>
			<!-- Header Navigation -->
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
		<!-- Create a Game Page -->
		<div class="managecontenttitle">
			<center>
				<h2>Create a Game Page</h2>
			</center>
		</div>
		<!-- Create a Game Page Form -->
		<div class="contentform">
				<form action ="" method ="POST">
					<label>Game Title:</label><br>
					<input type="text" name="title"><br>
					<label>Subseries:</label><br>
					<input type="text" name="subseries"><br>
					<label>Platform:</label><br>
					<input type ="" name="platform"><br>
					<label>Release Date:</label><br>
					<input type="text" name="release"><br>
					<label>Publisher:</label><br>
					<input type="text" name="publisher"><br>
					<input type="submit" name="submit" value="submit">			
				</form>
		</div>
	</body>
</html>