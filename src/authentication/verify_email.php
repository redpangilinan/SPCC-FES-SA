<?php
require "../../config/connection.php";

// Get email from root config
$config_content = file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/config.json");
$config = json_decode($config_content, true);
$sender_email = $config['email'];

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
        $subject = "Verification sent!";
        $message = "This is your verification code: $verification_code";
        $headers = "From: $sender_email" . "\r\n" .
            "Reply-To: $sender_email" . "\r\n" .
            "X-Mailer: PHP/" . phpversion();

        if (mail($to, $subject, $message, $headers)) {
            $stmt = $conn->prepare("DELETE FROM tb_verification WHERE email = ? AND verification_code = ? AND timestamp < DATE_SUB(NOW(), INTERVAL 15 MINUTE)");
            $stmt->execute([$verify_email, $verification_code]);
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            $_SESSION['verify_email'] = $verify_email;
            $_SESSION['verification_code'] = $verification_code;
            echo "success";
            exit();
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
