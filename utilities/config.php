<!DOCTYPE HTML>
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
			//Connection for the login form
			define('DB_SERVER', 'localhost');
			define('DB_USERNAME', 'root');
			define('DB_PASSWORD', '');
			define('DB_NAME', 'jrpgrotto_accounts');
 
			// Attempt to connect to MySQL database
			$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
			// Check connection
			if($link === false) {
    			die("ERROR: Could not connect. " . mysqli_connect_error());
			}

	//Connecting to the database for CRUD  
	try {
		$db_conn = new PDO('mysql:host=localhost; dbname=jrpgrotto_accounts', 'root', '');
	} 
	catch (PDOException $e) {
		echo "Cloud not connect to the database";
	}

		?>
	</body>
</html>
