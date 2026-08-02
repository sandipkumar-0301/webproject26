<?php
// =============================================
// COMPLETE SOLUTION - Handles both Subscription & Contact
// =============================================

// Disable error display (prevents HTML in JSON)
error_reporting(E_ALL);
ini_set('display_errors', 0);
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
        'message' => 'Invalid request method. Please use POST.'
    ]);
    exit;
}

// Check if POST data exists
if (empty($_POST)) {
    echo json_encode([
        'status' => 'error',
        'message' => 'No POST data received. Please check your form.'
    ]);
    exit;
}

// Get form data
$name = isset($_POST['name']) ? trim($_POST['name']) : '';
$email = isset($_POST['email']) ? trim($_POST['email']) : '';
$message = isset($_POST['message']) ? trim($_POST['message']) : '';

// Determine form type (subscription or contact)
$formType = isset($_POST['form_type']) ? $_POST['form_type'] : 'subscription';

// Debug: Log the extracted values
error_log("Form Type: '$formType'");
error_log("Name: '$name'");
error_log("Email: '$email'");
error_log("Message: '$message'");

// =============================================
// VALIDATION
// =============================================

// Validate name
if (empty($name)) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Please enter your name'
    ]);
    exit;
}

if (strlen($name) < 2) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Name must be at least 2 characters'
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

// Validate message for contact form
if ($formType === 'contact' && empty($message)) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Please enter your message'
    ]);
    exit;
}

// =============================================
// LOG TO FILE (Works without any SMTP)
// =============================================
$logFile = __DIR__ . '/submissions.log';
$logEntry = "============================\n";
$logEntry .= "Form Type: " . strtoupper($formType) . "\n";
$logEntry .= "Date: " . date('Y-m-d H:i:s') . "\n";
$logEntry .= "Name: " . $name . "\n";
$logEntry .= "Email: " . $email . "\n";
if (!empty($message)) {
    $logEntry .= "Message: " . $message . "\n";
}
$logEntry .= "IP: " . ($_SERVER['REMOTE_ADDR'] ?? 'unknown') . "\n";
$logEntry .= "User Agent: " . ($_SERVER['HTTP_USER_AGENT'] ?? 'unknown') . "\n";
$logEntry .= "============================\n\n";

file_put_contents($logFile, $logEntry, FILE_APPEND);

// =============================================
// TRY TO SEND EMAIL (if PHPMailer is available)
// =============================================
$emailSent = false;

// Check for PHPMailer
$phpmailerPaths = [
    __DIR__ . '/PHPMailer/src/PHPMailer.php',
    __DIR__ . '/vendor/autoload.php'
];

foreach ($phpmailerPaths as $path) {
    if (file_exists($path)) {
        try {
            if (strpos($path, 'autoload.php') !== false) {
                require_once $path;
            } else {
                require_once $path;
                require_once dirname($path) . '/SMTP.php';
                require_once dirname($path) . '/Exception.php';
            }
            
            if (class_exists('PHPMailer\\PHPMailer\\PHPMailer')) {
                // PHPMailer found - try to send email
                $mail = new PHPMailer\PHPMailer\PHPMailer(true);
                
                // Server settings - CHANGE THESE!
                $mail->isSMTP();
                $mail->Host       = 'smtp.gmail.com';
                $mail->SMTPAuth   = true;
                $mail->Username   = 'sandip.officeuse@gmail.com';  // YOUR GMAIL
                $mail->Password   = 'gmmw imgt burt gdlq';      // APP PASSWORD
                $mail->SMTPSecure = 'tls';
                $mail->Port       = 587;
                $mail->SMTPDebug  = 0;
                
                // Recipients
                $mail->setFrom('support@saifitrustandassociates.com', 'Saifi Trust & Associates');
                $mail->addAddress('support@saifitrustandassociates.com');
                $mail->addReplyTo($email, $name);
                
                // Content based on form type
                if ($formType === 'contact') {
                    $mail->Subject = "Contact Form Message from " . $name;
                    $mail->Body    = "Contact Form Submission:\n\n"
                                   . "Name: " . $name . "\n"
                                   . "Email: " . $email . "\n"
                                   . "Message: " . $message . "\n\n"
                                   . "IP: " . ($_SERVER['REMOTE_ADDR'] ?? 'unknown') . "\n"
                                   . "Date: " . date('Y-m-d H:i:s');
                } else {
                    $mail->Subject = "New Subscription from " . $name;
                    $mail->Body    = "Subscription Request:\n\n"
                                   . "Name: " . $name . "\n"
                                   . "Email: " . $email . "\n\n"
                                   . "Date: " . date('Y-m-d H:i:s');
                }
                
                $mail->send();
                $emailSent = true;
                break;
            }
        } catch (Exception $e) {
            error_log("PHPMailer Error: " . $e->getMessage());
            // Continue to fallback
        }
    }
}

// =============================================
// RETURN SUCCESS RESPONSE
// =============================================

if ($formType === 'contact') {
    $successMessage = 'Thank you for contacting us! We will get back to you within 24 hours.';
} else {
    $successMessage = 'Thank you for subscribing! You will receive updates soon.';
}

echo json_encode([
    'status' => 'success',
    'message' => $successMessage,
    'debug' => [
        'form_type' => $formType,
        'email_sent' => $emailSent,
        'logged' => true
    ]
]);
exit;
?>