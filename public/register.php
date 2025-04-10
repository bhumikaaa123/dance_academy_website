<?php
// Include the database connection file (update with your connection settings)
include 'db_config.php';

// Initialize variables to store error messages and success flag
$name = $username = $email = $phone = $password = "";
$nameErr = $usernameErr = $emailErr = $phoneErr = $passwordErr = "";
$success = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get input values and sanitize them
    $name = trim($_POST["name"]);
    $username = trim($_POST["username"]);
    $email = trim($_POST["email"]);
    $phone = trim($_POST["phone"]);
    $password = trim($_POST["password"]);
    $confirmPassword = trim($_POST["confirmPassword"]);

    // Server-side validation
    if (empty($name)) {
        $nameErr = "Name is required";
    }
    
    if (empty($username)) {
        $usernameErr = "Username is required";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Invalid email format";
    }

    if (!preg_match("/^[0-9]{10}$/", $phone)) {
        $phoneErr = "Please enter a valid 10-digit phone number";
    }

    if ($password !== $confirmPassword) {
        $passwordErr = "Passwords do not match";
    }

    if (empty($passwordErr) && empty($nameErr) && empty($usernameErr) && empty($emailErr) && empty($phoneErr)) {
        // Hash the password using bcrypt (PASSWORD_DEFAULT uses bcrypt)
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Prepare and execute the SQL query to insert user data into the database
        $sql = "INSERT INTO users (name, username, email, phone, password) VALUES (?, ?, ?, ?, ?)";

        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("sssss", $name, $username, $email, $phone, $hashedPassword);

            if ($stmt->execute()) {
                // Redirect with success query parameter
                header("Location: register.php?register=success");
                exit();
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }

            $stmt->close();
        }
    }
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Dance Academy</title>
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
            height: 120%;
            z-index: -1;
        }

        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 122%;
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

        .register-container {
            max-width: 400px;
            width: 100%;
            padding: 20px;
            background: #ffffff;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
            opacity: 0.9;
            margin-top: 140px;
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

        header {
            background-color: #123C69;
            color: white;
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 2;
            padding: 10px 0;
        }

        footer {
            background-color: #123C69;
            color: white;
            text-align: center;
            padding: 10px 0;
            position: fixed;
            width: 100%;
            bottom: 0;
            z-index: 2;
        }

        .navbar-brand, .nav-link {
            color: #fff !important;
        }

        .navbar-nav .nav-link {
            color: #fff !important;
            margin-left: 15px;
        }

        .logo {
            height: 60px;
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
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item"><a class="nav-link" href="index.html">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="about.html">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="service.html">Our Services</a></li>
                    <li class="nav-item"><a class="nav-link" href="instructorsss.html">Our Instructors</a></li>
                    <li class="nav-item"><a class="nav-link" href="contact.php">Contact Us</a></li>
                    <li class="nav-item"><a class="nav-link" href="schedule.html">Schedule </a></li>
                </ul>
            </div>
        </nav>
    </header>
    <!-- Banner -->
    <div class="banner"></div>
    <div class="overlay"></div>
    <!-- Content -->
    <div class="content">
        <div class="register-container">
            <h2>Register</h2>
            <form action="register.php" method="post">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($name); ?>">
                    <span class="error"><?php echo $nameErr; ?></span>
                </div>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($username); ?>">
                    <span class="error"><?php echo $usernameErr; ?></span>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>">
                    <span class="error"><?php echo $emailErr; ?></span>
                </div>
                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="text" id="phone" name="phone" value="<?php echo htmlspecialchars($phone); ?>">
                    <span class="error"><?php echo $phoneErr; ?></span>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password">
                    <span class="error"><?php echo $passwordErr; ?></span>
                </div>
                <div class="form-group">
                    <label for="confirmPassword">Confirm Password</label>
                    <input type="password" id="confirmPassword" name="confirmPassword">
                    <span class="error"><?php echo $passwordErr; ?></span>
                </div>
                <button type="submit" class="btn btn-primary">Register</button>
            </form>
            <div class="switch-page">
                <p>Already have an account? <a href="login.php">Login</a></p>
            </div>
        </div>
    </div>
    <!-- Footer -->
    <footer>
        <p>&copy; 2024 Dance Academy. All rights reserved.</p>
    </footer>
    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script>
        // Check if the URL contains the 'register=success' parameter
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.has('register') && urlParams.get('register') === 'success') {
            alert('Registration successful');
            // Redirect to login page after alert
            setTimeout(function() {
                window.location.href = 'login.php';
            }, 1000); // Delay to allow user to see the alert
        }
    </script>
</body>
</html>
