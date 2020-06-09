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
		<!-- Request title -->
		<center>
			<div class="logintitle">
				<h2>Request an Account</h2>
			</div>
		<!-- Begin form -->
		<div class="loginform">
		<form method="post" action="request_send_email.php">
				<label>First Name:</label>
				<input type="text" name="firstname"><br>
				<label>Last Name:</label>
				<input type="text" name="lastname"><br>
				<label>E-mail Address:</label>
				<input type="text" name="email"><br>
				<label>Desired Username:</label>
				<input type="text" name="username"><br>
				<label>Why do you want an account with JRPGrotto?</label><br>
				<textarea name="comment" rows=10 cols=40></textarea><br>
				<input type="submit" value="submit">
			</form>
		</div>
		</center>
		<!-- JavaScript for Form -->
		<script>
			var frmvalidator = new Validator("requestform");
			frmvalidator.addValiation("firstname", "req", "Please provide your first name");
			frmvalidator.addValidation("lastname", "req", "Please provide your last name");
			frmvalidator.addValidation("email", "req", "Please provide your e-mail address");
			frmvalidator.addValidation("email", "email", "Please enter a valid e-mail address");
			frmvalidator.addValidation("username", "req", "Please provide a username");
			frmvalidator.addValidation("comment", "req", "Please provide a reason why you need an account with JRPGrotto");
		</script>
	</body>
	</html>