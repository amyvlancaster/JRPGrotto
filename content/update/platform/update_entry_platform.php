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
                header("Location: platform_update.php");
            }
            if (!empty($_POST)) {
                //Keep track of validation errors
                $platform_nameError = null;
                //Keep track of post values
                $platform_name = $_POST['platform_name'];
                //Form validation 
                $valid = true; 
                if(empty($platform_name)) {
                    $status = "All fields are required.";
                }
                else {
                    if(strlen($platform_name) >= 255 || !preg_match("/^[0-9a-zA-Z-'\s]+$/", $platform_name)) {
                        $status = "Please enter a valid platform name.";
                    }
                    else {
                        //Update data
                        if ($valid) {
                            $db_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                            $sql = "UPDATE platform  set platform_name = ? WHERE ID = ?";
                            $q = $db_conn->prepare($sql);
                            $q->execute(array($platform_name, $id));
                            header("Location: platform_update.php");
                        }
                        else {
                            $db_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                            $sql = "SELECT * FROM platform where ID = ?";
                            $q = $db_conn->prepare($sql);
                            $q->execute(array($id));
                            $data = $q->fetch(PDO::FETCH_ASSOC);
                            $name = $data['platform_name'];
                        }
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
        <!-- Update a Platform -->
        <div class="managecontenttitle">
            <center>
                <h2>Update a Platform</h2>
            </center>
        </div>
	   <h2>Edit An Entry</h2>
	   <!-- Begin Form -->
       <div class="contentform">
        <center>
            <form method="post" action="update_entry_platform.php?ID=<?php echo $id?>">
                <!-- Edit Name -->
                <div class="<?php echo !empty($platform_nameError)?'error':'';?>">
                    <label>Platform Name:</label>
                    <input type="text" name="platform_name" value="<?php 
                    $stmt = $db_conn->query('SELECT ID, platform_name FROM platform');
                    while($row = $stmt->fetch()) {
                        echo 
                        $row['platform_name'];}?>">
                    <?php if (!empty($platform_nameError)): ?>
                    <span><?php echo $platform_nameError;?></span>
                    <?php endif; ?><br>
                </div>
		      <!-- Submit -->
		      <input type="submit" name="Update" value="Update">
            </form>
	       <p><a href="platform_update.php">Go back to the table</a></p>
        </center>
        </div>
    </body>
</html>