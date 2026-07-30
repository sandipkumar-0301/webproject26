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
