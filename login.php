<!-- Debugging Complete -->
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="description" content="Your source for all things JRPG!">
		<meta name="keywords" content="jrpg">
		<title>JRPGrotto</title>
		<link rel="stylesheet" type="text/css" href="utilities/styles.css" />
		<link href="https://fonts.googleapis.com/css?family=Raleway:400,700&display=swap" rel="stylesheet">
	</head>
	<body>
		<!-- Begin PHP -->
		<?php
            // Initialize the session
    		session_start();
            // Check if the user is already logged in
            if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    		  header("location: staffarea.php");
    		  exit;
            }
            // Include config file
            require_once "utilities/config.php";
            // Define variables and initialize with empty values
            $username = $password = "";
            $username_err = $password_err = "";
            // Processing form data when form is submitted
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Check if username is empty
                if (empty(trim($_POST["username"]))) {
                    $username_err = "<p>Please enter username.</p>";
                } 
                else {
                    $username = trim($_POST["username"]);
                }
                // Check if password is empty
                if (empty(trim($_POST["password"]))) {
                    $password_err = "<p>Please enter your password.</p>";
                } 
                else {
                    $password = trim($_POST["password"]);
                }
                // Validate credentials
                if (empty($username_err) && empty($password_err)) {
                    // Prepare a select statement
                    $sql = "SELECT id, username, password FROM users WHERE username = ?";
                    if ($stmt = mysqli_prepare($link, $sql)) {
                        // Bind variables to the prepared statement as parameters
                        mysqli_stmt_bind_param($stmt, "s", $param_username);
                        // Set parameters
                        $param_username = $username;
                        // Attempt to execute the prepared statement
                        if (mysqli_stmt_execute($stmt)) {
                            // Store result
                            mysqli_stmt_store_result($stmt);
                            // Check if username exists, if yes then verify password
                            if (mysqli_stmt_num_rows($stmt) == 1) {                    
                                // Bind result variables
                                mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                                if (mysqli_stmt_fetch($stmt)) {
                                    if (password_verify($password, $hashed_password)) {
                                        // Password is correct, so start a new session
                                        session_start();
                                        // Store data in session variables
                                        $_SESSION["loggedin"] = true;
                                        $_SESSION["id"] = $id;
                                        $_SESSION["username"] = $username;                            
                                        // Redirect user to welcome page
                                        header("location: staffarea.php");
                                    } 
                                    else {
                                        // Display an error message if password is not valid
                                        $password_err = "<p>The password you entered was not valid.</p>";
                                    }
                                }
                            } 
                            else {
                                // Display an error message if username doesn't exist
                                $username_err = "<p>No account found with that username.</p>";
                            }
                        } 
                        else {
                            echo "<p>Oops! Something went wrong. Please try again later.</p>";
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
				<a href="index.php">JRPGrotto</a>
			</div>
            <!-- Header Navigation -->
			<div class="nav">
				<a href="#">Persona</a>
				<a href="#">Atelier</a>
				<a href="#">Xeno</a>
			</div>
			<div class="staffnav">
				<a href="login.php">Staff Login</a>
			</div>
		</div>
		<!-- Login title -->
	<center>
		<div class="logintitle">
			<h2>Login</h2>
		</div>
		<!-- Login form for staff -->
		<div class="loginform">
			<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"> <!-- Action for PHP -->
				<div class="<?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
					<label>Username:</label> 
          <input type="text" name="username" value="<?php echo $username; ?>"><br>
					<span>
						<?php echo $username_err; ?>
						</span>
				</div>
				<div class="<?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
					<label>Password:</label>
          <input type="password" name ="password"><br>
					<span>
						<?php echo $password_err; ?>
						</span>
				</div>
				<input type="submit" value="Login">
			</form>
			<p>No account? <a href="request.php">Request one here</a>.</p>
		</div>
	</center>
	</body>
</html>