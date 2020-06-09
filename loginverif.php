         //Count for login fail attempts  
        if (isset($_POST["username"])) {
          $username = $_POST['username'];
          $password = $_POST['password'];
    try {
        $con = new PDO("mysql:host=". DB_SERVER . ";dbname=" . DB_NAME, DB_USERNAME, DB_PASSWORD);
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM users WHERE username = '$username'";
        $stmt = $con->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetchAll();
        $username_exists = false;
        $lockout_minutes = 5;
        $login_fail_max = 5;
        $login_fail_count = 0;
        $timestamp = date("Y-m-d H:i:s");
        if (sizeof($data) == 1) {
            $userid = $data[0]['id'];
            $username_exists = true;
            if ($data[0]['is_locked'] == 1) {
                $lock_start_timestamp = $data[0]['lock_start_timestamp'];
                if ($lock_start_timestamp != NULL) {
                    $dif = (strtotime($timestamp) - strtotime($lock_start_timestamp));
                    if ($dif > $lockout_minutes * 60) {
                        $login_fail_count = 0;
                        $sql = "UPDATE users
                        SET is_locked = 0, login_fail_count = 0, lock_start_timestamp = NULL
                        WHERE userid = $userid";
                        $stmt = $con->prepare($sql);
                        $stmt->execute();
                    }
                }
            } else {
                $login_fail_count = $data[0]['login_fail_count'];
            }
        }
        if ($username_exists) {
            $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password' LIMIT 1";
            $stmt = $con->prepare($sql);
            $stmt->execute();
            $data = $stmt->fetchAll();
            
            if (sizeof($data) == 1) {
                if ($data[0]["is_locked"] == 0) {
                    $sql = "UPDATE users
                    SET login_fail_count = 0
                    WHERE id = $userid";
                    $stmt = $con->prepare($sql);
                    $stmt->execute();
                    // Login Successful
                    $_SESSION["id"] = $data[0]["username"];
                    header("Location: staffarea.php");
                } else {
                    // Account is locked. Increment failed login count
                    $sql = "UPDATE users
                        SET login_fail_count = login_fail_count + 1
                        WHERE username = '$username'";
                    $stmt = $con->prepare($sql);
                    $stmt->execute();
                    echo "<pre>Account is locked.</pre>";
                }
            } else {
                // Not Successful. Increment failed login count
                $will_be_locked = ($login_fail_count == $login_fail_max - 1);
                $timestamp = date("Y-m-d H:i:s");
                if ($will_be_locked) {
                    $sql = "UPDATE users
                    SET login_fail_count = login_fail_count + 1, is_locked = 1, lock_start_timestamp = '$timestamp'
                    WHERE id = $userid";
                } else {
                    $sql = "UPDATE users
                    SET login_fail_count = login_fail_count + 1
                    WHERE id = $userid";
                }
                $stmt = $con->prepare($sql);
                $stmt->execute();
                
                if ($will_be_locked) {
                    echo "<pre>Account is locked.</pre>";
                } else {
                    $attempts_remaining = ($login_fail_max - ($login_fail_count + 1));
                    if ($attempts_remaining > 0) {
                        echo "<pre>Incorrect username or password.</pre>";
                        if ($attempts_remaining <= 3) {
                            echo "<pre>Attempts remaining: " . ($login_fail_max - ($login_fail_count + 1)) . "</pre>";
                        }
                    }
                }
            }
        } else {
            echo "<pre>Incorrect username or password.</pre>";
        }
    } catch (PDOException $e) {
        echo "Fail: " . $e->getMessage();
    }
}