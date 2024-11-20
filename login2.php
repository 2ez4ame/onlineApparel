<?php
// Include database connection
include('databaseconnection.php');

// Start session to store login status
session_start();

// Clear any previous session
session_unset();
session_destroy();

// Start a new session after destroying the previous one
session_start();

// Check if form is submitted
if (isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email']; // User input for email
    $password = $_POST['password']; // User input for password

    // Check if input is a valid email
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Query to check user by email
        $query = "SELECT * FROM users WHERE email = ?";

        // Prepare SQL statement
        if ($stmt = $conn->prepare($query)) {
            // Bind parameters and execute query
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();

            // Check if user exists
            if ($result->num_rows > 0) {
                $user = $result->fetch_assoc();

                // If the user is an admin, directly compare the password (unhashed)
                if ($user['role'] == 'admin') {
                    // Admin login, no password hashing, use the plain password from the database
                    if ($password === $user['password']) {
                        // Password is correct, start the session
                        $_SESSION['user_id'] = $user['user_id']; // Use 'user_id' here (as per your database schema)
                        $_SESSION['username'] = $user['username'];
                        $_SESSION['first_name'] = $user['first_name']; // Make sure first_name is stored in the session
                        $_SESSION['email'] = $user['email'];

                        // Redirect to the admin side
                        header('Location: admin-page.php');
                        exit();
                    } else {
                        // Password is incorrect for admin
                        $error = "Invalid password. Please try again.";
                    }
                } else {
                    // For non-admin users, use password_verify for hashed password comparison
                    if (password_verify($password, $user['password'])) {
                        // Password is correct, start the session
                        $_SESSION['user_id'] = $user['user_id']; // Use 'user_id' here (as per your database schema)
                        $_SESSION['username'] = $user['username'];
                        $_SESSION['first_name'] = $user['first_name']; // Store first_name in session
                        $_SESSION['email'] = $user['email'];

                        // Redirect to the user home page
                        header('Location: userhome.php');
                        exit();
                    } else {
                        // Password is incorrect for regular user
                        $error = "Invalid password. Please try again.";
                    }
                }
            } else {
                // No user found with that email
                $error = "No user found with that email address.";
            }

            $stmt->close();
        } else {
            // If SQL preparation failed
            $error = "There was an error with the login request. Please try again later.";
        }
    } else {
        // If the email format is invalid
        $error = "Please enter a valid email address.";
    }

    // Close database connection
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="icons/logo.png" type="image/x-icon">
  <title>GZEL Online Apparel</title>
  <link rel="stylesheet" href="css/login2.css">
  <!-- Font Awesome for the eye icon -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>
<body>
  <div class="login-container">
    <h2>Login</h2>
    <form action="login2.php" method="POST">
      <div class="input-group">
        <label for="email">Email</label>
        <input type="text" id="email" name="email" required>
      </div>
      <div class="input-group">
        <label for="password">Password</label>
        <div class="password-container">
          <input type="password" id="password" name="password" required>
          <i class="fas fa-eye" id="toggle-password" onclick="togglePasswordVisibility()"></i>
        </div>
      </div>
      <button type="submit" class="btn">Login</button>
    </form>
    <?php if (isset($error)) { ?>
        <p style="color: red;"><?php echo $error; ?></p>
    <?php } ?>
    <p>Don't have an account? <a href="create.php">Sign up</a></p>
  </div>

  <script>
    // Function to toggle the visibility of the password
    function togglePasswordVisibility() {
      const passwordInput = document.getElementById("password");
      const passwordIcon = document.getElementById("toggle-password");

      if (passwordInput.type === "password") {
        passwordInput.type = "text";
        passwordIcon.classList.remove("fa-eye");
        passwordIcon.classList.add("fa-eye-slash");
      } else {
        passwordInput.type = "password";
        passwordIcon.classList.remove("fa-eye-slash");
        passwordIcon.classList.add("fa-eye");
      }
    }
  </script>
</body>
</html>
