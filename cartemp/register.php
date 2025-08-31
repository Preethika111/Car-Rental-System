<?php
session_start();

// DEBUGGING: Show errors on screen
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// DB connection
$servername = "localhost";
$username = "root";         // Change if needed
$password = "";             // Change if you have a MySQL password
$dbname = "car_rental";     // Your DB name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check DB connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $user_type = $_POST['user_type'];

    if ($user_type === 'individual') {
        $name = trim($_POST['name']);
        $phone = trim($_POST['phone']);
        $dob = $_POST['dob'];
        $address = trim($_POST['address']);
        $license_no = trim($_POST['license_no']);
        $license_expiry = trim($_POST['license_expiry']);
        $email = trim($_POST['email']);
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Secure password storage

        $stmt = $conn->prepare("INSERT INTO individuals (name, phone, dob, address, license_no, license_expiry, email, password) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

        if (!$stmt) {
            die("SQL Prepare failed: " . $conn->error);
        }

        $stmt->bind_param("ssssssss", $name, $phone, $dob, $address, $license_no, $license_expiry, $email, $password);

        if ($stmt->execute()) {
            $_SESSION['user_id'] = $conn->insert_id; // Store the newly created user ID
            header("Location: individual_home.html"); // ✅ Redirect to individual_home.html
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Invalid user type.";
    }
} else {
    echo "Invalid request.";
}

$conn->close();
?>
