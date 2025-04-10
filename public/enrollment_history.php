<?php
session_start();
include('db_config.php');

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch enrollment history
$query = "SELECT * FROM enrollment_history WHERE user_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $user_id);
$stmt->execute();
$result = $stmt->get_result();

// Fetch data
$enrollments = [];
while ($row = $result->fetch_assoc()) {
    $enrollments[] = $row;
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enrollment History - Amazing Dance Academy</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #EDC7B7;
            margin: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        .navbar {
            padding: 20px;
            background-color: #123C69; /* Dark Blue color */
        }
        .navbar-brand, .nav-link {
            color: #fff !important;
        }
        .logo {
            height: 70px;
        }
        .container-title {
            text-align: center;
            margin: 80px 0 40px;
        }
        .history-table {
            margin: 0 auto;
            width: 90%;
            max-width: 1200px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            padding: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table th, table td {
            text-align: left;
            padding: 12px;
            border-bottom: 1px solid #dee2e6;
        }
        table th {
            background-color: #123C69;
            color: #fff;
        }
        table td {
            background-color: #f9f9f9;
            color: #495057;
        }
        table tr:nth-child(odd) td {
            background-color: #f1f1f1;
        }
        table tr:hover td {
            background-color: #e9ecef;
        }
        .footer {
            background-color: #123C69;
            color: white;
            text-align: center;
            padding: 15px 0;
            margin-top: auto;
        }
        .btn-back {
            display: block;
            margin: 20px auto;
            width: 200px;
            text-align: center;
            background-color: #123C69;
            color: #fff;
            padding: 10px;
            border-radius: 5px;
            text-decoration: none;
        }
        .btn-back:hover {
            background-color: #0d2d50;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light">
        <a class="navbar-brand" href="index.html">
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
                <li class="nav-item"><a class="nav-link" href="schedule.html">Schedule</a></li>
            </ul>
        </div>
    </nav>

    <!-- Enrollment History Title -->
    <div class="container-title">
        <h2>Enrollment History</h2>
    </div>

    <!-- Enrollment History Table -->
    <div class="container">
        <div class="history-table">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Dance Category</th>
                        <th>Dance Form</th>
                        <th>Enrollment Date</th>
                        <th>Payment Status</th>
                        <th>Payment Amount</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($enrollments)): ?>
                        <?php foreach ($enrollments as $enrollment): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($enrollment['id']); ?></td>
                                <td><?php echo htmlspecialchars($enrollment['dance_category']); ?></td>
                                <td><?php echo htmlspecialchars($enrollment['dance_form']); ?></td>
                                <td><?php echo htmlspecialchars($enrollment['enrollment_date']); ?></td>
                                <td><?php echo htmlspecialchars($enrollment['payment_status']); ?></td>
                                <td><?php echo htmlspecialchars($enrollment['payment_amount']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center">No enrollment history found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Back Button -->
    <a class="btn-back" href="index.html">Back to Home</a>

    <!-- Footer -->
    <footer class="footer">
        <p>&copy; 2024 Dance Academy. All rights reserved.</p>
    </footer>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
