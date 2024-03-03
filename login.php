<?php
error_reporting(E_ALL);
session_start();

// Update these values with your actual database credentials
$servername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "shoopeerefund";

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Create a new mysqli connection
    $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check if username and password are set in the POST data
    if (isset($_POST["username"]) && isset($_POST["password"])) {
        $username = trim($_POST["username"]);
        $password = trim($_POST["password"]);

        if (empty($username) || empty($password)) {
            echo "Username or password not set.";
            exit;
        }

        // Prepare a SQL statement to retrieve the hashed password for the entered username
        $stmt = $conn->prepare("SELECT password FROM users WHERE username = ?");
        if (!$stmt) {
            die("Error preparing statement: " . $conn->error);
        }

        $stmt->bind_param("s", $username);
        if (!$stmt->execute()) {
            die("Error executing statement: " . $stmt->error);
        }

        $stmt->bind_result($hashed_password);
        $stmt->fetch();

        // Verify the entered password against the retrieved hashed password
        if ($hashed_password !== null && password_verify($password, $hashed_password)) {
            // Set the username in the session variable
            $_SESSION["username"] = $username;
            // Redirect to the myPurchases.php page
            header("Location: myPurchases.php");
            exit;
        } else {
            // Display an error message if credentials are invalid
            echo "<p>Invalid username or password. Please try again.</p>";
        }

        // Close the prepared statement
        $stmt->close();
    } else {
        echo "<p>Username or password not set.</p>";
    }

    // Close the database connection
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="login.css">
</head>
<body>
  <div class="container">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="form">
      <h2>Shopee Login</h2>
      <div class="form-group">
        <label for="username">Username</label>
        <input type="text" id="username" name="username" required>
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" required>
      </div>
      <button type="submit" class="btn">Login</button>
      <p>Don't have an account? <a href="register.html">Register here</a>.</p>
    </form>
  </div>
</body>
</html>
