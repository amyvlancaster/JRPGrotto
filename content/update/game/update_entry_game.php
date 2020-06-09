<!-- Debugging Complete -->
<!DOCTYPE HTML>
<html lang="en">
    <!-- Begin PHP -->
    <?php
            // Initialize the session
            session_start();
 
            // Check if the user is logged in, if not then redirect him to login page
            if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
                header("location: ../../../login.php");
                exit;
            }
            //Calls the database 
            require '../../../utilities/config.php'; 
            $id = null;
            if (!empty($_GET['ID'])) {
                $id = $_REQUEST['ID'];
            } 
            if (null==$id) {
                header("Location: game_update.php");
            }
            if (!empty($_POST)) {
                //Keep track of validation errors
                $franchise_nameError = null;
                $game_nameError = null;
                $publisher_nameError = null;
                $subseriesError = null;
                $platformError = null;
                $user_IDError = null;
                //Keep track of post values
                $franchise_name = $_POST['franchise_name'];
                $game_name = $_POST['game_name'];
                $publisher_name = $_POST['publisher_name'];
                $subseries = $_POST['subseries'];
                $platform = $_POST['platform'];
                $user_ID = $_POST['user_ID'];
                //Form validation 
                $valid = true; 
                if(strlen($franchise_name) >= 255 || !preg_match("/^[0-9a-zA-Z-'\s]+$/", $franchise_name)) {
                    $status = "Please enter a valid franchise name.";
                }
                elseif(strlen($game_name) >= 255 || !preg_match("/^[0-9a-zA-Z-'\s]+$/", $game_name)) {
                    $status = "Please enter a valid game name.";
                }
                elseif(strlen($publisher_name) >= 255 || !preg_match("/^[0-9a-zA-Z-'\s]+$/", $publisher_name)) {
                    $status = "Please enter a valid publisher name.";
                }
                elseif(strlen($subseries) >= 255 || !preg_match("/^[0-9a-zA-Z-'\s]+$/", $subseries)) {
                    $status = "Please enter a valid subseries name.";
                }
                elseif(strlen($platform) >= 255 || !preg_match("/^[0-9a-zA-Z-'\s]+$/", $platform)) {
                    $status = "Please enter a valid franchise name.";
                }
                elseif(!is_numeric($user_ID)) {
                    $status = "Please enter a valid User ID.";
                }
                else {
        		  //Update data
                    if ($valid) {
                        $db_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        $sql = "UPDATE game  set franchise_name = ?, game_name = ?, publisher_name = ?, subseries = ?, platform = ?, user_ID = ? WHERE ID = ?";
                        $q = $db_conn->prepare($sql);
                        $q->execute(array($franchise_name, $game_name, $publisher_name, $subseries, $platform, $user_ID, $id));
                        header("Location: game_update.php");
                    }
                    else {
                        $db_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        $sql = "SELECT * FROM game where ID = ?";
                        $q = $db_conn->prepare($sql);
                        $q->execute(array($id));
                        $data = $q->fetch(PDO::FETCH_ASSOC);
                        $franchise_name = $data['franchise_name'];
                        $game_name = $data['game_name'];
                        $publisher_name = $data['publisher_name'];
                        $subseries = $data['subseries'];
                        $platform = $data['platform'];
                        $user_ID = $data['user_ID'];
                    }
                }
            }
        ?>
    <head>
	   <title>Edit An Entry</title>
	   <!-- Begin Stylesheet -->
        <meta charset="utf-8">
        <meta name="description" content="Your source for all things JRPG!">
        <meta name="keywords" content="jrpg">
        <title>JRPGrotto</title>
        <link rel="stylesheet" type="text/css" href="../../../utilities/styles.css" />
        <link href="https://fonts.googleapis.com/css?family=Raleway:400,700&display=swap" rel="stylesheet">
    </head>
    <body>
    <!-- Header -->
        <div class="header">
            <div class="jrpgrotto">
                <a href="../../../index.php">JRPGrotto</a>
            </div>
            <div class="nav">
                <!-- Header Nav -->
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
        <!-- Update a Game -->
        <div class="managecontenttitle">
            <center>
                <h2>Update a Game</h2>
            </center>
        </div>
	<h2>Edit An Entry</h2>
	<!-- Begin Form -->
    <div class="contentform">
	   <form method="post" action="update_entry_game.php?ID=<?php echo $id?>">
		  <!-- Edit Franchise Name -->
		<div class="<?php echo !empty($franchise_nameError)?'error':'';?>">
			<label>Franchise Name:</label>
			<input type="text" name="franchise_name" value="<?php 
            $stmt = $db_conn->query('SELECT ID, franchise_name FROM game');
            while($row = $stmt->fetch()) {
                echo 
                $row['franchise_name'];}?>">
			<?php if (!empty($franchise_nameError)): ?>
        	<span><?php echo $franchise_nameError;?></span>
        	<?php endif; ?><br>
        </div>
        <!-- Edit Game Name -->
        <div class="<?php echo !empty($game_nameError)?'error':'';?>">
            <label>Game Name:</label>
            <input type="text" name="game_name" value="<?php 
            $stmt = $db_conn->query('SELECT ID, game_name FROM game');
            while($row = $stmt->fetch()) {
                echo 
                $row['game_name'];}?>">
            <?php if (!empty($game_nameError)): ?>
            <span><?php echo $game_nameError;?></span>
            <?php endif; ?><br>
        </div>
        <!-- Edit Publisher Name -->
        <div class="<?php echo !empty($publisher_nameError)?'error':'';?>">
            <label>Publisher Name:</label>
            <input type="text" name="publisher_name" value="<?php 
            $stmt = $db_conn->query('SELECT ID, publisher_name FROM game');
            while($row = $stmt->fetch()) {
                echo 
                $row['publisher_name'];}?>">
            <?php if (!empty($publisher_nameError)): ?>
            <span><?php echo $publisher_nameError;?></span>
            <?php endif; ?><br>
        </div>
        <!-- Edit Subseries -->
        <div class="<?php echo !empty($subseriesError)?'error':'';?>">
            <label>Subseries:</label><br>
            <input type="text" name="subseries" value="<?php 
            $stmt = $db_conn->query('SELECT ID, subseries FROM game');
            while($row = $stmt->fetch()) {
                echo 
                $row['subseries'];}?>">
            <?php if (!empty($subseriesError)): ?>
            <span><?php echo $subseriesError;?></span>
            <?php endif; ?><br>
        </div>
        <!-- Edit Platform -->
        <div class="<?php echo !empty($platformError)?'error':'';?>">
            <label>Platform:</label><br>
            <input type="text" name="platform" value="<?php 
            $stmt = $db_conn->query('SELECT ID, platform FROM game');
            while($row = $stmt->fetch()) {
                echo 
                $row['platform'];}?>">
            <?php if (!empty($platformError)): ?>
            <span><?php echo $platformError;?></span>
            <?php endif; ?><br>
        </div>
        <!-- Edit User ID -->
        <div class="<?php echo !empty($user_IDError)?'error':'';?>">
            <label>Edited By (Enter Your User ID #):</label>
            <input type="text" name="user_ID" value="<?php 
            $stmt = $db_conn->query('SELECT ID, user_ID FROM game');
            while($row = $stmt->fetch()) {
                echo 
                $row['user_ID'];}?>">
            <?php if (!empty($user_IDEerror)): ?>
            <span><?php echo $user_IDError;?></span>
            <?php endif; ?><br>
        </div>
		<!-- Submit -->
		<input type="submit" name="Update" value="Update">
	   </form>
	   <p><a href="game_update.php">Go back to the table</a></p>
    </div>
    </body>
</html>