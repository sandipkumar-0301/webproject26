document.addEventListener('DOMContentLoaded', function () {

    const popupTime = localStorage.getItem('popupTime');
    const now = new Date().getTime();

    // 24 hours
    if (!popupTime || (now - popupTime) > 86400000) {

        const modal = new bootstrap.Modal(
            document.getElementById('verify_amount_popup')
        );

        modal.show();

        document.getElementById('confirm_payment').addEventListener('click', function () {
            localStorage.setItem('popupTime', now);
            modal.hide();
        });

        document.getElementById('verify_amount_popup')
            .addEventListener('hidden.bs.modal', function () {
                localStorage.setItem('popupTime', now);
            });
    }

});


// send-email.php
header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    
    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(['status' => 'error', 'message' => 'Invalid email address']);
        exit;
    }
    
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
}


document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('subscribeForm');
    const alertDiv = document.getElementById('subscribeAlert');
    
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        const formData = new FormData(form);
        
        fetch('send-email.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                alertDiv.innerHTML = `<div class="alert alert-success">${data.message}</div>`;
                form.reset();
            } else {
                alertDiv.innerHTML = `<div class="alert alert-danger">${data.message}</div>`;
            }
        })
        .catch(error => {
            alertDiv.innerHTML = `<div class="alert alert-danger">Network error. Please try again.</div>`;
        });
    });
});