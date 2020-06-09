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
		<!--Begin PHP -->
		<?php
			// Initialize the session
			session_start();
 
			// Check if the user is logged in, if not then redirect him to login page
			if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    			header("location: ../login.php");
    			exit;
			}
            // Include config file
            require_once "../utilities/config.php";
            // Define variables and initialize with empty values
            $username = $password = $confirm_password = "";
            $username_err = $password_err = $confirm_password_err = "";
            // Processing form data when form is submitted
            if($_SERVER["REQUEST_METHOD"] == "POST") {
                // Validate username
                if(empty(trim($_POST["username"]))) {
                    $username_err = "Please enter a username.";
                } 
                else {
                    // Prepare a select statement
                    $sql = "SELECT id FROM users WHERE username = ?";
                    if($stmt = mysqli_prepare($link, $sql)) {
                        // Bind variables to the prepared statement as parameters
                        mysqli_stmt_bind_param($stmt, "s", $param_username);
                        // Set parameters
                        $param_username = trim($_POST["username"]);
                        // Attempt to execute the prepared statement
                        if(mysqli_stmt_execute($stmt)) {
                            // store result
                            mysqli_stmt_store_result($stmt);
                            if(mysqli_stmt_num_rows($stmt) == 1){
                                $username_err = "This username is already taken.";
                            } 
                            else {
                                $username = trim($_POST["username"]);
                            }
                        } 
                        else {
                            echo "Oops! Something went wrong. Please try again later.";
                        }
                        // Close statement
                        mysqli_stmt_close($stmt);
                    }
                }
                // Validate password
                if(empty(trim($_POST["password"]))) {
                    $password_err = "Please enter a password.";     
                } 
                elseif(strlen(trim($_POST["password"])) < 6) {
                    $password_err = "Password must have atleast 6 characters.";
                } 
                else {
                    $password = trim($_POST["password"]);
                }
                // Validate confirm password
                if(empty(trim($_POST["confirm_password"]))) {
                    $confirm_password_err = "Please confirm password.";     
                } 
                else {
                    $confirm_password = trim($_POST["confirm_password"]);
                    if(empty($password_err) && ($password != $confirm_password)){
                        $confirm_password_err = "Password did not match.";
                    }
                }
                // Check input errors before inserting in database
                if(empty($username_err) && empty($password_err) && empty($confirm_password_err)) {
                    // Prepare an insert statement
                    $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
                    if($stmt = mysqli_prepare($link, $sql)) {
                        // Bind variables to the prepared statement as parameters
                        mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);
                        // Set parameters
                        $param_username = $username;
                        $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
                        // Attempt to execute the prepared statement
                        if(mysqli_stmt_execute($stmt)) {
                            echo "Account created successfully.";
                        } 
                        else {
                            echo "Something went wrong. Please try again later.";
                        }
                        // Close statement
                        mysqli_stmt_close($stmt);
                    }
                }
                // Close connection
                mysqli_close($link);
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
        <!-- Add Users -->
        <div class="adduserstitle">
            <center>
                <h2>Create Users</h2>
            </center>
        </div>
        <!-- Begin Form -->
        <div class="contentform">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="<?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                    <label>Username:</label><br>
                    <input type="text" name="username" value="<?php echo $username; ?>"><br>
                    <span><?php echo $username_err; ?></span>
                </div>    
                <div class="<?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                    <label>Password:</label><br>
                    <input type="password" name="password" value="<?php echo $password; ?>"><br>
                    <span><?php echo $password_err; ?></span>
                </div>
                <div class="<?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                    <label>Confirm Password:</label><br>
                    <input type="password" name="confirm_password" value="<?php echo $confirm_password; ?>"><br>
                    <span><?php echo $confirm_password_err; ?></span>
                </div>
                <div>
                    <input type="submit" value="Submit" name="Submit">
                </div>
            </form>
        </div>        
        </center>
	</body>
</html>