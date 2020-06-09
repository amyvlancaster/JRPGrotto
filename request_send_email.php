<!-- Debugging Complete -->
<!DOCTYPE HTML>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="description" content="Your source for all things JRPG!">
		<meta name="keywords" content="jrpg">
		<title>JRPGrotto</title>
		<link rel="stylesheet" type="text/css" href="styles.css" />
		<link href="https://fonts.googleapis.com/css?family=Raleway:400,700&display=swap" rel="stylesheet">
	</head>
	<body>
		<!-- Begin PHP -->
		<?php
			if(!isset($_POST['submit'])) {
				//This page should not be accessed directly. Need to submit the form.
				echo "<p>error; you need to submit the form!</p>";
			}
			$firstname = $_POST['firstname'];
			$lastname = $_POST['lastname'];
			$email = $_POST['email'];
			$username = $_POST['username'];
			$comment = $_POST['comment'];
			//Validation 
			if(empty($firstname)||empty($email)) {
    			echo "<p>Name and email are mandatory!</p>";
    			exit;
			}
			if(IsInjected($email)) {
    			echo "<p>Bad email value!</p>";
    			exit;
			}
			$email_from = "amy.lancaster@mymail.champlain.edu";
			$email_subject = "New Form submission";
			$email_body = "You have received a new message from the user $name.\n".
    		"Here is the message:\n $message".
    		//Prepare the e-mail 
			$to = " "; //Enter your e-mail address
			$headers = "From: $email_from \r\n";
			$headers .= "Reply-To: $email \r\n";
			//Send the email
			mail($to,$email_subject,$email_body,$headers);
			//Redirect to Thank You page
			header('Location: thankyou.php');
			// Function to validate against any email injection attempts
			function IsInjected($str) {
  				$injections = array('(\n+)',
              	'(\r+)',
              	'(\t+)',
              	'(%0A+)',
              	'(%0D+)',
              	'(%08+)',
              	'(%09+)');
  				$inject = join('|', $injections);
  				$inject = "/$inject/i";
  				if(preg_match($inject,$str)) {
    				return true;
  				}
  				else {
    			return false;
  				}
			}
		?> 
	</body>
	</html>
