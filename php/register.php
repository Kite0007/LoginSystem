<?php
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_BCRYPT);
    $otp = rand(100000, 999999);

    $sql = "INSERT INTO users (name, email, password, otp) VALUES ('$name', '$email', '$password', '$otp')";
    
    if ($conn->query($sql) === TRUE) {
        mail($email, "OTP Verification", "Your OTP code is: $otp");
        header("Location: ../otp.html");
    } else {
        echo "Error: " . $conn->error;
    }
}
?>