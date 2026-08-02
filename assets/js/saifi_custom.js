// =============================================
// PART 1: WHATSAPP WIDGET
// =============================================
document.addEventListener('DOMContentLoaded', function () {
    const button = document.getElementById('whatsapp-button');
    const popup = document.getElementById('whatsapp-popup');
    const close = document.getElementById('whatsapp-close');

    if (button) {
        button.addEventListener('click', function () {
            popup.style.display = 'block';
        });
    }

    if (close) {
        close.addEventListener('click', function () {
            popup.style.display = 'none';
        });
    }
});

// =============================================
// PART 2: DISCLAIMER MODAL (24-hour cooldown)
// =============================================
document.addEventListener('DOMContentLoaded', function () {
    const popupTime = localStorage.getItem('disclaimerPopupTime');
    const now = new Date().getTime();
    const oneDay = 86400000; // 24 hours

    // Show disclaimer if not shown in last 24 hours
    if (!popupTime || (now - popupTime) > oneDay) {
        const modal = new bootstrap.Modal(document.getElementById('disclaimerModal'));
        modal.show();

        // When user clicks "I Agree"
        document.getElementById('agreeButton').addEventListener('click', function () {
            localStorage.setItem('disclaimerPopupTime', now.toString());
            modal.hide();
        });

        // When user clicks "I Disagree" - redirect or handle
        document.getElementById('disagreeButton').addEventListener('click', function () {
            localStorage.setItem('disclaimerPopupTime', now.toString());
            modal.hide();
            // Optional: Redirect to Google or close
            // window.location.href = 'https://www.google.com';
        });

        // When modal is closed (X button or click outside)
        document.getElementById('disclaimerModal').addEventListener('hidden.bs.modal', function () {
            localStorage.setItem('disclaimerPopupTime', now.toString());
        });
    }
});

// =============================================
// PART 3: SUBSCRIPTION FORM
// =============================================
// =============================================
// PART 3: SUBSCRIPTION FORM (FIXED)
// =============================================
document.addEventListener('DOMContentLoaded', function() {
    // =============================================
    // SUBSCRIPTION FORM
    // =============================================
    const subscribeForm = document.getElementById('subscribeForm');
    const subscribeAlert = document.getElementById('subscribeAlert');

    if (subscribeForm) {
        subscribeForm.addEventListener('submit', function(e) {
            e.preventDefault();
            handleFormSubmit(this, subscribeAlert, 'Subscription');
        });
    }

    // =============================================
    // CONTACT FORM
    // =============================================
    const contactForm = document.getElementById('contactForm');
    const contactAlert = document.getElementById('contactAlert');

    if (contactForm) {
        contactForm.addEventListener('submit', function(e) {
            e.preventDefault();
            handleFormSubmit(this, contactAlert, 'Contact');
        });
    }

    // =============================================
    // SHARED FORM HANDLER
    // =============================================
    function handleFormSubmit(form, alertDiv, formName) {
        // Disable submit button
        const submitBtn = form.querySelector('button[type="submit"]');
        const originalText = submitBtn.innerHTML;
        submitBtn.disabled = true;
        submitBtn.innerHTML = 'Sending... <i class="fas fa-spinner fa-spin ms-2"></i>';

        // Build URL
        const actionUrl = window.location.origin + window.location.pathname.replace(/[^/]*$/, '') + 'send-email';
        
        const formData = new FormData(form);

        console.log(`=== ${formName} Form Submission ===`);
        console.log('Action URL:', actionUrl);
        
        for (let pair of formData.entries()) {
            console.log(pair[0] + ':', pair[1]);
        }

        fetch(actionUrl, {
            method: 'POST',
            body: formData,
            redirect: 'manual'
        })
        .then(response => {
            console.log('Response status:', response.status);
            
            if (response.redirected) {
                throw new Error(`Redirect detected to: ${response.url}`);
            }
            
            const contentType = response.headers.get('content-type');
            if (!contentType || !contentType.includes('application/json')) {
                throw new Error(`Expected JSON but got ${contentType}`);
            }
            
            return response.json();
        })
        .then(data => {
            console.log('Server response:', data);
            if (data.status === 'success') {
                alertDiv.innerHTML = `<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i> ${data.message}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>`;
                form.reset();
            } else {
                alertDiv.innerHTML = `<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i> ${data.message}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>`;
            }
        })
        .catch(error => {
            console.error('Fetch error:', error);
            alertDiv.innerHTML = `<div class="alert alert-danger">
                <strong>Error:</strong> ${error.message}
            </div>`;
        })
        .finally(() => {
            submitBtn.disabled = false;
            submitBtn.innerHTML = originalText;
        });
    }
});