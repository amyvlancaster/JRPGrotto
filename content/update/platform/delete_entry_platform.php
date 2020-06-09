<!-- Debugging Complete -->
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="description" content="Your source for all things JRPG!">
		<meta name="keywords" content="jrpg">
		<title>JRPGrotto</title>
		<link rel="stylesheet" type="text/css" href="../../../utilities/styles.css" />
		<link href="https://fonts.googleapis.com/css?family=Raleway:400,700&display=swap" rel="stylesheet">
		<!-- Begin PHP -->
		<?php
    		// Initialize the session
            session_start();
 
            // Check if the user is logged in, if not then redirect him to login page
            if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
                header("location: ../../../login.php");
                exit;
            }
			//Call the database
			require "../../../utilities/config.php";
			$id = 0;
			if (!empty($_GET['ID'])) {
				$id = $_REQUEST['ID'];
			}
			//Delete the entry and redirect to main page 
			if (!empty($_POST)) {
				$id = $_POST['ID'];
				$db_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$sql = "DELETE FROM platform WHERE ID= ?";
				$q = $db_conn->prepare($sql);
				$q->execute(array($id));
				header("Location: platform_update.php");
			}
		?>


		<title>Delete an Entry</title>
	</head>
	<body>
	<!-- Header -->
		<div class="header">
			<div class="jrpgrotto">
				<a href="../../../index.php">JRPGrotto</a>
			</div>
			<!-- Header Nav -->
			<div class="nav">
				<a href="#">Persona</a>
				<a href="#">Atelier</a>
				<a href="#">Xeno</a>
			</div>
			<div class="staffnav">
				<a href="../../../login.php">Staff Login</a>
			</div>
		</div>
		<!-- Begin staff area -->
		<div class="staffareatitle">
			<h2>Staff Area</h2>
		</div>
		<!-- Staff Area Navigation -->
		<div class="staffareanav">
			<a href="../../content.php">Manage Content</a><br>
			<a href="../../../users/users.php">Add Users</a><br>
			<a href="../../../logout.php">Logout</a><br>
		</div>
		<!-- Update a Platform -->
		<div class="managecontenttitle">
			<center>
				<h2>Update a Platform</h2>
			</center>
		</div>
			<center>
		<!-- Begin form -->
		<form action="" method="POST">
			<input type="hidden" name="ID" value="<?php echo $id;?>"/>
			<p>Are you sure you want to delete this entry?</p>
			<input type="submit" value="yes">
			<input type="submit" href="platform_update.php" value="Go back">
		</form>
		<p><a href="platform_update.php">Go back to the table</a></p>
		</center>
	</body>
</html>