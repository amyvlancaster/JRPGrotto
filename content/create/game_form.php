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
				$franchise_name = $_POST['franchise_name'];
				$game_name = $_POST['game_name'];
				$publisher_name = $_POST['publisher_name'];
				$game_date = $_POST['game_date'];
				$subseries = $_POST['subseries'];
				$platform = $_POST['platform'];
				$user_id = $_POST['user_id'];
				//Form validation 
				if(empty($franchise_name) || empty($game_name) || empty($publisher_name) || empty($game_date) || empty($platform) || empty($user_id)) {
					$status = "All fields except subseries are required.";
				}
				elseif(strlen($franchise_name) >= 255 || !preg_match("/^[a-zA-Z-'\s]+$/", $franchise_name)) {
						$status = "Please enter a valid franchise name.";
				}

				elseif(strlen($game_name) >= 255 || !preg_match("/^[0-9a-zA-Z-'\s]+$/", $game_name)) {
						$status = "Please enter a valid game name.";
				}

				elseif(strlen($publisher_name) >= 255 || !preg_match("/^[0-9a-zA-Z-'\s]+$/", $publisher_name)) {
						$status = "Please enter a valid publisher name.";
				}

				elseif(preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$game_date)) {
						$status = "Please enter a valid date.";
				}

				elseif(strlen($platform) >= 255 || !preg_match("/^[0-9a-zA-Z-'\s]+$/", $platform)) {
						$status = "Please enter a valid platform.";
				}

				elseif(!is_numeric($user_id)) {
						$status = "Please enter a valid user ID.";
				}
				//Inserting data into table 
				else {
					$sql = "INSERT INTO game (franchise_name, game_name, publisher_name, game_date, subseries, platform, user_id) VALUES (:franchise_name, :game_name, :publisher_name, :game_date, :subseries, :platform, :user_id)";
					$stmt = $db_conn->prepare($sql);
					$stmt->execute(['franchise_name' => $franchise_name, 'game_name' => $game_name, 'publisher_name' => $publisher_name, 'game_date' => $game_date, 'subseries' => $subseries, 'platform' => $platform, 'user_id' => $user_id]);
					$status = "Added successfully.";
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
		<!-- Creates Subjects - Game -->
		<div class="managecontenttitle">
			<center>
				<h2>Create Subjects</h2>
			</center>
		</div>
		<!-- Create Subject Form -->
		<div class="contentform">
		<h3>JRPG Game</h3>
		<form action="" method="POST">
			<label>Franchise Name:</label><br>
			<input type="text" name="franchise_name" value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST') echo $franchise_name ?>"><br>
			<label>Game Name:</label><br>
			<input type="text" name="game_name" value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST') echo $game_name ?>"><br>
			<label>Publisher:</label><br>
			<input type="text" name="publisher_name" value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST') echo $publisher_name ?>"><br>
			<label>Release Date:</label><br>
			<input type="date" name="game_date" value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST') echo $game_date ?>"><br>
			<label>Subseries (if applicable):</label><br>
			<input type="text" name="subseries" value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST') echo $subseries ?>"><br>
			<label>Platform:</label><br>
			<input type="text" name="platform" value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST') echo $platform ?>"><br>
			<label>Added By:</label><br>
			<input type="text" name="user_id" value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST') echo $user_id ?>"><br>
			<input type="submit" name="submit" value="submit">
			<p><?php echo $status ?></p>
		</form>
		<p><a href="create_subjects.php">Back</a></p>
		</div>	
	</body>
</html>