<?php
header('Content-Type: application/json');

// Enable error reporting for debugging (remove in production)
// error_reporting(E_ALL);
// ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Sanitize and validate inputs
    $name = isset($_POST['name']) ? htmlspecialchars(strip_tags(trim($_POST['name']))) : '';
    $email = isset($_POST['email']) ? filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL) : '';
    
    // Validate inputs
    if (empty($name) || strlen($name) < 2) {
        echo json_encode([
            'status' => 'error', 
            'message' => 'Please enter a valid name (minimum 2 characters)'
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
    
    // Email configuration
    $to = "your-email@example.com"; // CHANGE THIS TO YOUR EMAIL
    $subject = "New Subscription from $name";
    
    // Build email message
    $message = "========================================\n";
    $message .= "NEW SUBSCRIPTION REQUEST\n";
    $message .= "========================================\n\n";
    $message .= "Name: " . $name . "\n";
    $message .= "Email: " . $email . "\n";
    $message .= "IP Address: " . $_SERVER['REMOTE_ADDR'] . "\n";
    $message .= "User Agent: " . $_SERVER['HTTP_USER_AGENT'] . "\n";
    $message .= "Date/Time: " . date('Y-m-d H:i:s') . "\n";
    $message .= "========================================\n";
    
    // Email headers
    $headers = "From: " . $email . "\r\n";
    $headers .= "Reply-To: " . $email . "\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
    $headers .= "X-Mailer: PHP/" . phpversion() . "\r\n";
    
    // Optional: Add CC or BCC
    // $headers .= "Cc: admin@yourdomain.com\r\n";
    // $headers .= "Bcc: backup@yourdomain.com\r\n";
    
    // Try to send email
    if (mail($to, $subject, $message, $headers)) {
        // Optional: Save to database
        // saveToDatabase($name, $email);
        
        echo json_encode([
            'status' => 'success', 
            'message' => 'Thank you for subscribing! You will receive updates soon.'
        ]);
    } else {
        // Log error for debugging
        error_log("Mail send failed for: $email from IP: " . $_SERVER['REMOTE_ADDR']);
        
        echo json_encode([
            'status' => 'error', 
            'message' => 'Unable to process subscription. Please try again later.'
        ]);
    }
    
} else {
    echo json_encode([
        'status' => 'error', 
        'message' => 'Invalid request method. Please use POST.'
    ]);
}

// Optional: Database function
function saveToDatabase($name, $email) {
    /*
    $conn = new mysqli('localhost', 'username', 'password', 'database');
    if ($conn->connect_error) {
        return false;
    }
    
    $stmt = $conn->prepare("INSERT INTO subscribers (name, email, ip_address, created_at) VALUES (?, ?, ?, NOW())");
    $ip = $_SERVER['REMOTE_ADDR'];
    $stmt->bind_param("sss", $name, $email, $ip);
    $result = $stmt->execute();
    $stmt->close();
    $conn->close();
    return $result;
    */
}
?>