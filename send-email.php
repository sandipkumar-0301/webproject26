<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('log_errors', 1);
ini_set('error_log', 'php-error.log');

// Set JSON header
header('Content-Type: application/json');

// Debug: Log the request
error_log("=== New Request ===");
error_log("Method: " . $_SERVER['REQUEST_METHOD']);
error_log("POST: " . print_r($_POST, true));

// Check if it's a POST request
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    echo json_encode([
        'status' => 'error',
        'message' => 'Invalid request method. Please use POST.',
        'debug' => ['method' => $_SERVER['REQUEST_METHOD']]
    ]);
    exit;
}

// Check if POST data exists
if (empty($_POST)) {
    echo json_encode([
        'status' => 'error',
        'message' => 'No POST data received. Please check your form.',
        'debug' => ['raw_input' => file_get_contents('php://input')]
    ]);
    exit;
}

// Get form data
$name = isset($_POST['name']) ? trim($_POST['name']) : '';
$email = isset($_POST['email']) ? trim($_POST['email']) : '';

// Debug: Log the extracted values
error_log("Name: '$name'");
error_log("Email: '$email'");

// Validate name
if (empty($name)) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Please enter your name',
        'debug' => ['received' => $_POST]
    ]);
    exit;
}

if (strlen($name) < 2) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Name must be at least 2 characters',
        'debug' => ['length' => strlen($name)]
    ]);
    exit;
}

// Validate email
if (empty($email)) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Please enter your email address'
    ]);
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Please enter a valid email address'
    ]);
    exit;
}

// =============================================
// Send Email
// =============================================
$to = "support@saifitrustandassociates.com"; // CHANGE THIS!
$subject = "New Subscription from " . $name;
$message = "New subscription request:\n\n";
$message .= "Name: " . $name . "\n";
$message .= "Email: " . $email . "\n";
$message .= "IP: " . $_SERVER['REMOTE_ADDR'] . "\n";
$message .= "Date: " . date('Y-m-d H:i:s') . "\n";
$message .= "User Agent: " . $_SERVER['HTTP_USER_AGENT'] . "\n";

$headers = "From: " . $email . "\r\n";
$headers .= "Reply-To: " . $email . "\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

// Try to send email
$mailSent = mail($to, $subject, $message, $headers);

if ($mailSent) {
    echo json_encode([
        'status' => 'success',
        'message' => 'Thank you for subscribing! You will receive updates soon.'
    ]);
} else {
    error_log("Mail failed to send to: $to from: $email");
    echo json_encode([
        'status' => 'error',
        'message' => 'Unable to send email. Please try again later.',
        'debug' => ['mail_sent' => false]
    ]);
}
exit;
?>