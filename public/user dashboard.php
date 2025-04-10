<?php
// Start session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php"); // Redirect to login page if not logged in
    exit();
}

// Include the database connection file
include('db_config.php');

// Fetch user data from the database based on the session's username
$username = $_SESSION['username'];
$query = "SELECT * FROM users WHERE username = '$username'";
$result = mysqli_query($conn, $query);

// Fetch user data
$user = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instructor Dashboard - Amazing Dance Academy</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #EDC7B7;
        }
        .navbar {
            padding: 20px;
            background-color: #123C69;
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
        }
        .navbar-brand, .nav-link {
            color: #fff !important;
            margin-left: 15px;
        }
        .navbar-nav .nav-item {
            margin-right: 15px;
        }
        body {
            padding-top: 90px;
        }
        h1 {
            margin-top: 50px;
            text-align: center;
            color: #123C69;
        }
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        main {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #EDC7B7;
        }
        .user-info {
            background-color: #ffffff;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            max-width: 800px;
            width: 100%;
            margin: 20px;
            transition: transform 0.3s ease-in-out;
            margin-bottom: 100px;
        }
        .user-info:hover {
            transform: translateY(-5px);
        }
        .user-info h2 {
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 30px;
            text-align: center;
            color: #2c3e50;
            border-bottom: 2px solid #ecf0f1;
            padding-bottom: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 60px;
        }
        table th, table td {
            text-align: left;
            padding: 18px;
            border-bottom: 2px solid #ecf0f1;
            font-size: 18px;
        }
        table th {
            background-color: #2980b9;
            color: #fff;
            font-weight: bold;
            letter-spacing: 0.5px;
            width: 30%;
            border-right: 2px solid #ecf0f1;
        }
        table td {
            background-color: #f8f9fa;
            color: #34495e;
        }
        table tr:hover td {
            background-color: #e9ecef;
        }
        table tr:nth-child(odd) td {
            background-color: #f1f1f1;
        }
        @media (max-width: 768px) {
            .user-info {
                padding: 25px;
            }
            table th, table td {
                font-size: 16px;
                padding: 12px;
            }
            table th {
                width: 40%;
            }
        }
        .btn-group {
    display: flex;
    justify-content: center;
    margin-top: 20px;
}
.btn {
    padding: 10px 20px;
    background-color: #123C69;
    color: white;
    border: none;
    border-radius: 5px;
    text-decoration: none;
    text-align: center;
    margin: 0 10px;
    transition: background-color 0.3s ease;
    cursor: pointer;
}
.btn:hover, .btn:focus {
    background-color: #123C69; /* Ensure no color change on hover/focus */
    outline: none; /* Remove focus outline */
}

        .footer {
            background-color: #123C69;
            color: white;
            text-align: center;
            padding: 25px 0;
            width: 100%;
            position: relative;
            margin-top: 40px;
        }
        .footer p {
            margin: 0;
            font-size: 1em;
        }
        .logo {
            height: 70px;
        }
        .logout-btn {
            background-color: transparent;
            color: white;
            border: none;
            padding: 8px 15px;
            cursor: pointer;
            text-decoration: none;
            margin-left: 15px;
        }
        .logout-btn:hover {
            color: #ddd;
        }
    </style>
</head>
<body>
    <header>
        <h1>Welcome, <?php echo htmlspecialchars($user['name']); ?>!</h1>
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-light">
            <a class="navbar-brand" href="#">
                <img class="logo" src="bhuumika/Logo.png" alt="Dance Academy Logo">
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
                    <li class="nav-item"><a class="nav-link" href="schedule.html">Schedule</a></li>
                    <li class="nav-item">
                        <form method="post" action="index.html" onsubmit="return confirmLogout();" style="display: inline;">
                            <button type="submit" class="nav-link logout-btn">Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <main>
        <section class="user-info">
            <h2>Your Profile Details</h2>
            <table>
                <tr>
                    <th>Name:</th>
                    <td><?php echo htmlspecialchars($user['name']); ?></td>
                </tr>
                <tr>
                    <th>Username:</th>
                    <td><?php echo htmlspecialchars($user['username']); ?></td>
                </tr>
                <tr>
                    <th>Email:</th>
                    <td><?php echo htmlspecialchars($user['email']); ?></td>
                </tr>
                <tr>
                    <th>Phone:</th>
                    <td><?php echo htmlspecialchars($user['phone']); ?></td>
                </tr>
            </table>
            <!-- Buttons -->
            <div class="btn-group">
                
                <a href="enroll_now.php" class="btn">Enroll Now</a>
                
            </div>
        </section>
    </main>

    <script>
        function confirmLogout() {
            return confirm("Are you sure you want to log out?");
        }
    </script>

    <!-- Footer -->
    <footer class="footer">
        <p>&copy; 2024 Amazing Dance Academy</p>
    </footer>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
