<?php
header('Content-Type: application/json');

// Enable error reporting for debugging (remove in production)
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Log incoming data
    error_log("POST data: " . print_r($_POST, true));
    
    // Get form data
    $name = isset($_POST['name']) ? htmlspecialchars(strip_tags(trim($_POST['name']))) : '';
    $email = isset($_POST['email']) ? filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL) : '';
    
    // Debug: Log extracted values
    error_log("Name: '$name'");
    error_log("Email: '$email'");
    
    // Validate
    if (empty($name)) {
        echo json_encode(['status' => 'error', 'message' => 'Please enter your name']);
        exit;
    }
    
    if (strlen($name) < 2) {
        echo json_encode(['status' => 'error', 'message' => 'Name must be at least 2 characters']);
        exit;
    }
    
    if (empty($email)) {
        echo json_encode(['status' => 'error', 'message' => 'Please enter your email']);
        exit;
    }
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(['status' => 'error', 'message' => 'Please enter a valid email address']);
        exit;
    }
    
    // Send email
    $to = "your-email@example.com";
    $subject = "New Subscription from $name";
    $message = "New subscription request:\n\n";
    $message .= "Name: $name\n";
    $message .= "Email: $email\n";
    $message .= "IP: " . $_SERVER['REMOTE_ADDR'] . "\n";
    $message .= "Date: " . date('Y-m-d H:i:s');
    
    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
    
    if (mail($to, $subject, $message, $headers)) {
        echo json_encode(['status' => 'success', 'message' => 'Thank you for subscribing!']);
    } else {
        error_log("Mail failed for: $email");
        echo json_encode(['status' => 'error', 'message' => 'Failed to send. Please try again.']);
    }
    
} else {
    echo json_encode([
        'status' => 'error', 
        'message' => 'Invalid request method. Please use POST.',
        'debug' => ['method' => $_SERVER['REQUEST_METHOD']]
    ]);
}
?>