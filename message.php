<?php
// Database configuration
$servername = "localhost"; // XAMPP default server
$username = "root";        // XAMPP default username
$password = "";            // XAMPP default password is empty
$database = "luxadesign";  // Replace with your database name

// Create a connection
$conn = new mysqli($servername, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve form data
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$message = $_POST['message'];

// Validate and sanitize input
$name = $conn->real_escape_string(trim($name));
$email = $conn->real_escape_string(trim($email));
$phone = $conn->real_escape_string(trim($phone));
$message = $conn->real_escape_string(trim($message));

// Optional: Additional validation (e.g., check email format)
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die("Invalid email format.");
}

// Prepare and bind statement
$stmt = $conn->prepare("INSERT INTO messages (name, email, phone, message) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $name, $email, $phone, $message);

// Execute the statement
if ($stmt->execute()) {
    echo "Message sent successfully.";
} else {
    echo "Error: " . $stmt->error;
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>
