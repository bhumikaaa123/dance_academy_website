<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enrollment Confirmation</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body, html {
            height: 100%;
            margin: 0;
            font-family: Arial, sans-serif;
            overflow-y: auto; /* Ensure the page is scrollable */
        }

        .content {
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: calc(100vh - 100px); /* Ensure content takes full space minus header and footer */
            z-index: 1;
            padding-top: 100px; /* Padding to prevent overlap with header */
            padding-bottom: 60px; /* Add padding at the bottom for the footer */
        }

        .confirmation-container {
            max-width: 600px;
            width: 100%;
            background: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
            text-align: center;
            opacity: 0.95;
            margin-top: 60px;
        }

        h2 {
            font-size: 28px;
            font-weight: bold;
            color: #123C69;
            margin-bottom: 20px;
        }

        ul {
            list-style: none;
            padding: 0;
            text-align: left;
            margin-bottom: 20px;
        }

        ul li {
            font-size: 16px;
            padding: 5px 0;
            color: #555;
        }

        .btn-primary {
            background-color: #123C69;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 5px;
            font-weight: bold;
        }

        .btn-primary:hover {
            background-color: #0a2e4d;
        }

        header {
            background-color: #123C69;
            color: white;
            padding: 10px 0;
            width: 100%;
            z-index: 2;
            position: fixed;
            top: 0;
        }

        footer {
            background-color: #123C69;
            color: white;
            padding: 10px 0;
            text-align: center;
            width: 100%;
            position: relative; /* Ensure footer is in the normal document flow */
            margin-top: 20px;
        }

        .navbar-brand, .nav-link {
            color: #fff !important;
        }

        .logo {
            height: 70px;
        }

        p {
            color: #123C69;
        }
        footer p {
            color: white; /* Specific text color for footer */
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

      

    <!-- Main Confirmation Content -->
    <div class="content">
        <div class="confirmation-container">
            <h2>Enrollment Confirmation</h2>
            <p>Congratulations! You are now a part of Let's Naccho Family.</p>
            <p>Transaction ID: <?php echo htmlspecialchars($_GET['transaction_id']); ?></p>
            <p>Details of your enrollment:</p>
            <ul>
                <li><strong>Name:</strong> <?php echo htmlspecialchars($_GET['name']); ?></li>
                <li><strong>Category:</strong> <?php echo htmlspecialchars($_GET['category']); ?></li>
                <li><strong>Form:</strong> <?php echo htmlspecialchars($_GET['form']); ?></li>
                <li><strong>Fees:</strong> <?php echo htmlspecialchars($_GET['fees']); ?></li>
                <li><strong>Address:</strong> <?php echo htmlspecialchars($_GET['address']); ?></li>
                <li><strong>Time Slot:</strong> <?php echo htmlspecialchars($_GET['shift']); ?></li>
                <li><strong>Payment Method:</strong> <?php echo htmlspecialchars($_GET['payment_method']); ?></li>
            </ul>
            <p>If you have any questions, please contact our support team.</p>
            <a href="index.html" class="btn btn-primary">Go to Homepage</a>
            <a href="user dashboard.php" class="btn btn-primary">Go to Dashboard</a>
        </div>
    </div>

  

    <!-- Bootstrap Scripts -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 Dance Academy. All rights reserved.</p>
    </footer>
</body>
</html>
