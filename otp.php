<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OTP Verification</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="form-box">
        <h2>OTP Verification</h2>
        <p>Please enter the OTP sent to your email.</p>
        <form action="php/otp_verification.php<?php echo htmlspecialchars($_GET['email'] ?? ''); ?>">
            <input type="text" name="otp" placeholder="Enter OTP" required>
            <button type="submit">Submit</button>
        </form>
    </div>
</body>

</html>
