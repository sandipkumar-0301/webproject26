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

    if (form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();

            // Disable submit button
            const submitBtn = form.querySelector('button[type="submit"]');
            submitBtn.disabled = true;
            submitBtn.innerHTML = 'Sending... <i class="fas fa-spinner fa-spin ms-2"></i>';

            // Get form data
            const formData = new FormData(form);
            
            // Get the action URL from form or use default
            const actionUrl = form.getAttribute('action') || 'send-email.php';

            // ✅ EXPLICITLY SET METHOD TO POST
            fetch(actionUrl, {
                method: 'POST',  // ← Make sure this is POST
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
                console.error('Error:', error);
            })
            .finally(() => {
                submitBtn.disabled = false;
                submitBtn.innerHTML = 'Submit <i class="fas fa-paper-plane ms-2"></i>';
            });
        });
    }
});

