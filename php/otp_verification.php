<?php
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $otp = $_POST["otp"];
    
    $sql = "SELECT * FROM users WHERE otp='$otp'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        echo "OTP Verified. Account activated!";
    } else {
        echo "Invalid OTP!";
    }
}
?>