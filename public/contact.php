<?php
// Initialize variables
$success_message = '';
$error_message = '';


// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data safely
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $request = htmlspecialchars($_POST['request']);

    // Basic validation
    if (!empty($name) && !empty($email) && !empty($request)) {
        // Here you can add additional code like sending an email or saving to the database
        // For example: mail('admin@yourwebsite.com', 'Contact Form Submission', $request, 'From: ' . $email);

        // Success response
        $success_message = "Thank you, $name! Your request has been submitted. We'll contact you at $email shortly.";
    } else {
        // Error response
        $error_message = "Please fill in all fields correctly.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Amazing Dance Academy</title>
    <!-- Bootstrap CSS link -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        /* Original CSS Styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #EDC7B7;
            margin: 0;
        }

        .navbar {
            padding: 20px;
            background-color: #123C69;
        }

        .navbar-brand, .nav-link {
            color: #fff !important;
            margin-left: 15px;
        }

        .container-title {
            text-align: center;
            margin: 50px 0;
        }

        .banner-container {
            width: 100%; /* Full width */
            height: auto; /* Set the height to 30% of the viewport height */
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f8f9fa; /* Light background color in case there's empty space */
        }

        .banner {
            width: 100%; /* Make the image take up the full width */
            height: auto; /* Adjust the height to maintain aspect ratio */
            object-fit: cover; /* Ensure the image is fully visible without cropping */
        }

        .form-container {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 600px;
            margin: 0 auto 50px auto;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="email"],
        textarea {
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
            width: 100%;
        }

        textarea {
            resize: vertical;
            height: 120px;
        }

        .contact-info, .hours, .newsletter, .social-media, .faq {
            max-width: 800px;
            margin: 0 auto 50px auto;
            padding: 0 20px;
        }

        .contact-info, .hours {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }

        .contact-info p, .hours p {
            margin: 5px 0;
            font-size: 1.1em;
        }

        .contact-info strong, .hours strong {
            color: #123C69;
        }

        .contact-info {
            display: flex;
            justify-content: space-between;
            align-items: center;
            text-align: left;
        }

        .contact-info div {
            flex: 1;
            margin-right: 20px;
        }

        .hours {
            text-align: left;
        }

        .social-media {
            text-align: center;
        }

        .social-media a {
            margin: 0 10px;
            color: #123C69;
            font-size: 24px;
            transition: color 0.3s ease;
        }

        .social-media a:hover {
            color: #EDC7B7;
        }

        .footer {
            background-color: #123C69;
            color: white;
            text-align: center;
            padding: 15px 0;
        }

        .logo {
            height: 70px;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light">
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
                <li class="nav-item"><a class="nav-link" href="schedule.html">Schedule</a></li>
                <li class="nav-item"><a class="nav-link" href="register.php">Register</a></li>
                <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
            </ul>
        </div>
    </nav>

    <!-- Banner Image Container -->
    <div class="banner-container">
        <img src="bhuumika/contact.jpg" alt="Banner Image" class="banner">
    </div>

    <!-- Service Title -->
    <div class="container-title">
        <h2>CONTACT US TODAY</h2>
    </div>

    <!-- Contact Form -->
    <div class="form-container">
        <form action="contact.php" method="post">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" placeholder="Enter your name" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" placeholder="Enter your email" required>

            <label for="request">Request:</label>
            <textarea id="request" name="request" placeholder="Enter your request" required></textarea>

            <button type="submit" class="btn btn-primary btn-block">Submit</button>
        </form>
    </div>

    <!-- Contact Info -->
    <div class="contact-info">
        <div>
            <p><strong>Phone:</strong> +123-456-7890</p>
            <p><strong>Email:</strong> info@letsnacchoacademy.com</p>
            <p><strong>Address:</strong> 123 Dance Street, Dance City, DC 12345</p>
        </div>
    </div>

    <!-- Operating Hours -->
    <div class="hours">
        <p><strong>Operating Hours:</strong></p>
        <p>Monday - Friday: 9:00 AM - 8:00 PM</p>
        <p>Saturday: 10:00 AM - 5:00 PM</p>
        <p>Sunday: Closed</p>
    </div>

    <!-- Social Media -->
    <div class="social-media">
        <a href="https://facebook.com" target="_blank"><i class="fab fa-facebook-f"></i></a>
        <a href="https://twitter.com" target="_blank"><i class="fab fa-twitter"></i></a>
        <a href="https://instagram.com" target="_blank"><i class="fab fa-instagram"></i></a>
        <a href="https://linkedin.com" target="_blank"><i class="fab fa-linkedin-in"></i></a>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <p>&copy; 2024 Amazing Dance Academy. All Rights Reserved.</p>
    </footer>

    <!-- JavaScript -->
    <script>
        // Display alerts based on PHP messages
        <?php if ($success_message): ?>
            alert("<?php echo addslashes($success_message); ?>");
        <?php elseif ($error_message): ?>
            alert("<?php echo addslashes($error_message); ?>");
        <?php endif; ?>
    </script>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
