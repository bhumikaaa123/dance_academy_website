<?php
// Include the database configuration file
include('db_config.php');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $user_id = $_POST['user_id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $bio = $_POST['bio'];

    // Validate the data (you can add more validation as needed)
    if (!empty($name) && !empty($email)) {
        // Prepare an update statement
        $sql = "UPDATE users SET name = ?, email = ?, bio = ? WHERE user_id = ?";
        
        if ($stmt = $conn->prepare($sql)) {
            // Bind parameters
            $stmt->bind_param("sssi", $name, $email, $bio, $user_id);

            // Execute the statement
            if ($stmt->execute()) {
                echo "Profile updated successfully.";
            } else {
                echo "Error: " . $stmt->error;
            }

            // Close the statement
            $stmt->close();
        } else {
            echo "Error preparing statement: " . $conn->error;
        }
    } else {
        echo "Please fill in all required fields.";
    }

    // Close the connection
    $conn->close();
}
?>
