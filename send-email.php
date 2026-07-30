<?php
header('Content-Type: application/json');

// ✅ Allow both GET and POST for debugging
// Change this line:
// if ($_SERVER["REQUEST_METHOD"] == "POST") {
// To this:
if ($_SERVER["REQUEST_METHOD"] == "POST" || $_SERVER["REQUEST_METHOD"] == "GET") {
    
    // Get data from either POST or GET
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = isset($_POST['name']) ? htmlspecialchars(strip_tags(trim($_POST['name']))) : '';
        $email = isset($_POST['email']) ? filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL) : '';
    } else {
        // GET method (for debugging only)
        $name = isset($_GET['name']) ? htmlspecialchars(strip_tags(trim($_GET['name']))) : '';
        $email = isset($_GET['email']) ? filter_var(trim($_GET['email']), FILTER_SANITIZE_EMAIL) : '';
    }
    
    // Rest of your code...
    if (empty($name) || strlen($name) < 2) {
        echo json_encode(['status' => 'error', 'message' => 'Please enter a valid name']);
        exit;
    }
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(['status' => 'error', 'message' => 'Please enter a valid email']);
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
        echo json_encode(['status' => 'success', 'message' => 'Subscription successful!']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to send. Please try again.']);
    }
    
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method. Please use POST.']);
}
?>