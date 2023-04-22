<?php
require "../../config/connection.php";

$verify_email = $_POST["verify_email"];
$verification_code = substr(bin2hex(random_bytes(5)), 0, 10);

// Check if email exists in tb_users
$stmt = $conn->prepare("SELECT email FROM tb_users WHERE email = ?");
$stmt->execute([$verify_email]);
$user = $stmt->fetch();

if (!$user) {
    // Insert verification
    $stmt = $conn->prepare("INSERT INTO tb_verification (email, verification_code) VALUES (?, ?)");
    if ($stmt->execute([$verify_email, $verification_code])) {
        $to = $verify_email;
        $subject = "Verify your account";
        $message = "Click the following link to verify your email address: http://localhost/Projects/github/SPCC-FES-SA/templates/pages/verify.php?email=" . urlencode($verify_email) . "&code=$verification_code";
        $headers = "From: redpangilinan715@gmail.com" . "\r\n" .
            "Reply-To: redpangilinan715@gmail.com" . "\r\n" .
            "X-Mailer: PHP/" . phpversion();

        if (mail($to, $subject, $message, $headers)) {
            $stmt = $conn->prepare("DELETE FROM tb_verification WHERE email = ? AND verification_code = ? AND timestamp < DATE_SUB(NOW(), INTERVAL 15 MINUTE)");
            $stmt->execute([$verify_email, $verification_code]);
            echo "success";
        } else {
            echo "error_email_verification";
        }
    } else {
        echo "verification_sent";
    }
} else {
    echo "existing_user";
}

$stmt = null;
$conn = null;
