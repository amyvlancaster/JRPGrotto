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
		<!-- Begin PHP -->
		<?php
			// Initialize the session
			session_start();
			// Check if the user is logged in, if not then redirect him to login page
			if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    			header("location: ../../login.php");
    			exit;
			}
			//Call the database
			require "../../utilities/config.php";
			$status ="";
			if($_SERVER['REQUEST_METHOD'] =='POST') {
				$platform_name = $_POST['platform_name'];
				//Form validation 
				if(empty($platform_name)) {
					$status = "All fields are required.";
				}
				elseif(strlen($platform_name) >= 255 || !preg_match("/^[0-9a-zA-Z-'\s]+$/", $platform_name)) {
						$status = "Please enter a valid platform name.";
				}
				//Inserting data into table 
				else {
					$sql = "INSERT INTO platform (platform_name) VALUES (:platform_name)";
					$stmt = $db_conn->prepare($sql);
					$stmt->execute(['platform_name' => $platform_name]);
					$status = "Added successfully.";
					$platform_name = "";
				}
			}
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
		<!-- Create Subjects - Platform -->
		<div class="managecontenttitle">
			<center>
				<h2>Create Subjects</h2>
			</center>
		</div>
		<!-- Create Platform Form -->
		<div class="contentform">
			<h3>Gaming Platform</h3>
			<form action="" method="POST">
				<label>Platform Name:</label>
				<input type="text" name="platform_name" value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST') echo $platform_name ?>"><br>
				<input type="submit" name="submit" value="submit">
				<p><?php echo $status ?>
			</form>
			<p><a href="create_subjects.php">Back</a></p>
		</div>
	</body>
</html>