<!-- Debugging Complete -->
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="description" content="Your source for all things JRPG!">
		<meta name="keywords" content="jrpg">
		<title>JRPGrotto</title>
		<link rel="stylesheet" type="text/css" href="../utilities/styles.css" />
		<link href="https://fonts.googleapis.com/css?family=Raleway:400,700&display=swap" rel="stylesheet">
	</head>
	<body>
		<?php
            // Initialize the session
            session_start();
 
            // Check if the user is logged in, if not then redirect him to login page
            if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
                header("location: ../login.php");
                exit;
            }
            //Calls the database 
            require '../utilities/config.php';
            $id = null;
            if (!empty($_GET['ID'])) {
                $id = $_REQUEST['ID'];
            }
            if (null==$id) {
                header("Location: update_users.php");
            }
            if (!empty($_POST)) {
                //Keep track of validation errors
                $usernameError = null;
                //Keep track of post values
                $username = $_POST['username'];
                //Form validation 
                $valid = true; 
                if(empty($username)) {
                    $status = "All fields are required.";
                }
                else {
                    if(strlen($username) >= 255 || !preg_match("/^[0-9a-zA-Z-'\s]+$/", $username)) {
                        $status = "Please enter a valid franchise name.";
                    }
                    else {
                        //Update data
                        if ($valid) {
                            $db_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                            $sql = "UPDATE users  set username = ? WHERE ID = ?";
                            $q = $db_conn->prepare($sql);
                            $q->execute(array($username, $id));
                            header("Location: update_users.php");
                        }
                        else {
                            $db_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                            $sql = "SELECT * FROM users where ID = ?";
                            $q = $db_conn->prepare($sql);
                            $q->execute(array($id));
                            $data = $q->fetch(PDO::FETCH_ASSOC);
                            $name = $data['username'];
                        }
                    }
                }
            }
        ?>
		<!-- Header -->
		<div class="header">
			<div class="jrpgrotto">
				<a href="../index.php">JRPGrotto</a>
			</div>
            <!-- Header Nav -->
			<div class="nav">
				<a href="#">Persona</a>
				<a href="#">Atelier</a>
				<a href="#">Xeno</a>
			</div>
			<div class="staffnav">
				<a href="../login.php">Staff Login</a>
			</div>
		</div>
		<!-- Begin staff area -->
		<div class="staffareatitle">
			<h2>Staff Area</h2>
		</div>
		<!-- Staff Area Navigation -->
		<div class="staffareanav">
			<a href="../content/content.php">Manage Content</a><br>
			<a href="users.php">Add Users</a><br>
			<a href="../logout.php">Logout</a><br>
		</div>
        <!-- Update Users -->
        <div class="adduserstitle">
            <center>
                <h2>Update Users</h2>
            </center>
        </div>
        <!-- Begin Form -->
        <div class="contentform">
            <form method="post" action="update_entry_users.php?ID=<?php echo $id?>">
                <div class="<?php echo !empty($usernameError)?'error':'';?>">
                    <label>Username:</label>
                    <input type="text" name="username" value="<?php 
                    $stmt = $db_conn->query('SELECT ID, username FROM users');
                    while($row = $stmt->fetch()) {
                        echo 
                        $row['username'];}?>">
                    <?php if (!empty($usernameError)): ?>
                    <span><?php echo $userameError;?></span>
                    <?php endif; ?><br>
                </div>   
                <div>
                    <input type="submit" value="Submit" name="Submit">
                </div>
            </form>
        </div>        
        </center>
	</body>
</html>