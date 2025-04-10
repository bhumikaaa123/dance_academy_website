<?php
session_start(); // Start the session

// Check if the user is logged in
$is_logged_in = isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] === true;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Page Title</title>
    <!-- Include your CSS files here -->
    <link rel="stylesheet" href="styles.css"> <!-- Example CSS file -->
</head>
<body>

<!-- JavaScript to check login status -->
<script>
document.addEventListener('DOMContentLoaded', () => {
    // Check if the user is logged in
    const isLoggedIn = <?php echo json_encode($is_logged_in); ?>;
    console.log('User logged in status:', isLoggedIn); // Debugging line

    document.querySelectorAll('.enroll-btn').forEach(button => {
        button.addEventListener('click', (event) => {
            console.log('Enroll button clicked');
            if (!isLoggedIn) {
                alert('Please log in first before enrolling.');
                // Prevent the default action
                event.preventDefault();
                // Redirect to the login page
                window.location.href = 'login.php'; // Adjust this path if needed
            } else {
                // Enrollment logic here if logged in
                console.log('User is logged in, proceeding with enrollment.');
            }
        });
    });
});
</script>
