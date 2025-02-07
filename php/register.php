<?php
include 'db_connect.php';
include 'send_otp.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize inputs
    $name = $conn->real_escape_string($_POST["name"]);
    $email = $conn->real_escape_string($_POST["email"]);
    $password = password_hash($_POST["password"], PASSWORD_BCRYPT);
    $otp = rand(100000, 999999);

    // Using prepared statement
    $stmt = $conn->prepare("INSERT INTO users (name, email, password, otp) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $email, $password, $otp);

    if ($stmt->execute()) {
        if (sendOTP($email, $otp)) {
            header("Location: ../otp.html?email=" . urlencode($email));
        } else {
            echo "Error sending OTP. Please try again.";
        }
    } else {
        echo "Error: " . $conn->error;
    }
    $stmt->close();
}
?>
