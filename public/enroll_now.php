<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start(); // Start the session to access session variables

// Check if the user is logged in
if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
    echo "<script>
        alert('Please log in first to enroll.');
        window.location.href = 'login.php'; // Redirect to login page
    </script>";
    exit; // Stop further execution
}

include 'db_config.php'; // Database configuration file

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $name = $_POST['username'] ?? '';
    $category = $_POST['dance-category'] ?? '';
    $form = $_POST['dance-form'] ?? '';
    $fees = $_POST['fees'] ?? '';
    $address = $_POST['address'] ?? '';
    $shift = $_POST['shift-time'] ?? '';
    $payment_method = $_POST['payment-method'] ?? '';

    // Validate the data
    if (empty($name) || empty($category) || empty($form) || empty($fees) || empty($address) || empty($shift) || empty($payment_method)) {
        die("All fields are required.");
    }

    // Prepare and bind the SQL statement
    $stmt = $conn->prepare("INSERT INTO enrollment (name, category, form, fees, address, shift_time, payment_method) VALUES (?, ?, ?, ?, ?, ?, ?)");
    if (!$stmt) {
        die("Preparation failed: " . $conn->error);
    }
    $stmt->bind_param("sssssss", $name, $category, $form, $fees, $address, $shift, $payment_method);

    // Execute the statement
    if ($stmt->execute()) {
        $transaction_id = $stmt->insert_id; // Get the transaction ID
        // Redirect to confirmation page with details
        header("Location: confirmation.php?transaction_id=$transaction_id&name=$name&category=$category&form=$form&fees=$fees&address=$address&shift=$shift&payment_method=$payment_method");
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
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
            overflow: hidden; /* Prevents the body from scrolling */
        }
        .banner {
            background: linear-gradient(rgba(255, 255, 255, 0.1), rgba(255, 255, 255, 0.1)), url("bhuumika/your-banner-image.jpg") no-repeat center center;
            background-size: cover;
            position: absolute;
            width: 100%;
            height: 100%;
            z-index: -1; /* Ensure the banner is behind everything */
        }
        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5); /* Semi-transparent overlay */
            z-index: 0; /* Overlay behind the content but in front of the banner */
        }
        header {
            background-color: #123C69; /* Dark blue color */
            color: white;
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 2; /* Ensure header is above the overlay */
            padding: 10px 0;
        }
        footer {
            background-color: #123C69; /* Dark blue color */
            color: white;
            text-align: center;
            padding: 10px 0;
            position: fixed;
            width: 100%;
            bottom: 0;
            z-index: 2; /* Ensure footer is above the overlay */
        }
        .content {
            position: absolute;
            top: 100px; /* Increased top margin to make space for the header */
            bottom: 70px; /* Increased bottom margin to make space for the footer */
            left: 0;
            right: 0;
            overflow-y: auto; /* Enable scrolling within the content area */
            padding: 20px;
        }
        .register-container {
            max-width: 400px;
            width: 100%;
            padding: 20px;
            background: #ffffff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin: auto; /* Center the form horizontally */
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

    <div class="banner"></div>
    <div class="overlay"></div>
    <div class="content">
        <div class="register-container">
            <h2>Enroll With Us</h2>
            <form id="enroll-form" action="enroll_now.php" method="post">
                <div class="form-group">
                    <label for="username">Student Name</label>
                    <input type="text" class="form-control" id="username" name="username" required placeholder="Enter Name">
                </div>
                <div class="form-group">
                    <label for="dance-category">Dance Category</label>
                    <select class="form-control" id="dance-category" name="dance-category" required>
                        <option value="" disabled selected>Select your Category</option>
                        <option value="indian_classical">Indian Classical</option>
                        <option value="afro_american">Afro American</option>
                        <option value="latin">Latin</option>
                        <option value="street_dance">Street Dance</option>
                        <option value="zumba">Zumba</option>
                        <option value="ballet">Ballet</option>
                        <option value="fitness">Fitness Dance</option>
                        <option value="fusion">Fusion</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="dance-form">Dance Form</label>
                    <select class="form-control" id="dance-form" name="dance-form" required>
                        <!-- Options will be populated dynamically with JavaScript -->
                    </select>
                </div>
                <div class="form-group">
    <label for="fees">Fees</label>
    <input type="text" class="form-control" id="fees" name="fees" value="1000" readonly>
</div>

                <div class="form-group">
                    <label for="address">Address</label>
                    <textarea class="form-control" id="address" name="address" rows="3" required placeholder="Enter Address"></textarea>
                </div>
                <div class="form-group">
                    <label for="shift-time">Preferred Time Slot</label>
                    <select class="form-control" id="shift-time" name="shift-time" required>
                        <option value="morning">Morning</option>
                        <option value="afternoon">Afternoon</option>
                        <option value="evening">Evening</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="payment-method">Payment Method</label>
                    <select class="form-control" id="payment-method" name="payment-method" required>
                        <option value="credit_card">Credit Card</option>
                        <option value="paypal">PayPal</option>
                        <option value="bank_transfer">Bank Transfer</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Enroll Now</button>
            </form>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 Dance Academy. All Rights Reserved.</p>
    </footer>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const categorySelect = document.getElementById('dance-category');
            const formSelect = document.getElementById('dance-form');

            const danceForms = {
                indian_classical: ['Bharatnatyam', 'Kathak', 'Kathakali', 'Kuchipudi'],
                afro_american: ['Hip Hop', 'Jazz', 'Tap Dance', 'Break Dance'],
                latin: ['Rumba', 'Salsa', 'Cha-Cha'],
                street_dance: ['Break Dance', 'Locking', 'Popping'],
                zumba: ['Zumba Kids', 'Zumba Toning', 'Zumba Step'],
                ballet: ['Classical Ballet', 'Neo-Classical Ballet', 'Romantic Ballet'],
                fitness: ['Dance Cardio', 'Dance HIIT', 'Barre Dance'],
                fusion: ['Bollywood', 'Ballet-Jazz Fusion', 'Hip Hop-Contemporary Fusion']
            };

            categorySelect.addEventListener('change', function() {
                const selectedCategory = this.value;
                formSelect.innerHTML = '<option value="" disabled selected>Select your Dance Form</option>'; // Clear previous options

                if (danceForms[selectedCategory]) {
                    danceForms[selectedCategory].forEach(function(form) {
                        const option = document.createElement('option');
                        option.value = form.toLowerCase().replace(/\s+/g, '_'); // Convert to lower case and replace spaces with underscores
                        option.textContent = form;
                        formSelect.appendChild(option);
                    });
                }
            });
        });
    </script>
</body>
</html>
