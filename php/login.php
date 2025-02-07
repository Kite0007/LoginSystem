<?php
include 'db_connect.php'; // diko alam ilalagay dito
session_start(); // Start the session

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row["password"])) {

            // Check if the account is verified
            if ($row["is_verified"] == 1) {
                // Generate a new OTP for login
                $otp = rand(100000, 999999);
                $update_otp_sql = "UPDATE users SET otp='$otp' WHERE email='$email'";
                if ($conn->query($update_otp_sql) === TRUE) {
                    include 'send_otp.php';
                    sendOTP($email, $otp);
                    $_SESSION['email'] = $email; // Store email in session for OTP verification
                    header("Location: ../otp.html?email=" . urlencode($email)); // Redirect to OTP page
                    exit();
                } else {
                    echo "Error updating OTP: " . $conn->error;
                }
            } else {
                echo "Account not yet verified. Please check your email for OTP.";
            }
        } else {
            echo "Invalid password!";
        }
    } else {
        echo "User not found!";
    }
}
?>
