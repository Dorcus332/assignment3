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

// Function to validate mobile number
function validateMobileNumber($mobile)
{
    // Regular expression to validate mobile number (10 digits)
    $pattern = "/^\d{10}$/";
    return preg_match($pattern, $mobile);
}

// Function to validate email address
function validateEmailAddress($email)
{
    // Regular expression to validate email address
    $pattern = "/^\S+@\S+\.\S+$/";
    return preg_match($pattern, $email);
}

// Function to validate registration number
function validateRegistrationNumber($regNumber)
{
    // Regular expression to validate registration number (e.g., alphanumeric)
    $pattern = "/^[a-zA-Z0-9]+$/";
    return preg_match($pattern, $regNumber);
}

// Retrieve input data from the form
$mobileNumber = $_POST['mobile_number'];
$emailAddress = $_POST['email_address'];
$registrationNumber = $_POST['registration_number'];

// Validate input data
if (!validateMobileNumber($mobileNumber)) {
    echo "Invalid mobile number. Please enter a 10-digit mobile number.";
} elseif (!validateEmailAddress($emailAddress)) {
    echo "Invalid email address. Please enter a valid email address.";
} elseif (!validateRegistrationNumber($registrationNumber)) {
    echo "Invalid registration number. Please enter a valid registration number.";
} else {
    // Insert validated contact details into the database
    $sql = "INSERT INTO contacts (mobile_number, email_address, registration_number) VALUES ('$mobileNumber', '$emailAddress', '$registrationNumber')";

    if ($conn->query($sql) === TRUE) {
        echo "Contact details inserted successfully.";
    } else {
        echo "Error inserting contact details: " . $conn->error;
    }
}

// Close database connection
$conn->close();
