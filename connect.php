<?php
$name = $_POST['name'];
$phone = $_POST['phone'];
$email = $_POST['email'];

// Database connection
$conn = new mysqli('localhost', 'root', '', 'luxadesign');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO session (name, phone, email) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $phone, $email);
    
    // Execute the statement
    $stmt->execute();
    echo "Session Booked Successfully ...";
    
    // Close statement and connection
    $stmt->close();
    $conn->close();
}
?>
