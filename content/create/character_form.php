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
				$jrpg_id = $_POST['jrpg_id'];
				$game_id = $_POST['game_id'];
				$first_name = $_POST['first_name'];
				$last_name = $_POST['last_name'];
				$job_role = $_POST['job_role'];
				$weapon = $_POST['weapon'];
				$item = $_POST['item'];
				$image_file = $_POST['image_file'];
				$posted = $_POST['posted'];
				$author = $_POST['author'];
				//Form validation 
				if(empty($jrpg_id) || empty($game_id) || empty($first_name) || empty($image_file) || empty($posted) || empty($author)) {
					$status = "JRPG ID, Game ID, First Name, Image File, Date Posted, and Author are all required.";
				}
				elseif(!is_numeric($jrpg_id)) {
						$status = "Please enter a JRPG ID.";
				}

				elseif(!is_numeric($game_id)) {
						$status = "Please enter a valid game ID.";
				}

				elseif(strlen($first_name) >= 255 || !preg_match("/^[a-zA-Z-'\s]+$/", $first_name)) {
						$status = "Please enter a valid first name.";
				}

				elseif(strlen($last_name) >= 255 || !preg_match("/^[a-zA-Z-'\s]+$/", $last_name)) {
						$status = "Please enter a valid last name.";
				}

				elseif(strlen($job_role) >= 255 || !preg_match("/^[a-zA-Z-'\s]+$/", $job_role)) {
						$status = "Please enter a job role.";
				}

				elseif(strlen($weapon) >= 255 || !preg_match("/^[a-zA-Z-'\s]+$/", $weapon)) {
						$status = "Please enter a valid weapon.";
				}

				elseif(strlen($item) >= 255 || !preg_match("/^[a-zA-Z-'\s]+$/", $item)) {
						$status = "Please enter a valid item.";
				}


				elseif(preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$posted)) {
						$status = "Please enter a valid date.";
				}

				elseif(!is_numeric($author)) {
						$status = "Please enter a valid user ID.";
				}

				//Inserting data into table 
				else {
					$sql = "INSERT INTO character_profiles (jrpg_id, game_id, first_name, last_name, job_role, weapon, item, image_file, posted, author) VALUES (:jrpg_id, :game_id, :first_name, :last_name, :job_role, :weapon, :item, :image_file, :posted, :author)";
					$stmt = $db_conn->prepare($sql);
					$stmt->execute(['jrpg_id' => $jrpg_id, 'game_id' => $game_id, 'first_name' => $first_name, 'last_name' => $last_name, 'job_role' => $job_role, 'weapon' => $weapon, 'item' => $item, 'image_file' => $image_file, 'posted' => $posted, 'author' => $author]);
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

		<!-- Create Subjects - Characters -->
		<div class="managecontenttitle">
			<center>
				<h2>Create Subjects</h2>
			</center>
		</div>
		<!-- Create Character Form -->
		<div class="contentform">
		<h3>Add a Character Profile</h3>
		<form action="" method="POST">
			<label>JRPG Franchise (Enter ID #):</label><br>
			<input type="text" name="jrpg_id" value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST') echo $jrpg_id ?>"><br>
			<label>Game (Enter ID #):</label><br>
			<input type="text" name="game_id" value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST') echo $game_id ?>"><br>
			<label>First Name (Required):</label><br>
			<input type="text" name="first_name" value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST') echo $first_name ?>"><br>
			<label>Last Name:</label><br>
			<input type="text" name="last_name" value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST') echo $last_name ?>"><br>
			<label>Job Role:</label><br>
			<input type="text" name="job_role" value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST') echo $job_role ?>"><br>
			<label>Weapon:</label><br>
			<input type="text" name="weapon" value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST') echo $weapon ?>"><br>
			<label>Item:</label><br>
			<input type="text" name="item" value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST') echo $item ?>"><br>
			<label>Image (Enter file name):</label><br>
			<input type="text" name="image_file" value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST') echo $image_file ?>"><br>
			<label>Date Added (YYYYMMDD)</label><br>
			<input type="date" name="posted" value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST') echo $posted ?>"><br>
			<label>Added By (Enter Your ID #):</label><br>
			<input type="text" name="author" value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST') echo $author ?>"><br>
			<input type="submit" name="submit" value="submit">
			<p><?php echo $status ?></p>
		</form>
		<p><a href="create_subjects.php">Back</a></p>
		</div>
	</body>
</html>