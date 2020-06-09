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
            header("Location: character_update.php");
        }
        if (!empty($_POST)) {
            //Keep track of validation errors
            $jrpg_idError = null;
            $game_idError = null;
            $first_nameError = null;
            $last_nameError = null;
            $job_roleError = null;
            $weaponError = null;
            $itemError = null;
            $image_fileError = null;
            $postedError = null;
            $authorError = null;
            //Keep track of post values
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
            $valid = true; 
            if (!is_numeric($jrpg_id)) {
                $status = "Please enter a valid JRPG ID.";
            }
            elseif (!is_numeric($game_id)) {
                $status = "Please enter a valid game ID.";
            }
            elseif(strlen($first_name) >= 255 || !preg_match("/^[a-zA-Z-'\s]+$/", $first_name)) {
                $status = "Please enter a valid first name.";
            }
            elseif(strlen($last_name) >= 255 || !preg_match("/^[a-zA-Z-'\s]+$/", $last_name)) {
                $status = "Please enter a valid last name.";
            }
            elseif(strlen($job_role) >= 255 || !preg_match("/^[a-zA-Z-'\s]+$/", $job_role)) {
                $status = "Please enter a valid job role.";
            }
            elseif(strlen($weapon) >= 255 || !preg_match("/^[a-zA-Z-'\s]+$/", $weapon)) {
                $status = "Please enter a valid weapon.";
            }
            elseif(strlen($item) >= 255 || !preg_match("/^[a-zA-Z-'\s]+$/", $item)) {
                $status = "Please enter a valid item.";
            }
            elseif(strlen($image_file) >= 255 || !preg_match("/^[.a-zA-Z-'\s]+$/", $image_file)) {
                $status = "Please enter a valid image file.";
            }
            elseif(preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$posted)) {
                $status = "Please enter a valid date format YYYYMMDD.";
            }
            elseif(!is_numeric($author)) {
                $status = "Please enter a valid Author ID.";
            }
            else {
                //Update data
                if ($valid) {
                    $db_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $sql = "UPDATE character_profiles  set jrpg_id = ?, game_id = ?, first_name = ?, last_name = ?, job_role = ?, weapon = ?, item = ?, image_file = ?, posted = ?, author = ? WHERE ID = ?";
                    $q = $db_conn->prepare($sql);
                    $q->execute(array($jrpg_id, $game_id, $first_name, $last_name, $job_role, $weapon, $item, $image_file, $posted, $author, $id));
                    header("Location: character_update.php");
                }
                else {
                    $db_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $sql = "SELECT * FROM character_profiles where ID = ?";
                    $q = $db_conn->prepare($sql);
                    $q->execute(array($id));
                    $data = $q->fetch(PDO::FETCH_ASSOC);
                    $jrpg_id = $data['jrpg_id'];
                    $game_id = $data['game_id'];
                    $first_name = $data['first_name'];
                    $last_name = $data['last_name'];
                    $job_role = $data['job_role'];
                    $weapon = $data['weapon'];
                    $item = $data['item'];
                    $image_file = $data['image_file'];
                    $posted = $data['posted'];
                    $author = $data['author'];
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
        <!-- Update a Character -->
        <div class="managecontenttitle">
            <center>
                <h2>Update a Character</h2>
            </center>
        </div>
        <h2>Edit An Entry</h2>
        <!-- Begin Form -->
        <div class="contentform">
            <form method="post" action="update_entry_character.php?ID=<?php echo $id?>">
            <!-- Edit Franchise ID -->
            <div class="<?php echo !empty($jrpg_idError)?'error':'';?>">
                <label>Franchise ID:</label>
                <input type="text" name="jrpg_id" value="<?php 
                $stmt = $db_conn->query('SELECT ID, jrpg_id FROM character_profiles');
                while($row = $stmt->fetch()) {
                echo 
                $row['jrpg_id'];}?>">
                <?php if (!empty($jrpg_idError)): ?>
                <span><?php echo $jrpg_idError;?></span>
                <?php endif; ?><br>
            </div>
            <!-- Edit Game Id -->
            <div class="<?php echo !empty($game_idError)?'error':'';?>">
                <label>Game ID:</label>
                <input type="text" name="game_id" value="<?php 
                $stmt = $db_conn->query('SELECT ID, game_id FROM character_profiles');
                while($row = $stmt->fetch()) {
                echo 
                $row['game_id'];}?>">
                <?php if (!empty($game_idError)): ?>
                <span><?php echo $game_idError;?></span>
                <?php endif; ?><br>
            </div>
            <!-- Edit First Name -->
            <div class="<?php echo !empty($first_nameError)?'error':'';?>">
                <label>First Name:</label>
                <input type="text" name="first_name" value="<?php 
                $stmt = $db_conn->query('SELECT ID, first_name FROM character_profiles');
                while($row = $stmt->fetch()) {
                echo 
                $row['first_name'];}?>">
                <?php if (!empty($first_nameError)): ?>
                <span><?php echo $first_nameError;?></span>
                <?php endif; ?><br>
            </div>
            <!-- Edit Last name -->
            <div class="<?php echo !empty($last_nameError)?'error':'';?>">
                <label>Last name:</label><br>
                <input type="text" name="last_name" value="<?php 
                $stmt = $db_conn->query('SELECT ID, last_name FROM character_profiles');
                while($row = $stmt->fetch()) {
                echo 
                $row['last_name'];}?>">
                <?php if (!empty($last_nameError)): ?>
                <span><?php echo $last_nameError;?></span>
                <?php endif; ?><br>
            </div>
            <!-- Edit Job Role -->
            <div class="<?php echo !empty($job_roleError)?'error':'';?>">
                <label>Job Role:</label><br>
                <input type="text" name="job_role" value="<?php 
                $stmt = $db_conn->query('SELECT ID, job_role FROM character_profiles');
                while($row = $stmt->fetch()) {
                echo 
                $row['job_role'];}?>">
                <?php if (!empty($job_roleError)): ?>
                <span><?php echo $job_roleError;?></span>
                <?php endif; ?><br>
            </div>
            <!-- Edit Weapon -->
            <div class="<?php echo !empty($weaponError)?'error':'';?>">
                <label>Weapon:</label>
                <input type="text" name="weapon" value="<?php 
                $stmt = $db_conn->query('SELECT ID, weapon FROM character_profiles');
                while($row = $stmt->fetch()) {
                echo 
                $row['weapon'];}?>">
                <?php if (!empty($weaponError)): ?>
                <span><?php echo $weaponError;?></span>
                <?php endif; ?><br>
            </div>
            <!-- Item -->
            <div class="<?php echo !empty($itemError)?'error':'';?>">
                <label>Item:</label>
                <input type="text" name="item" value="<?php 
                $stmt = $db_conn->query('SELECT ID, item FROM character_profiles');
                while($row = $stmt->fetch()) {
                echo 
                $row['item'];}?>">
                <?php if (!empty($itemError)): ?>
                <span><?php echo $itemError;?></span>
                <?php endif; ?><br>
            </div>
            <!-- Image File -->
            <div class="<?php echo !empty($image_fileError)?'error':'';?>">
                <label>Image file:</label>
                <input type="text" name="image_file" value="<?php 
                $stmt = $db_conn->query('SELECT ID, image_file FROM character_profiles');
                while($row = $stmt->fetch()) {
                echo 
                $row['image_file'];}?>">
                <?php if (!empty($image_fileError)): ?>
                <span><?php echo $image_fileError;?></span>
                <?php endif; ?><br>
            </div>
            <!-- Posted -->
            <div class="<?php echo !empty($postedError)?'error':'';?>">
                <label>Edited On (YYYYMMDD):</label>
                <input type="date" name="posted" value="<?php 
                $stmt = $db_conn->query('SELECT ID, posted FROM character_profiles');
                while($row = $stmt->fetch()) {
                echo 
                $row['posted'];}?>">
                <?php if (!empty($postedError)): ?>
                <span><?php echo $postedError;?></span>
                <?php endif; ?><br>
            </div>
            <!-- Author ID -->
            <div class="<?php echo !empty($authorError)?'error':'';?>">
                <label>Edited By (Enter Your User ID #):</label>
                <input type="text" name="author" value="<?php 
                $stmt = $db_conn->query('SELECT ID, author FROM character_profiles');
                while($row = $stmt->fetch()) {
                echo 
                $row['author'];}?>">
                <?php if (!empty($authorError)): ?>
                <span><?php echo $authorError;?></span>
                <?php endif; ?><br>
            </div>
            <!-- Submit -->
            <input type="submit" name="Update" value="Update">
        </form>
        <p><a href="character_update.php">Go back to the table</a></p>
        </div>
    </body>
</html>