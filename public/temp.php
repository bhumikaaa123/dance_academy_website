<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dance_academy";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve user's enrollment history
$sql = "SELECT * FROM enrollments WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .dashboard-container {
            margin: 20px;
        }
        .enrollment-table th, .enrollment-table td {
            padding: 10px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container dashboard-container">
        <h2>Your Enrollment History</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Dance Category</th>
                    <th>Dance Form</th>
                    <th>Fees</th>
                    <th>Address</th>
                    <th>Shift Time</th>
                    <th>Payment Method</th>
                    <th>Payment Status</th>
                    <th>Enrollment Status</th>
                    <th>Enrollment Date</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['dance_category']); ?></td>
                        <td><?php echo htmlspecialchars($row['dance_form']); ?></td>
                        <td><?php echo htmlspecialchars($row['fees']); ?></td>
                        <td><?php echo htmlspecialchars($row['address']); ?></td>
                        <td><?php echo htmlspecialchars($row['shift_time']); ?></td>
                        <td><?php echo htmlspecialchars($row['payment_method']); ?></td>
                        <td><?php echo htmlspecialchars($row['payment_status']); ?></td>
                        <td><?php echo htmlspecialchars($row['enrollment_status']); ?></td>
                        <td><?php echo htmlspecialchars($row['enrollment_date']); ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>

<?php
$stmt->close();
$conn->close();
?>
