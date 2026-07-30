document.addEventListener('DOMContentLoaded', function () {

    // =============================================
    // PART 1: POPUP LOGIC (24-hour cooldown)
    // =============================================
    const popupTime = localStorage.getItem('popupTime');
    const now = new Date().getTime();

    // 24 hours = 86400000 milliseconds
    if (!popupTime || (now - popupTime) > 86400000) {
        const modal = new bootstrap.Modal(
            document.getElementById('verify_amount_popup')
        );
        modal.show();

        document.getElementById('confirm_payment').addEventListener('click', function () {
            localStorage.setItem('popupTime', now.toString());
            modal.hide();
        });

        document.getElementById('verify_amount_popup')
            .addEventListener('hidden.bs.modal', function () {
                localStorage.setItem('popupTime', now.toString());
            });
    }

    // =============================================
    // PART 2: SUBSCRIPTION FORM LOGIC
    // =============================================
    const form = document.getElementById('subscribeForm');
    const alertDiv = document.getElementById('subscribeAlert');

    if (form) { // Check if form exists on the page
        form.addEventListener('submit', function (e) {
            e.preventDefault();

            // Disable submit button to prevent double submission
            const submitBtn = form.querySelector('button[type="submit"]');
            submitBtn.disabled = true;
            submitBtn.innerHTML = 'Sending... <i class="fas fa-spinner fa-spin ms-2"></i>';

            const formData = new FormData(form);

            fetch('send-email.php', {
                method: 'POST',
                body: formData
            })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        alertDiv.innerHTML = `<div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle me-2"></i> ${data.message}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>`;
                        form.reset();
                        
                        // Optional: Close popup if subscription is successful
                        const modalElement = document.getElementById('verify_amount_popup');
                        if (modalElement) {
                            const modalInstance = bootstrap.Modal.getInstance(modalElement);
                            if (modalInstance) {
                                setTimeout(() => modalInstance.hide(), 2000);
                            }
                        }
                    } else {
                        alertDiv.innerHTML = `<div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fas fa-exclamation-circle me-2"></i> ${data.message}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>`;
                    }
                })
                .catch(error => {
                    alertDiv.innerHTML = `<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-circle me-2"></i> Network error. Please try again.
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>`;
                    console.error('Error:', error);
                })
                .finally(() => {
                    // Re-enable submit button
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = 'Submit <i class="fas fa-paper-plane ms-2"></i>';
                    
                    // Auto-hide alert after 5 seconds
                    setTimeout(() => {
                        const alert = alertDiv.querySelector('.alert');
                        if (alert) {
                            const bsAlert = new bootstrap.Alert(alert);
                            bsAlert.close();
                        }
                    }, 5000);
                });
        });
    }
});