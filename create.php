<?php
// Include database connection
include('databaseconnection.php');

// Start session for registration status
session_start();

// Check if form is submitted
if (isset($_POST['email']) && isset($_POST['password']) && isset($_POST['confirm_password']) && isset($_POST['username'])) {
    $email = $_POST['email'];  // User input for email
    $password = $_POST['password'];  // User input for password
    $confirm_password = $_POST['confirm_password'];  // User input for confirm password
    $username = $_POST['username'];  // User input for username (to be stored as firstname)

    // Check if passwords match
    if ($password === $confirm_password) {
        // Hash the password for security
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Check if email is valid
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            // Check if user already exists
            $query = "SELECT * FROM users WHERE email = ?";
            if ($stmt = $conn->prepare($query)) {
                $stmt->bind_param("s", $email);
                $stmt->execute();
                $result = $stmt->get_result();
                
                if ($result->num_rows > 0) {
                    // User already exists
                    $error = "An account with this email already exists.";
                } else {
                    // Insert the new user into the database (store the username as firstname)
                    $insert_query = "INSERT INTO users (email, password, first_name, role) VALUES (?, ?, ?, 'user')";
                    if ($insert_stmt = $conn->prepare($insert_query)) {
                        $insert_stmt->bind_param("sss", $email, $hashed_password, $username); // Insert username as firstname
                        if ($insert_stmt->execute()) {
                            $_SESSION['username'] = $username;  // Use username as session username
                            $_SESSION['email'] = $email;
                            $_SESSION['user_id'] = $conn->insert_id;

                            // Show success modal and redirect
                            $success = true;  // Flag for success modal
                        } else {
                            // Show specific error message from the query
                            $error = "Error executing query: " . $insert_stmt->error;
                        }
                        $insert_stmt->close();
                    } else {
                        // Show error from preparing the query
                        $error = "Error preparing the query: " . $conn->error;
                    }
                }
                $stmt->close();
            }
        } else {
            $error = "Please enter a valid email address.";
        }
    } else {
        $error = "Passwords do not match. Please try again.";
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
  <title>Create Account - GZEL Online Apparel</title>
  <link rel="stylesheet" href="css/createaccount.css">
  <!-- Font Awesome for icons -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
  
  <style>
    /* Modal Styles */
    .modal {
        display: none;
        position: fixed;
        z-index: 1;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.4);
        padding-top: 60px;
    }
    .modal-content {
        background-color: #fff;
        margin: 5% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 80%;
        max-width: 500px;
    }
    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }
    .close:hover,
    .close:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }
  </style>
</head>
<body>
  <div class="create-account-container">
    <h2>Create Account</h2>
    <form action="create.php" method="POST">
      <div class="input-group">
        <label for="username">Username</label>
        <input type="text" id="username" name="username" required>
      </div>
      <div class="input-group">
        <label for="email">Email</label>
        <input type="text" id="email" name="email" required>
      </div>
      <div class="input-group password-container">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" required>
        <i id="toggle-password" class="fa fa-eye"></i>
      </div>
      <div class="input-group password-container">
        <label for="confirm_password">Confirm Password</label>
        <input type="password" id="confirm_password" name="confirm_password" required>
        
        <span id="password-message" style="color: green; display: none;">Passwords match!</span>
        <span id="password-error" style="color: red; display: none;">Passwords do not match!</span>
      </div>
      <button type="submit" class="btn">Create Account</button>
    </form>
    <?php if (isset($error)) { ?>
        <p style="color: red;"><?php echo $error; ?></p>
    <?php } ?>
    <p>Already have an account? <a href="login2.php">Login</a></p>
  </div>

  <!-- Success Modal -->
  <?php if (isset($success) && $success) { ?>
    <div id="successModal" class="modal" style="display: block;">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h3>Account Created Successfully!</h3>
            <p>Your account has been created. You will be redirected to the login page.</p>
        </div>
    </div>
  <?php } ?>

  <script>
    // Password visibility toggle
    const togglePassword = document.getElementById('toggle-password');
    const passwordField = document.getElementById('password');

    togglePassword.addEventListener('click', function () {
        // Toggle the type of password field
        const type = passwordField.type === 'password' ? 'text' : 'password';
        passwordField.type = type;
        
        // Toggle the eye icon
        this.classList.toggle('fa-eye-slash');
    });

    // Check if passwords match on input change
    const passwordField2 = document.getElementById('confirm_password');
    const passwordMessage = document.getElementById('password-message');
    const passwordError = document.getElementById('password-error');

    passwordField2.addEventListener('input', function () {
        const password1 = document.getElementById('password').value;
        const password2 = passwordField2.value;

        if (password1 === password2) {
            passwordMessage.style.display = 'inline';
            passwordError.style.display = 'none';
        } else {
            passwordMessage.style.display = 'none';
            passwordError.style.display = 'inline';
        }
    });

    // Modal handling
    const modal = document.getElementById("successModal");
    const closeModal = document.querySelector(".close");

    if (modal) {
        // Close the modal when the "X" is clicked
        closeModal.onclick = function() {
            modal.style.display = "none";
            // Redirect to login2.php
            window.location.href = 'login2.php';
        }

        // Automatically close and redirect after 3 seconds
        setTimeout(function() {
            modal.style.display = "none";
            window.location.href = 'login2.php';
        }, 3000);
    }
  </script>
</body>
</html>
