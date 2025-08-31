<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "car_rental";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

if (!isset($_SESSION['user_id'])) {
    header("Location: individual_login.html");
    exit();
}

$user_id = $_SESSION['user_id'];

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $dob = $_POST['dob'];
    $address = $_POST['address'];
    $license_no = $_POST['license_no'];
    $license_expiry = $_POST['license_expiry'];

    $stmt = $conn->prepare("UPDATE individuals SET name=?, phone=?, dob=?, address=?, license_no=?, license_expiry=? WHERE id=?");
    $stmt->bind_param("ssssssi", $name, $phone, $dob, $address, $license_no, $license_expiry, $user_id);
    $stmt->execute();
    $stmt->close();
}

// Fetch user details
$stmt = $conn->prepare("SELECT name, phone, dob, address, license_no, license_expiry FROM individuals WHERE id=?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($name, $phone, $dob, $address, $license_no, $license_expiry);
$stmt->fetch();
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Personal Details</title>
    <style>
        body {
            background-color: white;
            color: #c9d1d9;
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            padding: 50px;
        }

        .profile-container {
            background-color: #161b22;
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0 0 15px rgba(0,0,0,0.6);
            width: 500px;
            text-align: center;
        }

        .avatar {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background-color: #30363d;
            margin: 0 auto 20px auto;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            color: #8b949e;
        }

        input, textarea {
            width: 100%;
            margin: 10px 0;
            padding: 10px;
            background-color: #0d1117;
            border: 1px solid #30363d;
            border-radius: 5px;
            color: #c9d1d9;
        }

        .btn {
            background-color: green;
            border: none;
            padding: 10px 20px;
            color: white;
            cursor: pointer;
            margin-top: 15px;
            border-radius: 5px;
        }

        .btn:hover {
            background-color: grey;
        }

        .btn:disabled {
            background-color: #30363d;
            cursor: not-allowed;
        }

        h2 {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="profile-container">
        <div class="avatar">👤</div>
        <h2>Personal Details</h2>
        <form method="POST" id="profileForm">
            <input type="text" name="name" value="<?= htmlspecialchars($name) ?>" disabled required>
            <input type="tel" name="phone" value="<?= htmlspecialchars($phone) ?>" disabled required>
            <input type="date" name="dob" value="<?= htmlspecialchars($dob) ?>" disabled required>
            <textarea name="address" rows="2" disabled required><?= htmlspecialchars($address) ?></textarea>
            <input type="text" name="license_no" value="<?= htmlspecialchars($license_no) ?>" disabled required>
            <input type="text" name="license_expiry" value="<?= htmlspecialchars($license_expiry) ?>" disabled required>
            <button type="button" id="editBtn" class="btn">Edit</button>
            <button type="submit" id="saveBtn" class="btn" disabled>Save Changes</button>
        </form>
    </div>

    <script>
        const editBtn = document.getElementById('editBtn');
        const saveBtn = document.getElementById('saveBtn');
        const inputs = document.querySelectorAll('#profileForm input, #profileForm textarea');

        editBtn.addEventListener('click', () => {
            inputs.forEach(input => input.disabled = false);
            saveBtn.disabled = false;
            editBtn.disabled = true;
        });
    </script>
</body>
</html>
