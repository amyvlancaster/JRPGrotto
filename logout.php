<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="description" content="Your source for all things JRPG!">
		<meta name="keywords" content="jrpg">
		<title>JRPGrotto</title>
		<link rel="stylesheet" type="text/css" href="styles.css" />
		<link href="https://fonts.googleapis.com/css?family=Raleway:400,700&display=swap" rel="stylesheet">

	</head>
	<body>

		<!-- Begin PHP -->
		<?php
			// Initialize the session
			session_start();
 
			// Unset all of the session variables
			$_SESSION = array();
 
			// Destroy the sessionx
			session_destroy();
 
			// Redirect to login page
			header("location: login.php");
			exit;
		?>

	</body>
</html>