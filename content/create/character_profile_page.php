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
			<!-- Header Navigation-->
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
		<!-- Create Character Profile Title -->
		<div class="managecontenttitle">
			<center>
				<h2>Create a Character Profile Page</h2>
			</center>
		</div>
		<!-- Create Character Profile Form -->
		<div class="contentform">
				<form action ="" method ="POST">
					<label>Character Name:</label><br>
					<input type="text" name="name"><br>
					<label>Game Title:</label><br>
					<input type="text" name="title"><br>
					<label>Character Image:</label><br>
					<input type ="" name="image"><br>
					<label>Role:</label><br>
					<input type="text" name="role"><br>
					<label>Weapon:</label><br>
					<input type="text" name="weapon"><br>
					<label>Item:</label><br>
					<input type="text" name="item"><br>
					<label>Character Summary:</label><br>
					<textarea name="summary" cols="30" rows="7"></textarea><br>
					<input type="submit" name="submit" value="submit">			
				</form>
		</div>
	</body>
</html>