<?php
// Start session
session_start();

// Include your database connection file
include 'db_config.php';

// Initialize error message
$error_message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form inputs and sanitize to prevent SQL injection
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if (empty($username) || empty($password)) {
        $error_message = 'Please fill in both fields.';
    } else {
        // Prepare SQL statement
        $stmt = $conn->prepare("SELECT id, password FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        // Verify password
        if ($user && password_verify($password, $user['password'])) {
            // Successful login - set session variables
            $_SESSION['logged_in'] = true;
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $username;

            // Redirect to user dashboard or home page after successful login
            header('Location: user dashboard.php');
            exit();
        } else {
            // Failed login
            $error_message = 'Invalid username or password.';
        }

        // Close statement
        $stmt->close();
    }
}

// Close the database connection
$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Dance Academy</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body, html {
            height: 100%;
            margin: 0;
            font-family: Arial, sans-serif;
        }

        .banner {
            background: linear-gradient(rgba(255, 255, 255, 0.1), rgba(255, 255, 255, 0.1)), url("bhuumika/your-banner-image.jpg") no-repeat center center;
            background-size: cover;
            position: absolute;
            width: 100%;
            height: 100%;
            z-index: -1;
        }

        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 0;
        }

        .content {
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            z-index: 1;
            margin-top: 60px;
            margin-bottom: 60px;
        }

        .login-container {
            max-width: 400px;
            width: 100%;
            padding: 20px;
            background: #ffffff;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
            margin-bottom: 120px;
            opacity: 0.9;
        }

        h2 {
            margin-bottom: 20px;
            font-size: 24px;
            font-weight: bold;
            color: #123C69;
            text-align: center;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            font-weight: bold;
            color: #123C69;
            display: block;
            margin-bottom: 5px;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }

        .form-group input:focus {
            border-color: #123C69;
            outline: none;
            box-shadow: 0 0 5px rgba(18, 60, 105, 0.3);
        }

        .btn-primary {
            background-color: #123C69;
            border: none;
            padding: 10px;
            border-radius: 5px;
            font-size: 16px;
            font-weight: bold;
        }

        .btn-primary:hover {
            background-color: #0a2e4d;
        }

        .switch-page {
            text-align: center;
            margin-top: 15px;
        }

        .switch-page a {
            color: #123C69;
            text-decoration: none;
        }

        .switch-page a:hover {
            text-decoration: underline;
        }

        header, footer {
            background-color: #123C69;
            color: white;
            padding: 10px 0;
            position: fixed;
            width: 100%;
            z-index: 2;
        }

        header {
            top: 0;
        }

        footer {
            bottom: 0;
            text-align: center;
        }

        .navbar-brand, .nav-link {
            color: #fff !important;
        }

        .logo {
            height: 70px;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark">
            <a class="navbar-brand" href="#">
                <img class="logo" src="bhuumika/Logo.png" alt="Dance Academy Logo">
                <span> Dance Academy</span>
            </a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item"><a class="nav-link" href="index.html">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="about.html">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="service.html">Our Services</a></li>
                    <li class="nav-item"><a class="nav-link" href="instructorsss.html">Our Instructors</a></li>
                    <li class="nav-item"><a class="nav-link" href="contact.php">Contact Us</a></li>
                    <li class="nav-item"><a class="nav-link" href="schedule.html">Schedule</a></li>
                </ul>
            </div>
        </nav>
    </header>

    <!-- Banner & Overlay -->
    <div class="banner"></div>
    <div class="overlay"></div>

    <!-- Login Form -->
    <div class="content">
        <div class="login-container">
            <h2>Login</h2>

            <!-- Display error message if login failed -->
            <?php if (!empty($error_message)): ?>
                <p style="color:red;"><?php echo htmlspecialchars($error_message); ?></p>
            <?php endif; ?>

            <form id="login-form" action="login.php" method="POST">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Login</button>
            </form>

            <p class="switch-page">Don't have an account? <a href="register.php">Register here</a></p>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 Dance Academy. All rights reserved.</p>
    </footer>

    <!-- Bootstrap Scripts -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
