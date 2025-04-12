<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Member</title>
  <link rel="stylesheet" href="styles4.css" />
</head>
<body>
  <div class="container">
    <div class="login-box">
      <h2>Motiv8</h2>
      <form onsubmit="return validateForm()">
        <input type="text" id="username" placeholder="Username" required />
        <input type="password" id="password" placeholder="Password" required />
        <button type="submit" class="login-btn">log in</button>
      </form>
      <div class="links">
        <a href="recover.html">Join now</a>
        <a href="../admin.php">Go back</a>
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