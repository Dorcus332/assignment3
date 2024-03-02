<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "website";

// Establish database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve user's email address from the form
$email = $_POST['email'];

// Generate a unique token
$token = bin2hex(random_bytes(16)); // Generate a 32-character hexadecimal token

// Store the token and user's email address in the database
$sql = "INSERT INTO password_reset_tokens (email, token) VALUES ('$email', '$token')";

if ($conn->query($sql) === TRUE) {
    // Construct the reset password link with the token embedded
    $reset_password_link = "http://localhost:8888/login.php?reset_password.php?token=$token";


    // Email content
    $subject = "Reset Password";
    $message = "To reset your password, click the following link: $reset_password_link";

    // Send the reset password email
    if (mail($email, $subject, $message)) {
        echo "An email with instructions to reset your password has been sent to $email";
    } else {
        echo "Failed to send reset password email. Please try again later.";
    }
} else {
    echo "Error storing token in the database: " . $conn->error;
}

// Close database connection
$conn->close();
