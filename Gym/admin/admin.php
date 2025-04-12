<?php
session_start();

// Database configuration
$host = 'localhost';
$username = 'root';
$password = ''; 
$dbname = 'gymsystem';

// Create a connection to the database
$conn = mysqli_connect($host, $username, $password, $dbname);

// Check if the connection was successful
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Handle form submission
$error = ""; // Variable to store error messages
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input_username = $_POST['username'];
    $input_password = $_POST['password'];

    // Prepare a query to check the credentials
    $query = "SELECT * FROM admin WHERE `User Name` = ? AND Password = ?";
    $stmt = mysqli_prepare($conn, $query);
    
    if ($stmt) {
        // Bind the parameters and execute the query
        mysqli_stmt_bind_param($stmt, "ss", $input_username, $input_password);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        // Check if a matching record exists
        if (mysqli_num_rows($result) > 0) {
            // Login successful
            $_SESSION['logged_in'] = true;
            $_SESSION['username'] = $input_username;
            header('Location: ../index.php'); // Redirect to the dashboard
            exit;
        } else {
            // Invalid credentials
            $error = "Invalid username or password.";
        }

        // Close the statement
        mysqli_stmt_close($stmt);
    } else {
        $error = "Database query preparation failed.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Admin</title>
  <link rel="stylesheet" href="styles3.css" />
</head>
<body>
  <div class="container">
    <div class="login-box">
      <h2>Motiv8</h2>
      <?php if (!empty($error)): ?>
        <p class="error"><?php echo htmlspecialchars($error); ?></p>
      <?php endif; ?>
      <form action="" method="POST">
        <input type="text" id="username" name="username" placeholder="Username" required />
        <input type="password" id="password" name="password" placeholder="Password" required />
        <button type="submit" class="login-btn">SIGN IN</button>
      </form>
      <div class="links">
        <a href="../customer/Login.php">Customer Log in</a>
        <a href="../staff/Login.php">Staff Log in</a>
      </div>
    </div>
  </div>

  <script>
    function validateForm() {
      const username = document.getElementById('username').value.trim();
      const password = document.getElementById('password').value.trim();
      if (username === '' || password === '') {
        alert('Please fill in all fields.');
        return false;
      }
      return true;
    }
  </script>
</body>
</html>