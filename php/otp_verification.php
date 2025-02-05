<?php
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $otp = $_POST["otp"];
    $email = $_GET['email'] ?? '';

    // Using prepared statement
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ? AND otp = ?");
    $stmt->bind_param("ss", $email, $otp);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Update verified status
        $update = $conn->prepare("UPDATE users SET otp = NULL WHERE email = ?");
        $update->bind_param("s", $email);
        $update->execute();
        
        echo "OTP Verified! Account activated.";
    } else {
        echo "Invalid OTP!";
    }
}
?>